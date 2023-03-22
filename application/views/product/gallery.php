<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row">
                    <?php //console($galleryList);?>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header bg-custom">
                                <a href="<?php echo base_url('product/edit/').$detail->id;?>"><h4 class="card-title" style="font-family: Kanit;color:white;">Gallery : <?php echo @$detail->title_th.' '.@$detail->subtitle_th;?></h4></a>
                            </div>
                            <div class="card-body pb-1">
                                <div class="basic-form">
                                    <form class="row" id="addForm">
                                        <div class="mb-3 col-8">
                                                <label class="text-custom form-label col-form-label-lg">รูปภาพ</label>
                                                <input type="file" class="form-control form-control-lg" name="image" style="padding-top: 14px;">
                                        </div>
                                        <div class="mb-3 col-4" style="margin-top: 3.4rem;">
                                            <button id="submit_btn" type="button" class="btn btn-success" style="float:right;" data-bs-toggle="modal" data-bs-target=".bd-example-modal-md">ยืนยัน</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <span id="_galleryList">
                                <?php 
                                if(isset($galleryList)&&!empty($galleryList)){
                                ?>
                                <div class="row">
                                    <?php 
                                    foreach($galleryList as $row){
                                    ?>
                                    <div class="col-lg-3 col-md-6 mb-4" style="text-align: center;">
                                        <img src="<?php echo @$row->image_url;?>" alt="" class="w-100"/>
                                        <button onclick="removePic(<?php echo $row->id;?>,<?php echo $row->product_id;?>);"type="button" class="btn light btn-danger btn-sm mt-2" style="font-size:2rem;">Remove</button>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                                <?php 
                                }
                                ?>
                                </span>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                </div>
            </div>
            <div id="result"></div>
        </div>


                
                                            

<script>
    var submitButton = $('#submit_btn');
    formContainer  = $('#addForm');
    $("#submit_btn").click(function(){
        
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

                data.append('product_id', <?php echo @$detail->id;?>);
                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('product/addGallery')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
                                            
                                            $('#_galleryList').html(result); 
                                           // $('#result').html(result);
                                            /*
                                            var json = $.parseJSON(result);
                                            if(json.status==true)
                                            {
                                                $('#result').html(result);
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }
                                            */

                                        }
                                    });
         
    });

    function removePic(id,product_id){
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('product/removePic')?>',
                        data: 'id='+id+'&product_id='+product_id,
                        success: function(result) { 
                            $('#_galleryList').html(result); 
                        }
            });
    }

</script>