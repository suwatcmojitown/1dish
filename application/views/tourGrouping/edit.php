<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/list');?>">Tour Grouping</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> แก้ไข Group</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="addForm">
                                        <?php //console($detail);?>
                                        	<div class="mb-3 row">
                                                <input type="hidden" class="form-control form-control-lg" name="id" value="<?php echo @$detail->id;?>">
                                                <label class="col-sm-3 col-form-label custom text-info">สัญลักษณ์</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="group_sign" value="<?php echo @$detail->group_sign;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ไกด์</label>
                                                <div class="col-sm-4">
                                                    <select class="default-select form-control wide mb-3" id="guidename" name="guidename">
                                                            <option value="" selected> ----- กรุณาเลือกไกด์ ----- </option>
                                                            <?php 
                                                            if(isset($guideList)&&!empty($guideList))
                                                            {
                                                                foreach($guideList as $row)
                                                                {
                                                            ?>
                                                                <option value="<?php echo $row->id;?>" <?php if($row->id==$detail->guide_id) echo 'selected';?>><?php echo $row->name;?></option>
                                                            <?php 
                                                                }
                                                            }
                                                            ?>
                                                    </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label custom text-info">% ไกด์</label>
                                                <div class="col-sm-3 select-custom">
                                                	<select class="form-control " name="guide_commission" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option <?php if($detail->guide_commission=='0') echo 'selected '; ?>value="0"  > 0% </option>
                                                        <option <?php if($detail->guide_commission=='5') echo 'selected '; ?>value="5"  > 5% </option>
                                                        <option <?php if($detail->guide_commission=='10') echo 'selected '; ?>value="10"  > 10% </option>
                                                        <option <?php if($detail->guide_commission=='15') echo 'selected '; ?>value="15"  > 15% </option>
                                                        <option <?php if($detail->guide_commission=='20') echo 'selected '; ?>value="20"  > 20% </option>
                                                        <option <?php if($detail->guide_commission=='25') echo 'selected '; ?>value="25"  > 25% </option>
                                                        <option <?php if($detail->guide_commission=='30') echo 'selected '; ?>value="30"  > 30% </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">บริษัททัวร์</label>
                                                <div class="col-sm-4">
                                                    <select class="default-select form-control wide mb-3" id="tourname" name="tourname">
                                                        <option value="" selected>  กรุณาเลือกบริษัททัวร์  </option>
                                                        <?php 
                                                        if(isset($companyList)&&!empty($companyList))
                                                        {
                                                            foreach($companyList as $row)
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>" <?php if($row->id==$detail->tour_company_id) echo 'selected';?>><?php echo $row->name;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                            </select>
                                                </div>
                                                <label class="col-sm-2 col-form-label custom text-info">% ทัวร์</label>
                                                <div class="col-sm-3 select-custom">
                                                    <select class="form-control " name="company_commission" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option <?php if($detail->company_commission=='0') echo 'selected '; ?>value="0"  > 0% </option>
                                                        <option <?php if($detail->company_commission=='5') echo 'selected '; ?>value="5"  > 5% </option>
                                                        <option <?php if($detail->company_commission=='10') echo 'selected '; ?>value="10"  > 10% </option>
                                                        <option <?php if($detail->company_commission=='15') echo 'selected '; ?>value="15"  > 15% </option>
                                                        <option <?php if($detail->company_commission=='20') echo 'selected '; ?>value="20"  > 20% </option>
                                                        <option <?php if($detail->company_commission=='25') echo 'selected '; ?>value="25"  > 25% </option>
                                                        <option <?php if($detail->company_commission=='30') echo 'selected '; ?>value="30"  > 30% </option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ค่าจอด</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="parking" value="<?php echo @$detail->parking;?>">
                                                </div>
                                            </div>


                                        <hr>

                                        <div class="mb-3 mt-3">
                                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                                            <button id="submit_btn" type="button" class="btn btn-success" style="float:right;">ยืนยัน</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

					</div>
				</div>
            </div>
            <div id="result"></div>
        </div>

        <!--  modal status -->
                                            <div class="modal fade text-start" id="result_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            บันทึกสำเร็จ
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('grouping');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal fade text-start" id="result_modal_fail" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            บันทึกไม่สำเร็จ เกิดข้อผิดพลาด กรุณาลองใหม่
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('grouping');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

<script>
    var submitButton = $('#submit_btn');
    formContainer  = $('#addForm');
    $("#submit_btn").click(function(){
        
                var data = new FormData();

                //data.append("detail", myEditor.getData());

                //Form data
                var form_data = $('#addForm').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });
/*
                var group_admin_id = document.getElementById("group_admin_id").value;
                    data.append('group_admin_id', group_admin_id);
                    */
                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('grouping/update')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
                                            //$('#result').html(result);
                                            
                                            if(result==true)
                                            {
                                                $('#result_modal').modal('show');
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }

                                        }
                                    });
         
    });

</script>