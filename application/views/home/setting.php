            

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">
                            <svg style="height:2rem;width:1.5rem!important;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                            Home</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('home');?>">Setting</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="content-body">
<script src="https://code.jquery.com/jquery-3.6.0.min.js" defer></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>

            <!-- Sortable lists section start -->

                <?php 
                //console($detail);
                ?>

                <section >
                    <div class="row">
                    <!-- Multiple List Group starts -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <h4 class="my-1 text-purple-500">Top Slider</h4>
                                            <ul class="list-group list-group-flush" id="_list">
                                                <?php 
                                                if(isset($topSliderList)&&!empty($topSliderList))
                                                {
                                                    foreach($topSliderList as $row)
                                                    {
                                                ?>
                                                <li class="list-group-item" id="<?php echo $row->bubble_id;?>">
                                                    <div class="d-flex row">
                                                        <img src="<?php 
                                                        if(@$row->image=='')echo base_url('assets/images/default-thumbnail.jpg');
                                                        else echo base_url().$row->image;
                                                        ?>" class="img-fluid col-3" alt="img-placeholder"/>
                                                        <div class="more-info col-7">
                                                            <h5 class="text-purple-500"><?php echo @$row->title;?></h5>
                                                            <span><?php echo @$row->external_link;?></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-flat-danger waves-effect" onclick="removeFromList(<?php echo $row->bubble_id;?>)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title"> </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form form-vertical" id="addTopSliderForm">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="first-name-vertical">Image</label>
                                                                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" >
                                                                        <small>The image should have aspect ratio of 635∶801</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="first-name-vertical">URL</label>
                                                                        <input type="text" class="form-control" name="url" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="first-name-vertical">Title</label>
                                                                        <input type="text" class="form-control" name="title" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="first-name-vertical">Description</label>
                                                                        <input type="text" name="description" class="form-control">
                                                                    </div>

                                                                    <input type="hidden" class="form-control" name="type" value="1">
                                                                </div>
                                                                <div class="col-12">
                                                                    <button id="submitTopSlide_btn" type="button" class="btn btn-primary me-1 waves-effect waves-float waves-light" style="float:right;">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <hr style="color:#7367f0;">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <h4 class="my-1 text-purple-500">Bubble</h4>
                                            <ul class="list-group list-group-flush" id="_listBubble">
                                                <?php 
                                                if(isset($bubbleList)&&!empty($bubbleList))
                                                {
                                                    foreach($bubbleList as $row)
                                                    {
                                                ?>
                                                <li class="list-group-item" id="<?php echo $row->bubble_id;?>">
                                                    <div class="d-flex row">
                                                        <img src="<?php 
                                                        if(@$row->image=='')echo base_url('assets/images/default-thumbnail.jpg');
                                                        else echo base_url().$row->image;
                                                        ?>" class="img-fluid col-3" alt="img-placeholder"/>
                                                        <div class="more-info col-7">
                                                            <h5 class="text-purple-500"><?php echo @$row->title;?></h5>
                                                            <span><?php echo @$row->external_link;?></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-flat-danger waves-effect" onclick="removeBlbbleFromList(<?php echo $row->bubble_id;?>)">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h4 class="card-title"> </h4>
                                                    </div>
                                                    <div class="card-body">
                                                        <form class="form form-vertical" id="addBubbleForm">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="first-name-vertical">Image</label>
                                                                        <input type="file" class="form-control" id="thumbnail_bubble" name="thumbnail_bubble" >
                                                                        <small>The image should have aspect ratio of 513∶505</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="mb-1">
                                                                        <label class="form-label" for="first-name-vertical">URL</label>
                                                                        <input type="text" class="form-control" name="url" placeholder="">
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" class="form-control" name="type" value="2">
                                                                <div class="col-12">
                                                                    <button id="submitBubble_btn" type="button" class="btn btn-primary me-1 waves-effect waves-float waves-light" style="float:right;">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>


                        </div>
                        <!-- Multiple List Group ends -->
                    </div>


                </section>
                <!-- Sortable lists section end -->

                <div id="result"></div>

                <!--  modal status -->
                                            <div class="modal fade text-start" id="result_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Successfully Published
                                                            The content will be generated and publish onto the website.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
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
                                                            Fail
                                                            Please try again
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('content/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

            </div>
            
        </div>
    </div>
    <!-- END: Content-->


<script>

 
    var submitButton = $('#submitTopSlide_btn');
    formContainer  = $('#addTopSliderForm');
    $("#submitTopSlide_btn").click(function(){

                
                var data = new FormData();

                //data.append("detail", myEditor.getData());

                //Form data
                var form_data = $('#addTopSliderForm').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });
                
                var file_data = $('input[name="thumbnail"]')[0].files;
                    for (var i = 0; i < file_data.length; i++) {
                        data.append("thumbnail", file_data[i]);
                }

                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('home/addTopSlider')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
                                            if(result==true)
                                            {
                                                $('#result_modal').modal('show');
                                                $.ajax({
                                                    url: '<?php echo base_url('home/loadTopSlider')?>',
                                                    success: function(result) {
                                                        $("#result").html(result);   
                                                    }
                                                });
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }
                                        }
                                    });
         
    });

  function removeFromList(id){
        $('#_list #'+id+'').remove();
        $.ajax({
                data: "bubble_id="+id,
                type: 'POST',
                url: '<?php echo base_url('home/deleteTopSlider')?>',
                success: function(result) {
                        //$("#result").html(result);   
                        $('#_list').html(result);
                }
                });
  }


  var submitButton = $('#submitBubble_btn');
    formContainer  = $('#addBubbleForm');
    $("#submitBubble_btn").click(function(){

                
                var data = new FormData();

                //data.append("detail", myEditor.getData());

                //Form data
                var form_data = $('#addBubbleForm').serializeArray();
                $.each(form_data, function (key, input) {
                    data.append(input.name, input.value);
                });
                
                var file_data = $('input[name="thumbnail_bubble"]')[0].files;
                    for (var i = 0; i < file_data.length; i++) {
                        data.append("thumbnail", file_data[i]);
                }

                                    $.ajax({
                                        type: 'POST',
                                        url: '<?php echo base_url('home/addBubble')?>',
                                        data: data,
                                        processData: false,
                                        contentType: false,
                                        success: function(result) { 
                                            //$('#result').html(result);
                                            if(result==true)
                                            {
                                                $('#result_modal').modal('show');
                                                $.ajax({
                                                    url: '<?php echo base_url('home/loadBubble')?>',
                                                    success: function(result) {
                                                        $("#_listBubble").html(result);   
                                                    }
                                                });
                                            } 
                                            else{
                                                $('#result_modal_fail').modal('show');
                                            }
                                        }
                                    });
         
    });

    function removeBlbbleFromList(id){
        $('#_listBubble #'+id+'').remove();
        $.ajax({
                data: "bubble_id="+id,
                type: 'POST',
                url: '<?php echo base_url('home/deleteTopSlider')?>',
                success: function(result) {
                        //$("#result").html(result);   
                        $('#_listBubble').html(result);
                }
                });
  }
</script>
