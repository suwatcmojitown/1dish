<ol class="dd-list" >
                <?php 
                                                        if(isset($selectList)&&!empty($selectList)){
                                                        foreach($selectList as $row){
                                                        ?>
                                                        <li class="dd-item" data-id="<?php echo @$row->product_id;?>" style="z-index: 100;">
                                                            <div class="dd-handle custom ">
                                                                <div class="row">
                                                                    <div class="col-3">
                                                                        <img style="max-height: 70px;max-width: 140px;display: inline;" src="<?php echo @$row->image_url;?>">
                                                                        </div>
                                                                    <div class="col-5">
                                                                        <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th;?></h4>
                                                                        <normal style="display:block;" > 
                                                                        <span class="text-custom" style="font-weight: 300!important;font-size: 1.2rem;"><?php echo @$row->title_en;?></span>
                                                                        </normal>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <button onclick="deleteContent(<?php echo $row->id;?>)" type="button" class="btn btn-danger btn-sm" style="float:right;"><i class="fa fa-trash"></i></button>
                                                                        <button onclick="editContent(<?php echo $row->id;?>)" type="button" class="btn btn-warning btn-sm" style="float:right;margin-right: 4px;"><i class="fa fa-pencil-alt"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php 
                                                        }
                                                        }
                                                        ?>
            </ol>