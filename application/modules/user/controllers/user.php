<?php

class user extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper("url");
        $this->load->Model("m_users");
        $this->load->helper('cookie');
    }

    public function index() {
        $flag = FALSE;
        if ($this->input->cookie('ck_email', TRUE) && $this->input->cookie('ck_password', TRUE)) {
            //var_dump($this->input->cookie('ck_email', TRUE));
            $dto_user = new DTO_user();
            $dto_user = $this->m_users->Check_Login($this->input->cookie('ck_email', TRUE), $this->input->cookie('ck_password', TRUE));
            $this->session->set_userdata('user_infor', $dto_user);
            $flag = TRUE;
        }
        if (!$this->session->userdata("user_infor")) {
            $flag = TRUE;
        }
        if (isset($_POST['tbnLogin'])) {
            $email = $_POST['username'];
            $pass = $_POST['password'];
            $dto_user = new DTO_user();
            $dto_user = $this->m_users->Check_Login($email, $pass);
            if ($dto_user != NULL) {
                $this->session->set_userdata('user_infor', $dto_user);
                if (isset($_POST['loginkeeping'])) {
                    $this->input->set_cookie('ck_email', $email, (2 * 24 * 3600), '', '/', '', TRUE);
                    $this->input->set_cookie('ck_password', $pass, (2 * 24 * 3600), '', '/', '', TRUE);
                }
                $flag = TRUE;
            }
        }
        if (!$flag) {
            $this->load->view("user/index");
        } else {
            $temp['title'] = "Admin";
            $temp['template'] = 'user/success';
            $this->load->view("backend/layout", $temp);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        setcookie('ck_email', time() - 9600);
        setcookie('ck_password', time() - 9600);
        $this->load->view("user/index");
    }

}

?>
