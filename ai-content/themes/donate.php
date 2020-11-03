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

<!--donation-section-->

<section class="bg-light">

    <div class="container">
        <div class="mb-3">
            <div class="text-center">
                <h1><?= $page->post_title; ?></h1>
            </div>
            <div class="text-justify">
                <?= $page->description; ?>
            </div>
        </div>

        <div class="row justify-content-center">

            <div class="col-sm-6">

                <div class="card card-box">

                    <div class="card-body pay-block">

                        <div class="hd-text">

                            <h3 class="txt1">DONATE NOW </h3>

                            <hr>

                        </div>

                        <div class="bg-form">

                            <form action="" method="post">

                                <label for="fname">Full Name</label>

                                <input type="text" id="fname" class="form-control" name="data[name]" placeholder="Enter Full Name" required="">

                                <label for="lname">Email ID</label>

                                <input type="text" id="Email" class="form-control" name="data[email]" placeholder="Enter Your Email ID" required="">

                                <label for="lname">Mobile No.</label>

                                <input type="text" id="Mobile" class="form-control" name="data[mobile]" placeholder="Enter Your Mobile Number" required="">

                                <label for="lname"> Amount </label>

                                <input type="text" id="amount" class="form-control" name="data[amount]" placeholder="Enter Amount" required="">

                                <button type="submit" name="submit" class="btn btn-sm btn-block btn-success"> Pay Now <i class="fa fa-send"></i> </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>