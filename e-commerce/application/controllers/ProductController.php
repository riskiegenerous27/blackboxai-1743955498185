<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
    }

    public function index() {
        $data['products'] = $this->Product_model->get_all_products();
        $this->load->view('products/index', $data);
    }

    public function details($id) {
        $data['product'] = $this->Product_model->get_product($id);
        if(empty($data['product'])) {
            show_404();
        }
        $this->load->view('products/details', $data);
    }

    public function category($category_id) {
        $data['products'] = $this->Product_model->get_products_by_category($category_id);
        $this->load->view('products/index', $data);
    }

    public function search() {
        $keyword = $this->input->get('q');
        $data['products'] = $this->Product_model->search_products($keyword);
        $data['search_term'] = $keyword;
        $this->load->view('products/index', $data);
    }
}