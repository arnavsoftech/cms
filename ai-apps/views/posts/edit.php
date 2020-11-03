
<div class="page-header">
    <h2>Article</h2>
</div>
<?php echo form_open_multipart(admin_url('posts/edit/' . $p -> id), array('class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-sm-9">
      
        <div class="form-group">
            <label class="col-sm-2 control-label">Post Title</label>

            <div class="col-sm-10">
                <input type="text" name="form[post_title]" value="<?php echo set_value('form[post_title]', $p -> post_title); ?>"
                       class="form-control input-sm" placeholder="Post Title">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Slug</label>

            <div class="col-sm-10">
                <input type="text" name="form[slug]" class="form-control input-sm" placeholder="User Friendly Slug"
                       value="<?php echo set_value('form[slug]', $p -> slug); ?>"/>
            </div>
        </div>
       
        <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>

            <div class="col-sm-10">
                <textarea class="ckeditor" name="form[description]"><?php echo set_value('form[description]', $p -> description); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Featured Image</label>
            <div class="col-sm-10">
                <input type="file" name="image">
                <?php if($p -> image != ''){ ?>
                    <div style="text-align:center; padding:5px; border:1px solid #ddd;"><img src="<?php echo base_url(upload_dir($p -> image));?>" alt="current" class="img-responsive"/><br/>Current File<br />
                    </div>
                    <label class="checkbox-inline">
                        <input type="hidden" name="hid_img" value="<?php echo $p -> image; ?>" />
                        <input type="checkbox" name="del_img" value="1" />Delete this image
                    </label>
                <?php }?>
            </div>
        </div>
        

      
      
      
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>

            <div class="col-sm-2">
                <?php
                echo form_dropdown('form[status]', array(1 => 'Active', 0 => 'Deactive'), $p -> status, 'class="form-control input-sm"');
                ?>
            </div>
          
          
        </div>
    </div>
   
</div>

<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save
        </button>
        <a href="<?php echo admin_url('posts/senior_post'); ?>" class="btn btn-default btn-sm"><i
                class="fa fa-remove"></i> Cancel</a>
    </div>
</div>
</form>


