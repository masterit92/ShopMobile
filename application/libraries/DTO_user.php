<?php
class DTO_user {
    private $user_id;
    private $email;
    private $password;
    private $full_name;
    private $status;

    public function setProperty($user_id, $email, $password, $full_name, $status) {
        $this->user_id = $user_id;
        $this->email = $email;
        $this->password = $password;
        $this->full_name = $full_name;
        $this->status = $status;
    }
    public function getUser_id() {
        return $this->user_id;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getFull_name() {
        return $this->full_name;
    }

    public function setFull_name($full_name) {
        $this->full_name = $full_name;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
?>
