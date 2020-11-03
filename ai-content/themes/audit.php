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

<!--financial-audit-section-->
<?php
$where = array(
    'post_type' => 'post',
    'parent_id' => 5,
    'status' => 1
);
$this->db->order_by('sequence', 'ASC');
$posts = $this->db->order_by("id", "DESC")->get_where("posts", $where)->result();
$showindex = isset($_GET['post']) ? $_GET['post'] : 0;
$p = isset($posts[$showindex]) ? $posts[$showindex] : $posts[0];
?>

<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4 wow slideInLeft" data-wow-duration="2s" data-wow-delay="0.5s">
                <div class="left-panel">
                    <ul>
                        <?php
                        $index = 0;
                        foreach ($posts as $post) {
                        ?>
                            <li><a href="<?= site_url('pages/financial-audit/?post=' . $index++); ?>"><?= $post->post_title; ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <div class="col-md-8 wow slideInRight" data-wow-duration="3s" data-wow-delay="1s">

                <div class="right-panel">

                    <div class="right-panel-child current">

                        <div class="sub-title wow slideInDown" data-wow-duration="1s" data-wow-delay="1s">

                            <h2><?= $p->post_title; ?></h2>

                        </div>

                        <div class="content-txt">
                            <?= $p->description; ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>



<div class="help-us">

    <div class="container">

        <div class="row">

            <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">

                <h2>Help us so we can help others</h2>

                <a class="btn orange-border" href="#">Donate now</a>

            </div>

        </div>

    </div>

</div>