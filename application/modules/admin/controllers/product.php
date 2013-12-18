<?php
class Product extends CI_Controller {

    protected $check_role = TRUE;

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( 'm_product' );
        $this->load->Model ( 'm_category' );
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
            $temp['title'] = "Product";
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
                $dto_pro->setColor_id($_POST['id_color']);
                if ( $dto_pro->getThumb () != NULL )
                {
                    unlink ( $_POST['img_old'] );
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

    public function set_category_product ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['pro_cat'] ) )
            {
                $arr_cat_check = $_POST['cb_cat_id'];
                $pro_id = $_POST['pro_id'];
                $arr_cat_id = array( );
                $dto_cat_pro = new DTO_cat_and_pro();
                foreach ( $this->m_product->get_cat_by_pro_id ( $pro_id ) as $dto_cat_pro )
                {
                    if ( !in_array ( $dto_cat_pro->getCat_id (), $arr_cat_id ) )
                    {
                        if ( $this->m_product->delete_cat_pro ( $pro_id, $dto_cat_pro->getCat_id () ) )
                        {
                            //success
                        }
                        else
                        {
                            //error
                        }
                    }
                }
                foreach ( $arr_cat_check as $cat_id )
                {
                    if ( !$this->m_product->check_cat_pro ( $pro_id, $cat_id ) )
                    {
                        $dto_cat = new DTO_cat_and_pro();
                        $dto_cat->setPro_id ( $pro_id );
                        $dto_cat->setCat_id ( $cat_id );
                        if ( $this->m_product->insert_cat_pro ( $dto_cat ) )
                        {
                            //success
                        }
                        else
                        {
                            //error
                        }
                    }
                }
            }
            $temp['title'] = "Product";
            if ( isset ( $pro_id ) )
            {
                $temp['data']['pro_id'] = $pro_id;
            }
            $temp['template'] = "product/list_cat";
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function view_image ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_GET['pro_id'] ) )
            {
                $pro_id = $_GET['pro_id'];
                $temp['data']['list_img'] = $this->m_product->get_img_by_pro_id ( $pro_id );
            }
            $temp['title'] = "Image";
            $temp['template'] = "product/list_image";
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function delete_image ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_GET['img_id'] ) )
            {
                $img_id = $_GET['img_id'];
                $dto_img = new DTO_image();
                $dto_img = $this->m_product->get_img_by_id ( $img_id );
                if ( $this->m_product->delete_img ( $img_id ) )
                {
                    //success
                    unlink ( $dto_img->getUrl () );
                }
                else
                {
                    //errror
                }
            }
            redirect ( 'admin/product/view_image?pro_id=' . $_GET['pro_id'] );
        }
    }

    public function edit_image ()
    {
        if ( $this->check_role )
        {
            $temp['data']['img'] = $this->m_product->get_img_by_id ( $_GET['img_id'] );
            $temp['title'] = "Image";
            $temp['template'] = "product/form_img";
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function create_image ()
    {
        if ( $this->check_role )
        {
            if ( $this->input->get ( 'pro_id' ) )
            {
                $temp['data']['count_img'] = $this->m_product->get_count_img_by_pro ( $this->input->get ( 'pro_id' ) );
            }
            $temp['title'] = "Image";
            $temp['template'] = "product/form_img";
            $this->load->view ( "backend/layout", $temp );
        }
    }

    public function save_image ()
    {
        if ( $this->check_role )
        {
            if ( isset ( $_POST['save'] ) )
            {
                if ( isset ( $_POST['img_id'] ) )
                {
                    $dto_img = new DTO_image();
                    $dto_img->setUrl ( $this->upload_img ( "img" ) );
                    if ( $this->m_product->upate_img ( $dto_img, $_POST['img_id'] ) )
                    {
                        if ( $dto_img->getUrl () != NULL )
                        {
                            unlink ( $_POST['url_old'] );
                        }
                        //success
                    }
                    else
                    {
                        //error
                    }
                }
                else
                {
                    $count_img = $_POST["count_img"];
                    for ( $i = 0; $i < $count_img; $i++ )
                    {
                        $filed_name= 'img'.$i;
                        if ($_FILES[$filed_name]['name'] != NULL )
                        {
                            $img = new DTO_image();
                            $img->setUrl ( $this->upload_img ( "$filed_name" ) );
                            $img->setPro_id ( $_POST['pro_id'] );
                            if ( $this->m_product->insert_img ( $img ) )
                            {
                                //success
                            }
                            else
                            {
                                //error
                            }
                        }
                    }
                }
                redirect ( "admin/product/view_image?pro_id=" . $_POST['pro_id'] );
            }
            redirect ( "admin/product/list_product" );
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
