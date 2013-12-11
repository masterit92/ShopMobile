<?php
class User extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( "m_users" );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data']['error'] = FALSE;
            $temp['title'] = "User";
            $temp['template'] = 'user/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_user ()
    {
        if ( $this->check_role )
        {
            $temp['data']["list_user"] = $this->m_users->get_all_user ();
            $temp['title'] = "User";
            $temp['template'] = 'user/index';
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

    public function edit_profile ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $temp["data"]['user'] = $this->m_users->get_user_by_id ( $id );
            $temp['title'] = "User";
            $temp['template'] = 'user/form_create';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function edit_status ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $status = $this->input->get ( 'status' );
            $user = new DTO_user();
            $user->setStatus ( ($status == 1) ? 0 : 1  );
            if ( $this->m_users->update_status ( $user, $id ) )
            {
                
            }
            else
            {
                
            }
            redirect ( 'admin/user/list_user' );
        }
    }

    public function create ()
    {
        if ( $this->check_role )
        {
            $temp['title'] = "User";
            $temp['template'] = 'user/form_create';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function save ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                $user = new DTO_user();
                $user->setFull_name($_POST['full_name']);
                $user->setEmail($_POST['email']);
                $user->setPassword($_POST['password']);
                if ( isset ( $_POST['user_id'] ) )
                {
                    if ( $this->m_users->update_role ( $user, $_POST['role_id'] ) )
                    {
                        
                    }
                    else
                    {
                        
                    }
                }
                else
                {
                    if ( $this->m_users->insert_user ( $user ) )
                    {
                        
                    }
                    else
                    {
                        
                    }
                }
                redirect ( 'admin/user/list_user' );
            }
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