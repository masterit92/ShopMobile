<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!class_exists('CI_Model')) {
    require_once(BASEPATH . 'core/Model.php');
}

class JoinTable extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTable($tableName, $arrGetColumn = NULL, $arrWhere = NULL) {
        $result = NULL;
        if (count($arrGetColumn) > 0) {
            $column = implode(",", $arrGetColumn);
            $this->db->select($column);
        }
        if (count($arrWhere) > 0) {
            foreach ($arrWhere as $_column => $_value) {
                $this->db->where($_column, $_value);
            }
        }
        $query = $this->db->get($tableName);
        $result = $query->result_array();
        return $result;
    }

    //SELECT column_name FROM information_schema.columns
    //WHERE table_name = 'entity'
    public function getColumnTable($tableName) {
        $_tableName = "information_schema.columns";
        $_arrColumn = array("column_name");
        $_arrWhere = array("table_name" => $tableName);
        $_arr = $this->getTable($_tableName, $_arrColumn, $_arrWhere);
        foreach ($_arr as $columns) {
            foreach ($columns as $col) {
                $arrColumns[] = $col;
            }
        }
        return $arrColumns;
    }

    public function checkReferent($table1, $table2) {
        $arrColumn1 = $this->getColumnTable($table1);
        $arrColumn2 = $this->getColumnTable($table2);
        foreach ($arrColumn1 as $column1) {
            if (in_array($column1, $arrColumn2)) {
                return $column1;
            }
        }
        return NULL;
    }

    //
//SELECT * FROM `entity` AS e
//JOIN `attribute` AS a
//ON e.`EID`=a.`EID`
//JOIN `value_varchar` AS v
//ON a.`AID`=v.`AID`

    public function joinTable($arrTable, $arrTableColumn, $arrWhere = NULL) {
        $query = "SELECT ";
        if (count($arrTableColumn) > 0) {
            foreach ($arrTableColumn as $_table => $_column) {
                foreach ($_column as $_col) {
                    $query.= $_table . "." . $_col . ",";
                }
            }
            $query= rtrim($query, ",");
        } else {
            $query.= "*";
        }

        return $query;
    }

}

?>