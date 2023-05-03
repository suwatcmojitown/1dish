 <?php 
                                                        if(isset($contentList)&&!empty($contentList)){
                                                        foreach($contentList as $row){
                                                        ?>
                                                        <li class="dd-item" data-id="<?php echo @$row->id;?>">
                                                            <div class="dd-handle custom ">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <img style="max-height: 70px;display: inline;" src="<?php echo @$row->image_url;?>">
                                                                        </div>
                                                                    <div class="col-8">
                                                                        <h4 class="text-custom mb-1 name" style="font-weight: 400;"><?php echo @$row->title_th;?></h4>
                                                                        <normal style="display:block;" > 
                                                                        <span class="text-custom" style="font-weight: 300!important;font-size: 1.2rem;">#<?php echo @$row->id;?></span>
                                                                        </normal>
                                                                    </div>
                                                                    <div class="col-2" >
                                                                        <button onclick="addShelfContent(<?php echo $row->id;?>)" type="button" class="btn btn-success btn-sm" style="float:right;"><i class="fa fa-plus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php 
                                                        }
                                                        }
                                                        ?>