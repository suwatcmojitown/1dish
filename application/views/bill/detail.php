<!--

-->

<!--**********************************
            Content body start
        ***********************************--> 
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="form-head d-flex mb-3 align-items-start">
                    <div class="me-auto d-none d-lg-block ">
                        <h2 class="text-primary font-w600 mb-0"><i class="fa fa-credit-card" aria-hidden="true"></i> Bill</h2>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)"><?php echo @$detail->BL20221208009?></a></li>
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
                   
                </div>
                <div class="row" id="_content">
                	<?php //console($detail);?>
                    <div class="col-5">
                        <div class="card">
                            	<div class="card-header bg-info">
                                <h4 class="card-title text-white" > Bill #<?php echo @$detail->document_no;?></h4>
                                </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <input type="hidden" class="form-control form-control-lg" name="requisition_in_id" value="<?php echo @$uuid;?>">
                                        <div class="mb-3 col-12" id="_productStockList">
                                            <label class="text-info form-label col-form-label-lg">สัญลักษณ์</label>
                                            <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo @$detail->group_sign?><?php if($detail->discount!='0%') echo ' - '.@$detail->discount;?>" readonly="">
                                        </div>

                                        <div class="mb-3 col-12" id="_productList">
                                            <label class="text-info form-label col-form-label-lg">ไกด์</label>
                                            <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo @$detail->guide_name?> <?php echo ' - '.@$detail->tour_company_name;?>" readonly="">
                                        </div>

                                        
										<div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">ยอดรวม</label>
                                                <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo number_format(@$detail->grand_total);?><?php echo ' - '.@$detail->payment_type_name;?>" readonly>
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">การทำรายการ</label>
                                                <input type="text" class="form-control form-control-lg" name="price_per_item" value="<?php echo @$detail->cashier_no;?><?php echo ' - '.@$detail->updated_at;?>" readonly>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
					</div>

					<div class="col-7">
                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-list"></i> รายการสินค้า | <?php echo @$detail->transfer_date?></h4>
                            </div>
                            <div class="card-body" id="_itemList">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <?php 
                                        //console($itemList);
                                        ?>
                                        <thead>
                                            <tr>
                                                <th width="40%"></th>
                                                <th>ราคา/ชิ้น</th>
                                                <th>จำนวน</th>
                                                <th>รวม</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            <?php 
                                                if(isset($detail->items)&&!empty($detail->items))
                                                {
                                                    foreach($detail->items as $row)
                                                    {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="code-info"><?php echo @$row->product_name_en;?></span>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->price_per_item);?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->quantity);?>
                                                    </td>
                                                    <td>
                                                        <?php echo number_format(@$row->total);?>
                                                    </td>
                                                </tr>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="card-order-footer" style="margin-top: 4rem;bottom: 2rem;">
                                    <div class="amount-details pl-7 pr-7">
                                        <h5 class="d-flex text-right mb-3">
                                            <span class="text">ราคารวม</span>
                                            <span class="me-0 ms-auto"><?php echo number_format(@$detail->total);?></span>
                                        </h5>
                                    </div>
                                </div>
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

function changeStatus(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('commission/changeCompanyStatusDetail')?>',
                        data: 'id='+id,
                        success: function(result) { 
                            //$('#result').html(result); 
                            $("#_content").html(result);
                        }
                    });
}

</script>

