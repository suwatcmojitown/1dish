<?php 
                                                if(isset($topSliderList)&&!empty($topSliderList))
                                                {
                                                    foreach($topSliderList as $row)
                                                    {
                                                ?>
                                                <li class="list-group-item">
                                                    <div class="d-flex row">
                                                        <img src="<?php 
                                                        if(@$row->image=='')echo base_url('assets/images/default-thumbnail.jpg');
                                                        else echo base_url().$row->image;
                                                        ?>" class="img-fluid col-3" alt="img-placeholder"/>
                                                        <div class="more-info col-7">
                                                            <h5 class="text-purple-500"><?php echo @$row->title;?></h5>
                                                            <span><?php echo @$row->external_link;?></span>
                                                        </div>
                                                        <div class="col-2">
                                                            <button type="button" class="btn btn-icon btn-icon rounded-circle btn-flat-danger waves-effect" onclick="removeFromList()">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php 
                                                    }
                                                }
                                                ?>