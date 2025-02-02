<!-- Main Content -->
<div class="container mt-4">

    <div class="row justify-content-center">
        
        <div class="col-lg-10">
        <div class="card mb-4">
        <form action="<?= route('session/users/save')?>" method="post">

        <div class="card-header">
            <div class="row">
                <div class="form-group ml-2">
                <input type="submit" value="Save" class="btn btn-sm btn-outline-dark">
                <a href="<?= route('session/users')?>" class="btn btn-sm btn-outline-dark">Back</a>
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

                            <div class="form-group mt-4">
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

                            <div class="form-group mt-4">
                                <label for="email">Email</label>
                                <input 
                                    type="text"
                                    class="form-control form-control-sm"
                                    name="email"
                                    value="<?=($user['email'] !== null)? $user['email'] : old('email')?>">

                                    <?php if(isset($errors['email'])):?>
                                        <div><small style="color:red"><?=$errors['email']?></small></div>
                                    <?php endif;?>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-text mt-4" for="auto">Authorizations</label>
                                        <select class="form-control mt-4" name="auto" id="auto">
                                            <option value="AUTH"><?=($user['auto_auth'] !== null)? $user['auto_auth'] : old('auto')?></option>
                                            <option value="AUTO_AUTH">Authorizer</option>
                                            <option value="AUTO_REV">Reviewer</option>
                                            <option value="AUTH">input User</option>
                                        </select>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-text mt-4" for="auto">Bank Officer</label>
                                        <select class="form-control mt-4" name="aps_bankPayer" id="aps_bankPayer">
                                            <option value=""></option>
                                            <option value="IMF_BANK_PAYER">IMF PAYER</option>
                                            <option value="OTHER_BANK_USER">OTHER BANK PAYER</option>
                                            <option value="ACCOUNT_SIGNATORY">ACCOUNT SIGNATORY</option>
                                        </select>

                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-text mt-4" for="entity_name">Company</label>
                                        <select class="form-control mt-4" name="entity_name" id="entity_name">
                                        <option selected disabled value="<?=old('entity_name')?>" ><?=($user['aps_entity'] !== null)? $user['aps_entity'] : old('entity_name')?></option>
                                            <?php foreach($entity as $ent):?>
                                                <option value="<?=$ent['entity_name']?>"><?=$ent['entity_name']?></option>
                                            <?php endforeach;?>
                                        </select>
                                </div>

                                    <?php if(isset($errors['entity_name'])):?>
                                        <div><small style="color:red"><?=$errors['entity_name']?></small></div>
                                    <?php endif;?>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-text mt-4" for="department">Department</label>
                                        <select class="form-control mt-4" name="department" id="department">
                                            <option value="<?=old('department')?>" ><?=($user['department'] !== null)? $user['department'] : old('department')?></option>
                                            <?php foreach($dept as $deptmnt):?>
                                                <option value="<?=$deptmnt['department_name']?>"><?=$deptmnt['department_name']?></option>
                                            <?php endforeach;?>
                                            <option value="Others">Others</option>
                                        </select>
                                </div>

                                    <?php if(isset($errors['department'])):?>
                                        <div><small style="color:red"><?=$errors['department']?></small></div>
                                    <?php endif;?>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <label class="input-group-text mt-4" for="user_role">User Roles</label>
                                        <select class="form-control mt-4" name="user_role" id="user_role">
                                            <option value="<?=old('user_role')?>"><?=(!empty($user['user_role']))? $user['user_role'] : old('user_role')?></option>
                                            <option value="Manager">Manager</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Officer">Officer</option>
                                            <?php if (isSuperAdmin()):?>
                                                <option value="Administrator">Super Admin</option>
                                                <option value="APS International Admin">APS International Admin</option>
                                                <option value="APS IMF Admin">APS IMF Admin</option>
                                                <option value="APS IMF Admin">APS Wallet Admin</option>
                                            <?php endif;?>
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
                                    <label class="input-group-text mt-4" for="status">User Status</label>
                                    <select class="form-control mt-4" name="status" id="status">
                                        <option value="">User status</option>
                                        <option value="1">Enabled</option>
                                        <option value="2">Hold</option>
                                        <option value="3">Disabled</option>
                                        <option value="4">Locked</option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label for="">Status changed on</label>
                                <input type="text" class="form-control form-control-sm" disabled value="<?= human($user['user_status_change'])?>">
                            </div>

                            <div class="form-group mt-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Default password" class="form-control">
                            </div>

                            <div class="form-group mt-4">
                                <label for="changed">Password Changed on</label>
                                <input type="text" disabled class="form-control" value="<?=(empty($user['password_updated_at']))? 'Never' : human($user['password_updated_at'])?>">
                            </div> 
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
        </form>
        <?php if($user['confirmed'] === core\Response::UNAUTHORISD):?>
            <hr>

                <div class="form-group p-2 mb-2">
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

        <div class="card-footer">
            <div class="row">
            

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
</div>
