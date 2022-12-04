<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"> <a href="<?php echo base_url('guide/list');?>">Guide</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> แก้ไข Guide : <?php echo @$detail->name;?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="addForm">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>">
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ชื่อ</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" name="name" value="<?php echo @$detail->name;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">รหัส</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="code" value="<?php echo @$detail->code;?>">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">รูปถ่าย</label>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-3">
                                                <img src="<?php echo @$detail->image_url;?>"></img>
                                            </div>
                                            <input type="hidden" class="form-control" name="thumbnail_hidden" placeholder="" value="<?php echo @$detail->image;?>">

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เบอร์โทรศัพท์</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="telephone" value="<?php echo @$detail->telephone;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ที่อยู่</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control  form-control-lg" style="padding-top:7px;" name="address"><?php echo @$detail->address;?></textarea>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เลขบัตรประชาชน</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="id_card" value="<?php echo @$detail->id_card;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">รูปถ่ายบัตรประชาชน</label>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control form-control-lg" name="id_card_image" style="padding-top: 14px;" value="<?php echo @$detail->id_card_image;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 col-3">
                                                <img src="<?php echo @$detail->id_card_image_url;?>"></img>
                                            </div>
                                            <input type="hidden" class="form-control" name="id_card_thumbnail_hidden" placeholder="" value="<?php echo @$detail->id_card_image;?>">

                                        <hr>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ชื่อบัญชีธนาคาร</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="bank_account_name" value="<?php echo @$detail->bank_account_name;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เลขบัญชีธนาคาร</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="bank_account" value="<?php echo @$detail->bank_account;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ธนาคาร</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="bank_id" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($bankList)&&!empty($bankList))
                                                        {
                                                            foreach($bankList as $row)
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>" <?php if($detail->bank_id==$row->id) echo 'selected';?>><?php echo $row->name;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">สาขา</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="bank_branch" value="<?php echo @$detail->bank_branch;?>">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ประเภทบัญชีธนาคาร</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="bank_type">
                                                         <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option <?php if($detail->bank_type==1) echo 'selected';?> value="1">ออมทรัพย์</option>
                                                        <option <?php if($detail->bank_type==2) echo 'selected';?> value="2">กระแสรายวัน</option>
                                                    </select>
                                                </div>
                                            </div>
                                        <!--
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">รูปถ่ายบัญชีธนาคาร</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control form-control-lg" name="bank_image">
                                                </div>
                                            </div>
                                        -->

                                        <hr>

                                        <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ค่าคอมไกด์</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="guide_commission">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option <?php if($detail->guide_commission==0) echo 'selected';?> value="0" >0%</option>
                                                        <option <?php if($detail->guide_commission==5) echo 'selected';?> value="5" >5%</option>
                                                        <option <?php if($detail->guide_commission==10) echo 'selected';?> value="10" >10%</option>
                                                        <option <?php if($detail->guide_commission==15) echo 'selected';?> value="15" >15%</option>
                                                        <option <?php if($detail->guide_commission==20) echo 'selected';?> value="20" >20%</option>
                                                        <option <?php if($detail->guide_commission==25) echo 'selected';?> value="25" >25%</option>
                                                    </select>
                                                </div>
                                        </div> 

                                        <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label custom text-info">สถานะ</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="status">
                                                        <option <?php if($detail->status==1) echo 'selected';?> value="1">เปิดใช้งาน</option>
                                                        <option <?php if($detail->status==0) echo 'selected';?> value="2">ไม่เปิดใช้งาน</option>
                                                    </select>
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
                                                            <a href="<?php echo base_url('guide/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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
                                                            <a href="<?php echo base_url('guide/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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
                
                var file_data = $('input[name="image"]')[0].files;
                    for (var i = 0; i < file_data.length; i++) {
                        data.append("image", file_data[i]);
                }
/*
                var group_admin_id = document.getElementById("group_admin_id").value;
                    data.append('group_admin_id', group_admin_id);
                    */
                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('guide/update')?>',
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