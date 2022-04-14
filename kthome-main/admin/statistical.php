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
                            <h1 class="m-0">Doanh thu </h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <?php
                $total = "SELECT SUM(TongTienSauShip) FROM `dondat` WHERE NgayDat <= NOW() - INTERVAL 0 DAY AND NgayDat > NOW() - INTERVAL 7 DAY AND TrangThai = 'Hoàn thành'";
                $query_total = mysqli_query($conn,$total);
                $result_total = mysqli_fetch_row($query_total);
            ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="card col-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Doanh thu cửa hàng</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">Doanh thu 7 ngày qua</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                      <h4 class="text-success">
                                        <?php echo number_format($result_total[0],0,",",".")?> VNĐ
                                      </h4>
                                    </p>
                                </div>
                                <div class="d-flex">
                                    <?php
                                        $sum = "SELECT SUM(TongTienSauShip) FROM dondat WHERE NgayDat = DATE(NOW()) and TrangThai = 'Hoàn thành'";
                                        $query_sum = mysqli_query($conn,$sum);
                                        $get_sum = mysqli_fetch_row($query_sum);
                                    ?>
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">Doanh thu trong ngày</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <h4 class="text-success">
                                        <input type="hidden" id="today" value="<?php echo $get_sum["0"]?>">
                                            <?php echo number_format($get_sum[0],0,",",".")?> VNĐ
                                        </h4>
                                    </p>
                                </div>

                                <div class="card-body">
<!--                                    <div id="bar-chart" style="height: 300px;"></div>-->
                                    <div class="chart">
                                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
                    <div class="card col-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Thông tin giao hàng</h3>
                                </div>
                            </div>
                            <?php
                                $count = "SELECT * FROM dondat WHERE NgayDat <= NOW() - INTERVAL 0 DAY AND NgayDat > NOW() - INTERVAL 7 DAY AND TrangThai = 'Hoàn thành'";
                                $query_count = mysqli_query($conn,$count);
                                $result_count = mysqli_num_rows($query_count);
                            ?>
                            <div class="card-body">
                                <div class="d-flex" >
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">Vận đơn 7 ngày qua</span>
                                    </p>
                                </div>
                                <span class="mr-2">
                                      <i class="fas fa-square" style="color: rgb(13, 180, 115)"></i> Đã giao hàng
                                    </span>
                                <div class="card-body">
                                    <div class="text-center">
                                        <input type="text" class="knob" value="<?php echo $result_count?>" data-width="200" data-height="200" data-fgColor="rgb(13, 180, 115)" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-info">
                            <span class="info-box-icon"><i class="fas fa-file-invoice-dollar"></i></i></span>
                            <?php
                                $count_bill = "SELECT * FROM dondat WHERE NgayDat <= NOW() - INTERVAL 0 DAY AND NgayDat > NOW() - INTERVAL 7 DAY";
                                $query_bill = mysqli_query($conn,$count_bill);
                                $result_bill = mysqli_num_rows($query_bill);
                            ?>
                            <div class="info-box-content">
                                <span class="info-box-text">Thông tin đơn hàng</span>
                                <h3 class="info-box-number"><?php echo $result_bill?> đơn hàng</h3>
                                <span class="progress-description">
                                   7 ngày theo sản phẩm
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon"><i class="fas fa-money-bill-wave-alt"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Thông tin thanh toán</span>
                                <h3 class="info-box-number"> <?php echo number_format($result_total[0],0,",",".")?></h3>

                                <span class="progress-description">
                                  7 ngày theo sản phẩm
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>


                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-success">
                            <span class="info-box-icon">
                                <i class="fas fa-money-bill-wave-alt"></i>
                            </span>
                            <?php
                                $totalMonth = "SELECT SUM(TongTienSauShip) FROM `dondat` WHERE month(CURRENT_DATE) = month(NgayDat)  AND TrangThai = 'Hoàn thành'";
                                $query_totalMonth = mysqli_query($conn,$totalMonth);
                                $result_totalMonth = mysqli_fetch_row($query_totalMonth);
                            ?>
                            <div class="info-box-content">
                                <span class="info-box-text">Thông tin thanh toán</span>
                                <h3 class="info-box-number"> <?php echo number_format($result_totalMonth[0],0,",",".")?></h3>

                                <span class="progress-description">
                                    1 tháng theo sản phẩm
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>


                    <!-- /.col -->
                    <div class="col-md-3 col-sm-6 col-12">
                        <div class="info-box bg-warning" style="background: #007bff; color: white">
                            <span class="info-box-icon"><i class="fas fa-money-bill"></i></span>
<!--                            --><?php
//                                $sort = "SELECT SUM(ct_dondat.Soluong*ct_dondat.GiaSanPham) as total FROM ct_dondat INNER JOIN dondat ON dondat.MaDonDat = ct_dondat.MaDonDat WHERE dondat.TrangThai = 'Hoàn thành' AND NgayDat <= NOW() - INTERVAL 1 DAY AND NgayDat > NOW() - INTERVAL 8 DAY";
//                                $query_sort = mysqli_query($conn, $sort);
//                                $totalrevenues = mysqli_fetch_row($query_sort);
//                            ?>
                            <?php
                                $sort = "SELECT (ct_dondat.GiaSanPham) as pricepro, ct_dondat.MaSanPham , SUM(ct_dondat.Soluong) as total
                                    FROM ct_dondat
                                    INNER JOIN sanpham ON ct_dondat.MaSanPham = sanpham.MaSanPham
                                    INNER JOIN dondat ON dondat.MaDonDat = ct_dondat.MaDonDat
                                    WHERE dondat.TrangThai = 'Hoàn thành' AND NgayDat <= NOW() - INTERVAL 0 DAY AND NgayDat > NOW() - INTERVAL 7 DAY
                                    GROUP BY ct_dondat.MaSanPham";
                                    $query_sort = mysqli_query($conn, $sort);

                                    $total_income = 0;
                                    while ($row = mysqli_fetch_array($query_sort)){
                                        $query_kho = mysqli_query($conn,"SELECT GiaVon FROM sanpham WHERE MaSanPham = '".$row["MaSanPham"]."'");
                                        $kho = mysqli_fetch_row($query_kho);
                                        $total_income += ($row["pricepro"]*$row["total"]) - ($kho[0]*$row["total"]);
                                ?>
                            <?php } ?>

                            <div class="info-box-content">
                                <span class="info-box-text">Lợi nhuận 7 ngày qua</span>
                                <h3 class="info-box-number"><?php echo number_format($total_income,0,",",".")?></h3>

                                <span class="progress-description">
                                  <a href="revenues.php" style="color: black">>> Lợi nhuận theo sản phẩm</a>
                                </span>
                            </div>

                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>

            <?php
            $i = 1;
            for ($i;$i<7;$i++) {
                $sum = "SELECT SUM(TongTienSauShip) FROM dondat WHERE NgayDat = DATE(NOW())-'$i' and TrangThai = 'Hoàn thành'";
                $query_sum = mysqli_query($conn,$sum);
                $get_sum = mysqli_fetch_row($query_sum);
            ?>
                <input type="hidden" id="day<?php echo $i?>" value="<?php echo $get_sum[0]?>">
            <?php }?>


            <?php
                include ('../admin/layoutAdmin/footer.php')
            ?>
