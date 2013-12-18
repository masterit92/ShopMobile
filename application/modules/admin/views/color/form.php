<?php
if ( isset ( $data['color'] ) )
{
    $color = new DTO_color();
    $color = $data['color'];
}
?>
<div id="content">
    <h1>Form Role</h1>
    <form action="<?php echo base_url ( 'admin/color/save' ) ?>" method="post" id="input_form">
        <?php if ( isset ( $color ) )
        {
            ?>
            <input type="hidden" name="color_id" value="<?php echo $color->getColor_id (); ?>"/>
<?php } ?>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Information Role</span></legend>
            <ol>
                <li><label for="forename" title="Enter your forename" class="required">Role Name:<span>*</span></label>
                    <input name="color_name" class="required" type="text" id="role_name" value="<?php echo isset ( $color ) ? $color->getName () : '' ?>" placeholder="Role Name" />	
                </li>
            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="<?php echo isset ( $color ) ? 'Edit Color' : 'Create Color' ?>" />
            <input type="button" id="formsubmit" name="back" value="Back" onclick="javascript: history.go(-1)" />
        </fieldset>
    </form>
</div>
