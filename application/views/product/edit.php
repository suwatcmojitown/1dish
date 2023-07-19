<div class="content-body">
            <!-- row --> 
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active "><a href="<?php echo base_url('product');?>" style="color:#ab0600!important;"><i class="fa fa-coffee text-custom" aria-hidden="true"></i> Product</a></li>
                        <li class="breadcrumb-item text-custom"><a href="javascript:void(0)">Edit</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">
                        <?php //console($detail);?>
                        <div class="card">
                            <div class="card-header bg-custom">
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> แก้ไข Product : <?php echo @$detail->title_th;?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>">
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ</label>
                                                <input type="text" class="form-control form-control-lg" name="title_th" value="<?php echo @$detail->title_th;?>">
                                                <small class="text-danger">* จำเป็นต้องใส่</small>
                                        </div>
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">ชื่อ <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="title_en" value="<?php echo @$detail->title_en;?>">
                                                <small class="text-danger">* จำเป็นต้องใส่</small>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">อธิบายเพิ่ม</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="subtitle_th" maxlength="255"><?php echo @$detail->subtitle_th;?></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">อธิบายเพิ่ม <code>EN</code></code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="subtitle_en" maxlength="255"><?php echo @$detail->subtitle_en;?></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">รายละเอียด</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_th" maxlength="255"><?php echo @$detail->description_th;?></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">รายละเอียด <code>EN</code></code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_en" maxlength="255"><?php echo @$detail->description_en;?></textarea>
                                        </div>
                                        <div class="mb-3 col-5">
                                                <label class="text-custom form-label col-form-label-lg">ราคา</label>
                                                <input type="text" class="form-control form-control-lg" name="price" value="<?php echo @$detail->price;?>">
                                                <small class="text-danger">* จำเป็นต้องใส่</small>
                                        </div>
                                        
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">รูปภาพ</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        <div class="mb-3 col-2">
                                                <img src="<?php echo @$detail->image_url;?>" class="img-fluid"></img>
                                        </div>
                                        <input type="hidden" class="form-control" name="thumbnail_hidden" placeholder="" value="<?php echo @$detail->image;?>"> 
                                        
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">คำอธิบายสินค้า</code></label>
                                                <div id="detail_th"><?php echo @$detail->detail_th;?></div>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">คำอธิบายสินค้า <code>EN</code></code></label>
                                                <div id="detail_en"><?php echo @$detail->detail_en;?></div>
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">Youtube Link</label>
                                                <input type="text" class="form-control form-control-lg" name="external_link" value="<?php echo @$detail->external_link;?>">
                                                <small class="text-muted">link ต้องเป็น link จากการ embed เช่น https://www.youtube.com/embed/5kW0RtcJZC8</small>
                                        </div>

                                        <div class="mb-3 col-5">
                                                <label class="text-custom form-label col-form-label-lg">หัวข้อ Youtube</label>
                                                <input type="text" class="form-control form-control-lg" name="external_link_title_th" value="<?php echo @$detail->external_link_title_th;?>">

                                        </div>

                                        <div class="mb-3 col-5">
                                                <label class="text-custom form-label col-form-label-lg">หัวข้อ Youtube <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="external_link_title_en" value="<?php echo @$detail->external_link_title_en;?>">
                                        </div>

                                        <hr>

                                        <div class="mb-3 col-4">
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

                                        <div class="mb-3 col-4 category" id="_categoryList">
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

                                        <div class="mb-3 col-4" id="_subCategoryList">
                                        <?php 
                                        //console($detail);
                                        //echo $detail->product_category_id;
                                        //console($categoryList);
                                        ?>
                                        <label class="text-custom form-label col-form-label-lg">หมวดหมู่ย่อย</label>
                                                <select class="default-select form-control wide mb-3" id="subcategory_id" name="subcategory_id" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($subCategoryList)&&!empty($subCategoryList))
                                                        {
                                                            foreach($subCategoryList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if($detail->subcategory_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                        </div>

                                        

                                        <div class="mb-3 col-5" >
                                        <?php 
                                        //console($detail);
                                        //echo $detail->product_category_id;
                                        //console($categoryList);
                                        ?>
                                        <label class="text-custom form-label col-form-label-lg">ยี่ห้อ</label>
                                                <select class="default-select form-control wide mb-1" id="car_brand_id" name="car_brand_id" onchange="carBrandChange()">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($carBrandList)&&!empty($carBrandList))
                                                        {
                                                            foreach($carBrandList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if($detail->car_brand_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                                <small class="text-muted">เลือกเมื่อเป็นประเภทโช๊คฝากระโปรง</small>
                                        </div>

                                        <div class="mb-3 col-5" id="_carModelList">
                                        <?php 
                                        //console($detail);
                                        //echo $detail->product_category_id;
                                        //console($categoryList);
                                        ?>
                                        <label class="text-custom form-label col-form-label-lg">รุ่น</label>
                                                <select class="default-select form-control wide mb-1" id="car_model_id" name="car_model_id" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($carModelList)&&!empty($carModelList))
                                                        {
                                                            foreach($carModelList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if($detail->car_model_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                                <small class="text-muted">เลือกเมื่อเป็นประเภทโช๊คฝากระโปรง</small>
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">ปีรถ</label>
                                                <input type="text" class="form-control form-control-lg" name="year" value="<?php echo @$detail->year;?>">
                                                <small class="text-muted">ตัวอย่าง : 2013,2014,2015</small>
                                        </div>

                                        <hr>

                                        <div class="mb-3 col-4">
                                                <label class="text-custom form-label col-form-label-lg">Link lazada</label>
                                                <input type="text" class="form-control form-control-lg" name="link_lazada" value="<?php echo @$detail->link_lazada;?>">
                                        </div>

                                        <div class="mb-3 col-4">
                                                <label class="text-custom form-label col-form-label-lg">Link Shopee</label>
                                                <input type="text" class="form-control form-control-lg" name="link_shopee" value="<?php echo @$detail->link_shopee;?>">
                                        </div>

                                        <div class="mb-3 col-4">
                                                <label class="text-custom form-label col-form-label-lg">Link Tiktok</label>
                                                <input type="text" class="form-control form-control-lg" name="link_tiktok" value="<?php echo @$detail->link_tiktok;?>">
                                        </div>

                                        <div class="mb-3 col-12">
                                                <label class="text-custom form-label col-form-label-lg">Keyword</label>
                                                <input type="text" class="form-control form-control-lg" name="keyword" value="<?php echo @$detail->keyword;?>">
                                        </div>

                                        <div class="mb-3 mb-0 col-6">
                                            <label class="text-custom form-label col-form-label-lg">Best Seller</label>
                                            <select class="default-select form-control wide mb-3" name="best_seller" id="best_seller">
                                                <option value="1" <?php if($detail->best_seller=='1') echo 'selected';?>>เปิดใช้งาน</option>
                                                <option value="0" <?php if($detail->best_seller=='0') echo 'selected';?>>ไม่เปิดใช้งาน</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 mb-0 col-6">
                                            <label class="text-custom form-label col-form-label-lg">Recommend</label>
                                            <select class="default-select form-control wide mb-3" name="recommended" id="recommended">
                                                <option value="1" <?php if($detail->recommended=='1') echo 'selected';?>>เปิดใช้งาน</option>
                                                <option value="0" <?php if($detail->recommended=='0') echo 'selected';?>>ไม่เปิดใช้งาน</option>
                                            </select>
                                        </div>
                                        
                                        <div class="mb-3 mb-0 col-5">
                                            <label class="text-custom form-label col-form-label-lg">สถานะ</label>
                                            <select class="default-select form-control wide mb-3" name="status" id="status">
                                                <option value="1" <?php if($detail->status=='1') echo 'selected';?>>เปิดใช้งาน</option>
                                                <option value="0" <?php if($detail->status=='0') echo 'selected';?>>ไม่เปิดใช้งาน</option>
                                            </select>
                                        </div>

                                        <hr>

                                        <div class="mb-3 col-6">
                                                <label class="text-custom form-label col-form-label-lg">สร้าง</label>
                                                <input type="text" class="form-control form-control-lg" value="<?php echo @$detail->created_by.' - '.$detail->created_at;?>" readonly>
                                        </div>

                                        <div class="mb-3 col-6">
                                                <label class="text-custom form-label col-form-label-lg">แก้ไขล่าสุด</label>
                                                <input type="text" class="form-control form-control-lg" value="<?php echo @$detail->updated_by.' - '.$detail->updated_at;?>">
                                        </div>
                                        <div class="mb-3 mt-3">
                                            <a href="<?php echo base_url('product');?>"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
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
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
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
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
<script>
        new FroalaEditor('#detail_th',{
        // Set the file upload URL.
        key: "2J1B10dA5B4F4C3A3C3I3C-22VKOG1FGULVKHXDXNDXc2a1Kd1SNdF3H3A8B5D4A3C3E3B2A13==",
        imageUploadURL: '<?php echo base_url('upload_image.php')?>',
        imageUploadParams: {
            id: 'my_editor'
        }
        });
        new FroalaEditor('#detail_en',{
        // Set the file upload URL.
        key: "2J1B10dA5B4F4C3A3C3I3C-22VKOG1FGULVKHXDXNDXc2a1Kd1SNdF3H3A8B5D4A3C3E3B2A13==",
        imageUploadURL: '<?php echo base_url('upload_image.php')?>',
        imageUploadParams: {
            id: 'my_editor'
        }
        });
</script> 
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

                var content_type_id = document.getElementById("content_type_id").value;
                data.append('content_type_id', content_type_id);

                var category_id = document.getElementById("category_id").value;
                data.append('category_id', category_id);

                var subcategory_id = document.getElementById("subcategory_id").value;
                data.append('subcategory_id', subcategory_id);

                var car_brand_id = document.getElementById("car_brand_id").value;
                data.append('car_brand_id', car_brand_id);

                var car_model_id = document.getElementById("car_model_id").value;
                data.append('car_model_id', car_model_id);

                var recommended = document.getElementById("recommended").value;
                data.append('recommended', recommended);

                var best_seller = document.getElementById("best_seller").value;
                data.append('best_seller', best_seller);
                
                var editor = new FroalaEditor('#detail_th');
                data.append('detail_th', editor.html.get());

                var editor = new FroalaEditor('#detail_en');
                data.append('detail_en', editor.html.get());
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('product/update')?>',
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

    function categoryChange(){
        
        category_id = document.getElementById("category_id").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('product/loadSubCategoryList')?>',
            data: 'category_id='+category_id+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subCategoryList").html(result);
            }
        });
    } 



    function carBrandChange(){
        
        car_brand_id = document.getElementById("car_brand_id").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('product/loadCarModelList')?>',
            data: 'car_brand_id='+car_brand_id+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_carModelList").html(result);
            }
        });
    } 

</script>