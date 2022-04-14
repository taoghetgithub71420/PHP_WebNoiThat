<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    include ('../page/connect.php')
?>
<?php
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 7;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    $dbdata = "SELECT * FROM thanhvien ORDER BY TenDangNhap DESC LIMIT ".$item_per_page." OFFSET ".$offset;
    $query = mysqli_query($conn,$dbdata);

    $total = mysqli_query($conn,"SELECT * FROM thanhvien");
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
            <h1 class="m-0">Danh sách khách hàng </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
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
                  <th style="width: 220px">Tên khách hàng</th>
                  <th style="width: 140px">Số điện thoại</th>
                  <th style="width: 200px">Email</th>
                    <th style="width: 120px">Tổng chi tiêu</th>
                  <th style="width: 150px;text-align: center">Tổng SL đơn hàng</th>
                  <th style="width: 120px"></th>
                </tr>
              </thead>
              <tbody>
              <?php
                while ($row = mysqli_fetch_array($query)){
                    $getcount = "SELECT MaDonDat FROM dondat WHERE TenDangNhap = '".$row["TenDangNhap"]."'";
                    $db = mysqli_query($conn,$getcount);
                    $count = mysqli_num_rows($db);

                    $totalchitieu = "SELECT SUM(TongTienSauShip) FROM `dondat` WHERE TenDangNhap = '".$row["TenDangNhap"]."'";
                    $query_total = mysqli_query($conn, $totalchitieu);
                    $result_total = mysqli_fetch_row($query_total);
              ?>
                <tr>
                  <td><?php echo $row["Hoten"]?></td>
                  <td><?php echo $row["Dienthoai"]?></td>
                  <td><?php echo $row["Email"]?></td>
                    <td><?php echo number_format($result_total[0],0,",",".") ?></td>
                  <td style="text-align: center"><?php echo $count ?></td>
                    <td>
                        <a href="../admin/detailUser.php?idUser=<?php echo $row["TenDangNhap"]?>" class="btn btn-primary icons"><i class="fas fa-edit"></i></a>
                    </td>
                </tr>
              <?php }?>
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
