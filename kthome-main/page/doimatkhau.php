<?php
    include ('../layout/header.php');
    if(!isset($_SESSION["tendangnhap"])){
        echo "<script>location = 'index.php'</script>";
    }
?>

<?php
    $laythongtin = "SELECT * FROM thanhvien WHERE TenDangNhap = '".$_SESSION["tendangnhap"]."'";
    $truyvanthongtin = mysqli_query($conn,$laythongtin);
    $cotthongtin = mysqli_fetch_array($truyvanthongtin);
?>





<!-- Offcanvas Overlay -->
<div class="offcanvas-overlay"></div>

<!-- ...:::: Start Breadcrumb Section:::... -->
<div class="breadcrumb-section breadcrumb-bg-color--golden">
    <div class="breadcrumb-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="breadcrumb-title">Thông tin khách hàng</h3>
                    <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                        <nav aria-label="breadcrumb">
                            <ul>
                                <li><a href="../page/index.php">Home</a></li>
                                <li><a href="../page/doimatkhau.php">Thông tin khách hàng</a></li>
<!--                                <li class="active" aria-current="page">Login</li>-->
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
                <div class="default-form-box" data-aos="fade-up"  data-aos-delay="0">
                    <h3>THÔNG TIN KHÁCH HÀNG</h3>
                    <form action="dangnhap.php" method="post">
                        <input type="hidden" name="tranghientai" value="<?php echo $_SERVER["PHP_SELF"];?>">
                        <div class="default-form-box">
                            <label style="margin-top: 20px">Tên đăng nhập </label>
                            <input id="info_dangnhap" name="tendangnhap" type="text" value="<?php echo $cotthongtin["TenDangNhap"];?>" style="color: red; border: none; margin-left: -20px" disabled="">
                        </div>
                        <div class="default-form-box">
                            <label>Họ tên </label>
                            <input id="info_hoten" name="hoten" type="text" value="<?php echo $cotthongtin["Hoten"];?>" style="color: red; border: none; margin-left: -20px" disabled>
                        </div>
                        <div class="default-form-box">
                            <label>Email </label>
                            <input id="info_email" name="email" type="email" value="<?php echo $cotthongtin["Email"];?>" style="color: red; border: none; margin-left: -20px" disabled>
                        </div>
                        <div class="default-form-box">
                            <label>Passwords </label>
                            <input id="info_password" name="password" type="password" value="<?php echo $cotthongtin["MatKhau"];?>" style="color: red; border: none; margin-left: -20px" disabled>
                        </div>
                        <div class="default-form-box">
                            <label>Số điện thoại </label>
                            <input id="info_sdt" name="sdt" type="text" value="<?php echo $cotthongtin["Dienthoai"];?>" style="color: red; border: none; margin-left: -20px" disabled>
                        </div>
                        <div class="default-form-box">
                            <label>Địa chỉ </label>
                            <input id="info_diachi" name="diachi" type="text" value="<?php echo $cotthongtin["Diachi"];?>" style="color: red; border: none; margin-left: -20px" disabled>
                        </div>
                        <div class="login_submit">
                            <!--                            <button data-bs-toggle="modal" data-bs-target="#modalQuickview_doithongtin" class="btn btn-md btn-black-default-hover">Update thông tin</button>-->
                            <a href="#"  data-bs-toggle="modal" data-bs-target="#modalQuickview_doithongtin" class="btn btn-md btn-black-default-hover mb-4" style="width: 200px">Update thông tin</a>
                        </div>
                    </form>
                </div>
            </div>
            <!--login area start-->
            <!--register area start-->
            <div class="col-lg-6 col-md-6">
                <div class="account_form register" data-aos="fade-up"  data-aos-delay="200">
                    <h3>Đổi mật khẩu</h3>
                    <div class="default-form-box">
                        <input id="tendangnhap"  type="hidden" value="<?php echo $cotthongtin["TenDangNhap"]; ?>">
                        <label>Mật khẩu cũ <span style="color: red">*</span></label>
                        <input required=""  id="matkhaucu" type="password">
                    </div>
                    <div class="default-form-box">
                        <label>Mật khẩu mới <span style="color: red">*</span></label>
                        <input required=""   type="password" id="matkhaumoi">
                    </div>
                    <div class="default-form-box">
                        <label>Nhập lại mật khẩu <span style="color: red">*</span></label>
                        <input required=""  type="password" id="nhapmatkhaumoi">
                    </div>
                    <div>
                        <span style="color: red" id="mk_thongbao"></span>
                    </div>
                    <div class="login_submit">
                        <button id="doimatkhau" class="btn btn-md btn-black-default-hover mb-4" type="submit">Đổi mật khẩu</button>
                    </div>
                </div>
            </div>
            <!--register area end-->
        </div>
    </div>
</div> <!-- ...:::: End Customer Login Section :::... -->


<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
//        $tendangnhap = $_POST["tendangnhap"];
        $hoten = $_POST["hoten_up"];
        $sdt = $_POST["sdt_up"];
        $diachi = $_POST["diachi_up"];
        $imginfo = $_POST["imginfo"];

//        $img = $cotthongtin["Image"];

//        if(($_FILES["imginfo"]["name"]!="")) {
//            unlink("../images/user/".$img);
//            $img = $_FILES["imginfo"]['name'];
//            move_uploaded_file($_FILES["imginfo"]['tmp_name'],'../images/user/'.$img);
//        }


        $queryupdateinfo = "UPDATE thanhvien SET Hoten = '".$hoten."',Diachi = '".$diachi."', Dienthoai = '".$sdt."', Image = '".$imginfo."' WHERE TenDangNhap = '".$_SESSION["tendangnhap"]."'";
//        $queryupdateinfo = "UPDATE thanhvien SET Image = '".$img."' WHERE TenDangNhap = '".$_SESSION["tendangnhap"]."'";
        $queryupdate = mysqli_query($conn,$queryupdateinfo);
        if($queryupdate)
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>location='../page/doimatkhau.php'</script>";
        }
?>
<div class="modal fade" id="modalQuickview_doithongtin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 col-md-6" style="width: 100%">
                            <div class="default-form-box" data-aos="fade-up"  data-aos-delay="0">
                                <h3 style="text-align: center">THÔNG TIN KHÁCH HÀNG</h3>
                                <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
                                    <div class="col-lg-6 col-md-6" style="position: relative; margin-left: 100px">
                                        <?php if($cotthongtin["Image"] != "") {?>
                                            <img src="../images/user/<?php echo $cotthongtin["Image"] ?>" class="avatar img-circle img-thumbnail" alt="avatar" style="width: 180px;height: 180px;position: absolute;top: 50px;">
                                            <h6 style="width: 180px;height: 180px;position: absolute;top: 230px;">Upload a different photo...</h6>
                                            <input type="file" name="imginfo" id="img_info" class="text-center center-block file-upload" style="width: 180px;height: 180px;position: absolute;top: 250px;">
                                        <?php } else {?>
                                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" class="avatar img-circle img-thumbnail" alt="avatar" style="width: 180px;height: 180px;position: absolute;top: 50px;">
                                            <h6 style="width: 180px;height: 180px;position: absolute;top: 230px;">Upload a different photo...</h6>
                                            <input type="file" name="imginfo" id="img_info" class="text-center center-block file-upload" style="width: 180px;height: 180px;position: absolute;top: 250px;">
                                        <?php }?>

                                    </div>
                                    <br>
                                    <div class="col-lg-6 col-md-6" style="float: right">
                                        <input name="tendangnhap" type="hidden" value="<?php echo $cotthongtin["TenDangNhap"]; ?>">
                                        <div class="default-form-box">
                                            <label>Họ tên <span style="color: red">*</span></label>
                                            <input required="" id="info_hoten" name="hoten_up" type="text" value="<?php echo $cotthongtin["Hoten"];?>">
                                        </div>
                                        <div class="default-form-box">
                                            <label>Số điện thoại <span style="color: red;">*</span></label>
                                            <input required="" id="info_sdt" name="sdt_up" type="text" value="<?php echo $cotthongtin["Dienthoai"];?>">
                                        </div>
                                        <div class="default-form-box">
                                            <label>Địa chỉ <span style="color: red">*</span></label>
                                            <input required="" id="info_diachi" name="diachi_up" type="text" value="<?php echo $cotthongtin["Diachi"];?>">
                                        </div>
                                        <div class="login_submit">
                                            <button class="btn btn-md btn-black-default-hover mb-4" type="submit" style="margin-left: 150px">Cập nhật</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php
    include ('../layout/footer.php')
?>

<script>
    $(document).ready(function() {
        var readURL = function(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('.avatar').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(".file-upload").on('change', function(){
            readURL(this);
        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#doimatkhau').click(function () {
            matkhaucu = $('#matkhaucu').val();
            matkhaumoi = $('#matkhaumoi').val();
            nhapmatkhaumoi = $('#nhapmatkhaumoi').val();

            loi = 0;
            if(matkhaucu == "" || matkhaumoi == "")
            {
                loi++;
                $("#mk_thongbao").text("Hãy nhập đầy đủ thông tin");
            }
            if(matkhaumoi != nhapmatkhaumoi)
            {
                loi++;
                $("#mk_thongbao").text("Nhập lại mật khẩu không trùng ");
            }
            if(loi != 0)
            {
                return false;
            }
            else {
                tendangnhap = $('#tendangnhap').val();
                $("#mk_thongbao").text("");
                DoiMatKhau(tendangnhap,matkhaucu,matkhaumoi);
            }
        });
    });

</script>
