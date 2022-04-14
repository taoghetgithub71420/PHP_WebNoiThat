<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    if(!isset($_GET["idAdmin"]))
        echo "<script>location='index4.php'</script>";
    $queryStaff = "SELECT * FROM nhanvien WHERE MaNhanVien = '".$_GET["idAdmin"]."'";
    $getStaff = mysqli_query($conn,$queryStaff);
    if (mysqli_num_rows($getStaff) > 0) {
        $dbdata = mysqli_fetch_array($getStaff);
    } else {
        echo "<script>location='index4.php'</script>";
    }

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $name = $_POST["name"];
        $role = $_POST["role"];
        $status_edit = $_POST["idstatus"];
        $date = $_POST["date"];
        $phone =$_POST["phone"];
        $email = $dbdata["Username"];
        $pass = $dbdata["Password"];

        $sql = "UPDATE nhanvien SET Hoten = '".$name."',TenDangNhap = '".$email."',MatKhau = '".$pass."',Ngaysinh = '".$date."',Dienthoai = '".$phone."', MaRole = '".$role."', MaTrangThaiNhanVien = '".$status_edit."' WHERE MaNhanVien = '".$_GET["idAdmin"]."'";
        $queryupdate=mysqli_query($conn,$sql);
        if($queryupdate > 0) {
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>location='index4.php'</script>";
        } else {
            echo "<script>alert('Xay ra loi')</script>";
        }
    }

    $getrole = "SELECT * FROM roles ";
    $role=mysqli_query($conn,$getrole);

    $getstatus = "SELECT * FROM trangthainhanvien ";
    $status=mysqli_query($conn,$getstatus);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="index4.php"> <span>&#60;</span> Quay về trang chủ</a>
                    <h1 class="m-0">Thông tin tài khoản </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Thông tin tài khoản</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" class="form-control col-md-8" name="name" value="<?php echo empty($_POST["name"])? $dbdata["Hoten"] : $_POST["name"]?>" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="tel" class="form-control col-md-8" name="phone" value="<?php echo empty($_POST["phone"])? $dbdata["Dienthoai"] : $_POST["phone"]?>" placeholder="Số điện thoại">
                                </div>
                                <?php
                                if($dbdata["MaRole"] == 1) {
                                    ?>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Quyền</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="role" id="" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                            while ($namest = mysqli_fetch_array($role)) {
                                                if($namest["MaRole"] == $dbdata["MaRole"]) {
                                                    ?>
                                                    <option selected="selected" value="<?php echo $namest["MaRole"]?>"><?php echo $namest["TenRole"]?></option>
                                                <?php } else {?>
                                                    <option value="<?php echo $namest["MaRole"]?>"><?php echo $namest["TenRole"]?></option>
                                                <?php } }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="idstatus" id="" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                            while ($namest1 = mysqli_fetch_array($status)) {
                                                if($namest1["MaTrangThaiNhanVien"] == $dbdata["MaTrangThaiNhanVien"]) {
                                                    ?>
                                                    <option selected="selected" value="<?php echo $namest1["MaTrangThaiNhanVien"]?>"><?php echo $namest1["TenTrangThai"]?></option>
                                                <?php } else {?>
                                                    <option value="<?php echo $namest1["MaTrangThaiNhanVien"]?>"><?php echo $namest1["TenTrangThai"]?></option>
                                                <?php } }?>
                                        </select>
                                    </div>
                                <?php }?>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control col-md-8" name="email" value="<?php echo empty($_POST["email"])? $dbdata["TenDangNhap"] : $_POST["email"]?>" placeholder="Email" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mật khẩu</label>
                                    <input type="password" class="form-control col-sm-8" name="password" value="<?php echo empty($_POST["password"])? $dbdata["MatKhau"] : $_POST["password"]?>" placeholder="Mật khẩu" disabled>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày sinh</label>
                                    <input type="date" name="date" value="<?php echo empty($_POST["date"]) ? $dbdata["Ngaysinh"] : $_POST["date"]?>" class="form-control col-sm-8">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer" style="float:right;" >
                            <button type="submit" class="btn btn-primary">Submit</button>
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


