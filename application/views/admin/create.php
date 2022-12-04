<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/list');?>">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Create</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > + เพิ่ม Admin</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="addForm">
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">ชื่อ - นามสกุล</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-lg" name="first_name">
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-lg" name="last_name">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">รูปภาพ</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">Email</label>
                                            <div class="col-sm-8">
                                                <input type="email" class="form-control form-control-lg" name="email">
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">เบอร์โทรศัพท์</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-lg" name="telephone">
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">Username</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-lg" name="username" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">Password</label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control form-control-lg" name="password" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="text-info col-sm-2 col-form-label col-form-label-lg label-custom">Role</label>
                                            <div class="col-sm-5">
                                            <select class="default-select form-control wide mb-3" name="group_admin_id">
                                                <option >Choose...</option>
                                                <?php 
                                                foreach($adminGroupList as $row){
                                                ?>
                                                <option value="<?php echo @$row->id;?>"><?php echo @$row->name;?></option>
                                                <?php 
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        </div>
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
                                                            <a href="<?php echo base_url('admin/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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
                                                            <a href="<?php echo base_url('admin/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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

                var group_admin_id = document.getElementById("group_admin_id").value;
                    data.append('group_admin_id', group_admin_id);
                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('admin/add')?>',
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