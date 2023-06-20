

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
                                <svg style="height:2rem;width:1.5rem!important;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book-open"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                            Category</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('category/list');?>">List</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create Subcategory
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                <div id="result">
                </div>

                <section id="basic-input">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form id="addForm">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="selectDefault">Category</label>
                                                    <select class="form-select" id="category_id" name="category_id">
                                                        <option selected="">Open this select Category</option>
                                                        <?php 
                                                        if(isset($list)&&!empty($list)){
                                                            foreach($list as $row){
                                                        ?>
                                                        <option value="<?php echo $row->category_id;?>" <?php if($category_id==$row->category_id) echo 'selected';?>><?php echo $row->name;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Name</label>
                                                    <input type="text" class="form-control" id="" name="name" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Slug</label>
                                                    <input type="text" class="form-control" id="" name="slug" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Meta Title</label>
                                                    <input type="text" class="form-control" id="" name="meta_title" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="exampleFormControlTextarea1">Meta Description</label>
                                                    <textarea class="form-control" id="" rows="3" name="meta_description" placeholder="Textarea"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicInput">Meta Keywords</label>
                                                    <input type="text" class="form-control" id="" name="meta_keyword" placeholder="">
                                                </div>
                                            </div>

                                            <div class="offset-9 col-3">
                                                <button class="btn btn-primary waves-effect waves-float waves-light" type="cancel">Cancel</button>
                                                <button id="submit_btn" class="btn btn-primary waves-effect waves-float waves-light m-l-10" type="button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    
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
                                                            <a href="<?php echo base_url('category/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
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
                                                            <a href="<?php echo base_url('category/list');?>"><button type="button" class="btn btn-primary">Back to content list</button></a>
                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Stay on this page</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
    <!--  modal status -->


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


            /*
            var file_data = $('input[name="thumbnail"]')[0].files;
                for (var i = 0; i < file_data.length; i++) {
                    data.append("thumbnail", file_data[i]);
            }
            */
                                $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('category/addSubcat')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) {  
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
    </script>