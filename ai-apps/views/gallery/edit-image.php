<div class="page-header">
    <h3>Edit Image</h3>
    <?php extract($image); ?>
</div>
<?php echo form_open(admin_url('gallery/edit_image/' . $id), array('class' => 'form-horizontal')); ?>
<div class="form-group">
    <label class="col-lg-2">Title</label>
    <div class="col-lg-8">
        <input type="text" name="title" value="<?php echo set_value('title', $title); ?>" class="form-control input-sm" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2">URL</label>
    <div class="col-lg-8">
        <input type="text" name="slug" value="<?php echo set_value('slug', $slug); ?>" class="form-control input-sm" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2">Description</label>

    <div class="col-lg-8">
        <textarea rows="4" cols="" name="description" class="form-control input-sm"><?php echo set_value('description', $description); ?></textarea>
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2">Image Thumbnail</label>

    <div class="col-lg-4">
        <img src="<?php echo base_url(upload_dir($image)); ?>" width="200" class="thumbnail" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2">Image Alt</label>

    <div class="col-lg-3">
        <input type="text" name="image_alt" value="<?php echo set_value('image_alt', $image_alt); ?>" class="form-control input-sm" />
    </div>
    <label class="col-lg-2">Image Title</label>

    <div class="col-lg-3">
        <input type="text" name="image_title" value="<?php echo set_value('image_title', $image_title); ?>" class="form-control input-sm" />
    </div>
</div>
<div class="form-group">
    <label class="col-lg-2">&nbsp;</label>

    <div class="col-lg-4">
        <input type="hidden" name="submit" value="Submit">
        <button type="submit" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-floppy-disk"></i> Save
        </button>
        <a href="<?php echo admin_url('gallery'); ?>" class="btn btn-default btn-sm">Cancel</a>
    </div>
</div>
<?php echo form_close(); ?>