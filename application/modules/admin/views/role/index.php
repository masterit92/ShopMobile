<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    ?>
    <table class="zebra">
        <caption>Manager Role</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Module</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user = new DTO_role();
            foreach ( $data["list_role"] as $user )
            {
                ?>
                <tr>
                    <td><?php echo $user->getRole_id (); ?></td>
                    <td><?php echo $user->getName (); ?></td>
                    <td>
                        <?php
                        if ( $user->getStatus () > 0 )
                        {
                            echo 'Active';
                        }
                        else
                        {
                            echo 'No Active';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url ('admin/role/edit'); ?>?id=<?php echo $user->getRole_id (); ?>">Edit</a>
                        <a href="<?php echo base_url ('admin/role/delete'); ?>?id=<?php echo $user->getRole_id (); ?>" onclick="return confirm('I want delete!');">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="4">
                    <a href="<?php echo base_url ('admin/role/create'); ?>">Add New</a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}
?>
