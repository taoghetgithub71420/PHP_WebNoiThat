<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    include ('../page/connect.php')
?>

<?php
    error_reporting(0);
    if (isset($_POST['timtendonhang'])) {
        $search = $_POST["timtendonhang"];
    } else {
        $search = $_GET['timtendonhang'];
    }
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $rowperpage = 10;
    $perrow = $page * $rowperpage - $rowperpage;

    $laysp = "SELECT * FROM dondat WHERE Hoten LIKE '%" . $_POST["timtendonhang"] . "%' ORDER BY 'MaDonDat' DESC LIMIT $perrow, $rowperpage";
    $query = mysqli_query($conn, $laysp);

    $totalrow = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM dondat WHERE Hoten LIKE '%" . $_POST["timtendonhang"] . "%'"));
    $totalpage = ceil($totalrow / $rowperpage);
    $listpage = "";
    for ($i = 1; $i <= $totalpage; $i++) {
        if ($page == $i) {
            $listpage .= '<li class="page-item"><a class="page-link" href="searchDonhang.php?search=' . $_POST["timtendonhang"] . '&page=' . $i . '">' . $i . '</a></li>';
        } else {
            $listpage .= '<li class="page-item"><a class="page-link" href="searchDonhang.php' . $_POST["timtendonhang"] . '&page=' . $i . '">' . $i . '</a></li>';
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
                    <h1 class="m-0">Danh sách đơn hàng </h1>
                </div><!-- /.col -->


                <div class="col-sm-6">
                    <div class="col-sm-6" style="margin-left: 250px">
                        <div class="form-inline">
                            <form action="searchDonhang.php" method="post">
                                <div id="search" class="input-group" >
                                    <input name="timtendonhang" class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar" style="background: #007bff">
                                            <i class="fas fa-search fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.col -->


            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Danh sách đơn hàng</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 150px">Mã đơn hàng</th>
                            <th style="width: 150px">Ngày tạo đơn</th>
                            <th style="width: 150px">Tên khách hàng</th>
                            <th style="width: 150px;text-align: center">Trạng thái đơn hàng</th>
                            <th style="width: 150px;text-align: center">Khách phải trả</th>
                            <th style="width: 70px"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($query)){
                            ?>
                            <tr>
                                <td><?php echo $row["MaDonDat"]?></td>
                                <td>
                                    <?php
                                    $date=date_create($row["NgayDat"]);
                                    echo date_format($date,"d/m/Y"); ?>
                                </td>
                                <td><?php echo $row["Hoten"]?></td>
                                <?php if($row["TrangThai"] == "Đã tiếp nhận") {?>
                                    <td ><p class="badge bg-danger" style="margin-left: 150px;font-size: 15px"><?php echo $row["TrangThai"]?></p></td>
                                <?php } else {?>
                                    <td ><p style="background: #E7FBE3;width: 110px; color: #0DB473; border-radius: 20px; padding-left: 16px;margin-left: 150px"><?php echo $row["TrangThai"]?></p></td>
                                <?php }?>
                                <td style="text-align: center"><?=number_format($row["TongTienSauShip"],0,",",".")?></td>
                                <td>
                                    <a href="editOrder.php?madondat=<?php echo $row["MaDonDat"]?>&TenDangNhap=<?php echo $row["TenDangNhap"]?>&MaNhanVien=<?php echo $row["MaNhanVien"]?>" class ="btn btn-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <?php for($num = 1 ; $num <= $totalpage; $num++){ ?>
                                <li class="page-item"><a class="page-link" href="?per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></li>
                            <?php } ?>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>

                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
</div>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

