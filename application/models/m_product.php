<?php
class M_product extends My_database {

    private $table_name = "products";

    public function __construct ()
    {
        parent::__construct ();
    }

    protected function set_value_profile ( $row_pro )
    {
        $dto_pro = new DTO_product();
        $dto_pro->set_property ( $row_pro['Pro_id'], $row_pro['Name'], $row_pro['Price'], $row_pro['Description'], $row_pro['Quantity'], $row_pro['Status'], $row_pro['Thumb'] );
        return $dto_pro;
    }

    public function get_all_product ( $isStatus = FALSE )
    {
        try
        {
            $arr_where = array( );
            if ( $isStatus )
            {
                $arr_where['Status'] = 1;
            }
            $list_pro = $this->get_table ( $this->table_name, $arr_where );
            $arr_pro = array( );
            foreach ( $list_pro as $value )
            {
                $arr_pro[] = $this->set_value_profile ( $value );
            }
            return $arr_pro;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function get_product_by_id ( $pro_id, $isStatus = FALSE )
    {
        $pro_id = $this->anti_sql ( $pro_id );
        try
        {
            $arr_where = array( "Pro_id" => $pro_id );
            if ( $isStatus )
            {
                $arr_where['Status'] = 1;
            }
            $list_pro = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $list_pro as $value )
            {
                return $this->set_value_profile ( $value );
            }
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function update_status ( DTO_product $dto_pro, $pro_id )
    {
        try
        {
            $arr_condition = array( "Pro_id" => $pro_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $dto_pro, "status" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function delete_pro ( $pro_id )
    {
        $pro_id = $this->anti_sql ( $pro_id );
        try
        {
            $arr_condition = array( "Pro_id" => $pro_id );
            return $this->delete ( $this->table_name, $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function insert_pro ( DTO_product $pro )
    {
        try
        {
            return $this->insert ( $this->table_name, $this->set_arr_data ( $pro, "insert" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function update_pro ( DTO_product $pro, $pro_id )
    {
        try
        {
            $arr_condition = array( "Pro_id" => $pro_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $pro, "update" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    protected function set_arr_data ( DTO_product $pro, $action = 'update' )
    {
        $arr_data = array( );
        if ( $action === 'update' OR $action === "insert" )
        {
            $arr_data["Name"] = $this->anti_sql ( $pro->getName () );
            if ( $pro->getThumb () != NULL )
            {
                $arr_data["Thumb"] = $this->anti_sql ( $pro->getThumb () );
            }
            $arr_data["Price"] = $this->anti_sql ( $pro->getPrice () );
            $arr_data["Description"] = $this->anti_sql ( $pro->getDescription () );
            $arr_data["Quantity"] = $this->anti_sql ( $pro->getQuantity () );
            
        }
        else if ( $action === 'status' )
        {
            $arr_data["Status"] = $this->anti_sql ( $pro->getStatus () );
        }
        return $arr_data;
    }

}

?>
