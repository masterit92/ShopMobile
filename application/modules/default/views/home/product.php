<div class="center_title_bar">All Products</div>
<?php
$dto_pro = new DTO_product();
foreach ( $data['list_pro'] as $dto_pro )
{
    ?>
    <div class="prod_box">
        <div class="top_prod_box"></div>
        <div class="center_prod_box">
            <div class="product_title"><a href="details.html"><?php $dto_pro->getName ()?></a></div>
            <div class="product_img">
                <a href="details.html">
                    <img src="<?php echo base_url ($dto_pro->getThumb ()) ?>" alt="" border="0" width="150" height="150"/>
                </a>
            </div>
            <div class="prod_price">
                <span class="price">$<?php echo $dto_pro->getPrice ()?></span>
            </div>
        </div>
        <div class="bottom_prod_box"></div>
        <div class="prod_details_tab"> <a href="" title="header=[Add to cart] body=[&nbsp;] fade=[on]">
                <a href="details.html" class="prod_details">details</a> </div>
    </div>
    <?php
}
?>