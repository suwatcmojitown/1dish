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