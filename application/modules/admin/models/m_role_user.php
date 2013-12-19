<?php
class M_role_user extends My_database {

    private $table_name = "role_and_user";

    public function __construct ()
    {
        parent::__construct ();
    }

    protected function set_value_profile ( $row_role_user )
    {
        $role_user = new DTO_role_and_user();
        $role_user->set_property ( $row_role_user['User_id'], $row_role_user['Role_id'] );
        return $role_user;
    }

    public function get_role_user_by_id ( $user_id )
    {
        try
        {
            $arr_table_column = array( 'r' => array( 'Name', 'Role_id' ), 'u' => array( 'User_id', 'Full_name' ) );
            $arr_table = array( "users" => "u", "role_and_user" => "r_a_u", "role" => "r" );
            $join = "INNER JOIN";
            $val_where = "u.User_id='$user_id' and u.Status=1 and r.Status=1";
            $query = $this->join_table ( $arr_table, $arr_table_column, $join, $val_where );
            $result = $this->db->query ( $query );
            return $result->result_array ();
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function insert_role_user ( DTO_role_and_user $role_user )
    {
        try
        {
            return $this->insert ( $this->table_name, $this->set_arr_data ( $role_user ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function delete_role_user ( $user_id, $role_id )
    {
        $role_id = $this->anti_sql ( $role_id );
        $user_id = $this->anti_sql ( $user_id );
        try
        {
            $arr_condition = array( "Role_id" => $role_id, "User_id" => $user_id );
            return $this->delete ( $this->table_name, $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function update_role_user ( DTO_role_and_user $role_user, $user_id )
    {
        try
        {
            $arr_condition = array( "User_id" => $user_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $role_user ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function check_role_user ( $user_id, $role_id )
    {
        try
        {
            $arr_where = array( "Role_id" => $role_id, "User_id" => $user_id );
            $result = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $result as $value )
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

    public function get_role_by_user ( $user_id )
    {
        try
        {
            $arr_role = array( );
            $arr_where = array( "User_id" => $user_id );
            $result = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $result as $value )
            {
                $arr_role[]=$this->set_value_profile($value);
            }
            return $arr_role;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    protected function set_arr_data ( DTO_role_and_user $role_user )
    {
        $arr_data = array(
            "User_id" => $role_user->getUser_id (),
            "Role_id" => $role_user->getRole_id ()
        );
        return $arr_data;
    }

}
