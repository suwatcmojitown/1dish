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