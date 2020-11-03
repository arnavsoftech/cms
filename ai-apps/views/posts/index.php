<div class="page-header">
    <h2>Manage Post <a class="btn btn-sm btn-primary pull-right" href="<?php echo admin_url('posts/add-post'); ?>"><i class="glyphicon glyphicon-plus-sign"></i> Add New Post</a></h2>
</div>

<div class="widget">
    <div class="widget-head">
        All Posts
    </div>
    <div class="widget-content">
        <div style="padding: 10px;">
            <table class="table table-striped table-search" id="post-index">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Post Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sl = 1;
                    foreach ($post_list as $row) {
                        $a = new AI_Post($row->id);
                        if (isset($_GET['cat'])) {
                            if ($_GET['cat'] <> $a->parent_id) {
                                continue;
                            }
                        }
                    ?>
                        <tr>
                            <td>#<?= $a->ID(); ?></td>
                            <td><?= $a->title(); ?> <?php if ($a->featured == 1) echo "<span class='label label-success'>Featured</span>"; ?></td>
                            <td><?php
                                $cat = $this->db->get_where('categories', array('id' => $a->parent_id))->row();
                                if (is_object($cat)) {
                                ?>
                                    <a href="<?= admin_url('posts/?cat=' . $cat->id); ?>"><?= $cat->name; ?></a>
                                <?php
                                } else {
                                    echo 'TOP';
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($a->status == 1) {
                                ?>
                                    <a href="<?= admin_url('posts/deactivate/' . $a->id, true); ?>" class="label label-success tip" title="Deactive now">Active</a>
                                <?php
                                } else {
                                ?>
                                    <a href="<?= admin_url('posts/activate/' . $a->id, true); ?>" class="label label-danger tip" title="Activate now">Deactive</a>
                                <?php
                                }
                                ?>
                            </td>
                            <td>
                                <div class="btn-group pull-right">

                                    <a class="btn btn-sm btn-default" href="<?php echo  admin_url('posts/add-post/' . $a->id); ?>"><i class="fa fa-pencil"></i> Edit</a>

                                    <a class="btn btn-sm btn-danger delete" href="<?php echo  admin_url('posts/delete/' . $a->id); ?>"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <?php echo $paginate; ?>
        </div>
    </div>
</div>