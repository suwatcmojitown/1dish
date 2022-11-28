<table class="table">
                                    <thead>
                                        <tr>
                                            <th width="30%">Name</th>
                                            <th width="15%">Role</th>
                                            <th width="15%">Date</th>
                                            <th width="15%">Status</th>
                                            <th width="25%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <div id="result"></div>
                                        <?php 
                                        if(isset($list)&&!empty($list)){
                                            foreach($list as $row){
                                        ?>
                                        <tr class="odd">
                                            <td class=" control" tabindex="0" style="display: none;"></td>
                                            <td class="sorting_1">
                                                <div class="d-flex justify-content-left align-items-center">
                                                    <div class="d-flex flex-column">
                                                        <a href="app-user-view-account.html" class="user_name text-truncate text-body">
                                                            <span class="fw-bolder"><?php echo $row->username;?></span>
                                                        </a>
                                                        <small class="emp_post text-muted"><?php echo $row->email;?></small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="text-truncate align-middle">
                                                    <?php if($row->role_id=='3'){?>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 font-medium-3 text-info me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg> Writer
                                                    <?php }elseif($row->role_id=='2'){?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user font-medium-3 text-primary me-50"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                                    Admin
                                                    <?php }else{?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slack font-medium-3 text-danger me-50"><path d="M14.5 10c-.83 0-1.5-.67-1.5-1.5v-5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5z"></path><path d="M20.5 10H19V8.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5-.67 1.5-1.5 1.5z"></path><path d="M9.5 14c.83 0 1.5.67 1.5 1.5v5c0 .83-.67 1.5-1.5 1.5S8 21.33 8 20.5v-5c0-.83.67-1.5 1.5-1.5z"></path><path d="M3.5 14H5v1.5c0 .83-.67 1.5-1.5 1.5S2 16.33 2 15.5 2.67 14 3.5 14z"></path><path d="M14 14.5c0-.83.67-1.5 1.5-1.5h5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-5c-.83 0-1.5-.67-1.5-1.5z"></path><path d="M15.5 19H14v1.5c0 .83.67 1.5 1.5 1.5s1.5-.67 1.5-1.5-.67-1.5-1.5-1.5z"></path><path d="M10 9.5C10 8.67 9.33 8 8.5 8h-5C2.67 8 2 8.67 2 9.5S2.67 11 3.5 11h5c.83 0 1.5-.67 1.5-1.5z"></path><path d="M8.5 5H10V3.5C10 2.67 9.33 2 8.5 2S7 2.67 7 3.5 7.67 5 8.5 5z"></path></svg> Super Admin
                                                    <?php }?>
                                                </span>
                                                
                                            </td>
                                            <td><span class="text-nowrap"><?php echo $row->create_date;?></span></td>
                                            <td>
                                                <!--
                                                <span class="badge rounded-pill badge-light-<?php if($row->status=='1')echo 'success';elseif($row->status=='2')echo 'danger';else echo 'warning';?>" text-capitalized="">
                                                <?php if($row->status=='1')echo 'Active';elseif($row->status=='2')echo 'Inactive';else echo 'Pending';?>
                                                    
                                                </span>
                                                -->
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-outline-<?php if($row->status=='1')echo 'success';elseif($row->status=='2')echo 'danger';else echo 'warning';?> dropdown-toggle waves-effect" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <?php if($row->status=='1')echo 'Active';elseif($row->status=='2')echo 'Inactive';else echo 'Pending';?>
                                                    </button>
                                                    <div class="dropdown-menu statusDD">
                                                        <a class="dropdown-item" value="1-<?php echo $row->user_id;?>">Active</a>
                                                        <a class="dropdown-item" value="2-<?php echo $row->user_id;?>">Inactive</a>
                                                        <a class="dropdown-item" value="3-<?php echo $row->user_id;?>">Pending</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('content/edit/').$row->user_id;?>"><button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="แก้ไข">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                </button></a>
                                                <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="อนุมัติ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php 
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="card-body d-flex justify-content-center">
                                    <button type="button" class="btn btn-flat-success waves-effect" id="prevBtn" value="<?php if(($paging['active_page']-1)>=0)echo $paging['active_page']-1;?>">
                                                <span><strong><</strong> Previous</span>
                                            </button>
                                    <button type="button" class="btn btn-flat-success waves-effect" id="nextBtn" value="<?php if(($paging['active_page']+1)<=$paging['total_page'])echo $paging['active_page']+1;?>">
                                                <span>Next <strong>></strong></span>
                                    </button>
                                </div>


<script>
    $('.statusDD a').on('click', function(){
            $(this).addClass('active');
            $('.statusDD a').not(this).removeClass('active');

            var status = '';
            var user_id = '';

            var page = <?php echo $page;?>;
            var keysearch = '';

            keysearch = document.getElementById("keysearch").value;

            $(".statusDD a").each(function(){ 
                if($(this).hasClass("active")) { 
                    temp_status = $(this).attr("value");
                    const tempArray = temp_status.split("-");
                    status = tempArray[0];
                    user_id = tempArray[1];
                }
            });

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('user/changeStatus')?>',
                        data: 'status='+status+'&user_id='+user_id+'',
                        success: function(result) { 
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url('user/loadUserList')?>',
                                data: 'page='+page+'&keysearch='+keysearch+'',
                                success: function(result) { 
                                    $("#_list").html(result);   
                                }
                            });  
                        }
            });
    });

    $('#nextBtn').on('click', function(){
            
            var page = '';
            var keysearch = '';

            page = document.getElementById("nextBtn").value;

            keysearch = document.getElementById("keysearch").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('user/loadUserList')?>',
                        data: 'page='+page+'&keysearch='+keysearch+'',
                        success: function(result) { 
                            $("#_list").html(result);   
                        }
            });
    });

    $('#prevBtn').on('click', function(){
            
            var page = '';
            var keysearch = '';

            page = document.getElementById("prevBtn").value;

            keysearch = document.getElementById("keysearch").value;

            $.ajax({
                        type: 'POST',
                        url: '<?php echo base_url('user/loadUserList')?>',
                        data: 'page='+page+'&keysearch='+keysearch+'',
                        success: function(result) { 
                            $("#_list").html(result);   
                        }
            });
    });

</script>