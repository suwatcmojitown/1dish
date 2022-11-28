

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
                                    <li class="breadcrumb-item"><a href="index.html">List</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                    <div class="mb-1 breadcrumb-right">
                        <div >
                            <button onclick="location.href='<?php echo base_url('category/create');?>'" class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> + Create New Category</button>
                        </div>
                    </div>
                </div>
            </div>
            

            <div class="content-body">

                


                <div class="col-md-12 col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th width="30%"></th>
                                                    <th width="20%">Category</th>
                                                    <th width="20%">ประเภท</th>
                                                    <th width="30%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(isset($list)&&!empty($list)){
                                                    foreach($list as $row){
                                                ?>
                                                <tr>
                                                    <td>
                                                        <p class="fw-bolder mb-0"><?php echo $row->name?></p>
                                                        <span class="badge bg-<?php if($row->status=='1')echo 'success';else echo 'danger';?>"><?php if($row->status=='1')echo 'Enable';else echo 'Disable';?></span>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                        if(isset($row->parent_id)&&!empty($row->parent_id))
                                                        echo getCategoryName($row->parent_id);?>
                                                    </td>
                                                    <td>
                                                        <code><?php if($row->type=='1')echo 'Category';else echo 'Subcategory';?></code>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url('category/edit/').$row->category_id;?>"><button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="แก้ไข">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#7367f0" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path><polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon></svg>
                                                        </button></a>
                                                        <?php 
                                                        if($row->type=='1'){
                                                        ?>
                                                        <a href="<?php echo base_url('category/createSubcategory/').$row->category_id;?>"><button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect" style="color:rgb(115, 103, 240);" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="เพิ่ม Subcategory">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-folder-plus"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path><line x1="12" y1="11" x2="12" y2="17"></line><line x1="9" y1="14" x2="15" y2="14"></line></svg>
                                                        </button></a>
                                                        <?php 
                                                        }
                                                        ?>
                                                        <!--
                                                        <button type="button" class="btn btn-icon btn-icon rounded-circle btn-danger waves-effect waves-float waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="ลบ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                        </button>
                                                        -->
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
            
        </div>
    </div>
    <!-- END: Content-->
