<!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                   <?php 
                   //getParentList(12604);
                   //console($list);
                   ?> 
                   <!-- Column -->
                    <div class="col-md-12 col-lg-12">
                        <div class="card">

                            <div class="card-body">
                                
                                <hr class="m-t-0 m-b-20">
                               
                                <div class="row m-b-15">
                                        <div class="col-md-12 align-self-right">
                                            <div class="row">
                                                <div class="col-md-4">
                                                        <input type="text" id="search" name="search" class="form-control" placeholder="คำค้นหา">
                                                </div> 
                                                <div class="col-md-2">
                                                      <button type="button" class="btn btn-info d-none d-lg-block m-l-15" style="background-color:#f9a935;border:1px solid #f9a935;"><i class="fa fa-search"></i> ค้นหา</button>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                
                                
                                <!--second tab-->
                                <div class="table-responsive dataTables_wrapper">
                                        <table class="table color-table warning-table ">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%;">#</th>
                                                    <th style="width:10%;">รหัสนักเรียน</th>
                                                    <th style="width:15%;">ชื่อ - นามสกุล</th>
                                                    <th style="width:15%;">ระดับชั้น</th>
                                                    <th style="width:10%;"></th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-muted">
                                                <?php 
                                                    //console($list);
                                                    if(isset($list)&&!empty($list)){
                                                        $i = 1;
                                                        foreach($list as $row)
                                                        {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td>
                                                    <td><?php echo $row->student_no;?></td>
                                                    <td><?php echo $row->name_th;?></td>
                                                    <td><?php echo $row->room;?></td>
                                                    <td class="text-nowrap" style="font-size: 17px;">
                                                        <button class="open-AddBookDialog btn btn-success" type="button" data-id="<?php echo $row->id;?>" data-toggle="modal" data-target="#responsive-modal"> <span>บันทึกเวลา</span> </button>
                                                        <button class="open-AddBookDialog2 btn btn-danger" type="button" data-id="<?php echo $row->id;?>" data-toggle="modal" data-target="#responsive-modal2"> <span>ลา</span></button>
                                                        <button class="open-AddBookDialog3 btn btn-purple" type="button" data-id="<?php echo $row->id;?>" data-toggle="modal" data-target="#responsive-modal3"> <span style="color:white;">กลับก่อนเวลา</span> </button>
                                                    </td>
                                                </tr>
                                                <?php 
                                                        $i++;
                                                        }
                                                    }    
                                                ?>
                                            </tbody>
                                        </table>
                                    <hr>
                                    
                                </div>
                                   
                            </div>        
                            
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

            <!-- modal -->
            <div id="responsive-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg" >
                                                        <div class="modal-content">
                                                            <div class="modal-header alert-success">
                                                                <h4 class="modal-title"><i class="fa fa-file-o"></i> แจ้งบันทึกเวลา</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="cus_order_add.php" >
                                                                    <div class="row m-t-10">
                                                                        <input type="hidden" id="bookId" class="form-control" placeholder="กรอกชื่อวิชา" aria-describedby="search-txt"> 
                                                                        <input type="hidden" id="status" value="6"> 
                                                                        
                                                                        <div class="col-md-2 text-success" >
                                                                                ผู้ติดต่อ
                                                                        </div>
                                                                        <div class="col-md-3" >
                                                                                <select class="form-control custom-select text-muted" id="is_parent" >
                                                                                                <option value="0">-- เลือกผู้ติดต่อ --</option>
                                                                                                <option value="1">ผู้ปกครอง</option>
                                                                                                <option value="2">บุคคลอื่น</option>
                                                                                </select>     
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-15">
                                                                        <div class="col-md-2 text-success" style="padding-top: 7px;">
                                                                                รายละเอียด
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <textarea type="text" id="description" class="form-control"></textarea>   
                                                                                <small class="form-control-feedback text-danger">ในกรณีที่เป็นบุคคลอื่นมาแจ้ง ให้ใส่ชื่อและเบอร์โทรศัพท์ติดต่อ</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-15">
                                                                        <div class="col-md-2 text-success" >
                                                                                เวลา
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                <input type="datetime-local" id="date_time" class="form-control" style="padding-top: 7px;">  
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-top:21px;"></div> 
                                                                    <div class="text-right m-b-10">
                                                                        <button type="button" class="btn btn-danger waves-effect waves-light alert-primary">ยกเลิก</button>
                                                                        <button type="button" class="btn btn-success waves-effect waves-light alert-success" id="submit_btn">บันทึก</button>
                                                                    </div>
                                                                </form>    
                                                            </div>
                                                                
                                                        </div>
                                                    </div>
            </div>
            <!-- modal --> 

            <!-- modal -->
            <div id="responsive-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg" >
                                                        <div class="modal-content">
                                                            <div class="modal-header alert-danger">
                                                                <h4 class="modal-title"><i class="fa fa-file-o"></i> ลา</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="cus_order_add.php" >
                                                                    <div class="row m-t-10">
                                                                        <input type="hidden" id="bookId" class="form-control" placeholder="กรอกชื่อวิชา" aria-describedby="search-txt"> 
                                                                        <input type="hidden" id="a_status" value="5">
                                                                        <div class="col-md-2 text-danger" >
                                                                                ผู้ติดต่อ
                                                                        </div>
                                                                        <div class="col-md-3" >
                                                                                <select class="form-control custom-select text-muted" id="a_is_parent" >
                                                                                                <option value="0">-- เลือกผู้ติดต่อ --</option>
                                                                                                <option value="1">ผู้ปกครอง</option>
                                                                                                <option value="2">บุคคลอื่น</option>
                                                                                </select>     
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-15">
                                                                        <div class="col-md-2 text-danger" style="padding-top: 7px;">
                                                                                รายละเอียด
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <textarea type="text" id="a_description" class="form-control"></textarea>   
                                                                                <input type="hidden" id="bookId" class="form-control" placeholder="กรอกชื่อวิชา" aria-describedby="search-txt">      
                                                                                <small class="form-control-feedback text-danger">ในกรณีที่เป็นบุคคลอื่นมาแจ้ง ให้ใส่ชื่อและเบอร์โทรศัพท์ติดต่อ</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-15">
                                                                        <div class="col-md-2 text-danger" >
                                                                                เวลา
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                <input type="datetime-local" id="a_date_time" class="form-control" style="padding-top: 7px;">  
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-top:21px;"></div> 
                                                                    <div class="text-right m-b-10">
                                                                        <button type="button" class="btn btn-danger waves-effect waves-light alert-primary">ยกเลิก</button>
                                                                        <button type="button" id="submitAbsentbtn" class="btn btn-success waves-effect waves-light alert-success" id="submit_btn">บันทึก</button>
                                                                    </div>
                                                                </form>    
                                                            </div>
                                                                
                                                        </div>
                                                    </div>
            </div>
            <!-- modal -->   

            <!-- modal -->
            <div id="responsive-modal3" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog modal-lg" >
                                                        <div class="modal-content">
                                                            <div class="modal-header alert-purple">
                                                                <h4 class="modal-title"><i class="fa fa-file-o"></i> ลา</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="post" action="cus_order_add.php" >
                                                                    <div class="row m-t-10">
                                                                        <input type="hidden" id="bookId" class="form-control" placeholder="กรอกชื่อวิชา" aria-describedby="search-txt"> 
                                                                        <input type="hidden" id="t_status" value="3">
                                                                        
                                                                        <div class="col-md-2 text-purple" >
                                                                                ผู้ติดต่อ
                                                                        </div>
                                                                        <div class="col-md-3" >
                                                                                <select class="form-control custom-select text-muted" id="t_is_parent" >
                                                                                                <option value="0">-- เลือกผู้ติดต่อ --</option>
                                                                                                <option value="1">ผู้ปกครอง</option>
                                                                                                <option value="2">บุคคลอื่น</option>
                                                                                </select>     
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-15">
                                                                        <div class="col-md-2 text-purple" style="padding-top: 7px;">
                                                                                รายละเอียด
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                                <textarea type="text" id="t_description" class="form-control"></textarea>   
                                                                                <small class="form-control-feedback text-danger">ในกรณีที่เป็นบุคคลอื่นมาแจ้ง ให้ใส่ชื่อและเบอร์โทรศัพท์ติดต่อ</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row m-t-15">
                                                                        <div class="col-md-2 text-purple" >
                                                                                เวลา
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                                <input type="datetime-local" id="t_date_time" class="form-control" style="padding-top: 7px;">  
                                                                        </div>
                                                                    </div>
                                                                    <div style="margin-top:21px;"></div> 
                                                                    <div class="text-right m-b-10">
                                                                        <button type="button" class="btn btn-danger waves-effect waves-light alert-primary">ยกเลิก</button>
                                                                        <button type="button" id="submitBeforeTime" class="btn btn-success waves-effect waves-light alert-success" id="submit_btn">บันทึก</button>
                                                                    </div>
                                                                </form>    
                                                            </div>
                                                                
                                                        </div>
                                                    </div>
            </div>
            <!-- modal -->                                                 

        <script>
                    $(document).on("click", ".open-AddBookDialog", function () {
                        var myBookId = $(this).data('id');
                        $(".modal-body #bookId").val( myBookId );
                        
                    });

                    $("#submit_btn").click(function(){
                        
                        student_id = document.getElementById("bookId").value;
                        date_time = document.getElementById("date_time").value;
                        description = document.getElementById("description").value;
                        is_parent = document.getElementById("is_parent").value;
                        status = document.getElementById("status").value;
                        
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('hr/')?>addEvent',
                            data: 'student_id='+student_id+'&description='+description+'&date_time='+date_time+'&status='+status+'&is_parent='+is_parent,
                            success: function(result) {   
                                alert(result);
                                //location.reload();
                            }
                        });
                    });

                    $(document).on("click", ".open-AddBookDialog2", function () {
                        var myBookId = $(this).data('id');
                        $(".modal-body #bookId").val( myBookId );
                        
                    });

                    $("#submitAbsentbtn").click(function(){
                        student_id = document.getElementById("bookId").value;
                        date_time = document.getElementById("a_date_time").value;
                        description = document.getElementById("a_description").value;
                        is_parent = document.getElementById("a_is_parent").value;
                        status = document.getElementById("a_status").value;
                        
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('hr/')?>addEvent',
                            data: 'student_id='+student_id+'&description='+description+'&date_time='+date_time+'&status='+status+'&is_parent='+is_parent,
                            success: function(result) {   
                                alert(result);
                                //location.reload();
                            }
                        });
                    });

                    $(document).on("click", ".open-AddBookDialog3", function () {
                        var myBookId = $(this).data('id');
                        $(".modal-body #bookId").val( myBookId );
                        
                    });

                    $("#submitBeforeTime").click(function(){
                        student_id = document.getElementById("bookId").value;
                        date_time = document.getElementById("t_date_time").value;
                        description = document.getElementById("t_description").value;
                        is_parent = document.getElementById("t_is_parent").value;
                        status = document.getElementById("t_status").value;
                        
                        $.ajax({
                            type: 'POST',
                            url: '<?php echo base_url('hr/')?>addEvent',
                            data: 'student_id='+student_id+'&description='+description+'&date_time='+date_time+'&status='+status+'&is_parent='+is_parent,
                            success: function(result) {   
                                alert(result);
                                //location.reload();
                            }
                        });
                    });


                    
     </script>