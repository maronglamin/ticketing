<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
    </h2>

    <div class="row justify-content-center">
        
        <div class="col-lg-10">
        <div class="card mb-4">
        <form action="<?= route('session/users/save')?>" method="post">

        <div class="card-header">
            <div class="row">
                <div class="form-group ml-2">
                <input type="submit" value="Save" class="btn btn-sm btn-outline-dark">
                <a href="<?= route('session/users')?>" class="btn btn-sm btn-outline-dark">Discard</a>
                </div>
            </div>
        </div>

        <?=flash('success')?>


        <input 
            type="hidden" 
            name="_method" 
            value="PATCH">

        <input 
            type="hidden" 
            name="id" 
            value="<?=$_GET['id']?>">

        <div class="p-4">
            

            <div class="row">

                <div class="col-sm-6">

                    <div class="row">

                        <div class="col-sm-8">
                            <div class="form-group mt-1">
                                <label for="username">Username</label>
                                <input 
                                    type="text"
                                    id="username"
                                    name="username"
                                    class="form-control form-control-sm"
                                    value="<?=($user['username'] !== null)? text2cap($user['username']) : $_POST['username']?>">

                                <?php if(isset($errors['username'])):?>
                                    <div><small style="color:red"><?=$errors['username']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="form-group mt-1">
                                <label for="name">Name</label>
                                <input 
                                    type="text"
                                    class="form-control form-control-sm"
                                    name="name"
                                    value="<?=($user['name'] !== null)? text2cap($user['name']) : $_POST['name']?>">
                                    
                                    <?php if(isset($errors['name'])):?>
                                        <div><small style="color:red"><?=$errors['name']?></small></div>
                                    <?php endif;?>
                                    
                            </div>

                            <div class="form-group mt-1">
                                <label for="email">Email</label>
                                <input 
                                    type="text"
                                    class="form-control form-control-sm"
                                    name="email"
                                    value="<?=($user['email'] !== null)? $user['email'] : ''?>">

                                    <?php if(isset($errors['email'])):?>
                                        <div><small style="color:red"><?=$errors['email']?></small></div>
                                    <?php endif;?>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="auto">Action Auth</label>
                                        </div>
                                        <select class="custom-select" name="auto" id="auto">
                                            <option value="AUTH"></option>
                                            <option value="AUTO_AUTH">Auto Auth</option>
                                        </select>

                                </div>
                                <small>inputs to be confirmed or not</small>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="department">Department</label>
                                        </div>
                                        <select class="custom-select" name="department" id="department">
                                            <option value="" ><?=($user['department'] !== null)? $user['department'] : ''?></option>
                                            <option value="Compliance">Compliance</option>
                                            <option value="Biz dev">Biz dev</option>
                                            <option value="Operations">Operations</option>
                                            <option value="Agent Operations">Agent Operations</option>
                                            <option value="HR">HR</option>
                                            <option value="APS Reconciliation">APS Reconciliation</option>
                                            <option value="Call Center">Call Center</option>
                                            <option value="Finance">Finance</option>
                                            <option value="Treasury">Treasury</option>
                                            <option value="IT">IT</option>
                                        </select>
                                </div>

                                    <?php if(isset($errors['department'])):?>
                                        <div><small style="color:red"><?=$errors['department']?></small></div>
                                    <?php endif;?>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="user_role">User Roles</label>
                                        </div>
                                        <select class="custom-select" name="user_role" id="user_role">
                                            <option value=""><?=(!empty($user['user_role']))? $user['user_role'] : ''?></option>
                                            <option value="Manager">APS Manager</option>
                                            <option value="Supervisor">APS Supervisor</option>
                                            <option value="Administrator">APS Administrator</option>
                                            <option value="Officer">APS Officer</option>
                                        </select>

                                </div>
                                    <?php if(isset($errors['user_role'])):?>
                                        <div><small style="color:red"><?=$errors['user_role']?></small></div>
                                    <?php endif;?>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label>User Status</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="enabled" <?=$user['user_status'] === core\Response::STATUS_ENABLED ? 'checked': ''?>>
                                <label class="form-check-label" for="enabled">
                                    Enabled
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="hold" <?=$user['user_status'] === core\Response::STATUS_HOLD ? 'checked': ''?>>
                                <label class="form-check-label" for="hold">
                                    Hold
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="disabled" <?=$user['user_status'] === core\Response::STATUS_DISABLED ? 'checked': ''?>>
                                <label class="form-check-label" for="disabled">
                                    disabled
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="locked" <?=$user['user_status'] === core\Response::STATUS_LOCKED ? 'checked': ''?>>
                                <label class="form-check-label" for="locked">
                                    Locked
                                </label>
                                </div>
                            </div>

                            <div class="form-group">

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="status">User Status</label>
                                    </div>
                                    <select class="custom-select" name="status" id="status">
                                    <option value="">User status</option>
                                    <option value="1">Enabled</option>
                                    <option value="2">Hold</option>
                                    <option value="3">Disabled</option>
                                    <option value="4">Locked</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="">Status changed on</label>
                                <input type="text" class="form-control form-control-sm" disabled value="<?= human($user['user_status_change'])?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Default password" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="changed">Password Changed on</label>
                                <input type="text" disabled class="form-control" value="<?=(empty($user['password_updated_at']))? 'Never' : human($user['password_updated_at'])?>">
                            </div> 
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
        </form>
        <div class="card-footer">
            <div class="row">
            <?php if($user['confirmed'] === core\Response::UNAUTHORISD):?>
                <div class="form-group ml-2 justify-content-start">
                    <form 
                        action="<?= route('session/users/update')?>"
                        method="post">

                        <input 
                        type="hidden" 
                        name="_method" 
                        value="PATCH">

                    <input 
                        type="hidden" 
                        name="id" 
                        value="<?=$_GET['id']?>">


                        <input type="submit" value="Authorize" class="btn btn-sm btn-outline-dark">

                    </form>
                </div>
            <?php endif;?>
            
                <div class="form-group p-2">
                    <a href="<?= route('session/user/role?id=' .$_GET['id']. '&username='. $user['username'])?>">Roles | </a>
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

            <div class="row">
                <div class="col-sm-6">
                    <p>Created By: <?= text2cap($user['maker'])?></p>
                    <p>Confirmed By: <?= text2cap($user['checker'])?></p>
                </div>

                <div class="col-sm-6">
                    <p>Created By: <?= $user['make_at'] ?></p>
                    <p>Confirmed at: <?=$user['checker_at']?></p>
                </div>
            </div>
        </div>
        </div>



        </div>
    </div>
</div>