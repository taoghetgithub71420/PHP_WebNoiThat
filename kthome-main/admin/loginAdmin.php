<?php
    include ('../page/connect.php')
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>KT Home</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<!--	<link rel="icon" type="image/png" href="../admin/assest/images/icons/favicon.ico"/>-->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../admin/assest/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../admin/assest/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../admin/assest/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../admin/assest/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../admin/assest/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../admin/assest/css/util.css">
	<link rel="stylesheet" type="text/css" href="../admin/assest/css/main.css">


    <?php
        session_start();
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $callData = "SELECT * FROM nhanvien WHERE TenDangNhap = '".$email."' and MatKhau ='".$pass."'";
            $query = mysqli_query($conn, $callData);
            $row = mysqli_fetch_array($query);

            if($row["MaTrangThaiNhanVien"] == 1){
                if(mysqli_num_rows($query) > 0) {
                    echo "<script>alert('Đăng nhập thành công')</script>";
                    $_SESSION["email"] = $email;
                    echo "<script>location='../admin/index4.php'</script>";
                } else {
                    echo "<script>alert('Đăng nhập thất bại')</script>";
                }
            }else{
                // echo "<script>alert('Tài khoản đã bị khóa')</script>";
				echo "<script>alert('Tài khoản đã bị vô hiệu hoá')</script>";
            }

        }
    ?>
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../images/imageadmin/KTHOME.jpg" alt="IMG">
                    <img src="../images/imageadmin/default-6.jpg" alt="IMG">
				</div>
				<form action="<?php $_SERVER['PHP_SELF']?>" class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						Login Admin
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Error format email">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="../admin/assest/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../admin/assest/vendor/bootstrap/js/popper.js"></script>
	<script src="../admin/assest/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../admin/assest/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../admin/assest/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../admin/assest/js/main.js"></script>

</body>
</html>