<div class="page-header">
    <h2>Manage Pages
        <!-- <a href="<?= admin_url('posts/add'); ?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus-circle"></i> Add Page</a>  -->
    </h2>
</div>
<?php
$list = config_item('pages');
?>
<div class="widget">
    <div class="widget-head">
        All Pages
    </div>
    <div class="widget-content">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Page Title</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sl = 1;
                foreach ($list as $ob) {
                    $fields = 0;
                    if (isset($ob['fields'])) {
                        $fields = count($ob['fields']);
                    }
                    $link = site_url($ob['slug']);
                ?>
                    <tr>
                        <td><?= $sl++; ?></td>
                        <td><a href="<?= $link; ?>" target="_blank"><?= $ob['name']; ?></a> </td>
                        <td>
                            <a href="<?= admin_url('posts/edit-page/' . $ob['id']) ?>" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                <?php
                }
                $pages = $this->db->get_where('posts', array('page_id' => '', 'post_type' => 'page'))->result();
                foreach ($pages as $r) {
                    $ob = new AI_Post($r->id);
                ?>
                    <tr>
                        <td><?= $sl++; ?></td>
                        <td><a href="<?= $ob->permalink(); ?>" target="_blank"><?= $ob->title(); ?></a> </td>
                        <td>
                            <a href="<?= admin_url('posts/add/' . $r->id) ?>" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> Edit</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>