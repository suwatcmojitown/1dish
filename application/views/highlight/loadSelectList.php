<ol class="dd-list" >
                <?php 
                                                        if(isset($selectList)&&!empty($selectList)){
                                                        foreach($selectList as $row){
                                                        ?>
                                                        <li class="dd-item" data-id="<?php echo @$row->product_id;?>" style="z-index: 100;">
                                                            <div class="dd-handle custom ">
                                                                <div class="row">
                                                                    <div class="col-5">
                                                                        <img style="max-height: 90px;display: inline;max-width: 350px;" src="<?php echo @$row->image_url;?>">
                                                                        </div>
                                                                    <div class="offset-4 col-3">
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