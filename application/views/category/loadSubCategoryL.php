        <label class="col-sm-2 col-form-label">หมวดหมู่ย่อย</label>
                                                        <div class="col-sm-3">
                                                                <select class="form-control" id="subCategory" name="subCategory">
                                                                        <option value="">-- เลือกหมวดหมู่ย่อย --</option>
                                                                        <?php 
                                                                        if($subCategoryList){
                                                                            foreach($subCategoryList as $row){
                                                                        ?>
                                                                            <option value="<?php echo $row->id?>" ><?php echo $row->title;?></option>
                                                                        <?php 
                                                                            }
                                                                        }
                                                                        ?>
                                                                </select>
                                                        </div>
        