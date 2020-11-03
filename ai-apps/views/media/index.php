<div class="page-header">
    <h2>Media Manager <a href="<?php echo admin_url('media/add'); ?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-sign"></i> Upload New</a></h2>
</div>
<div class="widget">
    <div class="widget-head">
        Media Files
    </div>
    <div class="widget-content">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="chkall" value="1" /> </th>
                    <th>Thumbnail</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($medias as $row) {
                ?>
                    <tr>
                        <td><input name="chkall[]" type="checkbox" class="chkall" value="1" /></td>
                        <td align="center">
                            <a href="<?php echo base_url(upload_dir($row->post_title)); ?>" target="_blank">
                                <?php if ($row->excerpt == 'image/png' || $row->excerpt == 'image/jpg' || $row->excerpt == 'image/gif' || $row->excerpt == 'image/jpeg') { ?>
                                    <img src="<?php echo base_url(upload_dir($row->post_title)); ?>" width="50">
                                <?php } else if ($row->excerpt == 'application/msword') { ?>
                                    <img src="<?php echo base_url('assets/img/word-icon.jpg'); ?>" width="50">
                                <?php } else if ($row->excerpt == 'application/pdf') { ?>
                                    <img src="<?php echo base_url('assets/img/pdf-icon.jpg'); ?>" width="50">
                                <?php } else if ($row->excerpt == 'application/octet-st') { ?>
                                    <img src="<?php echo base_url('assets/img/zip-icon.jpg'); ?>" width="50">
                                <?php } else if ($row->excerpt == 'video/mp4') { ?>
                                    <video width="140" height="80" controls>
                                        <source src="<?= base_url(upload_dir($row->post_title)); ?>" type="video/mp4">
                                    </video>
                                <?php } else {
                                    echo $row->excerpt;
                                } ?>
                            </a>
                        </td>
                        <td><?php echo base_url(upload_dir($row->post_title)); ?></td>
                        <td align="center">
                            <div class="pull-right btn-group">
                                <?php if ($row->excerpt == 'image/png' || $row->excerpt == 'image/jpg' || $row->excerpt == 'image/gif') { ?>
                                    <a href="<?= admin_url('media/edit/' . $row->id); ?>" title="Edit" class="btn btn-sm btn-default"><i class="fa fa-pencil"></i> </a>
                                <?php } ?>
                                <a href="<?= admin_url('media/delete/' . $row->id); ?>" title="Delete" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i> </a>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <div class="widget-foot">
        <?php echo $paginate; ?>
    </div>
</div>