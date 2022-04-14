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


    //loai sản phẩm
    $getgenres = "SELECT * FROM loaisp WHERE MaLoaiSP = '".$dbdata["MaLoaiSp"]."'";
    $getgen=mysqli_query($conn,$getgenres);
    $genres = mysqli_fetch_array($getgen);

    //status
    $getstatus = "SELECT * FROM trangthaisanpham WHERE MaTrangThaiSanPham = '".$dbdata["MaTrangThaiSanPham"]."'";
    $status=mysqli_query($conn,$getstatus);
    $get_status = mysqli_fetch_array($status);

    //giá vốn
//    $query_kho = "SELECT * FROM kho WHERE MaSanPham = '".$dbdata["MaSanPham"]."'";
//    $get_kho = mysqli_query($conn,$query_kho);
//    $kho = mysqli_fetch_array($get_kho);

    //thương hiệu
    $query_thuonghieu = "SELECT * FROM thuonghieu WHERE MaThuongHieu = '".$dbdata["MaThuongHieu"]."'";
    $get_thuonghieu = mysqli_query($conn,$query_thuonghieu);
    $thuonghieu = mysqli_fetch_array($get_thuonghieu);

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <a href="listProduct.php"> <span>&#60;</span> Quay về danh sách</a>
              <h1 class="m-0"><?php echo $dbdata["TenSanPham"]?> </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
          <div class="card">
              <div class="card-header" style="background-color: #007bff;">
                  <h3 class="card-title" style="color:#fff;" >Thông tin sản phẩm</h3>
              </div>
              <div class="card-header border-0">
                  <div class="row">
                      <div class="col-md-3" style="margin-top: 20px">
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-size: 15px">Phân loại: <?php echo $genres["TenLoai"]?></h3>
                          </div>
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-size: 15px">Loại sản phẩm: <?php echo $genres["TenLoai"]?></h3>
                          </div>
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-size: 15px">Nhãn hiệu: KTHOME</h3>
                          </div>
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-size: 15px">Thương hiệu hợp tác: <?php echo $thuonghieu["TenThuongHieu"]?></h3>
                          </div>
                      </div>
                      <div class="col-md-3" style="margin-top: 20px">
                          <div class="d-flex justify-content-between">
                              <?php if ($dbdata["MaTrangThaiSanPham"] == 2 && $dbdata["SoLuong"] == 0){?>
                                <h3 class="card-title" style="font-size: 15px">Trạng thái: <?php echo $get_status["TenTrangThai"]?> </h3>
                              <?php }else{ ?>
                                <h3 class="card-title" style="font-size: 15px">Trạng thái: <?php echo $get_status["TenTrangThai"]?> </h3>
                              <?php }?>
                          </div>
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-size: 15px">Ngày tạo: <?php $date=date_create($dbdata["Ngaytao"]);echo date_format($date,"d/m/Y");?></h3>
                          </div>
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title" style="font-size: 15px">Nhân viên tạo: Admin</h3>
                          </div>
                      </div>
                      <div style="display: flex">
                          <div class="col-md-3">
                              <div class="d-flex justify-content-between">
                                  <img src="../images/imageproduct/<?php echo $dbdata["Anh"]?>" style="width: 150px">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="d-flex justify-content-between">
                                  <img src="../images/imageproduct/<?php echo $dbdata["Anh2"]?>" style="width: 150px">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="d-flex justify-content-between">
                                  <img src="../images/imageproduct/<?php echo $dbdata["Anh3"]?>" style="width: 150px">
                              </div>
                          </div>
                          <div class="col-md-3">
                              <div class="d-flex justify-content-between">
                                  <img src="../images/imageproduct/<?php echo $dbdata["Anh4"]?>" style="width: 150px">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0">Chi tiết sản phẩm</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-4">
                  <div class="card">
                      <div class="card-header" style="background-color: #007bff;">
                          <h3 class="card-title" style="color:#fff;" >Mô tả chi tiết</h3>
                      </div>
                      <div class="card-header border-0">
                          <div class="row">
                              <div class="col-md-12" >
<!--                                  --><?php
//                                    if(mysqli_num_rows($get_kho)) {
//                                    $i=0;
//                                    $total_material = 0;
//                                    while ($kho = mysqli_fetch_array($get_kho)) {
//                                        $i++;
//                                        $total_material += $kho["Price"];
//                                  ?>
                                  <div class="d-flex justify-content-between">
<!--                                      <h3 class="card-title" style="font-size: 15px">Nguyên liệu --><?php //echo $i?><!--: --><?php //echo $kho["Material"]?><!-- / --><?php //echo number_format($kho["Price"],0,",",".")?><!-- VNĐ</h3>-->
                                  </div>
<!--                                 --><?php //} } else {
//                                        $total_material = 0;
//                                        ?>
                                  <div class="d-flex justify-content-between">
                                      <h3 class="card-title" style="font-size: 15px"><?php echo $dbdata["ThongTin"]?><h3>
                                  </div>
<!--                                    <div class="d-flex justify-content-between">-->
<!--                                        <h3 class="card-title" style="font-size: 15px">Chưa có thông tin</h3>-->
<!--                                    </div>-->
<!--                                 --><?php //} ?>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="card">
                      <div class="card-header" style="background-color: #007bff;">
                          <h3 class="card-title" style="color:#fff;" >Thông tin chi tiết sản phẩm</h3>
                      </div>
                      <div class="card-header border-0">
                          <div class="row">
                              <div class="col-md-6" >
                                  <div class="d-flex justify-content-between">
                                      <h3 class="card-title" style="font-size: 15px; display: flex">Tên sản phẩm: <p style="margin-left: 100px"><?php echo $dbdata["TenSanPham"]?></p></h3>
                                  </div>
                                  <div class="d-flex justify-content-between">
                                      <h3 class="card-title" style="font-size: 15px; display: flex">Mã sản phẩm: <p style="margin-left: 100px"><?php echo $dbdata["MaSanPham"]?></p></h3>
                                  </div>
                                  <div class="d-flex justify-content-between">
                                      <h3 class="card-title" style="font-size: 15px; display: flex">Giá bán lẻ: <p style="margin-left: 122px"><?php echo number_format($dbdata["DonGia"],0,",",".")?> VNĐ</p></h3>
                                  </div>
                                  <div class="d-flex justify-content-between">
                                      <h3 class="card-title" style="font-size: 15px; display: flex">Giá vốn gốc: <p style="margin-left: 110px"><?php echo number_format($dbdata["GiaVon"],0,",",".")?> VNĐ</p></h3>
                                  </div>
                                  <div class="d-flex justify-content-between">
                                      <h3 class="card-title" style="font-size: 15px; display: flex">Đơn vị tính: <p style="margin-left: 120px">cái</p></h3>
                                  </div>
<!--                                  <div class="d-flex justify-content-between">-->
<!--                                      <h3 class="card-title" style="font-size: 15px">Mô tả: --><?php //echo $dbdata["ThongTin"]?><!--</h3>-->
<!--                                  </div>-->
                              </div>
                              <div class="col-md-4">
                                  <div class="d-flex justify-content-between">
                                      <img src="../images/imageproduct/<?php echo $dbdata["Anh4"]?>" style="width: 220px">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
          </div>
      </div>
    </div>
</div>

<?php
    include ('../admin/layoutAdmin/footer.php')
?>

