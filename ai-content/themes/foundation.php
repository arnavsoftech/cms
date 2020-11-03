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

<section>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="content-part">

                    <div class="heading-area">

                        <h1><?= $page->post_title; ?></h1>



                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

</section>

<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="fd">
                    <?= $page->excerpt; ?>
                    <div class="fc_box">
                        <?= $page->factsheet; ?>
                    </div>
                    <?= $page->description; ?>
                </div>
            </div>
        </div>
    </div>
</section>