<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
            <h2 class="form-title">Change Password</h2>
                <form 
                    class="register-form"
                    id="register-form" 
                    method="post" 
                    action="<?= route('session/user/password/update')?>">

                    <div class="form-group text-uppercase">
                        <label for="username">
                            <i class="zmdi zmdi-email"></i>
                        </label>

                        <input 
                            type="hidden" 
                            name="_method" 
                            value="PATCH">

                        <input 
                            type="hidden" 
                            name="id" 
                            value="<?=$username?>">
                        
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            placeholder="username"
                            disabled
                            value="<?=$username?>">

                    </div>

                    <div class="form-group">
                        <label for="password">
                            <i class="zmdi zmdi-lock"></i>
                        </label>

                        <input 
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password">

                    </div>
                    <div class="form-group">
                        <label for="password_confirmed">
                            <i class="zmdi zmdi-lock"></i>
                        </label>

                        <input 
                            type="password"
                            name="password_confirmed"
                            id="password"
                            placeholder="Confirm Password">

                    </div>

                    <?php if(isset($errors['username'])):?>
                        <div><small style="color:red"><?=$errors['username']?></small></div>
                    <?php endif;?>
                    <?php if(isset($errors['password'])):?>
                        <div><small style="color:red"><?=$errors['password']?></small></div>
                    <?php endif;?>

                    <div><small style="color:green"><?=flash('success')?></small></div>

                    <div class="form-group form-button">
                        <input 
                            type="submit" 
                            class="form-submit" 
                            value="Update">
                    </div>

                </form>
            </div>
            
            <div class="signup-image">
                <figure><img src="<?=root()?>/public/session/images/signup-image.jpg" alt="sing up image"></figure>
                <a href="<?= route('dashboard')?>" class="signup-image-link">Cancel</a>

            </div>

    </div>
</div>
</section>