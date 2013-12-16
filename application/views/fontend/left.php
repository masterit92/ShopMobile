<script>
    $(function() {
        $(".list_cat").change(function() {
            cat_id = $(".list_cat").val();

            $('#list_pro').load("<?php echo base_url ( 'default/product_category' ); ?>", {cat_id: cat_id});
        });
        $("#search").click(function() {
            name = $("#txtSearch").val();
            if (name.length>0) {
                $('#list_pro').load("<?php echo base_url ( 'default/product_search' ); ?>", {name: name});
            }
        });
        $("#rdb_name_desc").click(function() {
            $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {sort_name: 'DESC'});
        });
        $("#rdb_name_asc").click(function() {
            $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {sort_name: 'ASC'});
        });
        $("#rdb_price_desc").click(function() {
            $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {sort_price: 'DESC'});
        });
        $("#rdb_price_asc").click(function() {
            $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {sort_price: 'ASC'});
        });
    });
</script>
<div class="left_content">
    <div class="title_box">Categories</div>
    <div >
        <div class="border_box">
            <select class="list_cat">
                <option selected>List Category</option>
                <?php
                $this->load->Model ( "m_category" );
                $this->load->Model ( "m_product" );
                $m_cat = new M_category();

                $menus = $m_cat->get_all_category ( TRUE );

                function show_menu ( $menus = array( ), $parrent = 0, $text = "&triangleright;" )
                {
                    $m_pro = new M_product();
                    $dto_cat = new DTO_category();
                    foreach ( $menus as $dto_cat )
                    {
                        if ( $dto_cat->getParent_id () == $parrent )
                        {
                            $cat_id = $dto_cat->getCat_id ();
                            echo "<option value='$cat_id'>" . $text . $dto_cat->getName () . "(" . count ( $m_pro->get_pro_cat ( $dto_cat->getCat_id () ) ) . " pro)</option>";
                            show_menu ( $menus, $dto_cat->getCat_id (), $text . '&triangleright;&triangleright;' );
                        }
                    }
                }

                show_menu ( $menus );
                ?>
            </select>
        </div>
    </div>

    <div class="title_box">Search</div>
    <div class="border_box">
        Name: <input type="text" id="txtSearch" />
        <input type="submit" value="Search" id="search"/>
    </div>
    <div class="title_box">ADDS</div>
    <div class="border_box">
      <input type="radio" id="rdb_name_desc" name="rdb"/> Name &DoubleUpArrow;<br/>
    <input type="radio" id="rdb_name_asc" name="rdb"/> Name &DoubleDownArrow;<br/>
    <input type="radio" id="rdb_price_desc" name="rdb"/> Price &DoubleUpArrow;<br/>
    <input type="radio" id="rdb_price_asc" name="rdb"/> Price &DoubleDownArrow;
    </div>
    <div class="banner_adds"> <a href="#"><img src="<?php echo base_url ( 'public/fontend/images/bann2.jpg' ) ?>" alt="" border="0" /></a> </div>
</div>
<!-- end of left content -->
