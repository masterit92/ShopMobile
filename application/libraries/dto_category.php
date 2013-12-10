<?php
class DTO_category {

    private $cat_id;
    private $name;
    private $parent_id;
    private $status;

    function set_property ( $cat_id, $name, $parent_id, $status )
    {
        $this->cat_id = $cat_id;
        $this->name = $name;
        $this->parent_id = $parent_id;
        $this->status = $status;
    }

    public function getCat_id ()
    {
        return $this->cat_id;
    }

    public function setCat_id ( $cat_id )
    {
        $this->cat_id = $cat_id;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setName ( $name )
    {
        $this->name = $name;
    }

    public function getParent_id ()
    {
        return $this->parent_id;
    }

    public function setParent_id ( $parent_id )
    {
        $this->parent_id = $parent_id;
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

?>
