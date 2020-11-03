<div class="page-header">
    <h3>Gallery <a href="<?php echo admin_url('gallery/create'); ?>" class="btn btn-sm btn-primary pull-right"><i class="glyphicon glyphicon-plus-sign"></i> Create New Gallery</a></h3>
</div>
<div class="widget">
    <div class="widget-head">
        All Galleries
    </div>
    <div class="widget-content">
        <table class="table table-striped">
            <thead>
                <th>ID</th>
                <th>Gallery Title</th>
                <th>Total Photos</th>
                <th>Author</th>
                <th>Status</th>
            </thead>
            <tbody>
                <?php
                if ((count($gallery_list) > 0) && is_array($gallery_list)) {
                    foreach ($gallery_list as $row) :
                ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['gallery_name']; ?></td>
                            <td><a href="<?php echo admin_url('gallery/view/' . $row['id']); ?>">
                                    <?php $c = $this->gallery_model->get_images($row['id']);
                                    echo count($c); ?> Photos</a>
                            </td>
                            <td>
                                <?php
                                if ($row['status'] == 1) {
                                ?>
                                    <a href="<?= admin_url('gallery/deactivate/' . $row['id'], true) ?>" class="label label-success" title="Click to Deactive">Active</a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?= admin_url('gallery/activate/' . $row['id'], true) ?>" class="label label-danger" title="Click to Active">Deactive</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <a title="Add Photos" href="<?php echo admin_url('gallery/multiple/' . $row['id']); ?>" class="btn btn-default btn-sm"><i class="fa fa-plus-circle"></i></a>
                                    <a title="Edit Gallery" href="<?php echo admin_url('gallery/create/' . $row['id']); ?>" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>
                                    <a title="Delete Gallery" href="<?php echo admin_url('gallery/delete/' . $row['id']); ?>" class="btn btn-sm btn-danger delete"><i class="fa fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                <?php
                    endforeach;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>