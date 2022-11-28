<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="me-auto d-none d-lg-block ">
						<h2 class="text-primary font-w600 mb-0"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Product Category</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
					</div>
                    <!--
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
                    -->
                    <a href="<?php echo base_url('product-category/create');?>" id="add-order" class="btn btn-warning btn-rounded ms-3">Add +</a>
				</div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Basic</h4>
                            </div>
                            <div class="card-body" id="_list">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ชื่อหมวดหมู่</th>
                                                <th>ชื่อหมวดหมู่ - EN</th>
                                                <th>จำนวนสินค้า</th>
                                                <th>สถานะ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($resultList);
                                            if(isset($list)&&!empty($list)){
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo @$row->code;?>
                                                </td>
                                                <td>
                                                    <h4 class="text-muted mb-0 name"><?php echo @$row->name_th;?></h4>
                                                </td>
                                                <td>
                                                    <h4 class="text-muted mb-0 name"><?php echo @$row->name_en;?>
                                                </td>
                                                <td>
                                                    <?php echo @$row->product_count;?>
                                                </td>
                                                <td>
                                                    <?php if($row->status=='1'){?>
                                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> เปิดใช้งาน</div>
                                                    <?php 
                                                    }else{
                                                    ?>
                                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> ไม่เปิดใช้งาน</div>
                                                    <?php 
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?php echo base_url('product-category/edit/').$row->id;?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a data-bs-original-title="ลบ" data-bs-toggle="modal" data-bs-target="#warning-<?php echo $row->id;?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

                                                        <!-- modal danger -->
                                                        <div class="modal fade modal-danger text-start" id="warning-<?php echo $row->id;?>" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel120">Delete #<?php echo $row->username;?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this content?
                                                                    It will not appear in any place anymore.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="close" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" value="<?php echo $row->id?>" onclick="confirmDelete('<?php echo $row->id;?>')">Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- modal danger -->
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

<span id="result"></span>

<script>

function loadPage(page){
    var status = '';
    //status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product-category/loadContentList')?>',
                data: 'status='+status+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('product-category/loadContentList')?>',
                data: 'status='+status+'&page=1',
                success: function(result) { 
                    $('#result').html(result);
                    //$("#_list").html(result);
                } 
    });
});


function changeStatus(id,status){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('admin/changeStatus')?>',
                        data: 'id='+id+'&status='+status,
                        success: function(result) { 
                            //$('#result').html(result);
                            if(result==true)
                            {
                                toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','แก้ไขคลังปัญญา');
                                setTimeout(function() { 
                                        var url = "<?php echo base_url('article/list');?>";    
                                        $(location).attr('href',url);
                                }, 3000);
                            } 
                            else{
                                toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','แก้ไขคลังปัญญา');
                            }    
                        }
                    });
}


function confirmDelete(id){
            var page = <?php echo $active_page;?>;
            var status = '';

            //status = document.getElementById("status").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('product-category/delete')?>',
                        data: 'id='+id+'&status='+status+'&page='+page,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_list").html(result);
                        }
            });
    }

</script>