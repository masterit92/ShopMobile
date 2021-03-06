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

    public function insert_user ( DTO_user $user )
    {
        if ( !$this->check_email ( $user->getEmail () ) )
        {
            try
            {
                return $this->insert ( $this->table_name, $this->set_arr_data ( $user, "insert" ) );
            }
            catch ( Exception $ex )
            {
                throw $ex;
            }
        }
        return FALSE;
    }

    public function get_user_by_id ( $user_id )
    {
        $user_id = $this->anti_sql ( $user_id );
        try
        {
            $arr_where = array( "User_id" => $user_id );
            $list_user = $this->get_table ( $this->table_name, $arr_where );
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

    public function update_user ( DTO_user $user, $user_id )
    {
        try
        {
            $arr_condition = array( "User_id" => $user_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $user, "profile" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function update_status ( DTO_user $user, $user_id )
    {
        try
        {
            $arr_condition = array( "User_id" => $user_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $user, "status" ) );
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return FALSE;
    }

    public function changer_pass ( DTO_user $user, $user_id )
    {
        try
        {
            $arr_condition = array( "User_id" => $user_id );
            return $this->update ( $this->table_name, $arr_condition, $this->set_arr_data ( $user, "password" ) );
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

    public function check_email ( $email )
    {
        $email = $this->anti_sql ( $email );
        try
        {
            $arr_where = array( "Email" => $email );
            $list_user = $this->get_table ( $this->table_name, $arr_where );
            foreach ( $list_user as $value )
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

    //$active='profile' or password or status
    protected function set_arr_data ( DTO_user $user, $action = 'profile' )
    {
        $arr_data = array( );
        if ( $action === 'profile' OR $action === "insert" )
        {
            if ( $user->getFull_name () != NULL )
            {
                $arr_data["Full_name"] = $this->anti_sql ( $user->getFull_name () );
            }
            else
            {
                throw new Exception ( 'Error!', NULL, NULL );
            }
        }
        if ( $action === 'password' OR $action === "insert" )
        {
            if ( $user->getFull_name () != NULL )
            {
                $arr_data["Password"] = $this->anti_sql ( $user->getPassword () );
            }
            else
            {
                throw new Exception ( 'Error!', NULL, NULL );
            }
        }
        if ( $action === 'status' )
        {
            $arr_data["Status"] = $this->anti_sql ( $user->getStatus () );
        }
        if ( $action === "insert" )
        {
            if ( $user->getFull_name () != NULL )
            {
                $arr_data["Email"] = $this->anti_sql ( $user->getEmail () );
            }
            else
            {
                throw new Exception ( 'Error!', NULL, NULL );
            }
        }
        return $arr_data;
    }

}
