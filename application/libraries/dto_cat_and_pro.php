<?php
class DTO_cat_and_pro {

    private $pro_id;
    private $cat_id;

    function set_property ( $pro_id, $cat_id )
    {
        $this->pro_id = $pro_id;
        $this->cat_id = $cat_id;
    }

    public function getPro_id ()
    {
        return $this->pro_id;
    }

    public function setPro_id ( $pro_id )
    {
        $this->pro_id = $pro_id;
    }

    public function getCat_id ()
    {
        return $this->cat_id;
    }

    public function setCat_id ( $cat_id )
    {
        $this->cat_id = $cat_id;
    }

}
