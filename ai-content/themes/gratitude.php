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
        <div class="content-part">
            <h1 class="h3"> <?= $page->post_title; ?> </h1>
            <hr>
            <?= $page->description; ?>
        </div>
        <div class="row">
            <?php
            $where = array(
                'post_type' => 'post',
                'parent_id' => 12,
                'status' => 1
            );
            $this->db->order_by('sequence', 'ASC');
            $this->db->order_by('id', 'DESC');
            $posts = $this->db->get_where("posts", $where)->result();
            foreach ($posts as $p) {
            ?>
                <div class="col-sm-6">
                    <h5 class="mb-4"><?= $p->post_title; ?></h5>
                    <div class="clearfix border rounded mb-4">
                        <a href="<?= base_url(upload_dir($p->attachment)); ?>" target="_blank">
                            <img src="<?= base_url(upload_dir($p->image)); ?>" style="width: 100%;" alt="">
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>

<?php include_once('widget/donation.php'); ?>