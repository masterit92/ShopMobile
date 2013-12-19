<?php
class M_role extends My_database {

    private $table_name = "role";

    public function __construct ()
    {
        parent::__construct ();
    }

    protected function set_value_profile ( $row_role )
    {
        $role = new DTO_role();
        $role->set_property ( $row_role['Role_id'], $row_role["Name"], $row_role["Status"] );
        return $role;
    }

    public function get_all_role ()
    {
        try
        {
            $list_role = $this->get_table ( $this->table_name );
            $arr_role = array( );
            foreach ( $list_role as $value )
            {
                $arr_role[] = $this->set_value_profile ( $value );
            }
            return $arr_role;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function get_role_by_id ( $role_id )
    {
        $role_id = $this->anti_sql ( $role_id );
        try
        {
            $arr_where = array( "Role_id" => $role_id );
            $list_role = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $list_role as $value )
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

    public function insert_role ( DTO_role $role )
    {
        try
        {
            return $this->insert ( $this->table_name, $this->set_arr_data ( $role ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function delete_role ( $role_id )
    {
        $role_id = $this->anti_sql ( $role_id );
        try
        {
            $arr_condition = array( "Role_id" => $role_id );
            return $this->delete ( $this->table_name, $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function update_role ( DTO_role $role, $role_id )
    {
        try
        {
            $arr_condition = array( "Role_id" => $role_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $role ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    protected function set_arr_data ( DTO_role $role )
    {
        $arr_data = array(
            "Name" => $this->anti_sql ( $role->getName () ),
            "Status" => $this->anti_sql ( $role->getStatus () )
        );
        return $arr_data;
    }

}
