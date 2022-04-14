<?php
    include ('../layout/header.php')
?>

<?php
    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
    $current_page = !empty($_GET['page'])?$_GET['page']:1;
    $offset = ($current_page-1) * $item_per_page;
    $dbdata = "SELECT * FROM blog ORDER BY MaBlog ASC LIMIT ".$item_per_page." OFFSET ".$offset ;
    $query = mysqli_query($conn,$dbdata);
    $total = mysqli_query($conn,"SELECT * FROM blog");
    $total = $total->num_rows;
    $totalpage = ceil($total / $item_per_page);
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
                                <li class="active" aria-current="page">Blog</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Blog List Section:::... -->
<div class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-wrapper">
                    <div class="row mb-n6">
                        <?php
                            while ($row = mysqli_fetch_array($query)){
                        ?>
                        <div class="col-xl-4 col-md-6 col-12 mb-6">
                            <!-- Start Product Default Single Item -->
                            <div class="blog-list blog-grid-single-item blog-color--golden"  data-aos="fade-up"  data-aos-delay="0">
                                <div class="image-box">
                                    <a href="blog-single-sidebar-left.php?Mablog=<?php echo $row["MaBlog"]?>" class="image-link">
                                        <img class="img-fluid" src="../images/imageblog/<?php echo $row["HinhAnh"]?>" alt="">
                                    </a>
                                </div>
                                <div class="content">
                                    <ul class="post-meta">
                                        <li>POSTED BY : <a href="#" class="author">Admin</a></li>
                                        <li>ON : <a href="#" class="date"><?php echo $row["Ngaytao"]?></a></li>
                                    </ul>
                                    <h6 class="title"><a href="blog-single-sidebar-left.php?Mablog=<?php echo $row["MaBlog"]?>"><?php echo $row["TieuDe"]?></a></h6>
                                    <p>
                                        <?php
                                            if(strlen($row["NoiDung"])<20)
                                                echo $row["NoiDung"];
                                            else
                                                echo substr($row["NoiDung"],0,120)."...";
                                        ?>
                                    </p>
                                    <a href="blog-single-sidebar-left.php?Mablog=<?php echo $row["MaBlog"]?>" class="read-more-btn icon-space-left">Read More <span class="icon"><i class="ion-ios-arrow-thin-right"></i></span></a>
                                </div>
                            </div>
                            <!-- End Product Default Single Item -->
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>

                <!-- Start Pagination -->
                <div class="page-pagination text-center" data-aos="fade-up"  data-aos-delay="0">
                    <ul>
                        <?php for($num =1 ; $num<= $totalpage; $num++){ ?>
                            <li><a class="active" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
                        <?php } ?>
                    </ul>
                </div> <!-- End Pagination -->
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Blog List Section:::... -->

<?php
include ('../layout/footer.php')
?>
