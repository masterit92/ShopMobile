<?php
class User extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->helper("url");
        $this->load->Model ( "m_users" );
        $this->load->helper ( 'cookie' );
    }

    public function list_user ()
    {
        if ( $this->check () )
        {
            $temp['data'] = $this->m_users->get_all_user ();
        }
        else
        {
            $temp['data'] = "Không có quyền!";
        }
        $temp['title'] = "User";
        $temp['template'] = 'user/list_user';
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
