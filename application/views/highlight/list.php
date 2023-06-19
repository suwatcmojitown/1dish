 <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <?php //console($paging);?>
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="me-auto d-none d-lg-block ">
						<h2 class="text-custom font-w600 mb-0"><i class="fa fa-coffee" aria-hidden="true"></i> Top Banner</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="text-custom">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
					</div>
                    
                    <a href="<?php echo base_url('product/create');?>" id="add-order" class="btn btn-success btn-rounded ms-3">Add +</a>
                    
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

function categoryChange(){
        
        category_id = document.getElementById("category_id").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('filter/loadSubCategoryList')?>',
            data: 'category_id='+category_id+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subCategoryList").html(result);
            }
        });
}    

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


$("#filterBtn").click(function(){
    keysearch = document.getElementById("keysearch").value;
    category_id = document.getElementById("category_id").value;
    subcategory_id = document.getElementById("subcategory_id").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/loadContentList')?>',
                data: 'keysearch='+keysearch+'&category_id='+category_id+'&subcategory_id='+subcategory_id+'&status='+status+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});


function changeStatus(id,change_status){
    keysearch = document.getElementById("keysearch").value;
    category_id = document.getElementById("category_id").value;
    subcategory_id = document.getElementById("subcategory_id").value;
    status = document.getElementById("status").value;


                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('product/changeStatus')?>',
                        data: 'id='+id+'&keysearch='+keysearch+'&category_id='+category_id+'&subcategory_id='+subcategory_id+'&status='+status+'&page=<?php echo $active_page;?>&change_status='+change_status,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_list").html(result);
                        } 
                    });
    
}


function confirmDelete(id){
            //alert(id);
            var page = <?php echo $active_page;?>;
            var keysearch = '';
            var status = '';

            keysearch = document.getElementById("keysearch").value;
            category_id = document.getElementById("category_id").value;
            subcategory_id = document.getElementById("subcategory_id").value;
            status = document.getElementById("status").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('product/delete')?>',
                        data: 'id='+id+'&keysearch='+keysearch+'&category_id='+category_id+'&subcategory_id='+subcategory_id+'&status='+status+'&page='+page,
                        success: function(result) { 
                            //alert(result);
                            $('#del'+id+'').modal('hide');
                            //$('#result').html(result);
                            $("#_list").html(result);
                        }
            });
    }

function changeStatusBestSeller(id,change_status,page){

    keysearch = document.getElementById("keysearch").value;
    category_id = document.getElementById("category_id").value;
    subcategory_id = document.getElementById("subcategory_id").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/changeStatusBestSeller')?>',
                data: 'id='+id+'&keysearch='+keysearch+'&category_id='+category_id+'&subcategory_id='+subcategory_id+'&status='+status+'&page='+page+'&change_status='+change_status,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}

function changeStatusRecommend(id,change_status,page){

    
    keysearch = document.getElementById("keysearch").value;
    category_id = document.getElementById("category_id").value;
    subcategory_id = document.getElementById("subcategory_id").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/changeStatusRecommend')?>',
                data: 'id='+id+'&keysearch='+keysearch+'&category_id='+category_id+'&subcategory_id='+subcategory_id+'&status='+status+'&page='+page+'&change_status='+change_status,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
    
}

</script>