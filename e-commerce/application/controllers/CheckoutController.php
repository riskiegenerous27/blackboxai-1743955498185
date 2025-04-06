<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CheckoutController extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Order_model');
    }

    public function index() {
        // Verify cart has items
        $cart = $this->session->userdata('cart') ?? array();
        if(empty($cart)) {
            redirect('cart');
        }

        $this->load->view('checkout/index');
    }

    public function process() {
        // Process the order
        $this->load->library('form_validation');
        $this->form_validation->set_rules('address', 'Address', 'required');

        if($this->form_validation->run() === FALSE) {
            $this->index();
            return;
        }

        $cart = $this->session->userdata('cart') ?? array();
        $total = array_reduce($cart, function($sum, $item) {
            return $sum + $item['price'];
        }, 0);

        $order_data = [
            'user_id' => $this->session->userdata('user_id'),
            'total' => $total,
            'address' => $this->input->post('address'),
            'status' => 'pending'
        ];

        $order_id = $this->Order_model->create_order($order_data, $cart);
        
        // Clear cart
        $this->session->unset_userdata('cart');
        
        // Redirect to order confirmation
        redirect('orders/view/'.$order_id);
    }
}