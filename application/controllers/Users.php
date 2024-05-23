<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Users extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('user_model', 'user');
    }

    private function check_isvalidated()
    {
        if (!$this->session->userdata('isLogin')) {
            redirect('/');
        }
    }

    public function formadd()
    {
        $data['title'] = 'Add User';
        
        $this->load->view('components/header', $data);
        $this->load->view('pages/form_add_user', $data);
        $this->load->view('components/footer');
    }

    public function formlist()
    {
        $data['title'] = 'All Users';
        
        $this->load->view('components/header', $data);
        $this->load->view('pages/users_list', $data);
        $this->load->view('components/footer');
    }

    public function formEdit($id)
    {
        $data['title'] = 'Edit User';
        $data['user'] = $this->user->get_user_details($id);
        $this->load->view('components/header', $data);
        $this->load->view('pages/form_add_user', $data);
        $this->load->view('components/footer');
    }

    public function get()
    {
        $users = $this->user->get_users();

        $data = array();

        foreach ($users as $user) {
            $data[] = array(
                'Complete Name' => $user->complete_name,
                'Username' => $user->username,
                'Role' => $user->user_type ,
                'Date Added' => $user->date_registered,
                'Action' => '
                    <a class="btn btn-datatable btn-icon me-2" href="'.base_url().'user/edit/'.$user->user_id.'" title="edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript:void(0)" title="delete" onclick="deleteUser('.$user->user_id.')">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript:void(0)" title="reset user password" onclick="resetUserPass('.$user->user_id.')">
                        <i class="fas fa-refresh"></i>
                    </a>
                        '
            );
        }

        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('complete_name', 'Complate Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_rules('user_type', 'User Type', 'required|trim');
        if ( $this->form_validation->run() == FALSE ) {
            $errors = validation_errors('<li>', '</li>');
            echo json_encode([
                'status' => 401,
                'response' => 'error',
                'response_message' =>$errors
            ]);
        } else {
            $cname = $this->input->post('complete_name');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $utype = $this->input->post('user_type');

            $checkName = $this->user->get_user_name($cname);
            $checkUsername = $this->user->get_username($username);

            if ($checkName) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "User's name is already exist."
                ]);
            } else if ($checkUsername) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "User's username is already exist."
                ]);
            } else {
                $datas = [
                    'username' => $username,
                    'password' => $password ,
                    'complete_name' => $cname,
                    'user_type' => $utype
                ];
                $insert  = $this->user->add_user($datas);
                if ($insert) {
                    echo json_encode([
                        'status' => 200,
                        'response'	=> "success",
                        'response_message' => "User successfully saved."
                    ]);
                } else {
                    echo json_encode([
                        'status' => 401,
                        'response'	=> "error",
                        'response_message' => "Unable to save user."
                    ]);
                }
            }
        }
    }

    public function put()
    {
        $this->form_validation->set_rules('complete_name', 'Complate Name', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('user_type', 'User Type', 'required|trim');
        if ( $this->form_validation->run() == FALSE ) {
            $errors = validation_errors('<li>', '</li>');
            echo json_encode([
                'status' => 401,
                'response' => 'error',
                'response_message' =>$errors
            ]);
        } else {
            $cname = $this->input->post('complete_name');
            $username = $this->input->post('username');
            $utype = $this->input->post('user_type');
            $userId = $this->input->post('user_id');

            $checkName = $this->user->get_user_name_other($userId, $cname);
            $checkUsername = $this->user->get_username_other($userId, $username);

            if ($checkName) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "User's name is already exist."
                ]);
            } else if ($checkUsername) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "User's username is already exist."
                ]);
            } else {
                $datas = [
                    'username' => $username,
                    'complete_name' => $cname,
                    'user_type' => $utype
                ];
                $update  = $this->user->update_user($datas ,'user_id = "'.$userId.'"');
                if ($update) {
                    echo json_encode([
                        'status' => 200,
                        'response'	=> "success",
                        'response_message' => "User successfully saved."
                    ]);
                } else {
                    echo json_encode([
                        'status' => 401,
                        'response'	=> "error",
                        'response_message' => "Unable to save user."
                    ]);
                }
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $delete  = $this->user->delete_user('user_id = "' . $id . '"');
        if ($delete) {
            echo json_encode([
                'status' => 200,
                'response'	=> "success",
                'response_message' => "User successfully deleted."
            ]);
        } else {
            echo json_encode([
                'status' => 401,
                'response'	=> "error",
                'response_message' => "Unable to delete user."
            ]);
        }
    }

    public function reset()
    {
        $userId = $this->input->post('id');
        $datas = [
            'password' => MD5('dis-2024')
        ];
        $update  = $this->user->update_user($datas ,'user_id = "'.$userId.'"');
        if ($update) {
            echo json_encode([
                'status' => 200,
                'response'	=> "success",
                'response_message' => "User password successfully reset."
            ]);
        } else {
            echo json_encode([
                'status' => 401,
                'response'	=> "error",
                'response_message' => "Unable to reset user password."
            ]);
        }
    }
}