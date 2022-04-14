<?php
    include ('../layout/header.php')
?>

<?php
    if(!isset($_GET["Masp"]))
        echo "<script>location='index.php';</script>";
    $laysanpham = "SELECT * FROM sanpham WHERE MaSanPham = '".$_GET["Masp"]."'";
    $truyvan = mysqli_query($conn,$laysanpham);
    $dbdata = mysqli_fetch_array($truyvan);

    // Truy vấn ra loại sản phẩm
    $layloaiSp = "SELECT * FROM sanpham INNER JOIN loaisp ON sanpham.MaLoaiSp = loaisp.MaLoaiSP WHERE MaSanPham = '".$_GET["Masp"]."'";
    $truyvanloaiSp = mysqli_query($conn,$layloaiSp);
    if(mysqli_num_rows($truyvanloaiSp) > 0)
    {
        $dbdataLoaiSp = mysqli_fetch_array($truyvanloaiSp);
    } else{
        echo "<script>location='index.php';</script>";
    }

    // Truy vấn ra brand sản phẩm
    $laybrandSp = "SELECT * FROM sanpham INNER JOIN thuonghieu ON sanpham.MaThuongHieu = thuonghieu.MaThuongHieu WHERE MaSanPham = '".$_GET["Masp"]."'";
    $truyvanthuonghieuSp = mysqli_query($conn, $laybrandSp);
    if(mysqli_num_rows($truyvanthuonghieuSp) > 0){
        $dbdatathuonghieuSp = mysqli_fetch_array($truyvanthuonghieuSp);
    }else{
        echo "<script>location='index.php';</script>";
    }
?>
<!-- Đếm số lượt bình luận -->
<?php
    $countbl =  "SELECT MaBinhLuan FROM binhluan WHERE MaSanPham = '".$_GET["Masp"]."'";
    $truyvancountbl = mysqli_query($conn, $countbl);
    $getcountbl = mysqli_num_rows($truyvancountbl);
?>

<!-- Bình luận sản phẩm -->
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $masp= $_GET["Masp"];
        $ngaybinhluan= date("Y-m-d");
        $ndbinhluan=$_POST["ndbinhluan"];
        $tendangnhap=$_SESSION["tendangnhap"];
        $thembl = "INSERT INTO binhluan(MaSanPham,NgayBinhLuan,NoiDung,TenDangNhap) VALUES ('".$masp."','".$ngaybinhluan."','".$ndbinhluan."','".$tendangnhap."') ";
        if(mysqli_query($conn,$thembl)){
            echo "<script>alert('Bình luận của bạn đã được ghi nhận');window.location='product-details-default.php?Masp=".$masp."'</script>";
        } else{
            echo "<script>alert('Đã xảy ra lỗi');</script>";
        }
    }
?>


<!-- Đánh giá sao -->
<?php
    $dbdanhgia = "SELECT * FROM danhgia WHERE MaSanPham = '".$dbdata["MaSanPham"]."'";
    $truyvandanhgia = mysqli_query($conn, $dbdanhgia);

    $tendangnhap = "";
    $sosao = "0";
    if(isset($_SESSION["tendangnhap"]))
    {
        $tendangnhap = $_SESSION["tendangnhap"];
        $layDG_ND = "SELECT * FROM danhgia WHERE MaSanPham='".$dbdata["MaSanPham"]."' and TenDangNhap='".$tendangnhap."'";
        $truyvanND = mysqli_query($conn, $layDG_ND);
        if(mysqli_num_rows($truyvanND) > 0){
            $cotDG = mysqli_fetch_array($truyvanND);
            $sosao = $cotDG["NoiDung"];
        }
    }
?>


<?php
    $tinhsao="SELECT * FROM danhgia WHERE MaSanPham='".$dbdata["MaSanPham"]."'";
    $querysao=mysqli_query($conn,$tinhsao);



    $tinh="SELECT MaSanPham FROM danhgia WHERE MaSanPham= '".$dbdata["MaSanPham"]."' ";
    $querytinh=mysqli_query($conn,$tinh);
    $laytinh=mysqli_num_rows($querytinh);
    //
    $sum= $conn->query("SELECT SUM(NoiDung) AS tongsao FROM danhgia WHERE MaSanPham= '".$dbdata["MaSanPham"]."'");
    $rDt=$sum->fetch_array();
    $total=$rDt['tongsao'];
    //
    //    $avg=$total / $laytinh;
    //?>



<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Shop</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="product-details-default.php">Shop</a></li>
<!--                                <li class="active" aria-current="page">Product Details Default</li>-->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- Start Product Details Section -->
<div class="product-details-section">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6">
                <div class="product-details-gallery-area" data-aos="fade-up"  data-aos-delay="0">
                    <!-- Start Large Image -->
                    <div class="product-large-image product-large-image-horaizontal swiper-container">
                        <?php
                            if($dbdata["SoLuong"] == 0 || $dbdata["MaTrangThaiSanPham"] == 2) {
                        ?>
                        <div class="swiper-wrapper">
                            <div class="product-image-large-image swiper-slide img-responsive">
                                <img src="../images/imageproduct/<?php echo $dbdata["Anh"]?>" alt="" style="opacity: 0.5;">
                                <div style="position: absolute;top: 250px;width: 100%;text-align: center;color: black;font-size: 35px;font-weight: 600"><p style="background: #FEF5EF;width: 570px;padding: 10px">Hết hàng</p></div>
                            </div>
                            <div class="product-image-large-image swiper-slide img-responsive">
                                <img src="../images/imageproduct/<?php echo $dbdata["Anh2"]?>" alt="" style="opacity: 0.5;">
                                <div style="position: absolute;top: 250px;width: 100%;text-align: center;color: black;font-size: 35px;font-weight: 600"><p style="background: #FEF5EF;width: 570px;padding: 10px">Hết hàng</p></div>
                            </div>
                            <div class="product-image-large-image swiper-slide img-responsive">
                                <img src="../images/imageproduct/<?php echo $dbdata["Anh3"]?>" alt="" style="opacity: 0.5;">
                                <div style="position: absolute;top: 250px;width: 100%;text-align: center;color: black;font-size: 35px;font-weight: 600"><p style="background: #FEF5EF;width: 570px;padding: 10px">Hết hàng</p></div>
                            </div>
                            <div class="product-image-large-image swiper-slide img-responsive">
                                <img src="../images/imageproduct/<?php echo $dbdata["Anh4"]?>" alt="" style="opacity: 0.5;">
                                <div style="position: absolute;top: 250px;width: 100%;text-align: center;color: black;font-size: 35px;font-weight: 600"><p style="background: #FEF5EF;width: 570px;padding: 10px">Hết hàng</p></div>
                            </div>
                        </div>

                        <?php } else {?>
                            <div class="swiper-wrapper">
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="../images/imageproduct/<?php echo $dbdata["Anh"]?>" alt="">
                                </div>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="../images/imageproduct/<?php echo $dbdata["Anh2"]?>" alt="">
                                </div>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="../images/imageproduct/<?php echo $dbdata["Anh3"]?>" alt="" >
                                </div>
                                <div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">
                                    <img src="../images/imageproduct/<?php echo $dbdata["Anh4"]?>" alt="">
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <!-- End Large Image -->
                    <!-- Start Thumbnail Image -->
                    <div class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                        <div class="swiper-wrapper">
                            <div class="product-image-thumb-single swiper-slide">
                                <img class="img-fluid" src="../images/imageproduct/<?php echo $dbdata["Anh"] ?>" alt="">
                            </div>
                            <div class="product-image-thumb-single swiper-slide">
                                <img class="img-fluid" src="../images/imageproduct/<?php echo $dbdata["Anh2"] ?>" alt="">
                            </div>
                            <div class="product-image-thumb-single swiper-slide">
                                <img class="img-fluid" src="../images/imageproduct/<?php echo $dbdata["Anh3"] ?>" alt="">
                            </div>
                            <div class="product-image-thumb-single swiper-slide">
                                <img class="img-fluid" src="../images/imageproduct/<?php echo $dbdata["Anh4"] ?>" alt="">
                            </div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="gallery-thumb-arrow swiper-button-next"></div>
                        <div class="gallery-thumb-arrow swiper-button-prev"></div>
                    </div>
                    <!-- End Thumbnail Image -->
                </div>
            </div>
            <div class="col-xl-7 col-lg-6">
                <div class="product-details-content-area product-details--golden" data-aos="fade-up"  data-aos-delay="200">
                    <!-- Start  Product Details Text Area-->
                    <div class="product-details-text">
                        <h4 class="title"><?php echo $dbdata["TenSanPham"]?></h4>
                        <?php if(mysqli_num_rows($querysao ) > 0){
                            $avg = round(($total / $laytinh),2);
                        ?>
                        <div class="d-flex align-items-center">
                            <ul class="review-star">
                                <a style="color: #b19361"><?php echo $avg?></a>
                                <li  class="sao sao1" data-sao="1" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 1)" ><i class="ion-android-star"></i></li>
                                <li  class="sao sao2" data-sao="2" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 2)" ><i class="ion-android-star"></i></li>
                                <li  class="sao sao3" data-sao="3" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 3)" ><i class="ion-android-star"></i></li>
                                <li  class="sao sao4" data-sao="4" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 4)" ><i class="ion-android-star"></i></li>
                                <li  class="sao sao5" data-sao="5" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 5)" ><i class="ion-android-star"></i></li>
                            </ul>
                            <a href="#" class="customer-review ml-2">(<?php echo mysqli_num_rows($truyvandanhgia)?> đánh giá)</a>
                        </div>
                        <?php } else{ ?>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                    <a>0</a>
                                    <li  class="sao sao1" data-sao="1" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 1)" ><i class="ion-android-star"></i></li>
                                    <li  class="sao sao2" data-sao="2" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 2)" ><i class="ion-android-star"></i></li>
                                    <li  class="sao sao3" data-sao="3" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 3)" ><i class="ion-android-star"></i></li>
                                    <li  class="sao sao4" data-sao="4" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 4)" ><i class="ion-android-star"></i></li>
                                    <li  class="sao sao5" data-sao="5" onclick="DanhGiaSao(<?php echo $dbdata["MaSanPham"];?>, '<?php echo $tendangnhap ?>', 5)" ><i class="ion-android-star"></i></li>
                                </ul>
                                <a href="#" class="customer-review ml-2">(<?php echo mysqli_num_rows($truyvandanhgia)?> đánh giá)</a>
                            </div>
                        <?php }?>

                        <div class="price"><?=number_format($dbdata["DonGia"],0,",",".")?> VNĐ</div>
                        <p><?php echo $dbdata["ThongTin"]?></p>
                    </div> <!-- End  Product Details Text Area-->
                    <!-- Start Product Variable Area -->
                    <div class="product-details-variable">
                        <?php
                        if($dbdata["SoLuong"] == 0 || $dbdata["MaTrangThaiSanPham"] == 2) {
                        ?>
                            <div class="product-stock" style="color: red"> <span class="product-stock-in"></span> Đã hết hàng</div>
                            <br>
                        <?php } else {?>
                            <h4 class="title">Available Options</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock" style="color: #81ca33"> <span class="product-stock-in"><i class="ion-checkmark-circled"></i></span> Còn hàng</div>
                            </div>
                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                <div class="variable-single-item ">
                                    <span>Quantity</span>
                                    <div class="product-variable-quantity">
                                        <input id="quanlity" min="1" max="<?php echo $dbdata["SoLuong"]?>" value="1" type="number">
                                    </div>
                                </div>

                                <div class="product-add-to-cart-btn">
                                    <a  onclick="addCart(<?php echo $dbdata["MaSanPham"]?>)" class="btn btn-block btn-lg btn-black-default-hover" data-bs-toggle="modal" data-bs-target="#modalAddcart">+ Add To Cart</a>
                                </div>
                            </div>
                        <?php }?>
                    </div> <!-- End Product Variable Area -->

                    <!-- Start  Product Details Catagories Area-->
                    <div class="product-details-catagory mb-2">
                        <span class="title">CATEGORIES:</span>
                        <ul>
                            <li><a href="../page/DanhMucSp.php?loaisp=<?php echo $dbdataLoaiSp["MaLoaiSP"]?>"><?php echo $dbdataLoaiSp["TenLoai"]?></a></li>
                        </ul>
                    </div> <!-- End  Product Details Catagories Area-->
                    <!-- Start  Product Details Catagories Area-->
                    <div class="product-details-catagory mb-2">
                        <span class="title">BRAND:</span>
                        <ul>
                            <li><a href="#"><?php echo $dbdatathuonghieuSp["TenThuongHieu"]?></a></li>
                        </ul>
                    </div> <!-- End  Product Details Catagories Area-->
                    <!-- Start  Product Details Social Area-->
                    <div class="product-details-social">
                        <span class="title">SHARE THIS PRODUCT:</span>
                        <ul>
<!--                            <div class="fb-like" data-href="https://makemyhomevn.com/" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>-->
                        </ul>
                    </div> <!-- End  Product Details Social Area-->
                    <div class="fb-like" data-href="https://makemyhomevn.com/pages/product" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
            </div>
        </div>
    </div>
</div> <!-- End Product Details Section -->


    <?php
        $count5sao =  "SELECT NoiDung FROM danhgia WHERE NoiDung = 5 AND MaSanPham = '".$_GET["Masp"]."'" ;
        $truyvancount5sao = mysqli_query($conn, $count5sao);
        $getcount5sao = mysqli_num_rows($truyvancount5sao);
    ?>

    <?php
        $count4sao =  "SELECT NoiDung FROM danhgia WHERE NoiDung = 4 AND MaSanPham = '".$_GET["Masp"]."'" ;
        $truyvancount4sao = mysqli_query($conn, $count4sao);
        $getcount4sao = mysqli_num_rows($truyvancount4sao);
    ?>

    <?php
        $count3sao =  "SELECT NoiDung FROM danhgia WHERE NoiDung = 3 AND MaSanPham = '".$_GET["Masp"]."'" ;
        $truyvancount3sao = mysqli_query($conn, $count3sao);
        $getcount3sao = mysqli_num_rows($truyvancount3sao);
    ?>

    <?php
        $count2sao =  "SELECT NoiDung FROM danhgia WHERE NoiDung = 2 AND MaSanPham = '".$_GET["Masp"]."'" ;
        $truyvancount2sao = mysqli_query($conn, $count2sao);
        $getcount2sao = mysqli_num_rows($truyvancount2sao);
    ?>

    <?php
        $count1sao =  "SELECT NoiDung FROM danhgia WHERE NoiDung = 1 AND MaSanPham = '".$_GET["Masp"]."'" ;
        $truyvancount1sao = mysqli_query($conn, $count1sao);
        $getcount1sao = mysqli_num_rows($truyvancount1sao);
    ?>

<!-- Start Product Content Tab Section -->
<div class="product-details-content-tab-section section-top-gap-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="product-details-content-tab-wrapper" data-aos="fade-up"  data-aos-delay="0">

                    <!-- Start Product Details Tab Button -->
                    <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                        <li>
                            <a class="nav-link active" data-bs-toggle="tab" href="#description">
                                Description
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="tab" href="#review">
                                Reviews (<?php echo $getcountbl?>)
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" data-bs-toggle="tab" href="#specification">
                                Specification
                            </a>
                        </li>
                    </ul> <!-- End Product Details Tab Button -->

                    <!-- Start Product Details Tab Content -->
                    <div class="product-details-content-tab">
                        <div class="tab-content">
                            <!-- Start Product Details Tab Content Singel -->
                            <div class="tab-pane active show" id="description">
                                <div class="single-tab-content-item">
                                    <p><?php echo $dbdata["ThongTin"]?></p>
                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->
                            <!-- Start Product Details Tab Content Singel -->
                            <?php
                                $laybl = "SELECT * FROM binhluan INNER JOIN thanhvien ON binhluan.TenDangNhap = thanhvien.TenDangNhap WHERE MaSanPham = '".$dbdata["MaSanPham"]."' ORDER BY MaBinhLuan DESC ";
                                $cotbl = mysqli_query($conn,$laybl);
                            ?>
                            <div class="tab-pane" id="review">
                                <div class="single-tab-content-item">
                                    <div style="margin-bottom: 25px">
                                        <ul class="review-star">
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <a href="#" class="customer-review ml-2">Sản phẩm có <?php echo $getcount5sao ?> đánh giá 5 sao</a>
                                        </ul>
                                        <ul class="review-star">
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <a href="#" class="customer-review ml-2">Sản phẩm có <?php echo $getcount4sao ?> đánh giá 4 sao</a>
                                        </ul>
                                        <ul class="review-star">
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <a href="#" class="customer-review ml-2">Sản phẩm có <?php echo $getcount3sao ?> đánh giá 3 sao</a>
                                        </ul>
                                        <ul class="review-star">
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <a href="#" class="customer-review ml-2">Sản phẩm có <?php echo $getcount2sao ?> đánh giá 2 sao</a>
                                        </ul>
                                        <ul class="review-star">
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                            <a href="#" class="customer-review ml-2">Sản phẩm có <?php echo $getcount1sao ?> đánh giá 1 sao</a>
                                        </ul>
                                    </div>
                                    <ul class="comment">
                                        <!-- Start - Review Comment list-->
                                        <?php
                                        while ($getdbbl = mysqli_fetch_array($cotbl)){ ?>
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="../images/user/<?php echo $getdbbl["Image"] ?>" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name"><?php echo $getdbbl["Hoten"]?></h6>
<!--                                                                <ul class="review-star">-->
<!--                                                                    <li class="empty"><i class="ion-android-star"></i></li>-->
<!--                                                                    <li class="empty"><i class="ion-android-star"></i></li>-->
<!--                                                                    <li class="empty"><i class="ion-android-star"></i></li>-->
<!--                                                                    <li class="empty"><i class="ion-android-star"></i></li>-->
<!--                                                                    <li class="empty"><i class="ion-android-star"></i></li>-->
<!--                                                                </ul>-->
                                                            </div>
                                                            <div style="margin-bottom: 5px">
                                                                <span style="margin-left: 10px;">Đã bình luận vào ngày: <?php echo $getdbbl["NgayBinhLuan"]?></span>
                                                                <?php if(isset($_SESSION["tendangnhap"]) && $getdbbl["TenDangNhap"] == $_SESSION["tendangnhap"] ){ ?>
                                                                    <a style="margin-left: 100px" data-bs-toggle="modal" data-bs-target="#modalQuickviewEditComment"  class="icon_chinhsua"><i class="ion-edit"></i></a>
                                                                    <a class="ion-android-delete" onclick="XoaBinhLuan(<?php echo $getdbbl["MaBinhLuan"]?>, <?php echo $dbdata["MaSanPham"]?>)" style="margin-left: 20px"></a>
                                                                <?php } ?>
                                                            </div>
                                                            <!--                                                        <div class="comment-content-right">-->
                                                            <!--                                                            <a href="#"><i class="fa fa-reply"></i>Reply</a>-->
                                                            <!--                                                        </div>-->
                                                        </div>
                                                        <div class="para-content">
                                                            <p><?php echo $getdbbl["NoiDung"]?> </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- End - Review Comment list-->
                                            <?php
                                        }
                                        ?>
                                    </ul> <!-- End - Review Comment -->
                                    <div class="review-form">
                                        <div class="review-form-text-top">
                                            <h5>ADD A REVIEW</h5>
                                        </div>
                                        <?php
                                        if(isset($_SESSION["tendangnhap"])){ ?>
                                            <form action="<?php echo $_SERVER["PHP_SELF"]?>?Masp=<?php echo $dbdata["MaSanPham"]?>" method="post">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="default-form-box">
                                                            <label for="comment-review-text">Your review <span>*</span></label>
                                                            <textarea name="ndbinhluan" id="comment-review-text" placeholder="Write a review" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-md btn-black-default-hover" type="submit">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php }
                                        else {?>
                                            <b style="margin-left: 350px;font-size: 20px" class="text-danger">Bạn cần đăng nhập để bình luận sản phẩm</b>
                                        <?php } ?>
                                    </div>
<!--                                    <table class="table table-bordered mb-20">-->
<!--                                        <tbody>-->
<!--                                        <tr>-->
<!--                                            <th scope="row">Compositions</th>-->
<!--                                            <td>Polyester</td>-->
<!--                                        </tr>-->
<!--                                        <tr>-->
<!--                                            <th scope="row">Styles</th>-->
<!--                                            <td>Girly</td>-->
<!--                                        <tr>-->
<!--                                            <th scope="row">Properties</th>-->
<!--                                            <td>Short Dress</td>-->
<!--                                        </tr>-->
<!--                                        </tbody>-->
<!--                                    </table>-->
<!--                                    <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>-->
                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->



                            <!-- Start Product Details Tab Content Singel -->
                            <div class="tab-pane" id="specification">
                                <div class="single-tab-content-item">
                                    <div>
                                        <div class="fb-comments" data-href="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2Fhhsb.vn%2Fposts%2F5410538482294474&show_text=true&width=500" data-width="1300" data-numposts="3"></div>
                                    </div>
                                    <!-- Start - Review Comment -->

                                </div>
                            </div> <!-- End Product Details Tab Content Singel -->
                        </div>
                    </div> <!-- End Product Details Tab Content -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Product Content Tab Section -->

<!-- Start Product Default Slider Section -->
<div class="product-default-slider-section section-top-gap-100 section-fluid">
    <!-- Start Section Content Text Area -->
    <div class="section-title-wrapper" data-aos="fade-up"  data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-content-gap">
                        <div class="secton-content">
                            <h3  class="section-title">Sản phẩm liên quan</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

        $lienquan = "SELECT * FROM loaisp WHERE MaLoaiSP = '".$dbdata["MaLoaiSp"]."'";
        $querylq = mysqli_query($conn,$lienquan);
        $layloailq = mysqli_fetch_array($querylq);


        $sql2 = "SELECT * FROM sanpham WHERE MaLoaiSp = '".$layloailq["MaLoaiSP"]."' ORDER BY MaSanPham DESC LIMIT 6";
        $query2 = mysqli_query($conn,$sql2);
    ?>
    <!-- Start Section Content Text Area -->
    <div class="product-wrapper" data-aos="fade-up"  data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-slider-default-1row default-slider-nav-arrow">
                        <!-- Slider main container -->
                        <div class="swiper-container product-default-slider-4grid-1row">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <?php
                                    while ($dbdata2 = mysqli_fetch_array($query2))
                                    {
                                ?>
                                    <!-- Start Product Default Single Item -->
                                    <div class="product-default-single-item product-color--golden swiper-slide">
                                        <div class="image-box">
                                            <a href="product-details-default.php?Masp=<?php echo $dbdata2["MaSanPham"]?>" class="image-link">
                                                <img src="../images/imageproduct/<?php echo $dbdata2["Anh"]?>" alt="">
                                                <img src="../images/imageproduct/<?php echo $dbdata2["Anh2"]?>" alt="">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <div class="content-left">
                                                <h6 class="title"><a href="product-details-default.php?Masp=<?php echo $dbdata2["MaSanPham"];?>"><?php echo $dbdata2["TenSanPham"] ?></a></h6>
                                                <ul class="review-star">
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                    <li class="empty"><i class="ion-android-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="content-right">
                                                <span class="price"><?=number_format($dbdata2["DonGia"],0,",",".")?> VNĐ</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <!-- End Product Default Single Item -->
                            </div>
                        </div>
                        <!-- If we need navigation buttons -->
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Default Slider Section -->


<div class="modal fade" id="modalQuickviewEditComment" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="account_form" data-aos="fade-up"  data-aos-delay="0">
                                <h3>Edit Comment</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="default-form-box">
                                            <label for="comment-review-text">Your review <span>*</span></label>
                                            <textarea id="comment-review-text" placeholder="Write a review" style="width: 800px"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-md btn-black-default-hover" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->






<?php
    include ('../layout/footer.php')
?>


<!-- Click chuột vào đánh giá sao -->
<script>
    $(document).ready(function () {
        for (i=1;i <=<?php echo $sosao ?>;i++){
            $('.sao'+i).css('color','#b19361');
        }
        $('.sao').mouseenter(function () {
            for(i=1;i<=$(this).attr('data-sao');i++){
                $('.sao'+i).addClass('saohover');
            }
        })
        $('.sao').mouseleave(function () {
            $('.sao').removeClass('saohover');
        })
        // $('.icon_chinhsua').click(function () {
        //     $('#bl_edit').val($(this).parent().find("#bl_id").val());
        //     $('#contentcm').val($(this).parent().find("#bl_noidung").val());
    })
</script>

<style>
    .saohover{
        color: #b19361;
    }
</style>