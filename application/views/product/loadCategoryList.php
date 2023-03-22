<label class="text-custom form-label col-form-label-lg">หมวดหมู่</label>
                                                <select class="default-select form-control wide mb-3" id="category_id" name="category_id" onchange="categoryChange()" style="font-size: 1rem!important;">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($categoryList)&&!empty($categoryList))
                                                        {
                                                            foreach($categoryList as $row)
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
                                                </select>