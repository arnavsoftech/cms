<div class="page-header">
    <h2>Categories <a class="btn pull-right btn-sm btn-primary" href="<?php echo admin_url('categories/add'); ?>"><i class="glyphicon glyphicon-plus-sign"></i> Add New Category</a></h2>
</div>
<div class="widget">
    <div class="widget-head">
        All Categories
    </div>
    <div class="widget-content">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Category name</th>
                    <th>Parent</th>
                    <th>Sequence</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($categories) && count($categories) > 0) {
                    $sl = 1;
                    foreach ($categories as $cat) {
                        $c = new AI_Category($cat->id);
                ?>
                        <tr>
                            <td><?= $sl++; ?></td>
                            <td><a href="<?= $c->permalink(); ?>" target="_blank"><?= $c->title(); ?></a></td>
                            <td>
                                <?php
                                if ($cat->parent_id == 0)
                                    echo 'Top Category';
                                else {
                                    $tc = $this->Category_model->getRow($cat->parent_id);
                                    if (property_exists($tc, 'name')) {
                                        echo $tc->name;
                                    } else {
                                        echo 'Category Deleted';
                                    }
                                }
                                ?>
                            </td>

                            <td><?= $cat->sequence; ?></td>
                            <td>
                                <?php
                                if ($cat->status == 1) {
                                ?>
                                    <a href="<?= admin_url('categories/deactivate/' . $cat->id, true); ?>" class="label label-success">Active</a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?= admin_url('categories/activate/' . $cat->id, true); ?>" class="label label-danger">Deactive</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <div class="btn-group pull-right">
                                    <a href="<?= admin_url('categories/add/' . $cat->id); ?>" title="Edit" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i> </a>
                                    <!-- <a href="<?= admin_url('categories/delete/' . $cat->id); ?>" title="Delete" class="btn btn-xs btn-danger delete"><i class="fa fa-trash"></i> </a> -->
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>