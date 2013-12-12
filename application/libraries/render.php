<?php
class Render {

    public function render_css ( $arr_file_css, $template = 'fontend' )
    {
        if ( count ( $arr_file_css ) > 0 )
        {
            $html_string = "";
            foreach ( $arr_file_css as $file_css )
            {
                $html_string.='<link href="';
                $html_string.=base_url ();
                $html_string.='public/';
                $html_string.=$template;
                $html_string.= '/css/';
                $html_string.=$file_css . '"';
                $html_string.='rel="stylesheet" type="text/css" />';
            }
            return $html_string;
        }
    }
    public function render_js($arr_file_js, $template='fontend'){
        if ( count ( $arr_file_js ) > 0 )
        {
            $html_string = "";
            foreach ( $arr_file_js as $file_js )
            {
                $html_string.='<script src="';
                $html_string.=base_url ();
                $html_string.='public/';
                $html_string.=$template;
                $html_string.= '/js/';
                $html_string.=$file_js . '"';
                $html_string.='type="text/javascript"></script>';
            }
            return $html_string;
        }
    }

}
