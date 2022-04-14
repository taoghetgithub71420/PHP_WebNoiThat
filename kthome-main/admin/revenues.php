<?php
    include ('../admin/layoutAdmin/header.php')
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <a href="statistical.php"> <span>&#60;</span> Báo cáo doanh thu</a>
                <h1 class="m-0">Lợi nhuận sản phẩm theo tháng <?php echo $date = date('m');?> </h1>
              </div><!-- /.col -->

                <div class="col-sm-3" style="margin-top: 20px; margin-left: 300px">
                    <select class="form-control" name="click" onchange="location = this.value;">
                        <option value="revenues.php">Lợi nhuận theo tháng</option>
                        <option value="revenuesProduct7Day.php">Lợi nhuận trong 7 ngày</option>
                        <option value="revenuesAllProduct.php">Lợi nhuận theo tất cả sản phẩm</option>
                    </select>
                </div>

            </div><!-- /.row -->
          </div><!-- /.container-fluid -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" style="background-color: #007bff;">
                <h3 class="card-title" style="color:#fff; padding: 5px" >Lợi nhuận theo sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table">
                  <thead>
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th style="width: 130px">Sản phẩm</th>
                      <th style="width: 100px">SL hàng thực bán</th>
                      <th style="width: 120px;text-align: center">Doanh thu thuần</th>
                      <th style="width: 100px;text-align: center">Tiền vốn</th>
                      <th style="width: 100px;text-align: center">Lợi nhuận</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $sort = "SELECT *, SUM(ct_dondat.Soluong) as total 
                            FROM ct_dondat 
                            INNER JOIN sanpham ON ct_dondat.MaSanPham = sanpham.MaSanPham 
                            INNER JOIN dondat ON dondat.MaDonDat = ct_dondat.MaDonDat
                            WHERE dondat.TrangThai = 'Hoàn thành' AND month(CURRENT_DATE) = month(NgayDat) 
                            GROUP BY ct_dondat.MaSanPham 
                            ORDER BY ct_dondat.MaSanPham DESC";
                  $query_sort = mysqli_query($conn, $sort);
                  $total_count = 0;
                  $total_revenues = 0;
                  $total_kho = 0;
                  $total_income = 0;
                  while ($row = mysqli_fetch_array($query_sort)){
//                      $query_kho = mysqli_query($conn,"SELECT GiaNhap FROM kho WHERE MaSanPham = '".$row["MaSanPham"]."'");
//                      $kho = mysqli_fetch_row($query_kho);

                      $total_count += $row["total"];
                      $total_revenues += $row["GiaSanPham"]*$row["total"];
                      $total_kho += $row["GiaVon"] * $row["total"];
                      $total_income += ($row["GiaSanPham"]*$row["total"]) - ($row["GiaVon"]* $row["total"]);
                      ?>
                    <tr>
                      <td><?php echo $row["MaSanPham"]?></td>
                      <td><?php echo $row["TenSanPham"];?></td>
                        <td><p style="margin-left: 50px"><?php echo $row["total"] ?></p></td>
                      <td><p style="text-align: center"><?php echo number_format($row["GiaSanPham"]*$row["total"],0,",",".")?></p></td>
                        <td style="text-align: center"><?php echo number_format( $row["GiaVon"]* $row["total"],0,",",".")?></td>
                      <td style="text-align: center">
                          <?php echo number_format( ($row["GiaSanPham"]*$row["total"]) - $row["GiaVon"]* $row["total"],0,",",".")?>
                      </td>

                    </tr>
                      <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position: fixed;bottom: 0;left: 0;right: 0;z-index: 1">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <h5 class="nav-link" style="margin-left: 30px;font-weight: bold"">Tổng tiền:</h5>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link" style="margin-left: 400px;font-weight: bold"><?php echo $total_count?></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link" style="margin-left: 265px;font-weight: bold"><?php echo number_format($total_revenues,0,",",".")?></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link" style="margin-left: 200px;font-weight: bold"><?php echo number_format($total_kho,0,",",".")?></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link" style="margin-left: 160px;font-weight: bold"><?php echo number_format($total_income,0,",",".")?></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

            </ul>
        </nav>
    </div>


<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
</body>
</html>
