<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_service extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function list()
    {
        return $this->Product_model->get_all();
    }

    public function create($post, $files)
    {
        $this->db->trans_start();

        $productData = [
            'product_code' => $post['product_code'],
            'stock_amount' => $post['stock'],
            'subtract_stock' => $post['subtract_stock'],
            'tax_rate' => 18,
            'extra_discount_percent' => $post['extra_discount'],
            'status' => $post['status'],
            'show_features' => $post['show_features'],
            'validity_date' => $post['new_valid_until'],
            'sort_order' => $post['sort_order'],
            'show_on_homepage' => $post['show_on_homepage'],
            'is_new' => $post['is_new'],
            'allow_installments' => $post['allow_installments'],
            'warranty_period' => $post['warranty'],
        ];

        if (!empty($files['main_image']['name'])) {
            $main_image_name = $this->Product_model->upload_main_image($files);
            $productData['main_image'] = $main_image_name;
        }

        $product_id = $this->Product_model->insert_product($productData);

        $descData = [
            'product_id' => $product_id,
            'language_code' => 'tr',
            'title' => $post['title'],
            'sub_title' => $post['sub_title'],
            'sub_description' => $post['sub_description'],
            'meta_title' => $post['meta_title'],
            'meta_keywords' => $post['meta_keywords'],
            'meta_description' => $post['meta_description'],
            'seo_url' => !empty($post['seo_url']) ? $post['seo_url'] : $post['title'], 'description' => $post['description'],
            'video_embed_code' => $post['video_embed'],
        ];
        $this->Product_model->insert_description($descData);

        $this->Product_model->insert_price($product_id, 'TL', $post['price_tl'], 1);
        $this->Product_model->insert_price($product_id, 'USD', $post['price_usd'], 1);
        $this->Product_model->insert_price($product_id, 'EUR', $post['price_eur'], 1);
        $this->Product_model->insert_price($product_id, 'TL', $post['price_2_tl'], 2);

        if (!empty($files['additional_images']['name'][0])) {
            foreach ($files['additional_images']['name'] as $key => $imgName) {
                $tmp_name = $files['additional_images']['tmp_name'][$key];
                $new_name = $this->Product_model->upload_additional_image($imgName, $tmp_name);
                $this->Product_model->insert_additional_image($product_id, $new_name);
            }
        }

        $this->handle_discounts($product_id, $post);
        $this->db->trans_complete();

        return $this->db->trans_status();
    }

    private function handle_discounts($product_id, $post)
    {
        $this->db->where('product_id', $product_id)->delete('product_discounts');

        if (isset($post['discount']) && is_array($post['discount'])) {
            foreach ($post['discount'] as $row) {

                $currencies = [
                    'TL' => $row['price_tl'],
                    'USD' => $row['price_usd'],
                    'EUR' => $row['price_eur']
                ];

                foreach ($currencies as $currency => $val) {
                    $clean_val = str_replace(',', '.', $val);

                    if (!empty($clean_val) && (float)$clean_val > 0) {
                        $discountData = [
                            'product_id' => $product_id,
                            'customer_group' => $row['customer_group'],
                            'priority' => (int)$row['priority'],
                            'discount_value' => (float)$clean_val,
                            'currency' => $currency,
                            'type' => $row['type'] ?? 'price',
                            'start_date' => !empty($row['start_date']) ? $row['start_date'] : NULL,
                            'end_date' => !empty($row['end_date']) ? $row['end_date'] : NULL
                        ];
                        $this->db->insert('product_discounts', $discountData);
                    }
                }
            }
        }
    }

    public function update($id, $post, $files)
    {
        $this->db->trans_start();

        $productData = [
            'product_code' => $post['product_code'],
            'stock_amount' => $post['stock'],
            'subtract_stock' => $post['subtract_stock'],
            'extra_discount_percent' => $post['extra_discount'],
            'status' => $post['status'],
            'show_features' => $post['show_features'],
            'validity_date' => $post['new_valid_until'],
            'sort_order' => $post['sort_order'],
            'show_on_homepage' => $post['show_on_homepage'],
            'is_new' => $post['is_new'],
            'allow_installments' => $post['allow_installments'],
            'warranty_period' => $post['warranty'],
        ];

        if (!empty($files['main_image']['name'])) {
            $main_image_name = $this->Product_model->upload_main_image($files);
            if ($main_image_name) {
                $productData['main_image'] = $main_image_name;
            }
        }

        $this->db->where('id', $id)->update('products', $productData);

        $descData = [
            'title' => $post['title'],
            'sub_title' => $post['sub_title'],
            'sub_description' => $post['sub_description'],
            'meta_title' => $post['meta_title'],
            'meta_keywords' => $post['meta_keywords'],
            'meta_description' => $post['meta_description'],
            'seo_url' => !empty($post['seo_url']) ? $post['seo_url'] : $post['title'], 'description' => $post['description'],
            'video_embed_code' => $post['video_embed'],
        ];
        $this->db->where('product_id', $id)->update('product_descriptions', $descData);

        $this->db->where('product_id', $id)->delete('product_prices');
        $this->Product_model->insert_price($id, 'TL', $post['price_tl'], 1);
        $this->Product_model->insert_price($id, 'USD', $post['price_usd'], 1);
        $this->Product_model->insert_price($id, 'EUR', $post['price_eur'], 1);
        $this->Product_model->insert_price($id, 'TL', $post['price_2_tl'], 2);

        if (!empty($files['additional_images']['name'][0])) {
            foreach ($files['additional_images']['name'] as $key => $imgName) {
                $tmp_name = $files['additional_images']['tmp_name'][$key];
                $new_name = $this->Product_model->upload_additional_image($imgName, $tmp_name);
                if ($new_name) {
                    $this->Product_model->insert_additional_image($id, $new_name);
                }
            }
        }
        $this->handle_discounts($id, $post);

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
