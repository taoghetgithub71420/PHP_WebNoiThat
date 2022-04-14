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
                    <h3 class="breadcrumb-title">Thông tin đơn hàng</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="thongtindonhang.php">Shop</a></li>
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
                        <h4 class="title" style="margin-bottom: 15px; font-size: 18px">Đơn hàng gần nhất</h4>
                        <div class="table_desc">
                            <div class="table_page table-responsive">
                                <?php
                                    $getorders = "SELECT * FROM dondat WHERE TenDangNhap = '" .$_SESSION["tendangnhap"]. "' ORDER BY MaDonDat DESC";
                                    $orders = mysqli_query($conn, $getorders);
                                ?>
                                <table>
                                    <!-- Start Cart Table Head -->
                                    <thead>
                                    <tr>
                                        <th class="product_remove">Đơn hàng #</th>
                                        <th class="product_thumb">Ngày đặt</th>
                                        <th class="product_name">Ngày chuyển</th>
                                        <th class="product-price">Giá trị đơn hàng</th>
                                        <th class="product_quantity">Tình trạng đơn hàng</th>
                                        <th style="width: 4px"></th>
                                    </tr>
                                    </thead> <!-- End Cart Table Head -->
                                    <?php if (mysqli_num_rows($orders) >0) {?>
                                        <tbody>
                                        <!-- Start Cart Single Item-->
                                        <?php while ($row = mysqli_fetch_array($orders)){?>
                                            <tr style="height: 80px">
                                                <td class="product_remove" style="font-size: 16px"><?php echo $row["MaDonDat"]?></td>
                                                <td class="product_thumb" style="font-size: 16px">
                                                    <?php
                                                        $date=date_create($row["NgayDat"]);
                                                        echo date_format($date,"d/m/Y");
                                                   ?>
                                                </td>
                                                <td class="product_thumb" style="font-size: 16px">
                                                    <?php
                                                        if($row["NgayChuyen"]>0) {
                                                            $date=date_create($row["NgayChuyen"]);
                                                            echo date_format($date,"d/m/Y");
                                                        } else {
                                                            echo $row["NgayChuyen"];
                                                        }
                                                    ?>
                                                </td>
                                                <td class="product-price" style="font-size: 16px"><?=number_format($row["TongTien"],0,",",".")?> VNĐ </td>
                                                <?php
                                                    if($row["TrangThai"] == "Đã tiếp nhận") { ?>
                                                        <td class="product_quantity" style="font-size: 16px">
                                                            <span style="background: #fa5e5e; color: white; border-radius: 20px; padding: 10px;margin-top: 10px"><?php echo $row["TrangThai"]?></span>
                                                        </td>
                                                    <?php } else if ($row["TrangThai"] == "Hoàn thành") {?>
                                                        <td class="product-price" style="font-size: 16px">
                                                            <span style="background: #E7FBE3; color: #0DB473; border-radius: 20px; padding: 10px"><?php echo $row["TrangThai"]?></span>
                                                        </td>
                                                    <?php } else {?>
                                                     <td class="product_quantity" style="font-size: 16px"><span style="background: #ffc107!important; color: black; border-radius: 20px; padding: 10px;margin-top: 10px"><?php echo $row["TrangThai"]?></span></td>
                                                <?php }?>

                                                <td><a href="chitietdondat.php?Madd=<?php echo $row["MaDonDat"]?>" ><i class="icon-magnifier"></i></a></td>
                                            </tr> <!-- End Cart Single Item-->
                                        <?php } ?>
                                        </tbody>
                                        <?php } else {?>
                                        <tbody>
                                            <tr>
                                                <td>Chưa có đơn hàng</td>
                                            </tr>
                                        </tbody>
                                        <?php }?>
                                </table>
                            </div>
<!--                            <div class="cart_submit">-->
<!--                                <a href="shop-full-width.php" class="btn btn-md btn-golden">Tiếp tục mua hàng</a>-->
<!--                            </div>-->
                        </div>
                    </div>
                </div>
        </div>
    </div> <!-- End Cart Table -->


<?php
    include ('../layout/footer.php')
?>