<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:title" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:image" content="https://davur.dexignzone.com/dashboard/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>CMS - BIG 2 Corporation</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>app-assets/images/favicon.png">
    <link href="<?php echo base_url()?>app-assets/css/style.css" rel="stylesheet">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <div class="text-center mb-3">
                                        <a href="index.html"><img src="<?php echo base_url()?>assets/images/big2-logo.png" alt="" style="max-width: 175px;"></a>
                                    </div>
                                    <h4 class="text-center mb-4">Sign in your account</h4>
                                    <form action="<?php echo base_url('user/validlogin');?>" method="POST">
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Username</strong></label>
                                            <input type="text" class="form-control" name="username">
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-danger btn-block">Sign In</button>
                                        </div>
                                    </form>
                                    <?php 
                                    if(isset($_GET['status'])&&($_GET['status']=='error')){
                                    ?>
                                     <div class="new-account mt-3">
                                        <p class="text-danger">รหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง</p>
                                    </div>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="./vendor/global/global.min.js"></script>
    <script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>

</body>

</html>