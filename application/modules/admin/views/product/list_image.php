<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    $dto_img = new DTO_image();
    $arr_img = $data['list_img'];
    ?>
    <table class="zebra">
        <caption>Manager Images</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ( count ( $arr_img ) > 0 )
            {
                foreach ( $arr_img as $dto_img )
                {
                    ?>
                    <tr>
                        <td><?php echo $dto_img->getImg_id () ?></td>
                        <td><img src="<?php echo base_url ( $dto_img->getUrl () ) ?>" width="100" height="100"/></td>
                        <td >
                            <a href="<?php echo base_url ( "admin/product/edit_image?img_id=" . $dto_img->getImg_id () . "&pro_id=" . $dto_img->getPro_id () ) ?>">Edit</a> |
                            <a href="<?php echo base_url ( "admin/product/delete_image?img_id=" . $dto_img->getImg_id () . "&pro_id=" . $_GET['pro_id'] ) ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
            }
            else
            {
                echo "<tr><td colspan='3'><b>No Data!</b></td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="<?php echo base_url ( "admin/product/create_image?pro_id=" . $_GET['pro_id'] ) ?>">Add New</a>
     | <a href='javascript: history.go(-1)' ><b>Back</b></a>
    <?php
}?>