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

<!--what we do-section-->

<section class="sec sec-about">
    <div class="container">

        <h2><?= $page->post_title; ?></h2>
        <h3><?= $page->excerpt; ?></h3>
        <hr>
        <?php
        if ($page->attachment != '') {
        ?>
            <img style="float: left; margin: 0 10px 10px 0; max-width: 400px; " src="<?= base_url(upload_dir($page->attachment)); ?>">
        <?php
        }
        ?>
        <?= $page->description; ?>
    </div>
</section>



<section id="testimonials" class="testimonials">
    <div class="container">
        <div class="section-title">
            <h2> <?= $page->heading; ?> </h2>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="vm-box">
                    <img src="<?= $page->vision_url; ?>">
                    <?= $page->vision; ?>
                </div>
            </div>

            <div class="col-md-6">
                <div class="vm-box">
                    <img src="<?= $page->mission_url; ?>">
                    <?= $page->mission; ?>
                </div>
            </div>
        </div>
    </div>
</section>



<?php include_once('widget/donation.php'); ?>