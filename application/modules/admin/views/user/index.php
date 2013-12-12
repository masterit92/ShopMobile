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
            $cate = new DTO_user();
            foreach ( $data["list_user"] as $cate )
            {
                ?>
                <tr>
                    <td><?php echo $cate->getUser_id (); ?></td>
                    <td><?php echo $cate->getEmail (); ?></td>
                    <td><?php echo $cate->getFull_name (); ?></td>
                    <td>
                        <?php
                        if ( $cate->getStatus () > 0 )
                        {
                            echo '<a href="'.base_url ('admin/user/edit_status?id=').$cate->getUser_id ().'&status='.$cate->getStatus ().'">Active</a>';
                        }
                        else
                        {
                            echo '<a href="'.base_url ('admin/user/edit_status?id=').$cate->getUser_id ().'">No Active</a>';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="<?php echo base_url ("admin/authority/index?user_id=").$cate->getUser_id (); ?>">Authority</a>
                        <a href="<?php echo base_url ('admin/user/delete?id=').$cate->getUser_id (); ?>" onclick="return confirm('I want delete!');">Delete</a>
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
