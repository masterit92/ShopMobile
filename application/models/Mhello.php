<?php
class Mhello extends CI_Model{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function listall(){
        $this->db->select("titel,interpret");
        $this->db->where("titel","Beauty");
        $query=$this->db->get("cds");
        return $query->result_array();
    }
}