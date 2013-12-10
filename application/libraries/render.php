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

}

?>
