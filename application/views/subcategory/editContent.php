<h4 class="card-title text-custom"> <i class="fas fa-pencil-alt"></i> แก้ไข Category </h4>
                                        <hr style="color:red!important;">
        <div class="dd" id="nestable2">
                                    <div class="basic-form">
                                        <form class="row" id="editForm" >
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>">

                                        <div class="mb-3 col-12">
                                        <label class="text-custom form-label col-form-label-lg">ประเภท</label>
                                                <select class="default-select form-control wide mb-3" id="content_type_id" name="content_type_id" onchange="contentTypeChange()">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($contentTypeList)&&!empty($contentTypeList))
                                                        {
                                                            foreach($contentTypeList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if(@$detail->content_type_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                        </div>

                                        <div class="mb-3 col-12 category" id="_categoryList">
                                        <?php 
                                        //console($detail);
                                        //echo $detail->product_category_id;
                                        //console($categoryList);
                                        ?>
                                        <label class="text-custom form-label col-form-label-lg">หมวดหมู่</label>
                                                <select class="default-select form-control wide mb-3" id="category_id" name="category_id" onchange="categoryChange()">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($categoryList)&&!empty($categoryList))
                                                        {
                                                            foreach($categoryList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if($detail->category_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ</label>
                                                <input type="text" class="form-control form-control-lg" name="title_th" value="<?php echo @$detail->title_th;?>">
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="title_en" value="<?php echo @$detail->title_en;?>">
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">คำอธิบาย</label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_th" maxlength="255"><?php echo @$detail->meta_description_th;?></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">คำอธิบาย <code>EN</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_en" maxlength="255"><?php echo @$detail->meta_description_en;?></textarea>
                                        </div>
                                        
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">รูปภาพ Cover</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        <div class="mb-3 col-2">
                                                <img src="<?php echo @$detail->image_url;?>" class="img-fluid"></img>
                                        </div>
                                        <input type="hidden" class="form-control" name="thumbnail_hidden" placeholder="" value="<?php echo @$detail->image;?>">
                                        
                                        
                                        <div class="mb-3 mt-3">
                                            <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                            <button id="updateBubble_btn" type="button" class="btn btn-success" style="float:right;" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md">ยืนยัน</button>
                                        </div>
                                        </form>
                                    </div>
            
        </div>

<script>
    function contentTypeChange(){
        
        content_type_id = document.getElementById("content_type_id").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('product/loadCategoryList')?>',
            data: 'content_type_id='+content_type_id+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_categoryList").html(result);
            }
        });
    } 

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

                var content_type_id = document.getElementById("content_type_id").value;
                data.append('content_type_id', content_type_id);


                var category_id = document.getElementById("category_id").value;
                data.append('category_id', category_id);

                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('subcategory/update')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
                                            //$('#result').html(result);
                                            
                                            if(result==true)
                                            {
                                                $('#result_modal').modal('show');
                                                setInterval(function() {
                                                    window.location.reload(true);
                                                }, 5000);
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }
                                            
                                            
                                        }
                                    });
         
    });
</script>