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

            <style>
                .btn {
                    border-radius: 3px;
                    box-shadow: 2px 2px 2px #888;
                    flex: 1;
                    margin: 0 5px;
                }
            </style>

            <div class="row">
                <div class="col-sm-8 m-auto">
                    <div class="text-center py-4 d-flex justify-content-between align-items-center">
                        <a href="https://www.convergepay.com/hosted-payments/?ssl_txn_auth_token=wUM0XEiiT22udpIRgKAbiQAAAXV6R6DK#!/payment-method" class="btn gradient-bg">$5</a>
                        <a href="https://www.convergepay.com/hosted-payments/?ssl_txn_auth_token=B2mGepNQQyKk5ylXaVL55QAAAXV6SVQQ#!/payment-method" class="btn gradient-bg">$20</a>
                        <a href="https://www.convergepay.com/hosted-payments/?ssl_txn_auth_token=N789GhbJR4ytonkFNYtFhgAAAXWZrAKd#!/payment-method" class="btn gradient-bg">$25</a>
                        <a href="https://www.convergepay.com/hosted-payments/?ssl_txn_auth_token=Q%2FZ40hc9TP6xxx3AeBt3dwAAAXV6SjVv#!/payment-method" class="btn gradient-bg">$50</a>
                        <a href="https://www.convergepay.com/hosted-payments/?ssl_txn_auth_token=VK8I2YC%2BSweLtMgKYpFM6AAAAXV6Sua5#!/payment-method" class="btn gradient-bg">$100</a>
                        <a href="https://www.convergepay.com/hosted-payments/?ssl_txn_auth_token=vS0Q2Ej5Twy2Ly%2Bn8ngVywAAAXV6TOs1#!/payment-method" class="btn gradient-bg">CUSTOM</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="row justify-content-center">
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
        </div> -->
    </div>

</section>