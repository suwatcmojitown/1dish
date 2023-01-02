<div class="table-responsive">
                                    <?php 
                                    //console($list);
                                    ?>
                                    <table id="aaa" class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th width="10%"></th>
                                                <th></th>  
                                                <th>รหัส</th>                                
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>ค่าคอมมิชชั่น</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($list)&&!empty($list)){
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <img style="max-height: 70px;" src="<?php 
                                                if($row->image_url=='')echo base_url('assets/images/default-thumbnail.jpg');
                                                else echo base_url().$row->image_url;
                                                ?>">
                                                </td>
                                                <!--
                                                <td>
                                                    <h4 class="text-muted mb-0 name"><strong>เม็ดมะม่วง</strong></h4>
                                                    <h5 class="text-muted email">sriadmin@gmail.com</h5>
                                                </td>
                                                -->
                                                <td>
                                                    <h4 class="text-muted mb-2 name"><?php echo @$row->name;?></h4>
                                                    <!--
                                                    <h5 class="text-muted mb-2 name">เบอร์โทร : 054317789</h5>-->
                                                    <normal style="display:block;">
                                                    <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#warning-<?php echo $row->id;?>">
                                                    <?php 
                                                    if($row->status==1){
                                                    ?>
                                                    <span class="text-success pr-7">เปิดใช้งาน</span>
                                                    <?php }else{?>
                                                    <span class="text-danger pr-7">ไม่เปิดใช้งาน</span>
                                                    <?php }?>
                                                    </a>
                                                    </normal>
                                                    <small class="text-muted">updated : <?php echo @$row->created_at;?></small>
                                                </td> 
                                                <td><?php echo @$row->code;?></td>
                                                <td><?php echo @$row->telephone;?></td>
                                                <td><?php echo @$row->guide_commission;?></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <!--
                                                        <a class="btn btn-primary shadow btn-sm sharp me-1">
                                                            <i class="fa fa-cube" aria-hidden="true"></i>
                                                        </a> -->
                                                        <a href="<?php echo base_url('guide/edit/').$row->id;?>" class="btn btn-primary shadow btn-sm sharp me-1"><i class="fas fa-pencil-alt"></i></a>
                                                        <a href="#" class="btn btn-danger shadow btn-sm sharp" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td>
                                                <!-- Modal Tash -->
                                                <div class="modal fade" id="exampleModalCenter">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title"><span class="badge badge-lg badge-danger"> <i class="fa fa-exclamation" aria-hidden="true"></i> </span> ยืนยันลบไกด์ <span class="text-danger">#<?php echo $row->id;?></span> </h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>คุณต้องการยืนยันที่จะลบไกด์นี้ ?</p>
                                                                <p>ในกรณีที่คุณต้องการซ่อนจากเว็บไซต์ คุณสามารถเลือกแก้ไข และเปลี่ยน <code>สถานะ</code> เป็น <code>ไม่เปิดใช้งาน</code> ได้</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">ยกเลิก</button>
                                                                <button type="button" class="btn btn-danger">ยืนยัน</button>
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