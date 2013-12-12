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
        <a href="<?php echo base_url ('admin/user/changer_pass?id=').$dto_user->getUser_id (); ?>">Change password</a> | 
        <a href="<?php echo base_url ('admin/user/edit_profile?id=').$dto_user->getUser_id (); ?>">Edit profile</a> | 
        <a href="<?php echo base_url ('admin/logout'); ?>">Logout</a>
    </div>
</div>
