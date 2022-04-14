<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    include ('../page/connect.php')
?>
<?php
//    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
//    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
//    $offset = ($current_page-1) * $item_per_page;
//    $dbdata = "SELECT * FROM dondat ORDER BY MaDonDat DESC LIMIT ".$item_per_page." OFFSET ".$offset;
//    $query = mysqli_query($conn,$dbdata);
//
//    $total = mysqli_query($conn,"SELECT * FROM dondat");
//    $total = $total->num_rows;
//    $totalpage = ceil($total / $item_per_page);

    $search = isset($_GET["city"])? $_GET["city"] : "" ;
    if($search) {
        $get = "WHERE Hoten LIKE '%".$search."%' ";
    }
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    if ($search) {
        $dbdata = "SELECT * FROM dondat WHERE Hoten LIKE '%".$search."%' ORDER BY MaDonDat DESC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM dondat WHERE Hoten LIKE '%".$search."%' ");
    } else {
        $dbdata = "SELECT * FROM dondat ORDER BY MaDonDat DESC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM dondat");
    }
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
            <h1 class="m-0">Danh sách đơn hàng </h1>
          </div><!-- /.col -->


            <div class="col-sm-6">
                <div class="col-sm-6" style="margin-left: 250px">
                    <div class="form-inline">
                        <form action="" method="get">
                            <div id="search" class="input-group" >
                                <input name="city" class="form-control form-control-sidebar" type="search" placeholder="Search" value="<?=isset($_GET["city"]) ? $_GET["city"] : "" ?>" aria-label="Search">
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
                    <?php } else if ($row["TrangThai"] == "Hoàn thành") {?>
                        <td ><p style="background: #E7FBE3;width: 110px; color: #0DB473; border-radius: 20px; padding-left: 16px;margin-left: 150px"><?php echo $row["TrangThai"]?></p></td>
                    <?php } else {?>
                        <td ><p class="badge bg-warning" style="margin-left: 150px;font-size: 16px; padding: 5px;width: 100px"><?php echo $row["TrangThai"]?></p></td>
                    <?php } ?>
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
              <?php
                include ("pagination.php")
              ?>
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
