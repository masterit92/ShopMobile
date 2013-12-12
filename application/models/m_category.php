<?php

class M_category extends My_database {

    private $table_name = "category";

    public function __construct ()
    {
        parent::__construct ();
    }

    protected function set_value_profile ( $row_cate )
    {
        $dto_cat = new DTO_category();
        $dto_cat->set_property ( $row_cate['Cat_id'], $row_cate['Name'], $row_cate['Parent_id'], $row_cate['Status'] );
        return $dto_cat;
    }

    public function get_all_category ( $isStatus = FALSE )
    {
        try
        {
            $arr_where = array( );
            if ( $isStatus )
            {
                $arr_where['Status'] = 1;
            }
            $list_cate = $this->get_table ( $this->table_name, $arr_where );
            $arr_cate = array( );
            foreach ( $list_cate as $value )
            {
                $arr_cate[] = $this->set_value_profile ( $value );
            }
            return $arr_cate;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function get_cat_by_parent_id ( $parent_id, $isStatus = FALSE )
    {
        $parent_id = $this->anti_sql ( $parent_id );
        try
        {
            $arr_where = array( "Parent_id" => $parent_id );
            if ( $isStatus )
            {
                $arr_where['Status'] = 1;
            }
            $list_cate = $this->get_table ( $this->table_name, $arr_where );
            $arr_cate = array( );
            foreach ( $list_cate as $value )
            {
                $arr_cate[] = $this->set_value_profile ( $value );
            }
            return $arr_cate;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function get_cat_by_id ( $cat_id, $isStatus = FALSE )
    {
        $parent_id = $this->anti_sql ( $parent_id );
        try
        {
            $arr_where = array( "Cat_id" => $cat_id );
            if ( $isStatus )
            {
                $arr_where['Status'] = 1;
            }
            $list_cate = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $list_cate as $value )
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

    public function update_status ( DTO_category $dto_cat, $cat_id )
    {
        try
        {
            $arr_condition = array( "Cat_id" => $cat_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $dto_cat, "status" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function delete_cat ( $cat_id )
    {
        $cat_id = $this->anti_sql ( $cat_id );
        try
        {
            $arr_condition = array( "Cat_id" => $cat_id );
            return $this->delete ( $this->table_name, $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function insert_cat ( DTO_category $cat )
    {
        try
        {
            return $this->insert ( $this->table_name, $this->set_arr_data ( $cat, "insert" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function update_cat ( DTO_category $cat, $cat_id )
    {
        try
        {
            $arr_condition = array( "Cat_id" => $cat_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $cat, "update" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    protected function set_arr_data ( DTO_category $cat, $action = 'update' )
    {
        $arr_data = array( );
        if ( $action === 'update' OR $action === "insert" )
        {
            $arr_data["Name"] = $this->anti_sql ( $cat->getName () );
            $arr_data["Parent_id"] = $this->anti_sql ( $cat->getParent_id () );
        }
        else if ( $action === 'status' )
        {
            $arr_data["Status"] = $this->anti_sql ( $cat->getStatus () );
        }
        return $arr_data;
    }

}

?>
