<?php
$list_data = $data['list_pro'];
?>
<div class="center_title_bar">Products</div>
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
}
else
{
    echo "<b>No data!</b>";
}
?>
