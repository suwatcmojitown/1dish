<!--**********************************
            Content body start
        ***********************************--> 
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid"> 
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="me-auto d-none d-lg-block ">
                        <h2 class="text-primary font-w600 mb-0"><i class="fa fa-credit-card" aria-hidden="true"></i> Commission Guide</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">List</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
                    </div>
                    <!--
                    <div class="input-group search-area style-1 mb-4 ">
                            <input type="text" class="form-control search-input" id="keysearch" placeholder="คำค้นหา...">
                    </div>
                    <div class="dropdown custom-dropdown ms-3">
                        <div class="input-group mb-3" style="">
                                            <select id="status" class="form-select wide" aria-label="Default select example" style="background: #fff;border: 0.0625rem solid #f0f1f5;padding: 0.3125rem 1.25rem;color: #6e6e6e;height: 3.5rem;border-radius: 0.5rem;">
                                                  <option selected disabled>Choose...</option>
                                                  <option value="1">เปิดใช้งาน</option>
                                                  <option value="0">ไม่เปิดใช้งาน</option>
                                            </select>
                                            <button class="btn btn-primary" type="button">สถานะ</button>
                                        </div>
                    </div>
                    -->
                    <div class="mb-3" style="margin-right: 3px;">
                            <input id="keysearch" class="form-control form-control-lg" type="text" placeholder="คำค้นหา" >
                    </div>
                    <div class="dropdown custom-dropdown ms-3">
                        <div class="input-group mb-3" style="">
                                            <select id="status" class="form-select wide" aria-label="Default select example" style="font-size:1.09375rem;background: #fff;border: 0.0625rem solid #f0f1f5;padding: 0.3125rem 1.25rem;color: #6e6e6e;height: 3.5rem;border-radius: 0.5rem;">
                                                  <option value="">-- สถานะ --</option>
                                                  <option value="1">เปิดใช้งาน</option>
                                                  <option value="0">ไม่เปิดใช้งาน</option>
                                            </select>
                        </div>
                    </div>
                    <a  id="filterBtn" class="btn btn-primary ms-3" style="margin-right: 4px;">ค้นหา  <i class="fa fa-filter"></i></a>
                    <!--
                    <a href="<?php echo base_url('admin/create');?>" id="add-order" class="btn btn-warning btn-rounded ms-3">Add +</a>-->
                    <!--
                    <div class="dropdown custom-dropdown ms-3">
                        <button type="button" class="btn btn-primary light d-flex align-items-center svg-btn" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="16" height="16" class="scale5" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.4281 2.856H21.8681V1.428C21.8681 0.56 21.2801 0 20.4401 0C19.6001 0 19.0121 0.56 19.0121 1.428V2.856H9.71606V1.428C9.71606 0.56 9.15606 0 8.28806 0C7.42006 0 6.86006 0.56 6.86006 1.428V2.856H5.57206C2.85606 2.856 0.560059 5.152 0.560059 7.868V23.016C0.560059 25.732 2.85606 28.028 5.57206 28.028H22.4281C25.1441 28.028 27.4401 25.732 27.4401 23.016V7.868C27.4401 5.152 25.1441 2.856 22.4281 2.856ZM5.57206 5.712H22.4281C23.5761 5.712 24.5841 6.72 24.5841 7.868V9.856H3.41606V7.868C3.41606 6.72 4.42406 5.712 5.57206 5.712ZM22.4281 25.144H5.57206C4.42406 25.144 3.41606 24.136 3.41606 22.988V12.712H24.5561V22.988C24.5841 24.136 23.5761 25.144 22.4281 25.144Z" fill="#2F4CDD"/></svg>
                            <span class="fs-16 ms-3">Today</span>
                            <i class="fa fa-angle-down scale5 ms-3"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Monday</a>
                            <a class="dropdown-item" href="#">Tuesday</a>
                            <a class="dropdown-item" href="#">Wednesday</a>
                            <a class="dropdown-item" href="#">Thursday</a>
                            <a class="dropdown-item" href="#">Friday</a>
                            <a class="dropdown-item" href="#">Saturday</a>
                            <a class="dropdown-item" href="#">Sunday</a>
                        </div>
                    </div>
                    -->
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-body" id="_list">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th></th>
                                                <th>ชื่อไกด์</th>
                                                <th>% คอมมิชชั่น</th>
                                                <th>ค่าคอมมิชชั่น</th>
                                                <th>สถานะ</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            //console($list);
                                            $i = (($paging->page - 1) * PAGE_LIMIT) + 1;
                                            if(isset($list)&&!empty($list)){
                                                foreach($list as $row){
                                            ?>
                                            <tr>
                                                <th><?php echo $i;?></th>
                                                <th></th>
                                                <td>
                                                    <h4 class="text-primary mb-0 name" style="font-weight: 400;"><?php echo @$row->guide_name;?></h4>
                                                    <h5 class="text-muted" style="font-weight: 300;">#<?php echo @$row->document_no;?></h5>
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
                                                        <a href="<?php echo base_url('commission/guide/view/').$row->bill_id;?>" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                                        <a target="_blank" href="<?php echo base_url('commission/guide/print/').$row->bill_id;?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-print"></i></a>
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
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
<span id="result"></span>

<script>

function loadPage(page){
    keysearch = document.getElementById("keysearch").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('commission/loadGuideList')?>',
                data: 'keysearch='+keysearch+'&status='+status+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    keysearch = document.getElementById("keysearch").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('commission/loadGuideList')?>',
                data: 'keysearch='+keysearch+'&status='+status+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});


function changeStatus(id,status){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('admin/changeStatus')?>',
                        data: 'id='+id+'&status='+status,
                        success: function(result) { 
                            //$('#result').html(result);
                            if(result==true)
                            {
                                toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','แก้ไขคลังปัญญา');
                                setTimeout(function() { 
                                        var url = "<?php echo base_url('article/list');?>";    
                                        $(location).attr('href',url);
                                }, 3000);
                            } 
                            else{
                                toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','แก้ไขคลังปัญญา');
                            }    
                        }
                    });
}


function confirmDelete(id){
            var page = <?php echo $active_page;?>;
            var keysearch = '';
            var status = '';

            keysearch = document.getElementById("keysearch").value;
            status = document.getElementById("status").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('admin/delete')?>',
                        data: 'id='+id+'&keysearch='+keysearch+'&status='+status+'&page='+page,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#_list").html(result);
                        }
            });
    }

</script>