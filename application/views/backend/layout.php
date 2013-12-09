<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml"> 
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <?php
        $arr_file_css = array("page_admin_css.css");
        echo $this->render->Render_css($arr_file_css);
        ?> 
        <title><?php echo $title; ?></title> 
    </head> 

    <body> 
        <?php $this->load->view("backend/header"); ?> 
        <div id="main"> 
            <?php $this->load->view("backend/left"); ?> 
            <div id="info"> 
                <?php
                $this->load->view($template, $data = '');
                ?> 
            </div> 
        </div> 
        <?php $this->load->view("backend/footer"); ?> 
    </body> 
</html>