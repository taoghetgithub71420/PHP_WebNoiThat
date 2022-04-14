<?php
include ('../connect.php');
if(isset($_POST["min_price"]) && isset($_POST["max_price"])){
    $min_price = $_POST["min_price"];
    $max_price = $_POST["max_price"];
    $query="SELECT * FROM sanpham WHERE MaTrangThaiSanPham = '1' AND DonGia BETWEEN '$min_price' AND '$max_price' ";
    $rows=mysqli_query($conn,$query);
    $count= mysqli_num_rows($rows);
    if($count == 0){
        echo "Không tìm thấy sản phẩm";
    }
    ?>

    <div class="row" >
        <?php
        while ($cot=mysqli_fetch_array($rows)){
            ?>
            <div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                <!-- Start Product Default Single Item -->
                <div class="product-default-single-item product-color--golden" data-aos="fade-up"  data-aos-delay="0">
                    <div class="image-box">
                        <a href="product-details-default.php?Masp=<?php echo $cot["MaSanPham"];?>" class="image-link">
                            <img src="../images/imageproduct/<?php echo $cot["Anh"]?>" alt="">
                            <img src="../images/imageproduct/<?php echo $cot["Anh2"]?>" alt="">
                        </a>
                    </div>
                    <div class="content">
                        <div class="content-left">
                            <h6 class="title"><a href="product-details-default.php?Masp=<?php echo $cot["MaSanPham"];?>"><?php echo $cot["TenSanPham"] ?></a></h6>
                        </div>

                        <div class="content-right">
                            <span class="price"><?=number_format($cot["DonGia"],0,",",".")?> VND</span>
                        </div>

                    </div>
                </div>
                <!-- End Product Default Single Item -->
            </div>
        <?php } ?>

    </div>
    <?php
}
?>