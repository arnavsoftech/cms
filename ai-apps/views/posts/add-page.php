<div class="page-header">
    <h2>Page Form</h2>
</div>
<div class="row">
    <div class="col-sm-12">
        <?php echo form_open_multipart(admin_url('posts/add/' . $p->id), array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label class="col-sm-2 control-label">Title</label>

            <div class="col-sm-8">
                <input type="text" name="data[post_title]" value="<?= set_value('data[post_title]', $p->post_title); ?>" class="form-control input-sm" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Slug</label>

            <div class="col-sm-5">
                <input type="text" name="data[slug]" value="<?= set_value('data[slug]', $p->slug); ?>" class="form-control input-sm" />
            </div>
            <label class="col-sm-1 control-label">Parent</label>
            <div class="col-sm-2">
                <?php
                $page_dd = array();
                foreach ($parents as $pid => $val) {
                    if ($p->id && $pid == $p->id) continue;
                    $page_dd[$pid] = $val;
                }
                echo form_dropdown('data[parent_id]', $page_dd, $p->parent_id, 'class="form-control input-sm"');
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Excerpt</label>

            <div class="col-sm-8">
                <textarea rows="4" cols="" class="form-control input-sm" name="data[excerpt]"><?= set_value('data[excerpt]', $p->excerpt); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Description</label>

            <div class="col-sm-10">
                <textarea rows="8" cols="" class="form-control input-sm ckeditor" name="data[description]"><?= set_value('data[description]', $p->description); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Layout</label>
            <div class="col-sm-2">
                <?php
                echo form_dropdown('data[layout]', $layouts, $p->layout, 'class="form-control input-sm"');
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Header Image</label>
            <div class="col-sm-6">
                <input type="file" name="image" />
                <?php
                if ($p->image <> '') {
                ?>
                    <img src="<?= base_url(upload_dir($p->image)); ?>" class="img-thumbnail img-responsive" /><br />
                    <label class="checkbox checkbox-inline"><input type="checkbox" name="del_img" value="1" /> Delete Image</label>
                    <input type="hidden" name="hid_img" value="<?= $p->image; ?>" />

                <?php
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Secondary Image</label>
            <div class="col-sm-6">
                <input type="file" name="attachment" />
                <?php
                if ($p->attachment <> '') {
                ?>
                    <img src="<?= base_url(upload_dir($p->attachment)); ?>" class="img-thumbnail img-responsive" /><br />
                    <label class="checkbox checkbox-inline"><input type="checkbox" name="del_at" value="1" /> Delete Image</label>
                    <input type="hidden" name="hid_at" value="<?= $p->attachment; ?>" />

                <?php
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">SEO Title</label>

            <div class="col-sm-8">
                <input type="text" name="data[seo_title]" class="form-control input-sm" value="<?php echo set_value('data[seo_title]', $p->seo_title); ?>" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Meta Description</label>

            <div class="col-sm-8">
                <textarea name="data[seo_description]" rows="3" cols="" class="form-control input-sm"><?php echo set_value('data[seo_description]', $p->seo_description); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Meta Keywords</label>

            <div class="col-sm-8">
                <textarea name="data[seo_keywords]" rows="3" cols="" class="form-control input-sm"><?php echo set_value('data[seo_keywords]', $p->seo_keywords); ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Status</label>

            <div class="col-sm-3">
                <?php
                $st = array(
                    1 => 'Active',
                    0 => 'Deactive'
                );
                echo form_dropdown('data[status]', $st, $p->status, 'class="form-control input-sm"');
                ?>
            </div>
        </div>
        <?php // print_r($page_data);
        ?>
        <?php
        if (isset($page_data['fields'])) {
            $fields = $page_data['fields'];
            foreach ($fields as $row) {
                $field = $row['field'];
                $value = get_field($field, $p->id);
                $field_nm = 'meta[' . $field . ']';
                $required = isset($row['required']) ? $row['required'] : '';
                $extra = array(
                    'class' => 'form-control'
                );
        ?>
                <div class="form-group">
                    <label class="col-sm-2 control-label"><?= $row['label']; ?></label>
                    <div class="col-sm-8">
                        <?php
                        switch ($row['type']) {
                            case 'text':
                                echo form_input($field_nm, $value, array('class' => 'form-control'));
                                break;
                            case 'textarea':
                                echo form_textarea($field_nm, $value, array('class' => 'form-control', 'style' => "height: 60px;"));
                                break;
                            case 'select':
                                echo form_dropdown($field_nm, $row['options'], $value, array('class' => 'form-control'));
                            case 'editor':
                                echo form_textarea($field_nm, $value, array('class' => 'form-control ckeditor', 'style' => "height: 300px;"));
                                break;
                        }
                        ?>
                    </div>
                </div>
        <?php
            }
        }
        ?>
        <div class="form-group">
            <div class="col-sm-8 col-sm-offset-2">
                <input type="submit" name="submit" value="Save" class="btn btn-sm btn-primary" />
                <a href="<?= admin_url('posts'); ?>" class="btn btn-sm btn-default">Cancel</a>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
    $('.img-preview').on('click', function(e) {
        $('.img-preview').removeClass('cover-img');
        $(this).addClass('cover-img');
        $('#cover_image').val($(this).attr('src'));
    });
</script>