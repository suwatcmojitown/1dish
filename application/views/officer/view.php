<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
              <div class="row">
                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-user"></i> รายละเอียดผู้ใช้งาน</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="<?php echo base_url('officer/list')?>"><span class="text-light"><strong>ผู้ใช้งาน</strong></span></a>
                                        </span>
                                    </header>
                  
                            </section>
                    </div>
            </div>

            <div class="row">
                    <aside class="profile-nav col-lg-4">
                        <section class="card">
                            <div class="user-heading round">
                                <a href="#">
                                    <img src="<?php echo @$detail->avatar_path;?>" alt="" style="width:112px;">
                                </a>
                                <h1><strong><?php echo @$detail->displayname;?></strong></h1>
                                <div style="margin-top:14px;text-align: left;border-top: 1px solid #f8f7f5;padding-top:7px;">
                                <?php echo @$detail->profile_background;?>
                                </div>
                                <p style="text-align:left;margin-top:14px;font-size:14px;"><i class="fa fa-envelope-o" style="margin-right:7px;"></i> <?php echo @$detail->email;?></p>
                                <p style="text-align:left;font-size:14px;"><i class="fa fa-phone" style="margin-right:7px;"></i> <?php echo @$detail->mobile_no;?></p>
                                <div style="margin-top:14px;text-align: left;border-top: 1px solid #f8f7f5;padding-top:7px;">
                                        <p style="text-align:left;margin-top:14px;font-size:14px;"><span style="margin-right:7px;">เข้าใช้งานล่าสุด</span> 02/10/2020 09:42:13</p>
                                </div>
                            </div>
                        </section>
                        <style>
                        .profile-nav ul > li > a:hover{
                            background: #f8f7f5 !important;
                            border-left: 5px solid #f8f7f5;
                            color: #89817f !important;
                        }
                        ul.summary-list > li {
                            padding-top:14px;
                            border-right: 0px solid #eaeaea;
                            border-bottom: 0px solid #eaeaea;
                        }
                        </style>
                        <div class="row">
                                <div class="col-lg-12">
                                    <section class="card">
                                            <ul class="summary-list">
                                                <li>
                                                    <a href="<?php echo @$detail->facebook;?>">
                                                        <img src="<?php echo base_url()?>assets/assets/images/icon-fb.png" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo @$detail->line_id;?>">
                                                        <img src="<?php echo base_url()?>assets/assets/images/icon-line.png" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo @$detail->youtube;?>">
                                                        <img src="<?php echo base_url()?>assets/assets/images/icon-yt.png" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="<?php echo @$detail->tiktok;?>">
                                                        <img src="<?php echo base_url()?>assets/assets/images/icon-tt.png" alt="">
                                                    </a>
                                                </li>
                                                <li></li>
                                            </ul>
                                    </section>
                                </div>
                            </div>
                    </aside>
                    
                    <aside class="profile-info col-lg-8">
                        <?php //console($detail);?>
                            <section class="card">
                                        <div class="card-body">
                                            <ul class="summary-list">
                                                <li  >
                                                    <a href="javascript:;">
                                                        <i class="fa fa-list-ul popovers text-success" data-content="ชุดข้อสอบ" data-placement="top" data-trigger="hover"></i>
                                                        <?php echo @$detail->exam_count;?>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-clipboard popovers text-warning" data-content="ข้อสอบ" data-placement="top" data-trigger="hover"></i>
                                                        <?php echo @$detail->quiz_count;?> 
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-file-o popovers text-danger" data-content="บทความ" data-placement="top" data-trigger="hover"></i>
                                                        <?php echo @$detail->article_count;?> 
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        <i class="fa fa-heart popovers text-info " data-content="ผู้ติดตาม" data-placement="top" data-trigger="hover"></i>
                                                        <?php echo @$detail->follower_count;?> 
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                        </section>
                        
                        <section class="card">
                            <div class="row">
                                <div class="col-lg-7">
                                        <div class="card">
                                            <header class="card-header text-info">
                                                <i class="fa fa-user"></i> ข้อมูลส่วนตัว
                                            </header>
                                            <div class="card-body">
                                            <p><?php echo @$detail->firstname;?> <?php echo @$detail->lastname;?></p>
                                            
                                            <p><?php echo @$detail->address;?> 
                                                <?php 
                                                if($detail->province_id){
                                                if($detail->province_id=='1') 
                                                echo 'แขวง '.@$detail->subdistrict_name.' '.@$detail->district_name; 
                                                else echo 'ตำบล '.$detail->subdistrict_name.' อำเภอ '.@$detail->district_name;
                                                echo '<br>จังหวัด '.@$detail->province_name.' '.@$detail->zipcode.'';
                                                }
                                                ?> 

                                            </p>                
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-5">
                                        <div class="card">
                                            <header class="card-header text-info">
                                                <i class="fa fa-money"></i> บัญชีธนาคาร
                                            </header>
                                            <div class="card-body">
                                                    <article class="media mb-3">
                                                            <div class="media-body">
                                                                    <p class=" p-head" href="#"><?php echo @$detail->bank_name;?></p> 
                                                                    <?php if($detail->bank_name){?>
                                                                    <p><?php echo @$detail->book_bank_name;?> | <span class="p-head"><?php echo @$detail->book_bank_no;?></span> <br><?php echo @$detail->bank_branch;?> <span>|</span> <?php if(@$detail->book_bank_type=='1')echo 'ออมทรัพย์';else echo 'กระแสรายวัน';?></p>
                                                                    <?php }?>
                                                            </div>
                                                    </article>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </section>
                        <section>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <header class="card-header text-info">
                                            <i class="fa fa-hospital-o"></i> การศึกษา
                                        </header>
                                        <div class="card-body">
                                                <article class="media mb-3">
                                                        <a class="mr-3 text-muted" >
                                                            <strong>ปริญญาตรี</strong>
                                                        </a>
                                                        <?php if($detail->bachelor_university_name){?>
                                                        <div class="media-body">
                                                                <a class=" p-head" href="#"><?php echo @$detail->bachelor_university_name;?></a> | 
                                                                <span><?php echo @$detail->bachelor_faculty;?></span> | 
                                                                <span><?php echo @$detail->bachelor_major;?></span>
                                                        </div>
                                                        <?php }?>
                                                </article>
                                                <article class="media mb-3">
                                                        <a class="mr-3 text-muted">
                                                            <strong>ปริญญาโท</strong>
                                                        </a>
                                                        <?php if($detail->master_university_name){?>
                                                        <div class="media-body">
                                                                <a class=" p-head" href="#"><?php echo @$detail->master_university_name;?></a> | 
                                                                <span><?php echo @$detail->master_faculty;?></span> | 
                                                                <span><?php echo @$detail->master_major;?></span>
                                                        </div>
                                                        <?php }?>
                                                </article>
                                                <article class="media mb-3">
                                                        <a class="mr-3 text-muted">
                                                            <strong>ปริญญาเอก</strong>
                                                        </a>
                                                        <?php if($detail->doctor_university_name){?>
                                                        <div class="media-body">
                                                                <a class=" p-head" href="#"><?php echo @$detail->doctor_university_name;?></a> | 
                                                                <span><?php echo @$detail->doctor_faculty;?></span> | 
                                                                <span><?php echo @$detail->doctor_major;?></span>
                                                        </div>
                                                        <?php }?>
                                                </article>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--
                        <div class="row">
                                <div class="col-lg-12">
                                
                                <section class="card">
                                
                                        <header class="card-header tab-bg-dark-navy-blue p-0">
                                            <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ชุดข้อสอบล่าสุด</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ข้อสอบล่าสุด</a>
                                                </li>
                                            </ul>
        
                                        </header>
                                        <div class="card-body">
                                            <div class="tab-content tasi-tab" id="myTabContent">
                                                <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <article class="media mb-3">
                                                        <a class="mr-3 ">
                                                            <img src="assets/images/setImg.png" style="max-width:100px;">
                                                        </a>
                                                        <div class="media-body">
                                                            แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                            <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                            <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                        </div>
                                                    </article>
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                    <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                </div>
                                                    </article>
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                    <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                </div>
                                                    </article>
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                    <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                </div>
                                                    </article>
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                    <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                </div>
                                                    </article>
                                                </div>
                                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div class="media-body">
                                                                            แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                            <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                            <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                        </div>
                                                                </div>
                                                    </article>
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                    <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                </div>
                                                    </article>
                                                    <article class="media mb-3">
                                                            <a class="mr-3 ">
                                                                    <img src="assets/images/setImg.png" style="max-width:100px;">
                                                                </a>
                                                                <div class="media-body">
                                                                    แบบทดสอบภาษาไทย ป.1 อ่านสระ อา
                                                                    <div><span class="badge badge-info label-mini">ภาษาไทย</span> <i class="fa fa-pencil" style="padding: 0 5px;"></i> System</div>
                                                                    <div class="text-muted">created: 02/10/2020 09:42:13</div>
                                                                </div>
                                                    </article>
                                                </div>
                                                
        
                                        </div>
                                    </section>
                                    </div>
                                    
                                </div>
                                -->

                    </aside>
                </div>

              
                
              <!-- page end-->
          </section>
      </section>