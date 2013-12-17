<?php
class Authority extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( "m_role" );
        $this->load->Model ( "m_role_user" );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data']['error'] = FALSE;
            $temp['title'] = "User";
            $temp['template'] = 'user/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function index ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'user_id' );
            $temp['data']['list_role_user'] = $this->m_role_user->get_role_user_by_id ( $id );
            $temp['data']['list_role'] = $this->m_role->get_all_role ();
            $temp['title'] = "User";
            $temp['template'] = 'user/authority';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function save ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                $user_id = $_POST['user_id'];
                $arr_role = $_POST['check_role'];
                $all_role_user = $this->m_role_user->get_role_by_user ( $user_id );
                $dto_role_user = new DTO_role_and_user();
                foreach ( $all_role_user as $dto_role_user )
                {
                    if ( !in_array ( $dto_role_user->getRole_id (), $arr_role ) )
                    {
                        if ( $this->m_role_user->delete_role_user ( $user_id, $dto_role_user->getRole_id () ) )
                        {
                           //success
                        }
                        else
                        {
                            //error
                           
                        }
                    }
                }
                foreach ( $arr_role as $value )
                {
                    if ( !$this->m_role_user->check_role_user ( $user_id, $value ) )
                    {
                        $role_user = new DTO_role_and_user();
                        $role_user->setRole_id ( $value );
                        $role_user->setUser_id ( $user_id );
                        if ( $this->m_role_user->insert_role_user ( $role_user ) )
                        {
                            //success
                             
                        }
                        else
                        {
                            //error
                            
                        }
                    }
                }
                redirect("admin/authority/index?user_id=$user_id");
            }
            
        }
    }

    protected function check ()
    {
        if ( $this->session->userdata ( "user_role" ) && $this->session->userdata ( "user_infor" ) )
        {
            foreach ( $this->session->userdata ( "user_role" ) as $roles )
            {
                if ( in_array ( 'admin', $roles ) OR in_array ( 'user', $roles ) )
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

?>
