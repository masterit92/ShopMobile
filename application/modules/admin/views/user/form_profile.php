<?php
$dto_user = new DTO_user();
$dto_user = $data['user'];
?>
<div id="content">
    <h1>Form Edit Profile User</h1>
    <form action="<?php echo base_url ( "admin/user/save" ) ?>" method="post">
        <input type="hidden" name="user_id" value="<?php echo $this->input->get ( 'id' ) ?>"/>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>User Information</span></legend>
            <ol>
                <li><label for="forename"  class="required">Full Name<span>*</span></label>
                    <input name="full_name" type="text" id="full_name" value="<?php echo $dto_user->getFull_name ()?>" placeholder="Full Name"  />	
                </li>
            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="Edit Profile" /></label>
        </fieldset>
    </form>
</div>