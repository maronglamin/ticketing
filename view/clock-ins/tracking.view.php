<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

<section class="signup mt-5">
    <div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header">
                    <a href="<?= route('clock-ins/track') ?>" class="btn btn-sm btn-primary">Back</a>
                </div>

                <div class="card-body">
                    <form action="<?= route('clock-ins/reactions') ?>" method="post">
                        <input type="hidden" name="username" value="<?= $user['username'] ?>">
                        <input type="hidden" name="month_year" value="<?= $user['month_year'] ?>">
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="row">
                            <div class="col-lg-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Username</span>
                                    <input type="text" class="form-control" value="<?= $user['username'] ?>" disabled aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Clockin time</span>
                                    <input type="text" class="form-control" value="<?= readTime($user['clock_in_at']) ?>" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-lg-10">
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Expected Difference</span>
                                    <input type="text" class="form-control" name="expected_diff" value="<?= core\DateTimeDiff::TimeDifference($user['clock_in_at'], month_year(). ' 08:00:00') ?>" aria-label="Username" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-lg-10 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="clock_in_status">Clockin status</label>
                                    </div>
                                    <select class="custom-select" name="clock_in_status" id="clock_in_status">
                                    <option value="<?=($user['clock_in_status'] === NULL)? '' : $user['clock_in_status']?>"><?=($user['clock_in_status'] === NULL)? '' : $user['clock_in_status']?></option>
                                    <option value="Early">Early</option>
                                        <option value="On_time">On Time</option>
                                        <option value="Late">Late</option>
                                        <option value="Highly_late">Highly Late</option>
                                    </select>
                                </div>

                                <?php if(isset($errors['clock_in_status'])):?>
                                    <div><small style="color:red"><?=$errors['clock_in_status']?></small></div>
                                <?php endif;?>
                            </div>

                            <div class="col-lg-10 mt-2">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>

                        </div>

                    </form>
                </div>
                
            </div>
        </div>



    </div>

</div>
</div>
                                </section>