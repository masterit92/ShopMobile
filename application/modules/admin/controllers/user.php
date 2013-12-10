<?php

class User extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->helper ( "url" );
        $this->load->Model ( "m_users" );
        // $this->load->helper ( 'cookie' );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data'] = "Không có quyền!";
            $temp['title'] = "User";
            $temp['template'] = 'user/list_user';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_user ()
    {
        if ( $this->check_role )
        {
            $temp['data'] = $this->m_users->get_all_user ();
            $temp['title'] = "User";
            $temp['template'] = 'user/list_user';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function delete ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            if ( $this->m_users->delete_user ( $id ) )
            {
                $this->session->set_flashdata ( 'result', 'Delete Sucess!' );
            }
            else
            {
                $this->session->set_flashdata ( 'result', 'Delete Fail!' );
            }
            redirect ( 'admin/user/list_user' );
        }
    }

    public function edit ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $temp["data"]=$this->m_users->get_user_by_id($id);
            $temp['title'] = "User";
            $temp['template'] = 'user/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function create ()
    {
        if ( $this->check_role )
        {
            $temp["data"]="CREATE";
            $temp['title'] = "User";
            $temp['template'] = 'user/form';
            $this->load->view ( "backend/layout", $temp );
        }
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
    }

}
