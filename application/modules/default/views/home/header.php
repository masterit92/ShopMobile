<?php
if ( !isset ( $_POST['data_pro'] ) )
{
    $list_pro = 0;
}
else
{
    $list_pro = $_POST['data_pro'];
    if($list_pro>4){
        $list_pro=0;
    }
}
$this->load->Model ( "m_product" );
$m_pro = new M_product();
$five_pro = $m_pro->get_limit_product ();
$dto_pro = new DTO_product();
$dto_pro = $five_pro[$list_pro];
$list_pro ++;
?>
<script>
    $(function() {
        $(".pro").click(function() {
            pro_id = $(this).attr("pro_id");
            $('#header').load("<?php echo base_url ( 'default/load_header' ); ?>", {data_pro: pro_id});
        });
        setInterval(function() {
            $('#header').load("<?php echo base_url ( 'default/load_header' ); ?>", {data_pro: <?php echo $list_pro ?>});
            //alert();
        }, 6000);
    });
</script>
<div id="header">
    <div id="logo"> 
        <a href="#">
            <img src="<?php echo base_url ( 'public/fontend/images/logo.png' ) ?>" alt="" border="0" width="237" height="140" />
        </a> </div>
    <div class="oferte_content">
        <div class="top_divider">
            <img src="<?php echo base_url ( 'public/fontend/images/header_divider.png' ) ?>" alt="" width="1" height="164" />
        </div>
        <div class="oferta">
            <div class="oferta_content" id="oferta"> 
                <img src="<?php echo base_url ( $dto_pro->getThumb () ) ?>" width="94" height="92" alt="" border="0" class="oferta_img" />
                <div class="oferta_details">
                    <div class="oferta_title"><?php echo $dto_pro->getName () ?></div>
                    <div class="oferta_text"><?php echo $dto_pro->getDescription () ?></div>
                    <a href="<?php echo base_url ( "default/detail?pro_id=" . $dto_pro->getPro_id () ) ?>" class="details">Details</a> </div>
            </div>
            <div class="oferta_pagination"> 
                <?php
                $cur = 0;
                if ( isset ( $_POST['data_pro'] ) )
                    $cur = $_POST['data_pro'];
                for ( $i = 0; $i < 5; $i++ )
                {
                    ?>
                <a href="#" <?php echo ($i == $cur) ? 'class="current pro"' : 'class="pro"' ?> pro_id="<?php echo $i ?>"> <?php echo $i + 1; ?> </a> 
    <?php
}
?>
            </div>
        </div>
        <div class="top_divider"><img src="<?php echo base_url ( 'public/fontend/images/header_divider.png' ) ?>" alt="" width="1" height="164" /></div>
    </div>
    <!-- end of oferte_content-->
</div>