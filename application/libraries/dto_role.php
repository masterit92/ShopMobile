<?php
class DTO_role {

    private $role_id;
    private $name;
    private $status;

    function set_property ( $role_id, $name, $status )
    {
        $this->role_id = $role_id;
        $this->name = $name;
        $this->status = $status;
    }

    public function getRole_id ()
    {
        return $this->role_id;
    }

    public function setRole_id ( $role_id )
    {
        $this->role_id = $role_id;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setName ( $name )
    {
        $this->name = $name;
    }

    public function getStatus ()
    {
        return $this->status;
    }

    public function setStatus ( $status )
    {
        $this->status = $status;
    }

}
