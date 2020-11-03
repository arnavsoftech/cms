<section class="customer_banr_sec">
    <div class="customer_banr_txt">
        <h1> <?= $page->post_title; ?> </h1>
        <ul>
            <li>Home &gt; </li>
            <li><a href="#"> <?= $page->post_title; ?> </a></li>
        </ul>
    </div>
    <img src="<?= $page->image; ?>">
</section>
<!--about-content-->
<section class="pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="content-part">
                    <h1> <?= $page->post_title; ?> </h1>
                    <hr>
                    <?php
                    if ($page->attachment != '') {
                    ?>
                        <img src="<?= base_url(upload_dir($page->attachment)); ?>" class="img-fluid mb-3" />
                    <?php
                    }
                    ?>
                    <?= $page->description; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include_once('widget/donation.php'); ?>