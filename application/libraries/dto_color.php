<?php
class DTO_color {

    private $color_id;
    private $name;

    public function set_property ( $color_id, $name )
    {
        $this->color_id = $color_id;
        $this->name = $name;
    }

    public function getColor_id ()
    {
        return $this->color_id;
    }

    public function setColor_id ( $color_id )
    {
        $this->color_id = $color_id;
    }

    public function getName ()
    {
        return $this->name;
    }

    public function setName ( $name )
    {
        $this->name = $name;
    }

}
