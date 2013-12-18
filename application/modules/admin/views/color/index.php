<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    ?>
    <table class="zebra">
        <caption>Manager Color</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $dto_color = new DTO_color();
            foreach ( $data['list_color'] as $dto_color )
            {
                ?>
                <tr>
                    <td><?php echo $dto_color->getColor_id () ?></td>
                    <td><?php echo $dto_color->getName () ?></td>
                    <td>
                        <a href="<?php echo base_url ( 'admin/color/edit' ); ?>?id=<?php echo $dto_color->getColor_id (); ?>">Edit</a>
                        <a href="<?php echo base_url ( 'admin/color/delete' ); ?>?id=<?php echo $dto_color->getColor_id (); ?>" onclick="return confirm('I want delete!');">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="3">
                    <a href="<?php echo base_url ( 'admin/color/create' ); ?>">Add New</a>
                </td>
            </tr>
        </tbody>
    </table>
<?php } ?>
