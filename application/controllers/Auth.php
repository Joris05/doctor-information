<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model', 'user');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ( $this->form_validation->run() == FALSE ) {
            $errors = validation_errors('<li>', '</li>');
            echo json_encode([
                'status' => 401,
                'response' => 'error',
                'response_message' =>$errors
            ]);
        } else {
            $username = $this->input->post('username');
            $password = MD5($this->input->post('password'));

            $user = $this->user->check_user($username, $password);

            if($user) {
                $data    = [
                    'userid' => $user->user_id,
                    'name' => $user->complete_name,
                    'username' => $user->username,
                    'usertype ' => $user->user_type ,
                    'isLogin' => true
                ];
                $this->session->set_userdata($data);
                echo json_encode([
                    'status' => 200,
                    'redirect' => 'dashboard',
                ]);
            } else {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => 'You have entered an invalid username or password.'
                ]);
            }
        }

    }

}