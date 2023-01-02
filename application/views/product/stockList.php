<!--**********************************
            Content body start
        ***********************************--> 
        <div class="content-body" style="font-family: 'Kanit';">
            <!-- row -->
			<div class="container-fluid">
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="me-auto d-none d-lg-block ">
						<h2 class="text-primary font-w600 mb-0"><i class="fa fa-cube" aria-hidden="true"></i> Stock</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
					</div>
                    
                    <a data-bs-toggle="modal" data-bs-target="#addStock" class="btn btn-primary btn-rounded ms-3"><i class="fa fa-cube" aria-hidden="true"></i> เพิ่ม stock</a>
                    <a href="<?php echo base_url('stock/export');?>" id="add-order" class="btn btn-danger btn-rounded ms-3"><i class="fas fa-minus-circle"></i> นำสินค้าออก</a>
                    <a href="<?php echo base_url('stock/import');?>" id="add-order" class="btn btn-success btn-rounded ms-3"><i class="fas fa-plus-circle"></i> นำสินค้าเข้า</a>
                    <!-- modal danger -->
                                                        <div class="modal fade modal-primary text-start" id="addStock" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"><span class="badge badge-lg badge-primary"> <i class="fas fa-pencil-alt"></i> </span> เพิ่ม stock <span class="text-primary">#<?php echo @$detail->name_th;?></span> </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="createForm">        
                                                                        <label>บาร์โค้ด : </label>
                                                                            <div class="mb-1">
                                                                                <input type="text" class="form-control form-control-lg" name="cBarcode" id="cBarcode">
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" value="" onclick="addCode('<?php echo $detail->id?>')">ยืนยัน</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                    <!-- modal danger -->


                    
				</div>
                <div class="row">
                    <?php 
                    //console($detail);
                    ?>
                    <div class="col-4">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="<?php echo @$detail->image_url;?>" alt="Card image cap">
                            <div style="padding: 1.5rem 1.875rem 1.25rem;">
                                <h4 class="text-primary mb-1 name" style="font-weight: 400;display: block!important;"><?php echo @$detail->name_th;?></h4>
                                <h4 class="text-primary mb-1 name" style="font-weight: 300;"><?php echo @$detail->name_en;?></h4>
                                <a href="<?php echo base_url('product/edit/').@$detail->id;?>"><span class="badge badge-lg badge-success" style="font-weight: 400;font-size:16px;"> <i class="fas fa-pencil-alt"></i> แก้ไข Product </span></a>
                            </div>
                        </div>
                    </div>
					<div class="col-8">
                    <?php 
                    //console($stockList);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive" id="_stockList">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>บาร์โค้ด</th>
                                                <th>จำนวน</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php 
                                            if(isset($stockList)&&!empty($stockList)){
                                                foreach($stockList as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <h4 class="mb-2 name"><?php echo @$row->barcode;?></h4>
                                                    <normal class="text-muted">updated : <?php echo @$row->updated_at;?></normal>
                                                    <normal>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="14 2 18 6 7 17 3 17 3 13 14 2"></polygon><line x1="3" y1="22" x2="21" y2="22"></line></svg> <?php echo @$row->updated_by;?></normal>
                                                    
                                                </td>
                                                <td style="font-size: 18px;">
                                                    <?php echo @$row->quantity;?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#warning-<?php echo $row->id;?>" class="btn btn-primary shadow btn-sm sharp me-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                </td>
                                                <!-- modal danger -->
                                                        <div class="modal fade modal-primary text-start" id="warning-<?php echo $row->id;?>" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"><span class="badge badge-lg badge-primary"> <i class="fas fa-pencil-alt"></i> </span> แก้ไข <span class="text-primary">#<?php echo @$row->product_name_th;?></span> </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form id="createPositionForm">        
                                                                        <label>บาร์โค้ด : </label>
                                                                            <div class="mb-1">
                                                                                <input type="text" class="form-control form-control-lg" name="barbode" id="barcode-<?php echo $row->id;?>"value="<?php echo $row->barcode;?>">
                                                                            </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" value="<?php echo $row->id?>" onclick="changeCode('<?php echo $row->id;?>')">ยืนยัน</button>
                                                                </div>
                                                            </div>
                                                    </div>
                                                <!-- modal danger -->
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!--
                                <nav style="float: right;">
                                    <ul class="pagination pagination-gutter pagination-primary no-bg">
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="javascript:void(0)">
                                                <i class="la la-angle-left"></i></a>
                                        </li>
                                        <li class="page-item "><a class="page-link" href="javascript:void(0)">1</a>
                                        </li>
                                        <li class="page-item active"><a class="page-link" href="javascript:void(0)">2</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                        <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                        <li class="page-item page-indicator">
                                            <a class="page-link" href="javascript:void(0)">
                                                <i class="la la-angle-right"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                                -->
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

<script>
    function changeCode(id){
            var temp_barcode = 'barcode-'+id;
            barcode = document.getElementById(temp_barcode).value;

            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('product/updateStock')?>',
                                    data: 'id='+id+'&barcode='+barcode,
                                    success: function(result) { 
                                        //$('#result').html(result);
                                        $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url('product/loadStockList')?>',
                                                    data: 'product_id=<?php echo $detail->id;?>',
                                                    success: function(result) { 
                                                        $("#_stockList").html(result);   
                                                    }
                                        });
                                    }
            });
    }

    function addCode(id){
            barcode = document.getElementById('cBarcode').value;
            
            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('product/createStock')?>',
                                    data: 'id='+id+'&barcode='+barcode,
                                    success: function(result) { 
                                        //$('#result').html(result);
                                        $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url('product/loadStockList')?>',
                                                    data: 'product_id=<?php echo $detail->id;?>',
                                                    success: function(result) { 
                                                        $("#_stockList").html(result);   
                                                    }
                                        });
                                    }
            });
    }
    
</script>