<?php
class M_users extends My_database {

    function __construct()
    {
        parent::__construct();
    }

    private function set_value_profile($row_user)
    {
        $user = NULL;
        foreach ($row_user as $value)
        {
            $user = new DTO_user();
            $user->set_property($value["User_id"], $value["Email"], $value["Password"], $value["Full_name"], $value["Status"]);
        }
        return $user;
    }

    public function check_Login($email, $password)
    {
        if (!empty($email) && !empty($password))
        {
            $email = $this->anti_sql($email);
            $password = $this->anti_sql($password);
            try
            {
                $arr_where = array("Email" => $email, "Password" => $password, "Status" => "1");
                $user = $this->get_table("users", $arr_where);
                return $this->set_value_profile($user);
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }
        return NULL;
    }

    public function get_all_user()
    {
        try
        {
            $list_user = $this->get_table("users");
            $arr_user = array();
            foreach ($list_user as $value)
            {
                $arr_user[] = $this->set_value_profile($value);
            }
            return $arr_user;
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
        return NULL;
    }

    public function check_role($user_id)
    {
        $arr_table = array('u' => array('User_id', 'Status'), 'r' => array('Role_id', 'Parent_id'));
       // $query = $this->join_table($arr_table, $arr_table_column, $join, $val_where);
    }

}
?>
