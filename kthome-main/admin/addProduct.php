<?php
    include ('../admin/layoutAdmin/header.php')
?>


<?php
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $tensanpham=$_POST["tensanpham"];
        $soluong=$_POST["soluong"];
        $anh=$_FILES["anh"];
        $anh2=$_FILES["anh2"];
        $anh3=$_FILES["anh3"];
        $anh4=$_FILES["anh4"];
        $dongia=$_POST["dongia"];
        $thongtin=$_POST["thongtin"];
        $trangthai=$_POST["trangthai"];
        $loaisp=$_POST["loaisp"];
        $brand=$_POST["thuonghieu"];
        $ngaytao=$_POST["ngaytao"];
        $giavon=$_POST["giavon"];

        if($anh["type"]!="image/jpeg" && $anh["type"]!="image/png")
        {
            echo "<script>alert('Hãy chọn đúng định dạng ảnh')</script>";
            echo "<script>location='addProduct.php';</script>";
            return;
        }

        move_uploaded_file($anh["tmp_name"],"../images/imageproduct/".$anh["name"]);
        move_uploaded_file($anh2["tmp_name"],"../images/imageproduct/".$anh2["name"]);
        move_uploaded_file($anh3["tmp_name"],"../images/imageproduct/".$anh3["name"]);
        move_uploaded_file($anh4["tmp_name"],"../images/imageproduct/".$anh4["name"]);

        $themsp="INSERT INTO sanpham(TenSanPham,SoLuong,Anh,Anh2,Anh3,Anh4,DonGia,ThongTin,MaLoaiSp,MaThuongHieu,MaTrangThaiSanPham,Ngaytao,GiaVon) VALUES ('".$tensanpham."','".$soluong."','".$anh["name"]."','".$anh2["name"]."','".$anh3["name"]."','".$anh4["name"]."','".$dongia."','".$thongtin."','".$loaisp."','".$brand."','".$trangthai."','".$ngaytao."','".$giavon."')";
        if(mysqli_query($conn,$themsp))
        {
            echo "<script>alert('Thêm thành công')</script>";
            echo "<script>location='listProduct.php';</script>";
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
                        <a href="listProduct.php"> <span>&#60;</span> Quay về danh sách</a>
                        <h1 class="m-0">Thêm sản phẩm </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #007bff;">
                        <h3 class="card-title" style="color:#fff;" >Thêm sản phẩm</h3>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                                        <input type="text" class="form-control col-md-8" name="tensanpham" id="tensanpham" value="" placeholder="Tên sản phẩm" required="Hãy nhập tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số lượng bán</label>
                                        <input type="text" class="form-control col-md-8" name="soluong" id="soluong" value="" placeholder="Số lượng" required="Hãy nhập số lượng bán">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Mô tả</label>
                                        <textarea class="form-control col-md-8" name="thongtin" id="thongtin" cols="50" rows="30" style="height: 100px; color: black" required="Hãy nhập mô tả"></textarea>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Loại sản phẩm</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="loaisp" id="loaisp" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                                $sqlloaisp = "SELECT * FROM loaisp ORDER BY TenLoai";
                                                $getloaisp = mysqli_query($conn, $sqlloaisp);
                                                while ($rows_loaisp = mysqli_fetch_array($getloaisp)){
                                                    ?>
                                                        <option value="<?php echo $rows_loaisp['MaLoaiSP']; ?>"> <?php echo $rows_loaisp['TenLoai']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword2">Thương hiệu</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="thuonghieu" id="thuonghieu" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                                $sqlthuonghieu = "SELECT * FROM thuonghieu ORDER BY TenThuongHieu";
                                                $getthuonghieu = mysqli_query($conn, $sqlthuonghieu);
                                                while ($rows_thuonghieu = mysqli_fetch_array($getthuonghieu)){
                                                    ?>
                                                        <option value="<?php echo $rows_thuonghieu['MaThuongHieu']; ?>"> <?php echo $rows_thuonghieu['TenThuongHieu']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div style="display: flex; margin-left: 130px; width: 1200px; margin-top: 100px">
                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">Hình ảnh 1</label>
                                            <div>
                                                <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar1 img-circle img-thumbnail" alt="avatar">
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">Hình ảnh 2</label>
                                            <div>
                                                <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar2 img-circle img-thumbnail" alt="avatar">
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">Hình ảnh 3</label>
                                            <div>
                                                <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar3 img-circle img-thumbnail" alt="avatar">
                                            </div>
                                        </div>

                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">Hình ảnh 4</label>
                                            <div>
                                                <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar4 img-circle img-thumbnail" alt="avatar">
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <!-- /.col -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Giá sản phẩm</label>
                                        <input type="text" class="form-control col-sm-8" name="dongia" id="dongia" value="" placeholder="Giá sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Giá vốn</label>
                                        <input type="text" class="form-control col-sm-8" name="giavon" id="giavon" value="" placeholder="Giá vốn">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Ngày tạo</label>
                                        <input type="date" name="ngaytao" id="ngaytao" value="" class="form-control col-sm-8">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Trạng thái</label>
                                        <select class="form-control select2 select2-danger col-md-8" name="trangthai" id="trangthai" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                            <?php
                                                $sqltrangthaisp = "SELECT * FROM trangthaisanpham ORDER BY TenTrangThai";
                                                $gettrangthaisp = mysqli_query($conn, $sqltrangthaisp);
                                                while ($rows_trangthaisp = mysqli_fetch_array($gettrangthaisp)){
                                                    ?>
                                                        <option value="<?php echo $rows_trangthaisp['MaTrangThaiSanPham']; ?>"> <?php echo $rows_trangthaisp['TenTrangThai']; ?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        <div style="margin-bottom: 10px">
                                            <label for="exampleInputPassword1">Hình 1</label>   <input type="file" name="anh" id="anh" class="text-center center-block file-upload1"> <br>
                                        </div>
                                        <div style="margin-bottom: 10px">
                                            <label for="exampleInputPassword1">Hình 2</label>   <input type="file" name="anh2" id="anh2" class="text-center center-block file-upload2"> <br>
                                        </div>
                                        <div style="margin-bottom: 10px">
                                            <label for="exampleInputPassword1">Hình 3</label>   <input type="file" name="anh3" id="anh3" class="text-center center-block file-upload3"> <br>
                                        </div>
                                        <div style="margin-bottom: 10px">
                                            <label for="exampleInputPassword1">Hình 4</label>   <input type="file" name="anh4" id="anh4" class="text-center center-block file-upload4"> <br>
                                        </div>
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