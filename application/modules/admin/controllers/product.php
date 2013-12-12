<?php

class Product extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( 'm_product' );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data']['error'] = FALSE;
            $temp['title'] = "User";
            $temp['template'] = 'user/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_product ()
    {
        if ( $this->check_role )
        {
            $temp['title'] = "Product";
            $temp['template'] = 'product/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    protected function check ()
    {
        if ( $this->session->userdata ( "user_role" ) && $this->session->userdata ( "user_infor" ) )
        {
            $result = FALSE;
            foreach ( $this->session->userdata ( "user_role" ) as $roles )
            {
                if ( in_array ( 'admin', $roles ) OR in_array ( 'product', $roles ) )
                {
                    $result = TRUE;
                }
            }

            return $result;
        }
    }

}

?>
