<h4 class="card-title text-custom"> <i class="fas fa-pencil-alt"></i> แก้ไข Car Model </h4>
                                        <hr style="color:red!important;">
        <div class="dd" id="nestable2">
                                    <div class="basic-form">
                                        <form class="row" id="editForm" >
                                        <input type="hidden" class="form-control" name="id" value="<?php echo @$detail->id;?>">

                                        <div class="mb-3 col-12">
                                        <label class="text-custom form-label col-form-label-lg">ประเภท</label>
                                                <select class="default-select form-control wide mb-3" id="car_brand_id" name="car_brand_id">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($carBrandList)&&!empty($carBrandList))
                                                        {
                                                            foreach($carBrandList as $row)
                                                            {
                                                        ?>
                                                            <option <?php if(@$detail->car_brand_id==$row->id) echo 'selected';?> value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
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

                                        
                                        <div class="mb-3 mt-3">
                                            <button type="reset" class="btn btn-danger">ยกเลิก</button>
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

                var car_brand_id = document.getElementById("car_brand_id").value;
                data.append('car_brand_id', car_brand_id);

                
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('carmodel/update')?>',
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