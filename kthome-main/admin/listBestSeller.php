<?php
    include ('../admin/layoutAdmin/header.php')
?>


<?php
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 7;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    $sqlbest = "SELECT * FROM ct_dondat INNER JOIN sanpham ON ct_dondat.MaSanPham = sanpham.MaSanPham GROUP BY ct_dondat.MaSanPham ORDER BY SUM(ct_dondat.Soluong) DESC LIMIT  " .$item_per_page." OFFSET ".$offset;
    $query = mysqli_query($conn,$sqlbest);

    $total = mysqli_query($conn,"SELECT * FROM ct_dondat INNER JOIN sanpham ON ct_dondat.MaSanPham = sanpham.MaSanPham GROUP BY ct_dondat.MaSanPham ORDER BY SUM(ct_dondat.Soluong)");
    $total = $total->num_rows;
    $totalpage = ceil($total / $item_per_page);

?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Danh sách sản phẩm bán chạy</h1>
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Danh sách sản phẩm bán chạy</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 10px">ID</th>
                            <th style="width: 90px">Ảnh</th>
                            <th style="width: 180px">Sản phẩm</th>
                            <th style="width: 150px">Trạng thái</th>
                            <th style="width: 120px">Giá</th>
                            <th style="width: 100px">Có thể bán</th>
                            <th style="width: 150px">Ngày khởi tạo</th>
                            <th style="width: 110px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($query)){
                                $idstatus = "SELECT * FROM trangthaisanpham WHERE MaTrangThaiSanPham ='".$row["MaTrangThaiSanPham"]."'";
                                $getstatus = mysqli_query($conn,$idstatus);
                                $status = mysqli_fetch_array($getstatus);
                            ?>
                            <tr>
                                <td><?php echo $row["MaSanPham"]?></td>
                                <td><img src="../images/imageproduct/<?php echo $row["Anh"]?>" style="width: 50px"></td>
                                <td><?php echo $row["TenSanPham"]?></td>
                                <td><?php echo $status["TenTrangThai"]?></td>
                                <td><?=number_format($row["DonGia"],0,",",".")?> VNĐ</td>
                                <td><?php echo $row["SoLuong"]?></td>
                                <td>
                                    <?php
                                        $date = date_create($row["Ngaytao"]);
                                        echo date_format($date,"d/m/Y");
                                    ?>
                                </td>
                                <td>
                                    <a href="../admin/editProduct.php?masp=<?php echo $row["MaSanPham"]?>&loaisp=<?php echo $row["MaLoaiSp"]?>" class="btn btn-primary icons"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <!--                <hr> -->
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                        <?php for($num = 1 ; $num <= $totalpage; $num++){ ?>
                            <li class="page-item"><a class="page-link" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
                        <?php } ?>
                        <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
</div>






<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
</body>
</html>

