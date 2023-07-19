 <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <?php //console($paging);?>
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="me-auto d-none d-lg-block ">
                        <h2 class="text-custom font-w600 mb-0"><i class="fa fa-id-badge"></i> Content</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="text-custom">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
                    </div>
                    <div class="mb-3" style="margin-right: 3px;">
                            <input id="keysearch" class="form-control form-control-lg" type="text" placeholder="คำค้นหา" >
                    </div>
                    
                    <div class="dropdown custom-dropdown ms-3">
                        <div class="input-group mb-3" style="">
                                            <select id="status" class="form-select wide" aria-label="Default select example" style="font-size:1.09375rem;background: #fff;border: 0.0625rem solid #f0f1f5;padding: 0.3125rem 1.25rem;color: #6e6e6e;height: 3.5rem;border-radius: 0.5rem;">
                                                  <option value="">-- สถานะ --</option>
                                                  <option value="1">เปิดใช้งาน</option>
                                                  <option value="0">ไม่เปิดใช้งาน</option>
                                            </select>
                        </div>
                    </div>
                    <a  id="filterBtn" class="btn btn-primary ms-3" style="margin-right: 4px;">ค้นหา  <i class="fa fa-filter"></i></a>
                    <a href="<?php echo base_url('content/create');?>" id="add-order" class="btn btn-success btn-rounded ms-3">Add +</a>
                    
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body" id="_list">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th width="10%"></th>
                                                <th width="60%"></th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($list);
                                            if(isset($list)&&!empty($list)){
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <img style="max-height: 70px;" src="<?php echo @$row->image_url?>">
                                                </td>
                                                <!--
                                                <td>
                                                    <h4 class="text-muted mb-0 name"><strong>เม็ดมะม่วง</strong></h4>
                                                    <h5 class="text-muted email">sriadmin@gmail.com</h5>
                                                </td>
                                                -->
                                                <td>
                                                    <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th?></h4>
                                                    <!--
                                                    <h4 class="text-custom mb-1 name" style="font-weight: 300;"><?php echo @$row->title_en?></h4>
                                                    -->
                                                    
                                                    <normal style="font-weight: 300;color:#3d4465;"><i class="fas fa-pencil-alt"></i> <?php echo @$row->updated_by;?> <i class="lni lni-timer"></i> <?php echo @$row->created_at;?></normal>
                                                    
                                                    
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($row->status==1){
                                                    ?>
                                                    <span class="badge bg-success ">เปิดใช้งาน</span>
                                                    <?php }else{?>
                                                    <span class="badge bg-danger ">ไม่เปิดใช้งาน</span>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <?php 
                                                        if($_SESSION['group_admin']!='cashier'){
                                                        ?>
                                                        <a href="<?php echo base_url('content/edit/').$row->id;?>" class="btn btn-custom shadow btn-sm sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <?php }?>
                                                        <a href="#" class="btn btn-danger shadow btn-sm sharp me-1" data-bs-toggle="modal" data-bs-target="#del<?php echo $row->id;?>"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                                <!-- Modal Tash -->
                                                <div class="modal fade" id="del<?php echo $row->id;?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยืนยันลบสินค้า <span class="text-danger"><?php echo @$row->name_th;?></span> </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยืนยันที่จะลบบทความนี้ ?</p>
                                                                <p>ในกรณีที่คุณต้องการซ่อนจากเว็บไซต์ คุณสามารถเลือกแก้ไข และเปลี่ยน <code>สถานะ</code> เป็น <code>ไม่เปิดใช้งาน</code> ได้</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('<?php echo $row->id;?>')">ยืนยัน</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Tash -->
                                            </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php 
                                if($paging)
                                {
                                    $total_page = $paging->total_page;
                                    $active_page = $paging->page;
                                    if($total_page > 1)
                                    {
                                ?>
                                <nav style="float: right;">
                                    <ul class="pagination pagination-gutter pagination-danger no-bg">
                                        <?php 
                                        if($active_page-1>0){
                                            ?>
                                            <li class="page-item page-indicator">
                                            <a class="page-link" onclick="loadPage(<?php echo $active_page-1;?>)">
                                                <i class="la la-angle-left"></i></a>
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
                                            <li class="page-item page-indicator">
                                            <a class="page-link" onclick="loadPage(<?php echo $active_page+1;?>)">
                                                <i class="la la-angle-right"></i></a>
                                        </li>
                                            <?php 
                                            }
                                            ?>
                                    </ul>
                                </nav>
                                <?php 
                                    }
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <span id="result"></span>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--  modal status -->
                                            <div class="modal fade text-start" id="result_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            บันทึกสำเร็จ
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('content/list');?>"><button type="button" class="btn btn-danger">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade text-start" id="result_modal_fail" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            บันทึกไม่สำเร็จ เกิดข้อผิดพลาด กรุณาลองใหม่
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('content/list');?>"><button type="button" class="btn btn-danger">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



<script>


function loadPage(page){
    //alert(page);
    keysearch = document.getElementById("keysearch").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('content/loadContentList')?>',
                data: 'keysearch='+keysearch+'&status='+status+'&page='+page,
                success: function(result) { 
                   // $('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    keysearch = document.getElementById("keysearch").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('content/loadContentList')?>',
                data: 'keysearch='+keysearch+'&status='+status+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});



function confirmDelete(id){
            //alert(id);
            var page = <?php echo $active_page;?>;
            var keysearch = '';
            var status = '';

            keysearch = document.getElementById("keysearch").value;
            status = document.getElementById("status").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('content/delete')?>',
                        data: 'id='+id+'&keysearch='+keysearch+'&status='+status+'&page='+page,
                        success: function(result) { 
                            //alert(result);
                            $('#del'+id+'').modal('hide');
                            //$('#result').html(result);
                            $("#_list").html(result);
                        }
            });
    }


</script>