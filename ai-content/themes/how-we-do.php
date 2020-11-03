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
            <div class="col-lg-8">
                <div claass="left-part">
                    <div class="content-part">
                        <h1> <?= $page->post_title; ?> </h1>
                        <hr>
                        <?= $page->description; ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-part">
                    <div class="media-part">
                        <div class="media-text">
                            <?= $page->excerpt; ?>
                        </div>
                        <div class="media-img">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $page->youtube ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include_once('widget/donation.php'); ?>