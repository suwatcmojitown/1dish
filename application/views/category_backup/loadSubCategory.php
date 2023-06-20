        <label>หมวดหมู่ย่อย</label>
        <select class="form-control" id="subCategory" name="subCategory">
            <option value="">-- ทุกหัวข้อ --</option>
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