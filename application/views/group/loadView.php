<div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title"><i class="fa fa-eye"></i> สิทธิ์การเข้าถึง</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    
                                                        <form role="form" id="addForm">
                                                            <div class="form-group">
                                                                <h5><?php echo @$detail->title;?></h5>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">

                                                                <div class="form-group">
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
                                                        </form>
                    </div>
                </div>
</div>