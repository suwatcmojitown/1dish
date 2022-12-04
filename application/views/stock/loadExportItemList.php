<div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
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
                                                                        <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยกเลิกนำสินค้าออก Code #<span class="text-danger"><?php echo @$row->barcode;?></span> </h4>
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

                                

                                <span class="row"> 
                                <div class="col-12">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">ประเภทใบนำออก</label>
                                            <div class="col-12">
                                            <select class="default-select form-control wide mb-3" name="requisition_type" id="requisition_type" onchange="requisitionTypeChange();">
                                                <option value="null" disabled selected >-- ระบุประเภทใบนำออก --</option>
                                                <?php 
                                                foreach($typeList as $row){
                                                ?>
                                                <option value="<?php echo @$row->id;?>"><?php echo @$row->title;?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                            </div>
                                </div>

                                <div id="_place" class="row" style="visibility: hidden;">
                                <div class="col-6">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">ต้นทาง</label>
                                            <div class="col-12">
                                            <select class="default-select form-control wide mb-3" name="origin_place_id" id="origin_place_id">
                                                <option value="null" disabled selected >-- ระบุต้นทาง --</option>
                                                <?php 
                                                foreach($placeList as $row){
                                                ?>
                                                <option value="<?php echo @$row->id;?>"><?php echo @$row->name;?></option>
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
                                                <option value="null" disabled selected >-- ระบุปลายทาง --</option>
                                                <?php 
                                                foreach($placeList as $row){
                                                ?>
                                                <option value="<?php echo @$row->id;?>"><?php echo @$row->name;?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                            </div>
                                </div>
                                </div>

                                <div class="col-12">
                                            <label class="text-info col-12 col-form-label col-form-label-lg label-custom">หมายเหตุ</label>
                                            <div class="col-12">
                                            <textarea class="form-control form-control-lg" rows="4" name="note" id="note"></textarea>
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

                                    <div class="btn_box">
                                        <div class="row no-gutter mx-0">
                                            <a onclick="cancelExport()" id="home-counter-tab" class="btn btn-danger btn-block col-6 m-0 rounded-0">ยกเลิก</a>
                                            <a onclick="confirmExport()" id="place-order-tab" class="btn btn-success btn-block col-6 m-0 rounded-0">ยืนยันนำสินค้าออก</a>
                                        </div>
                                    </div>
                                </div>


<script>

    ffunction confirmExport(){

            var data = new FormData();

            var origin_place_id = null;
            var destination_place_id = null;

            uuid = '<?php echo $uuid;?>';
            data.append('uuid', uuid);

            var note = document.getElementById("note").value;
            data.append('note', note);

            type_id = document.getElementById("requisition_type").value;
            if(type_id=='5dc8af66-b12a-412e-b388-205d1719f496'){
                origin_place_id = document.getElementById("origin_place_id").value;
                destination_place_id = document.getElementById("destination_place_id").value;
            } 

            data.append('requisition_type_id', type_id);
            data.append('origin_place_id', origin_place_id);
            data.append('destination_place_id', destination_place_id);

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('stock/export/confirm')?>',
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

    function cancelExport(){
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('stock/export/cancel')?>',
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
                        url: '<?php echo base_url('stock/export/deleteItem')?>',
                        data: 'uuid='+uuid+'&item_id='+item_id,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_itemList").html(result);
                        }
            });
    }

</script>