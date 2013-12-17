<?php
if ( isset ( $data['cat'] ) )
{
    $cat = new DTO_category();
    $cat = $data['cat'];
}
?>
<div id="content">
    <h1>Form Category</h1>
    <form action="<?php echo base_url ( 'admin/category/save' ) ?>" method="post" id="input_form">
        <?php
        if ( isset ( $cat ) )
        {
            ?>
            <input type="hidden" name="cat_id" value="<?php echo $cat->getCat_id (); ?>"/>
        <?php } ?>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Information Category</span></legend>
            <ol>
                <li><label for="forename" title="Enter your forename" class="required">Role Name<span>*</span></label>
                    <input name="cat_name" class="required" type="text" id="cat_name" value="<?php echo isset ( $cat ) ? $cat->getName () : '' ?>" placeholder="Category Name" />	
                </li>
                <li><label for="forename" title="Enter your forename" class="required">Parent Category<span>*</span></label>
                    <select name="parent_id">
                        <option value="0">Root</option>
                        <?php
                        $menus = $this->m_category->get_all_category ();

                        function show_menu ( $menus = array( ), $parrent = 0, $text = "--" )
                        {
                            $dto_cat = new DTO_category();

                            foreach ( $menus as $dto_cat )
                            {
                                if ( $dto_cat->getParent_id () == $parrent )
                                {
                                    $cat_id = $dto_cat->getCat_id ();
                                    if ( $cat_id != $_GET['id'] )
                                    {
                                        echo "<option value='$cat_id'>" . $text . $dto_cat->getName () . "</option>";
                                    }else{
                                        echo "<option value='$cat_id' disabled>" . $text . $dto_cat->getName () . "</option>";
                                    }
                                    show_menu ( $menus, $dto_cat->getCat_id (), $text . '--' );
                                }
                            }
                        }

                        show_menu ( $menus );
                        ?>
                    </select>	
                </li>

            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="<?php echo isset ( $cat ) ? 'Edit' : 'Create' ?>" />
            <input type="button" id="formsubmit" name="back" value="Back" onclick="javascript: history.go(-1)" />
        </fieldset>
    </form>
</div>