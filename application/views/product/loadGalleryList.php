<?php 
                                if(isset($galleryList)&&!empty($galleryList)){
                                ?>
                                <div class="row">
                                    <?php 
                                    foreach($galleryList as $row){
                                    ?>
                                    <div class="col-lg-3 col-md-6 mb-4" style="text-align: center;">
                                        <img src="<?php echo @$row->image_url;?>" alt="" class="w-100"/>
                                        <button onclick="removePic(<?php echo $row->id;?>,<?php echo $row->product_id;?>);"type="button" class="btn light btn-danger btn-sm mt-2" style="font-size:2rem;">Remove</button>
                                    </div>
                                    <?php 
                                    }
                                    ?>
                                </div>
                                <?php 
                                }
                                ?>