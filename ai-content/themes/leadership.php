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

                <div claass="left-part">

                    <div class="content-part">



                        <h1> <?= $page->post_title; ?> </h1>

                        <hr>

                        <?= $page->description; ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<section class="bg-light py-5">

    <?php
    $where = array(
        'post_type' => 'post',
        'parent_id' => 10,
        'status' => 1
    );
    $posts = $this->db->order_by("sequence", "ASC")->get_where("posts", $where)->result();

    ?>

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="history-section">

                    <div class="text-parta">

                        <h1><?= $page->head; ?></h1>
                        <p><?= $page->subhead; ?></p>
                    </div>

                    <div class="img-part row">
                        <?php
                        if (is_array($posts) && count($posts) > 0) {
                            foreach ($posts as $ob) {
                        ?>
                                <div class="col-sm-4 img-text">
                                    <img src="<?= base_url(upload_dir($ob->image)); ?>">
                                    <h4><?= $ob->post_title; ?></h4>
                                    <p><?= $ob->excerpt; ?></p>
                                    <?= $ob->description; ?>
                                </div>
                        <?php
                            }
                        }
                        ?>

                    </div>
                    <div class="text-partb">
                        <p><?= $page->photos; ?></p>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php include_once('widget/donation.php'); ?>