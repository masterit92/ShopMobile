<script>
    $(function() {
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

        $(".page_event").click(function() {
            page = $(this).attr('id');
            cat_id =<?php echo isset ( $data['cat_id'] ) ? $data['cat_id'] : '-1' ?>;
            f_price =<?php echo isset ( $data['f_price'] ) ? "'" . $data['f_price'] . "'" : "''" ?>;
            f_color = get_arr_check();
            search =<?php echo isset ( $data['search'] ) ? $data['search'] : '0' ?>;
            if (search >0) {
                name = $("#txtSearch").val();
                if (name.length > 0) {
                    $('#list_pro').load("<?php echo base_url ( 'default/product_search' ); ?>", {page: page,name: name});
                }
            }
            else if (f_price !== '') {
                if (f_color.length <= 0) {
                    $('#list_pro').load("<?php echo base_url ( 'default/filter_data' ); ?>", {page: page, price: f_price});
                } else {
                    $('#list_pro').load("<?php echo base_url ( 'default/filter_data' ); ?>", {page: page, price: f_price, arr_color: f_color});
                }
            }
            else if (cat_id > 0) {
                $('#list_pro').load("<?php echo base_url ( 'default/product_category' ); ?>", {page: page, cat_id: cat_id});
            }
            else if ($("#rdb_name_desc").is(':checked')) {
                $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {page: page, sort_name: 'DESC'});
            }
            else if ($("#rdb_name_asc").is(':checked')) {
                $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {page: page, sort_name: 'ASC'});
            }
            else if ($("#rdb_price_desc").is(':checked')) {
                $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {page: page, sort_price: 'DESC'});
            }
            else if ($("#rdb_price_asc").is(':checked')) {
                $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {page: page, sort_price: 'ASC'});
            } else {
                $('#list_pro').load("<?php echo base_url ( 'default/product' ); ?>", {page: page});
            }
        });

    });
</script>
<?php
$list_data = $data["list_pro"];
?>
<div class="center_title_bar">All Products 
    <input type="radio" id="rdb_name_desc" name="rdb" <?php echo(isset ( $data['cmb'] ) && $data['cmb'] === 'name_DESC') ? 'checked' : '' ?>/> Name &DoubleUpArrow;
    <input type="radio" id="rdb_name_asc" name="rdb" <?php echo(isset ( $data['cmb'] ) && $data['cmb'] === 'name_ASC') ? 'checked' : '' ?>/> Name &DoubleDownArrow;
    <input type="radio" id="rdb_price_desc" name="rdb" <?php echo(isset ( $data['cmb'] ) && $data['cmb'] === 'price_DESC') ? 'checked' : '' ?>/> Price &DoubleDownArrow;
    <input type="radio" id="rdb_price_asc" name="rdb" <?php echo(isset ( $data['cmb'] ) && $data['cmb'] === 'price_ASC') ? 'checked' : '' ?>/> Price &DoubleUpArrow;
</div>
<div id="sort_pro">
    <?php
    $dto_pro = new DTO_product();
    if ( count ( $list_data ) > 0 )
    {
        foreach ( $list_data as $dto_pro )
        {
            ?>
            <div class="prod_box">
                <div class="top_prod_box"></div>
                <div class="center_prod_box">
                    <div class="product_title"><a href="<?php echo base_url ( 'default/detail?pro_id=' . $dto_pro->getPro_id () ) ?>"><?php echo $dto_pro->getName () ?></a></div>
                    <div class="product_img">
                        <a href="<?php echo base_url ( 'default/detail?pro_id=' . $dto_pro->getPro_id () ) ?>">
                            <img src="<?php echo base_url ( $dto_pro->getThumb () ) ?>" alt="" border="0" width="150" height="150"/>
                        </a>
                    </div>
                    <div class="prod_price">
                        <span class="price">$<?php echo $dto_pro->getPrice () ?></span>
                    </div>
                </div>
                <div class="bottom_prod_box"></div>
                <div class="prod_details_tab"> <a href="" title="header=[Add to cart] body=[&nbsp;] fade=[on]">
                        <a href="<?php echo base_url ( 'default/detail?pro_id=' . $dto_pro->getPro_id () ) ?>" class="prod_details">details</a> </div>
            </div>
            <?php
        }
        echo $data['view_page'];
    }
    else
    {
        echo "<b>No Data!</b>";
    }
    ?>
</div>