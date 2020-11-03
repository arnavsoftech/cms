<?php extract($gallery); ?>
<div class="page-header">
    <h3>Gallery Form</h3>
</div>
<?php echo form_open(admin_url('gallery/create/' . $id), array('class' => 'form-horizontal')); ?>
<!--<div class="form-group">
    <label class="col-sm-2 control-label">Language</label>

    <div class="col-sm-4">
        <?php
        $arr_lang = array(
            1 => 'English',
            2 => 'Hindi'
        );
        echo form_dropdown('lang_id', $arr_lang, $lang_id, 'class="form-control input-sm"');
        ?>
    </div>
</div>-->
<div class="form-group">
    <label for="name" class="col-sm-2 control-label">Gallery Name</label>

    <div class="col-sm-4">
        <input type="text" name="gallery_name" value="<?php echo set_value('gallery_name', $gallery_name); ?>"
               class="form-control input-sm"/>
    </div>
</div>
<div class="form-group">
    <label class="col-sm-2 control-label">Status</label>
    <div class="col-sm-2">
        <?php
        $arr_st = array(
            1 => 'Active',
            0 => 'Deactive'
        );
        echo form_dropdown('status', $arr_st, $status, 'class="form-control input-sm"');
        ?>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <button name="submit" value="Save" type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-floppy-disk"></i> Save
        </button>
        <a href="<?php echo admin_url('gallery'); ?>" class="btn btn-default btn-sm">Cancel</a>
    </div>
</div>
<?php echo form_close(); ?>