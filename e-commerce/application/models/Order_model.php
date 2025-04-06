<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function create_order($order_data, $cart_items) {
        $this->db->trans_start();
        
        // Insert order
        $this->db->insert('orders', $order_data);
        $order_id = $this->db->insert_id();
        
        // Insert order items
        foreach($cart_items as $product_id => $item) {
            $order_item = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => 1,
                'price' => $item['price']
            ];
            $this->db->insert('order_items', $order_item);
        }
        
        $this->db->trans_complete();
        
        return $order_id;
    }

    public function get_orders_by_user($user_id) {
        $this->db->where('user_id', $user_id);
        $this->db->order_by('created_at', 'DESC');
        return $this->db->get('orders')->result_array();
    }

    public function get_order_details($order_id) {
        $this->db->where('id', $order_id);
        $order = $this->db->get('orders')->row_array();
        
        if($order) {
            $this->db->select('order_items.*, products.name, products.image_url');
            $this->db->join('products', 'products.id = order_items.product_id');
            $this->db->where('order_id', $order_id);
            $order['items'] = $this->db->get('order_items')->result_array();
        }
        
        return $order;
    }
}