<?php
if ( !$this->session->userdata ( "user_infor" ) )
{
    redirect ( 'user/index' );
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <?php
        $arr_file_css = array( "style_admin.css", "table.css", "menu_left.css" );
        echo $this->render->Render_css ( $arr_file_css, 'backend' );
        ?> 
        <title><?php echo $title; ?></title> 
    </head> 

    <body> 
        <div class="wraper">
                <?php $this->load->view ( "backend/header" ); ?> 
            <div class="container">
                    <?php $this->load->view ( "backend/left" ); ?> 
                <div class="container-right">
                    <?php
                    $this->load->view ( $template, $data = '' );
                    ?>  
                </div>
            </div>
            <div class="clear"></div>
<?php $this->load->view ( "backend/footer" ); ?> 
        </div>
    </body> 
</html>