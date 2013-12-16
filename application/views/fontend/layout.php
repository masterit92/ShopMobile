<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <?php
        $arr_file_css = array( 'iecss.css', 'style.css', 'menu_left.css' );
        $arr_file_js = array( "windowopen.js", "boxOver.js",'jquery-1.10.2.js','jquery.validate.min.js' );
        echo $this->render->Render_css ( $arr_file_css, 'fontend' );
        echo $this->render->Render_js ( $arr_file_js, 'fontend' );
        ?> 
        <title><?php echo $title; ?></title> 
    </head> 

    <body> 
        <div id="main_container">
            <?php $this->load->view ( "home/header" ); ?> 
            <div id="main_content">
                <?php $this->load->view ( "fontend/menu" ); ?> 
                <?php $this->load->view ( "fontend/left" ); ?> 
                <div class="center_content">
                    <div id="list_pro">
                    <?php
                    $this->load->view ( $template, $data = '' );
                    ?>  
                    </div>
                </div>
                <?php $this->load->view ( "fontend/right" ); ?> 
            </div>
            <?php $this->load->view ( "fontend/footer" ); ?> 
        </div>
    </body> 
</html>