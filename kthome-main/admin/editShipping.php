<?php
    include ('../admin/layoutAdmin/header.php')
?>


<?php
    if(!isset($_GET["Maship"]))
        echo "<script>location='listShip.php'</script>";
    $queryShip = "SELECT * FROM tinhthanhpho WHERE matp = '".$_GET["Maship"]."'";
    $getShip = mysqli_query($conn,$queryShip);
    if (mysqli_num_rows($getShip) > 0) {
        $dbdata = mysqli_fetch_array($getShip);
    } else {
        echo "<script>location='listShip.php'</script>";
    }


    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $tentp = $_POST["tenthanhpho"];
        $type = $_POST["thuoctinh"];
        $phiship = $_POST["phiship"];

        $sql = "UPDATE tinhthanhpho SET  name_city = '".$tentp."', type = '".$type."', PhiShip = '".$phiship."' WHERE matp = '".$_GET["Maship"]."'";
        $queryupdate = mysqli_query($conn,$sql);
        if($queryupdate > 0) {
            echo "<script>alert('Cập nhật thành công')</script>";
            echo "<script>location='listShip.php'</script>";
        } else {
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
                    <a href="listShip.php"> <span>&#60;</span> Quay về danh sách</a>
                    <h1 class="m-0">Chỉnh sửa phí Ship</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="background-color: #007bff;">
                    <h3 class="card-title" style="color:#fff;" >Chỉnh sửa phí Ship</h3>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thành phố</label>
                                    <input type="text" class="form-control col-md-8" name="tenthanhpho" value="<?php echo empty($_POST["tenthanhpho"])? $dbdata["name_city"] : $_POST["tenthanhpho"]?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Thuộc</label>
                                    <input type="text" class="form-control col-md-8" name="thuoctinh" value="<?php echo empty($_POST["thuoctinh"])? $dbdata["type"] : $_POST["thuoctinh"]?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí Ship</label>
                                    <input type="text" class="form-control col-md-8" name="phiship" value="<?php echo empty($_POST["phiship"])? $dbdata["PhiShip"] : $_POST["phiship"]?>">
<!--                                    <input type="text" class="form-control col-md-8" name="phiship" value="--><?//=number_format($dbdata["PhiShip"],0,",",".")?><!--">-->
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <div class="card-footer" style="float:right;" >
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        <!-- /.card-body -->
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php
    include ('../admin/layoutAdmin/footer.php')
?>



