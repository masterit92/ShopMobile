<?php
$cate_pr= 1;
if ( isset ( $data['pro'] ) )
{
    $pro = new DTO_product();
    $pro = $data['pro'];
}
?>
<div id="content">
    <h1>Form Product</h1>
    <form action="<?php echo base_url ( 'admin/product/save' ) ?>" method="post" enctype="multipart/form-data" id="input_form">
        <?php
        if ( isset ( $pro ) )
        {
            ?>
        <input type="hidden" name="pro_id" value="<?php echo $pro->getPro_id (); ?>"/>
        <input type="hidden" name="img_old" value="<?php echo $pro->getThumb (); ?>"/>
        <?php } ?>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Information Product</span></legend>
            <ol>
                <li><label for="forename" title="Enter your forename" class="required">Product Name<span>*</span></label>
                    <input name="pro_name" class="required" type="text" id="pro_name" value="<?php echo isset ( $pro ) ? $pro->getName () : '' ?>" placeholder="Product Name" />	
                </li>
                <li><label for="forename" title="Enter your forename" class="">Thumb<span>*</span></label>
                   <?php echo isset ( $pro ) ? '<img src='.  base_url ($pro->getThumb ()).' width="100" height="100"/>' : '' ?>
                    <input name="thumb"  type="file" id="thumb"  placeholder="Thumb" />
                </li>
                <li><label for="forename" title="Enter your forename" class="required">Price<span>*</span></label>
                    <input name="price" class="required" type="text" id="price" value="<?php echo isset ( $pro ) ? $pro->getPrice () : '' ?>" placeholder="Price" />	
                </li>
                <li><label for="forename" title="Enter your forename" class="required">Description<span>*</span></label>
                    <input name="description" type="text" id="description" value="<?php echo isset ( $pro ) ? $pro->getDescription () : '' ?>" placeholder="Description" />	
                </li>
                 <li><label for="forename" title="Enter your forename" class="required">Quantity<span>*</span></label>
                     <input name="quantity" class="required" type="text" id="quantity" value="<?php echo isset ( $pro ) ? $pro->getQuantity () : '' ?>" placeholder="Quantity" />	
                </li>
            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="<?php echo isset ( $pro ) ? 'Edit' : 'Create' ?>" />
            <input type="button" id="formsubmit" name="back" value="Back" onclick="javascript: history.go(-1)" />
        </fieldset>
    </form>
</div>
