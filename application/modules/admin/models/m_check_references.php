<?php
class M_check_references extends My_database {

    public function __construct ()
    {
        parent::__construct ();
    }

    public function check_references ($arr_table,$arr_table_column=NULL,$val_where= NULL)
    {
        $join= "JOIN";
        $sql_query= $this->join_table($arr_table, $arr_table_column, $join, $val_where);
        $query=$this->db->query($sql_query);
        return $query->result_array();
    }

}
