<label class="text-custom form-label col-form-label-lg">หมวดหมู่ย่อย</label>
                                                <select class="default-select form-control wide mb-3" id="subcategory_id" name="subcategory_id" style="font-size: 1rem!important;">
                                                        <option value="null" disabled selected> --- กรุณาเลือก --- </option>
                                                        <?php 
                                                        if(isset($subCategoryList)&&!empty($subCategoryList))
                                                        {
                                                            foreach($subCategoryList as $row)
                                                            {
                                                        ?>
                                                            <option  value="<?php echo $row->id;?>"><?php echo $row->title_th;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>
</select>