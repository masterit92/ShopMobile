<?php
class Role extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( "m_role" );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data']['error'] = FALSE;
            $temp['title'] = "User";
            $temp['template'] = 'role/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_role ()
    {
        if ( $this->check_role )
        {
            $temp['data']["list_role"] = $this->m_role->get_all_role ();
            $temp['title'] = "Role";
            $temp['template'] = 'role/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function delete ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            if ( $this->m_role->delete_role ( $id ) )
            {
                //success
                //$this->session->set_flashdata ( 'result', 'Delete Sucess!' );
            }
            else
            {
                //fail
                //$this->session->set_flashdata ( 'result', 'Delete Fail!' );
            }
            redirect ( 'admin/role/list_role' );
        }
    }

    public function edit ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $temp["data"]["role"] = $this->m_role->get_role_by_id ( $id );
            $temp['title'] = "Role";
            $temp['template'] = 'role/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function create ()
    {
        if ( $this->check_role )
        {
            $temp['title'] = "Role";
            $temp['template'] = 'role/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function save ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                $role = new DTO_role();
                $role->setName ( $_POST['role_name'] );
                $role->setStatus ( $_POST['status'] );
                if ( isset ( $_POST['role_id'] ) )
                {
                    if($this->m_role->update_role($role,$_POST['role_id'])){
                        //success
                    }else{
                        //error
                    }
                }else{
                    if($this->m_role->insert_role($role)){
                        //success
                    }else{
                        //error
                    }
                }
                redirect ( 'admin/role/list_role' );
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
