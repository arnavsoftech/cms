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
</section>
<?php
$where = array(
    'post_type' => 'post',
    'parent_id' => 6,
    'status' => 1
);
$posts = $this->db->order_by("sequence", "ASC")->get_where("posts", $where)->result();
?>

<section class="about-us-info-section ">
    <div class="container">
        <?php
        foreach ($posts as $post) {
            $ob = new AI_Post($post->id);
        ?>
            <div class="row mb-4">
                <div class="span-1-2 col-sm-4">
                    <img src="<?= $ob->getImgUrl(); ?>" alt="" width="100%">
                </div>

                <div class="span-1-2 col-sm-8 d-flex align-items-center">
                    <div class="about-us-copy">
                        <div class="sans-serif about-us-title push-bottom">
                            <h3><?= $ob->title(); ?></h3>
                        </div>
                        <div class="serif about-us-description">
                            <?= $ob->description(); ?>
                        </div>
                        <hr class="hr">
                        <p class="p-small sans-serif upper strong related"></p>
                        <p class="p-small serif italic flush related"></p>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>

<?php include_once('widget/donation.php'); ?>