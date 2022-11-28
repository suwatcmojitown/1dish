<div class="content-body custom">
            <div class="container-fluid">
                <!-- row -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header order-info">
                                <h3 class="card-title"><i class="fas fa-user-alt"></i> ลงทะเบียน</h3>
                            </div>
                            <div class="card-body">
								<div id="smartwizard" class="form-wizard custom order-create" style="border: 0px!important;">
									<ul class="nav nav-wizard custom mb-5" id="nav_ul" style="box-shadow: none !important;">
										<li><a class="nav-link" href="#group"> 
											<span>1</span> 
										</a></li>
										<li><a class="nav-link" href="#percent">
											<span>2</span>
										</a></li>
										<li><a class="nav-link" href="#contact">
											<span>3</span>
										</a></li>
										<li><a class="nav-link" href="#info">
											<span>4</span>
										</a></li>
										<li><a class="nav-link" href="#com">
											<span>5</span>
										</a></li>
									</ul>
									<div class="tab-content">
										<div id="group" class="tab-pane form-custom" role="tabpanel">
											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ชื่อบริษัท</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="name">
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                        	<label class="col-sm-3 col-form-label custom text-info">รูปถ่าย</label>
	                                            <div class="col-sm-9">
	                                                <input type="file" class="form-control form-control-lg" name="image">
	                                            </div>
	                                        </div>

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ประเภท</label>
	                                            <div class="col-sm-9 select-custom">
	                                                <select class="form-control " name="company_type" >
		                                                <option value="null" disabled selected> --- กรุณาเลือก --- </option>
		                                                <option value="1">ส่วนบุคคล</option>
		                                                <option value="2">นิติบุคคล</option>
		                                            </select>
	                                            </div>
	                                        </div>

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">สาขา</label>
	                                            <div class="col-sm-9 select-custom">
	                                                <select class="form-control " name="branch_type" >
		                                                <option value="null" disabled selected> --- กรุณาเลือก --- </option>
		                                                <option value="1">สำนักงานใหญ่</option>
		                                                <option value="2">สาขา</option>
		                                            </select>
	                                            </div>
	                                        </div>
	                                        
										</div>
										<div id="percent" class="tab-pane" role="tabpanel">

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">เลขผู้เสียภาษี</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="tax_no">
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ที่อยู่</label>
	                                            <div class="col-sm-9">
	                                                <textarea class="form-control  form-control-lg" style="padding-top:7px;" name="address"></textarea>
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">เบอร์โทรศัพท์</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="telephone">
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">Fax</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="contact_email">
	                                            </div>
	                                        </div>
										</div>

										<div id="contact" class="tab-pane" role="tabpanel">
											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ชื่อผู้ติดต่อ</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="contact_name">
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">E-mail ผู้ติดต่อ</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="contact_email">
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">เบอร์โทรศัพท์ผู้ติดต่อ</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" name="contact_telephone">
	                                            </div>
	                                        </div>	

										</div>

										<div id="info" class="tab-pane" role="tabpanel">

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ชื่อบัญชีธนาคาร</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" placeholder="" name="bank_account_name">
	                                            </div>
	                                        </div>

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ธนาคาร</label>
	                                            <div class="col-sm-9 select-custom">
	                                                <select class="form-control " name="bank_id" >
		                                                <option value="null" disabled selected> --- กรุณาเลือก --- </option>
		                                                <?php 
                                                        if(isset($bankList)&&!empty($bankList))
                                                        {
                                                            foreach($bankList as $row)
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->name;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
		                                            </select>
	                                            </div>
	                                        </div>

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">สาขา</label>
	                                            <div class="col-sm-9">
	                                                <input type="text" class="form-control form-control-lg" placeholder="" name="bank_branch">
	                                            </div>
	                                        </div>

	                                        <div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ประเภทบัญชีธนาคาร</label>
	                                            <div class="col-sm-9 select-custom">
	                                                <select class="form-control " name="bank_type">
		                                                <option value="null" disabled selected> --- กรุณาเลือก --- </option>
		                                                <option>ออมทรัพย์</option>
		                                                <option>กระแสรายวัน</option>
		                                            </select>
	                                            </div>
	                                        </div>

											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">รูปถ่ายบัญชีธนาคาร</label>
	                                            <div class="col-sm-9">
	                                                <input type="file" class="form-control form-control-lg" name="bank_image">
	                                            </div>
	                                        </div>

										</div>
										<div id="com" class="tab-pane" role="tabpanel">
											<div class="mb-3 row">
	                                            <label class="col-sm-3 col-form-label custom text-info">ค่าคอมไกด์</label>
	                                            <div class="col-sm-9 select-custom">
	                                                <select class="form-control " name="company_commission">
		                                                <option value="null" disabled selected> --- กรุณาเลือก --- </option>
		                                                <option>10%</option>
		                                                <option>15%</option>
		                                                <option>20%</option>
		                                                <option>25%</option>
		                                            </select>
	                                            </div>
	                                        </div>	

										</div>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


  <script>
  $(document).ready(function () {

    // Toolbar extra buttons
    var btnFinish = $('<button></button>').text('Enregistrer')
            .addClass('btn btn-danger')
            .on('click', function () {
                if (!$(this).hasClass('disabled')) {
                    var elmForm = $('form[name="blogbundle_dossier"]');

                    if (elmForm) {
                        elmForm.validator('validate');
                        $(elmForm).prop('disabled', false);
                        var elmErr = elmForm.find('.has-error');
                        if (elmErr && elmErr.length > 0) {
                            alert('Oops we still have error in the form');
                            return false;
                        } else {
                            alert('Great! we are ready to submit form');
                            elmForm.submit();
                            return false;
                        }
                    }
                }
            });
}

  </script> 