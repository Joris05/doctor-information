<?php
defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Manila');
class Doctor extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('doctor_model', 'doctor');
    }

    private function check_isvalidated()
    {
        if (!$this->session->userdata('isLogin')) {
            redirect('/');
        }
    }

    public function formadd()
    {
        $data['title'] = 'Add Doctor';
        
        $this->load->view('components/header', $data);
        $this->load->view('pages/form_add_doctor', $data);
        $this->load->view('components/footer');
    }

    public function formlist()
    {
        $data['title'] = 'All Doctors';
        
        $this->load->view('components/header', $data);
        $this->load->view('pages/doctors_list', $data);
        $this->load->view('components/footer');
    }

    public function formEdit($id)
    {
        $data['title'] = 'Edit Doctor';
        $data['doctor'] = $this->doctor->get_doctor_details($id);
        $data['doctorContact'] = $this->doctor->get_contact_doctor($id);
        $this->load->view('components/header', $data);
        $this->load->view('pages/form_add_doctor', $data);
        $this->load->view('components/footer');
    }

    public function formView($id)
    {
        $data['title'] = 'View Doctor Details';
        $data['doctor'] = $this->doctor->get_doctor_details($id);
        $data['doctorContact'] = $this->doctor->get_contact_doctor($id);
        $this->load->view('components/header', $data);
        $this->load->view('pages/form_view_doctor', $data);
        $this->load->view('components/footer');
    }

    public function get()
    {
        $doctors = $this->doctor->get_doctor();

        $data = array();

        foreach ($doctors as $doctor) {
            $photo = ($doctor->photo) ? base_url().$doctor->photo : base_url().'assets/images/icon/user.png';
            $data[] = array(
                'Doctor Name' => '<div class="d-flex align-items-center">
                                        <div class="avatar me-2"><img class="avatar-img img-fluid" src="'.$photo.'"></div>
                                        '.$doctor->lastname .', ' .$doctor->firstname . ' ' . $doctor->middlename.'
                                    </div>',
                'PRC License Type' => $doctor->prc_license_type,
                'PRC License No' => $doctor->prc_license_no,
                'PRC Expiry Date' => $doctor->prc_expiry_date,
                'Action' => '
                    <a class="btn btn-datatable btn-icon me-2" href="'.base_url().'doctor/edit/'.$doctor->doc_id.'" title="edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="javascript:void(0)" title="delete" onclick="deleteDoctor('.$doctor->doc_id.')">
                        <i class="fas fa-trash"></i>
                    </a>
                    <a class="btn btn-datatable btn-icon btn-transparent-dark me-2" href="'.base_url().'doctor/detail/'.$doctor->doc_id.'" title="view details">
                        <i class="fas fa-info"></i>
                    </a>
                        '
            );
        }

        echo json_encode($data);
    }

    public function store()
    {
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('middlename', 'Middle Name', 'required|trim');
        $this->form_validation->set_rules('birthday', 'Birth Day', 'required|trim');
        $this->form_validation->set_rules('prc_type', 'PRC License Type', 'required|trim');
        $this->form_validation->set_rules('prc_no', 'PRC License No', 'required|trim');
        $this->form_validation->set_rules('prc_expiry_date', 'PRC Expiry Date', 'required|trim');
        $this->form_validation->set_rules('address', 'Residential Address', 'required|trim');
        if ( $this->form_validation->run() == FALSE ) {
            $errors = validation_errors('<li>', '</li>');
            echo json_encode([
                'status' => 401,
                'response' => 'error',
                'response_message' =>$errors
            ]);
        } else {
            $lname = $this->input->post('lastname');
            $fname = $this->input->post('firstname');
            $mname = $this->input->post('middlename');
            $birthday = $this->input->post('birthday');
            $prc_type = $this->input->post('prc_type');
            $prc_no = $this->input->post('prc_no');
            $prcexpiry = $this->input->post('prc_expiry_date');
            $address = $this->input->post('address');
            $contact_numbers = $this->input->post('contact_no');

            $checkDocName = $this->doctor->get_doctor_name($lname, $fname, $mname);
            $checkPRCNo = $this->doctor->get_prc_no($prc_no);

            $filepath = (!empty($_FILES['doctor_photo']['name'])) ?
                        sprintf('assets/doctors/%s_%s', uniqid(), $_FILES['doctor_photo']['name']) :
                        'assets/images/icon/user.png';

            if ($checkDocName) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "Doctor name is already exist."
                ]);
            } else if ($checkPRCNo) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "PRC License No is already exist."
                ]);
            } else {
                $datas = [
                    'lastname' => ucwords($lname),
                    'firstname' => ucwords($fname),
                    'middlename' => ucwords($mname),
                    'birthdate' => date('Y-m-d', strtotime($birthday)),
                    'prc_license_type' => $prc_type,
                    'prc_license_no' => $prc_no,
                    'prc_expiry_date' => date('Y-m-d', strtotime($prcexpiry)),
                    'residential_address' => $address,
                    'photo' => $filepath
                ];
                $insert  = $this->doctor->add_doctor($datas);
                if ($insert) {
                    if (!empty($contact_numbers)) {
                        $contact_data = [];
                        foreach ($contact_numbers as $contact_no) {
                            $contact_data[] = [
                                'doctor_id' => $insert,
                                'mobile_no' => $contact_no
                            ];
                        }
                        $this->doctor->add_contact($contact_data);
                    }
                    if (!move_uploaded_file($_FILES['doctor_photo']['tmp_name'],$filepath)) {
                        throw new RuntimeException('Failed to move uploaded file.');
                    }
                    echo json_encode([
                        'status' => 200,
                        'response'	=> "success",
                        'response_message' => "Doctor successfully saved."
                    ]);
                } else {
                    echo json_encode([
                        'status' => 401,
                        'response'	=> "error",
                        'response_message' => "Unable to save doctor."
                    ]);
                }
            }
        }
    }

    public function put()
    {
        $this->form_validation->set_rules('lastname', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('firstname', 'First Name', 'required|trim');
        $this->form_validation->set_rules('middlename', 'Middle Name', 'required|trim');
        $this->form_validation->set_rules('birthday', 'Birth Day', 'required|trim');
        $this->form_validation->set_rules('prc_type', 'PRC License Type', 'required|trim');
        $this->form_validation->set_rules('prc_no', 'PRC License No', 'required|trim');
        $this->form_validation->set_rules('prc_expiry_date', 'PRC Expiry Date', 'required|trim');
        $this->form_validation->set_rules('address', 'Residential Address', 'required|trim');

        if ( $this->form_validation->run() == FALSE ) {
            $errors = validation_errors('<li>', '</li>');
            echo json_encode([
                'status' => 401,
                'response' => 'error',
                'response_message' =>$errors
            ]);
        } else {
            $docId = $this->input->post('doc_id');
            $lname = $this->input->post('lastname');
            $fname = $this->input->post('firstname');
            $mname = $this->input->post('middlename');
            $birthday = $this->input->post('birthday');
            $prc_type = $this->input->post('prc_type');
            $prc_no = $this->input->post('prc_no');
            $prcexpiry = $this->input->post('prc_expiry_date');
            $address = $this->input->post('address');
            $contact_numbers = $this->input->post('contact_no');

            $checkDocName = $this->doctor->get_doctor_name_other($docId, $lname, $fname, $mname);
            $checkPRCNo = $this->doctor->get_prc_no_other($docId, $prc_no);

            if ($checkDocName) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "Doctor name is already exist."
                ]);
            } else if ($checkPRCNo) {
                echo json_encode([
                    'status' => 401,
                    'response'	=> "error",
                    'response_message' => "PRC License No is already exist."
                ]);
            } else {

                $filepath = (!empty($_FILES['doctor_photo']['name'])) ?
                        sprintf('assets/doctors/%s_%s', uniqid(), $_FILES['doctor_photo']['name']) :
                        '';

                $datas = [
                    'lastname' => ucwords($lname),
                    'firstname' => ucwords($fname),
                    'middlename' => ucwords($mname),
                    'birthdate' => date('Y-m-d', strtotime($birthday)),
                    'prc_license_type' => $prc_type,
                    'prc_license_no' => $prc_no,
                    'prc_expiry_date' => date('Y-m-d', strtotime($prcexpiry)),
                    'residential_address' => $address,
                ];

                if(!empty($filepath)){
                    $datas['photo'] = $filepath;
                }

                $update  = $this->doctor->update_doctor($datas ,'doc_id = "'.$docId.'"');

                if ($update) {

                    $this->doctor->delete_doctor_contact('doctor_id = "'.$docId.'"');

                    if (!empty($contact_numbers)) {
                        $contact_data = [];
                        foreach ($contact_numbers as $contact_no) {
                            $contact_data[] = [
                                'doctor_id' => $docId,
                                'mobile_no' => $contact_no
                            ];
                        }
                        $this->doctor->add_contact($contact_data);
                    }
                    
                    if(!empty($filepath)){
                        if (!move_uploaded_file($_FILES['doctor_photo']['tmp_name'],$filepath)) {
                            throw new RuntimeException('Failed to move uploaded file.');
                        }
                    }

                    echo json_encode([
                        'status' => 200,
                        'response'	=> "success",
                        'response_message' => "Doctor successfully saved."
                    ]);
                } else {
                    echo json_encode([
                        'status' => 401,
                        'response'	=> "error",
                        'response_message' => "Unable to save doctor."
                    ]);
                }
            }
        }
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $docPhoto = $this->doctor->get_doctor_details($id);
        $delete  = $this->doctor->delete_doctor('doc_id = "' . $id . '"');
        if ($delete) {
            if (!empty($docPhoto->photo) && file_exists($docPhoto->photo)) {
                unlink($docPhoto->photo);
            }
            echo json_encode([
                'status' => 200,
                'response'	=> "success",
                'response_message' => "Doctor successfully deleted."
            ]);
        } else {
            echo json_encode([
                'status' => 401,
                'response'	=> "error",
                'response_message' => "Unable to delete doctor."
            ]);
        }
    }

}