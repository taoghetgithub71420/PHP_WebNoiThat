<?php
    include ('../admin/layoutAdmin/header.php')
?>
<?php
    if(!isset($_GET["masp"]))
        echo "<script>location='listProduct.php'</script>";
    $getProducts = "SELECT * FROM sanpham WHERE MaSanPham = '".$_GET["masp"]."'";
    $query = mysqli_query($conn,$getProducts);
    if (mysqli_num_rows($query) > 0) {
        $dbdata = mysqli_fetch_array($query);
    } else {
        echo "<script>location='listProduct.php'</script>";
    }


    $querynhanvien = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$_SESSION["email"]."'";
    $getnhanvien = mysqli_query($conn, $querynhanvien);
    $laynhanvien = mysqli_fetch_array($getnhanvien);


    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $name = $_POST["namepro"];
        $quantity = $_POST["quantity"];
        $price = $_POST["price"];
        $detail = $_POST["detail"];
        $genres = $_POST["loaisp"];
        $brand = $_POST["thuonghieu"];
        $getstatus = $_POST["status"];
        $date = $_POST["date"];

        $img = $dbdata["Anh"];
        $img2 = $dbdata["Anh2"];
        $img3 = $dbdata["Anh3"];
        $img4 = $dbdata["Anh4"];

        if(($_FILES["image1"]["name"]!="")) {
            unlink("../images/imageproduct/".$img);
            $img = $_FILES["image1"]['name'];
            move_uploaded_file($_FILES["image1"]['tmp_name'],'../images/imageproduct/'.$img);
        }


        if(($_FILES["image2"]["name"]!="")) {
            unlink("../images/imageproduct/".$img2);
            $img2 = $_FILES["image2"]['name'];
            move_uploaded_file($_FILES["image2"]['tmp_name'],'../images/imageproduct/'.$img2);
        }


        if(($_FILES["image3"]["name"]!="")) {
            unlink("../images/imageproduct/".$img3);
            $img3 = $_FILES["image3"]['name'];
            move_uploaded_file($_FILES["image3"]['tmp_name'],'../images/imageproduct/'.$img3);
        }


        if(($_FILES["image4"]["name"]!="")) {
            unlink("../images/imageproduct/".$img4);
            $img4 = $_FILES["image4"]['name'];
            move_uploaded_file($_FILES["image4"]['tmp_name'],'../images/imageproduct/'.$img4);
        }


        $sql = "UPDATE sanpham SET MaTrangThaiSanPham = '".$getstatus."',TenSanPham = '".$name."',SoLuong = '".$quantity."',Anh = '".$img."',Anh2 = '".$img2."',Anh3 = '".$img3."',Anh4 = '".$img4."',DonGia = '".$price."', ThongTin = '".$detail."', Ngaytao = '".$date."',MaLoaiSp = '".$genres."',MaThuongHieu = '".$brand."' WHERE MaSanPham = '".$_GET["masp"]."'";
        $queryupdate=mysqli_query($conn,$sql);
        if($queryupdate > 0) {
            echo "<script>alert('C???p nh???t th??nh c??ng')</script>";
            echo "<script>location='listProduct.php'</script>";
        } else {
            echo "<script>alert('Xay ra loi')</script>";
        }

    }
    //loai s???n ph???m
    $getgenres = "SELECT * FROM loaisp";
    $getgen=mysqli_query($conn,$getgenres);

    //th????ng hi???u
    $querrybrand = "SELECT * FROM thuonghieu";
    $getbrand =mysqli_query($conn,$querrybrand);

    //status
    $getstatus = "SELECT * FROM trangthaisanpham";
    $status=mysqli_query($conn,$getstatus);

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="listProduct.php"> <span>&#60;</span> Quay v??? danh s??ch</a>
                    <h1 class="m-0">Ch???nh s???a s???n ph???m </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Ch???nh s???a s???n ph???m</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">T??n s???n ph???m</label>
                                    <input type="text" class="form-control col-md-8" name="namepro" value="<?php echo empty($_POST["namepro"])? $dbdata["TenSanPham"] : $_POST["namepro"]?>" placeholder="T??n s???n ph???m">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">S??? l?????ng b??n</label>
                                    <input type="text" class="form-control col-md-8" name="quantity" value="<?php echo empty($_POST["quantity"])? $dbdata["SoLuong"] : $_POST["quantity"]?>" placeholder="S??? l?????ng">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">M?? t???</label>
                                    <textarea class="form-control col-md-8" name="detail" cols="50" rows="30" style="height: 100px; color: black"><?php echo empty($_POST["detail"])? $dbdata["ThongTin"] : $_POST["detail"]?></textarea>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Lo???i s???n ph???m</label>
                                    <select class="form-control select2 select2-danger col-md-8" name="loaisp" id="genres" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <?php
                                        while ($genres = mysqli_fetch_array($getgen)) {
                                            if($genres["MaLoaiSP"] == $dbdata["MaLoaiSp"]) {
                                                ?>
                                                <option selected="selected" value="<?php echo $genres["MaLoaiSP"]?>"><?php echo $genres["TenLoai"]?></option>
                                            <?php } else {?>
                                                <option value="<?php echo $genres["MaLoaiSP"]?>"><?php echo $genres["TenLoai"]?></option>
                                            <?php } }?>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Th????ng hi???u</label>
                                    <select class="form-control select2 select2-danger col-md-8" name="thuonghieu" id="thuonghieu" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <?php
                                        while ($rowsbrand = mysqli_fetch_array($getbrand)) {
                                            if($rowsbrand["MaThuongHieu"] == $dbdata["MaThuongHieu"]) {
                                                ?>
                                                <option selected="selected" value="<?php echo $rowsbrand["MaThuongHieu"]?>"><?php echo $rowsbrand["TenThuongHieu"]?></option>
                                            <?php } else {?>
                                                <option value="<?php echo $rowsbrand["MaThuongHieu"]?>"><?php echo $rowsbrand["TenThuongHieu"]?></option>
                                            <?php } }?>
                                    </select>
                                </div>

                                    <div style="display: flex; margin-left: 130px; width: 1200px; margin-top: 100px">
                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">H??nh ???nh 1</label>
                                            <div>
                                                <?php if($dbdata["Anh"] != ""){ ?>
                                                    <img  src="../images/imageproduct/<?php echo $dbdata["Anh"]?>" style="width: 500px" class="avatar1 img-circle img-thumbnail" alt="avatar">
                                                <?php } else{?>
                                                    <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar1 img-circle img-thumbnail" alt="avatar">
                                                <?php }?>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">H??nh ???nh 2</label>
                                            <div>
                                                 <?php if($dbdata["Anh2"] != ""){ ?>
                                                <img  src="../images/imageproduct/<?php echo $dbdata["Anh2"]?>" style="width: 500px" class="avatar2 img-circle img-thumbnail" alt="avatar">
                                                 <?php } else{?>
                                                     <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar2 img-circle img-thumbnail" alt="avatar">
                                                 <?php }?>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">H??nh ???nh 3</label>
                                            <div>
                                                 <?php if($dbdata["Anh3"] != ""){ ?>
                                                <img  src="../images/imageproduct/<?php echo $dbdata["Anh3"]?>" style="width: 500px" class="avatar3 img-circle img-thumbnail" alt="avatar">
                                                 <?php } else{?>
                                                     <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar3 img-circle img-thumbnail" alt="avatar">
                                                 <?php }?>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-right: 50px">
                                            <label for="exampleInputPassword1">H??nh ???nh 4</label>
                                            <div>
                                                <?php if($dbdata["Anh4"] != ""){ ?>
                                                <img  src="../images/imageproduct/<?php echo $dbdata["Anh4"]?>" style="width: 500px" class="avatar4 img-circle img-thumbnail" alt="avatar">
                                                <?php } else{?>
                                                    <img  src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png" style="width: 500px" class="avatar4 img-circle img-thumbnail" alt="avatar">
                                                <?php }?>
                                            </div>
                                        </div>
                                    </div>

                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Gi?? s???n ph???m</label>
                                    <input type="text" class="form-control col-sm-8" name="price" value="<?php echo empty($_POST["price"])? $dbdata["DonGia"] : $_POST["price"]?>" placeholder="Gi?? s???n ph???m">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ng??y t???o</label>
                                    <input type="date" name="date" value="<?php echo empty($_POST["date"]) ? $dbdata["Ngaytao"] : $_POST["date"]?>" class="form-control col-sm-8">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tr???ng th??i</label>
                                    <select class="form-control select2 select2-danger col-md-8" name="status" id="" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                        <?php
                                        while ($namest = mysqli_fetch_array($status)) {
                                            if($namest["MaTrangThaiSanPham"] == $dbdata["MaTrangThaiSanPham"]) {
                                                ?>
                                                <option selected="selected" value="<?php echo $namest["MaTrangThaiSanPham"]?>"><?php echo $namest["TenTrangThai"]?></option>
                                            <?php } else {?>
                                                <option value="<?php echo $namest["MaTrangThaiSanPham"]?>"><?php echo $namest["TenTrangThai"]?></option>
                                            <?php } }?>
                                    </select>
                                </div>
                                <div class="form-group" >
                                    <div style="margin-bottom: 10px">
                                        <label for="exampleInputPassword1">H??nh 1</label>   <input type="file" name="image1" class="text-center center-block file-upload1"> <br>
                                    </div>
                                    <div style="margin-bottom: 10px">
                                        <label for="exampleInputPassword1">H??nh 2</label>   <input type="file" name="image2" class="text-center center-block file-upload2"> <br>
                                    </div>
                                    <div style="margin-bottom: 10px">
                                        <label for="exampleInputPassword1">H??nh 3</label>   <input type="file" name="image3" class="text-center center-block file-upload3"> <br>
                                    </div>
                                    <div style="margin-bottom: 10px">
                                        <label for="exampleInputPassword1">H??nh 4</label>   <input type="file" name="image4" class="text-center center-block file-upload4"> <br>
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

