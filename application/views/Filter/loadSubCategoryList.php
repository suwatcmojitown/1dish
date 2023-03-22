<select id="subcategory_id" class="form-select wide" aria-label="Default select example" style="font-size:1.09375rem;background: #fff;border: 0.0625rem solid #f0f1f5;padding: 0.3125rem 1.25rem;color: #6e6e6e;height: 3.5rem;border-radius: 0.5rem;">
                                                  <option value="">-- หมวดหมู่ย่อย --</option>
                                                  <?php 
                                                  if(isset($list)&&!empty($list)){
                                                    foreach($list as $row){
                                                  ?>
                                                  <option value="<?php echo $row->id?>"><?php echo @$row->title_th;?></option>
                                                  <?php 
                                                    }
                                                  }
                                                  ?>
</select>