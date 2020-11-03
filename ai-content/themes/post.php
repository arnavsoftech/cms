<!--about-content-->
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div claass="left-part">
                    <div class="content-part">
                        <h1> <?= $page->post_title; ?> </h1>
                        <hr>
                        <?php
                        if ($page->image != '') {
                        ?>
                            <img src="<?= base_url(upload_dir($page->image)); ?>" style="width: 100%;" />
                        <?php
                        }
                        ?>
                        <?= $page->description; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('widget/donation.php'); ?>