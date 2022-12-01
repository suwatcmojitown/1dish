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
                                            <a href="javascript:void(0);" id="home-counter-tab" class="btn btn-danger btn-block col-6 m-0 rounded-0">ยกเลิก</a>
                                            <a href="javascript:void(0);" id="place-order-tab" class="btn btn-success btn-block col-6 m-0 rounded-0">ยืนยันนำเข้าสินค้า</a>
                                        </div>
                                    </div>
                                </div>