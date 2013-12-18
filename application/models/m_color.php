<?php
class M_color extends My_database {

    protected $table_name = "color";

    public function __construct ()
    {
        parent::__construct ();
    }

    protected function set_value_profile ( $row_color )
    {
        $dto_color = new DTO_color();
        $dto_color->set_property ( $row_color["Color_id"], $row_color["Name"] );
        return $dto_color;
    }

    public function get_color_by_id ( $color_id )
    {
        try
        {
            $arr_where = array( "Color_id" => $color_id );
            $list_color = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $list_color as $value )
            {
                return $this->set_value_profile ( $value );
            }
        }
        catch ( Exception $exc )
        {
            throw $exc;
        }

        return NULL;
    }

    public function get_all_color ()
    {
        try
        {
            $list_color = $this->get_table ( $this->table_name );
            $arr_color = array( );
            foreach ( $list_color as $value )
            {
                $arr_color[] = $this->set_value_profile ( $value );
            }
            return $arr_color;
        }
        catch ( Exception $exc )
        {
            throw $exc;
        }

        return NULL;
    }

    public function delete_color ( $color_id )
    {
        $color_id = $this->anti_sql ( $color_id );
        try
        {
            $arr_condition = array( "Color_id" => $color_id );
            return $this->delete ( $this->table_name, $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function update_color ( DTO_color $dto_color, $color_id )
    {
        try
        {
            $arr_condition = array( "Color_id" => $color_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $dto_color ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function insert_color ( DTO_color $dto_color )
    {
        try
        {
            return $this->insert ( $this->table_name, $this->set_arr_data ( $dto_color ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    protected function set_arr_data ( DTO_color $color )
    {
        $arr_data = array( );
        if ( $color->getName () != NULL )
        {
            $arr_data["Name"] = $this->anti_sql ( $color->getName () );
        }
        return $arr_data;
    }

}
