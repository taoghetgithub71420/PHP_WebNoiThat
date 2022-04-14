<?php
include ('../layout/header.php');
?>



<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Chi tiết đơn hàng</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="thongtindonhang.php">Thông tin đơn hàng</a></li>
                                <!--                                <li class="active" aria-current="page">Cart</li>-->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<?php
    $getorders = "SELECT * FROM dondat WHERE TenDangNhap = '" .$_SESSION["tendangnhap"]. "'";
    $orders = mysqli_query($conn, $getorders);
    $rowthanhvien = mysqli_fetch_array($orders);
?>
<!-- ...:::: Start Cart Section:::... -->
<div class="cart-section">
    <!-- Start Cart Table -->
    <div class="cart-table-wrapper"  data-aos="fade-up"  data-aos-delay="0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-text" style="margin-bottom: 30px;">
                        <h4 class="title">Xin chào, <?php echo $rowthanhvien["Hoten"]?></h4>
                    </div>
                    <h4 class="title" style="margin-bottom: 15px; font-size: 18px">Các sản phẩm trong đơn hàng</h4>
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <?php
                                $laychitietDD = "SELECT sanpham.*,ct_dondat.*,ct_dondat.SoLuong as 'sl' 
                                                FROM ct_dondat 
                                                JOIN sanpham ON ct_dondat.MaSanPham=sanpham.MaSanPham  
                                                WHERE MaDonDat = '".$_GET["Madd"]."'";
                                $truyvanlaychitietDD = mysqli_query($conn,$laychitietDD);
                            ?>
                            <table>
                                <!-- Start Cart Table Head -->
                                <thead>
                                <tr>
                                    <th class="product_remove">ID</th>
                                    <th class="product_thumb">Tên sản phẩm</th>
                                    <th class="product_name">Số lượng mua</th>
                                    <th class="product-price">Đơn giá</th>
                                    <th class="product_quantity">Thành tiền</th>
                                </tr>
                                </thead> <!-- End Cart Table Head -->
                                    <tbody>
                                    <!-- Start Cart Single Item-->
                                    <?php while ($row = mysqli_fetch_array($truyvanlaychitietDD)){?>
                                        <tr style="height: 80px">
                                            <td class="product_remove" style="font-size: 16px"><?php echo $row["MaSanPham"]?></td>
                                            <td class="product_thumb" style="font-size: 16px"><?php echo $row["TenSanPham"]?></td>
                                            <td class="product-price" style="font-size: 16px"><?php echo $row["sl"]?></td>
                                            <td class="product-price" style="font-size: 16px"><?=number_format($row["GiaSanPham"],0,",",".")?> VNĐ</td>
                                            <td class="product-price" style="font-size: 16px"><?=number_format($row["GiaSanPham"] * $row["sl"],0,",",".")?> VNĐ</td>
                                        </tr> <!-- End Cart Single Item-->
                                    <?php } ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Cart Table -->


    <?php
    include ('../layout/footer.php')
    ?>
