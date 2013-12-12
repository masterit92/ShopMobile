<?php
$cate_pr= 1;
if ( isset ( $data['cat'] ) )
{
    $cate = new DTO_category();
    $cate = $data['cat'];
}
?>
<div id="content">
    <h1>Form Category</h1>
    <form action="<?php echo base_url ( 'admin/category/save' ) ?>" method="post">
        <?php
        if ( isset ( $cate ) )
        {
            $cat_id_current = $cate->getCat_id ();
            $cate_pr=$cate->getParent_id ()
            ?>
            <input type="hidden" name="cat_id" value="<?php echo $cate->getCat_id (); ?>"/>
        <?php } ?>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Information Category</span></legend>
            <ol>
                <li><label for="forename" title="Enter your forename" class="required">Role Name<span>*</span></label>
                    <input name="cat_name" type="text" id="cat_name" value="<?php echo isset ( $cate ) ? $cate->getName () : '' ?>" placeholder="Category Name" />	
                </li>
                <?php
                if (  $cate_pr!= 0 )
                {
                    ?>
                    <li><label for="forename" title="Enter your forename" class="required">Parent Category<span>*</span></label>
                        <select name="parent_id">
                            <option value="0">Root</option>
                            <?php
                            foreach ( $this->m_category->get_cat_by_parent_id ( 0 ) as $cate1 )
                            {
                                ?>
                                <option value="<?php echo $cate1->getCat_id () ?>"><?php echo $cate1->getName () ?></option>
                                <?php
                                foreach ( $this->m_category->get_cat_by_parent_id ( $cate1->getCat_id () ) as $cate2 )
                                {
                                    if ( $cat_id_current != $cate2->getCat_id () )
                                    {
                                        ?>
                                        <option value="<?php echo $cate2->getCat_id () ?>">&nbsp;&nbsp;&nbsp;<?php echo $cate2->getName () ?></option>
                                        <?php
                                    }
                                }
                            }
                            ?>
                        </select>	
                    </li>
<?php } ?>
            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="<?php echo isset ( $cate ) ? 'Edit' : 'Create' ?>" /></label>
        </fieldset>
    </form>
</div>
