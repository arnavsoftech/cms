<div class="page-header">
	<h2>Personal Profile</h2>
</div>
<div class="row">
	<div class="col-sm-12">
    	<?php echo form_open(admin_url('dashboard/profile'), array('class' => 'form-horizontal')); ?>
        <div class="form-group">
        	<label class="col-sm-2">Full name</label>
            <div class="col-sm-3">
            	<input type="text" name="frm[first_name]" value="<?php echo $m -> first_name; ?>" class="form-control input-sm" />
            </div>
            <div class="col-sm-3">
            	<input type="text" name="frm[last_name]" value="<?php echo $m -> last_name; ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
        	<label class="col-sm-2">Phone no</label>
            <div class="col-sm-3">
            	<input type="text" name="frm[phone_no]" value="<?php echo $m -> phone_no; ?>" class="form-control input-sm" />
            </div>
	        <label class="col-sm-1">Gender</label>
	        <div class="col-sm-3">
		        <label class="radio radio-inline"><input type="radio" name="frm[gender]" value="Male" <?php if($m -> gender == 'Male') echo 'checked'; ?> /> Male</label>
		        <label class="radio radio-inline"><input type="radio" name="frm[gender]" value="Female" <?php if($m -> gender == 'Female') echo 'checked'; ?> /> Female</label>
	        </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Mobile no</label>
            <div class="col-sm-3">
                <input type="text" name="frm[mobile_no]" value="<?php echo $m -> mobile_no; ?>" class="form-control input-sm" />
                <?php
                if($m -> mobile_verified == 1){
                    ?>
                    <span class="small text-success"><i class="fa fa-check"></i></span> Verified
                    <?php
                }else{
                    ?>
                    <span class="small text-danger"><i class="fa fa-times"></i></span> <a href="<?= admin_url('dashboard/verify'); ?>">Not Verified</a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="form-group">
        	<label class="col-sm-2">City</label>
            <div class="col-sm-3">
                <input type="text" name="frm[city]" value="<?php echo $m -> city; ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">Address</label>
            <div class="col-sm-6">
                <input type="text" name="frm[address]" value="<?php echo $m -> address; ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-2">
                <div class="box box-p">
                    <span class="text-danger">If you dont want to change password. Leave it empty.</span><br />
                    <label>New Password</label>
                    <input type="password" name="pass1" value="" class="form-control" placeholder="Password" />
                </div>
            </div>
        </div>
        <div class="form-group">
        	<label class="col-sm-2">&nbsp;</label>
            <div class="col-sm-10">
            	<input type="submit" name="submit" value="Save Details" class="btn btn-sm btn-primary" />
                <a href="<?= admin_url('members'); ?>" class="btn btn-sm btn-default">Cancel</a>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
