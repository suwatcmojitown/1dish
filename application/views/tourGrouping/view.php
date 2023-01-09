<div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="row page-titles">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/list');?>">Tour Grouping</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">View</a></li>
                    </ol>
                </div>
                <div class="row">
					<div class="col-12">

                        <div class="card">
                            <div class="card-header bg-info">
                                <h4 class="card-title text-white" > <i class="fas fa-pencil-alt"></i> รายละเอียด Group</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="addForm">
                                        <?php //console($detail);?>
                                        	<div class="mb-3 row">
                                                <input type="hidden" class="form-control form-control-lg" name="id" value="<?php echo @$detail->id;?>">
                                                <label class="col-sm-3 col-form-label custom text-info">สัญลักษณ์</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="group_sign" value="<?php echo @$detail->group_sign;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ไกด์</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-lg" name="group_sign" value="<?php echo @$detail->guide_name;?>" readonly>
                                                </div>
                                                <label class="col-sm-2 col-form-label custom text-info">% ไกด์</label>
                                                <div class="col-sm-3 select-custom">
                                                	<input type="text" class="form-control form-control-lg" name="group_sign" value="<?php echo @$detail->guide_commission;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">บริษัททัวร์</label>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control form-control-lg" name="group_sign" value="<?php echo @$detail->company_name;?>" readonly>
                                                </div>
                                                <label class="col-sm-2 col-form-label custom text-info">% ทัวร์</label>
                                                <div class="col-sm-3 select-custom">
                                                    <input type="text" class="form-control form-control-lg" name="group_sign" value="<?php echo @$detail->company_commission;?>" readonly>
                                                </div>
                                            </div>

                                            <div class="mb-3 row">
                                                <label class="col-sm-3 col-form-label custom text-info">ค่าจอด</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control form-control-lg" name="parking" value="<?php echo @$detail->parking;?>" readonly>
                                                </div>
                                            </div>


                                    </form>
                                </div>
                            </div>
                        </div>

					</div>
				</div>
            </div>
            <div id="result"></div>
        </div>
