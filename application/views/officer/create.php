<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
              <div class="row">
                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-plus"></i> สร้างผู้ใช้งาน</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="<?php echo base_url('officer/list')?>"><span class="text-light"><strong>ผู้ใช้งาน</strong></span></a>
                                        </span>
                                    </header>
                  
                            </section>
                    </div>
            </div>
            <style>
            .wizard > .content
            {
                /*background: #eee;*/
                border: 1px solid #eee;
                display: block;
                margin: 0.5em;
                height: 700px;
                position: relative;
                width: auto;
                padding: 20px;

                -webkit-border-radius: 5px;
                -moz-border-radius: 5px;
                border-radius: 5px;
            }
            </style>
            <div class="row">
                  <div class="col-lg-12">
                        <section class="card">
                                <div class="card-body">
                                    <form id="addForm" method="post" enctype="multipart/form-data">
                                        <div>
                                            <h3><strong>ข้อมูลส่วนตัว</strong></h3>
                                            <section>
                                                    <div class="row">
                                                            <div class="col-lg-9">
                                                                    <header class="card-header text-info">
                                                                        ข้อมูลส่วนตัว
                                                                    </header>
                                                                    <div class="card-body">
                                                                            <div class="form-row  clearfix">
                                                                                    <div class="col-md-3">
                                                                                            <div class="form-group">
                                                                                                <label >คำนำหน้า</label>
                                                                                                <select class="form-control custom-select text-muted" id="name_title" name="name_title" >
                                                                                                        <option value="">-- คำนำหน้า --</option>
                                                                                                        <option value="1">นาย</option>
                                                                                                        <option value="2">นาง</option>
                                                                                                        <option value="3">นางสาว</option>
                                                                                                </select>
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-md-4">
                                                                                            <div class="form-group">
                                                                                                <label >ชื่อ</label>
                                                                                                <input type="text" class="form-control" name="firstname" id="firstname"  >
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 ">
                                                                                            <div class="form-group">
                                                                                            <label >นามสกุล</label>
                                                                                            <input type="text" class="form-control" name="lastname" id="lastname"  >
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-11 ">
                                                                                            <div class="form-group">
                                                                                            <label for="validationCustom03">ที่อยู่</label>
                                                                                            <textarea class="form-control" name="address" id="address" ></textarea>
                                                                                            </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="col-md-3 ">
                                                                                        <div class="form-group">
                                                                                            <label>จังหวัด</label>
                                                                                            <select class="form-control custom-select text-muted" id="province_id" name="province_id" onchange="provinceChange()">
                                                                                                <option value="">-- เลือกจังหวัด --</option>
                                                                                                <?php 
                                                                                                if($provinceList)
                                                                                                {
                                                                                                foreach($provinceList as $row)
                                                                                                {
                                                                                                ?>
                                                                                                <option value="<?php echo $row->province_id?>"><?php echo $row->province_name;?></option>
                                                                                                <?php 
                                                                                                }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 " id="_district">
                                                                                            <label for="validationCustom03">อำเภอ</label>
                                                                                            <select class="form-control custom-select text-muted" id="district_id" name="district_id" >
                                                                                                    <option value="">-- เลือกอำเภอ --</option>
                                                                                            </select>
                                                                                    </div>
                                                                                    <div class="col-md-3" id="_subdistrict">
                                                                                            <label for="validationCustom03">ตำบล</label>
                                                                                            <select class="form-control custom-select text-muted" id="subdistrict_id" name="subdistrict_id" >
                                                                                                    <option value="">-- เลือกตำบล --</option>
                                                                                            </select>
                                                                                    </div>
                                                                                    <div class="col-md-2 ">
                                                                                            <label for="validationCustom03">รหัสไปรษณีย์</label>
                                                                                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="" >
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">รหัสประชาชน</label>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-1">
                                                                                                        <input type="text" id="txtID1" name="txtID1" class="form-control" maxlength=1 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" >
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span>   
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="txtID2" name="txtID2" class="form-control" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" >  
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="txtID3" name="txtID3" class="form-control" maxlength=5 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" >  
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="txtID4" name="txtID4" class="form-control" maxlength=2 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" > 
                                                                                                    </div> 
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-1">
                                                                                                        <input type="text" id="txtID5" name="txtID5" class="form-control" maxlength=1 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" > 
                                                                                                    </div> 
                                                                                                </div>     
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">ภาพบัตรประชาชน</label>
                                                                                                <input type="file" id="id_card_img" name="id_card_img" class="dropify" />        
                                                                                            </div>
                                                                                    </div>
                                                                            </div>  
                                                                    </div>
                                                                    
                                                            </div>
                                                            <div class="col-lg-3">
                                                                    <header class="card-header text-info">
                                                                        ข้อมูลเพิ่มเติม
                                                                    </header>
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                                <label>วัน/เดือน/ปี เกิด</label>
                                                                                <input type="text" class="form-control date-picker-input" id="birthdate" name="birthdate" placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>เพศ</label>
                                                                                <select class="form-control custom-select text-muted" id="gender" name="gender">
                                                                                        <option value="">-- เลือกเพศ --</option>
                                                                                        <option value="M">ชาย</option>
                                                                                        <option value="F">หญิง</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>เบอร์โทรศัพท์</label>
                                                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="xxxxxxxxxx ไม่ต้องเว้นวรรค">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                            </section>
                                            <h3>การศึกษา</h3>
                                            <section >
                                                <div class="row">
                                                        <div class="col-lg-12">
                                                                <div class="card-body">
                                                                        <div class="form-row  clearfix">
                                                                                <div class="col-md-4 ">
                                                                                        <label >ปริญญาตรี มหาวิทยาลัย</label>
                                                                                        <input type="text" class="form-control" id="university-1" name="university-1" value="" >
                                                                                        <input type="hidden" class="form-control " id="bachelor_university_id" name="bachelor_university_id" value="">
                                                                                        <div id="suggesstion-box"></div>
                                                                                </div>
                                                                                <script>
                                                                                        $("#university-1").keyup(function(){
                                                                                                $.ajax({
                                                                                                type: "POST",
                                                                                                url: "<?php echo base_url('profile/university')?>",
                                                                                                data:'keyword='+$(this).val()+'&type=1',
                                                                                                success: function(data){
                                                                                                $("#suggesstion-box").show();
                                                                                                $("#suggesstion-box").html(data);
                                                                                                $("#university").css("background","#FFF");
                                                                                                }
                                                                                                });
                                                                                        });
                                                                                        function selectUniversity1(val,id) {
                                                                                                $("#university-1").val(val);
                                                                                                $("#bachelor_university_id").val(id);
                                                                                                $("#suggesstion-box").hide();
                                                                                        }
                                                                                </script>
                                                                                <div class="col-md-4 ">
                                                                                            <label >คณะ</label>
                                                                                            <input type="text" class="form-control" id="bachelor_faculty" name="bachelor_faculty" value="" >
                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                        <label >เอก</label>
                                                                                        <input type="text" class="form-control" id="bachelor_major" name="bachelor_major" value="" >
                                                                                </div>
                                                                        </div>
                        
                                                                        <div class="form-row  clearfix">
                                                                                <div class="col-md-4 ">
                                                                                        <label >ปริญญาโท มหาวิทยาลัย</label>
                                                                                        <input type="text" class="form-control" id="university-2" name="university-2" value="" >
                                                                                        <input type="hidden" class="form-control " id="master_university_id" name="master_university_id" value="">
                                                                                        <div id="suggesstion-box-2"></div>
                                                                                </div>
                                                                                <script>
                                                                                        $("#university-2").keyup(function(){
                                                                                                $.ajax({
                                                                                                type: "POST",
                                                                                                url: "<?php echo base_url('profile/university')?>",
                                                                                                data:'keyword='+$(this).val()+'&type=2',
                                                                                                success: function(data){
                                                                                                $("#suggesstion-box-2").show();
                                                                                                $("#suggesstion-box-2").html(data);
                                                                                                $("#university").css("background","#FFF");
                                                                                                }
                                                                                                });
                                                                                        });
                                                                                        function selectUniversity2(val,id) {
                                                                                                $("#university-2").val(val);
                                                                                                $("#master_university_id").val(id);
                                                                                                $("#suggesstion-box-2").hide();
                                                                                        }
                                                                                </script>
                                                                                <div class="col-md-4 ">
                                                                                            <label >คณะ</label>
                                                                                            <input type="text" class="form-control" id="master_faculty" name="master_faculty" value="" >
                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                        <label >เอก</label>
                                                                                        <input type="text" class="form-control" id="master_major" name="master_major" value="" >
                                                                                </div>
                                                                        </div>
                        
                                                                        <div class="form-row  clearfix">
                                                                                <div class="col-md-4 ">
                                                                                        <label >ปริญญาเอก มหาวิทยาลัย</label>
                                                                                        <input type="text" class="form-control" id="university-3" name="university-3" value="" >
                                                                                        <input type="hidden" class="form-control " id="doctor_university_id" name="doctor_university_id" value="">
                                                                                        <div id="suggesstion-box-3"></div>
                                                                                </div>
                                                                                <script>
                                                                                        $("#university-3").keyup(function(){
                                                                                                $.ajax({
                                                                                                type: "POST",
                                                                                                url: "<?php echo base_url('profile/university')?>",
                                                                                                data:'keyword='+$(this).val()+'&type=3',
                                                                                                success: function(data){
                                                                                                $("#suggesstion-box-3").show();
                                                                                                $("#suggesstion-box-3").html(data);
                                                                                                $("#university").css("background","#FFF");
                                                                                                }
                                                                                                });
                                                                                        });
                                                                                        function selectUniversity3(val,id) {
                                                                                                $("#university-3").val(val);
                                                                                                $("#doctor_university_id").val(id);
                                                                                                $("#suggesstion-box-3").hide();
                                                                                        }
                                                                                </script>
                                                                                <div class="col-md-4 ">
                                                                                            <label >คณะ</label>
                                                                                            <input type="text" class="form-control" id="doctor_faculty" name="doctor_faculty" value="" >
                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                        <label >เอก</label>
                                                                                        <input type="text" class="form-control" id="doctor_major" name="doctor_major" value="" >
                                                                                </div>
                                                                        </div>     
                                                                </div>
                                                        </div>
                                                    </div>
                                                      
                                            </section>
                                            <h3>Display & social</h3>
                                            <section>
                                                    <div class="row">
                                                            <div class="col-lg-6">
                                                                    <header class="card-header text-info">
                                                                        Profile
                                                                    </header>
                                                                    <div class="card-body">
                                                                            <div class="form-group">
                                                                                    <label>Display Name</label>
                                                                                    <input type="text" class="form-control" id="displayname" name="displayname" placeholder="">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                    <label>ภาพ</label>
                                                                                    <input type="file" id="avatar" name="avatar" class="dropify" />
                                                                            </div>
                                                                            <div class="form-group">
                                                                                    <label>คำอธิบายประวัติคร่าวๆ</label>
                                                                                    <textarea class="form-control" id="profile_background" name="profile_background" ></textarea>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Email</label>
                                                                                <input type="text" class="form-control" id="email" name="email"  placeholder="สำหรับเข้าใช้งานระบบ">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>รหัสผ่าน</label>
                                                                                <input type="text" class="form-control" id="password" name="password" placeholder="สำหรับเข้าใช้งานระบบ">
                                                                            </div>
                                                                    </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                    <header class="card-header text-info">
                                                                        Social
                                                                    </header>
                                                                    <div class="card-body">
                                                                        <div class="form-group">
                                                                                <label>Facebook</label>
                                                                                <input type="text" class="form-control" id="facebook" name="facebook" placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>Line ID</label>
                                                                                <input type="text" class="form-control" id="line_id" name="line_id" placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>Youtube Channel</label>
                                                                                <input type="text" class="form-control" id="youtube" name="youtube" placeholder="">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>TikTok</label>
                                                                                <input type="text" class="form-control" id="tiktok" name="tiktok" placeholder="">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                          
                                            </section>
                                            <h3>บัญชีธนาคาร</h3>
                                            <section>
                                                    <div class="row">
                                                            <div class="col-lg-12">
                                                                    <div class="card-body">
                                                                            <div class="form-row  clearfix">
                                                                                    <div class="col-md-4 ">
                                                                                        <div class="form-group">
                                                                                            <label for="validationCustom03">ธนาคาร</label>
                                                                                            <select class="form-control custom-select text-muted" id="bank_id" name="bank_id" onchange="provinceChange()">
                                                                                                <option value="">-- เลือกธนาคาร --</option>
                                                                                                <?php 
                                                                                                if($bankList)
                                                                                                {
                                                                                                        foreach($bankList as $row)
                                                                                                        {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $row->bank_id?>"><?php echo $row->bank_name;?></option>
                                                                                                        <?php 
                                                                                                        }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 ">
                                                                                            <label for="validationCustom03">สาขา</label>
                                                                                            <input type="text" class="form-control" id="bank_branch" name="bank_branch" placeholder="">
                                                                                    </div>
                                                                                    <div class="col-md-4 ">
                                                                                            <label for="validationCustom03">ประเภทบัญชี</label>
                                                                                            <select class="form-control custom-select text-muted" id="book_bank_type" name="book_bank_type" >
                                                                                                    <option value="">-- เลือกประเภทบัญชี --</option>
                                                                                                    <option value="1">ออมทรัพย์</option>
                                                                                                    <option value="2">กระแสรายวัน</option>
                                                                                            </select>
                                                                                    </div>

                                                                                    <div class="col-md-6 ">
                                                                                            <label for="validationCustom03">ชื่อบัญชี</label>
                                                                                            <input type="text" class="form-control" id="book_bank_name" name="book_bank_name" placeholder="">
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">เลขบัญชีธนาคาร</label>
                                                                                                <div class="row">
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="bookBankID1" name="bookBankID1" class="form-control" maxlength=3 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" >
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span>   
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="bookBankID2" name="bookBankID2" class="form-control" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" >  
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="bookBankID3" name="bookBankID3" class="form-control" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" >  
                                                                                                    </div>
                                                                                                </div>     
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">หน้าบัญชีธนาคาร</label>
                                                                                                <input type="file" id="book_bank_img" name="book_bank_img" class="dropify"/>        
                                                                                            </div>
                                                                                    </div>
                                                                            </div>  
                                                                    </div>
                                                                    
                                                            </div>
                                                        </div>
      
                                            </section>
                                        </div>
                                    </form>
                                </div>
                            </section>
                  </div>
              </div>

              
                
              <!-- page end-->
          </section>
      </section>

<span id="result"></span>

<script type="text/javascript">

function provinceChange(){
        province_id = document.getElementById("province_id").value;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('profile/loadDistrict')?>',
                data: 'province_id='+province_id+'',
                success: function(result) { 
                    $("#_district").html(result);
                    //$("#_subdistrict").html('<div class="form-group"><label for="wfirstName2"> ตำบล : <span class="danger">*</span> </label><select class="custom-select form-control " id="subdistrict_id" name="subdistrict_id"><option value="">-- Select --</option></select></div>');
                }
            });
}

function createContent()
{
        var data = new FormData();

        //Form data
        var form_data = $('#addForm').serializeArray();
        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });
        
        //File data
        var file_data = $('input[name="id_card_img"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("id_card_img", file_data[i]);
        }

        var file_data = $('input[name="avatar"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("avatar", file_data[i]);
        }
        
        var file_data = $('input[name="book_bank_img"]')[0].files;
        for (var i = 0; i < file_data.length; i++) {
            data.append("book_bank_img", file_data[i]);
        }
        
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('officer/add')?>',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(result) { 
                        
                        //$("#result").html(result);
                        
                        if(result==true)
                        {
                                toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','เพิ่มผู้ใช้งาน');
                                setTimeout(function() { 
                                        var url = "<?php echo base_url('officer/list');?>";    
                                        $(location).attr('href',url);
                                }, 3000);
                        } 
                        else{
                                toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','เพิ่มผู้ใช้งาน');                            
                        } 
                   }
                });
}






            $(document).ready(function () {
                var form = $("#addForm");
                form.validate({
                    errorPlacement: function errorPlacement(error, element) {
                        element.after(error);
                    }
                });
                form.children("div").steps({
                    headerTag: "h3",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    onStepChanging: function (event, currentIndex, newIndex) {
                        form.validate().settings.ignore = ":disabled,:hidden";
                        return form.valid();
                    },
                    onFinishing: function (event, currentIndex) {
                        form.validate().settings.ignore = ":disabled";
                        return form.valid();
                    },
                    onFinished: function (event, currentIndex) {
                        createContent();  
                    }
                }).validate({
                    errorPlacement: function errorPlacement(error, element) {
                        element.after(error);
                    },
                    rules: {
                        confirm: {
                            equalTo: "#password"
                        }
                    }
                });
            });

    
</script>