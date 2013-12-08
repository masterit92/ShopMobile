<?php

class Index extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
    }

    public function index()
    {
        $temp["view"]="admin/user/login";
        $this->load->view("index",$temp);
    }
}