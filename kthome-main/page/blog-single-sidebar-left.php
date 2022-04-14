<?php
    include ('../layout/header.php')
?>

<?php
    if(!isset($_GET["Mablog"]))
        echo "<script>location='index.php';</script>";
    $queryblog = "SELECT * FROM blog WHERE MaBlog = '".$_GET["Mablog"]."'";
    $truyvan = mysqli_query($conn,$queryblog);
    $dbdata = mysqli_fetch_array($truyvan);
?>

<!-- Bình luận blog -->
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $mablog = $_GET["Mablog"];
        $ngaybinhluan= date("Y-m-d");
        $ndbinhluan=$_POST["ndbinhluan"];
        $tendangnhap=$_SESSION["tendangnhap"];
        $thembl = "INSERT INTO binhluanblog(MaBlog,NgayBinhLuan,NoiDung,TenDangNhap) VALUES ('".$mablog."','".$ngaybinhluan."','".$ndbinhluan."','".$tendangnhap."') ";
        if(mysqli_query($conn,$thembl)){
            echo "<script>alert('Bình luận của bạn đã được ghi nhận');window.location='blog-single-sidebar-left.php?Mablog=".$mablog."'</script>";
        } else{
            echo "<script>alert('Đã xảy ra lỗi');</script>";
        }
    }
?>

<!-- Đếm số lượt bình luận -->
<?php
    $countbl =  "SELECT MaBinhLuanBlog FROM binhluanblog WHERE MaBlog = '".$_GET["Mablog"]."'";
    $truyvancountbl = mysqli_query($conn, $countbl);
    $getcountbl = mysqli_num_rows($truyvancountbl);
?>

<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Blog</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="blog-single-sidebar-left.php">Blog</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Blog Single Section:::... -->
<div class="blog-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-3">
                <!-- Start Sidebar Area -->
                <div class="siderbar-section" data-aos="fade-up"  data-aos-delay="0">

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget" >
                        <h6 class="sidebar-title">Search</h6>
                        <form method="get" action="shop-full-width.php">
                            <div class="default-search-style d-flex">
                                <input name="timkiemtensp" class="default-search-style-input-box" type="search" placeholder="Search..." required>
                                <button class="default-search-style-input-btn" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget" >
                        <h6 class="sidebar-title">Shop</h6>
                        <div class="sidebar-content">
                            <ul class="sidebar-menu loai sp">
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
                    </div>
                    <!-- End Single Sidebar Widget -->

                    <!-- Start Single Sidebar Widget -->
                    <div class="sidebar-single-widget" >
                        <h6 class="sidebar-title">Meta</h6>
                        <div class="sidebar-content">
                            <ul class="sidebar-menu">
                                <li ><a href="login.php">Log in</a></li>
                                <li ><a href="#">Entries feed</a></li>
                                <li ><a href="#">Comments feed</a></li>
                                <li ><a href="#">WordPress.org</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- End Single Sidebar Widget -->



                </div> <!-- End Sidebar Area -->
            </div>
            <div class="col-lg-9">
                <!-- Start Blog Single Content Area -->
                <div class="blog-single-wrapper">
                    <div class="blog-single-img" data-aos="fade-up"  data-aos-delay="0">
                        <img class="img-fluid" src="../images/imageblog/<?php echo $dbdata["HinhAnh"]?>" alt="">
                    </div>
                    <ul class="post-meta" data-aos="fade-up"  data-aos-delay="200">
                        <li>POSTED BY : <a href="#" class="author">Admin</a></li>
                        <li>ON : <a href="#" class="date"><?php echo $dbdata["Ngaytao"]?></a></li>
                    </ul>
                    <h4 class="post-title" data-aos="fade-up"  data-aos-delay="400"><?php echo $dbdata["TieuDe"]?></h4>
                    <div class="para-content" data-aos="fade-up"  data-aos-delay="600">
                        <p><?php echo $dbdata["NoiDung"]?></p>
                        <p><?php echo $dbdata["NoiDung2"]?></p>
                        <p><?php echo $dbdata["NoiDung3"]?></p>
                    </div>

                <?php
                    $laybl = "SELECT * FROM binhluanblog INNER JOIN thanhvien ON binhluanblog.TenDangNhap = thanhvien.TenDangNhap WHERE MaBlog = '".$dbdata["MaBlog"]."' ORDER BY MaBinhLuanBlog DESC ";
                    $cotbl = mysqli_query($conn,$laybl);
                ?>
                </div> <!-- End Blog Single Content Area -->
                <div class="comment-area">
                    <div class="comment-box" data-aos="fade-up"  data-aos-delay="0">
                        <h4 class="title mb-4"><?php echo $getcountbl?> Bình luận</h4>
                        <!-- Start - Review Comment -->
                        <ul class="comment">
                            <!-- Start - Review Comment list-->
                            <?php
                                while ($getdbbl = mysqli_fetch_array($cotbl)){
                            ?>
                            <li class="comment-list">
                                <div class="comment-wrapper">
                                    <div class="comment-img">
                                        <img src="../images/user/<?php echo $getdbbl["Image"] ?>" alt="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-content-top">
                                            <div class="comment-content-left">
                                                <h6 class="comment-name"><?php echo $getdbbl["Hoten"]?></h6>
                                            </div>
                                            <div style="margin-bottom: 5px">
                                                <span style="margin-left: 10px;">Đã bình luận vào ngày: <?php echo $getdbbl["NgayBinhLuan"]?></span>
                                                <?php if(isset($_SESSION["tendangnhap"]) && $getdbbl["TenDangNhap"] == $_SESSION["tendangnhap"] ){ ?>
                                                    <a class="ion-android-delete" onclick="XoaBinhLuanBlog(<?php echo $getdbbl["MaBinhLuanBlog"]?>, <?php echo $dbdata["MaBlog"]?>)" style="margin-left: 20px"></a>
                                                <?php } ?>
                                            </div>
<!--                                            <div class="comment-content-right">-->
<!--                                                <a href="#"><i class="fa fa-reply"></i>Reply</a>-->
<!--                                            </div>-->
                                        </div>

                                        <div class="para-content">
                                            <p><?php echo $getdbbl["NoiDung"]?></p>
                                        </div>
                                    </div>
                                </div>
                            </li> <!-- End - Review Comment list-->
                            <?php
                                }
                            ?>
                        </ul> <!-- End - Review Comment -->
                    </div>

                    <!-- Start comment Form -->
                    <div class="comment-form" data-aos="fade-up"  data-aos-delay="0">
                        <?php
                            if(isset($_SESSION["tendangnhap"])){ ?>
                        <form action="<?php echo $_SERVER["PHP_SELF"]?>?Mablog=<?php echo $dbdata["MaBlog"]?>" method="post">
                            <div class="row">
                                <div class="col-12">
                                    <div class="default-form-box mb-20">
                                        <label for="comment-review-text">Your review <span>*</span></label>
                                        <textarea name="ndbinhluan" id="comment-review-text" placeholder="Write a review" required></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-md btn-golden" type="submit">Post Comment</button>
                                </div>
                            </div>
                        </form>
                        <?php } else {?>
                            <b style="margin-left: 350px;font-size: 20px" class="text-danger">Bạn cần đăng nhập để bình luận sản phẩm</b>
                        <?php } ?>
                    </div> <!-- End comment Form -->
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Blog Single Section:::... -->

<?php
    include ('../layout/footer.php')
?>
