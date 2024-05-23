<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctor_model extends CI_model {

    protected $table = 'tbl_doctors_info';
    protected $tableContact = 'tbl_doctor_contactno';

    public function __construct()
    {
        parent::__construct();
    }

    public function total_doctors() {
        return $this->db->count_all($this->table);
    }

    public function get_doctor()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function add_doctor($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_doctor($data, $where)
    {
        $this->db->update($this->table, $data, $where);
        return true;
    }

    public function add_contact($data)
    {
        $this->db->insert_batch($this->tableContact, $data);
        return true;
    }

    public function delete_doctor_contact($where)
    {
        $this->db->delete($this->tableContact, $where);
        return true;
    }

    public function delete_doctor($where)
    {
        $this->db->delete($this->table, $where);
        return true;
    }

    public function get_doctor_name($lname, $fname, $mname)
    {
        $this->db->select('*');
        $this->db->where('lastname', $lname);
        $this->db->where('firstname ', $fname);
        $this->db->where('middlename ', $mname);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_doctor_name_other($id, $lname, $fname, $mname)
    {
        $this->db->select('*');
        $this->db->where('doc_id !=', $id);
        $this->db->where('lastname', $lname);
        $this->db->where('firstname ', $fname);
        $this->db->where('middlename ', $mname);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_prc_no($prcno)
    {
        $this->db->select('*');
        $this->db->where('prc_license_no', $prcno);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_prc_no_other($id, $prcno)
    {
        $this->db->select('*');
        $this->db->where('doc_id !=', $id);
        $this->db->where('prc_license_no', $prcno);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_doctor_details($id)
    {
        $this->db->select('*');
        $this->db->where('doc_id', $id);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_contact_doctor($id)
    {
        $this->db->where('doctor_id', $id);
        $this->db->order_by('doc_contact_id', 'asc');
        $query = $this->db->get($this->tableContact);

        $first_contact = $query->row();

        $contacts = $query->result();
        array_shift($contacts);

        return array('first_contact' => $first_contact, 'remaining_contacts' => $contacts);
    }


    public function get_doctors_expiring_soon() {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prc_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)', NULL, FALSE);
        $query = $this->db->get();
        $data['doctors'] = $query->result();

         // Query to get the total count
         $this->db->select('COUNT(*) as total');
         $this->db->from($this->table);
         $this->db->where('prc_expiry_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)', NULL, FALSE);
         $query = $this->db->get();
         $data['total'] = $query->row()->total;

         return $data;
    }

    public function get_doctors_recently_expired() {
        // Query to get the list of doctors with recently expired licenses
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('prc_expiry_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND CURDATE()', NULL, FALSE);
        $query = $this->db->get();
        $data['doctors'] = $query->result();

        // Query to get the total count of doctors with recently expired licenses
        $this->db->select('COUNT(*) as total');
        $this->db->from($this->table);
        $this->db->where('prc_expiry_date BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 MONTH) AND CURDATE()', NULL, FALSE);
        $query = $this->db->get();
        $data['total'] = $query->row()->total;

        return $data;
    }
    
    




}