<div class="container-fluid">
    <h2 
        class="h3 mb-1 text-gray-800 text-uppercase">
        <?=$heading?>
    </h2>
    <p class="mb-4"><?=$instruction?></p>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header">
                    <div class="">
                    <form action="<?= route('clock-ins/bydate/search') ?>" method="post">
                        <div class="row">

                            <div class="col-lg-4">
                                
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Date</span>
                                    <input type="date" name="month_year" class="form-control" aria-label="search" aria-describedby="basic-addon1">
                                </div>
                                
                            </div>

                            <div class="col-lg-4">

                                <div class="input-group mt-2">
                                    <input type="submit" value="Search" class="session-button">
                                </div>
                                
                            </div>

                        </div>
                        </form>

                        </div>
                    <?=flash('success')?>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table 
                            class="table 
                            table-borderless"
                            width="100%" 
                            cellspacing="0">

                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Date</th>
                                    <th>Clockin at</th>
                                    <th>Clockout at</th>
                                    <th>PC Used at CI</th>
                                    <th>PC Used at CO</th>
                                    <th>Clockin Status</th>
                                    <th>Expected Diff</th>
                                    <th>Clockin Status</th>
                                    <th>Clocked out Diff</th>

                                </tr>
                            </thead>

                            <tbody>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tbody>
                        </table>

                        
                    </div>

                </div>
                
            </div>
        </div>
    </div>

</div>