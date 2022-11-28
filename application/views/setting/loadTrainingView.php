<form id="trainingForm">                                
                                                                <label>Name : </label>
                                                                <div class="mb-1">
                                                                    <input type="text" value="<?php echo @$detail->title;?>" class="form-control" name="title">
                                                                    <input type="hidden" value="<?php echo @$detail->training_id;?>" class="form-control" name="training_id">
                                                                </div>

                                                                <label>Status : </label>
                                                                <div class="mb-1">
                                                                    <div class="position-relative graduated" data-select2-id="45">
                                                                        <select class="select2 form-select select2-hidden-accessible" name="status" id="status" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                            <option value="1" <?php if($detail->status=='1') echo 'selected';?> data-select2-id="">Publish</option>
                                                                            <option value="2" <?php if($detail->status=='2') echo 'selected';?> data-select2-id="">Unpublish</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
</form>