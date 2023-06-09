<script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/decoupled-document/ckeditor.js"></script>

<!--main content start-->
<section id="main-content">
          <section class="wrapper">
              <!-- page start-->
              <form id="addForm">
                <div class="row">

                        <div class="col-lg-12">
                                <section class="card">
                                        <header class="card-header bg-info text-light">
                                            <span ><strong><i class="fa fa-plus"></i> สร้างชุดข้อสอบ</strong></span>
                                            <span class="pull-right">
                                                    หน้าหลัก > 
                                                    <a href="<?php echo base_url('content/list')?>"><span class="text-light"><strong>บทความ</strong></span></a>
                                            </span>
                                        </header>
                      
                                </section>
                        </div>
                    
                        <div class="col-lg-12">
                            <section class="card">
                                        <header class="card-header head-border text-info">
                                            บทความ
                                        </header>
                                        <div class="card-body">
                                            
                                                <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">หัวข้อ</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="title" name="title" class="form-control" placeholder="ไม่ควรเกิน 120 ตัวอักษร">
                                                        </div>
                                                </div>

                                                <div class="form-group row" id="_subCategory">
                                                        <label class="col-sm-2 col-form-label">หมวดหมู่</label>
                                                        <div class="col-sm-3">
                                                                <select class="form-control" id="subCategory" name="subCategory">
                                                                        <option value="">-- เลือกหมวดหมู่ --</option>
                                                                        <?php 
                                                                        if($subCategoryList){
                                                                            foreach($subCategoryList as $row){
                                                                    ?>
                                                                        <option value="<?php echo $row->id?>" ><?php echo $row->title;?></option>
                                                                    <?php 
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">รูปหน้าปก</label>
                                                        <div class="col-sm-8">
                                                                <input type="file" id="thumbnail" name="thumbnail" class="dropify" />
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">Youtube Link</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" id="youtube_link" name="youtube_link" class="form-control" placeholder="ใส่ link youtube ถ้ามี ตัวอย่าง https://www.youtube.com/embed/EXhrAhqmYf4">
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label  class="col-sm-2 col-form-label">คำอธิบาย</label>
                                                    <div class="col-sm-8">
                                                        <textarea name="description" id="description" class="form-control" rows="2" ></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label class="col-sm-2 col-form-label">เนื้อหา</label>
                                                        <div class="col-sm-10">
                                                        <div id="toolbar-container"></div>
                                                        <!-- This container will become the editable. -->
                                                        <div id="editor">
                                                            <textarea class="form-control" id="detail" name="detail" rows="3" placeholder="กรอกรายละเอียด"></textarea>
                                                        </div>
                                                        </div>
                                                </div>

                                                <div class="form-group row">
                                                        <label for="inputEmail3" class="col-sm-2 col-form-label">Tags</label>
                                                        <div class="col-sm-10">
                                                                <input name="tagsinput" id="tagsinput" class="tagsinput" style="display: none;">
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
                                                    <label  class="col-sm-2 col-form-label">Meta Description</label>
                                                    <div class="col-sm-10">
                                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="3" ></textarea>
                                                    </div>
                                            </div>

                                            <div class="form-group row">
                                                    <label  class="col-sm-2 col-form-label">Meta Keyword</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" name="meta_keyword" class="form-control" >
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
                                                        <a href="<?php echo base_url('shelf/list');?>"><button class="btn btn-danger" type="button"><i class="fa fa-times"></i> ยกเลิก</button></a>
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
      <!--main content end-->

<span id="result"></span>

<script>

$(document).ready(function() {
        //small
        var elem = document.querySelector('.js-switch-small');
        var switchery = new Switchery(elem, { size: 'small' });
   });

/*
function categoryChange(){
        
        category = document.getElementById("category").value;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('category/loadSubCategoryLeft')?>',
            data: 'category_id='+category+'',
            success: function(result) { 
                //$('#result').html(result);
                $("#_subCategory").html(result);
            }
        });
}
*/

var submitButton = $('#submit_btn'),
check_req = 0;
formContainer  = $('#addForm');
$("#submit_btn").click(function(){
        
            var data = new FormData();

            data.append("detail", myEditor.getData());

            //Form data
            var form_data = $('#addForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            var file_data = $('input[name="thumbnail"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("thumbnail", file_data[i]);
            }

                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('content/add')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) {  

                                        $('#result').html(result);
                                         
                                        if(result==true)
                                        {
                                            toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','สร้างบทความ');
                                            setTimeout(function() { 
                                                $.redirect('<?php echo base_url('content/list')?>');  
                                                
                                            }, 3000);
                                        } 
                                        else{
                                            toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','สร้างบทความ');
                                        }
                                    }
                                });
     
});

    var myEditor;

    DecoupledEditor
        .create( document.querySelector( '#editor' ),{
                minHeight: '300px',
                ckfinder: {
                    uploadUrl: '<?php echo base_url()?>assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
                      //uploadUrl: 'https://cksource.com/weuy2g4ryt278ywiue/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json'
        
    
                }
            } )
        .then( editor => {
            const toolbarContainer = document.querySelector( '#toolbar-container' );

            toolbarContainer.appendChild( editor.ui.view.toolbar.element );

            myEditor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );

</script>



