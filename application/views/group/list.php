        <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
                <div class="row">
                
                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-gavel"></i> สิทธิ์การใช้งานั้งหมด</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="eexam_table_subject.html"><span class="text-light"><strong>สิทธิ์การใช้งาน</strong></span></a>
                                        </span>
                                    </header>
                  
                            </section>
                    </div>

                    <div class="col-lg-12">
                      <section class="card">
                            <header class="card-header">
                                    <i class="fa  text-info"></i> 
                                    <span class="pull-right">
                                        <a href="#createModal" data-toggle="modal" class=" btn btn-success btn-sm"><i class="fa fa-plus"></i> สร้างสิทธิ์การใช้งาน</a>
                                    </span>
                                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="createModal" class="modal fade">
                                            <div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="fa fa-plus"></i> สร้างสิทธิ์การใช้งาน</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" id="addForm">
                                                            <div class="form-group">
                                                                <label>ชื่อสิทธิ์</label>
                                                                <input type="text" class="form-control" id="title" name="title">
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <div class="checkbox-list">
                                                                            <?php 
                                                                            if($adminMenu)
                                                                            {
                                                                                foreach($adminMenu as $row){
                                                                            ?>
                                                                            <label for="closeButton">
                                                                                <div class="checker" >
                                                                                    <span class="checked">
                                                                                        <input name="permission[]" type="checkbox" value="<?php echo $row->id?>" class="input-small">
                                                                                    </span>
                                                                                </div>
                                                                                <?php echo $row->title?>
                                                                            </label>
                                                                            <?php 
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div  class="text-right">
                                                            <button type="button" id="addBtn" class="btn btn-primary text-right">ยืนยันการสร้าง</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </header>

                            
                                <div class="card-body" style="padding-top:0px!important;">

                                <div class="adv-table">
                                <table  class="display table " id="dynamic-table">
                                    <thead>
                                    <tr>
                                                        <th >#</th>
                                                        <th><i class="fa fa-folder-open"></i> ชื่อ</th>
                                                        <th ><i class="fa fa-external-link"></i> สถานะ</th>
                                                        <th ><i class="fa fa-clipboard"></i> แก้ไขล่าสุด</th>
                                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if($list){
                                        //console($list);
                                        $i = 1;
                                        foreach($list as $row){
                                    ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            
                                            <td><medium class="text-info"><?php echo $row->title;?></medium></td>
                                            <td align="left"><span class="badge badge-<?php if($row->status=='1')echo 'success';else echo 'danger';?>"><?php if($row->status=='1')echo 'เปิดใช้งาน';else echo 'ไม่เปิดใช้งาน';?></span></td>
                                            <td align="left"><?php echo $row->lastupdated_at;?> | <span class="badge badge-info"><?php echo $row->lastupdated_name;?></span></td>
                                            <td class="top-nav">
                                                    <ul class="nav pull-right top-menu">
                                                            <li class="dropdown language">
                                                                <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                                                    <i class=" fa fa-ellipsis-v"></i>  
                                                                </a>
                                                                <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                                    <li><a onclick="getDetail(<?php echo $row->id;?>)" data-toggle="modal"><button class="btn btn-success btn-sm"><i class="fa fa-eye"></i></button><span style="padding-left:7px;">ดูสิทธิ์การเข้าถึง</span></a></li>
                                                                    <li><a onclick="editDetail(<?php echo $row->id;?>)" data-toggle="modal"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button><span style="padding-left:7px;">แก้ไขรายละเอียด</span></a></li>
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
                                </div>
                            </div>
                      </section>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

      <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="viewModal" class="modal fade">
      </div>

      <div id="editModal" aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1"  class="modal fade">
    </div>
    
      <span id="result"></span>

<script>
function getDetail(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('group/detail')?>',
                        data: 'id='+id,
                        success: function(result) { 
                            $("#viewModal").html(result);
                            $("#viewModal").modal();
                        }
                    });
} 

function editDetail(id){
    
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('group/edit')?>',
                        data: 'id='+id,
                        success: function(result) { 
                            $("#editModal").html(result);
                            $("#editModal").modal();
                        }
                    });
}

$("#addBtn").click(function(){

    var data = new FormData();

    //Form data
    var form_data = $('#addForm').serializeArray();
    $.each(form_data, function (key, input) {
        data.append(input.name, input.value);
    });

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('group/add')?>',
        data: data,
        processData: false,
        contentType: false,
        success: function(result) { 
            if(result==true)
            {
                $('#createModal').modal('hide');
                toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','เพิ่มสิทธิ์');
                setTimeout(function() { 
                        var url = "<?php echo base_url('group/list');?>";    
                        $(location).attr('href',url);
                }, 3000);
            } 
            else{
                                        toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','เพิ่มสิทธิ์');
            }
            
        }
    });
});

</script>

