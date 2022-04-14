<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    $querynhanvien = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$_SESSION["email"]."'";
    $getnhanvien = mysqli_query($conn, $querynhanvien);
    $laynhanvien = mysqli_fetch_array($getnhanvien);
?>

<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $tieudeblog = $_POST["tieudeblog"];
        $noidung1 = $_POST["noidung1"];
        $noidung2 = $_POST["noidung2"];
        $noidung3 = $_POST["noidung3"];


        $date = $_POST["date"];
        $img = $_FILES["image"];

        if($img["type"]!="image/jpeg" && $img["type"]!="image/png")
        {
            echo "<script>alert('Hãy chọn đúng định dạng ảnh')</script>";
            echo "<script>location='addBlog.php';</script>";
            return;
        }

        move_uploaded_file($img["tmp_name"],"../images/imageblog/".$img["name"]);

        $them="INSERT INTO blog(MaNhanVien,TieuDe,NoiDung,NoiDung2,NoiDung3,HinhAnh,Ngaytao) VALUES ('".$laynhanvien["MaNhanVien"]."','".$tieudeblog."','".$noidung1."','".$noidung2."','".$noidung3."','".$img["name"]."','".$date."')";

        if(mysqli_query($conn,$them))
        {
            echo "<script>alert('Thêm thành công')</script>";
            echo "<script>location='listBlog.php';</script>";
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
                    <a href="listBlog.php" style="margin-bottom: 100px"> <span>&#60;</span> Quay về danh sách</a>
                </div><!-- /.col -->
                <div class="col-sm-12">
                    <h1 class="m-0">Thêm Blog mới </h1>
                    <br>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Thêm Blog</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu đề Blog</label>
                                    <input type="text" class="form-control col-md-8" name="tieudeblog" placeholder="Tiêu đề Blog">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung 1</label>
                                    <textarea class="form-control col-md-8" name="noidung1" cols="50" rows="30" style="height: 100px; color: black"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung 2</label>
                                    <textarea class="form-control col-md-8" name="noidung2" cols="50" rows="30" style="height: 100px; color: black"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung 3</label>
                                    <textarea class="form-control col-md-8" name="noidung3" cols="50" rows="30" style="height: 100px; color: black"></textarea>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày tạo</label>
                                    <input type="date" name="date" class="form-control col-sm-8">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh</label>
                                    <div>
                                        <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 200px" class="avatar1 img-circle img-thumbnail" alt="avatar">
                                        <h6>Upload a different photo...</h6>
                                        <input type="file" name="image" class="text-center center-block file-upload1">
                                    </div>
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

