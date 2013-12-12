<?php
class DTO_image {

    private $img_id;
    private $pro_id;
    private $url;

    function set_property ( $img_id, $pro_id, $url )
    {
        $this->img_id = $img_id;
        $this->pro_id = $pro_id;
        $this->url = $url;
    }

    public function getImg_id ()
    {
        return $this->img_id;
    }

    public function setImg_id ( $img_id )
    {
        $this->img_id = $img_id;
    }

    public function getPro_id ()
    {
        return $this->pro_id;
    }

    public function setPro_id ( $pro_id )
    {
        $this->pro_id = $pro_id;
    }

    public function getUrl ()
    {
        return $this->url;
    }

    public function setUrl ( $url )
    {
        $this->url = $url;
    }

}
