<?php
if ( isset ( $data['cat'] ) )
{
    $cat = new DTO_category();
    $cat = $data['cat'];
}
?>
<div id="content">
    <h1>Form Category</h1>
    <form action="<?php echo base_url ( 'admin/category/save' ) ?>" method="post">
        <?php
        if ( isset ( $cat ) )
        {
            $cat_id_current = $cat->getCat_id ();
            ?>
            <input type="hidden" name="cat_id" value="<?php echo $cat->getCat_id (); ?>"/>
        <?php } ?>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Information Category</span></legend>
            <ol>
                <li><label for="forename" title="Enter your forename" class="required">Role Name<span>*</span></label>
                    <input name="cat_name" type="text" id="cat_name" value="<?php echo isset ( $cat ) ? $cat->getName () : '' ?>" placeholder="Category Name" />	
                </li>
                <li><label for="forename" title="Enter your forename" class="required">Parent Category<span>*</span></label>
                    <select name="parent_id">
                        <option value="0">Root</option>
                        <?php
                        $menus = $this->m_category->get_all_category ();

                        function show_menu ( $menus = array( ), $parrent = 0 )
                        {
                            $gach='';
                            $dto_cat = new DTO_category();
                            foreach ( $menus as $dto_cat )
                            {
                                if ( $dto_cat->getParent_id () == $parrent )
                                {
                                    $gach.='--';
                                    $dto_cat->setName ($gach.$dto_cat->getName () );
                                    echo "<option>" . $dto_cat->getName ();
                                    show_menu ( $menus, $dto_cat->getCat_id () );
                                    echo '</option>';
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
            <input type="submit" id="formsubmit" name="save" value="<?php echo isset ( $cat ) ? 'Edit' : 'Create' ?>" /></label>
        </fieldset>
    </form>
</div>
