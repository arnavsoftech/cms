<div class="page-header">
    <h2>Post</h2>
</div>
<?php echo form_open_multipart(admin_url('posts/add-post/' . $p->id), array('class' => 'form-horizontal')); ?>
<div class="row">
    <div class="col-sm-9">
        <div class="form-group">
            <label class="col-sm-2 control-label">Parent</label>
            <div class="col-sm-3">
                <?php
                echo form_dropdown('form[parent_id]', $parents, set_value('form[parent_id]', $p->parent_id), 'class="form-control input-sm"'); ?>
            </div>
            <input type="hidden" name="form[lang_id]" value="1">
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Post Title</label>

            <div class="col-sm-10">
                <input type="text" name="form[post_title]" value="<?php echo set_value('form[post_title]', $p->post_title); ?>" class="form-control input-sm" placeholder="Post Title">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Slug</label>

            <div class="col-sm-7">
                <input type="text" name="form[slug]" class="form-control input-sm" placeholder="User Friendly Slug" value="<?php echo set_value('form[slug]', $p->slug); ?>" />
            </div>
            <label class="col-sm-1 control-label">Sequence</label>

            <div class="col-sm-2">
                <input type="number" name="form[sequence]" class="form-control input-sm" value="<?php echo set_value('form[sequence]', $p->sequence); ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Excerpt</label>

            <div class="col-sm-10">
                <textarea rows="3" name="form[excerpt]" cols="" class="form-control input-sm malyalam" placeholder="Small Description about post"><?php echo set_value('form[excerpt]', $p->excerpt); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>

            <div class="col-sm-10">
                <textarea class="ckeditor" name="form[description]"><?php echo set_value('form[description]', $p->description); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Featured Image</label>
            <div class="col-sm-10">
                <input type="file" name="image">
                <?php if ($p->image != '') { ?>
                    <div style="text-align:center; padding:5px; border:1px solid #ddd;"><img src="<?php echo base_url(upload_dir($p->image)); ?>" alt="current" class="img-responsive" /><br />Current File<br />
                    </div>
                    <label class="checkbox-inline">
                        <input type="hidden" name="hid_img" value="<?php echo $p->image; ?>" />
                        <input type="checkbox" name="del_img" value="1" />Delete this image
                    </label>
                <?php } ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Attachment</label>
            <div class="col-sm-6">
                <input type="file" name="attachment" />
                <?php
                if ($p->attachment <> '') {
                ?>
                    <p><a target="_blank" href="<?= base_url(upload_dir($p->attachment)); ?>"><?= $p->attachment; ?></a></p>
                    <label class="checkbox checkbox-inline"><input type="checkbox" name="del_at" value="1" /> Delete</label>
                    <input type="hidden" name="hid_at" value="<?= $p->attachment; ?>" />

                <?php
                }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">SEO Title</label>

            <div class="col-sm-8">
                <input type="text" name="form[seo_title]" class="form-control input-sm" value="<?php echo set_value('form[seo_title]', $p->seo_title); ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Meta Description</label>

            <div class="col-sm-8">
                <textarea name="form[seo_description]" rows="3" cols="" class="form-control input-sm"><?php echo set_value('form[seo_description]', $p->seo_description); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Meta Keywords</label>

            <div class="col-sm-8">
                <textarea name="form[seo_keywords]" rows="3" cols="" class="form-control input-sm"><?php echo set_value('form[seo_keywords]', $p->seo_keywords); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>

            <div class="col-sm-2">
                <?php
                echo form_dropdown('form[status]', array(1 => 'Active', 0 => 'Deactive'), $p->status, 'class="form-control input-sm"');
                ?>
            </div>
            <label class="col-sm-2 control-label">Google No Follow</label>

            <div class="col-sm-2">
                <label class="checkbox-inline">
                    <input type="checkbox" name="no_follow" value="1" <?php if ($p->no_follow) echo 'Checked'; ?> /> Yes
                </label>
            </div>
            <label class="col-sm-2 control-label">Featured Article</label>

            <div class="col-sm-2">
                <label class="checkbox-inline">
                    <input type="checkbox" name="featured" value="1" <?php if ($p->featured) echo 'Checked'; ?> /> Yes
                </label>
            </div>
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-sm-2"></div>
    <div class="col-sm-10">
        <button type="submit" name="submit" value="Submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Save
        </button>
        <a href="<?php echo admin_url('posts'); ?>" class="btn btn-default btn-sm"><i class="fa fa-remove"></i> Cancel</a>
    </div>
</div>
</form>


<script type="text/javascript">
    $(document).on('click', '#tegset1 > li', function() {
        var v = $('#tag').html();
        var c = $(this).html();
        var i = '<span class="rem"><i data-value="' + c + '" class="dismiss-rem">&times;</i> ' + c + '</span>';
        $('#tag').html(v + i);
        $('#tagging').val(c + ',' + $('#tagging').val());
        $(this).remove();
    });

    $(document).on('keyup', '#tagss', function(e) {
        var tag = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?= admin_url('posts/ajx'); ?>",
            data: 'tag=' + tag,
            success: function(f) {
                $('#tegset1').empty().append(f);
            }
        });
    });

    $(document).on('click', 'i.dismiss-rem', function() {
        var rv = $(this).attr('data-value');
        $(this).parent('span').remove();
        $('#tagging').val($('#tagging').val().replace(rv + ',', ''));

    });
</script>
<style>
    .rem {
        background: #4d4d4d;
        color: white;
        padding: 0px 6px;
        margin: 2px;
        border-radius: 9px;

    }

    .dismiss-rem {
        cursor: pointer;
    }
</style>