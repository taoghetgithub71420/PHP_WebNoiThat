<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    include ('../page/connect.php')
?>

<?php
    $querynhanvien = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$_SESSION["email"]."'";
    $getnhanvien = mysqli_query($conn, $querynhanvien);
    $laynhanvien = mysqli_fetch_array($getnhanvien);


    $search = isset($_GET["city"])? $_GET["city"] : "" ;
    if($search) {
        $get = "WHERE TenSanPham LIKE '%".$search."%' ";
    }
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    if ($search) {
        $dbdata = "SELECT * FROM sanpham WHERE TenSanPham LIKE '%".$search."%' ORDER BY MaSanPham DESC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM sanpham WHERE TenSanPham LIKE '%".$search."%' ");
    } else {
        $dbdata = "SELECT * FROM sanpham ORDER BY MaSanPham DESC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM sanpham");
    }
    $total = $total->num_rows;
    $totalpage = ceil($total / $item_per_page);





    if(isset($_GET["MaSanPham"]))
    {
        $delete = "DELETE FROM sanpham WHERE MaSanPham='".$_GET["MaSanPham"]."'";
        if(mysqli_query($conn,$delete))
        {
            echo "<script>alert('Xóa thành công')</script>";
            echo "<script>location='listProduct.php'</script>";
        }
        else
        {
            echo "<script>alert('Sản phẩm đã có trong đơn đặt')</script>";
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
                <h1 class="m-0">Danh sách sản phẩm </h1>
              </div><!-- /.col -->

                <div class="col-sm-6">
                    <?php if($laynhanvien["MaRole"] == 1){?>
                        <a href="addProduct.php" class="btn btn-success float-right" style="margin-right: 85px"><i class="fa fa-plus-circle"></i> Thêm</a>
                    <?php }else{?>
                        <a href="404.php" class="btn btn-success float-right" style="margin-right: 85px"><i class="fa fa-plus-circle"></i> Thêm</a>
                    <?php }?>
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
                <h3 class="card-title" style="color:#fff;" >Danh sách sản phẩm</h3>
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
                      <td>
                          <a href="../admin/detailProduct.php?masp=<?php echo $row["MaSanPham"]?>"</a>
                          <?php echo $row["TenSanPham"]?>
                      </td>
                        <?php if ($row["MaTrangThaiSanPham"] == 2 && $row["SoLuong"] == 0){?>
                            <td><span class="badge bg-danger" style="font-size: 15px""><?php echo $status["TenTrangThai"]?></span></td>
                        <?php }else{ ?>
                            <td><span style="background: #E7FBE3;width: 160px; color: #0DB473; border-radius: 20px; padding: 3px;"><?php echo $status["TenTrangThai"]?></span></td>
                        <?php }?>
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
                          <?php if($laynhanvien["MaRole"] == 1){?>
                              <a onclick="return Del('<?php echo $row["TenSanPham"];?>')" href="<?php echo $_SERVER["PHP_SELF"];?>?MaSanPham=<?php echo $row["MaSanPham"];?>" class="btn btn-danger icons"><i class="fas fa-trash-alt"></i></a>
                          <?php }else{?>
                              <a href="404.php"  class="btn btn-danger icons">
                                  <i class="fas fa-trash-alt"></i>
                              </a>
                          <?php }?>
                      </td>
                    </tr>
                      <?php
                    }
                  ?>
                  </tbody>
                </table>
              </div>
<!--                <hr> -->
                <?php
                    include ("pagination.php")
                ?>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </div>

<script>
    function Del(name) {
        return confirm("Bạn có chắc muốn xóa sản phẩm: " + name + "?");
    }
</script>




<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
</body>
</html>
