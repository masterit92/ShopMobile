<?php
if (!is_array($data)) 
{
    echo '<b>'.$data.'</b>';
} else {
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
            foreach ($data as $user) {
                ?>
                <tr>
                    <td><?php echo $user->getUser_id();?></td>
                    <td><?php echo $user->getEmail();?></td>
                    <td><?php echo $user->getFull_name();?></td>
                    <td>
                        <?php 
                             if($user->getStatus()>0){
                                 echo 'Active';
                             }else{
                                 echo 'No Active';
                             }
                        ?>
                    </td>
                    <td>
                        <a href="#">Edit</a>
                        <a href="#">Delete</a>
                    </td>
                </tr>
        <?php
    }
    ?>
        </tbody>
    </table>
    <?php
}
?>
