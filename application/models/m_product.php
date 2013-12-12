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

    protected function set_cat_pro ( $row )
    {
        $cat_pro = new DTO_cat_and_pro();
        $cat_pro->set_property ( $row['Pro_id'], $row['Cat_id'] );
        return $cat_pro;
    }

    protected function set_img ( $row )
    {
        $img = new DTO_image();
        $img->set_property ( $row['Img_id'], $row['Pro_id'], $row['Url'] );
        return $img;
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

    public function get_cat_by_pro_id ( $pro_id )
    {
        try
        {
            $arr_where = array( "Pro_id" => $pro_id );
            $list_cat_id = $this->get_table ( 'cat_and_pro', $arr_where );
            $arr_cat_id = array( );
            foreach ( $list_cat_id as $value )
            {
                $arr_cat_id[] = $this->set_cat_pro ( $value );
            }
            return $arr_cat_id;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function insert_cat_pro ( DTO_cat_and_pro $cat_pro )
    {
        try
        {
            return $this->insert ( 'cat_and_pro', $this->arr_data_pro_cat ( $cat_pro ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function delete_cat_pro ( $pro_id, $cat_id )
    {
        $pro_id = $this->anti_sql ( $pro_id );
        $cat_id = $this->anti_sql ( $cat_id );
        try
        {
            $arr_condition = array( "Pro_id" => $pro_id, "Cat_id" => $cat_id );
            return $this->delete ( 'cat_and_pro', $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function check_cat_pro ( $pro_id, $cat_id )
    {
        $pro_id = $this->anti_sql ( $pro_id );
        $cat_id = $this->anti_sql ( $cat_id );
        try
        {
            $arr_condition = array( "Pro_id" => $pro_id, "Cat_id" => $cat_id );
            foreach ( $this->get_table ( 'cat_and_pro', $arr_condition ) as $value )
            {
                return TRUE;
            }
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function get_img_by_pro_id ( $pro_id )
    {
        $pro_id = $this->anti_sql ( $pro_id );
        try
        {
            $arr_where = array( "Pro_id" => $pro_id );

            $list_img = $this->get_table ( 'images', $arr_where );
            $arr_img = array( );
            foreach ( $list_img as $value )
            {
                $arr_img[] = $this->set_img ( $value );
            }
            return $arr_img;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function delete_img ( $img_id )
    {
        $img_id = $this->anti_sql ( $img_id );
        try
        {
            $arr_where = array( "Img_id" => $img_id );
            return $this->delete ( "images", $arr_where );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function get_img_by_id ( $img_id )
    {
        $img_id = $this->anti_sql ( $img_id );
        try
        {
            $arr_where = array( "Img_id" => $img_id );

            $list_img = $this->get_table ( 'images', $arr_where );
            foreach ( $list_img as $value )
            {
                return $this->set_img ( $value );
            }
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
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

    protected function arr_data_pro_cat ( DTO_cat_and_pro $cat_pro )
    {
        $arr_data = array( );
        $arr_data['Pro_id'] = $this->anti_sql ( $cat_pro->getPro_id () );
        $arr_data['Cat_id'] = $this->anti_sql ( $cat_pro->getCat_id () );
        return $arr_data;
    }

    protected function arr_data_img ( DTO_image $img )
    {
        $arr_data = array( );
        $arr_data['Img_id'] = $this->anti_sql ( $img->getImg_id () );
        $arr_data['Pro_id'] = $this->anti_sql ( $img->getPro_id () );
        $arr_data['Url'] = $this->anti_sql ( $img->getUrl () );
        return $arr_data;
    }

}

?>
