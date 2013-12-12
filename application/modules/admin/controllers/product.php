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
            $temp['template'] = 'product/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function list_product ()
    {
        if ( $this->check_role )
        {
            $temp['data']["list_pro"] = $this->m_product->get_all_product ();
            $temp['title'] = "Product";
            $temp['template'] = 'product/index';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function edit_status ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $status = $this->input->get ( 'status' );
            $pro = new DTO_product();
            $pro->setStatus ( ($status == 1) ? 0 : 1  );
            if ( $this->m_product->update_status ( $pro, $id ) )
            {
                //success
            }
            else
            {
                //error
            }
            redirect ( 'admin/product/list_product' );
        }
    }

    public function delete ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            if ( $this->m_product->delete_pro ( $id ) )
            {
                //success
                //$this->session->set_flashdata ( 'result', 'Delete Sucess!' );
            }
            else
            {
                //fail
                //$this->session->set_flashdata ( 'result', 'Delete Fail!' );
            }
            redirect ( 'admin/product/list_product' );
        }
    }

    public function edit ()
    {
        if ( $this->check_role )
        {
            $id = $this->input->get ( 'id' );
            $temp["data"]['pro'] = $this->m_product->get_product_by_id ( $id );
            $temp['title'] = "Product";
            $temp['template'] = 'product/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function create ()
    {
        if ( $this->check_role )
        {
            $temp['title'] = "Category";
            $temp['template'] = 'product/form';
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function save ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                $pro = new DTO_product();
                isset ( $_POST['cat_name'] ) ? $pro->setName ( $_POST['cat_name'] ) : NULL;
                isset ( $_POST['parent_id'] ) ? $pro->setParent_id ( $_POST['parent_id'] ) : $pro->setParent_id ( 0 );
                if ( isset ( $_POST['cat_id'] ) )
                {
                    if ( $this->m_category->update_cat ( $pro, $_POST['cat_id'] ) )
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
                    if ( $this->m_category->insert_cat ( $pro ) )
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
