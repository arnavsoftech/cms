<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <title>Login</title>
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
</head>

<body>
<div class="container" style="margin-top:150px;">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="box">
            <div class="box-header">
                <h4 class="box-title">Secure Login</h4>
            </div>
            <div class="box-p">
                <?php
                if ($this->session->flashdata('error')) {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php
                }
                ?>
                <?php $err = validation_errors();
                if ($err != '') {
                    ?>
                    <div class="alert alert-danger">
                        <?php echo $err; ?>
                    </div>
                <?php
                }
                ?>
                <?php echo form_open(admin_url('users/login'), array('class' => 'form-horizontal')); ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="username">Email Id:</label>

                    <div class="col-lg-6">
                        <input type="text" name="username" value="<?php echo set_value('username'); ?>"
                               class="form-control input-sm"  placeholder="Email Id"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label" for="password">Password:</label>

                    <div class="col-lg-6">
                        <input type="password" name="password" class="form-control input-sm"
                               value="<?php echo set_value('password'); ?>" placeholder="Password"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-6 col-lg-offset-3">
                        <input type="hidden" value="Login" name="submit"/>
                        <button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-lock"></i> Login</button>
                    </div>
                </div>
                <input type="hidden" value="" name="redirect"/>
                <input type="hidden" value="submitted" name="submitted"/>
                <?php echo form_close(); ?>
            </div>
            <div class="box-bt box-p">
                <a href="<?= admin_url('users/forget'); ?>">Forgot Password</a>
                <a href="<?= site_url(); ?>" class="pull-right">Back to Website</a>
            </div>
        </div>
    </div>
</div>
</div>
<div class="footer text-center" style="position: fixed; bottom: 0; width: 100%">
    Copyright &copy; <?php echo date('Y'); ?>. Version: 3.0.1
    <!--Version 1.1. Powered by <a href="http://www.arnavinfotech.com" title="Arnav Infotech" target="_blank">Arnav Infotech</a> -->
</div>
</body>
</html>
