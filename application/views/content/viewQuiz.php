<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <form id="addForm" >
              <div class="row">
                    <div class="col-lg-12">
                            <section class="card">
                                    <header class="card-header bg-info text-light">
                                        <span ><strong><i class="fa fa-plus"></i> สร้างข้อสอบ</strong></span>
                                        <span class="pull-right">
                                                หน้าหลัก > 
                                                <a href="eexam_table.html"><span class="text-light"><strong>ข้อสอบ</strong></span></a>
                                        </span>
                                    </header>
                  
                            </section>
                    </div>
                    <div class="col-lg-12">
                        <section class="card">
                            <header class="card-header text-success">
                                ข้อมูลข้อสอบ
                            </header>
                            <div class="card-body">
                                
                                    <div class="form-row align-items-center">
                                        <div class="col-2">
                                                <div class="form-group">
                                                        <label>ระดับ</label>
                                                        <p><?php echo @$educationDetail->title;?></p>
                                                </div>
                                        </div>
                                        <div class="col-2">
                                                <div class="form-group">
                                                        <label>ชั้น</label>
                                                        <p><?php echo @$subeducationDetail->title;?></p>
                                                </div>
                                        </div>
                                        <div class="col-2">
                                                <div class="form-group">
                                                        <label>วิชา</label>
                                                        <p><?php echo @$subjectDetail->title;?></p>
                                                </div>
                                        </div>
                                        <div class="col-4">
                                                <div class="form-group">
                                                        <label>บทเรียน</label>
                                                        <p><?php echo @$lessonDetail->title;?></p>
                                                </div>
                                        </div>
                                    </div>
                                
  
                            </div>
                        </section>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-12">
                            <section class="card">
                                    <div class="card-body">
                                            <div class="inbox-body text-center">
                                                    <!--
                                                    <div class="btn-group">
                                                        <a href="javascript:;" class="btn mini btn-primary">
                                                            <i class="fa fa-backward"></i>
                                                        </a>
                                                    </div>
                                                    -->
                                                    <?php 
                                                    echo $total_create;
                                                    echo ":".$active_create;
                                                    if($total_create)
                                                    {
                                                    for($i=1;$i<=$total_create;$i++)
                                                        {
                                                    ?>
                                                    <div class="btn-group">
                                                            <a href="javascript:;" class="btn mini 
                                                                <?php 
                                                                if($active_create==$i) echo 'btn-success';
                                                                else if($active_create>$i) echo 'btn-info';
                                                                else echo 'btn-default';
                                                                ?>">
                                                                <?php echo $i;?>
                                                            </a>
                                                    </div>
                                                    <?php 
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                        </div>
                            </section>
                        </div>
                </div>
                <div class="row">
                        <div class="col-lg-9">
                            <section class="card">
                                        <header class="card-header head-border text-success">
                                            คำถาม
                                        </header>
                                        <div class="card-body">
                                                <span class="row">
                                                        <div class="form-group col-10" style="margin-top:1rem;">
                                                                <textarea class="form-control" id="question" name="question" rows="3" placeholder="กรอกคำถาม"></textarea>    
                                                        </div>
                                                        <div class="form-group col-2" style="margin-top:1rem;" id="btnAddThumbnail">
                                                                <button type="button" onclick="addThumbnail();" class="btn btn-info mb-2"> + เพิ่มรูปภาพ</button> 
                                                        </div>
                                                        <div class="form-group col-12" style="display:none;" id="showThumbnail">
                                                                <input type="file" id="thumbnail" name="thumbnail" class="dropify" style="margin-top:7px;"/>
                                                        </div>
                                                        <div class="form-group offset-8 col-4" id="btnAllcorrect" style="margin-bottom:0;">
                                                                <button type="button" id="choice_all_correct" onclick="allCorrect();" class="btn btn-default mb-2 pull-right" value="1"> ถูกทุกข้อ </button> 
                                                        </div>
                                                </span>

                                                

                                                <div class="form-row">
                                                    <div class="form-group col-8" style="margin-top:1rem;">
                                                            <label ><strong>คำตอบ ก</strong></label>
                                                            <input type="text" class="form-control" id="choice_1" name="choice_1">
                                                    </div>

                                                    <div class="form-group col-3" style="padding-top:43px;">
                                                            <button type="button" id="choice_1_addText" onclick="clickAddText_c1();" class="btn btn-info mb-2"><i class="fa fa-picture-o"></i> +</button>       
                                                            <div id="choice_1_addImage" class="m-t-30" style="display:none;">
                                                                    <input type="file" id="choice_1_pic" name="choice_1_pic" class="dropify" />
                                                            </div>    
                                                    </div>

                                                    <div class="form-group col-1" style="padding-top:43px;">
                                                            <button type="button" id="choice_1_correct" onclick="activeChoiceCorrect('choice_1_correct');" value="1" class="checkCorrect btn btn-secondary m-t-30"><i class="fa fa-check"></i> </button>    
                                                    </div>
                                                </div>

                                                <div class="form-row">
                                                        <div class="form-group col-8" >
                                                                <label ><strong>คำตอบ ข</strong></label>
                                                                <input type="text" class="form-control" id="choice_2" name="choice_2">
                                                        </div>
    
                                                        <div class="form-group col-3" style="padding-top:27px;">
                                                                <button type="button" id="choice_2_addText" onclick="clickAddText_c2();" class="btn btn-info mb-2"><i class="fa fa-picture-o"></i> +</button>       
                                                                <div id="choice_2_addImage" class="m-t-30" style="display:none;">
                                                                        <input type="file" id="choice_2_pic" name="choice_2_pic" class="dropify" />
                                                                </div>     
                                                        </div>
    
                                                        <div class="form-group col-1" style="padding-top:27px;">
                                                        <button type="button" id="choice_2_correct" onclick="activeChoiceCorrect('choice_2_correct');" value="2" class="checkCorrect btn btn-secondary btn-circle m-t-30 "><i class="fa fa-check"></i> </button>
                                                        </div>
                                                </div>

                                                <div class="form-row">
                                                        <div class="form-group col-8" >
                                                                <label ><strong>คำตอบ ค</strong></label>
                                                                <input type="text" class="form-control" id="choice_3" name="choice_3">
                                                        </div>
    
                                                        <div class="form-group col-3" style="padding-top:27px;">
                                                                <button type="button" id="choice_3_addText" onclick="clickAddText_c3();" class="btn btn-info mb-2"><i class="fa fa-picture-o"></i> +</button>       
                                                                <div id="choice_3_addImage" class="m-t-30" style="display:none;">
                                                                        <input type="file" id="choice_3_pic" name="choice_3_pic" class="dropify" />
                                                                </div>     
                                                        </div>
    
                                                        <div class="form-group col-1" style="padding-top:27px;">
                                                        <button type="button" id="choice_3_correct" onclick="activeChoiceCorrect('choice_3_correct');" value="3" class="checkCorrect btn btn-secondary btn-circle m-t-30 "><i class="fa fa-check"></i> </button>
                                                        </div>
                                                </div>

                                                <div class="form-row">
                                                        <div class="form-group col-8" id="_allCorrect">
                                                                <label><strong>คำตอบ ง</strong></label>
                                                                <input type="text" class="form-control" id="choice_4" name="choice_4">
                                                        </div>
    
                                                        <div class="form-group col-3" style="padding-top:27px;">
                                                                <button type="button" id="choice_4_addText" onclick="clickAddText_c4();" class="btn btn-info mb-2"><i class="fa fa-picture-o"></i> +</button>       
                                                                <div id="choice_4_addImage" class="m-t-30" style="display:none;">
                                                                        <input type="file" id="choice_4_pic" name="choice_4_pic" class="dropify" />
                                                                </div>     
                                                        </div>
    
                                                        <div class="form-group col-1" style="padding-top:27px;">
                                                                <button type="button" id="choice_4_correct" onclick="activeChoiceCorrect('choice_4_correct');" value="4" class="checkCorrect btn btn-secondary btn-circle m-t-30 "><i class="fa fa-check"></i> </button>
                                                        </div>
                                                </div>
                                        </div>
                                        
                            </section>
                            <section class="card">
                                    <header class="card-header text-success">
                                        ความรู้ อธิบายเพิ่มเติม
                                    </header>
                                    <div class="card-body">
                                        
                                            <div class="form-row align-items-center">
                                                <div class="col-lg-12">
                                                        <div class="form-group">
                                                                <textarea class="form-control" id="note" name="note" rows="2" placeholder="ข้อมูลเพิ่มเติม หรือ link youtube ที่ใช้อ้างอิง"></textarea> 
                                                        </div>
                                                </div>
                                            </div>
                                     </div>

                                     <header class="card-header text-success">
                                        Youtube อธิบายเพิ่มเติม
                                    </header>
                                    <div class="card-body">
                                        
                                            <div class="form-row align-items-center">
                                                <div class="col-lg-12">
                                                        <div class="form-group">
                                                        <input type="text" class="form-control" id="youtube_link" name="youtube_link">
                                                        </div>
                                                </div>
                                            </div>
                                     </div>
                                        
                                            
                                
                                </section>

                                <section class="card">
                                        <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-lg-2">
                                                    <a href="<?php echo base_url('quiz/list');?>"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i> ยกเลิก</button></a>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <button href="#createModal" data-toggle="modal" class="btn btn-danger" type="button"><i class="fa fa-times"></i> เพิ่มข้อสอบใหม่</button>
                                                    </div>
                                                    <div class="offset-lg-4 col-lg-3">
                                                        <button class="btn btn-success pull-right" type="button" id="submit_btn"><i class="fa fa-check"></i> ข้อถัดไป</button>
                                                    </div>
                                                </div>

                                        </div>
                                </section>
                        </div>
                        <div class="col-lg-3">
                            <section class="card">
                                <header class="card-header text-success">
                                    ระดับความยากข้อสอบ
                                </header>
                                <div class="card-body">
                                <div class="form-group">
                                                    <div class="col-lg-12">
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio1" name="rank" value="1" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1" style="padding-top:3px;">
                                                                <i class="fa fa-star" style="color:#17a2b8;font-size:14px;padding-left:14px;"></i>
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio2" name="rank" value="2" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio2" style="padding-top:3px;">
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;padding-left:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio3" name="rank" value="3" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio3" style="padding-top:3px;">
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;padding-left:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio4" name="rank" value="4" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio4" style="padding-top:3px;">
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;padding-left:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                            </label>
                                                        </div>
                                                        <div class="custom-control custom-radio mb-3">
                                                            <input type="radio" id="customRadio5" name="rank" value="5" class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio5" style="padding-top:3px;">
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;padding-left:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                                    <i class="fa fa-star" style="color:#17a2b8;font-size:14px;"></i>
                                                            </label>
                                                        </div>
              
                                                    </div>
                                                </div>
                                </div>

                            </section>

                            <section class="card">
                                    <header class="card-header text-success">
                                        ตัวชี้วัด
                                    </header>
                                    <div class="card-body">
                                        <div class="checkboxes">
                                        <?php 
                                        if($indicatorList){
                                                foreach($indicatorList as $row){
                                        ?> 
                                                <label class="label_check c_off" for="checkbox-<?php echo $row->id;?>">
                                                    <input name="indicator[]" id="checkbox-<?php echo $row->id;?>" value="<?php echo $row->id;?>" type="checkbox"><?php echo $row->indicator_title;?>
                                                </label>
                                        <?php 
                                                }
                                        }
                                        ?>
                                        </div>
                                    </div>
    
                             </section>

                             <section class="card">
                                    <header class="card-header text-success">
                                        การเผยแพร่
                                    </header>
                                    <div class="card-body">
                                        <div class="col-sm-12">
                                                <select class="form-control" name="status" id="status">
                                                        <option value="2" selected> ร่าง </option>
                                                        <option value="3"> ส่งตรวจสอบ </option>
                                                </select>
                                        </div>   
                                    </div>
    
                             </section>

                        </div>
                    </div>
                    </form>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->

        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="createModal" class="modal fade">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="fa fa-plus"></i> สร้างข้อสอบ</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form">
                                                            <div class="form-group">
                                                                    <label for="exampleInputPassword1">ระดับ</label>
                                                                    <select class="form-control" id="c_education" name="c_education" onchange="educationChangeCreate();">
                                                                                <option value="">-- ทุกระดับ --</option>
                                                                                <?php 
                                                                                    if($educationList){
                                                                                        foreach($educationList as $row){
                                                                                ?>
                                                                                    <option value="<?php echo $row->id?>" ><?php echo $row->title;?></option>
                                                                                <?php 
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group" id="_subEducationCreate">
                                                                    <label>ชั้น</label>
                                                                    <select class="form-control" id="c_subeducation" name="c_subeducation">
                                                                        <option value="">-- ทุกชั้น --</option>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="exampleInputEmail1">วิชา</label>
                                                                    <select class="form-control" id="c_subject" name="c_subject" onchange="subjectChangeCreate();">
                                                                                <option value="">-- ทุกวิชา --</option>
                                                                                <?php 
                                                                                    if($subjectList){
                                                                                        foreach($subjectList as $row){
                                                                                ?>
                                                                                    <option value="<?php echo $row->id?>" ><?php echo $row->title;?></option>
                                                                                <?php 
                                                                                        }
                                                                                    }
                                                                                ?>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group" id="_lessonCreate">
                                                                    <label>บทเรียน</label>
                                                                    <select class="form-control" id="c_lesson" name="c_lesson">
                                                                        <option value="">-- ทุกบทเรียน --</option>
                                                                    </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label >จำนวนข้อสอบ</label>
                                                                <input type="text" class="form-control" id="count_create" name="count_create" placeholder="จำนวนข้อสอบที่ต้องการสร้าง เช่น 5">
                                                            </div>
                                                            <div  class="text-right">
                                                                <a id="createBtn" ><button type="button" class="btn btn-primary text-right">ยืนยัน</button></a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
        </div>

<span id="result"></span>

<script>

function activeChoiceCorrect(id)
{
        var fix;
            $("#choice_all_correct").each(function(){ 
                if($(this).hasClass("active")) { 
                    fix = $(this).attr("value");
                }
                else fix = 0;
        })
        if(fix==1)
        {
                $('#_allCorrect').html('<label><strong>คำตอบ ง</strong></label><input type="text" class="form-control" id="choice_4" name="choice_4">');
        }
        $('.checkCorrect.btn').removeClass("btn-success");
        $('.checkCorrect.btn').addClass("btn-secondary");
        $('#'+id+'').addClass("btn-success");
        $('#choice_all_correct').addClass("btn-default");
        $('#choice_all_correct').removeClass("btn-success");
        $('#choice_all_correct').removeClass("active");
        
}

function addThumbnail(){
        $('#btnAddThumbnail').hide();
        $('#showThumbnail').show();
}

function clickAddText_c1(){
        $('#choice_1_addText').hide();
        $('#choice_1_addImage').show();
}

function clickAddText_c2(){
        $('#choice_2_addText').hide();
        $('#choice_2_addImage').show();
}

function clickAddText_c3(){
        $('#choice_3_addText').hide();
        $('#choice_3_addImage').show();
}

function clickAddText_c4(){
        $('#choice_4_addText').hide();
        $('#choice_4_addImage').show();
}

function allCorrect(){
        $('.checkCorrect.btn').removeClass("btn-success");
        $('.checkCorrect.btn').addClass("btn-secondary");
        $('#choice_all_correct').addClass("btn-success active");
        $('.checkCorrect.btn').addClass("btn-secondary");
        $('#choice_4_correct').addClass("btn-success");
        $('#_allCorrect').html('<label><strong>คำตอบ ง</strong></label><input type="text" class="form-control" id="choice_4" name="choice_4" value="ถูกทุกข้อ" readonly>');
}
        /*
        //ckeditor
        var myEditor;
        
            ClassicEditor
            .create( document.querySelector( '#question' ) ,{
                minHeight: '300px',
                ckfinder: {
                    uploadUrl: '../assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
    
                }
            } )
            .then( editor => {
                    myEditor = editor;
                } )
            .catch( error => {
                console.error( error );
            } ); 
        */
            


var submitButton = $('#submit_btn'),
check_req = 0;
formContainer  = $('#addForm');
$("#submit_btn").click(function(){
        
            var data = new FormData();

            //Form data
            var form_data = $('#addForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            //active all choice
            var fix;
            $("#choice_all_correct").each(function(){ 
                if($(this).hasClass("active")) { 
                    fix = 1;
                }
                else fix = 0;
            })

            //ckeditor
            /*
            var question = myEditor.getData();
            data.append('question', question);
            */

            $(".checkCorrect").each(function(){ 
                if($(this).hasClass("btn-success")) { 
                    checkCorrect = $(this).attr("value");
                }
            })
            data.append('checkCorrect', checkCorrect);
            data.append('fix_position', fix);

            data.append('subject_id', <?php echo $subject_id?>);
            data.append('education_id', <?php echo $education_id?>);
            data.append('subedu_id', <?php echo $subedu_id?>);
            data.append('lesson_id', <?php echo $lesson_id?>);

            //File data
            var file_data = $('input[name="thumbnail"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("thumbnail", file_data[i]);
            }

            var file_data = $('input[name="choice_1_pic"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("choice_1_pic", file_data[i]);
            }

            var file_data = $('input[name="choice_2_pic"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("choice_2_pic", file_data[i]);
            }

            var file_data = $('input[name="choice_3_pic"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("choice_3_pic", file_data[i]);
            }

            var file_data = $('input[name="choice_4_pic"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("choice_4_pic", file_data[i]);
            }
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('quiz/add')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) {  
                                        $('#result').html(result);
                                        if(result==true)
                                        {
                                            toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','สร้างคำถาม');
                                            setTimeout(function() { 
                                                
                                                subject = <?php echo $subject_id;?>;
                                                education = <?php echo $education_id;?>;
                                                subeducation = <?php echo $subedu_id;?>;
                                                lesson = <?php echo $lesson_id;?>;
                                                total_create = <?php echo $total_create?>;
                                                active_create = <?php echo $active_create?>;
                                                if(active_create==total_create){
                                                        $.redirect('<?php echo base_url('quiz/list')?>');  
                                                }
                                                else{
                                                        $.redirect('<?php echo base_url('quiz/create')?>', 
                                                        {'subject_id': subject, 
                                                        'education_id': education,
                                                        'subedu_id': subeducation,
                                                        'lesson_id': lesson,
                                                        'total_create': total_create,
                                                        'active_create': (active_create+1),
                                                        });
                                                }
                                            }, 3000);
                                        } 
                                        else{
                                            toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','สร้างคำถาม');
                                        }
                                    }
                                });
     
});

function educationChangeCreate(){
        
        education = document.getElementById("c_education").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('education/loadSubEdu/addLesson')?>',
            data: 'education_id='+education+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subEducationCreate").html(result);
            }
        });
}

function subjectChangeCreate(){
        
        subject = document.getElementById("c_subject").value;
        education = document.getElementById("c_education").value;
        subeducation = document.getElementById("c_subeducation").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('lesson/loadLessonCreate')?>',
            data: 'subject_id='+subject+'&education_id='+education+'&subedu_id='+subeducation,
            success: function(result) { 
                //$('#result').html(result);
                $("#_lessonCreate").html(result);
            }
        });
}

$("#createBtn").click(function(){
    subject = document.getElementById("c_subject").value;
    education = document.getElementById("c_education").value;
    subeducation = document.getElementById("c_subeducation").value;
    lesson = document.getElementById("c_lesson").value;
    total_create = document.getElementById("count_create").value;
    active_create = 1;
    
    $.redirect('<?php echo base_url('quiz/create')?>', 
    {'subject_id': subject, 
     'education_id': education,
     'subedu_id': subeducation,
     'lesson_id': lesson,
     'total_create': total_create,
     'active_create': 1,
    });
});
</script>