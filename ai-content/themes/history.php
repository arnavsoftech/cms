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

                        <div class="divider">

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-12">

                <div class="topText">

                    <?= $page->description; ?>

                </div>

            </div>



            <div class="col-lg-12">

                <div class="head-text">

                    <h3><?= $page->excerpt; ?></h3>

                </div>

            </div>

        </div>

    </div>

</section>
<style>
    .img-history,
    .timeline img {
        border: solid 1px #EEE;
        padding: 2px;
        display: inline-block;
        max-width: 250px;
        height: auto;
        cursor: pointer;
    }

    .viewshow {
        display: none;
        justify-content: center;
        align-items: center;
        flex: 1;
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        top: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
    }

    .viewshow.show {
        display: flex;
    }

    .viewimg {
        background: #fff;
        padding: 12px;
        border-radius: 3px;
    }

    .viewimg img {
        float: left;
    }

    .btn-close {
        position: absolute;
        right: 10px;
        top: 10px;
        cursor: pointer;
        background: rgb(206 12 12);
        color: #FFF;
        padding: 10px 20px;
        border-color: rosybrown;
    }
</style>
<!--===history-details-part====-->

<section class="bg-light">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="timeline timeline mt-0 pt-0">
                    <?php
                    $where = array(
                        'post_type' => 'post',
                        'parent_id' => 4,
                        'status' => 1
                    );
                    $posts = $this->db->order_by("id", "DESC")->get_where("posts", $where)->result();
                    ?>
                    <ul>
                        <?php
                        foreach ($posts as $post) {
                            $ob = new AI_Post($post->id);
                        ?>
                            <li>
                                <div class="content">
                                    <h3><?= $ob->title(); ?></h3>
                                    <div class="content1">
                                        <?php
                                        if ($ob->hasImage()) {
                                            echo '<div class="clearfix">';
                                            $ob->image('lg', array('class' => 'img-fluid img-thumbnail img-history'));
                                            echo '</div>';
                                        }
                                        ?>
                                        <?= $post->description; ?>
                                    </div>
                                </div>
                                <div class="time">
                                    <h4><?= $ob->excerpt(); ?></h4>
                                </div>
                            </li>
                        <?php
                        }
                        ?>
                        <div style="clear:both;"></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="viewshow">
    <div class="viewimg">
        <button class="btn btn-close btn-outline">CLOSE</button>
        <img id="imgview" src="https://christmasthenandnow.com/beneficiary_data/2020/2f61a94e_23_2020_06_12_11_18_pm.jpeg" alt="" srcset="">
    </div>
</div>

<?php include_once('widget/donation.php'); ?>
<script>
    jQuery(document).ready(function() {
        console.log('jQuery ready');
        jQuery('.timeline img').click(function(e) {
            let src = jQuery(this).attr('src');
            jQuery('#imgview').attr('src', src);
            jQuery('.viewshow').addClass('show');
        });
        jQuery('.btn-close').click(function(e) {
            jQuery('.viewshow').removeClass('show');
        });
    });
</script>