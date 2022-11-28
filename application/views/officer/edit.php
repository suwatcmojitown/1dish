<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              
              <div class="row">
                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-pencil"></i> แก้ไขผู้ใช้งาน</strong></span>
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

                                                                                    <input type="hidden" class="form-control" name="id" placeholder="" value="<?php echo @$detail->id;?>">
                                                
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
                                                                                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo @$detail->firstname;?>" >
                                                                                            </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 ">
                                                                                            <div class="form-group">
                                                                                            <label >นามสกุล</label>
                                                                                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo @$detail->lastname;?>" >
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-11 ">
                                                                                            <div class="form-group">
                                                                                            <label for="validationCustom03">ที่อยู่</label>
                                                                                            <textarea class="form-control" name="address" id="address" ><?php echo @$detail->address;?></textarea>
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
                                                                                                <option value="<?php echo $row->province_id?>" <?php if(@$detail->province_id==$row->province_id)echo 'selected';?>><?php echo $row->province_name;?></option>
                                                                                                <?php 
                                                                                                }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-3 " id="_district">
                                                                                            <label for="validationCustom03">อำเภอ</label>
                                                                                            <select class="form-control custom-select text-muted" id="district_id" name="district_id" onchange="districtChange()">
                                                                                                    <option value="">-- เลือกอำเภอ --</option>
                                                                                                    <?php 
                                                                                                        if($districtList)
                                                                                                        {
                                                                                                                foreach($districtList as $row){
                                                                                                        ?>
                                                                                                                <option value="<?php echo $row->district_id?>" <?php if(@$detail->district_id==$row->district_id)echo 'selected';?>><?php echo $row->district_name;?></option>
                                                                                                        <?php 
                                                                                                                }
                                                                                                        }
                                                                                                        ?>
                                                                                            </select>
                                                                                    </div>
                                                                                    <div class="col-md-3" id="_subdistrict">
                                                                                            <label for="validationCustom03">ตำบล</label>
                                                                                            <select class="form-control custom-select text-muted" id="subdistrict_id" name="subdistrict_id" >
                                                                                                    <option value="">-- เลือกตำบล --</option>
                                                                                                    <?php 
                                                                                                        if($subDistrictList)
                                                                                                        {
                                                                                                                foreach($subDistrictList as $row){
                                                                                                                ?>
                                                                                                                        <option value="<?php echo $row->subdistrict_id?>" <?php if(@$detail->subdistrict_id==$row->subdistrict_id)echo 'selected';?>><?php echo $row->subdistrict_name;?></option>
                                                                                                                <?php 
                                                                                                                }
                                                                                                        }
                                                                                                    ?>
                                                                                            </select>
                                                                                    </div>
                                                                                    <div class="col-md-2 ">
                                                                                            <label for="validationCustom03">รหัสไปรษณีย์</label>
                                                                                            <input type="text" class="form-control" id="zipcode" name="zipcode" value="<?php echo @$detail->zipcode?>">
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">รหัสประชาชน</label>
                                                                                                <div class="row">
                                                                                                        <?php 
                                                                                                        $id_card = @$detail->idcard;
                                                                                                        $id_1 = substr($id_card,0,1);
                                                                                                        $id_2 = substr($id_card,1,4);
                                                                                                        $id_3 = substr($id_card,5,5);
                                                                                                        $id_4 = substr($id_card,10,2);
                                                                                                        $id_5 = substr($id_card,12,1);
                                                                                                        ?>    
                                                                                                    <div class="col-md-1">
                                                                                                        <input type="text" id="txtID1" name="txtID1" class="form-control" maxlength=1 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo $id_1;?>">
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span>   
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="txtID2" name="txtID2" class="form-control" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo $id_2;?>">  
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="txtID3" name="txtID3" class="form-control" maxlength=5 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo $id_3;?>">  
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="txtID4" name="txtID4" class="form-control" maxlength=2 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo $id_4;?>"> 
                                                                                                    </div> 
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-1">
                                                                                                        <input type="text" id="txtID5" name="txtID5" class="form-control" maxlength=1 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo $id_5;?>"> 
                                                                                                    </div> 
                                                                                                </div>     
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">ภาพบัตรประชาชน</label>
                                                                                                <input type="file" id="id_card_img" name="id_card_img" class="dropify" data-default-file="<?php echo @$detail->id_card_img_path;?>"/> 
                                                                                                <input type="hidden" class="form-control" name="id_card_hidden" placeholder="" value="<?php echo @$detail->id_card_img;?>">       
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
                                                                                <input type="text" class="form-control date-picker-input" id="birthdate" name="birthdate" placeholder="" value="<?php echo @$detail->birthdate;?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>เพศ</label>
                                                                                <select class="form-control custom-select text-muted" id="gender" name="gender">
                                                                                        <option value="">-- เลือกเพศ --</option>
                                                                                        <option value="M" <?php if(@$detail->gender=='M')echo 'selected';?>>ชาย</option>
                                                                                        <option value="F" <?php if(@$detail->gender=='F')echo 'selected';?>>หญิง</option>
                                                                                </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>เบอร์โทรศัพท์</label>
                                                                                <input type="text" class="form-control" id="mobile_no" name="mobile_no" placeholder="xxxxxxxxxx ไม่ต้องเว้นวรรค" value="<?php echo @$detail->mobile_no;?>">
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
                                                                                        <input type="text" class="form-control" id="university-1" name="university-1" value="<?php echo @$detail->bachelor_university_name;?>" >
                                                                                        <input type="hidden" class="form-control " id="bachelor_university_id" name="bachelor_university_id" value="<?php echo @$detail->bachelor_university_id;?>">
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
                                                                                            <input type="text" class="form-control" id="bachelor_faculty" name="bachelor_faculty" value="<?php echo @$detail->bachelor_faculty;?>" >
                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                        <label >เอก</label>
                                                                                        <input type="text" class="form-control" id="bachelor_major" name="bachelor_major" value="<?php echo @$detail->bachelor_major;?>" >
                                                                                </div>
                                                                        </div>
                        
                                                                        <div class="form-row  clearfix">
                                                                                <div class="col-md-4 ">
                                                                                        <label >ปริญญาโท มหาวิทยาลัย</label>
                                                                                        <input type="text" class="form-control" id="university-2" name="university-2" value="<?php echo @$detail->master_university_name;?>" >
                                                                                        <input type="hidden" class="form-control " id="master_university_id" name="master_university_id" value="<?php echo @$detail->master_university_id;?>">
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
                                                                                            <input type="text" class="form-control" id="master_faculty" name="master_faculty" value="<?php echo @$detail->master_faculty;?>" >
                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                        <label >เอก</label>
                                                                                        <input type="text" class="form-control" id="master_major" name="master_major" value="<?php echo @$detail->master_major;?>" >
                                                                                </div>
                                                                        </div>
                        
                                                                        <div class="form-row  clearfix">
                                                                                <div class="col-md-4 ">
                                                                                        <label >ปริญญาเอก มหาวิทยาลัย</label>
                                                                                        <input type="text" class="form-control" id="university-3" name="university-3" value="<?php echo @$detail->doctor_university_name;?>" >
                                                                                        <input type="hidden" class="form-control " id="doctor_university_id" name="doctor_university_id" value="<?php echo @$detail->doctor_university_id;?>">
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
                                                                                            <input type="text" class="form-control" id="doctor_faculty" name="doctor_faculty" value="<?php echo @$detail->doctor_faculty;?>" >
                                                                                </div>
                                                                                <div class="col-md-4 ">
                                                                                        <label >เอก</label>
                                                                                        <input type="text" class="form-control" id="doctor_major" name="doctor_major" value="<?php echo @$detail->doctor_major;?>" >
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
                                                                                    <input type="text" class="form-control" id="displayname" name="displayname" value="<?php echo @$detail->displayname;?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                    <label>ภาพ</label>
                                                                                    <input type="file" id="avatar" name="avatar" class="dropify" data-default-file="<?php echo @$detail->avatar_path;?>"/>
                                                                                    <input type="hidden" class="form-control" name="avatar_img_hidden" placeholder="" value="<?php echo @$detail->avatar;?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                    <label>คำอธิบายประวัติคร่าวๆ</label>
                                                                                    <textarea class="form-control" id="profile_background" name="profile_background" ><?php echo @$detail->profile_background;?></textarea>
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
                                                                                <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo @$detail->facebook;?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>Line ID</label>
                                                                                <input type="text" class="form-control" id="line_id" name="line_id" value="<?php echo @$detail->line_id;?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>Youtube Channel</label>
                                                                                <input type="text" class="form-control" id="youtube" name="youtube" value="<?php echo @$detail->youtube;?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                                <label>TikTok</label>
                                                                                <input type="text" class="form-control" id="tiktok" name="tiktok" value="<?php echo @$detail->tiktok;?>">
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
                                                                                                        <option value="<?php echo $row->bank_id?>" <?php if(@$detail->subdistrict_id==$row->bank_id)echo 'selected';?>><?php echo $row->bank_name;?></option>
                                                                                                        <?php 
                                                                                                        }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-4 ">
                                                                                            <label for="validationCustom03">สาขา</label>
                                                                                            <input type="text" class="form-control" id="bank_branch" name="bank_branch" value="<?php echo @$detail->bank_branch;?>">
                                                                                    </div>
                                                                                    <div class="col-md-4 ">
                                                                                            <label for="validationCustom03">ประเภทบัญชี</label>
                                                                                            <select class="form-control custom-select text-muted" id="book_bank_type" name="book_bank_type" >
                                                                                                    <option value="">-- เลือกประเภทบัญชี --</option>
                                                                                                    <option value="1" <?php if(@$detail->book_bank_type=='1')echo 'selected';?>>ออมทรัพย์</option>
                                                                                                    <option value="2" <?php if(@$detail->book_bank_type=='2')echo 'selected';?>>กระแสรายวัน</option>
                                                                                            </select>
                                                                                    </div>

                                                                                    <div class="col-md-6 ">
                                                                                            <label for="validationCustom03">ชื่อบัญชี</label>
                                                                                            <input type="text" class="form-control" id="book_bank_name" name="book_bank_name" value="<?php echo @$detail->book_bank_name;?>">
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">เลขบัญชีธนาคาร</label>
                                                                                                <div class="row">
                                                                                                <?php 
                                                                                                $bookbank_id = @$detail->book_bank_no;
                                                                                                $temp = explode('-',$bookbank_id);
                                                                                                ?>
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="bookBankID1" name="bookBankID1" class="form-control" maxlength=3 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo @$temp[0];?>">
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span>   
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="bookBankID2" name="bookBankID2" class="form-control" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo @$temp[1];?>">  
                                                                                                    </div>
                                                                                                    <span class="p-t-5">-</span> 
                                                                                                    <div class="col-md-2">
                                                                                                        <input type="text" id="bookBankID3" name="bookBankID3" class="form-control" maxlength=4 onkeyup="keyup(this,event)" onkeypress="return Numbers(event)" value="<?php echo @$temp[2];?>">  
                                                                                                    </div>
                                                                                                </div>     
                                                                                            </div>
                                                                                    </div>

                                                                                    <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                            <label for="wphoneNumber2">หน้าบัญชีธนาคาร</label>
                                                                                                <input type="file" id="book_bank_img" name="book_bank_img" class="dropify" data-default-file="<?php echo @$detail->book_bank_img_path;?>"/>
                                                                                                <input type="hidden" class="form-control" name="bookbank_img_hidden" placeholder="" value="<?php echo @$detail->book_bank_img;?>">        
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

function updateContent()
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
                    url: '<?php echo base_url('officer/update')?>',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(result) { 
                        $("#result").html(result);
                        /*
                        if(result==true)
                        {
                                toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','แก้ไขผู้ใช้งาน');
                                setTimeout(function() { 
                                        var url = "<?php echo base_url('officer/list');?>";    
                                        $(location).attr('href',url);
                                }, 3000);
                        } 
                        else{
                                toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','แก้ไขผู้ใช้งาน');
                        }
                        */
                     }
                });
}

function districtChange(){
    district_id = document.getElementById("district_id").value;
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('profile/loadSubDistrict')?>',
                data: 'district_id='+district_id+'',
                success: function(result) { 
                    $("#_subdistrict").html(result);
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
                        updateContent();  
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