<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <form id="addForm">
                <div class="row">

                        <div class="col-lg-12">
                                <section class="card">
                                        <header class="card-header bg-info text-light">
                                            <span ><strong><i class="fa fa-plus"></i> สร้างวิชา</strong></span>
                                            <span class="pull-right">
                                                    หน้าหลัก > 
                                                    <a href="<?php echo base_url('subject/list')?>"><span class="text-light"><strong>วิชา</strong></span></a>
                                            </span>
                                        </header>
                      
                                </section>
                        </div>
                    
                        <div class="col-lg-7">
                            <section class="card">
                                        <header class="card-header head-border text-info">
                                            ข้อมูลวิชา
                                        </header>
                                        <div class="card-body">
                                            
                                                <div class="form-group row">
                                                        <label for="title" class="col-sm-2 col-form-label">วิชา<span class="text-danger"> *</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="title" required>
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label for="slug" class="col-sm-2 col-form-label">slug<span class="text-danger"> *</span></label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" name="slug" required>
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label for="slug" class="col-sm-2 col-form-label">หัวข้อ</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" name="meta_title" >
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">คำอธิบาย</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="description" class="form-control" rows="3" placeholder="ไม่เกิน 250 ตัวอักษร" ></textarea>
                                                        </div>
                                                </div>

                                                

                                                
                                        </div>
                            </section>

                            <section class="card">
                                    <header class="card-header text-info">
                                        ส่วนเสริม SEO
                                    </header>
                                    <div class="card-body">
                                        
                                            <div class="form-group row">
                                                    <label for="meta_description" class="col-sm-3 col-form-label">Meta Description</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="meta_description">
                                                    </div>
                                            </div>

                                            <div class="form-group row">
                                                    <label for="meta_keyword" class="col-sm-3 col-form-label">Meta Keywords</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="meta_keyword">
                                                    </div>
                                            </div>
                                    </div>
                            </section>
                        </div>

                        <div class="col-lg-5">
                            
                                <section class="card">
                                        <header class="card-header text-info">
                                            รูปภาพ
                                        </header>
                                        <div class="card-body">
                                            
                                                <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">หน้าปก</label>
                                                        <div class="col-sm-10">
                                                                <input type="file" id="cover_image" name="cover_image" class="dropify" style="height: 150px!important;"/>
                                                                <small id="emailHelp" class="form-text text-muted">ขนาดแนะนำ xxx x xxxx pixel</small>
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label for="" class="col-sm-2 col-form-label">ไอคอน</label>
                                                        <div class="col-sm-10">
                                                                <input type="file" id="icon" name="icon" class="dropify" style="height: 150px!important;"/>
                                                                <small id="emailHelp" class="form-text text-muted">ขนาดแนะนำ xxx x xxxx pixel</small>
                                                        </div>
                                                </div>
                                        </div>
                                </section>

                                
                        </div>
                        
                        <div class="col-lg-12">
                                <section class="card">
                                    <div class="card-body">
                                            <div class="form-group row">
                                                    <div class="col-lg-2">
                                                        <a href="<?php echo base_url('subject/list')?>"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i> ยกเลิก</button></a>
                                                    </div>
                                                    <div class="offset-lg-7 col-lg-3 ">
                                                        <button class="btn btn-success pull-right" type="button" id="submit_btn"><i class="fa fa-check"></i> บันทึก</button>
                                                    </div>
                                            </div>
                                    </div>
                                </section>
                        </div>
                    </div>
                    </form>
              <!-- page end-->
          </section>
      </section>

      <span id="result"></span>
<script>
var submitButton = $('#submit_btn'),
check_req = 0;
formContainer  = $('#addForm');
$("#submit_btn").click(function(){

      formContainer.find('input').each(function(index,ele){
        if($(this).prop('required') && $(this).val() == ""){
            var error  = "กรุณากรอกข้อมูลให้ครบถ้วน";
                ele.after(error);
                check_req = check_req+1;
        }
        
     });
     if(check_req==0)
     {
         
            var data = new FormData();

            //Form data
            var form_data = $('#addForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            //File data
            var file_data = $('input[name="icon"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("icon", file_data[i]);
            }

            //File data
            var file_data = $('input[name="cover_image"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("cover_image", file_data[i]);
            }
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('subject/add')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) {  
                                        $('#result').html(result);
                                        if(result==true)
                                        {
                                            toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','เพิ่มวิชา');
                                            setTimeout(function() { 
                                                var url = "<?php echo base_url('subject/list');?>";    
                                                $(location).attr('href',url);
                                            }, 3000);
                                        } 
                                        else{
                                            toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','เพิ่มวิชา');
                                        }
                                    }
                                });
     }
});

</script>