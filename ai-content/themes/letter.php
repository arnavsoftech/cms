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
<style>
    .right1-content-part img {
        max-width: 300px;
        margin: 0 15px 15px 0;
        border: solid 1px #DDD;
        padding: 2px;
    }
</style>
<!--letter-section-->

<section>

    <div class="container">
        <div class="row">
            <div class="col-sm-10 m-auto">
                <div class="content-part">
                    <div class="heading-area">
                        <h1><?= $page->post_title; ?></h1>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-sm-10 m-auto">
                <div class="right1-content-part">
                    <?= $page->description; ?>
                </div>
            </div>
        </div>
</section>
<?php include_once('widget/donation.php'); ?>