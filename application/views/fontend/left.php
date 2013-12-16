<div class="left_content">
    <div class="title_box">Categories</div>
    <div >
        <select class="baby_bear">
            <option selected>List Category</option>
            <?php
            $this->load->Model ( "m_category" );
            $m_cat = new M_category();
            $menus = $m_cat->get_all_category ( TRUE );

            function show_menu ( $menus = array( ), $parrent = 0, $text = "&triangleright;" )
            {
                $dto_cat = new DTO_category();
                foreach ( $menus as $dto_cat )
                {
                    if ( $dto_cat->getParent_id () == $parrent )
                    {
                        $cat_id = $dto_cat->getCat_id ();
                        echo "<option value='$cat_id'>" . $text . $dto_cat->getName () . "</option>";
                        show_menu ( $menus, $dto_cat->getCat_id (), $text . '&triangleright;&triangleright;' );
                    }
                }
            }

            show_menu ( $menus );
            ?>
        </select>
    </div>

    <div class="title_box">Special Products</div>
    <div class="border_box">
        <div class="product_title"><a href="details.html">Motorola 156 MX-VL</a></div>
        <div class="product_img"><a href="details.html"><img src="<?php echo base_url ( 'public/fontend/images/laptop.png' ) ?>" alt="" border="0" /></a></div>
        <div class="prod_price"><span class="reduce">350$</span> <span class="price">270$</span></div>
    </div>
    <div class="title_box">Newsletter</div>
    <div class="border_box">
        <input type="text" name="newsletter" class="newsletter_input" value="your email"/>
        <a href="#" class="join">join</a> </div>
    <div class="banner_adds"> <a href="#"><img src="<?php echo base_url ( 'public/fontend/images/bann2.jpg' ) ?>" alt="" border="0" /></a> </div>
</div>
<!-- end of left content -->
