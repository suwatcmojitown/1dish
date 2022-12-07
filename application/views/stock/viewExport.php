<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                
                <div class="row">
					<div class="col-12">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-list"></i> รายการสินค้านำออก</h4>
                            </div>
                            <div class="card-body" id="_itemList">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <?php 
                                        //console($detail);
                                        //console($typeList);
                                        ?>
                                        <thead>
                                            <tr>
                                                <th width="40%"></th>
                                                <th>ราคา</th>
                                                <th>จำนวน</th>
                                                <th>รวม</th>
                                                <!--<th width="5%"></th>-->
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
                                                    <!--
                                                    <td>
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-danger shadow btn-sm sharp" data-bs-toggle="modal" data-bs-target="#modal-<?php echo $row->id;?>"><i class="fas fa-times"></i></a>
                                                        </div>
                                                        
                                                        <div class="modal fade" id="modal-<?php echo $row->id;?>">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยกเลิกนำเข้า Code #<span class="text-danger"><?php echo @$row->barcode;?></span> </h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>คุณต้องการยืนยันที่จะยกเลิกนำสินค้าออกนี้ ?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light" >ยกเลิก</button>
                                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete('<?php echo $row->requisition_out_id;?>','<?php echo $row->id?>')" data-bs-dismiss="modal">ยืนยัน</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </td>-->
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

                                <span class="row"> 
                                <div class="col-12">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">ประเภทใบนำออก</label>
                                            <div class="col-12">
                                            <select class="default-select form-control wide mb-3" name="requisition_type" id="requisition_type" onchange="requisitionTypeChange();">
                                                <?php 
                                                foreach($typeList as $row){
                                                ?>
                                                <option <?php if($row->id==$detail->requisition_type_id) echo 'disabled selected';?> value="<?php echo @$row->id;?>"><?php echo @$row->title;?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                            </div>
                                </div>

                                <?php 
                                if($detail->requisition_type_id=='5dc8af66-b12a-412e-b388-205d1719f496'){
                                ?>
                                <div id="_place" class="row">
                                <div class="col-6">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">ต้นทาง</label>
                                            <div class="col-12">
                                            <select class="default-select form-control wide mb-3" name="origin_place_id" id="origin_place_id">
                                                <?php 
                                                foreach($placeList as $row){
                                                ?>
                                                <option <?php if($row->id==$detail->origin_place_id) echo 'disabled selected';?> value="<?php echo @$row->id;?>"><?php echo @$row->name;?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                            </div>
                                </div>

                                <div class="col-6">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">ปลายทาง</label>
                                            <div class="col-12">
                                            <select class="default-select form-control wide mb-3" name="destination_place_id" id="destination_place_id">
                                                <?php 
                                                foreach($placeList as $row){
                                                ?>
                                                <option <?php if($row->id==$detail->destination_place_id) echo 'disabled selected';?> value="<?php echo @$row->id;?>"><?php echo @$row->name;?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                            </div>
                                </div>
                                </div>
                                <?php 
                                }
                                ?>

                                <div class="col-12 row">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">หมายเหตุ</label>
                                            <div class="col-10">
                                            <textarea class="form-control form-control-lg" rows="4" name="note" id="note" readonly=""><?php echo $detail->note;?></textarea>
                                            </div>
                                            <div class="col-2">
                                                        <div class="d-flex">
                                                            <a href="#" class="btn btn-warning shadow btn-sm sharp" data-bs-toggle="modal" data-bs-target="#modal-<?php echo @$row->id;?>"><i class="fas fa-pencil-alt"></i> แก้ไขหมายเหตุ</a>
                                                        </div>
                                                       
                                                        <div class="modal fade" id="modal-<?php echo @$row->id;?>">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title"><span class="badge badge-lg badge-warning"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> แก้ไขหมายเหตุ <span class="text-warning">#<?php echo @$detail->document_no;?></span> </h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id='editForm'>
                                                                        <textarea class="form-control form-control-lg" rows="4" name="updateNote" id="updateNote"><?php echo @$detail->note;?></textarea>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-warning light" >ยกเลิก</button>
                                                                        <button type="button" class="btn btn-warning" onclick="updateNote()" data-bs-dismiss="modal">ยืนยัน</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            </div>
                                </div>
                                </span>

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
                                    <!--
                                    <div class="btn_box">
                                        <div class="row no-gutter mx-0">
                                            <a onclick="cancelExport()" id="home-counter-tab" class="btn btn-danger btn-block col-6 m-0 rounded-0">ยกเลิก</a>
                                            <a onclick="confirmExport()" id="place-order-tab" class="btn btn-success btn-block col-6 m-0 rounded-0">ยืนยันนำสินค้าออก</a>
                                        </div>
                                    </div>
                                    -->
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <span id="result"></span>
        </div>

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
                                                            <a href="<?php echo base_url('stock/report/export');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <a onclick="location.reload();"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button></a>
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
                                                            <a href="<?php echo base_url('stock/report/export');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


        <script>
            function updateNote(){
                    var data = new FormData();

                    id = '<?php echo $detail->id;?>';
                    data.append('uuid', id);

                    var note = document.getElementById("updateNote").value;
                    data.append('note', note);

                    $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url('stock/export/updateNote')?>',
                                data: data,
                                processData: false,
                                contentType: false,
                                success: function(result) { 
                                    //$('#result').html(result);
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
        </script>


