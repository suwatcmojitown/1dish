 <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="me-auto d-none d-lg-block ">
						<h2 class="text-primary font-w600 mb-0"><i class="fa fa-coffee" aria-hidden="true"></i> Product</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
					</div>
                    <div class="mb-3" style="margin-right: 3px;">
                            <input id="keysearch" class="form-control form-control-lg" type="text" placeholder="คำค้นหา" >
                    </div>
                    <div class="dropdown custom-dropdown ms-3">
                        <div class="input-group mb-3" style="">
                                            <select id="product_category_id" class="form-select wide" aria-label="Default select example" style="font-size:1.09375rem;background: #fff;border: 0.0625rem solid #f0f1f5;padding: 0.3125rem 1.25rem;color: #6e6e6e;height: 3.5rem;border-radius: 0.5rem;">
                                                  <option value="">-- หมวดหมู่ --</option>
                                                  <?php 
                                                  if(isset($categoryList)&&!empty($categoryList)){
                                                    foreach($categoryList as $row){
                                                  ?>
                                                  <option value="<?php echo $row->id?>"><?php echo @$row->name_th;?></option>
                                                  <?php 
                                                    }
                                                  }
                                                  ?>
                                            </select>
                        </div>
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
                    <a href="<?php echo base_url('product/create');?>" id="add-order" class="btn btn-warning btn-rounded ms-3">Add +</a>
                    
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
                                                <th></th>
                                                <th>จำนวน</th>
                                                <th>หมวดหมู่</th>
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
                                                    <h4 class="text-primary mb-1 name" style="font-weight: 400;"><?php echo @$row->name_th?></h4>
                                                    <h4 class="text-primary mb-1 name" style="font-weight: 300;"><?php echo @$row->name_en?></h4>
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
                                                    <!-- modal danger -->
                                                        <div class="modal fade modal-danger text-start" id="warning-<?php echo $row->id;?>" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"><span class="badge badge-lg badge-warning"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> เปลี่ยนสถานะ <span class="text-warning">#<?php echo $row->name_th;?></span> </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>คุณต้องการยืนยันที่จะเปลี่ยนสถานะสินค้านี้ ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-warning light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" value="<?php echo $row->id?>" onclick="changeStatus('<?php echo $row->id;?>','<?php echo $row->status;?>')">ยืนยัน</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <!-- modal danger -->
                                                    
                                                </td>
                                                <td>
                                                    <?php echo @$row->quantity;?>
                                                </td>
                                                <td>
                                                    <?php echo @$row->product_category_name_th;?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?php echo base_url('product/stock/view/').$row->id;?>" class="btn btn-primary shadow btn-sm sharp me-1">
                                                            <i class="fa fa-cube" aria-hidden="true"></i>
                                                        </a>
                                                        <a href="<?php echo base_url('product/edit/').$row->id;?>" class="btn btn-primary shadow btn-sm sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="#" class="btn btn-danger shadow btn-sm sharp" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                                <!-- Modal Tash -->
                                                <div class="modal fade" id="exampleModalCenter">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยืนยันลบสินค้า <span class="text-danger"><?php echo @$row->name_th;?></span> </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยืนยันที่จะลบสินค้านี้ ?</p>
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
                                    <ul class="pagination pagination-gutter pagination-primary no-bg">
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
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
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
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

<span id="result"></span>

<script>

function loadPage(page){
    keysearch = document.getElementById("keysearch").value;
    product_category_id = document.getElementById("product_category_id").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/loadContentList')?>',
                data: 'keysearch='+keysearch+'&product_category_id='+product_category_id+'&status='+status+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    keysearch = document.getElementById("keysearch").value;
    product_category_id = document.getElementById("product_category_id").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product/loadContentList')?>',
                data: 'keysearch='+keysearch+'&product_category_id='+product_category_id+'&status='+status+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});


function changeStatus(id,change_status){
    keysearch = document.getElementById("keysearch").value;
    product_category_id = document.getElementById("product_category_id").value;
    status = document.getElementById("status").value;


                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('product/changeStatus')?>',
                        data: 'id='+id+'&keysearch='+keysearch+'&product_category_id='+product_category_id+'&status='+status+'&page=<?php echo $active_page;?>&change_status='+change_status,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_list").html(result);
                        } 
                    });
    
}


function confirmDelete(id){
            var page = <?php echo $active_page;?>;
            var keysearch = '';
            var status = '';

            keysearch = document.getElementById("keysearch").value;
            product_category_id = document.getElementById("product_category_id").value;
            status = document.getElementById("status").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('product/delete')?>',
                        data: 'id='+id+'&keysearch='+keysearch+'&product_category_id='+product_category_id+'&status='+status+'&page='+page,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_list").html(result);
                        }
            });
    }

</script>