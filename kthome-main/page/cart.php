<?php
    include ('../layout/header.php')
?>
<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Cart</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li class="active" aria-current="page">Cart</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Cart Section:::... -->
<div class="cart-section">
    <!-- Start Cart Table -->
    <div class="cart-table-wrapper"  data-aos="fade-up"  data-aos-delay="0">
        <div class="container">
            <?php
                if(empty($_SESSION["giohang"])){
                    echo "<script>location='empty-cart.php';</script>";
            ?>
            <?php }else { ?>
            <div class="row">
                <div class="col-12">
                    <div class="table_desc">
                        <div class="table_page table-responsive">
                            <table>
                                <!-- Start Cart Table Head -->
                                <thead>
                                <tr>
                                    <th class="product_remove">Xóa</th>
                                    <th class="product_thumb">Hình ảnh</th>
                                    <th class="product_name">Sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product_quantity">Số lượng</th>
                                    <th class="product_total">Tổng tiền</th>
                                </tr>
                                </thead> <!-- End Cart Table Head -->
                                <tbody>
                                <!-- Start Cart Single Item-->
                                <?php
                                    $total = 0;
                                    $totaltongtien = 0;
//                                    if(isset($_SESSION["giohang"])){
                                    $count = 0;
                                    $giohang = $_SESSION["giohang"];
                                    foreach ($giohang as $key => $value){
                                        $total_quantity = $value["number"];
                                        $count += $total_quantity;
                                ?>
                                <tr>
                                    <td class="product_remove"><a href="#" onclick="deleteCart(<?php echo $key?>)"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="#"> <img src="../images/imageproduct/<?php echo $value["image"]?>" alt=""></a></td>
                                    <td class="product_name"><a href="#"><?php echo $value["name"]?></a></td>
                                    <td class="product-price"><?php echo number_format($value["price"],0,",",".")?></td>
                                    <td class="product_quantity"><label>Quantity</label> <input onclick="updateCart(<?php echo $key;?>, $(this).val())" value="<?php echo $value["number"]?>" id="quantityGH_<?php echo $key ?>"  max="100"  type="number"></td>
                                    <td class="product_total"><?php
                                        $total = $value["number"] * $value["price"];
                                        $totaltongtien += $total;
                                        echo number_format($total,0,",",".");
                                        ?>
                                    </td>
                                </tr> <!-- End Cart Single Item-->
                                <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart_submit">
<!--                            <button class="btn btn-md btn-golden" type="submit">Tiếp tục mua hàng</button>-->
                            <a href="shop-full-width.php" class="btn btn-md btn-golden">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div> <!-- End Cart Table -->

    <!-- Start Coupon Start -->
    <div class="coupon_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code left"  data-aos="fade-up"  data-aos-delay="200">
                        <h3>Coupon</h3>
                        <div class="coupon_inner">
                            <p>Enter your coupon code if you have one.</p>
                            <input class="mb-2" placeholder="Coupon code" type="text">
                            <button type="submit" class="btn btn-md btn-golden">Apply coupon</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code right"  data-aos="fade-up"  data-aos-delay="400">
                        <h3>Tổng tiền</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Số lượng</p>
                                <p class="cart_amount"><?php
                                        echo $count;
                                    ?>
                                </p>
                            </div>
<!--                            <a href="#">Calculate shipping</a>-->
                            <div class="cart_subtotal">
                                <p>Tổng hóa đơn</p>
                                <p class="cart_amount"><?php
                                    echo number_format($totaltongtien,0,",",".")
                                    ?>
                                </p>
                            </div>
                            <div class="checkout_btn">
                                <?php if(isset($_SESSION["tendangnhap"])){?>
                                    <a href="checkout.php" class="btn btn-md btn-golden">Tiếp tục thanh toán</a>
                                <?php }else{?>
                                    <span>Bạn cần đăng nhập để đặt hàng!!</span>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Coupon Start -->
</div> <!-- ...:::: End Cart Section:::... -->
<?php
    include ('../layout/footer.php')
?>
