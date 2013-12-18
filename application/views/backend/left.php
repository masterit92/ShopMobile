
<div class="container-menu">
    <div class="container-menu-title">Menu Manager</div>
    <div class="container-menu-content">
        <div id='cssmenu'>
            <ul>
                <li class=' '><a href='<?php echo base_url (); ?>admin/index/home'><span>Home</span></a></li>
                <li class='has-sub '><a href='#'><span>User</span></a>
                    <ul>
                        <li><a href="<?php echo base_url ('admin/user/list_user'); ?>"><span>User</span></a></li>
                        <li><a href="<?php echo base_url ('admin/role/list_role'); ?>"><span>Role</span></a></li>
                    </ul>
                </li>
                <li class='has-sub'><a href="#"><span>Product</span></a>
                    <ul>
                         <li><a href="<?php echo base_url ('admin/product/list_product'); ?>"><span>Product</span></a></li>
                         <li><a href="<?php echo base_url ('admin/color/list_color'); ?>"><span>Color</span></a></li>
                    </ul>
                </li>
                <li><a href="<?php echo base_url ('admin/category/list_category'); ?>"><span>Category</span></a></li>
            </ul>
        </div>
    </div>
</div>


