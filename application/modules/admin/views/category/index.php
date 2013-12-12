<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    ?>

    <div class="css-treeview">
        <h1>Manager Category</h1>
        <ul>
            <?php
            $dto_cat = new DTO_category();
            $i = 0;
            foreach ( $data['list_cat'] as $dto_cat )
            {
                ?>
                <li><input type="checkbox" id="item-<?php echo $i ?>" /><label for="item-<?php echo $i ?>"><?php echo $dto_cat->getName () ?> 
                        <a href="<?php echo base_url ('admin/category/edit_status?id=').$dto_cat->getCat_id ().'&status='.$dto_cat->getStatus ()?>">
                            <?php echo ($dto_cat->getStatus () == 1) ? 'Active' : 'No Active' ?>
                        </a> | 
                        <a href="<?php echo base_url ('admin/category/edit?id=').$dto_cat->getCat_id ()?>">Edit</a>
                    </label>
                    <?php
                    if ( count ( $this->m_category->get_cat_by_parent_id ( $dto_cat->getCat_id () ) ) )
                    {
                        echo "<ul>";
                        $j = 0;
                        foreach ( $this->m_category->get_cat_by_parent_id ( $dto_cat->getCat_id () ) as $dto_cat )
                        {
                            ?>

                        <li><input type="checkbox" id="item-<?php echo $i . '-' . $j ?>" /><label for="item-<?php echo $i . '-' . $j ?>"><?php echo $dto_cat->getName () ?>
                                <a href="<?php echo base_url ('admin/category/edit_status?id=').$dto_cat->getCat_id ().'&status='.$dto_cat->getStatus ()?>">
                                    <?php echo ($dto_cat->getStatus () == 1) ? 'Active' : 'No Active' ?>
                                </a> |    
                                <a href="<?php echo base_url ('admin/category/edit?id=').$dto_cat->getCat_id ()?>">Edit</a> | 
                                <a href="<?php echo base_url ('admin/category/delete?id=').$dto_cat->getCat_id ()?>" onclick="return confirm('I want delete?')">Delete</a>
                            </label>
                            <?php
                            if ( count ( $this->m_category->get_cat_by_parent_id ( $dto_cat->getCat_id () ) ) )
                            {
                                echo "<ul>";
                                $k = 0;
                                foreach ( $this->m_category->get_cat_by_parent_id ( $dto_cat->getCat_id () ) as $dto_cat )
                                {
                                    ?>

                                <li><input type="checkbox" id="item-<?php echo $i . '-' . $j . '-' . $k ?>" /><label for="item-<?php echo $i . '-' . $j . '-' . $k ?>"><?php echo $dto_cat->getName () ?>
                                        <a href="<?php echo base_url ('admin/category/edit_status?id=').$dto_cat->getCat_id ().'&status='.$dto_cat->getStatus ()?>">
                                            <?php echo ($dto_cat->getStatus () == 1) ? 'Active' : 'No Active' ?>
                                        </a> |
                                        <a href="<?php echo base_url ('admin/category/edit?id=').$dto_cat->getCat_id ()?>">Edit</a> | 
                                        <a href="<?php echo base_url ('admin/category/delete?id=').$dto_cat->getCat_id ()?>" onclick="return confirm('I want delete?')">Delete</a>
                                    </label>

                                </li>
                                <?php
                                $k++;
                            }
                            echo "</ul> ";
                        }
                        ?>
                        </li>
                        <?php
                        $j++;
                    }
                    echo "</ul> ";
                }
                ?>
                </li>
                <?php
                $i++;
            }
            ?>
        </ul>
        <br/>
        <a href="<?php echo base_url ('admin/category/create')?>">Add New</a>
    </div>
    <?php
}?>