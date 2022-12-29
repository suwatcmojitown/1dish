<option value="" selected>  กรุณาเลือกกรุ๊ปทัวร์  </option>
                                                        <?php 
                                                        if(isset($groupList)&&!empty($groupList))
                                                        {
                                                            foreach($groupList as $row)
                                                            {
                                                        ?>
                                                            <option value="<?php echo $row->id;?>"><?php echo $row->group_sign;?></option>
                                                        <?php 
                                                            }
                                                        }
                                                        ?>