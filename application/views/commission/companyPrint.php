<script
  src="https://code.jquery.com/jquery-3.6.1.js"
  integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
	<script src="<?php echo base_url('app-assets/')?>js/jquery.PrintArea.js" type="text/JavaScript"></script>
<style>
	.print{
		display: flex;
	    flex-wrap: wrap;
	    margin-right: -10px;
	    margin-left: -10px;
	}
	.noline{
		border-width: 0;
	}
</style>
<div class="row">
	<?php //console($detail);?>
                    <div class="col-md-4" >
                        <div class="card card-body printableArea" style="font-size:14px;width:450px;margin-left:2px;margin-right:10px;font-weight: bold;font-family: tahoma;">
                            
                            
							<div class="row">
                                <div class="col-md-12" align="center">
									<img src="<?php echo base_url()?>app-assets/images/logo.jpg" alt="logo" width="180" style="padding-right:5rem;">
								</div>
							</div>
							<br>
							<div> 
								<span style="padding-left: 6rem;">Rep Grp ( Tour Company )</span>
							</div>
							<br>
							<div class="row print">
                                <div style="width:250px;" align="left">
								<?php echo @$detail->transfer_date;?>
								</div>
								<div style="width:50px;padding-right:3px;" align="right">
								คอม
								</div>
								<div style="width:100px;" align="right">
								<?php echo number_format(@$detail->total);?>
								</div>
							</div>
							<div class="row print">
                                <div style="width:400px;" align="left">
								<?php echo @$detail->guide_name.' | '.@$detail->guide_code;?>
								</div>
							</div>
							<div class="row print">
                                <div style="width:250px;" align="left">
								<?php echo @$detail->short_name.' '.@$detail->company_name;?>
								</div>
								<div style="width:50px;padding-right:3px;" align="right">
								ยอด
								</div>
								<div style="width:100px;" align="right">
								<?php echo number_format(@$detail->bill_grandTotal);?>
								</div>
							</div>
							<hr class="noline" style="margin-top:5px!important;margin-bottom:14px!important;">

							<div class="row print" style="margin-top:3px;">
									<div style="width:250px;" align="left">
									สินค้า
									</div>
									<div style="width:50px;padding-right:3px;" align="right">
									จำนวน
									</div>
									<div style="width:100px;" align="right">
									ค่าคอม
									</div>
							</div>
                            <?php 
							//console($objResult);
							if(isset($detail->bill_item)&&!empty($detail->bill_item)){
							foreach($detail->bill_item as $row){
							?>
							<div class="row print" style="margin-top:3px;">
									<div style="width:250px;" align="left">
									<?php echo @$row->product_name_en;?>
									</div>
									<div style="width:50px;padding-right:3px;" align="right">
									<?php echo @$row->quantity;?>
									</div>
									<div style="width:100px;" align="right">
									<?php echo @($row->price);?>
									</div>
							</div>
							<?php
							}
							?>
							
								
								<div class="row print" style="margin-top:7rem!important;">
	                                <div style="width:220px;" align="center">
									ผู้จ่ายเงิน
									</div>
									<div style="width:220px;" align="center">
									ผู้รับเงิน
									</div>
								</div>
								<div class="row print" style="margin-top:2rem!important;">
	                                <div style="width:220px;" align="center">
									
									</div>
									<div style="width:220px;" align="center">
									______/______/______
									</div>
								</div>
								<div class="row print" style="margin-top:1rem!important;">
	                                <div style="width:220px;" align="center">
									
									</div>
									<div style="width:220px;" align="center">
									วันที่รับ
									</div>
								</div>
							<?php 
							}
							?>	
                        </div>
                    </div>
					<!--
					<div class="text-right">
                                        <button class="btn btn-danger" type="submit"> Proceed to payment </button>
                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                                    </div>
					-->				
                </div>

    
    <script>
    
	$(document).ready(function() { 
      setTimeout(function () {var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
       
    }, 1000)
	
		/*
		setInterval(function () {
             window.location.replace('<?php echo base_url("pos/landing")?>');
        }, 3000)
        */
	
	});
</script>