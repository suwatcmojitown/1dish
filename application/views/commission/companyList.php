<!--**********************************
            Content body start
        ***********************************--> 
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="me-auto d-none d-lg-block ">
                        <h2 class="text-primary font-w600 mb-0"><i class="fa fa-credit-card" aria-hidden="true"></i> Commission Company</h2>
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
                    <div class="mb-4" style="margin-right: 3px;width: 300px;">
                            <select class="default-select form-control wide mb-3" id="tourname" name="tourname">
                                                        <option value="null" selected> ----- กรุณาเลือกบริษัททัวร์ ----- </option>
                                                        <?php 
                                                        if(isset($tourList)&&!empty($tourList))
                                                        {
                                                            foreach($tourList as $row)
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                            </select>
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
                                                <th>ชื่อบริษัททัวร์</th>
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
                                                    <h4 class="text-primary mb-0 name" style="font-weight: 400;"><?php echo @$row->tour_company_name;?></h4>
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
                                                        <a href="<?php echo base_url('commission/company/view/').$row->bill_id;?>" class="btn btn-success shadow btn-xs sharp me-1"><i class="fas fa-eye"></i></a>
                                                        <a target="_blank" href="<?php echo base_url('commission/company/print/').$row->bill_id;?>" class="btn btn-primary shadow btn-xs sharp me-1"><i class="fas fa-print"></i></a>
                                                        <?php 
                                                        if($row->status==0){
                                                        ?>
                                                        <a style="padding-left: 14px;cursor: pointer;" onclick="changeStatus('<?php echo $row->bill_id;?>')"><span class="badge badge-success">จ่ายค่าคอม</span></a>
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
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <span id="result"></span>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


<script>

function loadPage(page){
    keysearch = document.getElementById("tourname").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('commission/loadCompanyList')?>',
                data: 'keysearch='+keysearch+'&status='+status+'&page='+page,
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
}


$("#filterBtn").click(function(){
    keysearch = document.getElementById("tourname").value;
    status = document.getElementById("status").value;
    
    $.ajax({
                type: 'POST',
                url: '<?php echo base_url('commission/loadCompanyList')?>',
                data: 'keysearch='+keysearch+'&status='+status+'&page=1',
                success: function(result) { 
                    //$('#result').html(result);
                    $("#_list").html(result);
                } 
    });
});


function changeStatus(id){
    keysearch = document.getElementById("tourname").value;
    status = document.getElementById("status").value;
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('commission/changeCompanyStatus')?>',
                        data: 'keysearch='+keysearch+'&status='+status+'&page=<?php echo $active_page;?>&id='+id,
                        success: function(result) { 
                            //$('#result').html(result); 
                            $("#_list").html(result);
                        }
                    });
}



</script>