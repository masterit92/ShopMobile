<?php
if ( isset ( $data['count_img'] ) )
{
    $count_img = 4 - $data['count_img'];
}
?>

<div id="content">
    <h1>Form Image</h1>
    <form action="<?php echo base_url ( "admin/product/save_image" ) ?>" method="post" enctype="multipart/form-data">
        <?php
        if ( isset ( $data['img'] ) )
        {
            $dto_img = new DTO_image();
            $dto_img = $data['img'];
            ?>
            <input type="hidden" name="img_id" value="<?php echo $dto_img->getImg_id () ?>"/>
            <input type="hidden" name="url_old" value="<?php echo $dto_img->getUrl () ?>"/>
            <?php
        }
        if ( isset ( $_GET['pro_id'] ) )
        {
            ?>
            <input type="hidden" name="pro_id" value="<?php echo $_GET['pro_id'] ?>"/>
            <?php
        }
        if ( isset ( $count_img ) && $count_img > 0 )
        {
            ?>
            <input type="hidden" name="count_img" value="<?php echo $count_img ?>"/>
            <?php
        }
        ?>

        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Image</span></legend>
            <ol>
                <?php
                if ( isset ( $count_img ) )
                {
                    if ( $count_img <= 0 )
                    {
                        echo "<b>Product Max 4 Image!</b><br/>";
                    }
                    else
                    {
                        for ( $k = 0; $k < $count_img; $k++ )
                        {
                            ?>
                            <li><label for="forename"  class="required">Chooser Image<span>*</span></label>
                                <input name="img<?php echo $k ?>" type="file" id="img" value=""  />	
                            </li>
                            <?php
                        }
                    }
                }
                else
                {
                    ?>
                    <li><label for="forename"  class="required">Chooser Image<span>*</span></label>
                        <input name="img" type="file" id="img" value=""  />	
                    </li>    
                    <?php
                }
                ?>

            </ol>
        </fieldset>
        <fieldset id="submitform">
            <?php
            $flag = TRUE;
            if ( isset ( $count_img ) )
            {
                if ( $count_img <= 0 )
                {
                    $flag = FALSE;
                }
            }
            if ( $flag )
            {
                ?>

                <input type="submit" id="formsubmit" name="save" value="Save" />


            <?php } ?>
            <input type="button" id="formsubmit" name="back" value="Back" onclick="javascript: history.go(-1)" />
        </fieldset>
    </form>
</div>