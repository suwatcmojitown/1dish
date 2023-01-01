<div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>ชื่อบริษัททัวร์</th>
                                                <th>% คอมมิชชั่น</th>
                                                <th>ยอดซื้อ</th>
                                                <th>ค่าคอมมิชชั่น</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($list);
                                            if(isset($list)&&!empty($list)){
                                                $i = (($paging->page - 1) * PAGE_LIMIT) + 1;
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <th><?php echo $i;?></th>
                                                <th></th>
                                                <td>
                                                    <h4 class="text-primary mb-0 name" style="font-weight: 400;"><?php echo @$row->tour_company_name;?></h4>
                                                    <h5 class="text-muted" style="font-weight: 300;">#<?php echo @$row->group_no;?></h5>
                                                </td>
                                                <td><?php echo @$row->commission;?></td>
                                                <td><?php echo number_format(@$row->bill_grandTotal);?></td>
                                                <td><?php echo number_format(@$row->total);?></td>
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
                                                        <a href="<?php echo base_url('commission/company/view/').$row->tour_grouping_id;?>" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                                        <a target="_blank" href="<?php echo base_url('commission/company/print/').$row->tour_grouping_id;?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-print"></i></a>
                                                        <?php 
                                                        if($row->status==0){
                                                        ?>
                                                        <a style="padding-left: 14px;cursor: pointer;" onclick="changeStatus('<?php echo $row->tour_grouping_id;?>')"><span class="badge badge-success">จ่ายค่าคอม</span></a>
                                                        <?php 
                                                        }
                                                        ?>
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