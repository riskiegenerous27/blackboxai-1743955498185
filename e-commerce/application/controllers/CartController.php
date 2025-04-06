<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartController extends CI_Controller {
    public function index() {
        // Display cart contents
        $this->load->view('cart/index');
    }

    public function add($product_id) {
        // Add product to cart
        $this->load->model('Product_model');
        $product = $this->Product_model->get_product($product_id);
        
        if($product) {
            $cart = $this->session->userdata('cart') ?? array();
            $cart[$product_id] = $product;
            $this->session->set_userdata('cart', $cart);
        }
        
        redirect('cart');
    }

    public function remove($product_id) {
        // Remove product from cart
        $cart = $this->session->userdata('cart') ?? array();
        unset($cart[$product_id]);
        $this->session->set_userdata('cart', $cart);
        
        redirect('cart');
    }
}