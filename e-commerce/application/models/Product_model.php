<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_products() {
        return $this->db->get('products')->result_array();
    }

    public function get_product($id) {
        return $this->db->get_where('products', ['id' => $id])->row_array();
    }

    public function get_featured_products() {
        $this->db->where('is_featured', 1);
        return $this->db->get('products')->result_array();
    }

    public function get_products_by_category($category_id) {
        return $this->db->get_where('products', ['category_id' => $category_id])->result_array();
    }

    public function search_products($keyword) {
        $this->db->like('name', $keyword);
        return $this->db->get('products')->result_array();
    }
}