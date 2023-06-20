<div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th width="10%"></th>
                                                <th></th>
                                                <th>ราคา</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($list);
                                            if(isset($list)&&!empty($list)){
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <img style="max-height: 70px;" src="<?php echo @$row->image_url?>">
                                                </td>
                                                <td>
                                                    <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th?></h4>
                                                    <normal style="display:block;"> 
                                                    <h5 style="font-weight: 400;"><?php echo @$row->category_title_th;?> - <?php echo @$row->car_brand_title_th;?></h5>
                                                    </normal>
                                                    <normal style="font-weight: 300;color:#3d4465;"><i class="fas fa-pencil-alt"></i> <?php echo @$row->updated_by;?> <i class="lni lni-timer"></i> <?php echo @$row->created_at;?></normal>
                                                    
                                                    
                                                </td>
                                                <td>
                                                    <?php echo number_format(@$row->price);?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($row->status==1){
                                                    ?>
                                                    <span class="badge bg-success ">เปิดใช้งาน</span>
                                                    <?php }else{?>
                                                    <span class="badge bg-danger ">ไม่เปิดใช้งาน</span>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <?php 
                                                        if($_SESSION['group_admin']!='cashier'){
                                                        ?>
                                                        <a target="_blank" href="<?php echo base_url('product/edit/').$row->id;?>" class="btn btn-custom shadow btn-sm sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <?php }?>
                                                        <a target="_blank" href="<?php echo base_url('product/gallery/').$row->id;?>" class="btn btn-info shadow btn-sm sharp me-1">
                                                            <i class="fa fa-image" aria-hidden="true"></i>
                                                        </a>
                                                        <?php 
                                                        if(($_SESSION['group_admin']!='cashier')||($_SESSION['group_admin']!='account')){
                                                        ?>
                                                        <a href="#" class="btn btn-danger shadow btn-sm sharp me-1" data-bs-toggle="modal" data-bs-target="#del<?php echo $row->id;?>"><i class="fa fa-trash"></i></a>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <a target="_blank" class="btn btn-<?php if($row->best_seller=='0')echo 'pre';?>success shadow btn-sm sharp me-1" onclick="changeStatusBestSeller('<?php echo $row->id;?>','<?php echo $row->best_seller;?>','<?php echo $page;?>')">
                                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                                        </a>
                                                        <a target="_blank" class="btn btn-<?php if($row->recommended=='0')echo 'pre';?>info shadow btn-sm sharp me-1" onclick="changeStatusRecommend('<?php echo $row->id;?>','<?php echo $row->recommended;?>','<?php echo $page;?>')">
                                                            <i class="fa fa-check" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <!-- Modal Tash -->
                                                <div class="modal fade" id="del<?php echo $row->id;?>">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยืนยันลบสินค้า <span class="text-danger"><?php echo @$row->name_th;?></span> </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยืนยันที่จะลบสินค้านี้ ?</p>
                                                                <p>ในกรณีที่คุณต้องการซ่อนจากเว็บไซต์ คุณสามารถเลือกแก้ไข และเปลี่ยน <code>สถานะ</code> เป็น <code>ไม่เปิดใช้งาน</code> ได้</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('<?php echo $row->id;?>')">ยืนยัน</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Modal Tash -->
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
                                    <ul class="pagination pagination-gutter pagination-danger no-bg">
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