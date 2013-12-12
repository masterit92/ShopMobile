<?php
if (isset($data["error"]) && !$data['error'])
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    ?>
    <table class="zebra">
        <caption>Manager user</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $user = new DTO_user();
            foreach ( $data["list_user"] as $user )
            {
                ?>
                <tr>
                    <td><?php echo $user->getUser_id (); ?></td>
                    <td><?php echo $user->getEmail (); ?></td>
                    <td><?php echo $user->getFull_name (); ?></td>
                    <td>
                        <?php
                        if ( $user->getStatus () > 0 )
                        {
                            echo '<a href="'.base_url ('admin/user/edit_status?id=').$user->getUser_id ().'&status='.$user->getStatus ().'">Active</a>';
                        }
                        else
                        {
                            echo '<a href="'.base_url ('admin/user/edit_status?id=').$user->getUser_id ().'">No Active</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url ("admin/authority/index?user_id=").$user->getUser_id (); ?>">Authority</a>
                        <a href="<?php echo base_url ('admin/user/delete?id=').$user->getUser_id (); ?>" onclick="return confirm('I want delete!');">Delete</a>
                    </td>
                </tr>
   <?php
    }
    ?>
            <tr>
                <td colspan="5">
                    <a href="<?php echo base_url ('admin/user/create'); ?>">Add New</a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}
?>
