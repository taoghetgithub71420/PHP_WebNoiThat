<?php
    include ('connect.php');
    $key=$_POST["id"];
    $query="SELECT * FROM tinhthanhpho WHERE matp = '".$key."'";
    $layship=mysqli_query($conn,$query);
    $rowship = mysqli_fetch_array($layship);
    if($rowship > 0) {?>
        <span class="ship"><?=number_format($rowship["PhiShip"],0,",",".")?> VNĐ</span>
<?php }?>
