
    <!-- Nestable -->
    <link href="<?php echo base_url()?>app-assets/vendor/nestable2/css/jquery.nestable.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
        <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/style.css" rel="stylesheet">

    <style>
        .dd-handle.custom{
            background-color: white!important;
        }
    </style>


<div class="content-body">
    <div class="container-fluid">

        <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #ab0600;">
                                <h4 class="card-title text-white" > <i class="lni lni-cart"></i> จัดการ Subcatgory </h4>
                            </div>

                            <div class="cf nestable-lists card-body">
                                <div class="row">
                                    <?php 
                                    //console($selectList);
                                    ?>
                                    <div class="col-md-7">
                                        <div class="card-content">
                                        <div class="dd" id="nestable">
                                            <ol class="dd-list" >
                                                <?php 
                                                        if(isset($selectList)&&!empty($selectList)){
                                                        foreach($selectList as $row){
                                                        ?>
                                                        <li class="dd-item" data-id="<?php echo @$row->product_id;?>" style="z-index: 100;">
                                                            <div class="dd-handle custom ">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <img style="max-height: 70px;max-width: 140px;display: inline;" src="<?php echo @$row->image_url;?>">
                                                                        </div>
                                                                    <div class="col-5">
                                                                        <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th;?></h4>
                                                                        <normal style="display:block;" > 
                                                                        <span class="text-custom" style="font-weight: 300!important;font-size: 1.2rem;"><?php echo @$row->title_en;?></span>
                                                                        </normal>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <button onclick="deleteContent(<?php echo $row->id;?>)" type="button" class="btn btn-danger btn-sm" style="float:right;"><i class="fa fa-trash"></i></button>
                                                                        <button onclick="editContent(<?php echo $row->id;?>)" type="button" class="btn btn-warning btn-sm" style="float:right;margin-right: 4px;"><i class="fa fa-pencil-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php 
                                                        }
                                                        }
                                                        ?>
            </ol>
        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <div class="card-content" id="_edit">
                                        <h4 class="card-title text-custom"> <i class="fas fa-pencil-alt"></i> เพิ่ม Subcategory </h4>
                                        <hr style="color:red!important;">
        <div class="dd" id="nestable2">
                                    <div class="basic-form">
                                        <form class="row" id="addForm" >

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
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
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
                                                <select class="default-select form-control wide mb-3" id="category_id" name="category_id" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                </select>
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ</label>
                                                <input type="text" class="form-control form-control-lg" name="title_th">
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="title_en" >
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">คำอธิบาย</label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_th" maxlength="255"></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">คำอธิบาย <code>EN</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_en" maxlength="255"></textarea>
                                        </div>
                                        
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">รูปภาพ Cover</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        
                                        
                                        <div class="mb-3 mt-3">
                                            <button type="reset" class="btn btn-danger">ยกเลิก</button>
                                            <button id="submit_btn" type="button" class="btn btn-success" style="float:right;" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md">ยืนยัน</button>
                                        </div>
                                        </form>
                                    </div>
            
        </div>
                                    </div>
                                    </div>

    </div>

    <div id="result"></div>

    

                </div>
            </div>
            </div>
    </div>
</div>
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
                                                            <a href="<?php echo base_url('subcategory');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('subcategory');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--  modal status -->

<script>

    function deleteContent(id){
        //alert(id);
        $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('subcategory/deleteContentItem')?>',
                    data: 'id='+id+'',
                    success: function(result) { 
                        //$('#result').html(result);
                        $("#nestable").html(result);
                    } 
        });
        
    }

    function editContent(id){
                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('subcategory/edit')?>',
                                        data: 'id='+id,
                                        success: function(result) { 
                                            $("#_edit").html(result);
                                        } 
                    });
       
    }

    formContainer  = $('#addForm');
    $("#submit_btn").click(function(){
        
                var data = new FormData();

                //Form data
                var form_data = $('#addForm').serializeArray();
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
                                        url: '<?php echo base_url('subcategory/add')?>',
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
</script>
