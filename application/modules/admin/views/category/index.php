<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    ?>
<div class="treeview_cat"> 
        <?php
        $menus = $data['list_cat'];

        function show_menu ( $menus = array( ), $parrent = 0, $text="&triangleright;" )
        {
            $dto_cat = new DTO_category();
            foreach ( $menus as $dto_cat )
            {
                if ( $dto_cat->getParent_id () == $parrent )
                {
                    echo $text . $dto_cat->getName ();
                    ?>
                    <a href="<?php echo base_url ( 'admin/category/edit_status?id=' ) . $dto_cat->getCat_id () . '&status=' . $dto_cat->getStatus () ?>">
                    <?php echo ($dto_cat->getStatus () == 1) ? 'Active' : 'No Active' ?>
                    </a> |
                    <a href="<?php echo base_url ( 'admin/category/edit?id=' ) . $dto_cat->getCat_id () ?>">Edit</a> | 
                    <a href="<?php echo base_url ( 'admin/category/delete?id=' ) . $dto_cat->getCat_id () ?>" onclick="return confirm('I want delete?')">Delete</a>
                <?php
                echo "<br/><br/>";
                show_menu ( $menus, $dto_cat->getCat_id () ,$text.'&triangleright;&triangleright;&triangleright;');
            }
        }
    }

    show_menu ( $menus );
    ?>
    </div>
    <a href="<?php echo base_url ( 'admin/category/create' ) ?>">Add New</a>
        <?php
    }?>