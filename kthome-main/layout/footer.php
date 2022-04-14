
<!-- Start Footer Section -->
<footer class="footer-section footer-bg section-top-gap-100">
    <div class="footer-wrapper">
        <!-- Start Footer Top -->
        <div class="footer-top">
            <div class="container">
                <div class="row mb-n6">
                    <div class="col-lg-3 col-sm-6 mb-6">
                        <!-- Start Footer Single Item -->
                        <div class="footer-widget-single-item footer-widget-color--pink" data-aos="fade-up"  data-aos-delay="0">
                            <h5 class="title">Hệ thống cửa hàng</h5>
                            <ul class="footer-nav">
<!--                                <li> <a href="#"><i class="fa fa-map-marker-alt" style="margin-right: 5px"></i>475A Điện Biên Phủ, Phường 25, Bình Thạnh, Thành phố Hồ Chí Minh</a></li>-->
<!--                                <li><a href="#"><i class="fa fa-phone-alt" style="margin-right: 5px"></i>0908745138 - 0387568948</a></li>-->
<!--                                <li><a href="#"><i class="fa fa-mail-bulk" style="margin-right: 5px"></i>kthomeinterior@gmail.com</a></li>-->
                                    <address>
                                        <li><i class="fa fa-map-marker-alt" style="margin-right: 5px"></i>475A Điện Biên Phủ, Phường 25, Bình Thạnh, Thành phố Hồ Chí Minh</li>
                                        <li><i class="fa fa-phone-alt" style="margin-right: 5px"></i>0908745138 - 0387568948</li>
                                        <li><i class="fa fa-mail-bulk" style="margin-right: 5px"></i>kthomeinterior@gmail.com</li>
                                    </address>
                            </ul>
                        </div>
                        <!-- End Footer Single Item -->
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-6">
                        <!-- Start Footer Single Item -->
                        <div class="footer-widget-single-item footer-widget-color--pink" data-aos="fade-up"  data-aos-delay="200">
                            <h5 class="title">Sản phẩm</h5>
                            <ul class="footer-nav">
                                <?php
                                $layloaisp = 'SELECT * FROM loaisp';
                                $truyvan = mysqli_query($conn,$layloaisp);
                                while ($row = mysqli_fetch_array($truyvan)){
                                    $getcount = "SELECT * FROM sanpham WHERE MaLoaiSp = '".$row["MaLoaiSP"]."'";
                                    $db = mysqli_query($conn,$getcount);
                                    $count = mysqli_num_rows($db);
                                    ?>
                                    <li><a href="../page/DanhMucSp.php?loaisp=<?php echo $row["MaLoaiSP"]?>"><?php echo $row["TenLoai"]?> (<?php echo $count?>)</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        <!-- End Footer Single Item -->
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-6">
                        <!-- Start Footer Single Item -->
                        <div class="footer-widget-single-item footer-widget-color--pink" data-aos="fade-up"  data-aos-delay="400">
                            <h5 class="title">Info</h5>
                            <ul class="footer-nav">
                                <li><a href="../page/privacy-policy.php">Chính sách bảo mật</a></li>
                                <li><a href="../page/contact-us.php">Contact us</a></li>
                                <li><a href="../page/about-us.php">About Us</a></li>
                                <li><a href="../page/faq.php">F&Qs</a></li>
                            </ul>
                        </div>
                        <!-- End Footer Single Item -->
                    </div>
                    <div class="col-lg-3 col-sm-6 mb-6">

                        <!-- Start Footer Single Item -->
                        <div class="footer-widget-single-item footer-widget-color--pink" data-aos="fade-up"  data-aos-delay="600">
                            <h5 class="title">Fanpage</h5>
                            <div class="footer-about">
<!--                                <p>We are a team of designers and developers that create high quality Magento, Prestashop, Opencart.</p>-->
<!---->
<!--                                <address>-->
<!--                                    <span>Address: 4710-4890 Breckinridge St, Fayettevill</span>-->
<!--                                    <span>Email: yourmail@mail.com</span>-->
<!--                                </address>-->

                                <div class="fb-page"
                                     data-href="https://www.facebook.com/makemyhomevn/?ref=aymt_homepage_panel"
                                     data-width="550"
                                     data-hide-cover="false"
                                     data-show-facepile="false"></div>

                            </div>
                        </div>
                        <!-- End Footer Single Item -->
                    </div>

                </div>
            </div>
        </div>
        <!-- End Footer Top -->

        <!-- Start Footer Center -->
        <div class="footer-center">
            <div class="container">
                <div class="row mb-n6">
                    <div class="col-xl-3 col-lg-4 col-md-6 mb-6">
                        <div class="footer-social" data-aos="fade-up"  data-aos-delay="0">
                            <h4 class="title">FOLLOW US</h4>
                            <ul class="footer-social-link">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6 col-md-6 mb-6">
                        <div class="footer-newsletter" data-aos="fade-up"  data-aos-delay="200">
                            <h4 class="title">DON'T MISS OUT ON THE LATEST</h4>
                            <div class="form-newsletter">
                                <form action="#" method="post">
                                    <div class="form-fild-newsletter-single-item input-color--pink">
                                        <input type="email" placeholder="Your email address..." required>
                                        <button type="submit">SUBSCRIBE!</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Footer Center -->

        <!-- Start Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="row justify-content-between align-items-center align-items-center flex-column flex-md-row mb-n6">
                    <div class="col-auto mb-6">
                        <div class="footer-copyright">
                            <p> COPYRIGHT &copy;  2021 KTHome</p>
                        </div>
                    </div>
                    <div class="col-auto mb-6">
                        <div class="footer-payment">
                            <div class="image">
                                <img src="../images/company-logo/payment.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Footer Bottom -->
    </div>
</footer>
<!-- End Footer Section -->

<!-- material-scrolltop button -->
<button class="material-scrolltop" type="button"></button>

<!-- Start Modal Quickview cart -->
<div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col text-right">
                            <button type="button" class="close modal-close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-details-gallery-area mb-7">
                                <!-- Start Large Image -->
                                <div class="product-large-image modal-product-image-large swiper-container">
                                    <div class="swiper-wrapper">
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="../images/product/default/home-3/default-1.jpg" alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="../images/product/default/home-3/default-2.jpg" alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="../images/product/default/home-3/default-3.jpg" alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="../images/product/default/home-3/default-4.jpg" alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="../images/product/default/home-3/default-5.jpg" alt="">
                                        </div>
                                        <div class="product-image-large-image swiper-slide img-responsive">
                                            <img src="../images/product/default/home-3/default-6.jpg" alt="">
                                        </div>
                                    </div>
                                </div>
                                <!-- End Large Image -->
                                <!-- Start Thumbnail Image -->
                                <div class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">
                                    <div class="swiper-wrapper">
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid" src="../images/product/default/home-3/default-1.jpg" alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid" src="../images/product/default/home-3/default-2.jpg" alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid" src="../images/product/default/home-3/default-3.jpg" alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid" src="../images/product/default/home-3/default-4.jpg" alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid" src="../images/product/default/home-3/default-5.jpg" alt="">
                                        </div>
                                        <div class="product-image-thumb-single swiper-slide">
                                            <img class="img-fluid" src="../images/product/default/home-3/default-6.jpg" alt="">
                                        </div>
                                    </div>
                                    <!-- Add Arrows -->
                                    <div class="gallery-thumb-arrow swiper-button-next"></div>
                                    <div class="gallery-thumb-arrow swiper-button-prev"></div>
                                </div>
                                <!-- End Thumbnail Image -->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="modal-product-details-content-area">
                                <!-- Start  Product Details Text Area-->
                                <div class="product-details-text">
                                    <h4 class="title">Nonstick Dishwasher PFOA</h4>
                                    <div class="price"><del>$70.00</del>$80.00</div>
                                </div> <!-- End  Product Details Text Area-->
                                <!-- Start Product Variable Area -->
                                <div class="product-details-variable">
                                    <!-- Product Variable Single Item -->
                                    <div class="variable-single-item">
                                        <span>Color</span>
                                        <div class="product-variable-color">
                                            <label for="modal-product-color-red">
                                                <input name="modal-product-color" id="modal-product-color-red" class="color-select" type="radio" checked>
                                                <span class="product-color-red"></span>
                                            </label>
                                            <label for="modal-product-color-tomato">
                                                <input name="modal-product-color" id="modal-product-color-tomato" class="color-select" type="radio">
                                                <span class="product-color-tomato"></span>
                                            </label>
                                            <label for="modal-product-color-green">
                                                <input name="modal-product-color" id="modal-product-color-green" class="color-select" type="radio">
                                                <span class="product-color-green"></span>
                                            </label>
                                            <label for="modal-product-color-light-green">
                                                <input name="modal-product-color" id="modal-product-color-light-green" class="color-select" type="radio">
                                                <span class="product-color-light-green"></span>
                                            </label>
                                            <label for="modal-product-color-blue">
                                                <input name="modal-product-color" id="modal-product-color-blue" class="color-select" type="radio">
                                                <span class="product-color-blue"></span>
                                            </label>
                                            <label for="modal-product-color-light-blue">
                                                <input name="modal-product-color" id="modal-product-color-light-blue" class="color-select" type="radio">
                                                <span class="product-color-light-blue"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <!-- Product Variable Single Item -->
                                    <div class="d-flex align-items-center flex-wrap">
                                        <div class="variable-single-item ">
                                            <span>Quantity</span>
                                            <div class="product-variable-quantity">
                                                <input min="1" max="100" value="1" type="number">
                                            </div>
                                        </div>

                                        <div class="product-add-to-cart-btn">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add To Cart</a>
                                        </div>
                                    </div>
                                </div> <!-- End Product Variable Area -->
                                <div class="modal-product-about-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel recusandae</p>
                                </div>
                                <!-- Start  Product Details Social Area-->
                                <div class="modal-product-details-social">
                                    <span class="title">SHARE THIS PRODUCT</span>
                                    <ul>
                                        <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                        <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                    </ul>

                                </div> <!-- End  Product Details Social Area-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Modal Quickview cart -->

<!-- ::::::::::::::All JS Files here :::::::::::::: -->
<!-- Global Vendor, plugins JS -->
<script src="../js/vendor/modernizr-3.11.2.min.js"></script>
<script src="../js/vendor/jquery-3.5.1.min.js"></script>
<script src="../js/vendor/jquery-migrate-3.3.0.min.js"></script>
<script src="../js/vendor/popper.min.js"></script>
<script src="../js/vendor/bootstrap.min.js"></script>
<script src="../js/vendor/jquery-ui.min.js"></script>

<!--Plugins JS-->
<script src="../js/plugins/swiper-bundle.min.js"></script>
<script src="../js/plugins/material-scrolltop.js"></script>
<script src="../js/plugins/jquery.nice-select.min.js"></script>
<script src="../js/plugins/jquery.zoom.min.js"></script>
<script src="../js/plugins/venobox.min.js"></script>
<script src="../js/plugins/jquery.waypoints.js"></script>
<script src="../js/plugins/jquery.lineProgressbar.js"></script>
<script src="../js/plugins/aos.min.js"></script>
<script src="../js/plugins/jquery.instagramFeed.js"></script>
<script src="../js/plugins/ajax-mail.js"></script>

<!-- Use the minified version files listed below for better performance and remove the files listed above -->
<!-- <script src="../js/vendor/vendor.min.js"></script>
<script src="../js/plugins/plugins.min.js"></script>-->

<script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    var usd = document.getElementById("vnd_to_usd").value;
    paypal.Button.render({
        // Configure environment
        env: 'sandbox',
        client: {
            sandbox: 'AQI9CUV9bP7hdN90ds5OnPdFPq-vnjAkBQ4bM6Zz56SNTca4mPN2Fgy7NFxHA7u71qiqNuzTirGq47cm',
            production: 'demo_production_client_id'
        },
        // Customize button (optional)
        locale: 'en_US',
        style: {
            size: 'small',
            color: 'blue',
            shape: 'pill',
        },

        // Enable Pay Now checkout flow (optional)
        commit: true,

        // Set up a payment
        payment: function(data, actions) {
            return actions.payment.create({
                transactions: [{
                    amount: {
                        total: `${usd}`,
                        currency: 'USD'
                    }
                }]
            });
        },
        // Execute the payment
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                // Show a confirmation message to the buyer
                window.alert('Cám ơn bạn đãt đặt hàng!');
                document.getElementById('thanhtoandathang').click();
            });
        }
    }, '#paypal-button');
</script>



<!-- Main JS -->
<script src="../js/main.js"></script>
<script src="../js/jsnguoidung.js"></script>
<script src="../js/tinhthanhpho.js"></script>
<!--<script src="../js/phuongxa.js"></script>-->
<script src="../js/searchprice.js"></script>





<div class="zalo-chat-widget" data-oaid="4072615585341506477" data-welcome-message="Rất vui khi được hỗ trợ bạn!" data-autopopup="0" data-width="300" data-height="500"></div>

<script src="https://sp.zalo.me/plugins/sdk.js"></script>

</body>

<!-- Mirrored from htmldemo.hasthemes.com/hono/hono/index-3.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Jan 2021 00:32:12 GMT -->
<../