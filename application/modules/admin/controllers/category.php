<?php

class Category extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( 'm_category' );
        if ( !$this->check () )
        {
            $this->check_role = FALSE;
            $temp['data']['error'] = FALSE;
            $temp['title'] = "User";
            $temp['template'] = 'category/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_category ()
    {
        if ( $this->check_role )
        {
            $temp['data']['list_cat'] = $this->m_category->get_cat_by_parent_id ( 0 );
            $temp['title'] = "Category";
            $temp['template'] = 'category/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function edit ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $temp["data"]['cat'] = $this->m_category->get_cat_by_id ( $id );
            $temp['title'] = "Category";
            $temp['template'] = 'category/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function create ()
    {
        if ( $this->check_role )
        {
            $temp['title'] = "Category";
            $temp['template'] = 'category/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function edit_status ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $status = $this->input->get ( 'status' );
            $cat = new DTO_category();
            $cat->setStatus ( ($status == 1) ? 0 : 1  );
            if ( $this->m_category->update_status ( $cat, $id ) )
            {
                //success
            }
            else
            {
                //error
            }
            redirect ( 'admin/category/list_category' );
        }
    }

    public function delete ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            if ( $this->m_category->delete_cat ( $id ) )
            {
                //success
                //$this->session->set_flashdata ( 'result', 'Delete Sucess!' );
            }
            else
            {
                //fail
                //$this->session->set_flashdata ( 'result', 'Delete Fail!' );
            }
            redirect ( 'admin/category/list_category' );
        }
    }

    public function save ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                $cat = new DTO_category();
                isset ( $_POST['cat_name'] ) ? $cat->setName ( $_POST['cat_name'] ) : NULL;
                isset ( $_POST['parent_id'] ) ? $cat->setParent_id ( $_POST['parent_id'] ) : $cat->setParent_id ( 0 );
                if ( isset ( $_POST['cat_id'] ) )
                {
                    if ( $this->m_category->update_cat ( $cat, $_POST['cat_id'] ) )
                    {
                        //success
                    }
                    else
                    {
                        //fail
                    }
                }
                else
                {
                    if ( $this->m_category->insert_cat ( $cat ) )
                    {
                        //success
                    }
                    else
                    {
                        //fail
                    }
                }
                redirect ( 'admin/category/list_category' );
            }
        }
    }

    protected function check ()
    {
        if ( $this->session->userdata ( "user_role" ) && $this->session->userdata ( "user_infor" ) )
        {
            $result = FALSE;
            foreach ( $this->session->userdata ( "user_role" ) as $roles )
            {
                if ( in_array ( 'admin', $roles ) OR in_array ( 'category', $roles ) )
                {
                    $result = TRUE;
                }
            }

            return $result;
        }
    }

}

?>
