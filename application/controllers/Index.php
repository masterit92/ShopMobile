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
        $this->load->library("join_table");
        $arrCl = array("column_name");
        $arrW = array("table_name" => "entity");
        $column = $this->join_table->Get_column_table("entity");
        foreach ($column as $c) {

            echo $c . "<br/>";

        }
        echo "<br/>===============================================<br/>";
        echo $this->join_table->Check_referent("type", "attribute");
        echo "<br/>================================================<br/>";
        $col= array("A"=>array("aaaa","aa"), "B"=>array("bb","bbb","bbbb"));
       
        $arrTable= array("An"=>"a","BB"=>"b","CC"=>"c","DD"=>"d");
        echo $this->join_table->Join_table($arrTable,$col);
        die();

        $this->load->view("index");
    }
}