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
        $col= array("e"=>array("E_ID"),"a"=>array("A_Name"),"v"=>array("V_ID","V_Value"));
       
        $arrTable= array("entity"=>"e","attribute"=>"a","value_varchar"=>"v");
        $val_where="v.V_ID=1";
        echo $this->join_table->Join_table($arrTable,$col,"INNER JOIN",$val_where);
        die();

        $this->load->view("index");
    }
}