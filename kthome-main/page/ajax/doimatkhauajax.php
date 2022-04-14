<?php
    include ('../connect.php');
    $ktmktontai = "SELECT * FROM thanhvien WHERE TenDangNhap='".$_POST["tendangnhap"]."' and MatKhau = '".$_POST["matkhaucu"]."'";
    $truyvanmktontai = mysqli_query($conn,$ktmktontai);
    if(mysqli_num_rows($truyvanmktontai)>0)
    {
        $thaydoimk = "UPDATE thanhvien SET MatKhau='".$_POST["matkhaumoi"]."' WHERE TenDangNhap='".$_POST["tendangnhap"]."' ";
        if(mysqli_query($conn,$thaydoimk))
            echo "Đổi mật khẩu thành công";
        else
            echo "Xảy ra lỗi";
    }
    else{
        echo "Mật khẩu không chính xác";
    }
?>

