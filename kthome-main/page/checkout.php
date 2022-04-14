<?php
    include ('../layout/header.php')
?>
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
?>

<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Checkout</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="../page/index-3.php">Home</a></li>
                                <li class="active" aria-current="page">Checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- ...:::: End Breadcrumb Section:::... -->

<!-- ...:::: Start Checkout Section:::... -->
<div class="checkout-section">
    <div class="container">
        <div class="row">
            <!-- User Quick Action Form -->
            <div class="col-12">
                <div class="user-actions accordion" data-aos="fade-up"  data-aos-delay="0">


                </div>
                <div class="user-actions accordion" data-aos="fade-up"  data-aos-delay="200">
                    <h3>
                        <i class="fa fa-file-o" aria-hidden="true"></i>
                        Bạn có mã khuyến mãi?
                        <a class="Returning" href="#" data-bs-toggle="collapse" data-bs-target="#checkout_coupon" aria-expanded="true">Nhập mã khuyến mãi!</a>

                    </h3>
                    <div id="checkout_coupon" class="collapse checkout_coupon" data-parent="#checkout_coupon">
                        <div class="checkout_info">
                            <form action="#">
                                <input placeholder="Mã khuyến mãi" type="text">
                                <button class="btn btn-md btn-black-default-hover" type="submit">Nhập</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- User Quick Action Form -->
        </div>
        <?php
            if(isset($_SESSION["tendangnhap"])) {
                $laythanhvien = "SELECT * FROM thanhvien WHERE TenDangNhap='" . $_SESSION["tendangnhap"] . "'";
                $truyvan = mysqli_query($conn, $laythanhvien);
                $cottv = mysqli_fetch_array($truyvan);
        ?>

        <!-- Start User Details Checkout Form -->
        <div class="checkout_form" data-aos="fade-up"  data-aos-delay="400">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <form  method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
                        <h3>Chi tiết đơn hàng</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="default-form-box">
                                    <label>Họ và tên <span style="color: red">*</span></label>
                                    <input name="hoten" type="text" value="<?php echo $cottv["Hoten"];?>" >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="default-form-box">
                                    <label> Email <span style="color: red">*</span></label>
                                    <input type="text" name="email" value="<?php echo $cottv["Email"];?>">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="default-form-box">
                                    <label>Số điện thoại <span style="color: red">*</span></label>
                                    <input type="text" name="dienthoai" id="dienthoai" value="<?php echo $cottv["Dienthoai"];?>">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="default-form-box">
                                    <label>Ngày đặt<span style="color: red">*</span></label>
                                    <input type="text" value="<?php echo date("d/m/Y"); ?>" disabled>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="default-form-box">
                                    <label>Số nhà, đường<span style="color: red">*</span></label>
                                    <input type="text" name="noigiao" value="<?php echo $cottv["Diachi"];?>" id="noigiao">
                                </div>
                            </div>


                            <div class="col-12 ">
                                <div class="default-form-box">
                                    <label for="country"> Tỉnh/Thành Phố <span style="color: red">*</span></label>
                                    <select class="country_option nice-select wide city"  name="city" required>
                                        <option selected="selected" value="">--Chọn thành phố--</option>
                                        <?php
                                            $sqlcity = "SELECT * FROM tinhthanhpho ORDER BY name_city";
                                            $getdbcity = mysqli_query($conn, $sqlcity);
                                            while ($rows_city = mysqli_fetch_array($getdbcity)){
                                               ?>
                                                    <option value="<?php echo $rows_city['matp']; ?>"> <?php echo $rows_city['name_city']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 ">
                                <div class="default-form-box">
                                    <label> Quận/ huyện <span style="color: red">*</span></label>
                                    <select style="position: relative" class="country_option nice-select wide tinh" name="district" required>
                                        <option selected="selected" value="">--Chưa chọn quận huyện--</option>

                                    </select>
                                </div>
                            </div>
<!--                            <div class="col-12">-->
<!--                                <div class="default-form-box">-->
<!--                                    <label> Phường/Xã <span style="color: red">*</span></label>-->
<!--                                    <select class="country_option nice-select wide quan" name="ward">-->
<!--                                        <option selected="selected" value="">--Chưa chọn phường xã--</option>-->
<!--                                    </select>-->
<!--                                </div>-->
<!--                            </div>-->

                            <div class="col-12 mt-3">
                                <div class="order-notes">
                                    <label for="order_note">Ghi chú</label>
                                    <textarea id="order_note" name="ghichu" placeholder="Hãy ghi chú lại điều bạn mong muốn để chúng tôi phục vụ tốt hơn!"></textarea>
                                </div>
                            </div>
                            <div class="order_button pt-3">
                                <button id="thanhtoandathang" name="send" class="btn btn-md btn-black-default-hover" type="submit">Đặt hàng</button>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-md-6">
                    <form action="#">
                        <h3>Đơn hàng của bạn</h3>
                        <div class="order_table table-responsive">
                            <?php
                            if(isset($_SESSION["giohang"])){
                                $subtotal = 0;
                                $ordertotal = 0;
                                ?>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Tổng cộng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($_SESSION["giohang"] as $key=>$value){
                                        $subtotal =$value["price"]*$value["number"];
                                        $ordertotal += $subtotal;
                                    ?>
                                    <tr>
                                        <td><?php echo $value["name"] ?> <strong> × <?php echo $value["number"] ?></strong></td>
                                        <td><?php  echo number_format($subtotal,0,",","."); ?> VNĐ</td>
                                        <?php }?>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr class="order_total">
                                        <th>Order Total</th>
                                        <td><strong><?php  echo number_format($ordertotal,0,",","."); ?> VNĐ</strong></td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td><strong class="ship"></strong></td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Sub Total</th>
                                        <td ><strong class="tongtiensauship"></strong></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            <?php } ?>
                        </div>
                        <div class="payment_method">
                            <div class="panel-default">
                                <label class="checkbox-default" for="currencyCod" data-bs-toggle="collapse" data-bs-target="#methodCod">
                                    <input type="checkbox" id="currencyCod">
                                    <span>Thanh toán Online</span>
                                </label>
                                <div id="methodCod" class="collapse" data-parent="#methodCod">
                                    <div class="card-body1">
                                        <div class="order_button pt-3" style="">
                                            <?php
                                                error_reporting(0);
                                                $vnd_to_usd = $_SESSION["tongbill"]/ 23000;
                                            ?>
                                            <div style="margin-left: 30px" id="paypal-button"></div>
                                            <input type="hidden" id="vnd_to_usd" value="<?php echo ceil($vnd_to_usd) ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <label class="checkbox-default" for="currencyPaypal" data-bs-toggle="collapse" data-bs-target="#methodPaypal">
                                    <input type="checkbox" id="currencyPaypal">
                                    <span>Thanh toán Momo</span>
                                </label>
                                <div id="methodPaypal" class="collapse " data-parent="#methodPaypal">
                                    <div class="card-body1">
                                        <p>Sau khi thanh toán vui lòng chụp lại tin nhắn thanh toán thành công và gửi cho CSKH!</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div> <!-- Start User Details Checkout Form -->
    </div>
</div><!-- ...:::: End Checkout Section:::... -->
<?php   }
    if(isset($_POST["send"])){
        if(isset($_SESSION["giohang"])){
            $tendangnhap = $_SESSION["tendangnhap"];
            $trangthai = "Đã tiếp nhận";
            $noigiao = $_POST["noigiao"];
            $ngaydat = date("Y-m-d");
            $dienthoai = $_POST["dienthoai"];
            $ghichu = $_POST["ghichu"];
            $tenkh = $_POST["hoten"];

            $tongbill =  $_SESSION["tongbill"];
            $thanhpho = $_POST["city"];
            $quanhuyen = $_POST["district"];
            $themdondat = "INSERT INTO dondat(TenDangNhap, MaNhanVien, TrangThai, NoiGiao, NgayDat, DienThoai, GhiChu, Hoten, TongTien, TongTienSauShip, matp, maqh) VALUES ('" . $tendangnhap . "','1','" . $trangthai . "','" . $noigiao . "','" . $ngaydat . "','".$dienthoai."','".$ghichu."','".$tenkh."','".$ordertotal."','".$tongbill."', '".$thanhpho."', '".$quanhuyen."')";


            if (mysqli_query($conn, $themdondat)) {
                $madondat = 0;
                $laydon = "SELECT * FROM dondat ORDER BY MaDonDat";
                $truyvanlaydondat = mysqli_query($conn, $laydon);
                while ($cotDD = mysqli_fetch_array($truyvanlaydondat)) {
                    $madondat = $cotDD["MaDonDat"];
                }

                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $ngaydat = date("d-m-Y H:i:s");

                $content.="<h2 style='color: black'>Cảm ơn bạn đã mua hàng!!</h2>";
                $content.="<p style='color: black'>Xin chào $tenkh. Chúng tôi đã nhận được đặt hàng của bạn và đã sẵn sàng để vận chuyển. Chúng tôi sẽ thông báo cho bạn khi đơn hàng được gửi đi.</p>";
                $content.="<hr>";
                $content.="<h4 style='margin: 10px 0;font-size: 18px;color: black'>Đơn Hàng Của Bạn</h4>";
                $content.="<p>Bạn đã đặt vào ngày: $ngaydat</p>";
                $content.="<table width='500px'>";
                $content.="<thead><tr><th>#</th><th>Tên sản phẩm</th><th>Đơn giá</th><th>Số lượng</th><th>Tổng</th></tr></thead><tbody>";
                $i=0;
                foreach ($_SESSION["giohang"] as $key=> $value) {
                    $i++;
                    $masp = $value["masp"];
                    $price = number_format($value["price"],0,",",".");
                    $gia = $value["price"];
                    $number = $value["number"];

                    $total = $value["price"] * $value["number"];
//                    $total = $value["price"];
                    $total_mail = number_format($total,0,",",".");

                    $date=date("d/m/Y");

                    $themctdd = "INSERT INTO ct_dondat VALUES ('".$madondat."','".$masp."','".$number."','".$gia."')";
                    mysqli_query($conn, $themctdd);

                    //==========================Trừ số lượng tồn ==========================================
                    $getcountsldd = "SELECT * FROM ct_dondat WHERE MaSanPham = '".$masp."' AND MaDonDat = '".$madondat."'";
                    $get_dbdd = mysqli_fetch_array(mysqli_query($conn, $getcountsldd));

                    $product = "SELECT * FROM sanpham WHERE MaSanPham = '".$masp."'";
                    $getsl = mysqli_fetch_array(mysqli_query($conn, $product));

                    $soluongton = $getsl["SoLuong"] - $get_dbdd["Soluong"];
                    if($soluongton == 0) {
                        $soldout = "UPDATE sanpham SET MaTrangThaiSanPham = '2', SoLuong = '".$soluongton."' WHERE MaSanPham = '".$masp."'";
                        $query_soldout=mysqli_query($conn,$soldout);
                    } else {
                        $querysl = "UPDATE sanpham SET SoLuong = '".$soluongton."' WHERE MaSanPham = '".$masp."'";
                        $queryupdatesl = mysqli_query($conn, $querysl);
                    }
                    //=======================================================================================

                    $content.="     
                                <tr><td>$i</td>
                                <td style='text-align: center; color: black'>".$value["name"]."</td>
                                <td style='text-align: center; color: black'>$price</td>
                                <td style='text-align: center; color: black'>$number</td>
                                <td style='text-align: right; color: black'>$total_mail VNĐ</td></tr>
                                 ";
                }
                $sum_price = number_format($ordertotal,0,",",".");
                $ship = number_format($_SESSION["ship"],0,",",".");
                $sum_total = number_format($tongbill,0,",",".");
                $content.="<tr><th></th><th></th><th></th><th><hr></th><th><hr></th></tr>";
                $content.="<tr><th></th><th></th><th></th><th>Thành tiền: </th><th style='text-align: right'>$sum_price VNĐ</th></tr>";
                $content.="<tr><th></th><th></th><th></th><th>Phí ship: </th><th style='text-align: right'>$ship VNĐ</th></tr>";
                $content.="<tr><th></th><th></th><th></th><th>Tổng tiền: </th><th style='text-align: right'>$sum_total VNĐ</th></tr></tbody>";
                $content.="<table>";

                unset($_SESSION["giohang"]);
                echo "<script>alert('Đặt hàng thành công xin hãy kiểm tra email của bạn');location='shop-full-width.php';</script>";
            }
            else {
                echo "<script>alert('Đã xảy ra lỗi');</script>";
            }
        }

        else {
            echo "<script>alert('Giỏ hàng trống');</script>";
        }
        include ('../PHPMAILER/lib/PHPMailer.php');
        include ('../PHPMAILER/lib/SMTP.php');
        include ('../PHPMAILER/lib/Exception.php');


        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'khoanguyengamers@gmail.com'; //SMTP username
            $mail->Password   = 'nguyenkhoa0975446963';
            $mail->SMTPSecure = 'tls';
            $mail->CharSet = 'UTF-8';
            $mail->Port       = 587;
            $sendmail= $_POST["email"];
            $fullname=$_POST["hoten"];

            $mail->setFrom('khoanguyengamers@gmail.com', 'KT Home');
            $mail->addAddress($sendmail, $fullname);
            $mail->isHTML(true);  //Set email format to HTML
            $mail->Subject = 'Chào bạn đây là thông tin đơn hàng của bạn';
            $mail->Body    = $content;
            $mail->send();
            echo 'Đã gửi đơn hàng';
        } catch (Exception $e) {
            echo "Lỗi gửi mail: {$mail->ErrorInfo}";
        }
    }
?>


<?php
    include ('../layout/footer.php')
?>

