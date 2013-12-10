<div class="banner">
    <div class="banner-logo">Logo</div>
    <div class="banner-top">ADMIN CONTROLLER PANEL</div>
    <div class="banner-menu">
        <b><?php
            $dto_user = new DTO_user();
            $dto_user = $this->session->userdata ( "user_infor" );
            echo $dto_user->getFull_name ();
            ?>
        </b>
        <a href="<?php echo base_url (); ?>user/logout">Logout</a>
    </div>
</div>
