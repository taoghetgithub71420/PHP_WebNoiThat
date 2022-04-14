<?php
    include ('../admin/layoutAdmin/header.php')
?>


<?php
    $search = isset($_GET["city"])? $_GET["city"] : "" ;
    if($search) {
        $get = "WHERE name_city LIKE '%".$search."%' ";
    }
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 10;
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($current_page-1) * $item_per_page;
    if ($search) {
        $dbdata = "SELECT * FROM tinhthanhpho WHERE name_city LIKE '%".$search."%' ORDER BY matp ASC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM tinhthanhpho WHERE name_city LIKE '%".$search."%' ");
    } else {
        $dbdata = "SELECT * FROM tinhthanhpho ORDER BY matp ASC LIMIT ".$item_per_page." OFFSET ".$offset;
        $query = mysqli_query($conn,$dbdata);

        $total = mysqli_query($conn,"SELECT * FROM tinhthanhpho");
    }
    $total = $total->num_rows;
    $totalpage = ceil($total / $item_per_page);



    if(isset($_GET["matp"]))
    {
        $delete="DELETE FROM tinhthanhpho WHERE matp ='".$_GET["matp"]."'";
        if(mysqli_query($conn,$delete))
        {
            echo "<script>alert('Xóa thành công')</script>";
            echo "<script>location='listCity.php'</script>";
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
                        <h1 class="m-0">Danh sách tỉnh thành phố </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6" >
                        <a href="addProduct.php" class="btn btn-success float-right" style="margin-right: 180px"><i class="fa fa-plus-circle"></i> Thêm</a>
                        <div class="col-sm-6" style="margin-left:200px">
                            <div class="form-inline">
                                <form action="" method="get">
                                    <div class="input-group" >
                                        <input class="form-control form-control-sidebar" name="city" type="search" placeholder="Search" value="<?=isset($_GET["city"]) ? $_GET["city"] : "" ?>" aria-label="Search">
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
                        <h3 class="card-title" style="color:#fff; padding: 5px" >Danh sách thành phố</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table">
                            <thead>
                            <tr>
                                <th style="width: 10px">ID</th>
                                <th style="width: 180px">Tên thành phố</th>
                                <th style="width: 150px">Type</th>
                                <th style="width: 120px">Ship</th>
                                <th style="width: 110px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            while ($row = mysqli_fetch_array($query)){
                                ?>
                                <tr>
                                    <td><?php echo $row["matp"]?></td>
                                    <td><?php echo $row["name_city"]?></td>
                                    <td><?php echo $row["type"]?></td>
                                    <td><?=number_format($row["PhiShip"],0,",",".")?> VNĐ</td>
                                    <td>
                                        <a href="../admin/editShipping.php?Maship=<?php echo $row["matp"]?>" class="btn btn-primary icons"><i class="fas fa-edit"></i></a>
                                        <a onclick="return Delete('<?php echo $row["name_city"];?>')" href="<?php echo $_SERVER["PHP_SELF"];?>?Maship=<?php echo $row["matp"];?>" class="btn btn-danger icons"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                        include ("pagination.php")
                    ?>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--<script>-->
<!--    function Delete(name) {-->
<!--        return confirm("Bạn có chắc muốn xóa sản phẩm: " + name + "?");-->
<!--    }-->
<!--</script>-->
<script src="../admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../admin/dist/js/adminlte.min.js"></script>
</body>
</html>
