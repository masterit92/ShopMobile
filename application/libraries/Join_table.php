<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('CI_Model')) {
    require_once(BASEPATH . 'core/Model.php');
}

class Join_table extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function Get_table($table_name, $arr_get_column = NULL, $arr_where = NULL) {
        try {
            $result = NULL;
            if (count($arr_get_column) > 0) {
                $column = implode(",", $arr_get_column);
                $this->db->select($column);
            }
            if (count($arr_where) > 0) {
                foreach ($arr_where as $_column => $_value) {
                    $this->db->where($_column, $_value);
                }
            }
            $query = $this->db->get($table_name);
            $result = $query->result_array();
            return $result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Get_column_table($table_name) {
        try {
            $_table_name = "information_schema.columns";
            $_arr_column = array("column_name");
            $_arr_where = array("table_name" => $table_name);
            $_arr = $this->Get_table($_table_name, $_arr_column, $_arr_where);
            foreach ($_arr as $columns) {
                foreach ($columns as $col) {
                    $arr_columns[] = $col;
                }
            }
            return $arr_columns;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function Check_referent($table1, $table2) {
        try {
            $arr_column1 = $this->Get_column_table($table1);
            $arr_column2 = $this->Get_column_table($table2);
            foreach ($arr_column1 as $column1) {
                if (in_array($column1, $arr_column2)) {
                    return $column1;
                }
            }
            return NULL;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

//SELECT * FROM `entity` AS e
//JOIN `attribute` AS a
//ON e.`EID`=a.`EID`
//JOIN `value_varchar` AS v
//ON a.`AID`=v.`AID`
    // $arr_table("as"=>array(column))
    // $arr_table_column("tableName"=>"as")
    // $join= "Join" or "Left Join"....
    // $val_where="condition:as.columnName"
    public function Join_table($arr_table, $arr_table_column, $join = "JOIN", $val_where = NULL) {
        $query = "SELECT ";
        if (count($arr_table_column) > 0) {
            foreach ($arr_table_column as $_table => $_column) {
                foreach ($_column as $_col) {
                    $query.= $_table . "." . $_col . ",";
                }
            }
            $query = rtrim($query, ",");
        } else {
            $query.= "*";
        }
        $query.=" FROM ";
        if (count($arr_table) > 0) {
            $i = 0;
            $arr_table_as = array();
            $table1 = NULL;
            $table2 = NULL;
            $arr_reference = array();
            foreach ($arr_table as $table => $as) {
                $arr_table_as[] = $as;
                if ($i % 2 === 0) {
                    $table1 = $table;
                } else {
                    $table2 = $table;
                }
                if ($table2 != NULL) {
                    $arr_reference[] = $this->Check_referent($table1, $table2);
                }
                if ($i > 0) {
                    $query.=" " . $join . " ";
                }
                $query.= $table . " AS " . $as;
                if ($i > 0) {
                    $query.=" ON ";
                    if (count($arr_table_as) >= 2) {
                        $query.= $arr_table_as[$i - 1] . "." . $arr_reference[$i - 1];
                        $query.=" = ";
                        $query.= $arr_table_as[$i] . "." . $arr_reference[$i - 1];
                    }
                }
                $i++;
            }
            if ($val_where != NULL) {
                    $query.=" WHERE ".$val_where." ";
            }
        } else {
            $query = NULL;
        }
        return $query;
    }

}

?>