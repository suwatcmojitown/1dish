<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
                <span id="result"></span>
                <div class="row">


                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-file-o"></i> บทความทั้งหมด</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="<?php echo base_url('quiz/list')?>"><span class="text-light"><strong>ข้อสอบ</strong></span></a>
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
                                        <a href="<?php echo base_url('content/create')?>" class=" btn btn-success btn-sm"><i class="fa fa-plus"></i> สร้างบทความ</a>
                                    </span>
                            </header>

                            <div class="card-body collapse" id="collapseExample">
                                                    <div class="form-row align-items-center">
                                                            <div class="col-auto">
                                                                    <div class="form-group">
                                                                            <label>หมวดหมู่</label>
                                                                            <select class="form-control" id="category" name="category" onchange="categoryChange();">
                                                                                <option value="">-- ทุกหัวข้อ --</option>
                                                                                <?php 
                                                                                    if($categoryList){
                                                                                        foreach($categoryList as $row){
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
                                                                <div class="form-group" id="_subCategory">
                                                                    <label>หมวดหมู่ย่อย</label>
                                                                    <select class="form-control" id="subCategory" name="subCategory">
                                                                        <option value="">-- ทุกหัวข้อ --</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                    <div class="form-group">
                                                                            <label>ผู้เขียน</label>
                                                                            <select class="form-control" id="officer" name="officer" >
                                                                                <option value="">-- ทุกคน --</option>
                                                                                <?php 
                                                                                    if($officerList){
                                                                                        foreach($officerList as $row){
                                                                                ?>
                                                                                    <option value="<?php echo $row->id?>" ><?php echo $row->displayname;?></option>
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
                            <?php //console($list);?>
                            <table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th> ภาพ</th>
                                  <th><i class="fa fa-bookmark"></i> บทความ</th>
                                  <th><i class="fa fa-bullhorn"></i> หมวดหมู่</th>
                                  <th><i class="fa fa-book"></i> หมวดหมู่ย่อย</th>
                                  <th><i class="fa fa-eye"></i> ยอดวิว</th>
                                  <th></th>
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
                                  <td><img src="<?php echo $row->thumbnail_path;?>" style="max-width:80px;"></td>
                                  <td><medium class="text-info"><?php echo $row->title;?></medium>
                                        <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-meh-o" style="padding: 0 5px;"></i> <?php echo $row->created_name;?></div>
                                        <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                  </td>
                                  <td class="hidden-phone"> <?php echo @$row->news_cat_title;?></td>
                                  <td class="hidden-phone"> <?php echo @$row->news_subcat_title;?></td>
                                  <td align="center"><?php echo @$row->view_count;?></td>
                                  <td>
                                        <span class="badge badge-<?php 
                                            if($row->status=='0')echo 'danger';
                                            elseif($row->status=='1')echo 'success';
                                            elseif($row->status=='2')echo 'info';
                                            elseif($row->status=='3')echo 'warning';
                                            elseif($row->status=='4')echo 'primary';
                                            elseif($row->status=='5')echo 'danger';
                                            ?>
                                        ">
                                            <?php 
                                            if($row->status=='0')echo 'ไม่เปิดใช้งาน';
                                            elseif($row->status=='1')echo 'เปิดใช้งาน';
                                            elseif($row->status=='2')echo 'ร่าง';
                                            elseif($row->status=='3')echo 'ส่งตรวจ';
                                            elseif($row->status=='4')echo 'รอแก้ไข';
                                            elseif($row->status=='5')echo 'ส่งตรวจอีกครั้ง';?>
                                        </span>
                                  </td>
                                  <td class="top-nav">
                                        <ul class="nav pull-right top-menu">
                                                <li class="dropdown language">
                                                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                                        <i class=" fa fa-ellipsis-v"></i>  
                                                    </a>
                                                    <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li><a href="<?php echo base_url('content/preview/').$row->id;?>"><button class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button><span style="padding-left:7px;">รายละเอียด</span></a></li>
                                                        <?php 
                                                        if(($row->status==2)||($row->status==4))
                                                        {
                                                        ?>
                                                        <li><a href="<?php echo base_url('content/edit/').$row->id;?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button><span style="padding-left:7px;">แก้ไขข้อสอบ</span></a></li>
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
    keysearch = document.getElementById("keysearch").value;
    category = document.getElementById("category").value;
    subCategory = document.getElementById("subCategory").value;
    officer = document.getElementById("officer").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('content/loadContentList')?>',
                data: 'keysearch='+keysearch+'&category_id='+category+'&subcat_id='+subCategory+'&officer_id='+officer+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    keysearch = document.getElementById("keysearch").value;
    category = document.getElementById("category").value;
    subCategory = document.getElementById("subCategory").value;
    officer = document.getElementById("officer").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('content/loadContentList')?>',
                data: 'keysearch='+keysearch+'&category_id='+category+'&subcat_id='+subCategory+'&officer_id='+officer+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});

function categoryChange(){
        
        category = document.getElementById("category").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('category/loadSubCategory')?>',
            data: 'category_id='+category+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subCategory").html(result);
            }
        });
}


$("#createBtn").click(function(){
    subject = document.getElementById("c_subject").value;
    education = document.getElementById("c_education").value;
    subeducation = document.getElementById("c_subeducation").value;
    lesson = document.getElementById("c_lesson").value;
    count_create = document.getElementById("count_create").value;
    
    $.redirect('<?php echo base_url('quiz/create')?>', 
    {'subject_id': subject, 
     'education_id': education,
     'subedu_id': subeducation,
     'lesson_id': lesson,
     'total_create': count_create,
     'active_create': 1,
    });
});

function changeStatus(id,status){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('content/changeStatus')?>',
                        data: 'id='+id+'&status='+status,
                        success: function(result) { 
                            //$('#result').html(result);
                            if(result==true)
                            {
                                toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','แก้ไขบทความ');
                                setTimeout(function() { 
                                        var url = "<?php echo base_url('content/list');?>";    
                                        $(location).attr('href',url);
                                }, 3000);
                            } 
                            else{
                                toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','แก้ไขบทความ');
                            }    
                        }
                    });
}

function del(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('content/delete')?>',
                        data: 'id='+id+'&status='+status,
                        success: function(result) { 
                            //$('#result').html(result);
                            if(result==true)
                            {
                                toastr.success('ลบข้อมูลในระบบสำเร็จ','ลบบทความ');
                                setTimeout(function() { 
                                        var url = "<?php echo base_url('content/list');?>";    
                                        $(location).attr('href',url);
                                }, 3000);
                            } 
                            else{
                                toastr.error('ลบข้อมูลในระบบไม่สำเร็จ','ลบบทความ');
                            }    
                        }
                    });
}

</script>

