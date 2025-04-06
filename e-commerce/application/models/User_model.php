<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function register($user_data) {
        // Hash password
        $user_data['password'] = password_hash($user_data['password'], PASSWORD_BCRYPT);
        $user_data['created_at'] = date('Y-m-d H:i:s');
        
        return $this->db->insert('users', $user_data);
    }

    public function login($email, $password) {
        $user = $this->db->get_where('users', ['email' => $email])->row_array();
        
        if($user && password_verify($password, $user['password'])) {
            unset($user['password']);
            return $user;
        }
        
        return false;
    }

    public function get_user($id) {
        return $this->db->get_where('users', ['id' => $id])->row_array();
    }

    public function email_exists($email) {
        return $this->db->get_where('users', ['email' => $email])->num_rows() > 0;
    }
}