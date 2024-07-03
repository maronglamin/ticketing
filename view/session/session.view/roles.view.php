<div class="container-fluid">
    <h2 class="h3 mb-1 text-gray-800 text-uppercase">
        User Roles
    </h2>
    <p class="pb-5">Assign subject the current user</p>

    <div class="row justify-content-center">
        
        <div class="col-lg-10">
        <div class="card mb-4">

        <div class="card-header">
            User Role
        </div>


        <form action="<?= route('session/user/role')?>" method="post">

        <input 
            type="hidden" 
            name="_method" 
            value="PATCH">

        <input 
            type="hidden" 
            name="username" 
            value="<?=$user['username']?>">

        <input 
        type="hidden" 
        name="id" 
        value="<?=$user['id']?>">

        <div class="p-4">
            <div class="row">
                <div class="form-group ml-2">
                <input type="submit" value="Update" class="btn btn-sm btn-outline-dark">
                <a href="<?= route('session/summary?id='. $user['id'])?>" class="btn btn-sm btn-outline-dark">Discard</a>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-6">
                <?=flash('success')?>

                    <div class="row">

                        <div class="col-sm-8">
                            <div class="form-group mt-1">
                                <label for="username">Subject Code</label>
                                <input 
                                    type="text"
                                    id="subject_code"
                                    name="Subject_code"
                                    value="<?= old('Subject_code')?>"
                                    placeholder="Subject code you wish to assign"
                                    class="form-control form-control-sm">

                                    <?php if(isset($errors['Subject_code'])):?>
                                        <div><small style="color:red"><?=$errors['Subject_code']?></small></div>
                                    <?php endif;?>
                            </div>

                            <div class="form-group mt-1">
                                <label for="name">Class Code</label>
                                <input 
                                    type="text"
                                    name="class_code"
                                    placeholder="Subject code you wish to assign"
                                    value="<?= old('class_code')?>"
                                    class="form-control form-control-sm">

                                    <?php if(isset($errors['class_code'])):?>
                                        <div><small style="color:red"><?=$errors['class_code']?></small></div>
                                    <?php endif;?>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                        <h2 class="h3 mb-1 text-gray-800 text-uppercase">
                            Subject List
                        </h2>
                        <div class="row">
                                <div class="table-responsive">
                                <table 
                                    class="table 
                                    table-bordered table-striped"
                                    width="100%" 
                                    cellspacing="0">

                                    <thead>
                                            <tr>
                                                <th>Class Code</th>
                                                <th>Subject Code</th>
                                            </tr>
                                        </thead>

                                    <tbody>
                                            <?php foreach ($classes as $class):?>
                                                <tr>
                                            
                                                    <td>
                                                        <a href="<?= route('classes/edit?id=' . $class['id']) ?>">
                                                            <?= text2cap($class['class_code'])?>
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <a href="<?= route('classes/edit?id=' . $class['id']) ?>">
                                                            <?= text2cap($class['Subject_code'])?>
                                                        </a>
                                                    </td>

                                                        

                                                    </tr>
                                            <?php endforeach;?>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
        </form>
        <div class="card-footer">
            <div class="row">
                <div class="form-group p-2">
                <a href="<?= route('session/user/role?id=' .$user['id']. '&username='. $user['username'])?>">Roles | </a>
                </div>

                <div class="form-group p-2">
                    <a href=""> Functions |</a>
                </div>
                <div class="form-group p-2">
                    <a href=""> Rights |</a>
                </div>
                <div class="form-group p-2">
                    <a href=""> Disallowed Functions |</a>
                </div>
                <div class="form-group p-2">
                    <a href=""> Dashboard Mapping |</a>
                </div>
            </div>
        </div>
        </div>



        </div>
    </div>
</div>