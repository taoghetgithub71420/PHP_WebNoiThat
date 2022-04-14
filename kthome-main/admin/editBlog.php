<?php
    include ('../admin/layoutAdmin/header.php')
?>
<?php
    if(!isset($_GET["Mablog"]))
        echo "<script>location='listBlog.php.php'</script>";
    $getBlog = "SELECT * FROM blog WHERE MaBlog = '".$_GET["Mablog"]."'";
    $query = mysqli_query($conn,$getBlog);
    if (mysqli_num_rows($query) > 0) {
        $dbdata = mysqli_fetch_array($query);
    } else {
        echo "<script>location='listBlog.php'</script>";
    }

    $querynhanvien = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$_SESSION["email"]."'";
    $getnhanvien = mysqli_query($conn, $querynhanvien);
    $laynhanvien = mysqli_fetch_array($getnhanvien);

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $tieudeblog = $_POST["tieudeblog"];
        $noidung1 = $_POST["noidung1"];
        $noidung2 = $_POST["noidung2"];
        $noidung3 = $_POST["noidung3"];
        $date = $_POST["date"];

        $img = $dbdata["HinhAnh"];

        if(($_FILES["imageblog"]["name"]!="")) {
            unlink("../images/imageblog/".$img);
            $img = $_FILES["imageblog"]['name'];
            move_uploaded_file($_FILES["imageblog"]['tmp_name'],'../images/imageblog/'.$img);
        }

        $sql = "UPDATE blog SET  TieuDe = '".$tieudeblog."', NoiDung = '".$noidung1."', NoiDung2 = '".$noidung2."', NoiDung3 = '".$noidung3."', Ngaytao = '".$date."', HinhAnh = '".$img."', MaNhanVien = '".$laynhanvien["MaNhanVien"]."' WHERE MaBlog = '".$_GET["Mablog"]."'";
        $queryupdate = mysqli_query($conn,$sql);
        if($queryupdate > 0) {
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>location='listBlog.php'</script>";
        } else {
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
                    <a href="listBlog.php"> <span>&#60;</span> Quay về danh sách</a>
                    <h1 class="m-0">Chỉnh sửa blog </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Chỉnh sửa Blog</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tiêu đề Blog</label>
                                    <input type="text" class="form-control col-md-8" name="tieudeblog" id="tieudeblog" value="<?php echo empty($_POST["tieudeblog"])? $dbdata["TieuDe"] : $_POST["tieudeblog"]?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung 1</label>
                                    <textarea class="form-control col-md-8" name="noidung1" id="noidung1" cols="50" rows="30" style="height: 100px; color: black"><?php echo empty($_POST["noidung1"])? $dbdata["NoiDung"] : $_POST["noidung1"]?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung 2</label>
                                    <textarea class="form-control col-md-8" name="noidung2" id="noidung2" cols="50" rows="30" style="height: 100px; color: black"><?php echo empty($_POST["noidung2"])? $dbdata["NoiDung2"] : $_POST["noidung2"]?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nội dung 3</label>
                                    <textarea class="form-control col-md-8" name="noidung3" id="noidung3" cols="50" rows="30" style="height: 100px; color: black"><?php echo empty($_POST["noidung3"])? $dbdata["NoiDung3"] : $_POST["noidung3"]?></textarea>
                                </div>
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày tạo</label>
                                    <input type="date" name="date" value="<?php echo empty($_POST["date"]) ? $dbdata["Ngaytao"] : $_POST["date"]?>" class="form-control col-sm-8">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hình ảnh</label>
                                    <div>
                                        <img src="../images/imageblog/<?php echo $dbdata["HinhAnh"]?>" style="width: 200px" class="avatar1 img-circle img-thumbnail" alt="avatar">
                                        <h6>Upload a different photo...</h6>
                                        <input type="file" name="imageblog" class="text-center center-block file-upload1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($laynhanvien["MaRole"] == 1){?>
                            <div class="card-footer" style="float:right;" >
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        <?php }?>
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


