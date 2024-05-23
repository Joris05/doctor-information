<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {

    protected $table = 'tbl_users';

    public function __construct()
    {
        parent::__construct();
    }

    public function total_users() {
        return $this->db->count_all($this->table);
    }

    public function check_user($username, $password)
    {
        $this->db->select('*');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function add_user($data)
    {
        $this->db->insert($this->table, $data);
        return true;
    }

    public function get_user_name($name)
    {
        $this->db->select('*');
        $this->db->where('complete_name', $name);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_username($name)
    {
        $this->db->select('*');
        $this->db->where('username', $name);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_users()
    {
        $query = $this->db->get($this->table);

        return $query->result();
    }

    public function get_user_details($id)
    {
        $this->db->select('*');
        $this->db->where('user_id', $id);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function update_user($data, $where)
    {
        $this->db->update($this->table, $data, $where);
        return true;
    }

    public function get_user_name_other($id, $name)
    {
        $this->db->select('*');
        $this->db->where('user_id !=', $id);
        $this->db->where('complete_name', $name);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function get_username_other($id, $name)
    {
        $this->db->select('*');
        $this->db->where('user_id !=', $id);
        $this->db->where('username', $name);
        $q = $this->db->get($this->table);
        return $q->row();
    }

    public function delete_user($where)
    {
        $this->db->delete($this->table, $where);
        return true;
    }
    

}