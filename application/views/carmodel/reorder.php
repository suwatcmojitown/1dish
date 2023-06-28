 <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <?php //console($paging);?>
				<div class="form-head d-flex mb-3 align-items-start">
					<div class="me-auto d-none d-lg-block ">
						<h2 class="text-custom font-w600 mb-0"><i class="fas fa-pencil-alt"></i> Bubble</h2>
						<ol class="breadcrumb">
                            <li class="breadcrumb-item active"><a href="javascript:void(0)" class="text-custom">Sort Orders</a></li>
                            <!--<li class="breadcrumb-item"><a href="javascript:void(0)">Accordion</a></li>-->
                        </ol>
					</div>
                    
				</div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-body" id="_list">
                                <div class="table-responsive">
                                    <table class="table custom table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <div class="task-content">
                                        <ul id="sortable" class="task-list">
                                            <?php 
                                            if($list){
                                                //console($list);
                                                foreach($list as $row){
                                            ?>
                                            <li id="item-<?php echo $row->id;?>" class="list-<?php echo @$row->sort;?>">
                                                <div class="task-title row">
                                                        <div class="col-lg-2">
                                                                <img style="max-height: 70px;" src="<?php echo @$row->image_url?>">
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th?></h4>
                                                            <h4 class="text-custom mb-1 name" style="font-weight: 300;"><?php echo @$row->title_en?></h4>
                                                            <normal style="display:block;"> 
                                                            <a style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#warning-<?php echo $row->id;?>">
                                                            </a>
                                                            <span class="text-muted">updated : <?php echo @$row->created_at;?></span>
                                                            </normal>
                                                        </div>
                                                </div>
                                                <hr>
                                            </li>
                                            <?php 
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

					</div>
				</div>
            </div>
            <span id="result"></span>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--  modal status -->
                                            <div class="modal fade text-start" id="result_modal" tabindex="-1" aria-labelledby="myModalLabel17" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            บันทึกสำเร็จ
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('product/list');?>"><button type="button" class="btn btn-danger">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ตกลง</button>
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
                                                            บันทึกไม่สำเร็จ เกิดข้อผิดพลาด กรุณาลองใหม่
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url('bubble');?>"><button type="button" class="btn btn-danger">กลับสู่หน้าหลัก</button></a>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ตกลง</button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" defer></script>
<script src="<?php echo base_url()?>assets/js/tasks.js" type="text/javascript"></script>

<script>
 
  $(function() {
      $( "#sortable" ).sortable();
      $( "#sortable" ).disableSelection();
  });

  $(document).ready(function () {
        
        TaskList.initTaskWidget();

        $('.task-list').sortable(
            {
            axis: 'y',
            stop: function (event, ui) {
                var sort = $(this).sortable('serialize');
                //$('#txt').text(sort);
                $.ajax({
                    data: sort,
                    type: 'POST',
                    url: '<?php echo base_url('bubble/updateOrder')?>',
                    success: function(result) {
                        //alert('a');
                        //$('#result').html(result);
                        if(result==false)
                        {
                            $('#result_modal_fail').modal('show');
                        } 
                    }
                });
            }
        }
      );
        


        
  });

    
</script>



</script>