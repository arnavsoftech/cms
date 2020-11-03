<div class="page-header">
    <h2>Global Settings</h2>
</div>
<?php
$arr_default['logo'] = theme_url('images/logo.jpg');
$arr_default['meta_title'] = 'Red Shed Santa - Official Website';
$arr_default['slider_video'] = null;

$arr_default['header_block'] = '';
$arr_default['body_start'] = '';
$arr_default['body_end'] = '';
$arr_default['banner_id'] = '';
$arr_default['email_id'] = '';
$arr_default['contact_no'] = '';
$arr_default['address'] = '';
$arr_default['donation_text'] = '';
$arr_default['footer_about'] = '';

$arr_default['pinterest'] = '';
$arr_default['facebook'] = '';
$arr_default['twitter'] = '';
$arr_default['instagram'] = '';
$arr_default['youtube'] = '';
$arr_default['linkedin'] = '';




$_GET['options'] = $options;
$_GET['default'] = $arr_default;
function get_option($fname)
{
    $arr_options = $_GET['options'];
    $arr_default = $_GET['default'];
    if (isset($arr_options[$fname])) {
        return $arr_options[$fname];
    } else {
        if (isset($arr_default[$fname])) {
            return $arr_default[$fname];
        } else {
            return NULL;
        }
    }
}
?>
<?php echo form_open(admin_url('settings'), array('class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <div class="form-group">
            <label class="col-sm-2 control-label">Logo</label>
            <div class="col-sm-8">
                <input type="text" name="logo" value="<?= get_option('logo'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Slider Video</label>
            <div class="col-sm-8">
                <input type="url" name="slider_video" value="<?= get_option('slider_video'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Footer about</label>
            <div class="col-sm-8">
                <input type="text" name="footer_about" value="<?= get_option('footer_about'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Title</label>
            <div class="col-sm-8">
                <input type="text" name="meta_title" value="<?= get_option('meta_title'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Donation Text</label>
            <div class="col-sm-8">
                <input type="text" name="donation_text" value="<?= get_option('donation_text'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Banner ID</label>
            <div class="col-sm-3">
                <input type="text" name="banner_id" value="<?= get_option('banner_id'); ?>" placeholder="Gallery ID for banners" class="form-control input-sm" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Email Id</label>
            <div class="col-sm-3">
                <input type="text" name="email_id" value="<?= get_option('email_id'); ?>" class="form-control input-sm" />
            </div>
            <label class="col-sm-2 control-label">Conact no</label>
            <div class="col-sm-3">
                <input type="text" name="contact_no" value="<?= get_option('contact_no'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Address</label>
            <div class="col-sm-8">
                <input type="text" name="address" value="<?= get_option('address'); ?>" class="form-control input-sm" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Pinterest</label>
            <div class="col-sm-8">
                <input type="text" name="pinterest" value="<?= get_option('pinterest'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Facbook</label>
            <div class="col-sm-8">
                <input type="text" name="facebook" value="<?= get_option('facebook'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Twitter</label>
            <div class="col-sm-8">
                <input type="text" name="twitter" value="<?= get_option('twitter'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Instagram</label>
            <div class="col-sm-8">
                <input type="text" name="instagram" value="<?= get_option('instagram'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Youtube</label>
            <div class="col-sm-8">
                <input type="text" name="youtube" value="<?= get_option('youtube'); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">LinkedIn</label>
            <div class="col-sm-8">
                <input type="text" name="linkedin" value="<?= get_option('linkedin'); ?>" class="form-control input-sm" />
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Header Block</label>
            <div class="col-sm-8">
                <textarea name="header_block" class="form-control input-sm" rows="5" placeholder="Place code to put in header block"><?= get_option('header_block'); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">After Body Start</label>
            <div class="col-sm-8">
                <textarea name="body_start" class="form-control input-sm" rows="5" placeholder="Place code to put in header block"><?= get_option('body_start'); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Before Body End</label>
            <div class="col-sm-8">
                <textarea name="body_end" class="form-control input-sm" rows="5" placeholder="Place code to put in header block"><?= get_option('body_end'); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2">&nbsp;</label>
            <div class="col-sm-5">
                <input type="submit" name="submit" value="Save Settings" class="btn btn-primary btn-sm" />
                <a href="<?= admin_url('settings/restore'); ?>" class="btn btn-sm btn-default reset">Restore Default</a>
            </div>
        </div>
    </div>
    <?php
    $str = '';
    if (is_array($arr_default) && count($arr_default) > 0) {
        foreach ($arr_default as $key => $val) {
            $str .= $key . ',';
        }
    }
    $str = rtrim($str, ',');
    ?>
    <input type="hidden" name="fields" value="<?= $str; ?>" />
</div>
<script>
    $(document).ready(function() {
        $('.reset').click(function() {
            if (!confirm('It will RESET all values. Are you sure to proceed?'))
                return false;
        });
    });
</script>
<?= form_close(); ?>