<div class="banner">
    <div class="banner-logo">
        <img src="<?php echo base_url ( "public/backend/images/logo.png" ) ?>" width="150" height="150"/>
    </div>
    <div class="banner-top">
        <img src="<?php echo base_url ( "public/backend/images/banner.jpg" ) ?>" width="850" height="110"/>
    </div>
    <div class="banner-menu">
        <div class="menu5">
            <a> Hello, 
            <b><?php
                $dto_user = new DTO_user();
                $dto_user = $this->session->userdata ( "user_infor" );
                echo $dto_user->getFull_name ();
                ?>
            </b> >>>>
            </a>
            <a href="<?php echo base_url ( 'admin/user/changer_pass?id=' ) . $dto_user->getUser_id (); ?>">Change password</a> | 
            <a href="<?php echo base_url ( 'admin/user/edit_profile?id=' ) . $dto_user->getUser_id (); ?>">Edit profile</a> | 
            <a href="<?php echo base_url ( 'admin/logout' ); ?>">Logout</a>
        </div>
    </div>
</div>
