<?php
if ( isset ( $data['role'] ) )
{
    $user = new DTO_role;
    $user = $data['role'];
}
?>
<div id="content">
    <h1>Form Role</h1>
    <form action="<?php echo  base_url('admin/role/save')?>" method="post">
        <?php if(isset($user)){?>
        <input type="hidden" name="role_id" value="<?php echo $user->getRole_id ();?>"/>
        <?php }?>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>Information Role</span></legend>
            <ol>
                <li><label for="forename" title="Enter your forename" class="required">Role Name:<span>*</span></label>
                    <input name="role_name" type="text" id="role_name" value="<?php echo isset ( $user ) ? $user->getName () : '' ?>" placeholder="Role Name" />	
                </li>
                <li>
                    <label for="surname" title="Enter your surname" class="required">Status<span>*</span></label>	
                    <select name="status">
                        <option value="1" <?php echo (isset ( $user ) && $user->getStatus () == 1) ? 'selected' : ''; ?>>Active</option>
                        <option value="0" <?php echo (isset ( $user ) && $user->getStatus () == 0) ? 'selected' : ''; ?>>No Active</option>
                    </select>
                </li>
            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="<?php echo isset($user)?'Edit Role' : 'Create Role'?>" /></label>
        </fieldset>
    </form>
</div>
