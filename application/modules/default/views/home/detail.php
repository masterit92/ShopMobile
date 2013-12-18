<?php
$dto_pro = new DTO_product();
$dto_pro = $data['pro'];
$this->load->Model ( "m_color" );
$m_color = new M_color();
$dto_color = new DTO_color();
$dto_color= $m_color->get_color_by_id ( $dto_pro->getColor_id ());
?>
<div class="center_title_bar">Motorola 156 MX-VL</div>
<div class="prod_box_big">
    <div class="top_prod_box_big"></div>
    <div class="center_prod_box_big">
        <div class="product_img_big"> <a href="javascript:popImage('<?php echo base_url ( $dto_pro->getThumb () ) ?>','<?php echo $dto_pro->getName () ?>')" title="header=[Zoom] body=[&nbsp;] fade=[on]">
                <img src="<?php echo base_url ( $dto_pro->getThumb () ) ?>" alt="" border="0" width="150" height="150"/></a>
            <div class="thumbs"> 
                <?php
                $dto_img = new DTO_image();
                foreach ( $data['list_img'] as $dto_img )
                {
                    ?>
                    <a href="javascript:popImage('<?php echo base_url ( $dto_img->getUrl () ) ?>','Image')" title="header=[Thumb1] body=[&nbsp;] fade=[on]">
                        <img src="<?php echo base_url ( $dto_img->getUrl () ) ?>" alt="No img" border="0" width="25" height="25"/>
                    </a>
                    <?php
                }
                ?>

            </div>
        </div>
        <div class="details_big_box">
            <div class="product_title_big"><?php echo $dto_pro->getName () ?></div>
            <div class="specifications"> Description: 
                <span class="blue"><?php echo $dto_pro->getDescription () ?></span><br />
                Disponibilitate: <span class="blue">
                    <?php echo ($dto_pro->getQuantity () > 0) ? 'In stoc' : 'Out stoc' ?>
                </span><br />
                Price: 
                <span class="blue"><?php echo $dto_pro->getPrice () ?></span><br />
                Color:
                <span class="blue"><?php echo $dto_color->getName ()?></span><br />
            </div>
        </div>
        <div class="bottom_prod_box_big"></div>
    </div>
</div>
<?php
$list_pro = $this->m_product->get_similar_product ( $dto_pro->getPrice (), $dto_pro->getPro_id () );
?>
<div class="center_title_bar">Similar products</div>
<?php
foreach ( $list_pro as $dto_pro )
{
    ?>
    <div class="prod_box">
        <div class="top_prod_box"></div>
        <div class="center_prod_box">
            <div class="product_title">
                <a href="<?php echo base_url ( 'default/detail?pro_id=' . $dto_pro->getPro_id () ) ?>">
                    <?php echo $dto_pro->getName () ?></a>
            </div>
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
}?>