<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('product-category/list')?>"><i class="fa fa-shopping-bag" aria-hidden="true"></i> Product Category</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> แก้ไข Product Category : <?php echo @$detail->name_th;?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>"> 
                                        <div class="mb-3 col-8">
                                                <label class="text-info form-label col-form-label-lg">Code</label>
                                                <input type="text" class="form-control form-control-lg" name="code" value="<?php echo @$detail->code;?>">
                                        </div>
                                        <div class="mb-3 col-8">
                                                <label class="text-info form-label col-form-label-lg">ชื่อ</label>
                                                <input type="text" class="form-control form-control-lg" name="name_th" value="<?php echo @$detail->name_th;?>">
                                        </div>
                                        <div class="mb-3 col-8">
                                                <label class="text-info form-label col-form-label-lg">ชื่อ <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="name_en" value="<?php echo @$detail->name_en;?>">
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">รายละเอียด</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_th"><?php echo @$detail->description_th;?></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">รายละเอียด <code>EN</code></code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_en"><?php echo @$detail->description_en;?></textarea>
                                        </div>
                                        <div class="mb-3 mb-0 col-5">
                                            <label class="text-info form-label col-form-label-lg">สถานะ</label>
                                            <select class="default-select form-control wide mb-3" name="status" id="status">
                                                <option value="1" <?php if($detail->status=='1')echo 'selected';?>>เปิดใช้งาน</option>
                                                <option value="0" <?php if($detail->status=='0')echo 'selected';?>>ไม่เปิดใช้งาน</option>
                                            </select>
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
                                                            Successfully Published
                                                            The content will be generated and publish onto the website.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('product-category/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
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
                                                            <a href="<?php echo base_url('product-category/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
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
                
                var status = document.getElementById("status").value;
                    data.append('status', status);
                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('product-category/update')?>',
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