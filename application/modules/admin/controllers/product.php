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
                $dto_pro = new DTO_product();
                $dto_pro->setName ( $_POST['pro_name'] );
                $dto_pro->setThumb ( $this->upload_img ( 'thumb' ) );
                $dto_pro->setPrice ( $_POST['price'] );
                $dto_pro->setDescription ( $_POST['description'] );
                $dto_pro->setQuantity ( $_POST['quantity'] );
                if ( $dto_pro->getThumb () != NULL )
                {
                    unlink($_POST['img_old']);
                }
                if ( isset ( $_POST['pro_id'] ) )
                {
                    if ( $this->m_product->update_pro ( $dto_pro, $_POST['pro_id'] ) )
                    {
                        //success
                    }
                    else
                    {
                        //error
                    }
                }
                else
                {
                    if ( $this->m_product->insert_pro ( $dto_pro ) )
                    {
                        //success
                    }
                    else
                    {
                        //error
                    }
                }
                redirect ( 'admin/product/list_product' );
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

    protected function upload_img ( $filed_name )
    {
        //Upload
        $path = realpath ( 'public/backend/images' );
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '2048';
        $config['encrypt_name'] = FALSE;
        $this->load->library ( 'upload', $config );
        $this->upload->initialize ( $config );
        $url_img = 'public/backend/images/' . $_FILES[$filed_name]['name'];
        if ( file_exists ( $url_img ) )
        {
            $_FILES[$filed_name]['name'] = rand ( 1000, 10000 ) . "_" . $_FILES[$filed_name]['name'];
            $url_img = 'public/backend/images/' . $_FILES[$filed_name]['name'];
        }
        $check_upload = $this->upload->do_upload ( $filed_name );
        if ( $check_upload )
        {
            return $url_img;
        }
        return NULL;
    }

}

?>
