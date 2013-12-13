<?php
class Index extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
    }

    public function index ()
    {
        $temp['title'] = "Home";
        $temp['template'] = 'home/index';
        $this->load->view ( "fontend/layout", $temp );
    }

}

?>
