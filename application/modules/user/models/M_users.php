<?php

class M_users extends My_database {

    function __construct() {
        parent::__construct();
    }

    private function Set_value_profile($row_user) {
        $user = NULL;
        foreach ($row_user as $value) {
            $user=new DTO_user();
            $user->setProperty($value["User_id"], $value["Email"], $value["Password"], $value["Full_name"], $value["Status"]);
        }
        return $user;
    }

    public function Check_Login($email, $password) {
        if (!empty($email) && !empty($password)) {
            $email = $this->Anti_sql($email);
            $password = $this->Anti_sql($password);
            try {
                $arr_where = array("Email" => $email, "Password" => $password);
                $user = $this->Get_table("users", $arr_where);
                return $this->Set_value_profile($user);
            } catch (Exception $ex) {
                throw $ex;
            }
        }
        return NULL;
    }

}

?>
