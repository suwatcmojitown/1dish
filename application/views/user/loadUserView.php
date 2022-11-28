<form id="userForm">                              
                                                                <label>Name : </label>
                                                                <div class="mb-1">
                                                                    <input type="text" value="<?php echo @$detail->username;?>" class="form-control" name="username">
                                                                    <input type="hidden" value="<?php echo @$detail->user_id;?>" class="form-control" name="user_id">
                                                                </div>

                                                                <label>Role : </label>
                                                                <div class="mb-1">
                                                                    <div class="position-relative graduated" data-select2-id="45">
                                                                        <select class="select2 form-select select2-hidden-accessible" name="role_id" id="role_id" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                            <option value="1" <?php if($detail->role_id=='1') echo 'selected';?> data-select2-id="">Super Admin</option>
                                                                            <option value="2" <?php if($detail->role_id=='2') echo 'selected';?> data-select2-id="">Admin</option>
                                                                            <option value="2" <?php if($detail->role_id=='3') echo 'selected';?> data-select2-id="">Writer</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <label>Status : </label>
                                                                <div class="mb-1">
                                                                    <div class="position-relative graduated" data-select2-id="45">
                                                                        <select class="select2 form-select select2-hidden-accessible" name="status" id="status" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                                            <option value="1" <?php if($detail->status=='1') echo 'selected';?> data-select2-id="">Publish</option>
                                                                            <option value="2" <?php if($detail->status=='2') echo 'selected';?> data-select2-id="">Unpublish</option>
                                                                            <option value="3" <?php if($detail->status=='3') echo 'selected';?> data-select2-id="">Pending</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
</form>