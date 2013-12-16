<?php

class Index extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( "m_product" );
    }

    public function index ()
    {
        $temp['data']['list_pro'] = $this->m_product->get_limit_product ( 10, 0 );
        $temp['title'] = "Home";
        $temp['template'] = 'home/index';
        $this->load->view ( "fontend/layout", $temp );
    }

    public function product ()
    {
        $temp['data']['list_pro'] = $this->m_product->get_all_product ( TRUE );
        $temp['title'] = "Home";
        $temp['template'] = 'home/product';
        $this->load->view ( "fontend/layout", $temp );
    }

    public function detail ()
    {
        if ( isset ( $_GET['pro_id'] ) )
        {
           $temp['data']['pro'] = $this->m_product->get_product_by_id ( $_GET['pro_id'],TRUE );
            $temp['title'] = "Home";
            $temp['template'] = 'home/detail';
            $this->load->view ( "fontend/layout", $temp );
        }
      //  redirect ( 'default' );
    }

}

?>
