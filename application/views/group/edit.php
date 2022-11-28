<div class="modal-dialog ">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"><i class="fa fa-pencil"></i> แก้ไขสิทธิ์</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" id="editForm">
                                                            <div class="form-group">
                                                                <label>ชื่อสิทธิ์</label>
                                                                <input type="hidden" name="id" value="<?php echo @$detail->id;?>">
                                                                <input type="text" class="form-control" id="title" name="title" value="<?php echo @$detail->title;?>">
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="form-group">
                                                                    <div class="col-sm-12">
                                                                        <div class="checkbox-list">
                                                                            <?php 
                                                                            if($adminMenu)
                                                                            {
                                                                                foreach($adminMenu as $row){
                                                                            ?>
                                                                            <label for="closeButton">
                                                                                <div class="checker" >
                                                                                    <span class="checked">
                                                                                        <input name="permission[]" type="checkbox" value="<?php echo $row->id?>" class="input-small"
                                                                                        <?php 
                                                                                        if($detail->permission){
                                                                                            if(in_array( $row->id , $detail->permission)) echo 'checked';
                                                                                        }
                                                                                        ?>
                                                                                        >
                                                                                    </span>
                                                                                </div>
                                                                                <?php echo $row->title?>
                                                                            </label>
                                                                            <?php 
                                                                                }
                                                                            }
                                                                            ?>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div  class="text-right">
                                                            <button type="button" id="editBtn" class="btn btn-primary text-right">ยืนยันการสร้าง</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

<script>
$("#editBtn").click(function(){
 
    var data = new FormData();

    //Form data
    var form_data = $('#editForm').serializeArray();
    $.each(form_data, function (key, input) {
        data.append(input.name, input.value);
    });
    
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('group/update')?>',
            data: data,
            processData: false,
            contentType: false,
            success: function(result) { 
                if(result==true)
                {
                    $('#editModal').modal('hide');
                    toastr.success('บันทึกข้อมูลในระบบเรียบร้อยแล้ว','แก้ไขสิทธิ์');
                    setTimeout(function() { 
                            var url = "<?php echo base_url('group/list');?>";    
                            $(location).attr('href',url);
                    }, 3000);
                } 
                else{
                    toastr.error('บันทึกข้อมูลในระบบไม่สำเร็จ','แก้ไขสิทธิ์');
                }
                
            }
        });
});
</script>