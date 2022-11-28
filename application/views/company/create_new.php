<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/list');?>">Company</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Create</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > + เพิ่ม Company</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="addForm">
                                        
                                        <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ชื่อบริษัท</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" name="name">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">โลโก้บริษัท</label>
                                                <div class="col-sm-8">
                                                    <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ประเภท</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="company_type" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option value="1">ส่วนบุคคล</option>
                                                        <option value="2">นิติบุคคล</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">สาขา</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="branch_type" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option value="1">สำนักงานใหญ่</option>
                                                        <option value="2">สาขา</option>
                                                    </select>
                                                </div>
                                            </div>

                                        <hr>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เลขผู้เสียภาษี</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="tax_no">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ที่อยู่</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control  form-control-lg" style="padding-top:7px;" name="address"></textarea>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เบอร์โทรศัพท์</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="telephone">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">Fax</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="fax">
                                                </div>
                                            </div>

                                        <hr>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ชื่อผู้ติดต่อ</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" name="contact_name">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">E-mail ผู้ติดต่อ</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" name="contact_email">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เบอร์โทรศัพท์ผู้ติดต่อ</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-lg" name="contact_telephone">
                                                </div>
                                            </div>  

                                        <hr>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ชื่อบัญชีธนาคาร</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="bank_account_name">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เลขบัญชีธนาคาร</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="bank_account">
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
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
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
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="bank_branch">
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ประเภทบัญชีธนาคาร</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="bank_type">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option value="1">ออมทรัพย์</option>
                                                        <option value="2">กระแสรายวัน</option>
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
                                                    <select class="form-control " name="company_commission">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <option value="10" >10%</option>
                                                        <option value="15" >15%</option>
                                                        <option value="20" >20%</option>
                                                        <option value="25" >25%</option>
                                                    </select>
                                                </div>
                                        </div>  

                                        <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">เครดิต</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-lg" placeholder="" name="credit_day">
                                                </div>
                                        </div>

                                        <div class="mb-3 row">
                                        <label class="col-sm-3 col-form-label custom text-info">สถานะ</label>
                                                <div class="col-sm-4 select-custom">
                                                    <select class="form-control " name="status">
                                                        <option value="1">เปิดใช้งาน</option>
                                                        <option value="2">ไม่เปิดใช้งาน</option>
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
                                                            Successfully Published
                                                            The content will be generated and publish onto the website.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('company/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
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
                                                            Fail
                                                            Please try again
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('company/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
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
                                        url: '<?php echo base_url('company/add')?>',
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