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
        $this->load->library("jointable");
        $arrCl = array("column_name");
        $arrW = array("table_name" => "entity");
        $column = $this->jointable->getColumnTable("entity");
        foreach ($column as $c) {

            echo $c . "<br/>";

        }
        echo "<br/>===============================================<br/>";
        echo $this->jointable->checkReferent("type", "attribute");
        echo "<br/>================================================<br/>";
        $col= array("A"=>array("aaaa","aa"));
        foreach($col as $a =>$v){
            echo $a;
           // foreach($a as $v){
             //   echo $a ."==>".$v;
           // }
        }
        $arrTable= array("An"=>"A");
        echo $this->jointable->joinTable($arrTable,$col);
        die();

        $this->load->view("index");
    }
}