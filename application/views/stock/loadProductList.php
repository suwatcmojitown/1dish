<label class="text-info form-label col-form-label-lg" id="_productList">สินค้า</label>
                                            <select id="product_id" class="default-select form-control wide mb-3"name="product_id" onchange="productChange()">
                                                <option value="null" disabled selected style="">เลือกสินค้า</option>
                                                <?php 
                                                //console($productList);
                                                if(isset($productList)&&!empty($productList))
                                                {
                                                    foreach($productList as $row)
                                                    {
                                                ?>
                                                    <option value="<?php echo $row->id;?>" style=""><?php echo $row->name_th;?></option>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </select>

                                            <script>
  $("#product_id").select2();</script>