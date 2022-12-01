<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row">
					<div class="col-4">
                        <div class="card">
                            <div class="card-header bg-success">
                                <h4 class="card-title text-white" > <i class="fas fa-plus-circle"></i> นำสินค้าเข้า</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <span id="result"></span>
                                        <input type="hidden" class="form-control form-control-lg" name="requisition_in_id" value="<?php echo $uuid;?>">
                                        <div class="mb-3 col-12">
                                            <label class="text-info form-label col-form-label-lg">สินค้า</label>
                                            <select id="single-select" class="default-select form-control wide mb-3"name="product_id" onchange="productChange()">
                                                <option value="null" disabled selected style="">เลือกสินค้า</option>
                                                <?php 
                                                if(isset($productList)&&!empty($productList))
                                                {
                                                    foreach($productList as $row)
                                                    {
                                                ?>
                                                    <option value="<?php echo $row->id;?>" style=""><?php echo $row->name_th;?></option>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-12" id="_productStockList">
                                            <label class="text-info form-label col-form-label-lg">รหัสสินค้า</label>
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">ราคา</label>
                                                <input type="text" class="form-control form-control-lg" name="price_per_item">
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">จำนวน</label>
                                                <input type="text" class="form-control form-control-lg" name="quantity">
                                        </div>
                                        
                                        <div class="mb-3 mt-3" style="text-align: center;">
                                            <button id="submit_btn" type="button" class="btn btn-success light" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md">+ เพิ่มในรายการนำเข้า</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
					</div>

<script>
    var submitButton = $('#submit_btn');
    formContainer  = $('#addForm');
    $("#submit_btn").click(function(){

                var temp = document.getElementById("product_stock_id");
                var barcode = temp.options[temp.selectedIndex].text;
        
                var data = new FormData();

                //var product_id = document.getElementById("product_id").value;
                //data.append('product_id', product_id);

                //Form data
                var form_data = $('#addForm').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });
                
                data.append('barcode', barcode);
                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('stock/import/addProduct')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
                                            //$('#result').html(result);
                                            $("#_itemList").html(result);
                                        }
                                    });
                
    });

</script>

                    <div class="col-8">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-list"></i> รายการสินค้านำเข้า</h4>
                            </div>
                            <div class="card-body" id="_itemList">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <?php 
                                        //console($itemList);
                                        ?>
                                        <thead>
                                            <tr>
                                                <th width="40%"></th>
                                                <th>ราคา</th>
                                                <th>จำนวน</th>
                                                <th>รวม</th>
                                                <th width="5%"></th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php 
                                                if(isset($itemList)&&!empty($itemList))
                                                {
                                                    $total_quantity = 0;
                                                    $sum_price = 0;
                                                    foreach($itemList as $row)
                                                    {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <h4 class="text-muted mb-1 name"><?php echo @$row->barcode;?></h4>
                                                        <span class="code-info"><?php echo @$row->product_name_th;?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->price_per_item);?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->quantity);?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->total_price);?>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-danger shadow btn-sm sharp" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id;?>"><i class="fas fa-times"></i></a>
                                                        </div>
                                                        <!-- Modal Tash -->
                                                        <div class="modal fade" id="modal-<?php echo $row->id;?>">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยกเลิกนำเข้า Code #<span class="text-danger"><?php echo @$row->barcode;?></span> </h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>คุณต้องการยืนยันที่จะยกเลิกนำเข้าสินค้านี้ ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" >ยกเลิก</button>
                                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('<?php echo $row->requisition_in_id;?>','<?php echo $row->id?>')" data-bs-dismiss="modal">ยืนยัน</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal Tash -->
                                                    </td>
                                                </tr>
                                            <?php 
                                                    $total_quantity = $total_quantity+$row->quantity;
                                                    $sum_price = $sum_price+$row->total_price;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-12">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">หมายเหตุ</label>
                                            <div class="col-12">
                                            <textarea class="form-control form-control-lg" rows="4" name="note"></textarea>
                                            </div>
                                </div>

                                <div class="card-order-footer" style="margin-top: 4rem;bottom: 2rem;">
                                    <div class="amount-details pl-7 pr-7">
                                        <h5 class="d-flex text-right mb-3">
                                            <span class="text">จำนวนรวม </span>
                                            <span class="me-0 ms-auto"><?php echo @$total_quantity;?></span>
                                        </h5>
                                        <h5 class="d-flex text-right mb-3">
                                            <span class="text">ราคารวม</span>
                                            <span class="me-0 ms-auto"><?php echo number_format(@$sum_price);?></span>
                                        </h5>
                                    </div>

                                    <div class="btn_box">
                                        <div class="row no-gutter mx-0">
                                            <a onclick="cancelImport()" id="home-counter-tab" class="btn btn-danger btn-block col-6 m-0 rounded-0">ยกเลิก</a>
                                            <a onclick="confirmImport()" id="place-order-tab" class="btn btn-success btn-block col-6 m-0 rounded-0">ยืนยันนำเข้าสินค้า</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
        </div>

        <!--  modal status -->
                                            <div class="modal fade text-start" id="result_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Successfully Published
                                                            The content will be generated and publish onto the website.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('import/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
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
                                                            Fail
                                                            Please try again
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('import/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

<script>

    function confirmImport(){
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('stock/import/confirm')?>',
                        data: 'uuid=<?php echo $uuid;?>',
                        success: function(result) { 
                            if(result==true)
                                            {
                                                $('#result_modal').modal('show');
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }
                        }
            });
    }

    function cancelImport(){
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('stock/import/cancel')?>',
                        data: 'uuid=<?php echo $uuid;?>',
                        success: function(result) { 
                            if(result==true)
                                            {
                                                $('#result_modal').modal('show');
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }
                        }
            });
    }

    function confirmDelete(uuid,item_id){
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('stock/import/deleteItem')?>',
                        data: 'uuid='+uuid+'&item_id='+item_id,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_itemList").html(result);
                        }
            });
    }

    function productChange(){
        
        product = document.getElementById("single-select").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('stock/loadProductStockList')?>',
            data: 'product_id='+product+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_productStockList").html(result);
            }
        });
    }

</script>