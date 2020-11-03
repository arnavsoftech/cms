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

<!--history-section-->

<section class="p-0">

    <div class="contact-page-wrap">

        <div class="container">

            <div class="row">

                <div class="col-12 col-lg-5">

                    <div class="entry-content">

                        <h2><?= $page->post_title; ?></h2>
                        <?= $page->description; ?>
                        <div class="py-3">
                            <a class="btn gradient-bg" href="<?= site_url('pages/help-submission'); ?>">Apply for Scholarship</a>
                        </div>
                        <ul class="contact-social d-flex flex-wrap align-items-center">

                            <?php
                            if (theme_option('pinterest') != '') {
                            ?>
                                <li><a target="_blank" href="<?= theme_option('pinterest'); ?>"><i class="fa fa-pinterest-p"></i></a></li>
                            <?php
                            }
                            ?>
                            <?php
                            if (theme_option('facebook') != '') {
                            ?>
                                <li><a target="_blank" href="<?= theme_option('facebook'); ?>"><i class="fa fa-facebook"></i></a></li>
                            <?php
                            }
                            ?>

                            <?php
                            if (theme_option('twitter') != '') {
                            ?>
                                <li><a target="_blank" href="<?= theme_option('twitter'); ?>"><i class="fa fa-twitter"></i></a></li>
                            <?php
                            }
                            ?>

                            <?php
                            if (theme_option('instagram') != '') {
                            ?>
                                <li><a target="_blank" href="<?= theme_option('instagram'); ?>"><i class="fa fa-instagram"></i></a></li>
                            <?php
                            }
                            ?>

                            <?php
                            if (theme_option('youtube') != '') {
                            ?>
                                <li><a target="_blank" href="<?= theme_option('youtube'); ?>"><i class="fa fa-youtube"></i></a></li>
                            <?php
                            }
                            ?>

                            <?php
                            if (theme_option('linkedin') != '') {
                            ?>
                                <li><a target="_blank" href="<?= theme_option('linkedin'); ?>"><i class="fa fa-linkedin"></i></a></li>
                            <?php
                            }
                            ?>

                        </ul>

                        <ul class="contact-info p-0">
                            <li><i class="fa fa-phone"></i><span><?= theme_option('contact_no') ?></span></li>
                            <li><i class="fa fa-envelope"></i><span><?= theme_option('email_id') ?></span></li>
                            <li><i class="fa fa-map-marker"></i><span><?= theme_option('address') ?></span></li>
                        </ul>

                    </div>

                </div>

                <div class="col-12 col-lg-7">
                    <form class="contact-form">
                        <input type="text" placeholder="Name">
                        <input type="email" placeholder="Email">
                        <textarea rows="15" cols="6" placeholder="Messages"></textarea>
                        <span>
                            <input class="btn gradient-bg" type="submit" value="Contact us">
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<?php include_once('widget/donation.php'); ?>