<h4 class="card-title text-custom"> <i class="fas fa-pencil-alt"></i> แก้ไข Highlight </h4>
                                        <hr style="color:red!important;">
        <div class="dd" id="nestable2">
                                    <div class="basic-form">
                                        <form class="row" id="editForm" >
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>">
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">รูปภาพ</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        <div class="mb-3 col-12">
                                                <img src="<?php echo @$detail->image_url;?>" class="img-fluid"></img>
                                        </div>
                                        <input type="hidden" class="form-control" name="thumbnail_hidden" placeholder="" value="<?php echo @$detail->image;?>">

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">Link</label>
                                                <input type="text" class="form-control form-control-lg" name="external_link" value="<?php echo $detail->external_link;?>">
                                        </div>
                                        
                                        
                                        <div class="mb-3 mt-3">
                                            <button type="button" class="btn btn-danger">ยกเลิก</button>
                                            <button id="updateBubble_btn" type="button" class="btn btn-success" style="float:right;" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md">ยืนยัน</button>
                                        </div>
                                        </form>
                                    </div>
            
        </div>

<script>
    $("#updateBubble_btn").click(function(){

                
                var data = new FormData();

                //data.append("detail", myEditor.getData());

                //Form data
                var form_data = $('#editForm').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });
                
                var file_data = $('input[name="image"]')[0].files;
                    for (var i = 0; i < file_data.length; i++) {
                        data.append("image", file_data[i]);
                }

                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('highlight/update')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
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