<div class="page-header">
	<h3>Modify Media</h3>
</div>
<div class="row-fluid">
	<?= form_open_multipart(admin_url('media/edit/'.$media -> id), array('class'=> 'form-horizontal')) ?>
    <div class="form-group">
		  <label class="col-sm-2">Image Title:</label>
		<div class="col-sm-5">
		  <input type="text" name="frm[seo_title]" value="<?= set_value('frm[seo_title]', $media -> seo_title); ?>" class="form-control input-sm">
		</div>
	</div>
    <div class="form-group">
		<label class="col-sm-2">Image File:</label>
		<div class="col-sm-8">
		  <img src="<?= base_url(upload_dir($media -> post_title)); ?>" width="100" class="thumbnail" />
          <input type="text" name="img_url" value="<?= base_url(upload_dir($media -> post_title)); ?>" class="form-control input-sm" />
		</div>
	</div>
	<input type="hidden" name="id" value="<?php echo $media -> id; ?>" />
	<div class="form-group">
		  <label class="col-sm-2">Image Alt</label>
		<div class="col-sm-2">
			<input type="text" name="frm[seo_description]" value="<?= set_value('frm[seo_description]', $media -> seo_description); ?>"	class="form-control input-sm" />
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-2">&nbsp;</label>
		<div class="col-sm-5">
		    <input type="submit" name="submit" class="btn btn-primary btn-sm" value="Update">
			<a href="<?= admin_url('media'); ?>" class="btn btn-sm btn-default">Cancel</a>
		</div>
	</div>
	<?php echo form_close(); ?>
</div>
