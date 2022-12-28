<div class="col-5">
                        <div class="card">
                            <?php 
                            	if($detail->status==1){
                            	?>
                            	<div class="card-header bg-success">
                                <h4 class="card-title text-white" > [ จ่ายแล้ว ]</h4>
                                <h4 class="text-white" ><?php echo number_format(@$detail->grandTotal);?></h4>
                                </div>
                            	<?php }else{?>
                            	<div class="card-header bg-danger">
                                <h4 class="card-title text-white" > [ ค้างจ่าย ]</h4>
                                <h4 class="text-white" ><?php echo number_format(@$detail->grandTotal);?></h4>
                                </div>
                            	<?php }?>
                            
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <input type="hidden" class="form-control form-control-lg" name="requisition_in_id" value="<?php echo @$uuid;?>">
                                        <div class="mb-3 col-12" id="_productStockList">
                                            <label class="text-info form-label col-form-label-lg">ชื่อไกด์</label>
                                            <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo @$detail->guide_name?> <?php echo ' | '.@$detail->guide_code;?>" readonly="">
                                        </div>

                                        <div class="mb-3 col-12" id="_productList">
                                            <label class="text-info form-label col-form-label-lg">ค่าคอม</label>
                                            <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo number_format(@$detail->total);?>" readonly="">
                                        </div>

                                        
										<div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">ค่าจอด</label>
                                                <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo number_format(@$detail->parking);?>" readonly>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
					</div>

					<div class="col-7">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-list"></i> รายการสินค้า | <?php echo @$detail->transfer_date?></h4>
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
                                                <th>จำนวน</th>
                                                <th>ค่าคอม</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php 
                                                if(isset($detail->bill_item)&&!empty($detail->bill_item))
                                                {
                                                    foreach($detail->bill_item as $row)
                                                    {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="code-info"><?php echo @$row->product_name_en;?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->quantity);?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->price);?>
                                                    </td>
                                                </tr>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-order-footer" style="margin-top: 4rem;bottom: 2rem;">
                                    <div class="amount-details pl-7 pr-7">
                                        <h5 class="d-flex text-right mb-3">
                                            <span class="text">ราคารวม</span>
                                            <span class="me-0 ms-auto"><?php echo number_format(@$detail->total);?></span>
                                        </h5>
                                    </div>

                                    <div class="btn_box">
                                        <div class="row no-gutter mx-0">
                                            <?php 
                                            if($detail->status==0){
                                            ?>
                                            <a onclick="changeStatus('<?php echo $detail->bill_id;?>')" id="home-counter-tab" class="btn btn-success btn-block col-6 m-0 rounded-0">จ่ายค่าคอม</a>
                                            <?php 
                                            }
                                            if($detail->status==1){
                                            ?>
                                            <a href="<?php echo base_url('commission/guide/print/').$detail->bill_id;?>" target="_blank" id="place-order-tab" class="btn btn-info btn-block col-6 m-0 rounded-0">ปริ๊น</a>
                                            <?php 
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>