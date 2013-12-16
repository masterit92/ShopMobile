<?php

class Split_page {

    private $arr_data;
    private $num_rec;


    public function set_data ( $arr_data, $num_rec )
    {
        $this->arr_data = $arr_data;
        $this->num_rec = $num_rec;
    }

    public function num_page ()
    {
        return ceil ( count ( $this->arr_data ) / $this->num_rec );
    }

    public function get_data_page ( $current_page )
    {
        $listData = array( );
        $num_element = ($current_page - 1) * $this->num_rec;
        if ( isset ( $this->arr_data[$num_element] ) )
        {
            if ( (count ( $this->arr_data ) - $num_element) - $this->num_rec >= 0 )
            {
                for ( $i = $num_element; $i < ($this->num_rec + $num_element); $i++ )
                {
                    $listData[] = $this->arr_data[$i];
                }
            }
            else
            {
                for ( $i = $num_element; $i < count ( $this->arr_data ); $i++ )
                {
                    $listData[] = $this->arr_data[$i];
                }
            }
        }
        return $listData;
    }

    public function view_num_page ( $url )
    {
        $view = '<div class="page">';
        $view.='<a href="' . $url . '?page=1" >Start</a>';
        $current = 1;
        if ( isset ( $_GET['page'] ) )
        {
            $current = $_GET['page'];
        }
        $flag = TRUE;
        for ( $i = 1; $i <= $this->num_page (); $i++ )
        {
            if ( isset ( $_GET['page'] ) && $_GET['page'] == $i )
            {
                $view.='<a href="' . $url . '?page=' . $i . '" class="current">' . $i . '</a>';
            }
            else
            {
                if ( $i > ($current - 3) && $i < ($current + 3) )
                {
                    $flag = TRUE;
                    $view.=' <a href="' . $url . '?page=' . $i . '">' . $i . '</a>';
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
        $view.='<a href="' . $url . '?page=' . $this->num_page () . '">End</a>';
        $view.='</div>';
        return $view;
    }

}

?>
