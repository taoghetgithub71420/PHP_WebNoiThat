<?php
    include ('../connect.php');

    $csbinhluan="UPDATE binhluan SET NoiDung='".$_POST["noidung"]."' WHERE MaBinhLuan='".$_POST["mabinhluan"]."'";

    if(mysqli_query($conn,$csbinhluan))
        echo "Bình luận đã được cập nhật";
    else
        echo "Đã xảy ra lỗi";
?>
