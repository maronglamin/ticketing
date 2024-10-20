<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">

        <div class="col-lg-4">
            <div class="card mb-4">

                <div class="card-header">Categries entries</div>

                <div class="card-body">
                    <?=flash('success')?>
                    <form action="<?= route("department/create/new") ?>" method="post">
                        <div class="row">

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="department_name">Department's Name *</label>
                                    </div>
                                    <input type="text" id="department_name" name="department_name" class="form-control">
                                </div>

                                <?php if(isset($errors['department_name'])):?>
                                    <div><small style="color:red"><?=$errors['category']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="email">Group Email *</label>
                                    </div>
                                    <input type="text" id="email" name="email" class="form-control">
                                </div>

                                <?php if(isset($errors['email'])):?>
                                    <div><small style="color:red"><?=$errors['email']?></small></div>
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
                                    <th>Department</th>
                                    <th>Group Email</th>
                                    <th>MAKER</th>
                                    <th>Create At</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach($dept as $value): ?>
                                        <tr>
                                            <td><a href="#"><strong><?= $value['department_name'] ?></strong></a></td>
                                            <td><?= ($value['email']) ?></td>
                                            <td><strong><?= $value['maker_id'] ?></strong></td>
                                            <td><?= human($value['created_at']) ?></td>

                                            <td>
                                            <form method="post" action="#" role="button">
                                                <input 
                                                    type="hidden"
                                                    name="_method"
                                                    value="DELETE">

                                                <input 
                                                    type="hidden"
                                                    name="id"
                                                    value="<?=$value['id']?>">

                                                <i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-400"></i>
                                                <button class="session-button">Delete</button>
                                            </form>
                                            </td>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        
                    </div>

                </div>
                
            </div>
        </div>

    </div>

</div>
