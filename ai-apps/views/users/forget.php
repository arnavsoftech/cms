<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Forget Password</title>
<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>

<body>
	<div class="container" style="margin-top:150px;">
    <?php
	$error = validation_errors();
	if($this -> session -> flashdata('error'))
		$error = $this -> session -> flashdata('error');
	if($error){
	?>
        <div class="alert alert-danger">
				<a class="close" data-dismiss="alert">&times;</a>
				<?php echo $error; ?>
        </div>
	<?php
	}
	?>
    	<div class="col-lg-6 col-lg-offset-3">
            <div class="box box-p">
                <h4>Forget Password</h4>
                <hr />
                <?php echo form_open(admin_url('users/forget'), array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <label class="col-sm-2" for="username">Email ID:</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="text" name="email_id" class="form-control" value="<?php echo set_value('email_id'); ?>"/>
                              <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">Get Now!</button>
                              </span>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="Submit" name="submit"/>
                <?php echo form_close(); ?>
                <hr />
                Already heve password. <a href="<?php echo admin_url('users/login'); ?>">Login now</a>
            </div>
        </div>
	</div>
    <div class="footer text-center" style="position: fixed; bottom: 0; width: 100%">
        Copyright &copy; <?php echo date('Y'); ?>. Version: 3.0.1
        <!--Version 1.1. Powered by <a href="http://www.arnavinfotech.com" title="Arnav Infotech" target="_blank">Arnav Infotech</a> -->
    </div>
</body>
</html>
