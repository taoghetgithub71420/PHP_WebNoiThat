<?php
    include ('../layout/header.php')
?>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $tendangnhap = $_POST["tendangnhap"];
        $matkhau = $_POST["passwords"];
        $hoten = $_POST["hoten"];
        $diachi = $_POST["diachi"];
        $dienthoai = $_POST["sodienthoai"];
        $email = $_POST["email"];

        $sqlcheckmail = "SELECT * FROM thanhvien WHERE Email = '".$_POST["email"]."'";
        $truyvanmail = mysqli_query($conn,$sqlcheckmail);
        $checkmail = mysqli_fetch_row($truyvanmail);
        if($checkmail){
            //echo "<script>alert('Email đã tồn tại')</script>";
            $reportemail = '<span id="email" style=\'color:#FF0400\'>Email đã tồn tại!!</span>';
        }
        else{
            if (!filter_var($email, FILTER_VALIDATE_EMAIL))
                echo "<script>$('#thongbaoemail').text('Email không hợp lệ');</script>";
            else{
                $kt = "SELECT * FROM thanhvien WHERE TenDangNhap = '".$tendangnhap."'";
                $truyvantontai = mysqli_query($conn,$kt);
                if(mysqli_num_rows($truyvantontai) > 0)
                    //echo "<script>$('#thongbao').text('Tài khoản đã tồn tại');</script>";
                    $report1 = '<span id="messageRegister" style=\'color:#FF0400\'>Tài khoản đã tồn tại!!</span>';
                else{
                    //$themnguoidung = "INSERT INTO thanhvien VALUES ('".$tendangnhap."','".$matkhau."','".$hoten."','".$diachi."','".$dienthoai."','".$email."')";
                    $themnguoidung = "INSERT INTO thanhvien(TenDangNhap,MatKhau,HoTen,DiaChi,DienThoai,Email) VALUES ('$tendangnhap','$matkhau','$hoten','$diachi','$dienthoai','$email')";
                    $truyvanthemnguoidung = mysqli_query($conn,$themnguoidung);
                    if($truyvanthemnguoidung)
                        //echo "<script>$('#thongbao').text('Đăng ký thành công');</script>";
                        echo "<script>alert('Đăng ký thành công')</script>";
//                    $report2 = '<span id="messageRegister" style=\'color:#FF0400\'>Đăng kí thành công</span>';
                }
            }
        }
    }
?>

    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">Login</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="../page/index.php">Home</a></li>
                                    <li class="active" aria-current="page">Login</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

     <!-- ...:::: Start Customer Login Section :::... -->
     <div class="customer-login">
        <div class="container">
            <div class="row">
                <!--login area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form" data-aos="fade-up"  data-aos-delay="0">
                        <h3>login</h3>
                        <form action="dangnhap.php" method="post">
                            <input type="hidden" name="tranghientai" value="<?php echo $_SERVER["PHP_SELF"];?>">
                            <div class="default-form-box">
                                <label>Tên đăng nhập <span style="color: red">*</span></label>
                                <input id="dn_dangnhap" name="tendangnhap" type="text">
                            </div>
                            <div class="default-form-box">
                                <label>Passwords <span style="color: red">*</span></label>
                                <input id="dn_matkhau" name="password" type="password">
                            </div>
                            <div class="default-form-box">
                                <span id="dn_thongbao" style="color: red"></span>
                            </div>
                            <div class="login_submit">
                                <button id="dangnhap" class="btn btn-md btn-black-default-hover mb-4" type="submit">login</button>
                                <label class="checkbox-default mb-4" for="offer">
                                    <input type="checkbox" id="offer">
                                    <span>Remember me</span>
                                </label>
                                <a href="quenmatkhau.php">Lost your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register" data-aos="fade-up"  data-aos-delay="200">
                        <h3>Register</h3>
<!--                        --><?php //if(isset($report2)){echo $report2;}?>
                        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]?>">
                            <div class="default-form-box">
                                <?php if(isset($report1)){echo $report1;}?>
                                <label>Tên đăng nhập <span style="color: red">*</span></label>
                                <input id="tendangnhap" name="tendangnhap" type="text">
                            </div>
                            <div class="default-form-box">
                                <label>Họ và tên <span style="color: red">*</span></label>
                                <input id="hoten" name="hoten" type="text">
                            </div>
                            <div class="default-form-box">
                                <label>Email <span style="color: red">*</span></label>
                                <input id="email" name="email" type="email" onblur="checkmail(this.value)">
                                <?php if(isset($reportemail)){echo $reportemail;}?>
                            </div>
                            <div class="default-form-box">
                                <span id="thongbaoemail" style="color: red"></span>
                            </div>
                            <div class="default-form-box">
                                <label>Passwords <span style="color: red">*</span></label>
                                <input id="passwords" name="passwords" type="password">
                            </div>

                            <div class="default-form-box">
                                <label>Nhập lại Passwords <span style="color: red">*</span></label>
                                <input id="nhaplaipasswords" name="nhaplaipasswords" type="password">
                            </div>
                            <div class="default-form-box">
                                <span id="thongbaonhaplaipasswords" style="color: red"></span>
                            </div>
                            <div class="default-form-box">
                                <label>Số điện thoại <span style="color: red">*</span></label>
                                <input id="sodienthoai" name="sodienthoai" type="text">
                            </div>
                            <div class="default-form-box">
                                <span id="thongbaodienthoai" style="color: red"></span>
                            </div>
                            <div class="default-form-box">
                                <label>Địa chỉ <span style="color: red">*</span></label>
                                <input id="diachi" name="diachi" type="text">
                            </div>
                            <div class="default-form-box">
                                <span id="thongbao" style="color: red"></span>
                            </div>
                            <div class="login_submit">
                                <button id="dangky" class="btn btn-md btn-black-default-hover" type="submit">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->
<?php
    include ('../layout/footer.php')
?>

<script>
    $(document).ready(function () {
        $("#dangky").click(function () {
            tendangnhap = $('#tendangnhap').val();
            matkhau = $('#passwords').val();
            nhaplaimatkhau=$('#nhaplaipasswords').val();
            hoten = $('#hoten').val();
            diachi = $('#diachi').val();
            dienthoai = $('#sodienthoai').val();
            email = $('#email').val();

            loi=0;
            if(tendangnhap == "" || matkhau == "" || hoten == "" ||  diachi == "" || dienthoai == "" || email == "")
            {
                loi++;
                $("#thongbao").text("Hãy nhập đầy đủ thông tin!!");
            }
            if(matkhau != nhaplaimatkhau)
            {
                loi++;
                $("#thongbaonhaplaipasswords").text("Mật khẩu không trùng khớp!!");
            }
            if(isNaN(dienthoai))
            {
                loi++;
                $("#thongbaodienthoai").text("Số điện thoại phải là số!!");
            }

            if (loi!=0)
            {
                return false;
            }
        });

        $('#dangnhap').click(function () {
            dn_tendangnhap = $('#dn_dangnhap').val();
            dn_matkhau = $('#dn_matkhau').val();

            loi = 0;
            if(dn_tendangnhap == "" || dn_matkhau==""){
                loi++;
                $('#dn_thongbao').text("Hãy nhập đầy đủ thông tin");

            }
            if(loi!=0){
                return false;
            }
        });
    });

</script>
