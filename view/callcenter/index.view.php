 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Call Center Ticketing</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="<?= route('dashboard')?>">APS eTicketing</a></li>
          <li class="nav-item"><a class="nav-link active" href="#new-ticket">New Ticket</a></li>
          <li class="nav-item"><a class="nav-link active" href="#ticket-history">Ticket History</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Full-Width Card with Image from Directory -->
  <div class="full-width-card"></div>

  <!-- Two Columns Layout -->
  <div class="container mt-4">
    <div class="row">
      <!-- Left Column (25%) -->
      <div class="col-md-3">
        <!-- Ticket Counts -->
        <div class="stats-card text-center">
          <h4>Ticket Summary</h4>
          <hr>
          <div>
            <p class="display-5 mb-0"><?= $complaints["count"]?> x <?= $enquiry["count"]?></p>
            <p>Complaints x Queries</p>
          </div>
        </div>

        <!-- New Ticket Form -->
        <div class="form-card">
          <h4 class="text-center">New Ticket</h4>
          <form action="<?= route("callcenter/save/customerDetail") ?>" method="post">

              <!-- hidden inputs for the agent inputs -->
            <input type="hidden" name="ticketId" value="<?= "APS_CS-" . ($ticketing_id["ticket_id"] + 1) ?>">
            <input type="hidden" name="email" value="<?= http\model\ModelData::addUserEmail() ?>">
            <input type="hidden" name="ticket_channel" value="APS_CALL_CENTER">

            <!-- Reason for the Call -->
            <div class="mb-3">
            <label for="reasonForCall" class="form-label"><strong>Reason for the Call</strong></label>
            <select class="form-select" id="reasonForCall" name="reasonForCall" required>
                <option value="" disabled selected>Choose a reason...</option>
                <?php foreach($callReason as $reason): ?>
                    <option value="<?= $reason['category'] ?>"><?= $reason['category'] ?></option>
                <?php endforeach; ?>
            </select>
            </div>

            <!-- Transaction Type -->
            <div class="mb-3">
            <label for="transactionType" class="form-label"><strong>Transaction Type</strong></label>
            <select class="form-select" id="transactionType" name="transactionType" required>
                <option value="" disabled selected>Choose a transaction type...</option>
                <?php foreach($transactionType as $transaction): ?>
                    <option value="<?= $transaction['category'] ?>"><?= $transaction['category'] ?></option>
                <?php endforeach; ?>
            </select>
            </div>

            <!-- Customer Name -->
            <div class="mb-3">
            <label for="customerName" class="form-label"><strong>Customer Name</strong></label>
            <input type="text" class="form-control" id="customerName" name="customerName">
            </div>

            <!-- Phone Number -->
            <div class="mb-3">
            <label for="phoneNumber" class="form-label"><strong>Wallet Number</strong></label>
            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" pattern="[0-9]{7}" placeholder="Enter 7-digit phone number">
            </div>

            <!-- Description -->
            <div class="mb-3">
            <label for="description" class="form-label"><strong>Description</strong></label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter details about the issue or request" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        </div>
      </div>

      <!-- Right Column (75%) -->
      <div class="col-md-9">
        <div class="table-container">
        <?=flash('success')?>

          <!-- Export Button Inline with Table Label -->
          <div class="d-flex justify-content-between align-items-center">
            <h4>Ticket Table</h4>
            <button class="btn btn-sm" onclick="exportTableToCSV('tickets.csv')">Export Report</button>
          </div>

          <table class="table table-striped" id="ticketTable">
            <thead>
              <tr>
                <th>ID</th>
                <th>Phone Number</th>
                <th>Call Reason</th>
                <th>Transaction Type</th>
                <th>Username</th>
                <th>Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($ticketLists as $ticketList): ?>        
              <tr>
                <td><a href=""><strong> <?= $ticketList['ticketId']?> </strong></a></td>
                <td><?= $ticketList['phoneNumber']?></td>
                <td><?= $ticketList['reasonForCall']?></td>
                <td><?= $ticketList['transactionType']?></td>
                <td><?= $ticketList['maker_id']?></td>
                <td><?= $ticketList['created_at']?></td>
                <?php if ($ticketList['status'] === 'NEW'):?>
                    <td><span class="badge bg-secondary text-light"><?= $ticketList['status']?></span></td>
                <?php elseif($ticketList['status'] === 'PENDING'):?>
                    <td><span class="badge bg-warning text-dark"><?= $ticketList['status']?></span></td>
                <?php else:?>
                    <td><span class="badge bg-success"><?= $ticketList['status']?></span></td>
                <?php endif;?>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>

          <!-- Pagination -->
          <p class="text-secondary text-center">Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?></p>
            <nav aria-label="Page navigation example p-2">
                <ul class="pagination justify-content-end">
                    <!-- Previous Button -->
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $page > 1 ? route('callcenter/logs?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                            <a class="page-link" href="<?= route('callcenter/logs?page=' . $i) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $page < $pages ? route('callcenter/logs?page=' . ($page + 1)) : '#' ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
      </div>
    </div>
  </div>
