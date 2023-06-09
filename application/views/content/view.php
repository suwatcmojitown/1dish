<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <form id="addForm" >
              <div class="row">
                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-eye"></i> รายละเอียดข้อสอบ</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="<?php echo base_url('quiz/list');?>"><span class="text-light"><strong>ข้อสอบ</strong></span></a>
                                        </span>
                                    </header>
                  
                            </section>
                    </div>
                </div>
                
                <div class="row">
                        <div class="col-lg-8">
                            <section class="card">
                                        <header class="card-header head-border text-info">
                                                คำถาม
                                        </header>
                                        <div class="card-body">
                                                <?php //console($detail);?>
                                                <span class="row">
                                                        <div class="form-group col-10" style="margin-top:1rem;">
                                                                <p style="color:#155724;"><?php echo @$detail->title;?></p>
                                                        </div>
                                                        <?php 
                                                        if(@$detail->image){
                                                        ?>
                                                        <div class="form-group col-2" style="margin-top:1rem;" id="btnAddThumbnail">
                                                            <img class="fancybox" rel="group" href="<?php echo @$detail->image_path;?>" src="<?php echo @$detail->image_path;?>" style="max-width:110px;">
                                                        </div>
                                                        <?php 
                                                        }
                                                        ?>
                                                </span>

                                                

                                                <div class="form-row" <?php if(@$choiceDetail[0]->correct_flag=='1') echo 'style="background-color:#d4edda;" class="alert alert-success"';?>>
                                                    <div class="form-group col-9" style="margin: 0;">
                                                            <label style="padding-left:7px;padding-top:7px;color:#155724;"><strong>คำตอบ ก</strong></label>
                                                            <p style="padding-left:7px;color:#155724;"><?php echo @$choiceDetail[0]->title;?></p>
                                                    </div>

                                                    <div class="form-group col-2" style="padding-top:43px;">
                                                            <?php 
                                                            if(@$choiceDetail['0']->image){
                                                            ?>
                                                            <div class="form-group col-2" style="margin-top:1rem;" id="btnAddThumbnail">
                                                                <img class="fancybox" rel="group" href="<?php echo @$choiceDetail['0']->image_path;?>" src="<?php echo @$choiceDetail['0']->image_path;?>" style="max-width:110px;">
                                                            </div>
                                                            <?php 
                                                            }
                                                            ?>    
                                                    </div>
                                                </div>

                                                <div class="form-row" <?php if(@$choiceDetail[1]->correct_flag=='1') echo 'style="background-color:#d4edda;" class="alert alert-success"';?>>
                                                    <div class="form-group col-9" style="margin: 0;">
                                                            <label style="padding-left:7px;padding-top:7px;color:#155724;"><strong>คำตอบ ข</strong></label>
                                                            <p style="padding-left:7px;"><?php echo @$choiceDetail[1]->title;?></p>
                                                    </div>

                                                    <div class="form-group col-2" style="padding-top:43px;">
                                                            <?php 
                                                            if(@$choiceDetail['1']->image){
                                                            ?>
                                                            <div class="form-group col-2" style="margin-top:1rem;" id="btnAddThumbnail">
                                                                <img class="fancybox" rel="group" href="<?php echo @$choiceDetail['1']->image_path;?>" src="<?php echo @$choiceDetail['1']->image_path;?>" style="max-width:110px;">
                                                            </div>
                                                            <?php 
                                                            }
                                                            ?>    
                                                    </div>
                                                </div>

                                                <div class="form-row" <?php if(@$choiceDetail[2]->correct_flag=='1') echo 'style="background-color:#d4edda;" class="alert alert-success"';?>>
                                                    <div class="form-group col-9" style="margin: 0;">
                                                            <label style="padding-left:7px;padding-top:7px;color:#155724;"><strong>คำตอบ ค</strong></label>
                                                            <p style="padding-left:7px;"><?php echo @$choiceDetail[2]->title;?></p>
                                                    </div>

                                                    <div class="form-group col-2" style="padding-top:43px;">
                                                            <?php 
                                                            if(@$choiceDetail['2']->image){
                                                            ?>
                                                            <div class="form-group col-2" style="margin-top:1rem;" id="btnAddThumbnail">
                                                                <img class="fancybox" rel="group" href="<?php echo @$choiceDetail['2']->image_path;?>" src="<?php echo @$choiceDetail['2']->image_path;?>" style="max-width:110px;">
                                                            </div>
                                                            <?php 
                                                            }
                                                            ?>    
                                                    </div>
                                                </div>

                                                <div class="form-row" <?php if(@$choiceDetail[3]->correct_flag=='1') echo 'style="background-color:#d4edda;" class="alert alert-success"';?>>
                                                    <div class="form-group col-9" style="margin: 0;">
                                                            <label style="padding-left:7px;padding-top:7px;color:#155724;"><strong>คำตอบ ง</strong></label>
                                                            <p style="padding-left:7px;"><?php echo @$choiceDetail[3]->title;?></p>
                                                    </div>

                                                    <div class="form-group col-2" style="padding-top:43px;">
                                                            <?php 
                                                            if(@$choiceDetail['3']->image){
                                                            ?>
                                                            <div class="form-group col-2" style="margin-top:1rem;" id="btnAddThumbnail">
                                                                <img class="fancybox" rel="group" href="<?php echo @$choiceDetail['3']->image_path;?>" src="<?php echo @$choiceDetail['3']->image_path;?>" style="max-width:110px;">
                                                            </div>
                                                            <?php 
                                                            }
                                                            ?>    
                                                    </div>
                                                </div>
                                        </div>
                                        
                            </section>
                            <section class="card">
                                <div class="row">
                                        <?php if(@$detail->note){?>
                                        <div class="col-lg-6">
                                                <div class="card-body">
                                                        <header class="card-header text-info">
                                                                อธิบายข้อสอบเพิ่มเติม
                                                        </header>
                                                        <div class="card-body">
                                                                <p><?php echo @$detail->note;?></p>
                                                        </div>
                                                </div>
                                        </div>
                                        <?php }?>
                                        <?php if(@$detail->video_link){?>
                                        <div class="col-lg-6">
                                        <div class="card-body">
                                                <header class="card-header text-danger">
                                                        <i class="fa fa-youtube-play"></i>
                                                </header>
                                                <div class="card-body">
                                                        <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
                                                        <div class='embed-container'><iframe src='<?php echo @$detail->video_link;?>' frameborder='0' allowfullscreen></iframe></div>
                                                </div>
                                        </div>
                                        </div>
                                        <?php }?>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-4">

                            <aside class="profile-nav alt green-border">
                                <section class="card">
                                <ul class="nav nav-pills nav-stacked">
                                        <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-bar-chart-o"></i> ระดับชั้น <span class="badge badge-primary pull-right r-activity"><?php echo @$detail->education_sublevel_title;?></span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-folder-open"></i> วิชา <span class="badge badge-info pull-right r-activity"><?php echo @$detail->subject_name;?></span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-list-ul"></i> บทเรียน <span class="badge badge-warning pull-right r-activity"><?php echo @$detail->lesson_title;?></span></a></li>
                                        <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-star"></i> ระดับความยากข้อสอบ <span class="pull-right r-activity">
                                        <?php 
                                                if($detail->rating)
                                                {
                                                        for($i=1;$i<=$detail->rating;$i++)
                                                        {
                                                ?>
                                                <i class="fa fa-star" style="color:#155724;font-size:14px;padding-left:14px;"></i>
                                                <?php 
                                                        }
                                                }
                                                ?>
                                        </span></a>
                                        </li>
                                        <li class="nav-item"><a class="nav-link" href="javascript:;"> <i class="fa fa-meh-o"></i> สร้างโดย <span class="badge pull-right r-activity"><?php echo @$detail->created_name;?> | <?php echo @$detail->created_at;?></span></a></li>
                                </ul>

                                </section>
                            </aside>

                            <section class="card">
                                    <header class="card-header text-info">
                                        ตัวชี้วัด
                                    </header>
                                    <div class="card-body">
                                        <div class="checkboxes">
                                        <?php 
                                        if(@$detail->indicator){
                                                foreach(@$detail->indicator as $row){
                                        ?> 
                                                <p><i class="fa fa-angle-right"></i> <?php echo $row->title;?></p>
                                                
                                        <?php 
                                                }
                                        }
                                        ?>
                                        </div>
                                    </div>
    
                             </section>

                             

                        </div>
                    </div>
                    </form>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

      

<span id="result"></span>
