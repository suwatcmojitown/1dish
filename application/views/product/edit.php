<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('product');?>"><i class="fa fa-coffee" aria-hidden="true"></i> Product</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Edit</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> แก้ไข Product : <?php echo @$detail->name_th;?></h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>">
                                        <div class="mb-3 col-8">
                                                <label class="text-info form-label col-form-label-lg">ชื่อ</label>
                                                <input type="text" class="form-control form-control-lg" name="name_th" value="<?php echo @$detail->name_th;?>">
                                        </div>
                                        <div class="mb-3 col-8">
                                                <label class="text-info form-label col-form-label-lg">ชื่อ <code>EN</code></label>
                                                <input type="text" class="form-control form-control-lg" name="name_en" value="<?php echo @$detail->name_en;?>">
                                        </div>
                                        <div class="mb-3 col-5">
                                                <label class="text-info form-label col-form-label-lg">หน่วยสินค้า</label>
                                                <input type="text" class="form-control form-control-lg" name="unit" value="<?php echo @$detail->unit;?>">
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">รายละเอียด</code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_th"><?php echo @$detail->description_th;?></textarea>
                                        </div>
                                        <div class="mb-3 col-12">
                                                <label class="text-info form-label col-form-label-lg">รายละเอียด <code>EN</code></code></label>
                                                <textarea class="form-control form-control-lg" rows="4" name="description_en"><?php echo @$detail->description_en;?></textarea>
                                        </div>
                                        <div class="mb-3 col-5">
                                                <label class="text-info form-label col-form-label-lg">รูปภาพ</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        <div class="mb-3 col-3">
                                                <img src="<?php echo @$detail->thumbnail_path;?>"></img>
                                        </div>
                                        <input type="hidden" class="form-control" name="thumbnail_hidden" placeholder="" value="<?php echo @$detail->thumbnail;?>"> 
                                        <!--
                                        <div class="mb-3 col-12 category">
                                                <label class="text-info form-label col-form-label-lg" style="display:block;">หมวดหมู่</label>
                                                    <?php 
                                                    if(isset($categoryList)&&!empty($categoryList)){
                                                        foreach($categoryList as $row){
                                                    ?>
                                                    <button type="button" class="btn <?php if($detail->product_category_id!=$row->id) echo 'light';?> btn-info ma-7 mb-2 <?php if($detail->product_category_id==$row->id) echo 'active';?>" value="<?php echo $row->id?>" style="font-size: 16px;"><?php echo $row->name_th;?></button>
                                                    <?php 
                                                        }
                                                    }
                                                    ?>
                                        </div>
                                        -->
                                        <div class="mb-3 col-8 category">
                                        <label class="text-info form-label col-form-label-lg">หมวดหมู่</label>
                                                <select class="default-select form-control wide mb-3" name="product_category_id" >
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($categoryList)&&!empty($categoryList))
                                                        {
                                                            foreach($categoryList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if($detail->product_category_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->name_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>
                                        </div>

                                        <hr>
                                        <div class="mb-3 col-5">
                                                <label class="text-info form-label col-form-label-lg">คำนวณ Vat (%)</label>
                                                <!--
                                                <input type="text" class="form-control form-control-lg" name="calculate_vat" value="<?php echo @$detail->calculate_vat;?>">-->
                                                <select class="default-select form-control wide mb-3" name="calculate_vat" id="calculate_vat">
                                                    <option value="1" <?php if($detail->calculate_vat=='1') echo 'selected';?>>คำนวณ</option>
                                                    <option value="0" <?php if($detail->calculate_vat=='0') echo 'selected';?>>ไม่คำนวณ</option>
                                                </select>
                                        </div>

                                        <div class="mb-3 col-5">
                                                <label class="text-info form-label col-form-label-lg">คำนวณค่า Com (%)</label>
                                                <!--
                                                <input type="text" class="form-control form-control-lg" name="calculate_commision" value="<?php echo @$detail->calculate_commision;?>">
                                                -->
                                                <select class="default-select form-control wide mb-3" name="calculate_commission" id="calculate_commission">
                                                    <option value="1" <?php if($detail->calculate_commission=='1') echo 'selected';?>>คำนวณ</option>
                                                    <option value="0" <?php if($detail->calculate_commission=='0') echo 'selected';?>>ไม่คำนวณ</option>
                                                </select>
                                        </div>

                                        <div class="mb-3 col-5">
                                                <label class="text-info form-label col-form-label-lg">ราคาทุน (บาท)</label>
                                                <input type="text" class="form-control form-control-lg" name="cost" value="<?php echo @$detail->cost;?>">
                                        </div>

                                        <div class="mb-3 col-5">
                                                <label class="text-info form-label col-form-label-lg">ราคาหน้าร้าน (บาท)</label>
                                                <input type="text" class="form-control form-control-lg" name="price" value="<?php echo @$detail->price;?>">
                                        </div>
                                        
                                        <div class="mb-3 mb-0 col-5">
                                            <label class="text-info form-label col-form-label-lg">สถานะ</label>
                                            <select class="default-select form-control wide mb-3" name="status" id="status">
                                                <option value="1" <?php if($detail->status=='1') echo 'selected';?>>เปิดใช้งาน</option>
                                                <option value="0" <?php if($detail->status=='0') echo 'selected';?>>ไม่เปิดใช้งาน</option>
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
                                                            บันทึกไม่สำเร็จ เกิดข้อผิดพลาด กรุณาลองใหม่
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-primary">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

<script>
    var submitButton = $('#submit_btn');
    formContainer  = $('#addForm');
    $("#submit_btn").click(function(){
        
                var product_category_id = null;
        
                $(".category button").each(function(){ 
                    if($(this).hasClass("active")) { 
                        product_category_id = $(this).attr("value");
                    }
                });

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

                var calculate_vat = document.getElementById("calculate_vat").value;
                data.append('calculate_vat', calculate_vat);

                var calculate_commission = document.getElementById("calculate_commission").value;
                data.append('calculate_commission', calculate_commission);

                data.append('product_category_id', product_category_id);
                
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

    $('.category button').on('click', function(){
        $(this).addClass('active');
        $('.category button').not(this).removeClass('active');
        $('.category button').not(this).addClass('light');
        $(this).removeClass('light');
});

</script>