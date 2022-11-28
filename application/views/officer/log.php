<!--main content start-->
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
                                        <p style="text-align:left;margin-top:14px;font-size:14px;"><span style="margin-right:7px;">เข้าใช้งานล่าสุด</span> <?php echo @$detail->last_login;?></p>
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
                        <section class="card">
                                <header class="card-header tab-bg-dark-navy-blue p-0">
                                        <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">ชุดข้อสอบ ( <?php echo count($shelfList);?> )</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">ข้อสอบ ( <?php echo count($quizList);?> )</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="follow" aria-selected="false">บทความ ( <?php echo count($contentList);?>)</a>
                                            </li>
                                        </ul>
    
                                    </header>
                                    <div class="card-body">
                                        <div class="tab-content tasi-tab" id="myTabContent">
                                            <div class="tab-pane fade active show adv-table" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <table class="table table-advance table-hover" id="dynamic-table">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><i class="fa fa-bullhorn"></i> ชุดข้อสอบ</th>
                                                                <th><i class="fa fa-eye"></i> ยอดวิว</th>
                                                                <th>สถานะ</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                                if($shelfList){
                                                                $i = 1;
                                                                foreach($shelfList as $row){
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><medium class="text-info"><?php echo $row->title;?></medium>
                                                                    <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-bookmark" style="padding: 0 5px;"></i> <?php echo @$row->subject_name;?> | <?php echo @$row->education_sublevel_title;?></div>
                                                                    <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                                                    </td>
                                                                    <td><?php echo @$row->view_count;?></td>
                                                                    <td>
                                                                        <span class="badge badge-<?php if($row->status=='1')echo 'success';else echo 'danger';?>"><?php if($row->status=='1')echo 'เปิดใช้งาน';else echo 'ไม่เปิดใช้งาน';?></span>
                                                                    </td>
                                                                </tr>
                                                            <?php 
                                                                $i++;
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            <div class="tab-pane fade adv-table" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                    <table class="table table-advance table-hover" id="dynamic-table-2">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><i class="fa fa-bullhorn"></i> ข้อสอบ</th>
                                                                <th><i class="fa fa-eye"></i> จำนวนถูกใช้</th>
                                                                <th>สถานะ</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                                if($quizList){
                                                                $i = 1;
                                                                foreach($quizList as $row){
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><medium class="text-info"><?php echo $row->quiz_title;?></medium>
                                                                    <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-bookmark" style="padding: 0 5px;"></i> <?php echo @$row->subject_name;?> | <?php echo @$row->education_sublevel_title;?></div>
                                                                    <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                                                    </td>
                                                                    <td><?php echo @$row->used_count;?></td>
                                                                    <td>
                                                                        <span class="badge badge-<?php if($row->status=='1')echo 'success';else echo 'danger';?>"><?php if($row->status=='1')echo 'เปิดใช้งาน';else echo 'ไม่เปิดใช้งาน';?></span>
                                                                    </td>
                                                                </tr>
                                                            <?php 
                                                                $i++;
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                            </div>
                                            
                                            <div class="tab-pane fade adv-table" id="content" role="tabpanel" aria-labelledby="content-tab">
                                                    <table class="table table-advance table-hover" id="dynamic-table-3">
                                                            <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th><i class="fa fa-bullhorn"></i> ข้อสอบ</th>
                                                                <th><i class="fa fa-eye"></i> ยอดวิว</th>
                                                                <th>สถานะ</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php 
                                                                if($contentList){
                                                                $i = 1;
                                                                foreach($contentList as $row){
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $i;?></td>
                                                                    <td><medium class="text-info"><?php echo $row->title;?></medium>
                                                                    <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-bookmark" style="padding: 0 5px;"></i> <?php echo @$row->news_cat_title;?> | <?php echo @$row->news_subcat_title;?></div>
                                                                    <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                                                    </td>
                                                                    <td><?php echo @$row->view_count;?></td>
                                                                    <td>
                                                                        <span class="badge badge-<?php if($row->status=='1')echo 'success';else echo 'danger';?>"><?php if($row->status=='1')echo 'เปิดใช้งาน';else echo 'ไม่เปิดใช้งาน';?></span>
                                                                    </td>
                                                                </tr>
                                                            <?php 
                                                                $i++;
                                                                }
                                                            }
                                                            ?>
                                                            </tbody>
                                                        </table>
                                                </div>
                                        </div>
    
                                    </div>      
                        </section>
                    </aside>
                </div>

              
                
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->