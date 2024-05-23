<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('user_model', 'user');
        $this->load->model('doctor_model', 'doctor');
    }

    private function check_isvalidated()
    {
        if (!$this->session->userdata('isLogin')) {
            redirect('/');
        }
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['todaysDate'] = date('Y-m-d H:i:s');
        $data['totalUsers'] = $this->user->total_users();
        $data['totalDoctors'] = $this->doctor->total_doctors();
        $resultSoon = $this->doctor->get_doctors_expiring_soon();
        $resultRecently = $this->doctor->get_doctors_recently_expired();
        $data['expiringSoon'] = $resultSoon['doctors'];
        $data['totalExpiringSoon'] = $resultSoon['total'];
        $data['expirRecently'] = $resultRecently['doctors'];
        $data['totalExpiringRecently'] = $resultRecently['total'];
        $this->load->view('components/header', $data);
        $this->load->view('pages/home', $data);
        $this->load->view('components/footer');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
