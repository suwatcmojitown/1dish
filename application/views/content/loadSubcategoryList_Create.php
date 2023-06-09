<div class="mb-1">
                                                <label class="form-label" for="exampleFormControlTextarea1">Subcategory</label>
                                                <div class="p-b-5 subcategory">
                                                    <?php 
                                                    foreach($subcategoryList as $row){
                                                    ?>
                                                    <button type="button" class="btn btn-outline-primary waves-effect" value="<?php echo $row->category_id?>"><?php echo $row->name;?></button>
                                                    <?php 
                                                    }
                                                    ?>
                                                </div>

</div>