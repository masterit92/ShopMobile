<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
if ($this->session->flashdata('login_error'))
{
    $err = $this->session->flashdata('login_error');
    echo "<script> alert('$err');</script>";
}
?>
<html>
    <head>
        <meta charset="UTF-8" />
        <?php
        $arr_file_css = array("login.css", "style_login.css", "animate-custom.css");
        $backend = 'backend';
        $this->load->library("render");
        echo $this->render->render_css($arr_file_css, $backend);
        ?>
        <title>Login</title>
    </head>
    <body>
        <div class="container">
            <header>

            </header>
            <section>				
                <div id="container_demo" >
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">
                            <form  action="<?php echo base_url(); ?>user/index" autocomplete="on" method="post"> 
                                <h1>Log in</h1> 
                                <p> 
                                    <label for="username" class="uname" data-icon="u" > Your email or username </label>
                                    <input id="username" name="username" required="required" type="text" placeholder="myusername or mymail@mail.com"/>
                                </p>
                                <p> 
                                    <label for="password" class="youpasswd" data-icon="p"> Your password </label>
                                    <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                                </p>
                                <p class="keeplogin"> 
                                    <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                    <label for="loginkeeping">Keep me logged in</label>
                                </p>
                                <p class="login button"> 
                                    <input type="submit" value="Login" name="tbnLogin"/> 
                                </p>
                                <p class="change_link">
                                    Forgot your password?
                                    <a href="#toregister" class="to_register">Click here</a>
                                </p>
                            </form>
                        </div>
                        <div id="register" class="animate form">
                            <form  action="mysuperscript.php" autocomplete="on"> 
                                <h1> Forgot your password! </h1> 
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p class="signin button"> 
                                    <input type="submit" value="Send" name="tbnSend"/> 
                                </p>
                                <p class="change_link">  
                                    <a href="#tologin" class="to_register"> Go and log in </a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>  
            </section>
        </div>
    </body>
</html>