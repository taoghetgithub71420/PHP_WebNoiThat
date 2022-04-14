<?php
    include ('../admin/layoutAdmin/header.php')
?>


<?php
    $getuser = "SELECT * FROM thanhvien WHERE TenDangNhap = '".$_GET["idUser"]."'";
    $query = mysqli_query($conn,$getuser);
    $dbdata = mysqli_fetch_array($query);

    $total = "SELECT SUM(TongTienSauShip) FROM dondat WHERE TenDangNhap = '".$_GET["idUser"]."' and TrangThai = 'Hoàn thành'";
    $query_total = mysqli_query($conn, $total);
    $result_total = mysqli_fetch_row($query_total);

    $getcount = "SELECT MaDonDat FROM dondat WHERE TenDangNhap = '".$_GET["idUser"]."' and TrangThai = 'Hoàn thành'";
    $db = mysqli_query($conn,$getcount);
    $count = mysqli_num_rows($db);

    $gethistory = "SELECT * FROM dondat WHERE TenDangNhap = '".$_GET["idUser"]."' ORDER BY MaDonDat DESC ";
    $db_history = mysqli_query($conn,$gethistory);
    $db_hiscountpro = mysqli_query($conn,$gethistory);
    $history = mysqli_fetch_array($db_hiscountpro);


    $countsp="SELECT MaSanPham FROM ct_dondat INNER JOIN dondat ON ct_dondat.MaDonDat = dondat.MaDonDat  WHERE TenDangNhap= '".$_GET["idUser"]."' AND TrangThai='Hoàn thành'";
    $sp=mysqli_query($conn,$countsp);
    $laysp=mysqli_num_rows($sp);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <a href="listUser.php"> <span>&#60;</span> Danh sách khách hàng</a>
                    <h1 class="m-0"> Khách hàng <?php echo $dbdata["Hoten"]?> </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="card col-3" style="float: right; margin-right: 60px;">
        <div class="d-flex card-header justify-content-between border-0">
            <h3 class="card-title">Thông tin tích điểm</h3>

        </div>
        <div class="card-body">
            <div class=" justify-content-between align-items-center border-bottom mb-3">
                <!--                <p class="d-flex flex-column text-left" style="font-size: 14px">Bảng giá: Giá bán lẻ</p>-->
                <!--                <p class="d-flex flex-column text-left" style="font-size: 14px">Thuế: Giá chưa bao gồm thuế</p>-->
                <!--                <p class="d-flex flex-column text-left" style="font-size: 14px">Ngày chứng từ: --><?php //if($dbdata["Status"]=="Hoàn thành") { $date=date_create($dbdata["Datedeliver"]);echo date_format($date,"d/m/Y"); } else { echo "---"; }?><!--</p>-->
                <!--                <p class="d-flex flex-column text-left" style="font-size: 14px">Nội dung: --><?php //echo $dbdata["Notes"]?><!--</p>-->
                <!--                <p class="d-flex flex-column text-left" style="font-size: 14px">Nhân viên bán hàng: --><?php //echo $db_staff["Name"]?><!--</p>-->
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Thông tin cá nhân</h3>
                </div>
                <div class="card-header border-0" style="height: 100px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Tên khách: <?php echo $dbdata["Hoten"]?></h3>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Số điện thoại: <?php echo $dbdata["Dienthoai"]?></h3>
                            </div>

                            <?php
                                $loaiuser =  number_format($result_total[0],0,",",".");
                                $userprice = '30000000';
                                $formatprice =  number_format($userprice,0,",",".");
                            ?>

                            <div class="d-flex justify-content-between">
                                <?php
                                    if($loaiuser > $formatprice){ ?>
                                    <h3 class="card-title" style="font-size: 15px">Loại khách hàng: Khách VIP</h3>
                                <?php } else {?>
                                    <h3 class="card-title" style="font-size: 15px">Loại khách hàng: Khách thường</h3>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-md-6">
<!--                            <div class="d-flex justify-content-between">-->
<!--                                <h3 class="card-title" style="font-size: 15px">Mã khách hàng: --><?php //echo $dbdata["TenDangNhap"]?><!--</h3>-->
<!--                            </div>-->
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Email: <?php echo $dbdata["Email"]?></h3>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Nhân viên phụ trách: --</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Thông tin mua hàng</h3>
                </div>
                <div class="card-header border-0" style="height: 130px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Tổng chi tiêu: <?php echo number_format($result_total[0],0,",",".")?> VNĐ</h3>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Tổng SL đơn: <?php echo $count ?></h3>
                            </div>

                            <?php
                                $firsdate="SELECT *,NgayDat FROM dondat WHERE TenDangNhap = '".$_GET["idUser"]."' AND TrangThai='Hoàn thành'";
                                $date=mysqli_query($conn,$firsdate);
                                $xuatdate=mysqli_fetch_array($date);
                            ?>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Ngày đầu tiên mua hàng:
                                    <?php
                                        if($xuatdate["TrangThai"] == "Hoàn thành"){
                                            $date1=date_create($xuatdate["NgayDat"]);
                                            echo date_format($date1,"d/m/Y");
                                        }else{
                                            { echo "--"; }
                                        }
                                    ?>
                                </h3>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Ngày cuối cùng mua hàng:
                                    <?php
                                        if($history["TrangThai"] == "Hoàn thành"){
                                            $date1=date_create($history["NgayDat"]);
                                            echo date_format($date1,"d/m/Y");
                                        }else{
                                            { echo "--"; }
                                        }
                                    ?>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Tổng SL sản phẩm đã mua: <?php echo $laysp?></h3> <a data-toggle="modal" data-target="#modal-lg" ><i style="margin-right: 240px" class="fas fa-search"></i></a><br>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Tổng SL sản phẩm hoàn trả: 0</h3>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title" style="font-size: 15px">Công nợ hiện tại: --</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Lịch sử mua hàng</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 200px">Mã đơn hàng</th>
                                <th style="width: 300px">Trạng thái</th>
                                <th>Thanh toán</th>
                                <th style="">Giá trị</th>
                                <th style="width: 190px">Nhân viên xử lí đơn</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($result = mysqli_fetch_array($db_history)) {
                                $getstaff = "SELECT * FROM nhanvien WHERE MaNhanVien = '".$result["MaNhanVien"]."'";
                                $db_staff = mysqli_query($conn,$getstaff);
                                $namestaff = mysqli_fetch_array($db_staff);
                                ?>
                                <tr>
                                    <td><?php echo $result["MaDonDat"]?></td>
                                    <?php
                                    if($result["TrangThai"]=="Đã tiếp nhận") {
                                        ?>
                                        <td><p class="badge bg-danger" style="font-size: 15px"><?php echo $result["TrangThai"]?></p></td>
                                    <?php }else {?>
                                        <td><p style="background: #E7FBE3;width: 110px; color: #0DB473; border-radius: 20px; padding-left: 16px;"><?php echo $result["TrangThai"]?></p></td>
                                    <?php }?>
                                    <td style="margin-left: 50px;">
                                        <?php
                                        if($result["TrangThai"]=="Đã tiếp nhận") {
                                            ?>
                                            <span><i class="far fa-circle"></i></span>
                                        <?php }else {?>
                                            <span><i class="fas fa-circle"></i></span>
                                        <?php }?>
                                    </td>
                                    <td ><?php echo number_format($result["TongTienSauShip"],0,",",".") ?></td>
                                    <td style="text-align: center"><?php echo $namestaff["Hoten"]?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- /.modal -->
<?php
    $sqlsanpham = "SELECT sanpham.*,ct_dondat.*,dondat.*,ct_dondat.Soluong as 'sl',dondat.TrangThai 
            FROM ct_dondat 
            INNER JOIN sanpham ON ct_dondat.MaSanPham=sanpham.MaSanPham 
            INNER JOIN dondat ON ct_dondat.MaDonDat = dondat.MaDonDat  
            WHERE dondat.TrangThai='Hoàn thành' AND TenDangNhap = '".$_GET["idUser"]."'";
    $querysanpham = mysqli_query($conn, $sqlsanpham);
?>
<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="margin-left: 130px">Danh sách sản phẩm khách hàng đã mua</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 150px">Mã đơn hàng</th>
                            <th style="width: 150px">Tên sản phẩm</th>
                            <th style="width: 95px">Số lượng</th>
                            <th style="width: 150px;text-align: center">Đơn giá</th>
                            <th style="width: 140px;text-align: center">Ngày mua</th>
                            <th style="width: 70px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            while ( $getsanpham = mysqli_fetch_array($querysanpham)){
                        ?>
                            <tr>
                                <td><?php echo $getsanpham["MaDonDat"]?></td>
                                <td><?php echo $getsanpham["TenSanPham"]?></td>
                                <td style="text-align: center"><?php echo $getsanpham["sl"]?></td>
                                <td style="text-align: center"><?=number_format($getsanpham["GiaSanPham"],0,",",".")?></td>
                                <td style="text-align: center"><?php
                                    $date=date_create($getsanpham["NgayDat"]);
                                    echo date_format($date,"d/m/Y"); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<?php
    include ('../admin/layoutAdmin/footer.php')
?>


