<div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>ชื่อบริษัททัวร์</th>
                                                <th>% คอมมิชชั่น</th>
                                                <th>ค่าคอมมิชชั่น</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($paging);
                                            if(isset($list)&&!empty($list)){
                                                $i = (($paging->page - 1) * PAGE_LIMIT) + 1;
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <th><?php echo $i;?></th>
                                                <th></th>
                                                <td>
                                                    <h4 class="text-muted mb-0 name"><strong><?php echo @$row->tour_company_name;?></strong></h4>
                                                    <h5 class="text-muted email"><?php echo @$row->email;?></h5>
                                                </td>
                                                <td><?php echo @$row->commission;?></td>
                                                <td><?php echo number_format(@$row->grandTotal);?></td>
                                                <td>
                                                    <?php if($row->status=='1'){?>
                                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-success me-1"></i> จ่ายแล้ว</div>
                                                    <?php 
                                                    }else{
                                                    ?>
                                                    <div class="d-flex align-items-center"><i class="fa fa-circle text-danger me-1"></i> ยังไม่จ่าย</div>
                                                    <?php 
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?php echo base_url('admin/edit/').$row->tour_company_id;?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a data-bs-original-title="ลบ" data-bs-toggle="modal" data-bs-target="#warning-<?php echo $row->tour_company_id;?>" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                        <!-- modal danger -->
                                                        <div class="modal fade modal-danger text-start" id="warning-<?php echo $row->tour_company_id;?>" tabindex="-1" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="myModalLabel120">Delete #<?php echo $row->username;?></h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ยืนยันที่จะลบรายการนี้ ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="close" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" value="<?php echo $row->tour_company_id?>" onclick="confirmDelete('<?php echo $row->tour_company_id;?>')">ยืนยัน</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- modal danger -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                $i++; 
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