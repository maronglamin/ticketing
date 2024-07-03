<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signin-image">
                <figure><img src="<?=root()?>/public/session/images/signin-image.jpg" alt="sing up image"></figure>
                <a href="../" class="signup-image-link">Already a member, sign in</a>
            </div>
            <div class="signup-form">
            <h2 class="form-title">Register</h2>
                <form 
                    class="register-form"
                    id="register-form" 
                    method="post" 
                    action="<?= route('sessions')?>">

                    <div class="form-group">
                        <label for="name">
                            <i class="zmdi zmdi-email"></i>
                        </label>

                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            placeholder="username"
                            value="<?= old('username') ?>">

                    </div>

                    <div class="form-group">
                        <label for="name">
                            <i class="zmdi zmdi-lock"></i>
                        </label>

                        <input 
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Password">

                    </div>
                    
                    <?php if(isset($errors['username'])):?>
                                <div><small style="color:red"><?=$errors['username']?></small></div>
                    <?php endif;?>
                    <?php if(isset($errors['password'])):?>
                        <div><small style="color:red"><?=$errors['password']?></small></div>
                    <?php endif;?>

                    <div class="form-group form-button">
                        <input 
                            type="submit" 
                            class="form-submit" 
                            value="Register">
                    </div>

                </form>
            </div>
    </div>
</div>
</section>