<nav class="bg-dark text-white py-2">
    <div class="container d-flex gap-3">
        <a  href="<?= route('new/ticket')?>" class="btn btn-outline-light">Open a New Ticket</a>
        <button class="btn btn-warning">My Tickets (<?= $userCount['username']?>)</button>
        <button class="btn btn-warning">Tickets From my team (<?=$departmentCount['ticketCount']?>)</button>
    </div>
</nav>
    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="fs-4 fw-bold">Welcome back!</h2>
        <p class="text-secondary">Here's a list of your tickets raised</p>
        
        <div class="row g-2 my-3">
            <div class="col-3">
                <input type="text" class="form-control" placeholder="Filter tasks...">
            </div>
            <div class="col-2">
                <select class="form-select">
                    <option>Status</option>
                    <option value="Customer Review">CustomerReview</option>
                    <option value="Analysis">Analysis</option>
                    <option value="Resolved">Resolved</option>
                    <option value="Proccessing">Proccessing</option>
                </select>
            </div>
            <div class="col-2">
                <select class="form-select">
                    <option>Priority</option>
                    <option>Low</option>
                    <option>Medium</option>
                    <option>High</option>
                </select>
            </div>
          <div class="col">
	    <a>Search</a>
	 </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordless text-white">
                <thead class="table-secondary">
                    <tr>
                        <th>Request_id</th>
                        <th>Ticket Summary</th>
                        <th>Priority</th>
                        <th>Created at</th>
                        <th>Status</th>		
                    </tr>
                </thead>
                <tbody>
                <?php foreach($data as $value): ?>
                    <tr class="text-dark">
                        <td><a style="text-decoration: none;" href="<?= route('status/details?ticket='. $value['ticketId']) ?>"><strong><?= $value['ticketId'] ?></strong></a></td>
                        <td><span class="badge bg-secondary"><?= $value['department'] ?></span> <?= shortText($value['summary'], '90', '...')?></td>
                        <td><?= ($value['priority'] === 'High')? '<span class="badge bg-danger bi bi-arrow-up">'. ' '. $value['priority'] .' </span>' : '<span class="badge bg-info bi bi-arrow-down text-dark">'. ' '. $value['priority'] .' </span>'?></td>
                        <td><?= slashDate($value['make_at']) ?></td>
                        <td><strong><?= $value['status'] ?></strong></td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
                    <nav aria-label="Page navigation example p-2">
                        <ul class="pagination justify-content-end">
                            <!-- Previous Button -->
                            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page > 1 ? route('dashboard?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
                            </li>

                            <?php
                            $maxVisiblePages = 5; // Maximum number of visible pages
                            $startPage = max(1, $page - 2); // Start 2 pages before the current page
                            $endPage = min($pages, $startPage + $maxVisiblePages - 1); // Ensure no overflow

                            // Adjust startPage if close to the last page
                            if ($endPage - $startPage + 1 < $maxVisiblePages) {
                                $startPage = max(1, $endPage - $maxVisiblePages + 1);
                            }

                            // Generate visible page links
                            for ($i = $startPage; $i <= $endPage; $i++) : ?>
                                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                                    <a class="page-link" href="<?= route('dashboard?page=' . $i) ?>"><?= $i ?></a>
                                </li>
                            <?php endfor; ?>

                            <!-- Next Button -->
                            <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                                <a class="page-link" href="<?= $page < $pages ? route('dashboard?page=' . ($page + 1)) : '#' ?>">Next</a>
                            </li>
                        </ul>
                    </nav>
        </div>
    </div>

</body>

</html>
