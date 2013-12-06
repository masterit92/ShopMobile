<?php
class Hello extends CI_Controller
{
    public function __construct(){
        parent::__construct();
       $this->load->helper("url");
    }
    public function index(){
        //$this->load->Model("Mhello");
        $temp['title']="QHOnline Layout";
        $temp['template']='hello_view';
       $temp['data']['acc']="sss";
        $this->load->view("hello_view");
    }
}