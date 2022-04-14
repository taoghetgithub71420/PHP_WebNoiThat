<?php
include ('../admin/layoutAdmin/header.php')
?>


<?php
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $tennhanvien = $_POST["tennhanvien"];
    $tendangnhap = $_POST["tendangnhap"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $ngaysinh = $_POST["ngaysinh"];
    $matkhau = $_POST["matkhau"];
    $quyen = $_POST["roles"];
    $trangthai = $_POST["trangthai"];

    $themnv="INSERT INTO nhanvien(MaRole,MaTrangThaiNhanVien,Hoten,TenDangNhap,Dienthoai,Email,Ngaysinh,MatKhau) VALUES ('".$quyen."','".$trangthai."','".$tennhanvien."','".$tendangnhap."','".$phone."','".$email."','".$ngaysinh."','".$matkhau."')";
    if(mysqli_query($conn,$themnv))
    {
        echo "<script>alert('Thêm thành công')</script>";
        echo "<script>location='listStaff.php';</script>";
    }
    else{
        echo "<script>alert('Xảy ra lỗi')</script>";
    }
}
?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <a href="listStaff.php"> <span>&#60;</span> Quay về danh sách</a>
                        <h1 class="m-0">Thêm nhân viên mới </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #007bff;">
                        <h3 class="card-title" style="color:#fff;" >Thêm nhân viên</h3>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên nhân viên</label>
                                        <input type="text" class="form-control col-md-8" name="tennhanvien" value="" placeholder="Tên nhân viên" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số điện thoại</label>
                                        <input type="text" class="form-control col-md-8" name="phone" value="" placeholder="Số điện thoại" >
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Quyền</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="roles" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                            $sqlroles = "SELECT * FROM roles ORDER BY TenRole";
                                            $getroles = mysqli_query($conn, $sqlroles);
                                            while ($rows_roles = mysqli_fetch_array($getroles)){
                                                ?>
                                                <option value="<?php echo $rows_roles['MaRole']; ?>"> <?php echo $rows_roles['TenRole']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword2">Trạng thái nhân viên</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="trangthai"  data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                            $sqlstatus = "SELECT * FROM trangthainhanvien ORDER BY TenTrangThai";
                                            $getstatus = mysqli_query($conn, $sqlstatus);
                                            while ($rows_status = mysqli_fetch_array($getstatus)){
                                                ?>
                                                <option value="<?php echo $rows_status['MaTrangThaiNhanVien']; ?>"> <?php echo $rows_status['TenTrangThai']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tên đăng nhập</label>
                                        <input type="email" class="form-control col-sm-8" name="tendangnhap"  value="" placeholder="Tên đăng nhập">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Email</label>
                                        <input type="email" class="form-control col-sm-8" name="email"  value="" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mật khẩu</label>
                                        <input type="text" class="form-control col-sm-8" name="matkhau"  value="" placeholder="Mật khẩu">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Ngày sinh</label>
                                        <input type="date" name="ngaysinh" value="" class="form-control col-sm-8">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer" style="float:right;" >
                                <button id="luu" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <!-- /.card-body -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>




<?php
    include ('../admin/layoutAdmin/footer.php')
?>