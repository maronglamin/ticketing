<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
            <h2 class="form-title">Sign In</h2>
                <form 
                    class="register-form"
                    id="register-form" 
                    method="post" 
                    action="session">

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
                    <div><small style="color:green"><?=flash('success')?></small></div>

                    <div class="form-group form-button">
                        <input 
                            type="submit" 
                            class="form-submit" 
                            value="login">
                    </div>

                </form>
            </div>
            
            <div class="signup-image">
                <figure><img src="/public/session/images/signup-image.jpg" style="height:268px" alt="sing up image"></figure>
                <a href="session/create" class="signup-image-link">Not a member, register</a>
            </div>

    </div>
</div>
</section>
