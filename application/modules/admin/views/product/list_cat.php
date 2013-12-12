<?php
if(!isset($_GET['pro_id'])){
    $_GET['pro_id']=$data['pro_id']
;}
?>
<form action="<?php echo base_url ( "admin/product/set_category_product" ) ?>" method="post">
    <input type="hidden" value="<?php echo $_GET['pro_id']?>" name="pro_id"/>
    <div class="">
        <?php
        $menus = $this->m_category->get_all_category ();

        function show_menu ( $menus = array( ), $parrent = 0 )
        {
            $i = 0;
            if ( $i == 0 )
            {
                $arr_cat_id = array( );
                $dto_cat_pro = new DTO_cat_and_pro();
                $m_pro= new M_product();
                foreach ( $m_pro->get_cat_by_pro_id ( $_GET['pro_id'] ) as $dto_cat_pro )
                {
                    $arr_cat_id[] = $dto_cat_pro->getCat_id ();
                }
            }
            $i++;
            $dto_cat = new DTO_category();
            foreach ( $menus as $dto_cat )
            {
                echo '<ul>';
                if ( $dto_cat->getParent_id () == $parrent )
                {
                    echo "<li>" . $dto_cat->getName ();
                    ?>
                    <input type="checkbox" name="cb_cat_id[]" value="<?php echo $dto_cat->getCat_id () ?>" <?php echo in_array ( $dto_cat->getCat_id (), $arr_cat_id )?'checked':'' ?>/>
                    <?php
                    show_menu ( $menus, $dto_cat->getCat_id () );
                    echo '</li>';
                }
                echo '</ul>';
            }
        }

        show_menu ( $menus );
        ?>
    </div>
    <input type="submit" value="Save" name="pro_cat"/>
</form>