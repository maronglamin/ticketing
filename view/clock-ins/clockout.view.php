<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

<section class="signup mt-5">
    <div class="container">
        <h3 class="text-gray-500 mt-3 p-3">Mark your Attendance</h3>
        <?= flash('success') ?>

        <div class="row">
            <div class="col-lg-4 mb-3">
                <form action="<?= route('clock-ins/out/send') ?>" method="post">
                    <input type="hidden" name="clock_out_host" value="<?= clientHost() ?>">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="id" value="<?= $currentlyClocked['id'] ?>">
                    <h5 class="mb-5">Click to close attendance</h5> 
                    <?php if ((!empty($currentlyClocked) && $currentlyClocked['clock_out_at'] !== NULL)):?>
                        <button class="btn btn-lg btn-danger btn-block" disabled>Clock out</button>
                    <?php else:?>
                        <button class="btn btn-lg btn-danger btn-block">Clock out</button>
                    <?php endif;?>
                </form>
                <p><strong>Expected Time out: 17:00 GMT</strong></p>
            </div>

            <div class="col-lg-8">
            <ul class="list-group mb-4">
            <h5 class="mb-5">Records in details</h5>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    User id:
                    <span class="badge"><?= core\Session::user() ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Time in:
                    <span class="badge" style="font-size: 15px"><?= !empty($currentlyClocked)? readTime($currentlyClocked["clock_out_at"]) : '__:__'?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Date in:
                    <span class="badge" style="font-size: 15px"><?= !empty($currentlyClocked)? readDate($currentlyClocked["clock_out_at"]) : '__ /__ / ____'?></span>
                </li>
            </ul>
            <p><strong>Today's CLOCK-IN detail</strong></p>

            <ul class="list-group mb-4">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Time in:
                    <span class="badge" style="font-size: 15px"><?= !empty($currentlyClocked)? readTime($currentlyClocked["clock_in_at"]) : '__:__'?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Clock-in status:
                    <span class="badge"><?= !empty($currentlyClocked)? $currentlyClocked['clock_in_status'] : 'comment from HR'?></span>
                </li>
            </ul>
            </div>
        </div>
    </div>
</section>
</div>