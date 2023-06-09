<table class="table table-advance table-hover">
                              <thead>
                              <tr>
                                  <th>#</th>
                                  <th> ภาพ</th>
                                  <th><i class="fa fa-bookmark"></i> บทความ</th>
                                  <th><i class="fa fa-bullhorn"></i> หมวดหมู่</th>
                                  <th><i class="fa fa-book"></i> หมวดหมู่ย่อย</th>
                                  <th><i class="fa fa-eye"></i> ยอดวิว</th>
                                  <th></th>
                                  <th></th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php 
                                if($list){
                                    if($page==1) $i = 1;
                                    else $i = (($page-1)*PAGE_LIMIT)+1;
                                    foreach($list as $row){
                              ?>
                              <tr>
                                  <td><?php echo $i;?></td>
                                  <td><img src="<?php echo $row->thumbnail_path;?>" style="max-width:80px;"></td>
                                  <td><medium class="text-info"><?php echo $row->title;?></medium>
                                        <div><span class="badge badge-info label-mini">#<?php echo $row->id;?></span> <i class="fa fa-meh-o" style="padding: 0 5px;"></i> <?php echo $row->created_name;?></div>
                                        <div class="text-muted">สร้างเมื่อ : <?php echo $row->created_at;?></div>
                                  </td>
                                  <td class="hidden-phone"> <?php echo @$row->news_cat_title;?></td>
                                  <td class="hidden-phone"> <?php echo @$row->news_subcat_title;?></td>
                                  <td align="center"><?php echo @$row->view_count;?></td>
                                  <td>
                                        <span class="badge badge-<?php 
                                            if($row->status=='0')echo 'danger';
                                            elseif($row->status=='1')echo 'success';
                                            elseif($row->status=='2')echo 'info';
                                            elseif($row->status=='3')echo 'warning';
                                            elseif($row->status=='4')echo 'primary';
                                            elseif($row->status=='5')echo 'danger';
                                            ?>
                                        ">
                                            <?php 
                                            if($row->status=='0')echo 'ไม่เปิดใช้งาน';
                                            elseif($row->status=='1')echo 'เปิดใช้งาน';
                                            elseif($row->status=='2')echo 'ร่าง';
                                            elseif($row->status=='3')echo 'ส่งตรวจสอบ';
                                            elseif($row->status=='4')echo 'รอแก้ไข';
                                            elseif($row->status=='5')echo 'ส่งตรวจอีกครั้ง';?>
                                        </span>
                                  </td>
                                  <td class="top-nav">
                                        <ul class="nav pull-right top-menu">
                                                <li class="dropdown language">
                                                    <a data-close-others="true" data-hover="dropdown" data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                                        <i class=" fa fa-ellipsis-v"></i>  
                                                    </a>
                                                    <ul class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 40px, 0px);">
                                                        <li><a href="<?php echo base_url('quiz/detail/').$row->id;?>"><button class="btn btn-warning btn-sm"><i class="fa fa-eye"></i></button><span style="padding-left:7px;">รายละเอียด</span></a></li>
                                                        <?php 
                                                        if(($row->status==2)||($row->status==4))
                                                        {
                                                        ?>
                                                        <li><a href="<?php echo base_url('quiz/edit/').$row->id;?>"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></button><span style="padding-left:7px;">แก้ไขข้อสอบ</span></a></li>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <?php 
                                                        if(($row->status==1)&&($this->session->userdata['group_id']=='1'))
                                                        {
                                                        ?>
                                                        <li><a onclick="changeStatus(<?php echo $row->id;?>,0)"><button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></button><span style="padding-left:7px;">ปิดใช้งาน</span></a></li>
                                                        <?php 
                                                        }
                                                        elseif(($row->status==0)&&($this->session->userdata['group_id']=='1'))
                                                        {
                                                        ?>
                                                        <li><a onclick="changeStatus(<?php echo $row->id;?>,1)"><button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button><span style="padding-left:7px;">เปิดใช้งาน</span></a></li>
                                                        <?php    
                                                        }
                                                        if($row->status==2)
                                                        {
                                                        ?>
                                                        <li><a onclick="changeStatus(<?php echo $row->id;?>,3)"><button class="btn btn-warning btn-sm"><i class="fa fa-ban"></i></button><span style="padding-left:7px;">ส่งตรวจสอบ</span></a></li>
                                                        <li><a onclick="del(<?php echo $row->id;?>)"><button class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></button><span style="padding-left:7px;">ลบ</span></a></li>
                                                        <?php 
                                                        }
                                                        ?> 
                                                    </ul>
                                                </li>
                                        </ul>
                                  </td>
                              </tr>
                              <?php 
                                $i++;
                                }
                              }
                              ?>
                              
                              </tbody>
                          </table>
                          <?php 
                            if($paging)
                            {
                                $total_page = $paging->total_page;
                                $active_page = $paging->page;
                                if($total_page > 1)
                                {
                            ?>
                            <div class="card-body">
                                <div>
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-end">
                                            <?php 
                                            if($active_page-1>0){
                                            ?>
                                            <li class="page-item">
                                                <a onclick="loadPage(<?php echo $active_page-1;?>)" class="page-link" tabindex="-1">Previous</a>
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
                                            <li class="page-item">
                                                <a onclick="loadPage(<?php echo $active_page+1;?>)" class="page-link" >Next</a>
                                            </li>
                                            <?php 
                                            }
                                            ?>
                                            
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <?php 
                                }
                            }    
                            ?>