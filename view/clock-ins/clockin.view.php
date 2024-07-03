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
                <form action="<?= route('clock-ins/in/send') ?>" method="post">
                    <input type="hidden" name="host_name" value="<?= clientHost() ?>">
                    <h5 class="mb-5">Click to mark attendance</h5>
                    <?php if (!empty($currentlyClocked["month_year"]) && $currentlyClocked["month_year"] === month_year()):?>
                        <button class="btn btn-lg btn-primary btn-block" disabled>Clock in</button>
                    <?php else:?>
                        <button class="btn btn-lg btn-primary btn-block">Clock in</button>
                    <?php endif;?>
                </form>
                <p><strong>Expected Time in: 8:00 GMT</strong></p><br><br>
            </div>

            <div class="col-lg-8">
            <ul class="list-group mb-4">
            <h5 class="mb-5">Records in details</h5>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    User id:
                    <span class="badge" style="font-size: 15px"><?= core\Session::user() ?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Time in:
                    <span class="badge" style="font-size: 15px"><?= !empty($currentlyClocked )? readTime($currentlyClocked["clock_in_at"]) : '__:__'?></span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Date in:
                    <span class="badge" style="font-size: 15px"><?= !empty($currentlyClocked )? readDate($currentlyClocked["clock_in_at"]) : '__ /__ / ____'?></span>
                </li>
            </ul>
            </div>
        </div>
    </div>
</section>
</div>