<?php

class M_users extends My_database {

    private $table_name = "users";

    public function __construct ()
    {
        parent::__construct ();
    }

    private function set_value_profile ( $row_user )
    {
        $user = new DTO_user();
        $user->set_property ( $row_user["User_id"], $row_user["Email"], $row_user["Password"], $row_user["Full_name"], $row_user["Status"] );
        return $user;
    }

    public function check_login ( $email, $password )
    {
        if ( !empty ( $email ) && !empty ( $password ) )
        {
            $email = $this->anti_sql ( $email );
            $password = $this->anti_sql ( $password );
            try
            {
                $arr_where = array( "Email" => $email, "Password" => $password, "Status" => "1" );
                $user = $this->get_table ( $this->table_name, $arr_where );
                foreach ( $user as $value )
                {
                    return $this->set_value_profile ( $value );
                }
            }
            catch ( Exception $ex )
            {
                throw $ex;
            }
        }
        return NULL;
    }

    public function get_all_user ()
    {
        try
        {
            $list_user = $this->get_table ( $this->table_name );
            $arr_user = array( );
            foreach ( $list_user as $value )
            {
                $arr_user[] = $this->set_value_profile ( $value );
            }
            return $arr_user;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function delete_user ( $user_id )
    {
        $user_id = $this->anti_sql ( $user_id );
        try
        {
            $arr_condition = array( "User_id" => $user_id );
            return $this->delete ( $this->table_name, $arr_condition );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function insert_user ( $arr_data )
    {
        try
        {
            return $this->insert ( $this->table_name, $arr_data );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function get_user_by_id ( $user_id )
    {
        $user_id = $this->anti_sql ( $user_id );
        try
        {
            $arr_where=array("User_id"=>$user_id);
            $list_user = $this->get_table ( $this->table_name, $arr_where );
            $arr_user = array( );
            foreach ( $list_user as $value )
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

    public function update_user ( $arr_data, $user_id )
    {
        try
        {
            $arr_condition = array( "User_id" => $user_id );
            return $this->update ( $this->table_name, $arr_condition, $arr_data );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function check_role ( $user_id )
    {
        try
        {
            $arr_table_column = array( 'r' => array( 'Name' ) );
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

}

?>
