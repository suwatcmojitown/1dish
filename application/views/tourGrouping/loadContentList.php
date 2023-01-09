<div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>สัญลักษณ์</th>
                                                <th>ชื่อไกด์</th>
                                                <th>ข้อมูลกรุ๊ป</th>
                                                <!--
                                                <th>สถานะ</th>
                                                -->
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($list);
                                            
                                            if(isset($list)&&!empty($list)){
                                                //$i = (($paging->page - 1) * PAGE_LIMIT) + 1;
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <h4 class="text-primary mb-0 name" style="font-weight: 400;"><?php echo @$row->group_sign.' #'.$row->no;?></h4>
                                                    <h5 class="text-muted" style="font-weight: 400;">  
                                                        <?php echo @$row->created_at;?></h5>
                                                </td>
                                                <td>
                                                    <h4 class="text-primary mb-0 name" style="font-weight: 400;"><?php echo @$row->company_name;?></h4>
                                                    <h5 class="text-muted" style="font-weight: 400;">  
                                                        <?php 
                                                        echo @$row->guide_name;
                                                        ?>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <h5 class="text-muted" style="font-weight: 400;">  
                                                        <?php 
                                                        echo @$row->country_name.'-'.@$row->volume_adult.'-'.@$row->volume_child;
                                                        ?>
                                                    </h5>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="<?php echo base_url('grouping/view/').$row->id;?>" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                                        <a href="<?php echo base_url('grouping/edit/').$row->id;?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-pencil-alt"></i>
                                                        <!--
                                                        <?php 
                                                        if($row->status==0){
                                                        ?>
                                                        <a style="padding-left: 14px;cursor: pointer;" onclick="changeStatus('<?php echo $row->tour_grouping_id;?>')"><span class="badge badge-success">จ่ายค่าคอม</span></a>
                                                        <?php 
                                                        }
                                                        ?>
                                                        -->
                                                </td>
                                            </tr>
                                            <?php
                                                //$i++; 
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