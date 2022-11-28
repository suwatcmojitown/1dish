<label class="text-info form-label col-form-label-lg">สต็อก</label>
<?php 
//console($stockList);
?>
                                            <select class="default-select form-control wide mb-3" name="product_stock_id" id="product_stock_id">
                                                <option value="null" disabled selected style="font-size: 1.5rem;">เลือกสต็อก</option>
                                                <?php 
                                                if(isset($stockList)&&!empty($stockList))
                                                {
                                                    foreach($stockList as $row)
                                                    {
                                                ?>
                                                    <option value="<?php echo $row->id;?>|<?php echo @$row->quantity?>" style="font-size: 2.3rem;"><?php echo $row->barcode;?></option>
                                                <?php 
                                                    }
                                                }
                                                ?>
                                            </select>