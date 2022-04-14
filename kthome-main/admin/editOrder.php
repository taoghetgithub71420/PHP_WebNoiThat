<?php
    include ('../admin/layoutAdmin/header.php')
?>
<?php
    $getorder = "SELECT * FROM dondat WHERE MaDonDat = '".$_GET["madondat"]."'";
    $query = mysqli_query($conn,$getorder);
    $dbdata = mysqli_fetch_array($query);

    $getstaff = "SELECT * FROM nhanvien WHERE MaNhanVien = '".$_GET["MaNhanVien"]."'";
    $query_staff = mysqli_query($conn,$getstaff);
    $db_staff = mysqli_fetch_array($query_staff);

    $getkhachhang = "SELECT * FROM thanhvien WHERE TenDangNhap = '".$_GET["TenDangNhap"]."'";
    $query_khachhang = mysqli_query($conn, $getkhachhang);
    $db_khachhang = mysqli_fetch_array($query_khachhang);

    $get_ctdh="SELECT * FROM ct_dondat INNER JOIN sanpham ON ct_dondat.MaSanPham = sanpham.MaSanPham WHERE MaDonDat='".$_GET["madondat"]."' ";
    $db_detail=mysqli_query($conn,$get_ctdh);


    $getthanhpho = "SELECT * FROM tinhthanhpho WHERE matp = '".$dbdata["matp"]."'";
    $query_thanhpho = mysqli_query($conn, $getthanhpho);
    $db_thanhpho = mysqli_fetch_array($query_thanhpho);

    $getquanhuyen = "SELECT * FROM quanhuyen WHERE maqh =  '".$dbdata["maqh"]."'";
    $query_quanhuyen = mysqli_query($conn, $getquanhuyen);
    $db_quanhuyen = mysqli_fetch_array($query_quanhuyen);

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <a href="listBill.php"> <span>&#60;</span> Đơn hàng</a>
                <h1 class="m-0"></h1>
              <h1 class="m-0"> Thông tin đơn hàng #<?php echo $dbdata["MaDonDat"]?> </h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
        <div class="card col-3" style="float: right; margin-right: 60px;">
            <div class="d-flex card-header justify-content-between border-0">
                <h3 class="card-title">Đơn hàng</h3>
                <?php if($dbdata["TrangThai"] == "Đã tiếp nhận") {?>
                    <h3 class="card-title badge bg-danger" style="margin-left: 50px;font-size: 14px"><?php echo $dbdata["TrangThai"]?></h3>
                <?php } else if ($dbdata["TrangThai"] == "Hoàn thành") {?>
                <h3 class="card-title" style="background: #E7FBE3;width: 100px; color: #0DB473; border-radius: 20px; padding-left: 12px;font-size: 15px; margin-left: 50px"><?php echo $dbdata["TrangThai"]?></h3>
                <?php } else {?>
                <p class="badge bg-warning" style="margin-left: 50px;font-size: 14px; padding: 5px;width: 100px"><?php echo $dbdata["TrangThai"]?></p>
                <?php } ?>
            </div>
            <div class="card-body">
                <div class=" justify-content-between align-items-center border-bottom mb-3">
                    <p class="d-flex flex-column text-left" style="font-size: 14px">Bảng giá: Giá bán lẻ</p>
                    <p class="d-flex flex-column text-left" style="font-size: 14px">Thuế: Giá chưa bao gồm thuế</p>
                    <p class="d-flex flex-column text-left" style="font-size: 14px">Ngày chứng từ: <?php if($dbdata["TrangThai"]=="Hoàn thành") { $date=date_create($dbdata["NgayChuyen"]);echo date_format($date,"d/m/Y"); } else { echo "---"; }?></p>
                    <p class="d-flex flex-column text-left" style="font-size: 14px">Ghi chú đơn hàng: <?php echo $dbdata["Ghichu"]?></p>
                    <?php
                        if($dbdata["TrangThai"] == "Đã tiếp nhận"){
                    ?>
                    <p class="d-flex flex-column text-left" style="font-size: 14px">Nhân viên bán hàng: --/-- </p>
                    <?php }else {?>
                            <p class="d-flex flex-column text-left" style="font-size: 14px">Nhân viên bán hàng: <?php echo $db_staff["Hoten"]?> </p>
                    <?php }?>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Thông tin khách hàng</h3>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" style="margin-left: 20px;font-size: 16px"><i class="fas fa-user" style="margin-right: 2px"></i><strong>Họ tên: </strong> <?php echo $dbdata["Hoten"]?></h3>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" style="margin-left: 20px;font-size: 16px"><i class="fas fa-phone" style="margin-right: 2px"></i><strong>Số điện thoại: </strong><?php echo $dbdata["Dienthoai"]?></h3>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" style="margin-left: 20px;font-size: 16px"><i class="fas fa-envelope" style="margin-right: 2px"></i><strong>Email: </strong> <?php echo $db_khachhang["Email"]?></h3>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title" style="margin-left: 20px;font-size: 16px"><i class="fas fa-map-marker-alt" style="margin-right: 2px"></i><strong>Địa chỉ giao hàng: </strong><?php echo $dbdata["NoiGiao"]?>, <?php echo $db_quanhuyen["name_quanhuyen"]?>, <?php echo $db_thanhpho["name_city"]?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">Thông tin sản phẩm</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th style="width: 200px; text-align: right">Tên sản phẩm</th>
                                    <th style="text-align: center">Số lượng</th>
                                    <th style="width: 150px">Đơn giá</th>
                                    <th style="width: 130px">Thành tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                    while ($result= mysqli_fetch_array($db_detail)) {
                                        $price = $result["GiaSanPham"] * $result["Soluong"];
                                ?>
                                <tr>
                                    <td><?php echo $result["MaSanPham"]?></td>
                                    <td style="width: 300px; text-align: right"><?php echo $result["TenSanPham"]?></td>
                                    <td style="text-align: center"><?php echo $result["Soluong"]?></td>
                                    <td><span><?=number_format($result["GiaSanPham"],0,",",".")?></span></td>
                                    <td style="text-align: right"><?=number_format($price,0,",",".")?></td>
                                </tr>
                                <?php }?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center; font-weight: bold">Tổng tiền:</td>
                                    <td style="text-align: right"><?=number_format($dbdata["TongTien"],0,",",".")?></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center; font-weight: bold">Tiền ship:</td>
                                    <td style="text-align: right"><?=number_format($dbdata["TongTienSauShip"] - $dbdata["TongTien"],0,",",".")?></td>
                                </tr>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td style="text-align: center; font-weight: bold">Khách phải trả:</td>
                                    <td style="text-align: right"><?=number_format($dbdata["TongTienSauShip"],0,",",".")?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="d-flex justify-content-between">
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body" style="float: right">
                            <?php
                                if($_SERVER["REQUEST_METHOD"]=="POST") {

                                    $querynhanvien = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$_SESSION["email"]."'";
                                    $getnhanvien = mysqli_query($conn, $querynhanvien);
                                    $laynhanvien = mysqli_fetch_array($getnhanvien);

                                    $status = $_POST["trangthai"];
                                    $ngaydat = date("Y-m-d H:i:s");
                                    $query = "UPDATE dondat SET  TrangThai = '".$status."',NgayChuyen = '".$ngaydat."', MaNhanVien = '".$laynhanvien["MaNhanVien"]."' WHERE MaDonDat = '".$_GET["madondat"]."'";
                                    $queryupdate=mysqli_query($conn,$query);
                                    echo "<script>location='../admin/listBill.php'</script>";
                                }
                            ?>
                            <?php
                            if($dbdata["TrangThai"] == "Hoàn thành") {
                                ?>
                                <h3 class="card-title card-footer" style="float: right"><i class="fa fa-check-circle" style="color: #28a745"></i> Xác nhận đơn hàng</h3>
<!--                                <form class="row contact_us_form" action="" method="post" id="contactForm" novalidate="novalidate" style="float: right">-->
<!--                                    <div class="card-footer" style="display: flex">-->
<!--                                        <select class="form-control" name="trangthai" id="" style="margin-right: 20px" disabled>-->
<!--                                            <option value="Hoàn thành">Hoàn thành</option>-->
<!--                                            <option value="Đã tiếp nhận">Đã tiếp nhận</option>-->
<!--                                        </select>-->
<!--                                        <button type="submit" class="btn btn-primary" disabled>Xác nhận</button>-->
<!--                                    </div>-->
<!--                                </form>-->
                            <?php }else {?>
                                <h3 class="card-title card-footer"><i class="fa fa-bookmark" style="color: red"></i> Chưa xác nhận đơn</h3>
                                <form class="row contact_us_form" action="" method="post" id="contactForm" novalidate="novalidate" style="float: right">
                                    <div class="card-footer" style="display: flex">
                                        <select class="form-control" name="trangthai" id="" style="margin-right: 20px">
                                            <option value="Hoàn thành">Hoàn thành</option>
                                            <option value="Đã tiếp nhận">Đã tiếp nhận</option>
                                            <option value="Đang giao">Đang giao</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                                    </div>
                                </form>
                            <?php }?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
</div>
<?php
    include ('../admin/layoutAdmin/footer.php')
?>

