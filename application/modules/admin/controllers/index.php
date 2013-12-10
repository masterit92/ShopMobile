<?php
class Index extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->helper("url");
        $this->load->Model ( "m_users" );
        //$this->load->Model ( "dto_user" );
       // $this->load->helper ( 'cookie' );
    }

    public function index ()
    {
        $flag = FALSE;
//        if ($this->input->cookie('ck_email', TRUE) && $this->input->cookie('ck_password', TRUE)) {
//            //var_dump($this->input->cookie('ck_email', TRUE));
//            $dto_user = new DTO_user();
//            $dto_user = $this->m_users->Check_Login($this->input->cookie('ck_email', TRUE), $this->input->cookie('ck_password', TRUE));
//            $this->session->set_userdata('user_infor', $dto_user);
//            $flag = TRUE;
//        }
        if ( $this->session->userdata ( "user_infor" ) )
        {
           // var_dump($this->session->userdata ( "user_infor" ));die();
            $flag = TRUE;
        }
        if ( isset ( $_POST['tbnLogin'] ) )
        {
            $email = $_POST['username'];
            $pass = $_POST['password'];
            $dto_user = new DTO_user();
            $dto_user = $this->m_users->check_login ( $email, $pass );
            if ( $dto_user != NULL )
            {
                $this->session->set_userdata ( 'user_infor', $dto_user );
//                if ( isset ( $_POST['loginkeeping'] ) )
//                {
//                    $this->input->set_cookie ( 'ck_email', $email, (2 * 24 * 3600 ), '', '/', '', TRUE );
//                    $this->input->set_cookie ( 'ck_password', $pass, (2 * 24 * 3600 ), '', '/', '', TRUE );
//                }
                $arr_role = $this->m_users->check_role ( $dto_user->getUser_id () );
                $this->session->set_userdata ( 'user_role', $arr_role );
                $flag = TRUE;
            }
            else
            {
               $this->session->set_flashdata ( 'login_error', 'Username or password is not correct!' );
            }
        }
        if ( !$flag )
        {
            $this->load->view ( "index/index" );
        }
        else
        {
            $temp['title'] = "Home";
            $temp['template'] = 'index/home';
            $this->load->view ( "backend/layout", $temp );
           // $this->load->view ( "index/home" );
          //  var_dump($this->session->userdata ( "user_infor" ));die();
           // redirect ( "admin/home" );
        }
    }

    public function logout ()
    {
        $this->session->sess_destroy ();
        $this->session->unset_userdata ( 'user_infor' );
        //delete_cookie('ck_email'); 
        //delete_cookie('ck_password'); 
        //setcookie('ck_email', time() - 9600);
        //setcookie('ck_password', time() - 9600);
        //$this->load->view("user/index");
        redirect ( "admin/index" );
    }
    
    public function home ()
    {
        $temp['title'] = "Home";
        $temp['template'] = 'index/home';
        $this->load->view ( "backend/layout", $temp );
    }

    protected function check ()
    {
        if ( $this->session->userdata ( "user_role" ) && $this->session->userdata ( "user_infor" ) )
        {
            foreach ( $this->session->userdata ( "user_role" ) as $roles )
            {
                if ( in_array ( 'admin', $roles ) OR in_array ( $this->uri->segment ( 1 ), $roles ) )
                {
                    return TRUE;
                }
                else
                {
                    return FALSE;
                }
            }
        }
        else
        {
            redirect ( "admin/index" );
        }
    }

}
?>