<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
                <span id="result"></span>
                <div class="row">


                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-user-md"></i> ผู้ใช้งานทั้งหมด</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="<?php echo base_url('officer/list')?>"><span class="text-light"><strong>ผู้ใช้งาน</strong></span></a>
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
                                    <span class="pull-right">
                                        <a href="<?php echo base_url('officer/create')?>" class=" btn btn-success btn-sm"><i class="fa fa-plus"></i> สร้างผู้ใช้งาน</a>
                                    </span>
                            </header>

                            <div class="card-body collapse" id="collapseExample">
                                                    <div class="form-row align-items-center">
                                                            <div class="col-auto">
                                                                    <div class="form-group">
                                                                            <label>สิทธิ์</label>
                                                                            <select class="form-control" id="group" name="group">
                                                                                <option value="">-- ทุกสิทธิ์ --</option>
                                                                                <?php 
                                                                                    if($groupList){
                                                                                        foreach($groupList as $row){
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
                                  <th> ภาพ</th>
                                  <th><i class="fa fa-user"></i> ชื่อ</th>
                                  <th class="hidden-phone"><i class="fa fa-external-link"></i> สิทธิ์</th>
                                  <th><i class=" fa fa-list-ul"></i> ชุดข้อสอบ</th>
                                  <th><i class="fa fa-clipboard"></i> ข้อสอบ</th>
                                  <th><i class="fa fa-file-o"></i> บทความ</th>
                                  <th><i class="fa fa-heart"></i> ผู้ติดตาม</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                              //console($list);
                                if($list){
                                    if($page==1) $i = 1;
                                    else $i = (($page-1)*PAGE_LIMIT)+1;
                                    foreach($list as $row){
                              ?>
                              <tr>
                                  <td><?php echo $i;?></td>
                                  <td><img src="<?php echo $row->avatar_path?>" style="max-width:45px;"></td>
                                  <td><medium class="text-info"><?php echo $row->name;?></medium>
                                        <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-meh-o" style="padding: 0 5px;"></i> <?php echo $row->displayname;?></div>
                                        <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                  </td>
                                  <td class="hidden-phone"> <?php echo @$row->group_name;?></td>
                                  <td align="center"><?php echo @$row->exam_count;?></td>
                                  <td align="center"><?php echo @$row->quiz_count;?></td>
                                  <td align="center"><?php echo @$row->article_count;?></td>
                                  <td align="center"><?php echo @$row->follower_count;?></td>
                                  <td>
                                  <!--
                                        <a onclick="changeStatus(<?php echo $row->id;?>,<?php if($row->status=='1')echo '0';else echo '1';?>)">
                                        <span class="badge badge-<?php if($row->status=='1')echo 'success';else echo 'danger';?>"><?php if($row->status=='1')echo 'เปิดใช้งาน';else echo 'ไม่เปิดใช้งาน';?></span>
                                        </a>
                                  -->
                                  </td>
                                  <td class="top-nav">
                                        <ul class="nav pull-right top-menu">
                                                <li class="dropdown language">
                                                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                                        <i class=" fa fa-ellipsis-v"></i>  
                                                    </a>
                                                    <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li><a href="<?php echo base_url('officer/detail/').$row->id;?>"><button class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button><span style="padding-left:7px;">รายละเอียด</span></a></li>
                                                        <li><a href="<?php echo base_url('officer/log/').$row->id;?>"><button class="btn btn-info btn-sm"><i class="fa fa-comment-o"></i></button><span style="padding-left:7px;">การใช้งาน</span></a></li>
                                                        <li><a href="<?php echo base_url('officer/edit/').$row->id;?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button><span style="padding-left:7px;">แก้ไขรายละเอียด</span></a></li>
                                                        <li><a href="#"><button class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button><span style="padding-left:7px;">ลบ</span></a></li>
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
    keysearch = document.getElementById("keysearch").value;
    group = document.getElementById("group").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('officer/loadOfficerList')?>',
                data: 'group_id='+group+'&keysearch='+keysearch+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}

function changeStatus(id,status){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('lesson/changeStatus')?>',
                        data: 'id='+id+'&status='+status,
                        success: function(result) { 
                            //$('#result').html(result);
                            if(result==true)
                            {
                                                        toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','แก้ไขบทเรียน');
                                                        setTimeout(function() { 
                                                            var url = "<?php echo base_url('lesson/list');?>";    
                                                            $(location).attr('href',url);
                                                        }, 3000);
                            } 
                            else{
                                                        toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','แก้ไขบทเรียน');
                            }    
                        }
                    });
}


$("#filterBtn").click(function(){
    keysearch = document.getElementById("keysearch").value;
    group = document.getElementById("group").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('officer/loadOfficerList')?>',
                data: 'group_id='+group+'&keysearch='+keysearch+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});



</script>

