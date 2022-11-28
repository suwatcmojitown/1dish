


                <section id="basic-input">
                    <form id="addForm" action="<?php echo base_url('sale/calculate');?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="basicInput" style="padding-right: 80px;">ชื่อ</label>
                                                <input type="text" class="form-control" id="title" name="name" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="basicInput" style="padding-right: 20px;">น้ำหนักผลไม้</label>
                                                <input type="text" class="form-control" id="external_link" name="weight" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="basicInput" style="padding-right: 20px;">กล่อง</label>
                                                <div class="position-relative graduated" data-select2-id="45">
                                                    <select class="select2 form-select select2-hidden-accessible" name="box_size" id="box_size" data-select2-id="select2-basic" tabindex="-1" aria-hidden="true">
                                                        <option value="1" data-select2-id="">---- S ----</option>
                                                        <option value="2" data-select2-id="">---- M ----</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="offset-9 col-3">
                                            <button id="submit_btn" class="btn btn-primary waves-effect waves-float waves-light m-l-10" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </section>

                