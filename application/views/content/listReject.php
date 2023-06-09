<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
                <span id="result"></span>
                <div class="row">


                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-danger text-light">
                                        <span ><strong><i class="fa fa-list-ul"></i> ข้อสอบที่ต้องแก้ไขทั้งหมด</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="<?php echo base_url('quiz/rejectList')?>"><span class="text-light"><strong>ข้อสอบที่ต้องแก้ไข</strong></span></a>
                                        </span>
                                    </header>
                  
                            </section>
                    </div>

                    <div class="col-lg-12">
                      <section class="card">
                            <header class="card-header">
                                    <i class="fa  text-info"></i> 
                                    <span class="tools pull-left">
                                                        <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                                <i class="fa fa-filter"></i> ตัวกรอง
                                                        </button>
                                    </span>
                                    
                            </header>

                            <div class="card-body collapse" id="collapseExample">
                                                    <div class="form-row align-items-center">
                                                            <div class="col-auto">
                                                                    <div class="form-group">
                                                                            <label>ระดับ</label>
                                                                            <select class="form-control" id="education" name="education" onchange="educationChange();">
                                                                                <option value="">-- ทุกระดับ --</option>
                                                                                <?php 
                                                                                    if($educationList){
                                                                                        foreach($educationList as $row){
                                                                                ?>
                                                                                    <option value="<?php echo $row->id?>" ><?php echo $row->title;?></option>
                                                                                <?php 
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                    </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="form-group" id="_subEducation">
                                                                    <label>ชั้น</label>
                                                                    <select class="form-control" id="subeducation" name="subeducation">
                                                                        <option value="">-- ทุกชั้น --</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                    <div class="form-group">
                                                                            <label>วิชา</label>
                                                                            <select class="form-control" id="subject" name="subject" onchange="subjectChange();">
                                                                                <option value="">-- ทุกวิชา --</option>
                                                                                <?php 
                                                                                    if($subjectList){
                                                                                        foreach($subjectList as $row){
                                                                                ?>
                                                                                    <option value="<?php echo $row->id?>" ><?php echo $row->title;?></option>
                                                                                <?php 
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                            </select>
                                                                    </div>
                                                            </div>
                                                            
                                                            <div class="col-auto">
                                                                    <div class="form-group">
                                                                            <label>ค้นหา</label>
                                                                            <input type="text" class="form-control" id="keysearch" placeholder="ค้นหา...">
                                                                    </div>
                                                            </div>
                                                            <div class="col-auto" style="padding-top:10px;">
                                                                    <button id="filterBtn" class="btn btn-primary btn-sm" type="button">
                                                                        <i class="fa fa-filter"></i> Filter
                                                                    </button>
                                                            </div>
                                                    </div>
                            </div>

                            <div class="row card-body" id="_list">
                            <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th><i class="fa fa-bullhorn"></i> ข้อสอบ</th>
                                  <th class="hidden-phone"><i class="fa fa-bookmark"></i> ระดับชั้น</th>
                                  <th><i class="fa fa-bullhorn"></i> วิชา</th>
                                  <th><i class=" fa fa-star"></i> ความยาก</th>
                                  <th><i class=" fa fa-star"></i> เหตุผลที่ไม่ผ่าน</th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                                //console($this->session->userdata);
                                if($list){
                                    if($page==1) $i = 1;
                                    else $i = (($page-1)*PAGE_LIMIT)+1;
                                    foreach($list as $row){
                              ?>
                              <tr>
                                  <td><?php echo $i;?></td>
                                  <td><medium class="text-info"><?php echo $row->title;?></medium>
                                        <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-meh-o" style="padding: 0 5px;"></i> <?php echo $row->created_name;?></div>
                                        <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                  </td>
                                  <td class="hidden-phone"> <?php echo @$row->education_sublevel_title;?></td>
                                  <td align="left"><?php echo @$row->subject_name;?></td>
                                  <td align="center"><?php echo @$row->rating;?></td>
                                  <td align="left"><span class="badge badge-danger"><?php echo @$row->reject_title;?></span>
                                        <?php if($row->note!=''){?>
                                        <div class="text-muted"><?php echo $row->note;?></div>
                                        <?php }?>
                                  </td>
                                  <td class="top-nav">
                                        <ul class="nav pull-right top-menu">
                                                <li class="dropdown language">
                                                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                                        <i class=" fa fa-ellipsis-v"></i>  
                                                    </a>
                                                    <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li><a href="<?php echo base_url('quiz/detail/').$row->id;?>"><button class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button><span style="padding-left:7px;">รายละเอียด</span></a></li>
                                                        <?php 
                                                        if(($row->status==2)||($row->status==4))
                                                        {
                                                        ?>
                                                        <li><a href="<?php echo base_url('quiz/edit/').$row->id;?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button><span style="padding-left:7px;">แก้ไขข้อสอบ</span></a></li>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <?php 
                                                        if(($row->status==1)&&($this->session->userdata['group_id']=='1'))
                                                        {
                                                        ?>
                                                        <li><a onclick="changeStatus(<?php echo $row->id;?>,0)"><button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></button><span style="padding-left:7px;">ปิดใช้งาน</span></a></li>
                                                        <?php 
                                                        }
                                                        elseif(($row->status==0)&&($this->session->userdata['group_id']=='1'))
                                                        {
                                                        ?>
                                                        <li><a onclick="changeStatus(<?php echo $row->id;?>,1)"><button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button><span style="padding-left:7px;">เปิดใช้งาน</span></a></li>
                                                        <?php    
                                                        }
                                                        if($row->status==2)
                                                        {
                                                        ?>
                                                        <li><a onclick="changeStatus(<?php echo $row->id;?>,3)"><button class="btn btn-warning btn-sm"><i class="fa fa-ban"></i></button><span style="padding-left:7px;">ส่งตรวจสอบ</span></a></li>
                                                        <li><a onclick="del(<?php echo $row->id;?>)"><button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></button><span style="padding-left:7px;">ลบ</span></a></li>
                                                        <?php 
                                                        }
                                                        ?> 
                                                    </ul>
                                                </li>
                                        </ul>
                                  </td>
                              </tr>
                              <?php 
                                $i++;
                                }
                              }
                              ?>
                              
                              </tbody>
                          </table>
                          <?php 
                            if($paging)
                            {
                                $total_page = $paging->total_page;
                                $active_page = $paging->page;
                                if($total_page > 1)
                                {
                            ?>
                            <div class="card-body">
                                <div>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end">
                                            <?php 
                                            if($active_page-1>0){
                                            ?>
                                            <li class="page-item">
                                                <a onclick="loadPage(<?php echo $active_page-1;?>)" class="page-link" tabindex="-1">Previous</a>
                                            </li>
                                            <?php 
                                            }
                                            ?>
                                            <?php if($active_page-2>0){?><li class="page-item"><a class="page-link" onclick="loadPage(<?php echo $active_page-2;?>)" ><?php echo $active_page-2;?></a></li><?php }?>
                                            <?php if($active_page-1>0){?><li class="page-item"><a class="page-link" onclick="loadPage(<?php echo $active_page-1;?>)" ><?php echo $active_page-1;?></a></li><?php }?>
                                            <li class="page-item active"><a class="page-link" href="#"><?php echo $active_page;?></a></li>
                                            <?php if($active_page+1<=$total_page){?><li class="page-item"><a class="page-link" onclick="loadPage(<?php echo $active_page+1;?>)" ><?php echo $active_page+1;?></a></li><?php }?>
                                            <?php if($active_page+2<=$total_page){?><li class="page-item"><a class="page-link" onclick="loadPage(<?php echo $active_page+2;?>)" ><?php echo $active_page+2;?></a></li><?php }?>
                                            <?php 
                                            if($active_page+1<=$total_page){
                                            ?>
                                            <li class="page-item">
                                                <a onclick="loadPage(<?php echo $active_page+1;?>)" class="page-link" >Next</a>
                                            </li>
                                            <?php 
                                            }
                                            ?>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <?php 
                                }
                            }    
                            ?>
                            </div>
                      </section>
                    </div>
                    
              </div>
              <!-- page end-->
          </section>
      </section>
<!--main content end-->
<span id="result"></span>

<script>

function loadPage(page){
    subject = document.getElementById("subject").value;
    education = document.getElementById("education").value;
    subeducation = document.getElementById("subeducation").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('quiz/loadRejectQuizList')?>',
                data: 'subject_id='+subject+'&education_id='+education+'&subedu_id='+subeducation+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    subject = document.getElementById("subject").value;
    education = document.getElementById("education").value;
    subeducation = document.getElementById("subeducation").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('quiz/loadRejectQuizList')?>',
                data: 'subject_id='+subject+'&education_id='+education+'&subedu_id='+subeducation+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});

function educationChange(){
        
        education = document.getElementById("education").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('education/loadSubEdu/filterL')?>',
            data: 'education_id='+education+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subEducation").html(result);
            }
        });
}

function subjectChange(){
        
        subject = document.getElementById("subject").value;
        education = document.getElementById("education").value;
        subeducation = document.getElementById("subeducation").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('lesson/loadLessonFilter')?>',
            data: 'subject_id='+subject+'&education_id='+education+'&subedu_id='+subeducation,
            success: function(result) { 
                //$('#result').html(result);
                $("#_lesson").html(result);
            }
        });
}

function educationChangeCreate(){
        
        education = document.getElementById("c_education").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('education/loadSubEdu/addLesson')?>',
            data: 'education_id='+education+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subEducationCreate").html(result);
            }
        });
}


</script>

