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
        // PRC
        $resultSoon = $this->doctor->get_doctors_expiring_soon();
        $resultRecently = $this->doctor->get_doctors_recently_expired();
        $data['expiringSoon'] = $resultSoon['doctors'];
        $data['totalExpiringSoon'] = $resultSoon['total'];
        $data['expirRecently'] = $resultRecently['doctors'];
        $data['totalExpiringRecently'] = $resultRecently['total'];
        //PHIC
        $resultPHICSpoon = $this->doctor->get_doctors_phic_expiring_soon();
        $resutlPHICRecently = $this->doctor->get_doctors_recently_expired_phic();
        $data['phicExpiringSoon'] = $resultPHICSpoon['doctors'];
        $data['totalPhicExpiringSoon'] = $resultPHICSpoon['total'];
        $data['expirRecentlyPhic'] = $resutlPHICRecently['doctors'];
        $data['totalExpiringRecentlyPhic'] = $resutlPHICRecently['total'];
        //S2
        $resultS2Soon = $this->doctor->get_doctors_s2_expiring_soon();
        $resultS2Recently = $this->doctor->get_doctors_recently_expired_s2();
        $data['s2ExpiringSoon'] = $resultS2Soon['doctors'];
        $data['totalS2ExpiringSoon'] = $resultS2Soon['total'];
        $data['expirRecentlyS2'] = $resultS2Recently['doctors'];
        $data['totalExpiringRecentlyS2'] = $resultS2Recently['total'];

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
