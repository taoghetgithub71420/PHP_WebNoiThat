<?php
    include ('../admin/layoutAdmin/header.php')
?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">404 Error Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="error-page" style="display: flex;">
                <!--        <h2 class="headline text-warning"> 404</h2>-->
                <div><img src="../images/404role/role.jpg" alt=""></div>
                <div class="error-content" style="margin-left: 10px; margin-top: 120px">
                    <h3><i class="fas fa-exclamation-triangle text-warning"></i> Bạn không có quyền truy cập.</h3>
                    <p>
                        Bạn không có quyền truy cập vào chức năng này. <br>
                        Vui lòng liên hệ <a href="#">khoa24092000@gmail.com</a> để được cấp quyền.
                    </p>
                    <p style="text-align: center">
                        <a href="<?php echo $_SERVER["PHP_SELF"]?>?dxadmin=0">Đăng xuất khỏi hệ thống</a>.
                    </p>
                </div>
                <!-- /.error-content -->
            </div>
            <!-- /.error-page -->
        </section>
        <!-- /.content -->
    </div>

<?php
    include ('../admin/layoutAdmin/footer.php')
?>