 <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <?php //console($paging);?>
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="me-auto d-none d-lg-block ">
						<h2 class="text-custom font-w600 mb-0"><i class="fas fa-paper-plane"></i> Shelf</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="text-custom">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
					</div>
                    
                    <a class="btn btn-success btn-rounded ms-3"><span data-bs-toggle="modal" data-bs-target="#createPosition" style="float:right;cursor: pointer;">+ create</span></a>
                    
                    <div class="modal modal-primary fade text-start" id="createPosition" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">+ Create Shelf</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="createShelfForm">                                
                                                                    <label>ชื่อ</label>
                                                                    <div class="mb-1">
                                                                        <input type="text" class="form-control" name="title_th">
                                                                    </div>

                                                                    <label>ชื่อ <code>EN</code></label>
                                                                    <div class="mb-1">
                                                                        <input type="text" class="form-control" name="title_en">
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="submitShelfBtn" class="btn btn-custom" data-bs-dismiss="modal">Create</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

				</div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-body" id="_list">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th></th>
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
                                                    <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th?></h4>
                                                    <h4 class="text-custom mb-1 name" style="font-weight: 300;"><?php echo @$row->title_en?></h4>
                                                    <normal style="display:block;"> 
                                                    <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#warning-<?php echo $row->id;?>">
                                                    <?php 
                                                    if($row->status==1){
                                                    ?>
                                                    <span class="text-success pl-7 pr-7">เปิดใช้งาน</span>
                                                    <?php }else{?>
                                                    <span class="text-danger pl-7 pr-7">ไม่เปิดใช้งาน</span>
                                                    <?php }?>
                                                    </a>
                                                    <span class="text-muted">updated : <?php echo @$row->created_at;?></span>
                                                    </normal>
                                                    
                                                    
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a target="_blank" href="<?php echo base_url('shelf/content/').$row->id;?>" class="btn btn-custom shadow btn-sm sharp me-1"><i class="fas fa-pencil-alt"></i></a>

                                                        <a target="_blank" href="<?php echo base_url('shelf/reorder/').$row->id;?>" class="btn btn-warning shadow btn-sm sharp me-1"><i class="fa fa-retweet"></i></a>

                                                        <a href="#" class="btn btn-danger shadow btn-sm sharp me-1" data-bs-toggle="modal" data-bs-target="#del<?php echo $row->id;?>"><i class="fa fa-trash"></i></a>

                                                        <!-- Modal Tash -->
                                                        <div class="modal fade" id="del<?php echo $row->id;?>">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยืนยันลบ Shelf <span class="text-danger"><?php echo @$row->title_th;?></span> </h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>คุณต้องการยืนยันที่จะลบ Shelf นี้ ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('<?php echo $row->id;?>')">ยืนยัน</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Tash -->
                                                        
                                                    </div>
                                                </td>
                                                
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
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-danger">กลับสู่หน้าหลัก</button></a>
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
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-danger">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>


<script>
                                    formContainer  = $('#createShelfForm');
                                    $("#submitShelfBtn").click(function(){
                                            
                                            var data = new FormData();

                                            //Form data
                                            var form_data = $('#createShelfForm').serializeArray();
                                            $.each(form_data, function (key, input) {
                                                data.append(input.name, input.value);
                                            });

                                            $.ajax({
                                                                    type: 'POST',
                                                                    url: '<?php echo base_url('shelf/add')?>',
                                                                    data: data,
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success: function(result) { 
                                                                        //$('#result').html(result);
                                                                        $.ajax({
                                                                                    type: 'POST',
                                                                                    url: '<?php echo base_url('shelf/loadShelfList')?>',
                                                                                    success: function(result) { 
                                                                                        //$('#result').html(result);
                                                                                        $("#_list").html(result);   
                                                                                    }
                                                                        });
                                                                    }
                                            });
                                    });
</script>

<script>
 

function loadPage(page){
    //alert(page);
    keysearch = document.getElementById("keysearch").value;
    category_id = document.getElementById("category_id").value;
    subcategory_id = document.getElementById("subcategory_id").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/loadContentList')?>',
                data: 'keysearch='+keysearch+'&category_id='+category_id+'&subcategory_id='+subcategory_id+'&status='+status+'&page='+page,
                success: function(result) { 
                   // $('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


function confirmDelete(id){
            //alert(id);
           
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('shelf/deleteShelf')?>',
                        data: 'id='+id,
                        success: function(result) { 
                            //alert(result);
                            $('#del'+id+'').modal('hide');
                            //$('#result').html(result);
                            $("#_list").html(result);
                        }
            });
    }


</script>