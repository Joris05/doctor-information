<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_model extends CI_Model {

    protected $table;

    public function __construct() {
        parent::__construct();
    }

    public function insert($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update($data, $condition) {
        $this->db->where($condition);
        return $this->db->update($this->table, $data);
    }

    public function delete($condition) {
        $this->db->where($condition);
        return $this->db->delete($this->table);
    }

    public function get($condition = null, $limit = null, $offset = null, $order_by = null, $select = '*') {
        if ($condition) {
            $this->db->where($condition);
        }

        if ($limit) {
            $this->db->limit($limit, $offset);
        }

        if ($order_by) {
            $this->db->order_by($order_by);
        }

        $this->db->select($select);
        return $this->db->get($this->table)->result();
    }

    public function get_row($condition = null, $select = '*') {
        if ($condition) {
            $this->db->where($condition);
        }

        $this->db->select($select);
        return $this->db->get($this->table)->row();
    }

    public function join($table, $on, $type = 'inner') {
        $this->db->join($table, $on, $type);
        return $this;
    }

    public function select($select) {
        $this->db->select($select);
        return $this;
    }

    public function order_by($order_by) {
        $this->db->order_by($order_by);
        return $this;
    }

    public function limit($limit, $offset = 0) {
        $this->db->limit($limit, $offset);
        return $this;
    }
}
