<div class="page-header">
	<h2>User Details</h2>
</div>
<div class="row">
	<div class="col-sm-12">
    	<?php echo form_open(admin_url('members/add/'.$m -> id), array('class' => 'form-horizontal')); ?>
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
        	<label class="col-sm-2">Email ID</label>
            <div class="col-sm-3">
            	<input type="text" name="frm[email_id]" value="<?php echo $m -> email_id; ?>" class="form-control input-sm" />
            </div>
            <label class="col-sm-1">Password</label>
            <div class="col-sm-2">
            	<input type="text" name="frm[pass]" value="<?php echo $m -> pass; ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
        	<label class="col-sm-2">Account Status</label>
            <div class="col-sm-3">
                <?php
                $st = array('Deactive', 'Active', 'Blocked');
                echo form_dropdown('frm[status]', $st, set_value('frm[status]', $m -> status), 'class="form-control input-sm"');
                ?>
            </div>
            <label class="col-sm-1">User Type</label>
            <div class="col-sm-2">
                <?php
                $adm = AI_User::getUserTypes();
                echo form_dropdown('frm[user_type]', $adm, set_value('frm[user_type]', $m -> user_type), 'class="form-control input-sm"');
                ?>
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
