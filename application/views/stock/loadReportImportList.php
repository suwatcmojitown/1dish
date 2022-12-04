<div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>จำนวน</th>
                                                <th>ราคา</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($resultList);
                                            if(isset($list)&&!empty($list)){
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <!--
                                                <td>
                                                    <h4 class="text-muted mb-0 name"><strong>เม็ดมะม่วง</strong></h4>
                                                    <h5 class="text-muted email">sriadmin@gmail.com</h5>
                                                </td>
                                                -->
                                                <td>
                                                    <h4 class="text-primary mb-1 name" style="font-weight: 400;"><?php echo @$row->document_no?></h4>
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
                                                    <?php echo number_format(@$row->total_quantity);?>
                                                </td>
                                                <td>
                                                    <?php echo number_format(@$row->grand_total);?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?php echo base_url('product/edit/').$row->id;?>" class="btn btn-primary shadow btn-sm sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="#" class="btn btn-success shadow btn-sm sharp" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-eye"></i></a>
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