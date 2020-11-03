<div class="row">
    <div class="col-sm-7">
        <div class="widget">
            <div class="widget-head">
                Latest Posts
            </div>
            <div class="widget-content">
                <table class="table table-hover table-striped">
                    <thead>
                        <?php foreach ($posts as $row) {
                            $a = new AI_Post($row->id); ?>
                            <tr>
                                <td><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <a href="<?= site_url() . $a->post_permalink(); ?>" target="_blank"><?= $a->title(); ?></a></td>

                            </tr>
                        <?php } ?>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="widget">
            <div class="widget-head">
                Latest Category
            </div>
            <div class="widget-content">
                <table class="table table-hover">
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>