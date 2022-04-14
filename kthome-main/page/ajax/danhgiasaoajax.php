<?php
    include ('../connect.php');

    if($_POST["tendangnhap"] == ""){
        echo "Bạn hãy đăng nhập để đánh giá";
    }
    else{
        $laydanhgia = "SELECT * FROM danhgia WHERE MaSanPham='".$_POST["masanpham"]."' and TenDangNhap='".$_POST["tendangnhap"]."' ";
        $truyvan = mysqli_query($conn, $laydanhgia);
        if(mysqli_num_rows($truyvan)>0){
            echo "Bạn đã đánh giá sản phẩm này";
        }
        else{
            $themdanhgia = "INSERT INTO danhgia(MaSanPham, TenDangNhap, NoiDung) VALUES ('".$_POST["masanpham"]."', '".$_POST["tendangnhap"]."', '".$_POST["noidung"]."')";
            if(mysqli_query($conn,$themdanhgia))
                echo "Đánh giá sản phẩm thành công";
            else
                echo "Đã xảy ra lỗi";
        }
    }
?>
