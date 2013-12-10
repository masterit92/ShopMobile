<?php
if ( !defined ( 'BASEPATH' ) )
    exit ( 'No direct script access allowed' );

if ( !class_exists ( 'CI_Model' ) )
{
    require_once(BASEPATH . 'core/Model.php');
}
class My_database extends CI_Model {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->database ();
    }

    //$arr_condition=array('column'=>'value')
    public function delete ( $table_name, $arr_condition )
    {
        try
        {
            foreach ( $arr_condition as $key => $value )
            {
                $this->db->where ( "$key", "$value" );
            }
            $this->db->delete ( $table_name );
            return TRUE;
        }
        catch ( Exception $ex )
        {
            throw $ex;
            return FALSE;
        }
        return FALSE;
    }

    public function update ( $table_name, $arr_condition,$arr_data )
    {
        try
        {
            foreach ( $arr_condition as $key => $value )
            {
                $this->db->where ( "$key", "$value" );
            }
            $this->db->update ( $table_name, $arr_data );
            return TRUE;
        }
        catch ( Exception $ex )
        {
            throw $ex;
            return FALSE;
        }
        return FALSE;
    }

    public function insert ( $table_name, $arr_data )
    {
        try
        {
            $this->db->insert ( $table_name, $arr_data );
            return TRUE;
        }
        catch ( Exception $ex )
        {
            throw $ex;
            return FALSE;
        }
        return FALSE;
    }

    public function get_table ( $table_name, $arr_where = NULL, $arr_get_column = NULL )
    {
        try
        {
            $result = NULL;
            if ( count ( $arr_get_column ) > 0 )
            {
                $column = implode ( ",", $arr_get_column );
                $this->db->select ( $column );
            }
            if ( count ( $arr_where ) > 0 )
            {
                foreach ( $arr_where as $_column => $_value )
                {
                    $this->db->where ( $_column, $_value );
                }
            }
            $query = $this->db->get ( $table_name );
            $result = $query->result_array ();
            return $result;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
    }

    protected function get_column_table ( $table_name )
    {
        try
        {
            $_table_name = "information_schema.columns";
            $_arr_column = array( "column_name" );
            $_arr_where = array( "table_name" => $table_name );
            $_arr = $this->get_table ( $_table_name, $_arr_where, $_arr_column );
            foreach ( $_arr as $columns )
            {
                foreach ( $columns as $col )
                {
                    $arr_columns[] = $col;
                }
            }
            return $arr_columns;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
    }

    public function check_referent ( $table1, $table2 )
    {
        try
        {
            $arr_column1 = $this->get_column_table ( $table1 );
            $arr_column2 = $this->get_column_table ( $table2 );
            foreach ( $arr_column1 as $column1 )
            {
                if ( in_array ( $column1, $arr_column2 ) )
                {
                    return $column1;
                }
            }
            return NULL;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
    }

    // $arr_table_column("as"=>array(column))
    // $arr_table("tableName"=>"as")
    // $join= "Join" or "Left Join"....
    // $val_where="condition:as.columnName"
    public function join_table ( $arr_table, $arr_table_column, $join = "JOIN", $val_where = NULL )
    {
        $query = "SELECT ";
        if ( count ( $arr_table_column ) > 0 )
        {
            foreach ( $arr_table_column as $_table => $_column )
            {
                foreach ( $_column as $_col )
                {
                    $query.= $_table . "." . $_col . ",";
                }
            }
            $query = rtrim ( $query, "," );
        }
        else
        {
            $query.= "*";
        }
        $query.=" FROM ";
        if ( count ( $arr_table ) > 0 )
        {
            $i = 0;
            $arr_table_as = array( );
            $table1 = NULL;
            $table2 = NULL;
            $arr_reference = array( );
            foreach ( $arr_table as $table => $as )
            {
                $arr_table_as[] = $as;
                if ( $i % 2 === 0 )
                {
                    $table1 = $table;
                }
                else
                {
                    $table2 = $table;
                }
                if ( $table2 != NULL )
                {
                    $arr_reference[] = $this->check_referent ( $table1, $table2 );
                }
                if ( $i > 0 )
                {
                    $query.=" " . $join . " ";
                }
                $query.= $table . " AS " . $as;
                if ( $i > 0 )
                {
                    $query.=" ON ";
                    if ( count ( $arr_table_as ) >= 2 )
                    {
                        $query.= $arr_table_as[$i - 1] . "." . $arr_reference[$i - 1];
                        $query.=" = ";
                        $query.= $arr_table_as[$i] . "." . $arr_reference[$i - 1];
                    }
                }
                $i++;
            }
            if ( $val_where != NULL )
            {
                $query.=" WHERE " . $val_where . " ";
            }
        }
        else
        {
            $query = NULL;
        }
        return $query;
    }

    public function anti_sql ( $value )
    {
        $value = strtolower ( $value );
        $arr_key = array( '--', 'jav&#x0A;ascript:', 'jav&#x0D;ascript:', 'jav&#x09;ascript:', '<!-', '<', '>',
            '%3C', '&lt', '&lt;', '&LT', '&LT;', '&#60', '&#060', '&#0060', '&#00060', '&#000060',
            '&#0000060', '&#60;', '&#060;', '&#0060;', '&#00060;', '&#000060;', '&#0000060;', '&#x3c',
            '&#x03c', '&#x003c', '&#x0003c', '&#x00003c', '&#x000003c', '&#x3c;', '&#x03c;', '&#x003c;',
            '&#x0003c;', '&#x00003c;', '&#x000003c;', '&#X3c', '&#X03c', '&#X003c', '&#X0003c', '&#X00003c',
            '&#X000003c', '&#X3c;', '&#X03c;', '&#X003c;', '&#X0003c;', '&#X00003c;', '&#X000003c;',
            '&#x3C', '&#x03C', '&#x003C', '&#x0003C', '&#x00003C', '&#x000003C', '&#x3C;', '&#x03C;',
            '&#x003C;', '&#x0003C;', '&#x00003C;', '&#x000003C;', '&#X3C', '&#X03C', '&#X003C', '&#X0003C',
            '&#X00003C', '&#X000003C', '&#X3C;', '&#X03C;', '&#X003C;', '&#X0003C;', '&#X00003C;',
            '&#X000003C;', '\x3c', '\x3C', '\u003c', '\u003C', chr ( 60 ), chr ( 62 ) );
        ;
        $value = str_replace ( $arr_key, "", $value );
        return htmlspecialchars ( trim ( strip_tags ( addslashes ( mysql_real_escape_string ( $value ) ) ) ) );
    }

}