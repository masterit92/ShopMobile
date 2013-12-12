<?php
if ( isset ( $data["error"] ) && !$data['error'] )
{
    echo '<b>Khong co quyen truy cap.</b>';
}
else
{
    ?>
    <table class="zebra">
        <caption>Manager Product</caption>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Thumb</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $pro = new DTO_product();
            foreach ( $data["list_pro"] as $pro )
            {
                ?>
                <tr>
                    <td><?php echo $pro->getPro_id (); ?></td>
                    <td><?php echo $pro->getName (); ?></td>
                    <td>
                        <img src=" <?php echo base_url($pro->getThumb ()); ?>" width="100" height="100"/>
                    </td>
                    <td><?php echo $pro->getQuantity (); ?></td>
                    <td>
                        <a href="<?php echo base_url ( 'admin/product/edit_status?id=' ) . $pro->getPro_id () . '&status=' . $pro->getStatus () ?>"> 
                            <?php echo ($pro->getStatus ()== 1)? 'Active':'No Active' ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo base_url ( 'admin/product/view_image?pro_id='.$pro->getPro_id ()); ?>">Image</a> | 
                        <a href="<?php echo base_url ( 'admin/product/set_category_product?pro_id='.$pro->getPro_id () ); ?>">Category</a> | 
                        <a href="<?php echo base_url ( 'admin/product/edit?id='.$pro->getPro_id () ); ?>">Edit</a> | 
                        <a href="<?php echo base_url ( 'admin/product/delete?id='. $pro->getPro_id () ); ?>" onclick="return confirm('I want delete!');">Delete</a>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="6">
                    <a href="<?php echo base_url ( 'admin/product/create' ); ?>">Add New</a>
                </td>
            </tr>
        </tbody>
    </table>
    <?php
}
?>