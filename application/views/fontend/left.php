<?php
$this->load->Model ( "m_color" );
$m_color = new M_color();
$dto_color = new DTO_color();
$list_color = $m_color->get_all_color ();
$arr_id_color = '';
foreach ( $list_color as $dto_color )
{
    $arr_id_color.= $dto_color->getColor_id () . ',';
}
$arr_id_color = rtrim ( $arr_id_color, ',' );
?>
<script>
    function get_arr_check() {
        arr_id_color = new Array(<?php echo $arr_id_color ?>);
        arr_check = new Array();
        k = 0;
        for (i = 0; i < arr_id_color.length; i++) {
            element = "#ColorID_" + arr_id_color[i];
            if ($(element).is(':checked')) {
                arr_check[k] = arr_id_color[i];
                k++;
            }
        }
        return  arr_check;
    }
    $(function() {
        $(".list_cat").click(function() {
            cat_id = $(this).attr('cat_id');
            $('#list_pro').load("<?php echo base_url ( 'default/product_category' ); ?>", {cat_id: cat_id});
        });
        $("#search").click(function() {
            name = $("#txtSearch").val();
            if (name.length > 0) {
                $('#list_pro').load("<?php echo base_url ( 'default/product_search' ); ?>", {name: name});
            }
        });
        $("#slider-range").slider({
            range: true,
            min: 5,
            max: 500,
            values: [75, 300],
            slide: function(event, ui) {
                $("#amount").val("$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ]);
            }
        });
        $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                " - $" + $("#slider-range").slider("values", 1));
        $("#slider-range").slider({
            change: function(event, ui) {
                price = $("#amount").val();
                arr_check = get_arr_check();
                if (arr_check.length > 0) {
                    $('#list_pro').load("<?php echo base_url ( 'default/filter_data' ); ?>", {price: price, arr_color: arr_check});
                } else {
                    $('#list_pro').load("<?php echo base_url ( 'default/filter_data' ); ?>", {price: price});
                }
            }
        });
        $(".color_event").click(function() {
            arr_check = get_arr_check();
            price = $("#amount").val();
            if (arr_check.length > 0) {
                $('#list_pro').load("<?php echo base_url ( 'default/filter_data' ); ?>", {price: price, arr_color: arr_check});
            } else {
                $('#list_pro').load("<?php echo base_url ( 'default/filter_data' ); ?>", {price: price});
            }
        });
    });
</script>
<div class="left_content">
    <div class="title_box">Categories</div>
    <div class="border_box">
        <div id="menu">
            <div>
                <ul class="menu_left">
                    <?php
                    $this->load->Model ( "m_category" );
                    $this->load->Model ( "m_product" );
                    $m_cat = new M_category();


                    $menus = $m_cat->get_all_category ( TRUE );

                    function show_menu_ul ( $menus = array( ), $parrent = 0 )
                    {
                        $model_cat = new M_category();
                        $dto_cat = new DTO_category();
                        $m_pro = new M_product();
                        echo "<div>";
                        echo '<ul>';
                        foreach ( $menus as $dto_cat )
                        {
                            if ( $dto_cat->getParent_id () == $parrent )
                            {
                                $cat_id = $dto_cat->getCat_id ();
                                $flag = $model_cat->check_chiden ( $dto_cat->getCat_id () );
                                echo "<li class='list_cat' cat_id='$cat_id' >";
                                echo $flag ? '<a class="parent">' : '<a>';
                                echo '<span>' . $dto_cat->getName () . '(' . count ( $m_pro->get_pro_cat ( $cat_id ) ) . ' pro)</span></a>';
                                if ( $flag )
                                {
                                    show_menu_ul ( $menus, $dto_cat->getCat_id (), $flag );
                                }
                                echo "</li>";
                            }
                        }
                        echo "</ul></div>";
                    }

                    show_menu_ul ( $menus );
                    ?>

                </ul>
            </div>
        </div>
    </div>

    <div class="title_box">Search</div>
    <div class="border_box">
        Name: <input type="text" id="txtSearch" />
        <input type="submit" value="Search" id="search"/>
    </div>
    <div class="title_box">Filter</div>
    <div class="border_box">
        <p>
            <label for="amount"><b>Price range:</b></label>
            <input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;">
        </p>

        <div id="slider-range"></div>
        <div class="div_color">
            <b>Chooser Color Product:</b><br/>
            <?php
            foreach ( $list_color as $dto_color )
            {
                ?>
                <input type="checkbox" class="color_event" id ="<?php echo "ColorID_" . $dto_color->getColor_id () ?>" />
                <?php echo $dto_color->getName () ?>
                <br/>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="banner_adds"> <a href="#"><img src="<?php echo base_url ( 'public/fontend/images/bann2.jpg' ) ?>" alt="" border="0" /></a> </div>
</div>
<!-- end of left content -->
