
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
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> แก้ไข Shelf : <?php echo @$detail->title_th;?></h4>
                            </div>

    <div class="cf nestable-lists card-body">
        <div class="row">
                                    <div class="col-md-6">
                                        <div class="card-content">
        <div class="dd" id="nestable">
            <ol class="dd-list">
                <li class="dd-item" data-id="0" style="z-index: 100;">
                </li>
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
                                                                    <div class="col-2" style="z-index: 1000;">
                                                                        <a onclick="test(a);"  class="badge badge-circle badge-danger"> - </a>
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
                                                                    <label class="text-custom form-label col-form-label-lg">รูปภาพ</label>
                                                                    <input type="text" class="form-control form-control-lg" name="image" style="padding-top: 14px;" placeholder="ค้นหาด้วย # หรือ ชื่อ">
                                                            </div>
                                                            <div class="mb-3 col-2" style="padding-top: 2.9rem;">
                                                                <button id="submit_btn" type="button" class="btn btn-custom" style="float:right;">ค้นหา</button>
                                                            </div>
                                                        </form>
                                                    </div>
            <ol class="dd-list">
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
                                                                    <div class="col-10">
                                                                        <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th;?></h4>
                                                                        <normal style="display:block;" > 
                                                                        <span class="text-custom" style="font-weight: 300!important;font-size: 1.2rem;">#<?php echo @$row->id;?></span>
                                                                        </normal>
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

    <div id="result">result</div>

    <p><strong>Serialised Output (per list)</strong></p>

    <textarea id="nestable-output"></textarea>
    <textarea id="nestable2-output"></textarea>

                </div>
            </div>
            </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>

$(document).ready(function()
{

    var updateOutput = function(e)
    {
        //console.log(e);
        //alert(e);
        //console.log( JSON.stringify(e, null, 2) );
        var list   = e.length ? e : $(e.target),
            //alert(list.target);
            output = list.data('output');
            //console.log(output);

        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            //alert(window.JSON.stringify(list.nestable('serialize')));
            //test(window.JSON.stringify(list.nestable('serialize')));
            orderList = window.JSON.stringify(list.nestable('serialize'))
    
            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('shelf/updateOrder')?>',
                        data: 'order='+orderList,
                        success: function(result) { 
                            //$('#result').html(result);
                            $("#nestable").html(result);

                        } 
            });
            
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    var updateOutput2 = function(e)
    {
        //console.log(e);
        //alert(e);
        //console.log( JSON.stringify(e, null, 2) );
        var list   = e.length ? e : $(e.target),
            //alert(list.target);
            output = list.data('output');
            //console.log(output);

        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            //alert(window.JSON.stringify(list.nestable('serialize')));
            //test(window.JSON.stringify(list.nestable('serialize')));
            
        } else {
            output.val('JSON browser support required for this demo.');
        }
    };

    // activate Nestable for list 1
    $('#nestable').nestable({
        group: 1,
    })
    .on('change', updateOutput);

    // activate Nestable for list 2
    $('#nestable2').nestable({
        group: 1
    })
    .on('change', updateOutput2);

    // output initial serialised data
    updateOutput($('#nestable').data('output', $('#nestable-output')));
    updateOutput2($('#nestable2').data('output', $('#nestable2-output')));

    

    $('#nestable3').nestable();

    function test(a){
        alert(a);
    }

});
</script>
</body>
</html>
