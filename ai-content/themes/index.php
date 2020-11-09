<style>
    .hero-slider {
        min-width: 320px;
        overflow: hidden;
        padding: 250px 0;
        position: relative;
    }

    .hero-slider-opacity {
        background-color: #fff;
        height: 100%;
        left: 0;
        opacity: .8;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 0;
    }

    .hero-slider video {
        bottom: 50%;
        height: auto;
        min-height: 100%;
        min-width: 100%;
        position: absolute;
        right: 50%;
        -webkit-transform: translateX(50%) translateY(50%);
        -ms-transform: translateX(50%) translateY(50%);
        transform: translateX(50%) translateY(50%);
        width: auto;
        z-index: -1;
    }
</style>
<div class="swiper-container1 hero-slider">
    <div class="hero-slider-opacity" style="opacity:.6;"></div>
    <video autoplay loop>
        <source src="<?= theme_option('slider_video'); ?>" type="video/mp4">
    </video>
    <div class="swiper-wrapper">
        <?php
        $banner = theme_option('banner_id');
        $images = $this->Gallery_model->get_images($banner);
        foreach ($images as $ob) {
            $ob = (object)$ob;
        ?>
            <div class="swiper-slide hero-content-wrap">
                <div class="hero-content-overlay position-absolute w-100 h-100">
                    <div class="container h-100">
                        <div class="row h-100">
                            <div class="col-12 col-lg-8 d-flex flex-column justify-content-center align-items-start">
                                <header class="entry-header">
                                    <h1><?= $ob->title; ?></h1>
                                </header>
                                <div class="entry-content mt-4">
                                    <p style="color: #ed1b24;"><?= $ob->description; ?></p>
                                </div>
                                <footer class="entry-footer d-flex flex-wrap align-items-center mt-5">
                                    <a href="<?= site_url('pages/donation'); ?>" class="btn gradient-bg mr-2">Donate Now</a>
                                    <a href="<?= $ob->slug; ?>" class="btn orange-border" style="color: #ed1b24;">Read More</a>
                                </footer>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <!-- <div class="pagination-wrap position-absolute w-100">
        <div class="container">
            <div class="swiper-pagination"></div>
        </div>
    </div> -->
</div>
<div class="home-page-icon-boxes">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                <div class="icon-box active">
                    <figure class="d-flex justify-content-center">
                        <img src="<?= theme_url(); ?>images/hands-gray.png" alt="">
                        <img src="<?= theme_url(); ?>images/hands-white.png" alt="">
                    </figure>
                    <header class="entry-header">
                        <h3 class="entry-title"><?= $page->box1; ?></h3>
                    </header>
                    <div class="entry-content">
                        <p><?= $page->box1_1; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                <div class="icon-box">
                    <figure class="d-flex justify-content-center">
                        <img src="<?= theme_url(); ?>images/donation-gray.png" alt="">
                        <img src="<?= theme_url(); ?>images/donation-white.png" alt="">
                    </figure>
                    <header class="entry-header">
                        <h3 class="entry-title"><?= $page->box2; ?></h3>
                    </header>
                    <div class="entry-content">
                        <p><?= $page->box2_1; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mt-4 mt-lg-0">
                <div class="icon-box">
                    <figure class="d-flex justify-content-center">
                        <img src="<?= theme_url(); ?>images/charity-gray.png" alt="">
                        <img src="<?= theme_url(); ?>images/charity-white.png" alt="">
                    </figure>
                    <header class="entry-header">
                        <h3 class="entry-title"><?= $page->box3; ?></h3>
                    </header>
                    <div class="entry-content">
                        <p><?= $page->box3_1; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-page-welcome">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-10 m-auto order-2 order-lg-1">
                <div class="welcome-content">
                    <header class="entry-header">
                        <h2 class="entry-title"><?= $page->post_title; ?></h2>
                    </header>

                    <div class="entry-content">
                        <img src="<?= base_url(upload_dir($page->attachment)); ?>" class="img-thumbnail float-left" style="max-width: 450px;" alt="welcome">
                        <?= $page->description; ?>
                    </div>
                    <div class="entry-footer mt-5">
                        <a href="<?= site_url('letter'); ?>" class="btn gradient-bg mr-2 border border-white">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-page-events">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <?php
                $cat_id = 1;
                $cat = $this->db->get_where('categories', array('id' => $cat_id))->row();
                ?>
                <div class="upcoming-events">
                    <div class="section-heading">
                        <h2 class="entry-title"><?= $cat->name; ?></h2>
                    </div>
                    <?php
                    $where = array(
                        'post_type' => 'post',
                        'parent_id' => $cat_id,
                        'status' => 1
                    );
                    $posts = $this->db->order_by("id", "DESC")->limit(3)->get_where("posts", $where)->result();
                    if (is_array($posts) && count($posts) > 0) {
                        foreach ($posts as $ob) {
                    ?>
                            <div class="event-wrap d-flex flex-wrap justify-content-between">
                                <figure class="m-0">
                                    <?php
                                    $path = theme_url('images/event-1.jpg');
                                    if ($ob->image != '') {
                                        $path = base_url(upload_dir($ob->image));
                                    }
                                    ?>
                                    <img src="<?= $path; ?>" alt="" width="144" height="144">
                                </figure>
                                <div class="event-content-wrap">
                                    <header class="entry-header d-flex flex-wrap align-items-center">
                                        <h3 class="entry-title w-100 m-0"><a href="#"><?= $ob->post_title; ?></a></h3>
                                        <div class="posted-date">
                                            <a href="#"><?= date("M d, Y", strtotime($ob->created)); ?></a>
                                        </div>
                                        <div class="cats-links">

                                        </div>
                                    </header>
                                    <div class="entry-content">
                                        <p class="m-0"><?= $ob->excerpt; ?></p>
                                    </div>
                                    <div class="entry-footer">
                                        <a href="<?= site_url('posts/' . $ob->slug . '/' . $ob->id); ?>">Read More</a>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <?php
                $cat_id = 2;
                $cat = $this->db->get_where('categories', array('id' => $cat_id))->row();
                ?>
                <div class="featured-cause">
                    <div class="section-heading">
                        <h2 class="entry-title"><?= $cat->name; ?></h2>
                    </div>
                    <?php
                    $where = array(
                        'post_type' => 'post',
                        'parent_id' => $cat_id,
                        'status' => 1
                    );
                    $post = $this->db->order_by("id", "DESC")->limit(1)->get_where("posts", $where)->row();
                    ?>
                    <div class="cause-wrap d-flex flex-wrap justify-content-between">
                        <figure class="m-0">
                            <img style="max-width: 260px;" src="<?= base_url(upload_dir($post->image)); ?>" alt="">
                        </figure>
                        <div class="cause-content-wrap">
                            <header class="entry-header d-flex flex-wrap align-items-center">
                                <h3 class="entry-title w-100 m-0"><a href="#"><?= $post->post_title; ?></a></h3>
                                <div class="posted-date">
                                    <a href="#"><?= date("M d, Y", strtotime($post->created)); ?></a>
                                </div>
                            </header>
                            <div class="entry-content">
                                <p class="m-0"><?= $post->excerpt; ?></p>
                            </div>
                        </div>
                        <div class="description">
                            <div class="mt-2">
                                <?= $post->description; ?>
                            </div>
                            <!-- <div class="entry-footer mt-5">
                                <a href="<?= site_url('pages/donation'); ?>" class="btn gradient-bg mr-2">Donate Now</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$cat_id = 3;
$cat = $this->db->get_where('categories', array('id' => $cat_id))->row();
?>
<div class="our-causes">
    <div class="container">
        <div class="row">
            <div class="coL-12">
                <div class="section-heading">
                    <h2 class="entry-title"><?= $cat->name; ?></h2>
                </div>
            </div>
        </div>
        <?php
        $where = array(
            'post_type' => 'post',
            'parent_id' => $cat_id,
            'status' => 1
        );
        $posts = $this->db->order_by("id", "DESC")->limit(10)->get_where("posts", $where)->result();
        ?>
        <div class="row">
            <div class="col-12">
                <div class="swiper-container causes-slider">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($posts as $row) {
                            $ob = new AI_Post($row->id);
                        ?>
                            <div class="swiper-slide">
                                <div class="cause-wrap">
                                    <figure class="m-0" style="height: 240px; overflow: hidden;">
                                        <img src="<?= $ob->getImgUrl(); ?>" alt="">
                                        <!-- <div class="figure-overlay d-flex justify-content-center align-items-center position-absolute w-100 h-100">
                                            <a href="<?= site_url('pages/donation'); ?>" class="btn gradient-bg mr-2">Donate Now</a>
                                        </div> -->
                                    </figure>
                                    <div class="cause-content-wrap">
                                        <header class="entry-header d-flex flex-wrap align-items-center">
                                            <h3 class="entry-title w-100 m-0"><a href="<?= $ob->permalink(); ?>"><?= $ob->title(); ?></a></h3>
                                        </header>
                                        <div class="entry-content">
                                            <p class="m-0"><?= $ob->excerpt(); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="home-page-limestone">
    <div class="container">
        <div class="row align-items-start">
            <div class="coL-12 col-lg-6">
                <div class="section-heading">
                    <h2 class="entry-title"><?= $page->bheading ?></h2>
                    <p class="mt-5"><?= $page->bexcerpt; ?></p>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <?php // $page->help_details;
                ?>
                <?php
                $where = array(
                    'post_type' => 'post',
                    'parent_id' => 15,
                    'status' => 1
                );
                $posts = $this->db->order_by("sequence", "ASC")->get_where("posts", $where)->result();
                if (is_array($posts) && count($posts) > 0) {
                ?>
                    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $sl = 1;
                            foreach ($posts as $p) {
                                $ac = ($sl == 1) ? 'active' : null;
                            ?>
                                <div class="carousel-item <?= $ac; ?>" style="height: 200px;">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5 class="text-dark"><?= $p->post_title; ?></h5>
                                        <div class="text-dark"><?= $p->description; ?></div>
                                    </div>
                                </div>
                            <?php
                                $sl++;
                            }
                            ?>
                        </div>
                        <a class="carousel-control-prev text-danger" href="#carouselExampleCaptions" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only1 text-danger">PREV</span>
                        </a>
                        <a class="carousel-control-next text-danger" href="#carouselExampleCaptions" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only1 text-danger">NEXT</span>
                        </a>
                    </div>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>