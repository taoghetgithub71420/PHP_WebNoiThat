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
              <h1 class="m-0">Trang chủ </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-check-alt"></i></span>
              <div class="info-box-content">
                  <?php
                      $total = "SELECT SUM(TongTienSauShip) FROM `dondat` WHERE TrangThai = 'Hoàn thành'";
                      $query_total = mysqli_query($conn,$total);
                      $result_total = mysqli_fetch_row($query_total);
                  ?>
                  <span class="info-box-text">Doanh Thu</span>
                  <span class="info-box-number">
                      <?php echo number_format($result_total[0],0,",",".")?>
                  <small>VNĐ</small>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fab fa-product-hunt"></i></span>
              <div class="info-box-content">
                  <?php
                      $getcount = "SELECT * FROM sanpham";
                      $db = mysqli_query($conn,$getcount);
                      $count = mysqli_num_rows($db);
                  ?>
                  <span class="info-box-text">Tổng sản phẩm</span>
                  <span class="info-box-number"><?php echo $count?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                <div class="info-box-content">
                    <?php
                        $getbill = "SELECT * FROM dondat";
                        $db_bill = mysqli_query($conn,$getbill);
                        $count_bill = mysqli_num_rows($db_bill);
                    ?>
                    <span class="info-box-text">Tổng đơn hàng</span>
                    <span class="info-box-number"><?php echo $count_bill?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                  <?php
                      $getaccount = "SELECT * FROM thanhvien";
                      $db_accounts = mysqli_query($conn,$getaccount);
                      $count_accounts = mysqli_num_rows($db_accounts);
                  ?>
                  <span class="info-box-text">Members</span>
                  <span class="info-box-number"><?php echo $count_accounts?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


          <div style="display: flex">
              <div class="card col-8">
                  <div class="card">
                      <div class="card-header border-0">
                          <div class="d-flex justify-content-between">
                              <h3 class="card-title">Tổng doanh thu</h3>
                          </div>
                      </div>
                      <div class="card-body">
                          <div class="d-flex">
                              <p class="d-flex flex-column">
                                  <span class="text-bold text-lg"> <?php echo number_format($result_total[0],0,",",".")?> VNĐ</span>
                                  <span>Sales Over Time</span>
                              </p>
                              <?php
                                  //tháng vừa rồi
                                  $curdate_last = "SELECT SUM(TongTienSauShip) as total FROM dondat WHERE month(NgayDat) = month(curdate())-1 and TrangThai = 'Hoàn thành'";
                                  $query_last = mysqli_query($conn, $curdate_last);
                                  $lastmonth = mysqli_fetch_row($query_last);
                                  // tháng này
                                  $curdate = "SELECT SUM(TongTienSauShip) FROM dondat WHERE month(curdate()) = month(NgayDat) and TrangThai = 'Hoàn thành'";
                                  $query_curdate = mysqli_query($conn, $curdate);
                                  $curdate_query = mysqli_fetch_row($query_curdate);

//                                  $result =  (($curdate_query[0]/$lastmonth[0])*100)-100;
                                  $result =  (($curdate_query[0]*100)/$lastmonth[0]);
//                                  if($result > 100) {
//                                      $result = 100;
//                                  } else if($result < 0) {
//                                      $result = 0;
//                                  }
                              ?>
                              <p class="ml-auto d-flex flex-column text-right">
                                  <span class="text-success">
                                    <i class="fas fa-arrow-up"></i> <?php echo number_format((float)$result, 2, '.', '')?>%
                                  </span>
                                  <span class="text-muted">Since last month</span>
                              </p>
                          </div>

                          <div class="card-body">
                              <div class="chart">
                                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                              </div>
                          </div>
                          <div class="d-flex flex-row justify-content-end">
                            <span class="mr-2">
                              <i class="fas fa-square text-primary"></i> This year
                            </span>
                              <span>
                              <i class="fas fa-square text-gray"></i> Last year
                            </span>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-4">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Sản phẩm bán chạy</h3>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                  <i class="fas fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body p-0">
                          <ul class="products-list product-list-in-card pl-2 pr-2">
                              <?php
                                  $sort = "SELECT * ,SUM(ct_dondat.Soluong) as total FROM ct_dondat INNER JOIN sanpham ON ct_dondat.MaSanPham = sanpham.MaSanPham JOIN dondat ON ct_dondat.MaDonDat = dondat.MaDonDat WHERE TrangThai = 'Hoàn thành' GROUP BY ct_dondat.MaSanPham ORDER BY SUM(ct_dondat.Soluong) DESC LIMIT 6";
                                  $query_sort = mysqli_query($conn,$sort);
                              while ($row_sort = mysqli_fetch_array($query_sort)){
                                  ?>
                                  <li class="item">
                                      <div class="product-img">
                                          <img src="../images/imageproduct/<?php echo $row_sort["Anh"]?>" alt="Product Image" class="img-size-50" style="width: 50px;height: 50px">
                                      </div>
                                      <div class="product-info">
                                          <a href="#" class="product-title"><?php echo $row_sort["TenSanPham"]?>
                                              <span class="badge badge-warning float-right"><?php echo $row_sort["total"]?></span></a>
                                          <span class="product-description">
                                                <?php
                                                    $getgenres = "SELECT * FROM loaisp WHERE MaLoaiSP = '".$row_sort["MaLoaiSp"]."'";
                                                    $db_genres = mysqli_query($conn,$getgenres);
                                                    $count_genres = mysqli_fetch_array($db_genres);
                                                    echo $count_genres["TenLoai"]
                                                ?>
                                            </span>
                                      </div>
                                  </li>
                              <?php }?>
                          </ul>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-footer text-center">
                          <a href="../admin/listProduct.php" class="uppercase">Xem tất cả</a>
                      </div>
                      <!-- /.card-footer -->
                  </div>
              </div>
          </div>
    </div>
        <?php
            $i = 1;
            for ($i;$i<13;$i++) {
                    $get_total = "SELECT SUM(TongTienSauShip) as total FROM dondat WHERE month(NgayDat) = '$i' and TrangThai = 'Hoàn thành'";
                    $query = mysqli_query($conn, $get_total);
                    $mysql = mysqli_fetch_array($query);
                ?>
                <input type="hidden" id="total<?php echo $i?>" value="<?php echo $mysql["total"]?>">
        <?php }?>


<?php
    include ('../admin/layoutAdmin/footer.php')
?>

