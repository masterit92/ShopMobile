<?php
class DTO_product {

    private $pro_id;
    private $name;
    private $price;
    private $description;
    private $quantity;
    private $status;
    private $thumb;

    public function getThumb ()
    {
        return $this->thumb;
    }

    public function setThumb ( $thumb )
    {
        $this->thumb = $thumb;
    }

    function set_property ( $pro_id, $name, $price, $description, $quantity, $status ,$thumb)
    {
        $this->pro_id = $pro_id;
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->status = $status;
        $this->thumb=$thumb;
    }

    public function getPro_id ()
    {
        return $this->pro_id;
    }

    public function setPro_id ( $pro_id )
    {
        $this->pro_id = $pro_id;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setName ( $name )
    {
        $this->name = $name;
    }

    public function getPrice ()
    {
        return $this->price;
    }

    public function setPrice ( $price )
    {
        $this->price = $price;
    }

    public function getDescription ()
    {
        return $this->description;
    }

    public function setDescription ( $description )
    {
        $this->description = $description;
    }

    public function getQuantity ()
    {
        return $this->quantity;
    }

    public function setQuantity ( $quantity )
    {
        $this->quantity = $quantity;
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

