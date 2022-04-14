<?php
    include ('../layout/header.php')
?>

<?php
//    $item_per_page = !empty($_GET['per_page'])?$_GET['per_page']:8;
//    $current_page = !empty($_GET['page'])?$_GET['page']:1;
//    $offset = ($current_page-1) * $item_per_page;
//    $dbdata = "SELECT * FROM sanpham ORDER BY MaSanPham ASC LIMIT ".$item_per_page." OFFSET ".$offset ;
//    $query = mysqli_query($conn,$dbdata);
//    $total = mysqli_query($conn,"SELECT * FROM sanpham");
//    $total = $total->num_rows;
//    $totalpage = ceil($total / $item_per_page);

    $search = isset($_GET["timkiemtensp"])? $_GET["timkiemtensp"] : "" ;
    if($search) {
        $get = "WHERE TenSanPham LIKE '%".$search."%' ";
    }
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 12;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    if ($search) {
        $dbdata = "SELECT * FROM sanpham WHERE TenSanPham LIKE '%".$search."%' ORDER BY MaSanPham DESC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM sanpham WHERE TenSanPham LIKE '%".$search."%' ");
    } else {
        $dbdata = "SELECT * FROM sanpham ORDER BY MaSanPham DESC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM sanpham");
    }
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
                    <h3 class="breadcrumb-title">Shop</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="shop-full-width.php">Shop</a></li>
<!--                                <li class="active" aria-current="page">Shop Full Width</li>-->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Shop Section:::... -->
<div class="shop-section">
    <div class="container">
        <div class="row flex-column-reverse flex-lg-row">
            <div class="col-lg-12">
                <!-- Start Shop Product Sorting Section -->
                <div class="shop-sort-section">
                    <div class="container">
                        <div class="row">
                            <!-- Start Sort Wrapper Box -->
                            <div class="sort-box d-flex justify-content-between align-items-md-center align-items-start flex-md-row flex-column" data-aos="fade-up"  data-aos-delay="0">
                                <!-- Start Sort tab Button -->
                                <div class="sort-tablist d-flex align-items-center">
                                    <ul class="tablist nav sort-tab-btn">
                                        <li><a class="nav-link active" data-bs-toggle="tab" href="#layout-4-grid"><img src="../images/icons/bkg_grid.png" alt=""></a></li>
                                        <li><a class="nav-link" data-bs-toggle="tab" href="#layout-list"><img src="../images/icons/bkg_list.png" alt=""></a></li>
                                    </ul>

                                    <!-- Start Page Amount -->
                                    <div class="page-amount ml-2">
                                        <span>Showing 1–9 of 21 results</span>
                                    </div> <!-- End Page Amount -->
                                </div> <!-- End Sort tab Button -->

                                <!-- Start Sort Select Option -->
                                <div class="sort-select-list d-flex align-items-center">

                                    <div class="price-range-block" style="width: 300px">
                                        <div id="slider-range" class="price-filter-range" name="rangeInput"></div>

                                        <div style="margin:30px auto; text-align: center">
                                            <input  type="number" min=0 max="10000000" oninput="validity.valid||(value='0');" id="min_price" class="price-range-field" placeholder="0"/>
                                            <input type="number" min=0 max="10000000" oninput="validity.valid||(value='10000000');" id="max_price" class="price-range-field" placeholder="10000000"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Sort Select Option -->

                            </div> <!-- Start Sort Wrapper Box -->
                        </div>
                    </div>
                </div> <!-- End Section Content -->

                <!-- Start Tab Wrapper -->
                <div class="sort-product-tab-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="tab-content">
                                    <!-- Start Grid View Product -->
                                    <div class="tab-pane active show sort-layout-single" id="searchgia">
                                        <div class="row">
                                            <?php
                                                while ($row = mysqli_fetch_array($query)){
                                            ?>
                                            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                                                <!-- Start Product Default Single Item -->
                                                <div class="product-default-single-item product-color--golden" data-aos="fade-up"  data-aos-delay="0">
                                                    <div class="image-box">
                                                        <a href="product-details-default.php?Masp=<?php echo $row["MaSanPham"]?>" class="image-link">
                                                            <img src="../images/imageproduct/<?php echo $row["Anh"]?>" alt=""/>
                                                            <img src="../images/imageproduct/<?php echo $row["Anh2"]?>" alt=""/>
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <div class="content-left">
                                                            <h6 class="title"><a href="product-details-default.php?Masp=<?php echo $row["MaSanPham"]?>"><?php echo $row["TenSanPham"]?></a></h6>
                                                            <ul class="review-star">
                                                                <li class="empty"><i class="ion-android-star"></i></li>
                                                                <li class="empty"><i class="ion-android-star"></i></li>
                                                                <li class="empty"><i class="ion-android-star"></i></li>
                                                                <li class="empty"><i class="ion-android-star"></i></li>
                                                                <li class="empty"><i class="ion-android-star"></i></li>
                                                            </ul>
                                                        </div>
                                                        <div class="content-right">
                                                            <span class="price"><?=number_format($row["DonGia"],0,",",".")?> VNĐ</span>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- End Product Default Single Item -->
                                            </div>
                                            <?php
                                                }
                                            ?>

                                        </div>
                                    </div> <!-- End Grid View Product -->
                                    <!-- Start List View Product -->
                                    <div class="tab-pane sort-layout-single" id="layout-list">
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single product-color--golden">
                                                    <a href="product-details-default.php" class="product-list-img-link">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-1.jpg" alt="">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-2.jpg" alt="">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.php">KAOREET LOBORTIS SAGIT</a></h5>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                        <span class="product-list-price"><del>$30.12</del> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover">Add to cart</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
                                                            <a href="wishlist.php" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
                                                            <a href="compare.php" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single product-color--golden">
                                                    <a href="product-details-default.php" class="product-list-img-link">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-3.jpg" alt="" >
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-4.jpg" alt="" >
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.php">CONDIMENTUM POSUERE</a></h5>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                        <span class="product-list-price">$95.00</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover">Add to cart</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
                                                            <a href="wishlist.php" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
                                                            <a href="compare.php" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single product-color--golden">
                                                    <a href="product-details-default.php" class="product-list-img-link">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-5.jpg" alt="" >
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-6.jpg" alt="" >
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.php">ALIQUAM LOBORTIS</a></h5>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                        <span class="product-list-price"> $25.12</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover">Add to cart</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
                                                            <a href="wishlist.php" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
                                                            <a href="compare.php" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single product-color--golden">
                                                    <a href="product-details-default.php" class="product-list-img-link">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-7.jpg" alt="" >
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-8.jpg" alt="" >
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.php">CONVALLIS QUAM SIT</a></h5>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                        <span class="product-list-price">$75.00 - $85.00</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover">Add to cart</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
                                                            <a href="wishlist.php" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
                                                            <a href="compare.php" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                            <div class="col-12">
                                                <!-- Start Product Defautlt Single -->
                                                <div class="product-list-single product-color--golden">
                                                    <a href="product-details-default.php" class="product-list-img-link">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-9.jpg" alt="">
                                                        <img class="img-fluid" src="../images/product/default/home-1/default-10.jpg" alt="">
                                                    </a>
                                                    <div class="product-list-content">
                                                        <h5 class="product-list-link"><a href="product-details-default.php">DONEC EU LIBERO AC</a></h5>
                                                        <ul class="review-star">
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="fill"><i class="ion-android-star"></i></li>
                                                            <li class="empty"><i class="ion-android-star"></i></li>
                                                        </ul>
                                                        <span class="product-list-price"><del>$25.12</del> $20.00</span>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad, iure incidunt. Ab consequatur temporibus non eveniet inventore doloremque necessitatibus sed, ducimus quisquam, ad asperiores</p>
                                                        <div class="product-action-icon-link-list">
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart" class="btn btn-lg btn-black-default-hover">Add to cart</a>
                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview" class="btn btn-lg btn-black-default-hover"><i class="icon-magnifier"></i></a>
                                                            <a href="wishlist.php" class="btn btn-lg btn-black-default-hover"><i class="icon-heart"></i></a>
                                                            <a href="compare.php" class="btn btn-lg btn-black-default-hover"><i class="icon-shuffle"></i></a>
                                                        </div>
                                                    </div>
                                                </div> <!-- End Product Defautlt Single -->
                                            </div>
                                        </div>
                                    </div> <!-- End List View Product -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Tab Wrapper -->
                <!-- Start Pagination -->
                <?php
                    include ("PhanTrang.php");
                ?>
                <!-- End Pagination -->
            </div> <!-- End Shop Product Sorting Section  -->
        </div>
    </div>
</div> <!-- ...:::: End Shop Section:::... -->




<script type="text/javascript">
    $(document).ready(function () {

        function filterProduct() {
            $("#searchgia").html("<p>Loading</p>")

            var min_price = $("#min_price").val();
            var max_price = $("#max_price").val();

            $.ajax({
                url:"ajax/searchprice.php",
                type:"POST",
                data:{min_price:min_price,max_price:max_price},
                success:function (data){
                    $('#searchgia').html(data);

                }

            });
            //alert(min_price + max_price);
        }
        $("#min_price, #max_price").on('keyup',function () {
            filterProduct();
        });

        $("#slider-range").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 10000000,
            values: [0, 10000000],
            step: 100,

            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $("#min_price").val(ui.values[0]);
                $("#max_price").val(ui.values[1]);
                filterProduct();
            }
        });
        $("#min_price").val($("#slider-range").slider("value",0));
        $("#max_price").val($("#slider-range").slider("value",1));
    });
</script>

<style>

    .price-range-block {
        margin:2% 0%;
    }
    .ui-slider-horizontal {
        height: .6em;
    }
    .ui-slider-horizontal {

        width:100%;
    }
    .ui-widget-header {
        background: #b19361;
    }


    .price-range-field{
        width:40%;
        margin-top: 10px;
        min-width: 16%;
        background-color:#f9f9f9;
        border: 1px solid #6e6666;
        color: black;
        font-family: myFont;
        font: normal 14px Arial, Helvetica, sans-serif;
        border-radius: 5px;
        height:26px;
        padding:5px;
    }
    .search-results-block{
        position: relative;
        display: block;
        clear: both;
    }

</style>


<?php
    include ('../layout/footer.php')
?>
