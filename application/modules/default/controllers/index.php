<?php

class Index extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( "m_product" );
        $this->load->Model ( "m_paging" );
        $this->m_paging->set_infor ( 'products', '0', '9' );
        $arr_where = array( "Status" => "1" );
        $this->m_paging->setArr_where ( $arr_where );
    }

    public function index ()
    {
        $this->m_paging->setStart ( 0 );
        $temp['data']['list_pro'] = $this->m_paging->get_limit_product ();
        $temp['title'] = "Home";
        $temp['template'] = 'home/index';
        $this->load->view ( "fontend/layout", $temp );
    }

    public function product ()
    {
        $paging= new M_paging();
        $paging->set_infor('products', 0, 6);
        $_GET['page'] = 1;

        if ( isset ( $_POST['page'] ) )
        {
            $_GET['page'] = $_POST['page'] + 1;
            $start = $paging->getNum_re () * $_POST['page'];
            $paging->setStart ( $start );
        }
        if ( isset ( $_POST['sort_name'] ) )
        {
            $paging->setArr_order_by ( array( "Name" => $_POST['sort_name'] ) );
            $temp['data']['cmb'] = 'name_' . $_POST['sort_name'];
            $temp['data']['list_pro'] = $paging->get_limit_product ();
            $temp['data']['view_page'] = $paging->view_html ( "#", "page_event" );
            $this->load->view ( "home/product", $temp );
        }
        else if ( isset ( $_POST['sort_price'] ) )
        {
            $paging->setArr_order_by ( array( "Price" => $_POST['sort_price'] ) );
            $temp['data']['cmb'] = 'price_' . $_POST['sort_price'];
            $temp['data']['list_pro'] = $paging->get_limit_product ();
            $temp['data']['view_page'] = $paging->view_html ( "#", "page_event" );
            $this->load->view ( "home/product", $temp );
        }
        else
        {
            $temp['data']['list_pro'] = $paging->get_limit_product ();
            $temp['data']['view_page'] = $paging->view_html ( "#", "page_event" );
            $temp['title'] = "Product";
            if ( isset ( $_POST['page'] ) )
            {
                $this->load->view ( "home/product", $temp );
            }
            else
            {
                $temp['template'] = 'home/product';
                $this->load->view ( "fontend/layout", $temp );
            }
        }
    }

    public function detail ()
    {
        if ( isset ( $_GET['pro_id'] ) )
        {
            $temp['data']['pro'] = $this->m_product->get_product_by_id ( $_GET['pro_id'], TRUE );
            $temp['data']['list_img'] = $this->m_product->get_img_by_pro_id ( $_GET['pro_id'] );
            $temp['title'] = "Home";
            $temp['template'] = 'home/detail';
            $this->load->view ( "fontend/layout", $temp );
        }
    }

    public function product_category ()
    {
        $paging_cat= new M_paging();
        $paging_cat->set_infor('products', 0, 6);
        $_GET['page'] = 1;

        if ( isset ( $_POST['page'] ) )
        {
            $_GET['page'] = $_POST['page'] + 1;
            $start = $paging_cat->getNum_re () * $_POST['page'];
           $paging_cat->setStart ( $start );
        }
        $arr_pro_id = array( );
        foreach ( $this->m_product->get_pro_cat ( $_POST['cat_id'] ) as $dto_cat_pro )
        {
            $arr_pro_id[] = $dto_cat_pro->getPro_id ();
        }
        $arr_where_in = array( "Pro_id" => $arr_pro_id );
        $paging_cat->setArr_where_in ( $arr_where_in );
        $temp['data']['cat_id'] = $_POST['cat_id'];
        $temp['data']['list_pro'] = $paging_cat->get_limit_product ();
        $temp['data']['view_page'] =$paging_cat->view_html ( "#", "page_event" );
        $this->load->view ( "home/product", $temp );
    }

    public function product_search ()
    {
        $s_paging= new M_paging();
        $s_paging->set_infor('products', 0, 6);
        $_GET['page'] = 1;

        if ( isset ( $_POST['page'] ) )
        {
            $_GET['page'] = $_POST['page'] + 1;
            $start = $s_paging->getNum_re () * $_POST['page'];
           $s_paging->setStart ( $start );
        }
        $s_paging->setArr_like(array("Name"=>$_POST['name']));
        $temp['data']['search']=1;
        $temp['data']['list_pro'] = $s_paging->get_limit_product ();
        $temp['data']['view_page'] =$s_paging->view_html ( "#", "page_event" );
        $this->load->view ( "home/product", $temp );
    }

    public function load_header ()
    {
        //echo "ghah";die;
        $this->load->view ( "home/header" );
    }

    public function filter_data ()
    {
        $f_paging= new M_paging();
        $f_paging->set_infor('products', 0, 6);
        $_GET['page'] = 1;

        if ( isset ( $_POST['page'] ) )
        {
            $_GET['page'] = $_POST['page'] + 1;
            $start =$f_paging->getNum_re () * $_POST['page'];
            $f_paging->setStart ( $start );
        }

        $range = explode ( ' - ', $_POST['price'] );
        $min = ltrim ( $range[0], "$" );
        $max = ltrim ( $range[1], "$" );
        $arr_where = array( "Status" => "1", "Price >=" => $min, "Price <=" => $max );
        $f_paging->setArr_where ( $arr_where );
        $temp['data']['f_price']=$_POST['price'];
        if ( isset ( $_POST['arr_color'] ) )
        {
            $arr_where_in=array("Color_id"=>$_POST['arr_color']);
            $f_paging->setArr_where_in ($arr_where_in);
            $temp['data']['f_color']=$_POST['arr_color'];
        }
        $temp['data']['list_pro'] = $f_paging->get_limit_product ();
        $temp['data']['view_page'] = $f_paging->view_html ( "#", "page_event" );
        $this->load->view ( "home/product", $temp );
    }

}
