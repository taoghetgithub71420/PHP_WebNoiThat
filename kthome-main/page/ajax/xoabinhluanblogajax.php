<?php
    include ("../connect.php");

    $truyvan = "DELETE FROM binhluanblog WHERE MaBinhLuanBlog = '".$_POST["mabinhluan"]."'";
    if(mysqli_query($conn, $truyvan))
        echo "Xóa bình luận thành công";
    else
        echo "Xóa bình luận thất bại!!"
?>

