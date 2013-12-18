<?php
class Index extends CI_Controller {

    public function __construct ()
    {
        parent::__construct ();
        $this->load->Model ( "m_product" );
        $this->load->library('session');
    }

    public function index ()
    {
        $temp['data']['list_pro'] = $this->m_product->get_limit_product ( 9, 0 );
        $temp['title'] = "Home";
        $temp['template'] = 'home/index';
        $this->load->view ( "fontend/layout", $temp );
    }

    public function product ()
    {
        if ( isset ( $_POST['sort_name'] ) )
        {
            $arr_pro=$this->m_product->get_all_product ( TRUE, $_POST['sort_name'] );
            $temp['data']['cmb'] = 'name_' . $_POST['sort_name'];
            $temp['data']['list_pro'] = $arr_pro;
            $this->load->view ( "home/product", $temp );
        }
        else if ( isset ( $_POST['sort_price'] ) )
        {
            $temp['data']['cmb'] = 'price_' . $_POST['sort_price'];
            $temp['data']['list_pro'] = $this->m_product->get_all_product ( TRUE, NULL, $_POST['sort_price'] );
            $this->load->view ( "home/product", $temp );
        }
        else
        {
            $temp['data']['list_pro'] = $this->m_product->get_all_product ( TRUE );
            $temp['title'] = "Home";
            $temp['template'] = 'home/product';
            $this->load->view ( "fontend/layout", $temp );
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
        //  redirect ( 'default' );
    }

    public function product_category ()
    {
        $temp['data']['list_pro'] = $this->m_product->get_product_by_cat_id ( $_POST['cat_id'], TRUE );
        $this->load->view ( "home/product", $temp );
    }

    public function product_search ()
    {
        $temp['data']['list_pro'] = $this->m_product->get_product_name ( $_POST['name'], TRUE );
        $this->load->view ( "home/product", $temp );
    }

    public function load_header ()
    {
        //echo "ghah";die;
        $this->load->view ( "home/header" );
    }

    public function filter_data ()
    {
        $range = explode ( ' - ', $_POST['price'] );
        $min = ltrim ( $range[0], "$" );
        $max = ltrim ( $range[1], "$" );
        if ( isset ( $_POST['arr_color'] ) )
        {
            $temp['data']['list_pro'] = $this->m_product->get_filter ( $min, $max, $_POST["arr_color"], TRUE );
        }else{
            $temp['data']['list_pro'] = $this->m_product->get_filter ( $min, $max, NULL, TRUE );
        }
        
        $this->load->view ( "home/product", $temp );
    }

    public function page ()
    {
      // var_dump ( $this->session->userdata ( "arr_pro" ) );die;
        if (FALSE && $this->session->userdata ( "data_list" ) )
        {
            $list= $this->session->userdata ( "data_list" );
            $temp['data']['list_pro'] = $list;
        }
        else
        {
        $temp['data']['list_pro'] = $this->m_product->get_all_product ( TRUE );
        }

        $temp['title'] = "Product";
        $temp['template'] = 'home/product';
        $this->load->view ( "fontend/layout", $temp );
    }

}

?>
