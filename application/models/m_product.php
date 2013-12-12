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
        $dto_pro->set_property ( $row_pro['Pro_id'], $row_pro['Name'], $row_pro['Price'], $row_pro['Description'], $row_pro['Quantity'], $row_pro['Status'] );
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
    public function get_product_by_id($pro_id){
        
    }

}

?>
