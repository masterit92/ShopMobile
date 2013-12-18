<?php

class M_paging extends My_database {

    protected $table_name;
    protected $start;
    protected $num_re;
    protected $arr_where = NULL;
    protected $arr_where_in = NULL;
    protected $arr_order_by = NULL;

    public function setArr_where ( $arr_where )
    {
        $this->arr_where = $arr_where;
    }

    public function setArr_where_in ( $arr_where_in )
    {
        $this->arr_where_in = $arr_where_in;
    }

    public function setArr_order_by ( $arr_order_by )
    {
        $this->arr_order_by = $arr_order_by;
    }

    public function setStart ( $start )
    {
        $this->start = $start;
    }

    public function setTable_name ( $table_name )
    {
        $this->table_name = $table_name;
    }

    public function setNum_re ( $num_re )
    {
        $this->num_re = $num_re;
    }
    public function getNum_re ()
    {
        return $this->num_re;
    }

    
    public function __construct ()
    {
        parent::__construct ();
    }

    protected function set_value_profile ( $row_pro )
    {
        $dto_pro = new DTO_product();
        $dto_pro->set_property ( $row_pro['Pro_id'], $row_pro['Name'], $row_pro['Price'], $row_pro['Description'], $row_pro['Quantity'], $row_pro['Status'], $row_pro['Thumb'], $row_pro['Color_id'] );
        return $dto_pro;
    }

    public function set_infor ( $table_name, $start, $num_re )
    {
        $this->table_name = $table_name;
        $this->start = $start;
        $this->num_re = $num_re;
    }

    //arr_where=array("column"=>"vakue")
    //arr_where_in=array("column"=>array("value1","value2"))
    //arr_order_by=array("column"=>value)
    protected function set_data ()
    {
        if ( count ( $this->arr_where ) > 0 )
        {
            foreach ( $this->arr_where as $key => $value )
            {
                $this->db->where ( $key, $value );
            }
        }
        if ( count ( $this->arr_where_in ) > 0 )
        {
            foreach ( $this->arr_where_in as $key => $value )
            {
                $this->db->where_in ( $key, $value );
            }
        }
        if ( count ( $this->arr_order_by ) > 0 )
        {
            foreach ( $this->arr_order_by as $key => $value )
            {
                $this->db->order_by ( $key, $value );
            }
        }
    }

    public function get_limit_product ()
    {
        try
        {
            $this->set_data ();
            $this->db->limit ( $this->num_re, $this->start );
            $list = $this->get_table ( $this->table_name );
            $arr = array( );
            foreach ( $list as $value )
            {
                $arr[] = $this->set_value_profile ( $value );
            }
            return $arr;
        }
        catch ( Exception $ex )
        {
            throw $ex;
        }
        return NULL;
    }

    public function get_count_data ()
    {
        try
        {
            $this->set_data ();
            $this->db->from ( $this->table_name );
            return $this->db->count_all_results ();
        }
        catch ( Exception $exc )
        {
            throw $exc;
        }

        return NULL;
    }

    public function get_num_page ()
    {
        return ceil ( $this->get_count_data () / $this->num_re );
    }

    public function view_html ( $url = "#", $class_name = NULL )
    {
        $view = '<div class="page">';
        $view.='<a href="' . $url . '?page=1" class="' . $class_name . '"  id="0">Start</a>';
        $current = 1;
        if ( isset ( $_GET['page'] ) )
        {
            $current = $_GET['page'];
        }
        $flag = TRUE;
        for ( $i = 1; $i <= $this->get_num_page (); $i++ )
        {
            if ( isset ( $_GET['page'] ) && $_GET['page'] == $i )
            {
                $view.='<a href="' . $url . '?page=' . $i . '" class="current ' . $class_name . '" id="'.($i-1).'">' . $i . '</a>';
            }
            else
            {
                if ( $i > ($current - 3) && $i < ($current + 3) )
                {
                    $flag = TRUE;
                    $view.=' <a href="' . $url . '?page=' . $i . '" class="' . $class_name . '" id="'.($i-1).'">' . $i . '</a>';
                }
                else
                {
                    if ( $flag )
                    {
                        $flag = FALSE;
                        $view.= "<a>....</a>";
                    }
                }
            }
        }
        $view.='<a href="' . $url . '?page=' . $this->get_num_page () . '" class="' . $class_name . '" id="'.($this->get_num_page ()-1).'">End</a>';
        $view.='</div>';
        return $view;
    }

}
