<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    $getinfo = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$_SESSION["email"]."'";
    $query = mysqli_query($conn,$getinfo);
    $name = mysqli_fetch_array($query);
?>

<?php
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    $dbdata = "SELECT * FROM blog ORDER BY MaBlog DESC LIMIT ".$item_per_page." OFFSET ".$offset;
    $query = mysqli_query($conn,$dbdata);

    $total = mysqli_query($conn,"SELECT * FROM blog");
    $total = $total->num_rows;
    $totalpage = ceil($total / $item_per_page);



    if(isset($_GET["Mablog"]))
    {
        $delete = "DELETE FROM blog WHERE MaBlog = '".$_GET["Mablog"]."'";
        if(mysqli_query($conn,$delete))
        {
            echo "<script>alert('Xóa thành công')</script>";
            echo "<script>location='listBlog.php'</script>";
        }
        else
        {
            echo "<script>alert('Xảy ra lỗi')</script>";
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
                        <h1 class="m-0">Quản lí blog web</h1>
                    </div><!-- /.col -->
                    <?php if($name["MaRole"] == 1){?>
                    <div class="col-sm-6" style="margin-left: -85px">
                        <a href="addBlog.php" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i>Thêm</a>
                    </div><!-- /.col -->
                    <?php }else{?>
                        <div class="col-sm-6" style="margin-left: -85px">
                            <a href="404.php" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i>Thêm</a>
                        </div><!-- /.col -->
                    <?php }?>
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #007bff;">
                        <h3 class="card-title" style="color:#fff;" >Danh sách blog</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 30px">#</th>
                                <th style="width: 130px;text-align: center">Ảnh</th>
                                <th style="width: 130px;text-align: center">Thời gian</th>
                                <th style="width: 150px;text-align: center">Nhân viên tạo</th>
                                <th style="width: 70px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)){
                                $getStaff = "SELECT * FROM nhanvien WHERE MaNhanVien = '".$row["MaNhanVien"]."'";
                                $query_staff = mysqli_query($conn,$getStaff);
                                $nameStaff = mysqli_fetch_array($query_staff);
                                ?>
                                <tr>
                                    <td><?php echo $row["MaBlog"]?></td>
                                    <td style="text-align: center">
                                        <img class="img-fluid" src="../images/imageblog/<?php echo $row["HinhAnh"]?>" alt="" style="width: 100px">
                                    </td>
                                    <td style="text-align: center">
                                        <?php
                                        $date=date_create($row["Ngaytao"]);
                                        echo date_format($date,"d/m/Y");?>
                                    </td>
                                    <td style="text-align: center">
                                        <p><?php echo $nameStaff["Hoten"]?></p>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="editBlog.php?Mablog=<?php echo $row["MaBlog"]?>&MaNhanVien=<?php echo $row["MaNhanVien"]?>" class ="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <?php if($name["MaRole"] == 1){?>
                                        <a onclick="return Del('<?php echo $row["TieuDe"];?>')" href="<?php echo $_SERVER["PHP_SELF"];?>?Mablog=<?php echo $row["MaBlog"];?>" class="btn btn-danger icons" >
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
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


<script>
    function Del(name) {
        return confirm("Bạn có chắc muốn xóa blog: " + name + "?");
    }
</script>




<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>

