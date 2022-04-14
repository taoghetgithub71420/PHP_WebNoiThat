<?php
//    include ('../layout/header.php')
//?>

    <!DOCTYPE html>
    <html lang="zxx">

    <!-- Mirrored from htmldemo.hasthemes.com/hono/hono/index.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 06 Jan 2021 00:31:04 GMT -->
    <!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <head>
        <?php
        include ('../page/connect.php')
        ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>KTHOME</title>

        <!-- ::::::::::::::Favicon icon::::::::::::::-->
        <link rel="shortcut icon" href="../images/favicon.ico" type="image/png">

        <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="../css/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="../css/vendor/ionicons.css">
        <link rel="stylesheet" href="../css/vendor/simple-line-icons.css">
        <link rel="stylesheet" href="../css/vendor/jquery-ui.min.css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="../css/plugins/swiper-bundle.min.css">
        <link rel="stylesheet" href="../css/plugins/animate.min.css">
        <link rel="stylesheet" href="../css/plugins/nice-select.css">
        <link rel="stylesheet" href="../css/plugins/venobox.min.css">
        <link rel="stylesheet" href="../css/plugins/jquery.lineProgressbar.css">
        <link rel="stylesheet" href="../css/plugins/aos.min.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <script src="../js/jsnguoidung.js"></script>


        <link rel="stylesheet" href="../Content/bootstrap.min.css>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <script src="https://kit.fontawesome.com/ab2155e76b.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins&display=swap">
        <link rel="stylesheet"  href="../css/App.css" />


        <!-- Main CSS -->
        <!--<link rel="stylesheet" href="../sass/style.css">-->
        <link rel="stylesheet" href="../css/style.css">
        <!-- Use the minified version files listed below for better performance and remove the files listed above -->
        <!--<link rel="stylesheet" href="../css/vendor/vendor.min.css">
        <link rel="stylesheet" href="../css/plugins/plugins.min.css">
        <link rel="stylesheet" href="../css/style.min.css">-->
        <?php
        session_start();
        if(isset($_GET["dx"])) {
            unset($_SESSION["tendangnhap"]);
            echo "<script>location='index.php';</script>";
        }
        ?>

    </head>
<body>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0&appId=220773626740849&autoLogAppEvents=1" nonce="Yn9SkCki"></script>

<!-- Start Header Area -->
<header class="header-section d-none d-xl-block">
    <div class="header-wrapper">
        <div class="header-bottom header-bottom-color--golden section-fluid sticky-header sticky-color--golden">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 d-flex align-items-center justify-content-between">
                        <!-- Start Header Logo -->
                        <div class="header-logo">
                            <div class="logo">
                                <a href="../page/index.php"><img src="../images/logo/logoshop.jpg" alt=""></a>
                            </div>
                        </div>
                        <!-- End Header Logo -->

                        <!-- Start Header Main Menu -->
                        <div class="main-menu menu-color--black menu-hover-color--golden">
                            <nav>
                                <ul>
                                    <li class="has-dropdown">
                                        <a class="active main-menu-link" href="../page/index.php">Home </a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="../page/shop-full-width.php">Shop <i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            <?php
                                            $layloaisp = 'SELECT * FROM loaisp';
                                            $dbdata = mysqli_query($conn,$layloaisp);
                                            while ($row = mysqli_fetch_array($dbdata)){
                                                $getcount = "SELECT * FROM sanpham WHERE MaLoaiSp = '".$row["MaLoaiSP"]."'";
                                                $db = mysqli_query($conn,$getcount);
                                                $count = mysqli_num_rows($db);
                                                ?>
                                                <li><a href="../page/DanhMucSp.php?loaisp=<?php echo $row["MaLoaiSP"]?>"><?php echo $row["TenLoai"]?> (<?php echo $count?>)</a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="../page/blog-full-width.php">Blog</a>
                                    </li>
                                    <li class="has-dropdown">
                                        <a href="#">F&Q <i class="fa fa-angle-down"></i></a>
                                        <!-- Sub Menu -->
                                        <ul class="sub-menu">
                                            <li><a href="../page/faq.php">Frequently Questions</a></li>
                                            <li><a href="../page/privacy-policy.php">Privacy Policy</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="../page/about-us.php">About Us</a>
                                    </li>
                                    <li>
                                        <a href="../page/contact-us.php">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!-- End Header Main Menu Start -->

                        <!-- Start Header Action Link -->
                        <ul class="header-action-link action-color--black action-hover-color--golden">
                            <!--                            <li>-->
                            <!--                                <a href="#offcanvas-wishlish" class="offcanvas-toggle">-->
                            <!--                                    <i class="icon-heart"></i>-->
                            <!--                                    <span class="item-count">3</span>-->
                            <!--                                </a>-->
                            <!--                            </li>-->

                            <?php
                            $number=0;
                            if(isset($_SESSION["giohang"])){
                                $giohang = $_SESSION["giohang"];
                                foreach ($giohang as $key => $value){
                                    $number +=(int)$value["number"];
                                }
                            }
                            ?>
                            <li>
                                <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                    <i class="icon-bag"></i>
                                    <span id="soluongcart" class="item-count"><?php echo $number?></span>
                                </a>
                            </li>
                            <li>
                                <a href="#search">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </li>
                            <?php if(!isset($_SESSION["tendangnhap"])){ ?>
                                <li>
                                    <a href="../page/login.php">
                                        <i class="icon-user"></i>
                                    </a>
                                </li>
                            <?php } else { ?>
                                <li class="has-dropdown">
                                    <a href="../page/thongtindonhang.php">
                                        <i class="icon-social-dropbox"></i>
                                    </a>
                                </li>
                                <li >
                                    <a href="doimatkhau.php">Hi - <?php echo $_SESSION["tendangnhap"]?></a>
                                    <!--                                    Hello - --><?php //echo $_SESSION["tendangnhap"]?>
                                    <a href="<?php echo $_SERVER["PHP_SELF"];?>?dx=0">
                                        <i class="icon-logout"></i>
                                    </a>
                                </li>
                            <?php }?>
                            <li>
                                <a href="#offcanvas-about" class="offacnvas offside-about offcanvas-toggle">
                                    <i class="icon-menu"></i>
                                </a>
                            </li>
                        </ul>
                        <!-- End Header Action Link -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Start Header Area -->

<!-- Start Mobile Header -->
<div class="mobile-header mobile-header-bg-color--golden section-fluid d-lg-block d-xl-none">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex align-items-center justify-content-between">
                <!-- Start Mobile Left Side -->
                <div class="mobile-header-left">
                    <ul class="mobile-menu-logo">
                        <li>
                            <a href="../page/index.php">
                                <div class="logo">
                                    <img src="../images/logo/logo_black.png" alt="">
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Left Side -->

                <!-- Start Mobile Right Side -->
                <div class="mobile-right-side">
                    <ul class="header-action-link action-color--black action-hover-color--golden">
                        <li>
                            <a href="#search">
                                <i class="icon-magnifier"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-wishlish" class="offcanvas-toggle">
                                <i class="icon-heart"></i>
                                <span class="item-count">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="#offcanvas-add-cart" class="offcanvas-toggle">
                                <i class="icon-bag"></i>
                                <span class="item-count">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="#mobile-menu-offcanvas" class="offcanvas-toggle offside-menu">
                                <i class="icon-menu"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- End Mobile Right Side -->
            </div>
        </div>
    </div>
</div>
<!-- End Mobile Header -->

<!--  Start Offcanvas Mobile Menu Section -->
<div id="mobile-menu-offcanvas" class="offcanvas offcanvas-rightside offcanvas-mobile-menu-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-mobile-menu-wrapper">
        <!-- Start Mobile Menu  -->
        <div class="mobile-menu-bottom">
            <!-- Start Mobile Menu Nav -->
            <div class="offcanvas-menu">
                <ul>
                    <li>
                        <a href="#"><span>Home</span></a>
                        <ul class="mobile-sub-menu">
                            <li><a href="../page/index.php">Home 1</a></li>
                            <li><a href="../page/index-2.php">Home 2</a></li>
                            <li><a href="../page/index-3.php">Home 3</a></li>
                            <li><a href="../page/index-4.php">Home 4</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><span>Shop</span></a>
                        <ul class="mobile-sub-menu">
                            <li>
                                <a href="#">Shop Layout</a>
                                <ul class="mobile-sub-menu">
                                    <li><a href="../page/shop-grid-sidebar-left.php">Grid Left Sidebar</a></li>
                                    <li><a href="../page/shop-grid-sidebar-right.php">Grid Right Sidebar</a></li>
                                    <li><a href="../page/shop-full-width.php">Full Width</a></li>
                                    <li><a href="../page/shop-list-sidebar-left.php">List Left Sidebar</a></li>
                                    <li><a href="../page/shop-list-sidebar-right.php">List Right Sidebar</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="mobile-sub-menu">
                            <li>
                                <a href="#">Shop Pages</a>
                                <ul class="mobile-sub-menu">
                                    <li><a href="../page/cart.php">Cart</a></li>
                                    <li><a href="../page/empty-cart.php">Empty Cart</a></li>
                                    <li><a href="../page/../page/wishlist.php">Wishlist</a></li>
                                    <li><a href="../page/../page/compare.php">Compare</a></li>
                                    <li><a href="../page/../page/checkout.php">Checkout</a></li>
                                    <li><a href="../page/../page/login.php">Login</a></li>
                                    <li><a href="../page/../page/my-account.php">My Account</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="mobile-sub-menu">
                            <li>
                                <a href="#">Product Single</a>
                                <ul class="mobile-sub-menu">
                                    <li><a href="../page/../page/product-details-default.php">Product Default</a></li>
                                    <li><a href="../page/../page/product-details-variable.php">Product Variable</a></li>
                                    <li><a href="../page/../page/product-details-affiliate.php">Product Referral</a></li>
                                    <li><a href="../page/../page/product-details-group.php">Product Group</a></li>
                                    <li><a href="../page/../page/product-details-single-slide.php">Product Slider</a></li>
                                    <li><a href="../page/../page/product-details-tab-left.php">Product Tab Left</a></li>
                                    <li><a href="../page/../page/product-details-tab-right.php">Product Tab Right</a></li>
                                    <li><a href="../page/../page/product-details-gallery-left.php">Product Gallery Left</a></li>
                                    <li><a href="../page/../page/product-details-gallery-right.php">Product Gallery Right</a></li>
                                    <li><a href="../page/../page/product-details-sticky-left.php">Product Sticky Left</a></li>
                                    <li><a href="../page/../page/product-details-sticky-right.php">Product Sticky right</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><span>Blogs</span></a>
                        <ul class="mobile-sub-menu">
                            <li>
                                <a href="#">Blog Grid</a>
                                <ul class="mobile-sub-menu">
                                    <li><a href="../page/../page/blog-grid-sidebar-left.php">Blog Grid Sidebar left</a></li>
                                    <li><a href="../page/../page/blog-grid-sidebar-right.php">Blog Grid Sidebar Right</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="../page/blog-full-width.php">Blog Full Width</a>
                            </li>
                            <li>
                                <a href="#">Blog List</a>
                                <ul class="mobile-sub-menu">
                                    <li><a href="../page/blog-list-sidebar-left.php">Blog List Sidebar left</a></li>
                                    <li><a href="../page/blog-list-sidebar-right.php">Blog List Sidebar Right</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Blog Single</a>
                                <ul class="mobile-sub-menu">
                                    <li><a href="../page/blog-single-sidebar-left.php">Blog Single Sidebar left</a></li>
                                    <li><a href="../page/blog-single-sidebar-right.php">Blog Single Sidebar Right</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><span>Pages</span></a>
                        <ul class="mobile-sub-menu">
                            <li><a href="../page/faq.php">Frequently Questions</a></li>
                            <li><a href="../page/privacy-policy.php">Privacy Policy</a></li>
                            <li><a href="../page/404.php">404 Page</a></li>
                        </ul>
                    </li>
                    <li><a href="../page/about-us.php">About Us</a></li>
                    <li><a href="../page/contact-us.php">Contact Us</a></li>
                </ul>
            </div> <!-- End Mobile Menu Nav -->
        </div> <!-- End Mobile Menu -->

        <!-- Start Mobile contact Info -->
        <div class="mobile-contact-info">
            <div class="logo">
                <a href="../page/index.php"><img src="../images/logo/logo_white.png" alt=""></a>
            </div>

            <address class="address">
                <span>Address: 4710-4890 Breckinridge St, Fayettevill</span>
                <span>Call Us: (+800) 345 678, (+800) 123 456</span>
                <span>Email: yourmail@mail.com</span>
            </address>

            <ul class="social-link">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>

            <ul class="user-link">
                <li><a href="../page/wishlist.php">Wishlist</a></li>
                <li><a href="../page/cart.php">Cart</a></li>
                <li><a href="../page/checkout.php">Checkout</a></li>
            </ul>
        </div>
        <!-- End Mobile contact Info -->

    </div> <!-- End Offcanvas Mobile Menu Wrapper -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-about" class="offcanvas offcanvas-rightside offcanvas-mobile-about-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->
    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <!-- Start Mobile contact Info -->
    <div class="mobile-contact-info">
        <div class="logo">
            <a href="../page/index.php"><img src="../images/logo/logo_white.png" alt=""></a>
        </div>

        <address class="address">
            <span>Address: 4710-4890 Breckinridge St, Fayettevill</span>
            <span>Call Us: (+800) 345 678, (+800) 123 456</span>
            <span>Email: yourmail@mail.com</span>
        </address>

        <ul class="social-link">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>

        <!--        <ul class="user-link">-->
        <!--            <li><a href="../page/../page/wishlist.php">Wishlist</a></li>-->
        <!--            <li><a href="../page/../page/cart.php">Cart</a></li>-->
        <!--            <li><a href="../page/../page/checkout.php">Checkout</a></li>-->
        <!--        </ul>-->
    </div>
    <!-- End Mobile contact Info -->
</div> <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

<!-- Start Offcanvas Addcart Section -->
<div id="offcanvas-add-cart" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- End Offcanvas Header -->

    <!-- Start  Offcanvas Addcart Wrapper -->
    <div class="offcanvas-add-cart-wrapper">
        <h4 class="offcanvas-title">Shopping Cart</h4>

        <ul class="offcanvas-cart">
            <?php
            $total = 0;
            $totaltongtien = 0;
            if(isset($_SESSION["giohang"])){
                $giohang = $_SESSION["giohang"];
                foreach ($giohang as $key => $value){
                    ?>
                    <li class="offcanvas-cart-item-single">
                        <div class="offcanvas-cart-item-block">
                            <a href="#" class="offcanvas-cart-item-image-link">
                                <img src="../images/imageproduct/<?php echo $value["image"]?>" alt="" class="offcanvas-cart-image">
                            </a>
                            <div class="offcanvas-cart-item-content">
                                <a href="#" class="offcanvas-cart-item-link"><?php echo $value["name"]?></a>
                                <div class="offcanvas-cart-item-details">
                                    <span class="offcanvas-cart-item-details-quantity">Số lượng: <?php echo $value["number"]?> </span> <br>
                                    <span class="offcanvas-cart-item-details-price">Giá: <?php echo number_format($value["price"],0,",",".")?> VNĐ</span>
                                </div>
                                <div class="offcanvas-cart-item-details">
                                    <b>
                                        Thành tiền:
                                    </b>
                                    <span class="offcanvas-cart-item-details-price"><?php
                                        $total = $value["number"] * $value["price"];
                                        $totaltongtien += $total;
                                        echo number_format($total,0,",",".");
                                        ?> VNĐ
                            </span>
                                </div>
                            </div>
                        </div>
                        <div class="offcanvas-cart-item-delete text-right">
                            <a href="#" class="offcanvas-cart-item-delete" onclick="deleteCart(<?php echo $key?>)"><i class="fa fa-trash-o"></i></a>
                        </div>
                    </li>
                <?php } } else{?>
                <img src="../images/emprt-cart/empty-cart.png" alt="" class="offcanvas-cart-image">
            <?php }?>
        </ul>
        <div class="offcanvas-cart-total-price">
            <span class="offcanvas-cart-total-price-text">Tổng tiền:</span>
            <span class="offcanvas-cart-total-price-value"><?php echo number_format($totaltongtien,0,",",".");?> VNĐ</span>
        </div>
        <ul class="offcanvas-cart-action-button">
            <li><a href="../page/cart.php" class="btn btn-block btn-golden">View Cart</a></li>
            <li><a href="../page/checkout.php" class=" btn btn-block btn-golden mt-5">Checkout</a></li>
        </ul>
    </div> <!-- End  Offcanvas Addcart Wrapper -->

</div> <!-- End  Offcanvas Addcart Section -->

<!-- Start Offcanvas Mobile Menu Section -->
<div id="offcanvas-wishlish" class="offcanvas offcanvas-rightside offcanvas-add-cart-section">
    <!-- Start Offcanvas Header -->
    <div class="offcanvas-header text-right">
        <button class="offcanvas-close"><i class="ion-android-close"></i></button>
    </div> <!-- ENd Offcanvas Header -->

    <!-- Start Offcanvas Mobile Menu Wrapper -->
    <div class="offcanvas-wishlist-wrapper">
        <h4 class="offcanvas-title">Wishlist</h4>
        <ul class="offcanvas-wishlist">
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="../images/product/default/home-1/default-1.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link">Car Wheel</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$49.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="../images/product/default/home-2/default-1.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link">Car Vails</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">3 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$500.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
            <li class="offcanvas-wishlist-item-single">
                <div class="offcanvas-wishlist-item-block">
                    <a href="#" class="offcanvas-wishlist-item-image-link">
                        <img src="../images/product/default/home-3/default-1.jpg" alt="" class="offcanvas-wishlist-image">
                    </a>
                    <div class="offcanvas-wishlist-item-content">
                        <a href="#" class="offcanvas-wishlist-item-link">Shock Absorber</a>
                        <div class="offcanvas-wishlist-item-details">
                            <span class="offcanvas-wishlist-item-details-quantity">1 x </span>
                            <span class="offcanvas-wishlist-item-details-price">$350.00</span>
                        </div>
                    </div>
                </div>
                <div class="offcanvas-wishlist-item-delete text-right">
                    <a href="#" class="offcanvas-wishlist-item-delete"><i class="fa fa-trash-o"></i></a>
                </div>
            </li>
        </ul>
        <ul class="offcanvas-wishlist-action-button">
            <li><a href="../page/wishlist.php" class="btn btn-block btn-golden">View wishlist</a></li>
        </ul>
    </div> <!-- End Offcanvas Mobile Menu Wrapper -->

</div> <!-- End Offcanvas Mobile Menu Section -->

<!-- Start Offcanvas Search Bar Section -->
<div id="search" class="search-modal">
    <button type="button" class="close">×</button>
    <form method="post" action="TimKiem.php">
        <input name="timkiemtensp" type="search" placeholder="type keyword(s) here" />
        <button type="submit" class="btn btn-lg btn-golden">Search</button>
    </form>
</div>
<!-- End Offcanvas Search Bar Section -->




<!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Contact Us</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="../page/index.php">Home</a></li>
                                    <li class="active" aria-current="page">Contact Us</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...::::Start Map Section:::... -->
    <div class="map-section" data-aos="fade-up"  data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <!--<iframe id="gmap_canvas" src="https://maps.google.com/maps?q=121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"></iframe>-->
<!--                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.48393590318!2d106.68360961532069!3d10.774198762179706!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f248f287f0d%3A0xcea606fe652b522b!2zMzUyIE5ndXnhu4VuIMSQw6xuaCBDaGnhu4N1LCBQaMaw4budbmcgNCwgUXXhuq1uIDMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1632834510211!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>-->
                            <div class="jumbotron">
                                <div class="container-fluid">
                                    <h1>Hỗ trợ khách hàng tìm kiếm vị trí</h1>
                                    <p>Ứng dụng này sẽ giúp bạn tính toán khoảng cách di chuyển của mình.</p>
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <label for="from" class="col-xs-2 control-label"><i class="far fa-dot-circle"></i></label>
                                            <div class="col-xs-8">
                                                <input style="font-size: 16px;"
                                                       type="text" id="from" placeholder="Từ" class="form-control"
                                                       value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="to" class="col-xs-2 control-label"><i class="fas fa-map-marker-alt"></i></label>
                                            <div class="col-xs-8">
                                                <input  style="font-size: 20px;"
                                                        type="text" id="to" placeholder="475A Điện Biên Phủ, P.25, Q. Bình Thạnh"
                                                        value="475A Điện Biên Phủ, P.25, Q. Bình Thạnh" class="form-control">
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-xs-offset-2 col-xs-10" style="margin-top: 10px">
                                        <button class="btn btn-info btn-lg " onclick="calcRoute();"><i class="fas fa-map-signs">Xem đường đi đến cửa hàng   </i></button>
                                    </div>
                                </div>
                                <div class="container-fluid">
                                    <div id="googleMap">

                                    </div>
                                    <div id="output">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...::::End  Map Section:::... -->

    <!-- ...::::Start Contact Section:::... -->
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Start Contact Details -->
                    <div class="contact-details-wrapper section-top-gap-100" data-aos="fade-up"  data-aos-delay="0">
                        <div class="contact-details">
                            <!-- Start Contact Details Single Item -->
                            <div class="contact-details-single-item">
                                <div class="contact-details-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-details-content contact-phone">
                                    <a href="tel:+012345678102">+012 345 678 102</a>
                                    <a href="tel:+012345678102">+012 345 678 102</a>
                                </div>
                            </div> <!-- End Contact Details Single Item -->
                            <!-- Start Contact Details Single Item -->
                            <div class="contact-details-single-item">
                                <div class="contact-details-icon">
                                    <i class="fa fa-globe"></i>
                                </div>
                                <div class="contact-details-content contact-phone">
                                    <a href="mailto:urname@email.com">urname@email.com</a>
                                    <a href="http://www.yourwebsite.com/">www.yourwebsite.com</a>
                                </div>
                            </div> <!-- End Contact Details Single Item -->
                            <!-- Start Contact Details Single Item -->
                            <div class="contact-details-single-item">
                                <div class="contact-details-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-details-content contact-phone">
                                    <span>Address goes here,</span>
                                    <span>street, Crossroad 123.</span>
                                </div>
                            </div> <!-- End Contact Details Single Item -->
                        </div>
                        <!-- Start Contact Social Link -->
                        <div class="contact-social">
                            <h4>Follow Us</h4>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div> <!-- End Contact Social Link -->
                    </div> <!-- End Contact Details -->
                </div>
                <div class="col-lg-8">
                    <div class="contact-form section-top-gap-100" data-aos="fade-up"  data-aos-delay="200">
                        <h3>Get In Touch</h3>
                        <form id="contact-form" action="https://htmlmail.hasthemes.com/nazmul/mail.php" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-name">Name</label>
                                        <input name="name" type="text" id="contact-name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-email">Email</label>
                                        <input name="email" type="email" id="contact-email">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-subject">Subject</label>
                                        <input name="subject" type="text" id="contact-subject">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="default-form-box mb-20">
                                        <label for="contact-message">Your Message</label>
                                        <textarea name="message" id="contact-message" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-lg btn-black-default-hover" type="submit">SEND</button>
                                </div>
                                <p class="form-messege"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ...::::ENd Contact Section:::... -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBsZrS5LkAXAqzgVYMJQQMYOoWgYCHHZTU&libraries=places"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="Scripts/jquery-3.1.1.min.js"></script> -->
    <script src="../js/Map.js"></script>
<?php
    include ('../layout/footer.php')
?>