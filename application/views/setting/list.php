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
                                <svg style="height:2rem;width:1.5rem!important;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tool"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                            Setting</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('setting/list')?>">List</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Tables start -->
                <div class="row" id="basic-table">
                    <!-- occupation -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                            <div class="alert-body">
                                              <strong>Occupation</strong> <span data-bs-toggle="modal" data-bs-target="#createOccupation" style="float:right;cursor: pointer;">+ create</span>
                                            </div>
                                            <div class="modal modal-primary fade text-start" id="createOccupation" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">+ Create Occupation</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="createOccupationForm">                                
                                                                    <label>Name : </label>
                                                                    <div class="mb-1">
                                                                        <input type="text" class="form-control" name="title">
                                                                    </div>

                                                                    <label>Status : </label>
                                                                    <div class="mb-1">
                                                                        <div class="position-relative graduated" data-select2-id="45">
                                                                            <select class="select2 form-select select2-hidden-accessible" name="status" id="status" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                                <option value="1">Publish</option>
                                                                                <option value="2">Unpublish</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="submitOccupationBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            
                                <div class="table-responsive" id="_list">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="80%" style="background-color: white!important;"></th>
                                                <th width="20%" style="background-color: white!important;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($occupationList)&&!empty($occupationList)){
                                                foreach($occupationList as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="fw-bold block"><h5><?php echo $row->title?></h5></span>
                                                    <div class="text-purple-500 bg-purple-100 fw-bold inline" style="display:inline;">#<?php echo $row->occupation_id?></div>
                                                    <div class="inline text-<?php if($row->status=='1')echo 'success';else echo 'danger';?> p-l-10"><?php if($row->status=='1')echo 'Published';else echo 'Unpublished';?></div>
                                                </td>
                                                <td>
                                                    <a onclick="getOccupationDetail(<?php echo $row->occupation_id;?>)" data-toggle="modal">
                                                        <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="แก้ไข" data-bs-target="#warning-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- occupation -->
                    <!-- Position -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                            <div class="alert-body">
                                              <strong>Position</strong> <span data-bs-toggle="modal" data-bs-target="#createPosition" style="float:right;cursor: pointer;">+ create</span>
                                            </div>
                                            <div class="modal modal-primary fade text-start" id="createPosition" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">+ Create Position</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="createPositionForm">                                
                                                                    <label>Name : </label>
                                                                    <div class="mb-1">
                                                                        <input type="text" class="form-control" name="title">
                                                                    </div>

                                                                    <label>Status : </label>
                                                                    <div class="mb-1">
                                                                        <div class="position-relative graduated" data-select2-id="45">
                                                                            <select class="select2 form-select select2-hidden-accessible" name="status" id="status" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                                <option value="1">Publish</option>
                                                                                <option value="2">Unpublish</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="submitPositionBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            
                                <div class="table-responsive" id="_listPosition">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="80%" style="background-color: white!important;"></th>
                                                <th width="20%" style="background-color: white!important;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($positionList)&&!empty($positionList)){
                                                foreach($positionList as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="fw-bold block"><h5><?php echo $row->name?></h5></span>
                                                    <div class="text-purple-500 bg-purple-100 fw-bold inline" style="display:inline;">#<?php echo $row->position_id?></div>
                                                    <div class="inline text-<?php if($row->status=='1')echo 'success';else echo 'danger';?> p-l-10"><?php if($row->status=='1')echo 'Published';else echo 'Unpublished';?></div>
                                                </td>
                                                <td>
                                                    <a onclick="getPositionDetail(<?php echo $row->position_id;?>)" data-toggle="modal">
                                                        <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="แก้ไข" data-bs-target="#warning-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Position -->
                    <!-- training -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                            <div class="alert-body">
                                              <strong>Residents in training</strong> <span data-bs-toggle="modal" data-bs-target="#createTraining" style="float:right;cursor: pointer;">+ create</span>
                                            </div>
                                            <div class="modal modal-primary fade text-start" id="createTraining" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">+ Create Residents in training</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="createTrainingForm">                                
                                                                    <label>Name : </label>
                                                                    <div class="mb-1">
                                                                        <input type="text" class="form-control" name="title">
                                                                    </div>

                                                                    <label>Status : </label>
                                                                    <div class="mb-1">
                                                                        <div class="position-relative graduated" data-select2-id="45">
                                                                            <select class="select2 form-select select2-hidden-accessible" name="status" id="status" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                                <option value="1">Publish</option>
                                                                                <option value="2">Unpublish</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="submitTrainingBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            
                                <div class="table-responsive" id="_listTraining">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="80%" style="background-color: white!important;"></th>
                                                <th width="20%" style="background-color: white!important;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($trainingList)&&!empty($trainingList)){
                                                foreach($trainingList as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="fw-bold block"><h5><?php echo $row->title?></h5></span>
                                                    <div class="text-purple-500 bg-purple-100 fw-bold inline" style="display:inline;">#<?php echo $row->training_id?></div>
                                                    <div class="inline text-<?php if($row->status=='1')echo 'success';else echo 'danger';?> p-l-10"><?php if($row->status=='1')echo 'Published';else echo 'Unpublished';?></div>
                                                </td>
                                                <td>
                                                    <a onclick="getTrainingDetail(<?php echo $row->training_id;?>)" data-toggle="modal">
                                                        <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="แก้ไข" data-bs-target="#warning-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- training -->
                    <!-- Graduated -->
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="alert alert-primary" role="alert">
                                            <div class="alert-body">
                                              <strong>Graduated Alumni</strong> <span data-bs-toggle="modal" data-bs-target="#createGraduated" style="float:right;cursor: pointer;">+ create</span>
                                            </div>
                                            <div class="modal modal-primary fade text-start" id="createGraduated" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel33">+ Create Graduated Alumni</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form id="createGraduatedForm">                                
                                                                    <label>Name : </label>
                                                                    <div class="mb-1">
                                                                        <input type="text" class="form-control" name="title">
                                                                    </div>

                                                                    <label>Status : </label>
                                                                    <div class="mb-1">
                                                                        <div class="position-relative graduated" data-select2-id="45">
                                                                            <select class="select2 form-select select2-hidden-accessible" name="status" id="status" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                                <option value="1">Publish</option>
                                                                                <option value="2">Unpublish</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="submitGraduatedBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            
                                <div class="table-responsive" id="_listGraduated">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="80%" style="background-color: white!important;"></th>
                                                <th width="20%" style="background-color: white!important;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            if(isset($graduatedList)&&!empty($graduatedList)){
                                                foreach($graduatedList as $row){
                                            ?>
                                            <tr>
                                                <td>
                                                    <span class="fw-bold block"><h5><?php echo $row->title?></h5></span>
                                                    <div class="text-purple-500 bg-purple-100 fw-bold inline" style="display:inline;">#<?php echo $row->graduated_id?></div>
                                                    <div class="inline text-<?php if($row->status=='1')echo 'success';else echo 'danger';?> p-l-10"><?php if($row->status=='1')echo 'Published';else echo 'Unpublished';?></div>
                                                </td>
                                                <td>
                                                    <a onclick="getGraduatedDetail(<?php echo $row->graduated_id;?>)" data-toggle="modal">
                                                        <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="แก้ไข" data-bs-target="#warning-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Graduated -->

                </div>
                <!-- Basic Tables end -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

<!-- Occupation -->
    <button id="occupationModalBtn" type="button" class="btn btn-outline-primary hidden" data-bs-toggle="modal" data-bs-target="#occupationDetail">
    Occupation Edit
    </button>
                                            <!-- Modal -->
                                            <div class="modal modal-primary fade text-start" id="occupationDetail" tabindex="-1" aria-labelledby="myModalLabel20" aria-hidden="true" >
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel20">
                                                                <svg style="padding-bottom: 2px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                                 Edit Occupation</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="_Detail">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="occupationBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

<script>
    //var submitButton = $('#submit_btn');
    formContainer  = $('#occupationForm');
    $("#occupationBtn").click(function(){
            
            var data = new FormData();

            //Form data
            var form_data = $('#occupationForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('setting/occupationUpdate')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) { 

                                        $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url('setting/loadOccupationList')?>',
                                                    success: function(result) { 
                                                        $("#_list").html(result);   
                                                    }
                                        });
                                    }
            });
    });

    function getOccupationDetail(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('setting/occupationDetail')?>',
                        data: 'occupation_id='+id,
                        success: function(result) { 
                            $("#_Detail").html(result);
                            $("#occupationModalBtn").click();
                        }
                    });
    } 

</script>      
<!-- Occupation -->

    

<!-- Training -->
    <button id="trainingModalBtn" type="button" class="btn btn-outline-primary hidden" data-bs-toggle="modal" data-bs-target="#trainingDetail">
    Residents in training Edit
    </button>
                                            <!-- Modal -->
                                            <div class="modal modal-primary fade text-start" id="trainingDetail" tabindex="-1" aria-labelledby="myModalLabel20" aria-hidden="true" >
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel20">
                                                                <svg style="padding-bottom: 2px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                                 Edit Residents in training</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="_DetailTraining">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="trainingBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

<script>
    //var submitButton = $('#submit_btn');
    formContainer  = $('#trainingForm');
    $("#trainingBtn").click(function(){
            
            var data = new FormData();

            //Form data
            var form_data = $('#trainingForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('setting/trainingUpdate')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) { 

                                        $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url('setting/loadTrainingList')?>',
                                                    success: function(result) { 
                                                        $("#_listTraining").html(result);   
                                                    }
                                        });
                                    }
            });
    });

    function getTrainingDetail(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('setting/trainingDetail')?>',
                        data: 'training_id='+id,
                        success: function(result) { 
                            $("#_DetailTraining").html(result);
                            $("#trainingModalBtn").click();
                        }
                    });
    } 

</script>      
<!-- Training -->


<!-- Graduated -->
    <button id="graduatedModalBtn" type="button" class="btn btn-outline-primary hidden" data-bs-toggle="modal" data-bs-target="#graduatedDetail">
    Graduated Alumni
    </button>
                                            <!-- Modal -->
                                            <div class="modal modal-primary fade text-start" id="graduatedDetail" tabindex="-1" aria-labelledby="myModalLabel20" aria-hidden="true" >
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel20">
                                                                <svg style="padding-bottom: 2px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                                 Edit Graduated Alumni</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="_DetailGraduated">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="graduatedBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

<script>
    //var submitButton = $('#submit_btn');
    formContainer  = $('#graduatedForm');
    $("#graduatedBtn").click(function(){
            
            var data = new FormData();

            //Form data
            var form_data = $('#graduatedForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('setting/graduatedUpdate')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) { 

                                        $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url('setting/loadGraduatedList')?>',
                                                    success: function(result) { 
                                                        $("#_listGraduated").html(result);   
                                                    }
                                        });
                                    }
            });
    });

    function getGraduatedDetail(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('setting/graduatedDetail')?>',
                        data: 'graduated_id='+id,
                        success: function(result) {
                            $("#_DetailGraduated").html(result);
                            $("#graduatedModalBtn").click();
                        }
                    });
    } 

</script>      
<!-- Graduated -->


<!-- Position -->
    <button id="positionModalBtn" type="button" class="btn btn-outline-primary hidden" data-bs-toggle="modal" data-bs-target="#positionDetail">
    Position
    </button>
                                            <!-- Modal -->
                                            <div class="modal modal-primary fade text-start" id="positionDetail" tabindex="-1" aria-labelledby="myModalLabel20" aria-hidden="true" >
                                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel20">
                                                                <svg style="padding-bottom: 2px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                                 Edit Position</h4>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body" id="_DetailPosition">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" id="positionBtn" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Modal -->

<script>
    //var submitButton = $('#submit_btn');
    formContainer  = $('#positionForm');
    $("#positionBtn").click(function(){
            
            var data = new FormData();

            //Form data
            var form_data = $('#positionForm').serializeArray();
            $.each(form_data, function (key, input) {
                data.append(input.name, input.value);
            });

            $.ajax({
                                    type: 'POST',
                                    url: '<?php echo base_url('setting/positionUpdate')?>',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    success: function(result) { 

                                        $.ajax({
                                                    type: 'POST',
                                                    url: '<?php echo base_url('setting/loadPositionList')?>',
                                                    success: function(result) { 
                                                        $("#_listPosition").html(result);   
                                                    }
                                        });
                                    }
            });
    });

    function getPositionDetail(id){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('setting/positionDetail')?>',
                        data: 'position_id='+id,
                        success: function(result) {
                            $("#_DetailPosition").html(result);
                            $("#positionModalBtn").click();
                        }
                    });
    } 

</script>      
<!-- Position -->


<script>
                                    formContainer  = $('#createOccupationForm');
                                    $("#submitOccupationBtn").click(function(){
                                            
                                            var data = new FormData();

                                            //Form data
                                            var form_data = $('#createOccupationForm').serializeArray();
                                            $.each(form_data, function (key, input) {
                                                data.append(input.name, input.value);
                                            });

                                            $.ajax({
                                                                    type: 'POST',
                                                                    url: '<?php echo base_url('setting/occupationAdd')?>',
                                                                    data: data,
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success: function(result) { 

                                                                        $.ajax({
                                                                                    type: 'POST',
                                                                                    url: '<?php echo base_url('setting/loadOccupationList')?>',
                                                                                    success: function(result) { 
                                                                                        $("#_list").html(result);   
                                                                                    }
                                                                        });
                                                                    }
                                            });
                                    });
</script>
<script>
                                    formContainer  = $('#createPositionForm');
                                    $("#submitPositionBtn").click(function(){
                                            
                                            var data = new FormData();

                                            //Form data
                                            var form_data = $('#createPositionForm').serializeArray();
                                            $.each(form_data, function (key, input) {
                                                data.append(input.name, input.value);
                                            });

                                            $.ajax({
                                                                    type: 'POST',
                                                                    url: '<?php echo base_url('setting/positionAdd')?>',
                                                                    data: data,
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success: function(result) { 

                                                                        $.ajax({
                                                                                    type: 'POST',
                                                                                    url: '<?php echo base_url('setting/loadPositionList')?>',
                                                                                    success: function(result) { 
                                                                                        $("#_listPosition").html(result);   
                                                                                    }
                                                                        });
                                                                    }
                                            });
                                    });
</script>
<script>
                                    formContainer  = $('#createGraduatedForm');
                                    $("#submitGraduatedBtn").click(function(){
                                            
                                            var data = new FormData();

                                            //Form data
                                            var form_data = $('#createGraduatedForm').serializeArray();
                                            $.each(form_data, function (key, input) {
                                                data.append(input.name, input.value);
                                            });

                                            $.ajax({
                                                                    type: 'POST',
                                                                    url: '<?php echo base_url('setting/graduatedAdd')?>',
                                                                    data: data,
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success: function(result) { 

                                                                        $.ajax({
                                                                                    type: 'POST',
                                                                                    url: '<?php echo base_url('setting/loadGraduatedList')?>',
                                                                                    success: function(result) { 
                                                                                        $("#_listGraduated").html(result);   
                                                                                    }
                                                                        });
                                                                    }
                                            });
                                    });
</script>
<script>
                                    formContainer  = $('#createTrainingForm');
                                    $("#submitTrainingBtn").click(function(){
                                            
                                            var data = new FormData();

                                            //Form data
                                            var form_data = $('#createTrainingForm').serializeArray();
                                            $.each(form_data, function (key, input) {
                                                data.append(input.name, input.value);
                                            });

                                            $.ajax({
                                                                    type: 'POST',
                                                                    url: '<?php echo base_url('setting/trainingAdd')?>',
                                                                    data: data,
                                                                    processData: false,
                                                                    contentType: false,
                                                                    success: function(result) { 

                                                                        $.ajax({
                                                                                    type: 'POST',
                                                                                    url: '<?php echo base_url('setting/loadTrainingList')?>',
                                                                                    success: function(result) { 
                                                                                        $("#_listTraining").html(result);   
                                                                                    }
                                                                        });
                                                                    }
                                            });
                                    });
</script>