<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:title" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:image" content="https://davur.dexignzone.com/dashboard/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>CMS - SRI BHURAPA ORCHID </title>
    <!-- Favicon icon -->
    <link href="<?php echo base_url()?>app-assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    
    
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url()?>app-assets/vendor/select2/css/select2.min.css">
    <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo base_url()?>app-assets/vendor/swiper/css/swiper-bundle.css">
    <link href="<?php echo base_url()?>app-assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/style3.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/LineIcons.css" rel="stylesheet">

 
   

   
</head>


<style>
    label { font-size: 20px; }
@media print {
  label {
    font-size: 10px;
  }
}
</style>
<body>
<div id="print-area" style="font-size:14px;width:450px;margin-left:21px;margin-right:10px;font-weight: bold;font-family: tahoma;">
  <div class="row">
                                <div class="col-md-12" align="center">
                                    <a href="<?php echo base_url('pos');?>"><img src="<?php echo base_url()?>app-assets/images/logo.jpg" alt="logo" width="170" style="margin-right:5rem;"></a>
                                </div>
                            </div>
                            <br>
                            <div class="row print">
                                <div  style="width:70px;">
                                Reprint
                                </div>
                                <div style="width:330px;" align="right">
                                <?php 
                                $tz_object = new DateTimeZone('Asia/Bangkok');
                                $datetime = new DateTime();
                                $datetime->setTimezone($tz_object);
                                echo $datetime->format('Y\-m\-d\ H:i:s');
                                ?>
                                </div>
                            </div>
                            <br>
                            <div class="row print">
                                <div  style="width:200px;">
                                <?php echo @$billDetail->document_no;?>
                                </div>
                                <div style="width:180px;" align="right">
                                <?php echo @$billDetail->cashier_no.'|'.@$billDetail->updated_by_name;?>
                                </div>
                            </div>
                            <hr class="noline" style="margin-top:5px!important;margin-bottom:14px!important;">                          
                            <?php 
                            //console($objResult);
                            if(isset($itemList)&&!empty($itemList)){
                            $totalQuantity = 0;
                            $totalPrice = 0;
                            foreach($itemList as $row){
                            ?>
                            <div class="row print" style="margin-top:3px;">
                                    <div style="width:225px;" align="left">
                                    <?php echo @$row->product_name_en;?>
                                    </div>
                                    <div style="width:55px;" align="right">
                                    <?php echo @$row->price_per_item;?>
                                    </div>
                                    <div style="width:55px;padding-right:3px;" align="right">
                                    <?php echo @$row->quantity;?>
                                    </div>
                                    <div style="width:65px;" align="right">
                                    <?php echo @($row->quantity*$row->price_per_item);?>
                                    </div>
                            </div>
                            <?php
                                $totalPrice = $totalPrice + ($row->quantity*$row->price_per_item);
                                $totalQuantity = $totalQuantity + $row->quantity;
                            }
                            
                            ?>
                            <hr class="noline" style="margin-bottom:14px!important;">
                                <div class="row print" style="margin-top:3px;">
                                    <div style="width:225px;" align="left">
                                    Total Price
                                    </div>
                                    <div style="width:55px;" align="right">
                                    
                                    </div>
                                    <div style="width:55px;padding-right:3px;" align="right">
                                    <?php echo @$totalQuantity;?>
                                    </div>
                                    <div style="width:65px;" align="right">
                                    <?php echo @$totalPrice;?>
                                    </div>
                                </div>
                            <hr class="noline" style="margin-bottom:14px!important;">
                                <div class="row print" style="margin-top:3px;">
                                    <div style="width:225px;" align="left">
                                    </div>
                                    <div style="width:55px;" align="right">
                                    <?php echo '-'.(( round($billDetail->total) - round($billDetail->grand_total)));?>
                                    </div>
                                    <div style="width:55px;padding-right:3px;" align="right">
                                    </div>
                                    <div style="width:65px;" align="right">
                                    </div>
                                </div>
                            <hr class="noline" style="margin-bottom:14px!important;">
                                <div class="row print" style="margin-top:3px;">
                                    <div style="width:225px;" align="left">
                                        Net
                                    </div>
                                    <div style="width:55px;" align="right">
                                    </div>
                                    <div style="width:55px;padding-right:3px;" align="right">
                                    </div>
                                    <div style="width:65px;" align="right">
                                        <?php echo round($billDetail->grand_total);?>
                                    </div>
                                </div>
                            <hr class="noline" style="margin-bottom:14px!important;">
                                <div class="row print" style="margin-top:3px;">
                                    <div style="width:225px;" align="left">
                                        Cur. THB Pay By <?php echo $billDetail->payment_type_name;?>
                                    </div>
                                    <div style="width:55px;" align="right">
                                    </div>
                                    <div style="width:55px;padding-right:3px;" align="right">
                                    </div>
                                    <div style="width:65px;" align="right">
                                        <?php echo round($billDetail->grand_total);?>
                                    </div>
                                </div>
                                <hr  class="noline" style="margin-top:3px!important;margin-bottom:3px!important;">
                                <a onclick="window.location.reload();"><div class="col-md-12" align="center" style="margin-top:14px;padding-right:5rem;">
                                    Thank You
                                </div></a>
                                
                            <?php 
                            }
                            ?>  
</div>

</body>


        
                                

<script>

document.addEventListener("DOMContentLoaded", function(event) { 
  var printContents = document.getElementById('print-area').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
});



    /*
    $(document).ready(function() { 
      setTimeout(function () {

        var printContents = document.getElementById('print-area').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
       
    }, 1000)
    
    });
    */

    
</script>

<?php 
/*
?>
<!DOCTYPE html>
<html lang="en">
<?php 
//console($pendingOrderList);
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:title" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:description" content="Davur - Restaurant Bootstrap Admin Dashboard + FrontEnd" />
    <meta property="og:image" content="https://davur.dexignzone.com/dashboard/social-image.png" />
    <meta name="format-detection" content="telephone=no">
    <title>POS - SRI BHURAPA ORCHID </title>
    <!-- Favicon icon -->
    <link href="<?php echo base_url()?>app-assets/vendor/jquery-smartwizard/dist/css/smart_wizard.min.css" rel="stylesheet">
    
    
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="stylesheet" href="<?php echo base_url()?>app-assets/vendor/select2/css/select2.min.css">
    <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/vendor/owl-carousel/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo base_url()?>app-assets/vendor/swiper/css/swiper-bundle.css">
    <link href="<?php echo base_url()?>app-assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/style3.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/LineIcons.css" rel="stylesheet">

 


 
</head>
<body class="custom">
	 <header class="site-header mo-left header style-1">
            <!-- Main Header -->
            <div class="sticky-header main-bar-wraper navbar-expand-lg">
                <div class="main-bar clearfix ">
                    <div class="container-fluid clearfix" style="padding-left:0px!important;">
                        <div class="logo-header mostion logo-dark">
                            <a href="front-dashboard.html"><img src="<?php echo base_url();?>app-assets/images/custom/logo.png" style="width: 52px;"></a>
                        </div>
                        <!-- Extra Nav -->
                        <?php 
                        //console($_SESSION);
                        ?>
                        <div class="extra-nav">
                            <div class="extra-cell">
                                <a href="<?php echo base_url('logout');?>" class="profile-box">
                                    <div class="header-info">
                                        <span><?php echo @$_SESSION['username'];?></span>
                                        <small>Logout</small>
                                    </div>
                                    <div class="img-bx">
                                        <img src="<?php echo base_url()?>app-assets/images/avatar/1.jpg" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="header-nav navbar-collapse collapse" id="navbarNavDropdown">
                            <div class="logo-header">
                                <img src="images/avatar/1.jpg" alt="">
                            </div>
                            <ul class="nav navbar-nav navbar navbar-left">  
                                <li class="active"><a href="<?php echo base_url('pos')?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z" fill="#000000"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
                                        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
                                    </g>
                                </svg>
                                หน้าหลัก</a></li>
                                <li class=""><a href="<?php echo base_url('pos/customer')?>" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M6,9 L6,15 C6,16.6568542 7.34314575,18 9,18 L15,18 L15,18.8181818 C15,20.2324881 14.2324881,21 12.8181818,21 L5.18181818,21 C3.76751186,21 3,20.2324881 3,18.8181818 L3,11.1818182 C3,9.76751186 3.76751186,9 5.18181818,9 L6,9 Z M17,16 L17,10 C17,8.34314575 15.6568542,7 14,7 L8,7 L8,6.18181818 C8,4.76751186 8.76751186,4 10.1818182,4 L17.8181818,4 C19.2324881,4 20,4.76751186 20,6.18181818 L20,13.8181818 C20,15.2324881 19.2324881,16 17.8181818,16 L17,16 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path d="M9.27272727,9 L13.7272727,9 C14.5522847,9 15,9.44771525 15,10.2727273 L15,14.7272727 C15,15.5522847 14.5522847,16 13.7272727,16 L9.27272727,16 C8.44771525,16 8,15.5522847 8,14.7272727 L8,10.2727273 C8,9.44771525 8.44771525,9 9.27272727,9 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                จอลูกค้า</a></li>
                                <li class=""><a href="<?php echo base_url('pos/opengroup')?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M12,22 C7.02943725,22 3,17.9705627 3,13 C3,8.02943725 7.02943725,4 12,4 C16.9705627,4 21,8.02943725 21,13 C21,17.9705627 16.9705627,22 12,22 Z" fill="#000000" opacity="0.3"/>
                                        <path d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z" fill="#000000"/>
                                    </g>
                                </svg>
                                เปิดบิล</a></li>
                                <li class=""><a href="<?php echo base_url('pos/group')?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"/>
                                        <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                เปิดกลุ่ม</a></li>
                                <li class=""><a href="<?php echo base_url('guide')?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"/>
                                        <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                ลงทะเบียนไกด์</a></li>
                                <li class=""><a href="<?php echo base_url('company')?>">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="svg-main-icon">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path d="M5.5,4 L9.5,4 C10.3284271,4 11,4.67157288 11,5.5 L11,6.5 C11,7.32842712 10.3284271,8 9.5,8 L5.5,8 C4.67157288,8 4,7.32842712 4,6.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M14.5,16 L18.5,16 C19.3284271,16 20,16.6715729 20,17.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,17.5 C13,16.6715729 13.6715729,16 14.5,16 Z" fill="#000000"/>
                                        <path d="M5.5,10 L9.5,10 C10.3284271,10 11,10.6715729 11,11.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,12.5 C20,13.3284271 19.3284271,14 18.5,14 L14.5,14 C13.6715729,14 13,13.3284271 13,12.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z" fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg>
                                ลงทะเบียนทัวร์</a></li>
                                <?php 
                                if(isset($pendingOrderList)&&!empty($pendingOrderList)){
                                ?>
                                <li class="">
                                    <a class="nav-link  ai-icon warning" role="button" data-bs-toggle="dropdown" style="z-index: 6;">
                                    <span class="badge light badge-warning"><?php echo count($pendingOrderList);?></span>
                                    <div class="pulse-css custom"></div>

                                    

                                </a>
                                <div class="dropdown-menu custom dropdown-menu-right">
                                    <div id="DZ_W_Notification1" class="widget-media dz-scroll p-3" style="height:380px;">
                                        <ul class="timeline">
                                                    <?php 
                                                    foreach($pendingOrderList as $row){
                                                    ?>
                                                    
                                                    <li style="z-index:999;" onclick="window.location.replace('<?php echo base_url('pos/continue/').$row->id.'/'.$row->document_no;?>')">
                                                        <div class="timeline-panel">
                                                            <div class="media me-2 media-warning">
                                                                <?php echo $row->group_sign;?>
                                                            </div>
                                                            <div class="media-body">
                                                                <h6 class="mb-1">
                                                                    <?php if(!empty($row->total))echo $row->total;else echo '0';?> 
                                                                BTH</h6>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <?php 
                                                    }
                                                    ?>
                                            
                                        </ul>
                                    </div>
                                    <a class="all-notification" href="#">See all notifications <i class="ti-arrow-right"></i></a>
                                </div>
                                </li>
                                <?php 
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Main Header End -->
        </header>

<div class="content-wrapper" style="padding-top: 0rem!important;">
            <!-- row -->
            <?php 
            //console($detail);
            //console($billDetail);
            ?>
            <div class="listcontent-area custom">
<div class="row">
                    <div class="offset-md-4 col-md-4" >
                        <div class="card card-body printableArea" id="printableArea" style="font-size:14px;width:450px;margin-left:2px;margin-right:10px;font-weight: bold;font-family: tahoma;">
                            
                            
							<div class="row">
                                <div class="col-md-12" align="center">
									<img src="<?php echo base_url()?>app-assets/images/logo.jpg" alt="logo" width="150" style="padding-right:2rem;">
								</div>
							</div>
							<br>
							<div class="row print">
                                <div  style="width:200px;">
								<?php echo @$billDetail->document_no;?>
								</div>
								<div style="width:200px;" align="right">
								<?php echo @$billDetail->cashier_no.'|'.@$billDetail->updated_by_name;?>
								</div>
							</div>
							<hr class="noline" style="margin-top:5px!important;margin-bottom:14px!important;">							
                            <?php 
							//console($objResult);
							if(isset($itemList)&&!empty($itemList)){
							$totalQuantity = 0;
							$totalPrice = 0;
							foreach($itemList as $row){
							?>
							<div class="row print" style="margin-top:3px;">
									<div style="width:225px;" align="left">
									<?php echo @$row->product_name_en;?>
									</div>
									<div style="width:55px;" align="right">
									<?php echo @$row->price_per_item;?>
									</div>
									<div style="width:55px;padding-right:3px;" align="right">
									<?php echo @$row->quantity;?>
									</div>
									<div style="width:65px;" align="right">
									<?php echo @($row->quantity*$row->price_per_item);?>
									</div>
							</div>
							<?php
								$totalPrice = $totalPrice + ($row->quantity*$row->price_per_item);
								$totalQuantity = $totalQuantity + $row->quantity;
							}
							
							?>
							<hr class="noline" style="margin-bottom:14px!important;">
								<div class="row print" style="margin-top:3px;">
									<div style="width:225px;" align="left">
									Total Price
									</div>
									<div style="width:55px;" align="right">
									
									</div>
									<div style="width:55px;padding-right:3px;" align="right">
									<?php echo @$totalQuantity;?>
									</div>
									<div style="width:65px;" align="right">
									<?php echo @$totalPrice;?>
									</div>
								</div>
							<hr class="noline" style="margin-bottom:14px!important;">
								<div class="row print" style="margin-top:3px;">
									<div style="width:225px;" align="left">
									</div>
									<div style="width:55px;" align="right">
									<?php echo '-'.(( round($billDetail->total) - round($billDetail->grand_total)));?>
									</div>
									<div style="width:55px;padding-right:3px;" align="right">
									</div>
									<div style="width:65px;" align="right">
									</div>
								</div>
							<hr class="noline" style="margin-bottom:14px!important;">
								<div class="row print" style="margin-top:3px;">
									<div style="width:225px;" align="left">
										Net
									</div>
									<div style="width:55px;" align="right">
									</div>
									<div style="width:55px;padding-right:3px;" align="right">
									</div>
									<div style="width:65px;" align="right">
										<?php echo round($billDetail->grand_total);?>
									</div>
								</div>
							<hr class="noline" style="margin-bottom:14px!important;">
								<div class="row print" style="margin-top:3px;">
									<div style="width:225px;" align="left">
										Cur. THB Pay By <?php echo $billDetail->payment_type_name;?>
									</div>
									<div style="width:55px;" align="right">
									</div>
									<div style="width:55px;padding-right:3px;" align="right">
									</div>
									<div style="width:65px;" align="right">
										<?php echo round($billDetail->grand_total);?>
									</div>
								</div>
								<hr  class="noline" style="margin-top:3px!important;margin-bottom:3px!important;">
								<div class="col-md-12" align="center" style="margin-top:14px;padding-right:5rem;">
									Thank You
								</div>
								
							<?php 
							}
							?>	
                        </div>
                    </div>
					<div class="text-center" >
                                        <a href="<?php echo base_url('pos')?>"><button  class="btn btn-danger" type="button"> Main </button></a>
                                        <button onclick="reprint();" id="print" class="btn btn-primary" type="button" style="margin-left: 2rem;"> <span><i class="fa fa-print"></i> re-Print </span> </button>
                                    </div>			
                </div>
</div>
</div>
<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
    <script src="<?php echo base_url('app-assets/')?>js/jquery.PrintArea.js" type="text/JavaScript"></script>
    
<style>
	.print{
		display: flex;
	    flex-wrap: wrap;
	    margin-right: -10px;
	    margin-left: -10px;
	}
	.noline{
		border-width: 0;
	}
</style>
    
    <script>
    
	$(document).ready(function() { 
      setTimeout(function () {var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
       
    }, 1000)
	
	});

	function reprint(){
            var mode = 'iframe'; 
			var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
            
            
                var printContents = document.getElementById('printableArea').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

	}
</script>

</body>
</html>
<?php 
*/
?>