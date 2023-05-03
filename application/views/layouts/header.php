<!DOCTYPE html>
<html lang="en">

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
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="<?php echo base_url()?>app-assets/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url()?>app-assets/vendor/select2/css/select2.min.css">
    <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/style.css" rel="stylesheet">
    <!--<link href="<?php echo base_url()?>app-assets/css/style3.css" rel="stylesheet">-->
    <link href="<?php echo base_url()?>app-assets/css/custom.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <!-- Nestable -->
    <link href="<?php echo base_url()?>app-assets/vendor/nestable2/css/jquery.nestable.min.css" rel="stylesheet">


    <!-- Form step -->
    <link href="<?php echo base_url()?>app-assets/vendor/jquery-steps/css/jquery.steps.css" rel="stylesheet">
    <!-- Form step -->
    <link href="<?php echo base_url()?>app-assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">


    <script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="<?php echo base_url()?>app-assets/images/custom/logo.png" alt="">
                
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->
        
        
        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <!--
                            <div class="input-group search-area">
                                <input type="text" class="form-control" placeholder="Search here...">
                                <span class="input-group-text"><a href="javascript:void(0)"><i class="flaticon-381-search-2"></i></a></span>
                            </div>
                            -->
                        </div>

                        <?php 
                        //console($_SESSION['username']);
                        ?>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                                    <div class="header-info">
                                        <span>Hello, <strong><?php echo @$_SESSION['username'];?></strong></span>
                                    </div>
                                    <img src="<?php echo base_url()?>app-assets/images/profile/pic1.jpg" width="20" alt=""/>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="<?php echo base_url('logout')?>" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ms-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <?php 
                    if($_SESSION['group_admin']=='super_admin'){
                    ?>
                    <li><a class="ai-icon" href="<?php echo base_url('dashboard');?>" >
                            <i class="flaticon-381-networking"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <?php 
                    }
                    ?>
                    <li><a class="ai-icon" href="<?php echo base_url('product');?>" >
                            <i class="fas fa-car-alt"></i>
                            <span class="nav-text">Product</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-car-alt"></i>
                            <span class="nav-text">Tour</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('guide');?>">Guide</a></li>
                            <li><a href="<?php echo base_url('company');?>">Company</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="far fa-file"></i>
                            <span class="nav-text">ใบเบิก</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('stock/report/import');?>">ใบเบิกสินค้าเข้า</a></li>
                            <li><a href="<?php echo base_url('stock/report/export');?>">ใบเบิกสินค้าออก</a></li>
                            <li><a href="<?php echo base_url('stock/import');?>">เพิ่มใบเบิกสินค้าเข้า</a></li>
                            <li><a href="<?php echo base_url('stock/export');?>">เพิ่มใบเบิกสินค้าออก</a></li>
                        </ul>
                    </li>
                    <?php 
                    if(($_SESSION['group_admin']!='cashier')||($_SESSION['group_admin']!='account')){
                    ?>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <span class="nav-text">คอมมิชชั่น</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('commission/guide');?>">คอมไกด์</a></li>
                            <li><a href="<?php echo base_url('commission/company');?>">คอมทัวร์</a></li>
                        </ul>
                    </li>
                    <?php }?>
                    <?php 
                    if(($_SESSION['group_admin']!='cashier')||($_SESSION['group_admin']!='account')){
                    ?>
                    <li><a class="ai-icon" href="<?php echo base_url('grouping');?>" >
                            <i class="fa fa-coffee" aria-hidden="true"></i>
                            <span class="nav-text">กรุ๊ปทัวร์</span>
                        </a>
                    </li>
                    <?php }?>
                    <li><a class="ai-icon" href="<?php echo base_url('bill');?>" >
                            <i class="fa fa-coffee" aria-hidden="true"></i>
                            <span class="nav-text">Bills</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                            <span class="nav-text">Setting</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url('admin');?>">User</a></li>
                            <li><a href="<?php echo base_url('product-category');?>">Product Category</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
        
        
