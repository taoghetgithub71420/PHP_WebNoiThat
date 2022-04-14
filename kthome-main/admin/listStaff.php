<?php
    include ('../admin/layoutAdmin/header.php')
?>

<?php
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    $dbdata = "SELECT * FROM nhanvien ORDER BY MaNhanVien DESC LIMIT ".$item_per_page." OFFSET ".$offset;
    $query = mysqli_query($conn,$dbdata);

    $total = mysqli_query($conn,"SELECT * FROM nhanvien");
    $total = $total->num_rows;
    $totalpage = ceil($total / $item_per_page);
?>

<?php
    $getinfo = "SELECT * FROM NhanVien WHERE TenDangNhap = '".$_SESSION["email"]."'";
    $query_staff = mysqli_query($conn,$getinfo);
    $name = mysqli_fetch_array($query_staff);
?>

<?php
    if(isset($_GET["MaNhanVien"]))
    {
        $delete = "DELETE FROM nhanvien WHERE MaNhanVien = '".$_GET["MaNhanVien"]."'";
        if(mysqli_query($conn,$delete))
        {
            echo "<script>alert('Xóa thành công')</script>";
            echo "<script>location='listStaff.php'</script>";
        }
        else
        {
            echo "<script>alert('Nhân viên đang xử lý đơn đặt')</script>";
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
                        <h1 class="m-0">Danh sách nhân viên</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" style="margin-left: -120px">
                        <a href="addStaff.php" class="btn btn-success float-right"><i class="fa fa-plus-circle"></i>Thêm</a>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" style="background-color: #007bff;">
                        <h3 class="card-title" style="color:#fff; padding: 5px" >Danh sách nhân viên</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th style="width: 180px">Tên nhân viên</th>
                                <th style="width: 180px">Tài khoản</th>
                                <th style="width: 150px">Chức vụ</th>
                                <th style="width: 150px">Ngày sinh</th>
                                <th style="width: 130px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)){
                                    $getrole = "SELECT * FROM roles WHERE MaRole ='".$row["MaRole"]."' ";
                                    $role=mysqli_query($conn,$getrole);
                                    $name_role = mysqli_fetch_array($role);
                                ?>
                                <tr>
                                    <td><?php echo $row["MaNhanVien"]?></td>
                                    <td><?php echo $row["Hoten"]?></td>
                                    <td><?php echo $row["TenDangNhap"]?></td>
                                    <?php if($name_role["MaRole"] == 1) {?>
                                        <td ><span style="background: #E7FBE3;width: 160px; color: #0DB473; border-radius: 20px; padding: 3px;"><?php echo $name_role["TenRole"]?></span></td>
                                    <?php } else {?>
                                        <td ><span class="" style="font-size: 14px"><?php echo $name_role["TenRole"]?></span></td>
                                    <?php }?>
                                    <td>
                                        <?php
                                            $date=date_create($row["Ngaysinh"]);
                                            echo date_format($date,"d/m/Y");
                                        ?>
                                    </td>
                                    <td>
                                        <a href="../admin/editStaff.php?Mastaff=<?php echo $row["MaNhanVien"]?>&Marole=<?php echo $name_role["MaRole"]?>" class="btn btn-primary icons"><i class="fas fa-edit"></i></a>
                                        <a onclick="return Del('<?php echo $row["Hoten"];?>')" href="<?php echo $_SERVER["PHP_SELF"];?>?MaNhanVien=<?php echo $row["MaNhanVien"];?>" class="btn btn-danger icons"><i class="fas fa-trash-alt"></i></a>
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

<script>
    function Del(name) {
        return confirm("Bạn có chắc muốn xóa nhân viên: " + name + "?");
    }
</script>

<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
</body>
</html>

