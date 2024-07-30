<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
    </h2>

    <div class="row justify-content-center">
        
        <div class="col-lg-10">
        <div class="card mb-4">

        <div class="card-header">
            Security operation
        </div>

        <?=flash('success')?>

        <form action="<?= route('session/users/create')?>" method="post">

        <div class="p-4">
            <div class="row">
                <div class="form-group ml-2">
                <input type="submit" class="btn btn-sm btn-outline-dark">
                </div>
            </div>

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
                                    value="<?= old('username')?>"
                                    class="form-control form-control-sm">

                                    <?php if(isset($errors['username'])):?>
                                        <div><small style="color:red"><?=$errors['username']?></small></div>
                                    <?php endif;?>
                            </div>

                            <div class="form-group mt-1">
                                <label for="name">Name</label>
                                <input 
                                    type="text"
                                    class="form-control form-control-sm"
                                    value="<?= old('name')?>"
                                    name="name">

                                    <?php if(isset($errors['name'])):?>
                                        <div><small style="color:red"><?=$errors['name']?></small></div>
                                    <?php endif;?>
                                </div>

                            <div class="form-group mt-1">
                                <label for="">Email</label>
                                <input 
                                    type="text"
                                    class="form-control form-control-sm"
                                    value="<?= old('email')?>"
                                    name="email">
                            </div>
                            
                            <div class="form-group">
                                <select class="form-control" name="auto" id="auto">
                                    <option value="AUTH"></option>
                                    <option value="AUTO">Auto Auth</option>
                                </select>
                                <small>inputs to be confirmed or not</small>
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
                                <input class="form-check-input" type="radio" disabled id="enabled">
                                <label class="form-check-label" for="enabled">
                                    Enabled
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="hold">
                                <label class="form-check-label" for="hold">
                                    Hold
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="disabled">
                                <label class="form-check-label" for="disabled">
                                    disabled
                                </label>
                                </div>
                                <div class="form-check">
                                <input class="form-check-input" type="radio" disabled id="locked">
                                <label class="form-check-label" for="locked">
                                    Locked
                                </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="status">Change User status</label>
                                <select name="user_status" id="status" class="form-control">
                                    <option value="">User status</option>
                                    <option value="1">Enabled</option>
                                    <option value="2">Hold</option>
                                    <option value="3">Disabled</option>
                                    <option value="4">Locked</option>
                                </select>
                                <?php if(isset($errors['status'])):?>
                                    <div><small style="color:red"><?=$errors['status']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="form-group">
                                <label for="">Status changed on</label>
                                <input type="text" class="form-control form-control-sm" disabled>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" placeholder="Default password" class="form-control">
                            
                                <?php if(isset($errors['password'])):?>
                                    <div><small style="color:red"><?=$errors['password']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="form-group">
                                <label for="changed">Password Changed on</label>
                                <input type="text" disabled class="form-control">
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
                    <a href="">Roles | </a>
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
                    <p>Created By: </p>
                    <p>Confirmed By:</p>
                </div>

                <div class="col-sm-6">
                    <p>Created By:</p>
                    <p>Confirmed at:</p>
                </div>
            </div>
        </div>
        </div>



        </div>
    </div>
</div>