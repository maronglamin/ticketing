<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">

        <div class="col-lg-4">
            <div class="card mb-4">

                <div class="card-header">Report A concern</div>

                <div class="card-body">
                    <?=flash('success')?>
                    <form action="<?= route("mobifin/ticket/save") ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                        <?php foreach($ticketing_id as $id): 
                            $tid = $id['ticket_id'];?>
                        <?php endforeach;?>

                            <input type="hidden" name="ticketId" value="<?= "APSW-T" . ($tid + 1) ?>">
                            <input type="hidden" name="host" value="<?= clientHost() ?>">
                            <input type="hidden" name="email" value="<?= Http\model\ModelData::addUserEmail() ?>">
                            <input type="hidden" name="ticket_channel" value="MPR">

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="classification">Classification *</label>
                                    </div>
                                    <select class="custom-select" name="classification" id="classification">
                                        <option value="<?= old('classification')?>"><?= ((isset($_POST['classification']) ? $_POST['classification'] : old('classification')))?></option>
                                        <option value="Request">Request</option>
                                        <option value="Incident">Incident</option>
                                    </select>
                                </div>

                                <?php if(isset($errors['classification'])):?>
                                    <div><small style="color:red"><?=$errors['classification']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="category">Category *</label>
                                    </div>
                                    <select class="custom-select" name="category" id="category">

                                    <option value="<?= old('category')?>"><?= ((isset($_POST['category']) ? $_POST['category'] : old('category')))?></option>
                                    <?php foreach($categories as $category):?>   
                                        <option value="<?= $category['category']?>"><?= $category['category']?></option>
                                    <?php endforeach;?>
                                    <option value="OTHERS">Others</option>

                                    </select>
                                </div>

                                <?php if(isset($errors['category'])):?>
                                    <div><small style="color:red"><?=$errors['category']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="sub_category">Sub Category *</label>
                                    </div>
                                    <select class="custom-select" name="sub_category" id="sub_category">
                                    <option value="<?= old('sub_category')?>"><?= ((isset($_POST['sub_category']) ? $_POST['sub_category'] : old('sub_category')))?></option>
                                    <?php foreach($subCategories as $sub):?>
                                        <option value="<?= $sub['category']?>"><?= $sub['category']?></option>
                                    <?php endforeach;?>
                                        <option value="OTHERS">Others</option>
                                    </select>
                                </div>

                                <?php if(isset($errors['sub_category'])):?>
                                    <div><small style="color:red"><?=$errors['sub_category']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="source">Source (optional)</label>
                                    </div>
                                    <select class="custom-select" name="source" id="source">
                                    <option value="<?= old('source')?>"><?= ((isset($_POST['source']) ? $_POST['source'] : old('source')))?></option>
                                        <option value="CSO">CSO</option>
                                        <option value="DSA">DSA</option>
                                        <option value="Agent">Agent</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="department">Department</label>
                                    </div>
                                    <select class="custom-select" name="department" id="department">
                                    <option value="<?= old('department')?>"><?= ((isset($_POST['department']) ? $_POST['department'] : old('department')))?></option>
                                        <option value="Operations">Operations</option>
                                        <option value="Compliance">Compliance</option>
                                        <option value="Compliance">Call Center</option>
                                        <option value="APS Int. Reconciliation Office">APS Int. Reconciliation Office</option>
                                        <option value="Agent Operations">Agent Operations</option>
                                        <option value="Business Development">Business Development</option>
                                        <option value="Business Development">Finance</option>
                                        <option value="Business Development">HR</option>
                                    </select>
                                </div>

                                <?php if(isset($errors['department'])):?>
                                    <div><small style="color:red"><?=$errors['department']?></small></div>
                                <?php endif;?>
                            </div>


                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="priority">Priority *</label>
                                    </div>
                                    <select class="custom-select" name="priority" id="priority">
                                    <option value="<?= old('priority')?>"><?= ((isset($_POST['priority']) ? $_POST['priority'] : old('priority')))?></option>
                                        <option value="Low">Low</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>

                                <?php if(isset($errors['priority'])):?>
                                    <div><small style="color:red"><?=$errors['priority']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 mb-2">
                                <label for="discription">Discription</label>
                                <textarea name="discription" id="discription" rows="7" placeholder="Narration..." class="form-control" value="<?= old('discription')?>"></textarea>
                                <small>Detail down the issue/concern</small>

                                <?php if(isset($errors['discription'])):?>
                                    <div><small style="color:red"><?=$errors['discription']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 mt-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Attach</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="upload_file" name="upload_file">
                                        <label class="custom-file-label" for="upload_file">Choose file</label>
                                    </div>
                                </div>
                                <small>Attach a screenshot the event if applicable to better understand your request</small>


                                <?php if(isset($errors['upload_file'])):?>
                                    <div><small style="color:red"><?=$errors['upload_file']?></small></div>
                                <?php endif;?>
                            </div>


                            <div class="col-lg-12">
                                <input type="submit" value="Submit" class="btn btn-primary mt-3">
                            </div>

                        </div>
                    </form>
                </div>
                
            </div>
        </div>

        <!-- second section -->
        <div class="col-lg-8">
            <div class="card mb-4">

                <div class="card-header">Recent Requests</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table 
                            class="table 
                            table-borderless"
                            width="100%" 
                            cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Request_id</th>
                                    <th>Request_Date</th>
                                    <th>Classified As</th>
                                    <th>Category</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><strong><?= $value['ticketId'] ?></strong></td>
                                        <td><?= human($value['make_at']) ?></td>
                                        <td><?= $value['classification'] ?></td>
                                        <td><?= $value['category'] ?></td>
                                        <td><?= $value['priority'] ?></td>
                                        <td><strong><?= $value['status'] ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>

                </div>
                
            </div>
        </div>

    </div>

</div>