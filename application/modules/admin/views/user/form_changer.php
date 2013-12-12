<div id="content">
    <h1>Form Edit Profile User</h1>
    <form action="<?php echo base_url ( "admin/user/save" ) ?>" method="post">
        <input type="hidden" name="user_id" value="<?php echo $this->input->get ( 'id' ) ?>"/>
        <p><strong>Note:</strong> Items marked <span class="required">*</span> are required fields</p>
        <fieldset id="personal">
            <legend><span>User Information</span></legend>
            <ol>
                <li><label for="forename"  class="required">New Password<span>*</span></label>
                    <input name="password" type="password" id="password" value="" placeholder="Password"  />	
                </li>
                 <li>
                    <label for="email"  class="required">Re-Password<span>*</span></label>
                    <input type="password" id="re_password" name="re_password" placeholder="Re-Password" />
                </li>
                <li>
                    <label for="email"  class="required">Code<span>*</span></label>
                    <img src="<?php echo base_url ( 'public/backend/images/random_image.php' ) ?>" width="100" height="40" alt="No image" title="Confirmation code"/>
                </li>
                <li>
                    <label for="email"  class="required">Security code<span>*</span></label>
                    <input type="text" id="security_code" name="security_code" placeholder="Security code" /><br/>
                </li>
            </ol>
        </fieldset>
        <fieldset id="submitform">
            <input type="submit" id="formsubmit" name="save" value="Changer" /></label>
        </fieldset>
    </form>
</div>