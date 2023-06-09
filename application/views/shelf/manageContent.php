
    <!-- Nestable -->
    <link href="<?php echo base_url()?>app-assets/vendor/nestable2/css/jquery.nestable.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
        <link href="<?php echo base_url()?>app-assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>app-assets/css/style.css" rel="stylesheet">

    <style>
        .dd-handle.custom{
            background-color: white!important;
        }
    </style>


<div class="content-body">
    <div class="container-fluid">

        <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header" style="background-color: #ab0600;">
                                <h4 class="card-title text-white" > <i class="fas fa-paper-plane"></i> แก้ไข Shelf : <?php echo @$detail->title_th;?></h4>
                            </div>

    <div class="cf nestable-lists card-body">
        <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-content">
        <div class="dd" id="nestable">
            <ol class="dd-list">
                <?php 
                                                        if(isset($selectList)&&!empty($selectList)){
                                                        foreach($selectList as $row){
                                                        ?>
                                                        <li class="dd-item" data-id="<?php echo @$row->product_id;?>" style="z-index: 100;">
                                                            <div class="dd-handle custom ">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <img style="max-height: 70px;display: inline;" src="<?php echo @$row->image_url;?>">
                                                                        </div>
                                                                    <div class="col-8">
                                                                        <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th;?></h4>
                                                                        <normal style="display:block;" > 
                                                                        <span class="text-custom" style="font-weight: 300!important;font-size: 1.2rem;">#<?php echo @$row->product_id;?></span>
                                                                        </normal>
                                                                    </div>
                                                                    <div class="col-2">
                                                                        <button onclick="deleteShelfContent(<?php echo $row->id;?>)" type="button" class="btn btn-danger btn-sm" style="float:right;"><i class="fa fa-trash"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php 
                                                        }
                                                        }
                                                        ?>
            </ol>
        </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="card-content">

        <div class="dd" id="nestable2">
                                                    <div class="basic-form">
                                                        <form class="row" id="addForm" style="margin-top: 5px;">
                                                            <div class="mb-3 col-10">
                                                                    <label class="text-custom form-label col-form-label-lg">Content</label>
                                                                    <input type="text" class="form-control form-control-lg" name="keysearch" id="keysearch" style="padding-top: 14px;" placeholder="ค้นหาด้วย # หรือ ชื่อ">
                                                            </div>
                                                            <div class="mb-3 col-2" style="padding-top: 2.9rem;">
                                                                <button id="searchBtn" type="button" class="btn btn-custom" style="float:right;">ค้นหา</button>
                                                            </div>
                                                        </form>
                                                    </div>
            <ol class="dd-list" id="_contentList">
                <?php 
                                                        if(isset($contentList)&&!empty($contentList)){
                                                        foreach($contentList as $row){
                                                        ?>
                                                        <li class="dd-item" data-id="<?php echo @$row->id;?>">
                                                            <div class="dd-handle custom ">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <img style="max-height: 70px;display: inline;" src="<?php echo @$row->image_url;?>">
                                                                        </div>
                                                                    <div class="col-8">
                                                                        <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th;?></h4>
                                                                        <normal style="display:block;" > 
                                                                        <span class="text-custom" style="font-weight: 300!important;font-size: 1.2rem;">#<?php echo @$row->id;?></span>
                                                                        </normal>
                                                                    </div>
                                                                    <div class="col-2" >
                                                                        <button onclick="addShelfContent(<?php echo $row->id;?>)" type="button" class="btn btn-success btn-sm" style="float:right;"><i class="fa fa-plus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php 
                                                        }
                                                        }
                                                        ?>
            </ol>
        </div>
                                    </div>
                                    </div>

    </div>

    <div id="result"></div>

    

                </div>
            </div>
            </div>
    </div>
</div>
</div>

<script>
    function addShelfContent(id){
        $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('shelf/addShelfContent')?>',
                    data: 'id='+id+'&shelf_id=<?php echo $shelf_id?>',
                    success: function(result) { 
                        //$('#result').html(result);
                        $("#nestable").html(result);
                    } 
        });
    }

    function deleteShelfContent(id){
        $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('shelf/deleteContentItem')?>',
                    data: 'id='+id+'&shelf_id=<?php echo $shelf_id?>',
                    success: function(result) { 
                        //$('#result').html(result);
                        $("#nestable").html(result);
                    } 
        });
        
    }

    $("#searchBtn").click(function(){
        keysearch = document.getElementById("keysearch").value;
        
        $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url('shelf/loadContentList')?>',
                    data: 'keysearch='+keysearch+'',
                    success: function(result) { 
                        //$('#result').html(result);
                        $("#_contentList").html(result);
                    } 
        });
    });
</script>
