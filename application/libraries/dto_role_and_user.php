<?php
class DTO_role_and_user {

    private $user_id;
    private $role_id;

    function set_property ( $user_id, $role_id )
    {
        $this->user_id = $user_id;
        $this->role_id = $role_id;
    }

    public function getUser_id ()
    {
        return $this->user_id;
    }

    public function setUser_id ( $user_id )
    {
        $this->user_id = $user_id;
    }

    public function getRole_id ()
    {
        return $this->role_id;
    }

    public function setRole_id ( $role_id )
    {
        $this->role_id = $role_id;
    }

}

?>
