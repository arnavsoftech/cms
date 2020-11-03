<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $meta_title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" value="<?= $meta_description; ?>" />
    <meta name="keywords" value="<?= $meta_keywords; ?>" />
    <script type='text/javascript' src='<?= theme_url(); ?>js/jquery.js'></script>
    <link rel="stylesheet" href="<?= theme_url(); ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= theme_url(); ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= theme_url(); ?>css/elegant-fonts.css">
    <link rel="stylesheet" href="<?= theme_url(); ?>css/themify-icons.css">
    <link rel="stylesheet" href="<?= theme_url(); ?>css/swiper.min.css">
    <link rel="stylesheet" href="<?= theme_url(); ?>style.css?var=0.1">
</head>

<body>
    <header class="site-header">
        <div class="top-header-bar">
            <div class="container">
                <div class="row flex-wrap justify-content-center justify-content-lg-between align-items-lg-center">
                    <div class="col-12 col-lg-8 d-none d-md-flex flex-wrap justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                        <div class="header-bar-email">
                            MAIL: <a href="mailto:<?= theme_option('email_id') ?>"><?= theme_option('email_id') ?></a>
                        </div>
                        <div class="header-bar-text">
                            <p>PHONE: <span><?= theme_option('contact_no') ?></span></p>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 d-flex flex-wrap justify-content-center justify-content-lg-end align-items-center">
                        <div class="donate-btn">
                            <a href="<?= site_url('pages/donation'); ?>">Donate Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12 d-flex flex-wrap justify-content-between align-items-center">
                        <div class="site-branding d-flex align-items-center">
                            <a class="d-block" href="<?= site_url(); ?>" rel="home"><img class="d-block" src="<?= theme_option('logo'); ?>" alt="logo"></a>
                        </div>
                        <nav class="site-navigation d-flex justify-content-end align-items-center">
                            <?php
                            $menu = $this->Menu_model->simpleMenu(1, array('ul_class' => 'd-flex flex-column flex-lg-row justify-content-lg-end align-content-center'));
                            echo $menu;
                            ?>
                            <!-- <ul class="d-flex flex-column flex-lg-row justify-content-lg-end align-content-center">
                                <li>
                                    <a href="<?= site_url(); ?>"> Home </a>
                                    <ul>
                                        <li><a href="<?= site_url('letter') ?>">Letter from Red Sled Santa</a></li>
                                        <li><a href="<?= site_url('leadership') ?>">Leadership</a></li>
                                        <li><a href="<?= site_url('history') ?>">History</a></li>
                                        <li><a href="<?= site_url('foundation-factsheet') ?>">Foundation Factsheet</a></li>
                                        <li><a href="<?= site_url('financial-audit') ?>">Financial Audit</a></li>
                                        <li><a href="<?= site_url('contact-us') ?>">Contact us</a></li>
                                        <li><a href="<?= site_url('regional-offices') ?>">Regional Offices</a></li>
                                        <li><a href="<?= site_url('letter-of-gratitude') ?>">Letter of Gratitude</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?= site_url('what-we-do'); ?>"> What We Do</a>
                                    <ul>
                                        <li><a href="<?= site_url('emergency-response') ?>">Emergency Response</a></li>
                                        <li><a href="<?= site_url('services') ?>">Financial Services for Poor</a></li>
                                        <li><a href="<?= site_url('media') ?>">Media Help</a></li>
                                        <li><a href="<?= site_url('child-education') ?>">Child Education</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?= site_url('how-we-work'); ?>">How We Work</a>
                                    <ul>
                                        <li><a href="<?= site_url('make-grants'); ?>">How we make grants</a></li>
                                        <li><a href="<?= site_url('information-sharing'); ?>">Information Sharing approach</a></li>
                                        <li><a href="<?= site_url('global-access-policy'); ?>">Global Access Policy</a></li>
                                        <li><a href="<?= site_url('evaluation-policy'); ?>">Evaluation Policy</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= site_url('where-we-work'); ?>">Where we work</a>
                                    <ul>
                                        <?php
                                        $where = array(
                                            'post_type' => 'post',
                                            'parent_id' => 14,
                                            'status' => 1
                                        );
                                        $menus = $this->db->order_by("sequence", "ASC")->get_where("posts", $where)->result();
                                        foreach ($menus as $m) {
                                            $mob = new AI_Post($m->id);
                                        ?>
                                            <li><a href="<?= $mob->permalink(); ?>"><?= $mob->title(); ?></a></li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li><a href="<?= site_url('news'); ?>"> Get Involved</a>
                                    <ul>
                                        <li><a href="<?= site_url('foundation-cares'); ?>">Foundation cares</a></li>
                                        <li><a href="<?= site_url('resources'); ?>">Resources for volunteering</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?= site_url('career'); ?>">Career</a></li>
                                <li><a href="<?= site_url('donate'); ?>">Donation</a></li>
                                <li><a href="<?= site_url('contact-us'); ?>">Contact us</a></li>
                            </ul> -->
                        </nav>
                        <div class="hamburger-menu d-lg-none">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!----------------------- Main Section Loader ------->
    <?php $this->load->front_view($main); ?>
    <!-----------------------/ Main Section ------------->
    <footer class="site-footer">
        <div class="footer-widgets">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="foot-about">
                            <h2><a class="foot-logo" href="<?= site_url(); ?>"><img src="<?= theme_option('logo'); ?>" alt=""></a></h2>
                            <p><?= theme_option('footer_about'); ?></p>
                            <ul class="d-flex flex-wrap align-items-center">
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
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <h2>Useful Links</h2>
                        <?php
                        $menu = $this->Menu_model->simpleMenu(2);
                        echo $menu;
                        ?>
                        <!-- <ul>
                            <li><a href="<?= site_url('privacy-policy'); ?>">Privacy Policy</a></li>
                            <li><a href="<?= site_url('volunteer'); ?>">Become a Volunteer</a></li>
                            <li><a href="<?= site_url('donate'); ?>">Donate</a></li>
                            <li><a href="<?= site_url('testimonials'); ?>">Testimonials</a></li>
                            <li><a href="<?= site_url('causes'); ?>">Causes</a></li>
                            <li><a href="<?= site_url('portfolio'); ?>">Portfolio</a></li>
                            <li><a href="<?= site_url('news'); ?>">News</a></li>
                        </ul> -->
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-latest-news">
                            <?php
                            $where = array(
                                'post_type' => 'post',
                                'parent_id' => 1,
                                'status' => 1
                            );
                            $posts = $this->db->order_by("id", "DESC")->limit(3)->get_where("posts", $where)->result();
                            ?>
                            <h2>Latest News</h2>
                            <ul>
                                <?php
                                foreach ($posts as $row) {
                                    $ob = new AI_Post($row->id);
                                ?>
                                    <li>
                                        <h3><a href="<?= $ob->permalink(); ?>"><?= $ob->title(); ?></a></h3>
                                        <div class="posted-date"><?= date("M d, Y", strtotime($row->created)); ?></div>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3 mt-5 mt-md-0">
                        <div class="foot-contact">
                            <h2>Contact</h2>
                            <ul>
                                <li><i class="fa fa-phone"></i><span><?= theme_option('contact_no') ?></span></li>
                                <li><i class="fa fa-envelope"></i><span><?= theme_option('email_id') ?></span></li>
                                <li><i class="fa fa-map-marker"></i><span><?= theme_option('address') ?></span></li>
                            </ul>
                        </div>
                        <div class="subscribe-form">
                            <form class="d-flex flex-wrap align-items-center">
                                <input type="email" placeholder="Your email">
                                <input type="submit" value="send">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-white">
                <small>(Red Sled Santa Foundation is a non-profit 501(c)(3). Government Number- EIN:85-312783)</small>
            </div>
        </div>
        <div class="footer-bar">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <p class="m-0">
                            Copyright &copy; 2020 All rights reserved
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script type='text/javascript' src='<?= theme_url(); ?>js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='<?= theme_url(); ?>js/swiper.min.js'></script>
    <script type='text/javascript' src='<?= theme_url(); ?>js/jquery.countdown.min.js'></script>
    <script type='text/javascript' src='<?= theme_url(); ?>js/circle-progress.min.js'></script>
    <script type='text/javascript' src='<?= theme_url(); ?>js/jquery.countTo.min.js'></script>
    <script type='text/javascript' src='<?= theme_url(); ?>js/jquery.barfiller.js'></script>
    <script type='text/javascript' src='<?= theme_url(); ?>js/custom.js'></script>
</body>

</html>