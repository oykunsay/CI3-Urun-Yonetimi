<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function get_product_by_id($id)
    {
        $this->db->select('
            p.*, 
            pd.title, pd.sub_title, pd.sub_description, pd.meta_title, pd.meta_keywords, pd.meta_description, pd.seo_url, pd.description, pd.video_embed_code,
            pr_tl.price AS price_tl,
            pr_usd.price AS price_usd,
            pr_eur.price AS price_eur,
            pr_2_tl.price AS second_price
        ');
        $this->db->from('products p');
        $this->db->join('product_descriptions pd', 'pd.product_id = p.id AND pd.language_code="tr"', 'left');

        $this->db->join('product_prices pr_tl', 'pr_tl.product_id = p.id AND pr_tl.currency="TL" AND pr_tl.price_type=1', 'left');
        $this->db->join('product_prices pr_usd', 'pr_usd.product_id = p.id AND pr_usd.currency="USD" AND pr_usd.price_type=1', 'left');
        $this->db->join('product_prices pr_eur', 'pr_eur.product_id = p.id AND pr_eur.currency="EUR" AND pr_eur.price_type=1', 'left');

        $this->db->join('product_prices pr_2_tl', 'pr_2_tl.product_id = p.id AND pr_2_tl.currency="TL" AND pr_2_tl.price_type=2', 'left');

        $this->db->where('p.id', $id);
        return $this->db->get()->row();
    }

    public function get_all()
    {
        $this->db->select('
            p.id, p.product_code, p.stock_amount, p.subtract_stock, p.tax_rate, p.status, p.validity_date, p.main_image, 
            pd.title, pd.description,
            pr_tl.price AS price_tl,
            pr_2_tl.price AS second_price, 
            pr_usd.price AS price_usd,
            pr_eur.price AS price_eur
        ');
        $this->db->from('products p');
        $this->db->join('product_descriptions pd', 'pd.product_id = p.id AND pd.language_code="tr"', 'left');
        $this->db->join('product_prices pr_tl', 'pr_tl.product_id = p.id AND pr_tl.currency="TL" AND pr_tl.price_type=1', 'left');
        $this->db->join('product_prices pr_2_tl', 'pr_2_tl.product_id = p.id AND pr_2_tl.currency="TL" AND pr_2_tl.price_type=2', 'left');
        $this->db->join('product_prices pr_usd', 'pr_usd.product_id = p.id AND pr_usd.currency="USD" AND pr_usd.price_type=1', 'left');
        $this->db->join('product_prices pr_eur', 'pr_eur.product_id = p.id AND pr_eur.currency="EUR" AND pr_eur.price_type=1', 'left');

        $this->db->order_by('p.id', 'ASC');
        return $this->db->get()->result();
    }

    public function insert_product($data)
    {
        $this->db->insert('products', $data);
        return $this->db->insert_id();
    }

    public function insert_description($data)
    {
        $this->db->insert('product_descriptions', $data);
    }

    public function insert_price($product_id, $currency, $price, $type)
    {
        if ($price === '' || $price === null) return;
        $this->db->insert('product_prices', [
            'product_id' => $product_id,
            'currency' => $currency,
            'price' => $price,
            'price_type' => $type
        ]);
    }

    public function upload_main_image($files)
    {
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('main_image')) {
            $data = $this->upload->data();
            return $data['file_name'];
        } else {
            return null;
        }
    }

    public function upload_additional_image($name, $tmp_name)
    {
        $config['upload_path'] = './uploads/products/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $_FILES['temp_img']['name'] = $name;
        $_FILES['temp_img']['type'] = 'image/jpeg';
        $_FILES['temp_img']['tmp_name'] = $tmp_name;
        $_FILES['temp_img']['error'] = 0;
        $_FILES['temp_img']['size'] = 5000;

        if ($this->upload->do_upload('temp_img')) {
            $data = $this->upload->data();
            return $data['file_name'];
        }
        return null;
    }

    public function insert_additional_image($product_id, $image_name)
    {
        return $this->db->insert('product_images', [
            'product_id' => $product_id,
            'image_path' => $image_name
        ]);
    }

    public function update_product($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('products', $data);
    }

    public function get_product_images($product_id)
    {
        return $this->db->where('product_id', $product_id)->get('product_images')->result();
    }

    public function delete_related_data($product_id)
    {
        $this->db->where('product_id', $product_id)->delete('product_descriptions');
        $this->db->where('product_id', $product_id)->delete('product_prices');
    }

    public function get_product_discounts($product_id = null)
    {
        if (!$product_id) {
            return [];
        }

        $this->db->select('pd.*, p.product_code, pd.product_id, desc.title as product_name');
        $this->db->from('product_discounts pd');
        $this->db->join('products p', 'p.id = pd.product_id');
        $this->db->join('product_descriptions desc', 'desc.product_id = p.id');

        $this->db->where('pd.product_id', $product_id);

        $this->db->order_by('pd.priority', 'ASC');
        $this->db->order_by('pd.product_id', 'ASC');

        return $this->db->get()->result();
    }

    public function delete_product($id)
    {

        $this->db->where('product_id', $id)->delete('product_descriptions');

        $this->db->where('product_id', $id)->delete('product_prices');

        $this->db->where('product_id', $id)->delete('product_images');
        $this->db->where('product_id', $id)->delete('product_discounts');

        $this->db->where('id', $id);
        return $this->db->delete('products');
    }
}