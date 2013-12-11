<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    $user_role = $data["list_role_user"];
    ?>
<form action="<?php echo base_url ('admin/authority/save')?>" method="post">
    <input type="hidden" name="user_id" value="<?php echo $user_role[0]['User_id']?>"/>
        <table class="zebra">
            <caption>Authority of <?php echo $user_role[0]['Full_name']?></caption>
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Manager</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $user = new DTO_role();
                foreach ( $data["list_role"] as $user )
                {
                    $check = NULL;
                    foreach ( $user_role as $value )
                    {
                        if ( $value['Role_id'] === $user->getRole_id () )
                        {
                            $check = 'checked';
                        }
                    }
               ?>
                    <tr>
                        <td><?php echo $user->getName (); ?></td>
                        <td>
                            <input  type="checkbox" value="<?php echo $user->getRole_id () ?>" name="check_role[]" <?php echo ($check!=NULL)? $check:''; ?>/>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td colspan="2" class="container">
                        <input type="submit" value="Save" name="save" />
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <?php
}
?>
