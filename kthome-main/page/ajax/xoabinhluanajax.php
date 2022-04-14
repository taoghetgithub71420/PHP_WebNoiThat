<?php
    include ("../connect.php");

    $truyvan = "DELETE FROM binhluan WHERE MaBinhLuan = '".$_POST["mabinhluan"]."'";
    if(mysqli_query($conn, $truyvan))
        echo "Xóa bình luận thành công";
    else
        echo "Xóa bình luận thất bại!!"
?>
