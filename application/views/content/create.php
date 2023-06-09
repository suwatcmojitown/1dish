<div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" ><a href="<?php echo base_url('content/list');?>" style="color:#ab0600!important;"><i class="fa fa-id-badge" aria-hidden="true"></i> Content</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Create</a></li>
                    </ol>
                </div>
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header bg-custom">
                                <h4 class="card-title text-white" > + เพิ่ม Content</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ</label>
                                                <input type="text" class="form-control form-control-lg" name="title_th">
                                        </div>
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="title_en" >
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">รายละเอียด</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_th"></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">รายละเอียด <code>EN</code></code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_en"></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">เนื้อหา </label>
                                                <textarea class="form-control form-control-lg" rows="4" name="detail_th"></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">เนื้อหา <code>EN</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="detail_en"></textarea>
                                        </div>
                                        
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">รูปภาพ</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">Youtube Link</label>
                                                <input type="text" class="form-control form-control-lg" name="youtube_link">
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">External Link</label>
                                                <input type="text" class="form-control form-control-lg" name="external_link">
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">Keyword</label>
                                                <input type="text" class="form-control form-control-lg" name="keyword">
                                        </div>

                                        <div class="mb-3 mb-0 col-5">
                                            <label class="text-custom form-label col-form-label-lg">สถานะ</label>
                                            <select class="default-select form-control wide mb-3" name="status" id="status">
                                                <option value="1">เปิดใช้งาน</option>
                                                <option value="0">ไม่เปิดใช้งาน</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                                            <button id="submit_btn" type="button" class="btn btn-success" style="float:right;" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md">ยืนยัน</button>
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
                                                            <a href="<?php echo base_url('content/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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
                                                            บันทึกไม่สำเร็จ เกิดข้อผิดพลาด กรุณาตรวจสอบข้อมูลอีกครั้ง <br>
                                                            หมวดหมู่ , ราคาทุน , ราคาขาย 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('content/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

<script>
    var submitButton = $('#submit_btn');
    formContainer  = $('#addForm');
    $("#submit_btn").click(function(){
        
                /*

                var product_category_id = null;
        
                $(".category button").each(function(){ 
                    if($(this).hasClass("active")) { 
                        product_category_id = $(this).attr("value");
                    }
                });
                */

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

                var status = document.getElementById("status").value;
                data.append('status', status);

                 
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('content/add')?>',
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