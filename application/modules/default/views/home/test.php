<?php
$this->load->Model ( "m_category" );
$m_cat = new M_category();

$menus = $m_cat->get_all_category ( TRUE );

function show_menu_test ( $menus = array( ), $parrent = 0 )
{
    $model_cat = new M_category();
    $dto_cat = new DTO_category();
    echo "<div>";
    echo '<ul>';
    foreach ( $menus as $dto_cat )
    {
        if ( $dto_cat->getParent_id () == $parrent )
        {
            $flag = $model_cat->check_chiden ( $dto_cat->getCat_id () );
            echo '<li>';
            echo $flag ? '<a class="parent">' : '<a>';
            echo '<span>' . $dto_cat->getName () . '</span></a>';
            if ( $flag )
            {
                show_menu_ul ( $menus, $dto_cat->getCat_id (), $flag );
            }
            echo "</li>";
        }
    }
    echo "</ul></div>";
}

show_menu_test ( $menus );
?>