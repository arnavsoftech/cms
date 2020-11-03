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
    blockquote {
        font-size: 1rem;
        border-left: solid 4px #DDD;
        padding-left: 25px;
    }

    .img-testimonial {
        max-height: 250px;
        overflow: hidden;
    }
</style>
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

                    <?php
                    $where = array(
                        'post_type' => 'post',
                        'parent_id' => 13,
                        'status' => 1
                    );
                    $posts = $this->db->order_by("sequence", "ASC")->get_where("posts", $where)->result();

                    $sl = 1;
                    foreach ($posts as $post) {
                        $ob = new AI_Post($post->id);
                        $show_left = true;
                        if ($sl++ % 2 == 0) {
                            $show_left = false;
                        }
                    ?>
                        <div class="row mb-4">
                            <?php
                            if ($show_left) {
                            ?>
                                <div class="col-sm-4 img-testimonial">
                                    <img src="<?= $ob->getImgUrl(); ?>" alt="" class="img-thumbnail" width="100%">
                                </div>
                            <?php
                            }
                            ?>
                            <div class="col-sm-8">
                                <div class="about-us-copy">
                                    <blockquote class="blockquote text-justify">
                                        <?= $ob->description(); ?>
                                    </blockquote>
                                    <p><em> <?= $ob->title(); ?></em></p>
                                </div>
                            </div>
                            <?php
                            if ($show_left == false) {
                            ?>
                                <div class="col-sm-4 img-testimonial">
                                    <img src="<?= $ob->getImgUrl(); ?>" class="img-thumbnail" alt="" width="100%">
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include_once('widget/donation.php'); ?>