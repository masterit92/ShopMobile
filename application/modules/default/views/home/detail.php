<?php
$dto_pro= new DTO_product();
$dto_pro=$data['pro'];
?>
<div class="center_title_bar">Motorola 156 MX-VL</div>
<div class="prod_box_big">
    <div class="top_prod_box_big"></div>
    <div class="center_prod_box_big">
        <div class="product_img_big"> <a href="javascript:popImage('<?php echo base_url ($dto_pro->getThumb ())?>','Some Title')" title="header=[Zoom] body=[&nbsp;] fade=[on]">
                <img src="<?php echo base_url ($dto_pro->getThumb ())?>" alt="" border="0" width="150" height="150"/></a>
            <div class="thumbs"> 
                <a href="#" title="header=[Thumb1] body=[&nbsp;] fade=[on]">
                    <img src="images/thumb1.gif" alt="" border="0" />
                </a> <a href="#" title="header=[Thumb2] body=[&nbsp;] fade=[on]">
                    <img src="images/thumb1.gif" alt="" border="0" /></a> 
                <a href="#" title="header=[Thumb3] body=[&nbsp;] fade=[on]">
                    <img src="images/thumb1.gif" alt="" border="0" /></a> </div>
        </div>
        <div class="details_big_box">
            <div class="product_title_big"><?php echo  $dto_pro->getName ()?></div>
            <div class="specifications"> Description: 
                <span class="blue"><?php echo $dto_pro->getDescription ()?></span><br />
                Disponibilitate: <span class="blue">
                    <?php echo ($dto_pro->getQuantity ()>0)?'In stoc':'Out stoc'?>
                </span><br />
                Price: 
                <span class="blue"><?php echo $dto_pro->getPrice ()?></span><br />
            </div>
    </div>
    <div class="bottom_prod_box_big"></div>
</div>
</div>