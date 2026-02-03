<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function save()
    {
        $this->load->model('Product_service');
        $this->load->library('form_validation');
        $this->load->helper('form');

        $this->form_validation->set_message('required', '{field} alanı boş bırakılamaz.');
        $this->form_validation->set_message('min_length', '{field} en az {param} karakter olmalıdır.');
        $this->form_validation->set_message('numeric', '{field} alanı sadece sayı içermelidir.');
        $this->form_validation->set_message('greater_than', '{field} alanı 0\'dan büyük olmalıdır.');
        $post = $this->input->post();
        $files = $_FILES;
        $id = $this->input->post('id');

        $this->form_validation->set_rules('title', 'Ürün Başlığı', 'required|min_length[3]');

        $discounts = $this->input->post('discount');
        if (!empty($discounts)) {
            foreach ($discounts as $key => $val) {
                $this->form_validation->set_rules("discount[$key][priority]", 'Öncelik', 'required|numeric|greater_than[0]');
                $this->form_validation->set_rules("discount[$key][customer_group]", 'Müşteri Grubu', 'required');
                $this->form_validation->set_rules("discount[$key][price_tl]", 'TL Fiyatı', 'numeric');
            }
        }

        if ($this->form_validation->run() == FALSE) {
            return $this->form($id);
        }

        if ($id) {
            $result = $this->Product_service->update($id, $post, $files);
        } else {
            $result = $this->Product_service->create($post, $files);
        }

        if ($result) {
            redirect('product/list_all');
        } else {
            echo "Kayıt sırasında teknik bir hata oluştu. Lütfen veritabanı bağlantınızı veya logları kontrol edin.";
        }
    }

    public function delete($id)
    {
        $this->load->model('Product_model');

        if ($this->Product_model->delete_product($id)) {
            redirect('product/list_all');
        } else {
            echo "Silme işlemi sırasında bir hata oluştu.";
        }
    }

    public function list_all()
    {
        $this->load->model('Product_service');

        $data['products'] = $this->Product_service->list();

        $this->db->select('pd.*, desc.title as product_name');
        $this->db->from('product_discounts pd');
        $this->db->join('products p', 'p.id = pd.product_id');
        $this->db->join('product_descriptions desc', 'desc.product_id = p.id');


        $this->db->order_by('pd.priority', 'ASC');
        $this->db->order_by('pd.id', 'DESC');
        $data['discounted_products'] = $this->db->get()->result();

        $this->load->view('product_list', $data);
    }

    public function form($id = null)
    {
        $this->load->model('Product_model');
        $data = [];
        $data['product_discounts'] = [];
        if ($id) {
            $data['product'] = $this->Product_model->get_product_by_id($id);


            if (!$data['product']) {
                show_404();
            }
            $data['product_images'] = $this->Product_model->get_product_images($id);
        }

        $data['product_images'] = $this->Product_model->get_product_images($id);

        $data['product_discounts'] = $this->Product_model->get_product_discounts($id);        $this->load->helper('form');
        $this->load->view('product_form', $data);

    }

    public function delete_image($id)
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $this->load->model('Product_model');

        $image = $this->db->where('id', $id)->get('product_images')->row();

        if ($image) {
            $file_path = './uploads/products/' . $image->image_path;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            $this->db->where('id', $id)->delete('product_images');

            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false, 'message' => 'Resim bulunamadı.']);
        }
    }
}
