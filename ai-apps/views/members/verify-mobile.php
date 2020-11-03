<div class="page-header">
	<h2>OTP</h2>
</div>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Enter OTP</h4>
            </div>
            <div class="box-p">
                <p>Please enter the OTP Sent on your mobile.</p>
                <?= form_open(admin_url('dashboard/verify'), array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <label class="col-sm-4">OTP</label>
                    <div class="col-sm-7">
                        <input type="text" name="otp" value="" required="required" class="form-control input-sm" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="submit" value="Verify" class="btn btn-sm btn-primary" />
                    </div>
                </div>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>