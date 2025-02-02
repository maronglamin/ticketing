<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">

        <div class="col-lg-4">
            <div class="card mb-4">

                <div class="card-header">Send Request</div>

                <div class="card-body">
                    <?=flash('success')?>
                    <form action="<?= route("mobifin/ticket/save") ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                        <?php foreach($ticketing_id as $id): 
                            $tid = $id['ticket_id'];?>
                        <?php endforeach;?>

                            <input type="hidden" name="ticketId" value="<?= "APSW-T" . ($tid + 1) ?>">
                            <input type="hidden" name="host" value="<?= clientHost() ?>">
                            <input type="hidden" name="email" value="<?= http\model\ModelData::addUserEmail() ?>">
                            <input type="hidden" name="ticket_channel" value="MPR">

                            <div class="col-lg-12 col-sm-12 mb-3">
                                <label for="summary">Summary Header Message</label>
                                <input type="text" class="form-control form-control-lg" placeholder="Summary" name="summary" id="summary">

                                <?php if(isset($errors['summary'])):?>
                                    <div><small style="color:red"><?=$errors['summary']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 col-sm-12 mb-3">
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


                            <div class="col-lg-12 col-sm-12 mb-2">
                                <label for="discription">Discription</label>
                                <textarea name="discription" id="discription" rows="7" placeholder="Narration..." class="form-control" value="<?= old('discription')?>"></textarea>
                                <small>Detail down the issue/concern</small>

                                <?php if(isset($errors['discription'])):?>
                                    <div><small style="color:red"><?=$errors['discription']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 col-sm-12 mt-3">
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

                            <div class="col-lg-12 col-sm-12 mb-3">
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


                            <div class="col-lg-12 col-sm-12">
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
                                    <th>Summary</th>
                                    <th>Priority</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($data as $value): ?>
                                    <tr>
                                        <td><strong><?= $value['ticketId'] ?></strong></td>
                                        <td><?= $value['summary'] ?></td>
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
