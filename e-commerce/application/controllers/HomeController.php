<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {
    public function index() {
        $this->load->model('Product_model');
        $data['products'] = $this->Product_model->get_featured_products();
        $this->load->view('home', $data);
    }

    public function about() {
        $this->load->view('about');
    }

    public function contact() {
        $this->load->view('contact');
    }
}