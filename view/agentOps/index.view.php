  <!-- Two Columns Layout -->
  <div class="p-3 mt-4">
    <div class="row">
      <!-- Left Column (25%) -->
      <div class="col-md-3">

        <!-- New Ticket Form -->
        <div class="form-card">
          <h4 class="text-center">New Ticket</h4>
          <form action="<?= route("agentops/save/logDetail") ?>" method="post">

              <!-- hidden inputs for the agent inputs -->
            <input type="hidden" name="ticketId" value="<?= "APS-" . ($ticketing_id["ticket_id"] + 1) ?>">
            <input type="hidden" name="email" value="<?= http\model\ModelData::addUserEmail() ?>">
            <input type="hidden" name="ticket_channel" value="APS_AGENT_OPS">

            <div class="mb-3">
              <label for="issueCat" class="form-label"><strong>Entity Raised for</strong></label>
              <select class="form-select" id="issueCat" name="issueCat" required>
                <option value="" disabled selected>Choose...</option>
                <option value="ADR">Complaint Against Agent</option>
                <option value="Agent">Complaint from Agent</option>
              </select>
            </div>
              
            <!-- Reason for the Call -->
            <div class="mb-3">
            <label for="issueType" class="form-label"><strong>Type of Issue</strong></label>
            <select class="form-select" id="issueType" name="issueType" required>
                <option value="" disabled selected>Choose...</option>
                <option value="Login">Login</option>
                <option value="Other Tech Issues">Other Tech Issues</option>
                <option value="Commission">Commission</option>
                <option value="Rebalancing">Rebalancing</option>
                <option value="Delay in settlement">Delay in settlement</option>
                <option value="Deposit">Deposit</option>
                <option value="Withdrawal">Withdrawal</option>
                <option value="upgrade">upgrade</option>
                <option value="Poor Customer Service">Poor Customer Service</option>
            </select>
            </div>

            <div class="mb-3">
              <label for="reportedChannel" class="form-label"><strong>Reported Channel</strong></label>
              <select class="form-select" id="reportedChannel" name="reportedChannel" required>
                <option value="" disabled selected>Choose...</option>
                <option value="WhatsApp">WhatsApp</option>
                <option value="Call Center">Call Center</option>
                <option value="Staff">Staff</option>
                <option value="Mystery Shopper Report">Mystery Shopper Report</option>
              </select>
            </div>

            <div class="mb-3">
              <label for="resolver" class="form-label"><strong>Resolved By</strong></label>
              <input type="text" class="form-control" id="resolver" name="resolver" placeholder="Enter name of the Resolver">
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
                <th>Issue Type</th>
                <th>Reported Channel</th>
                <th>Status</th>
                <th>Reported At</th>
                <th>Status Changed</th>
                <th>Resolution Time</th>
              </tr>
            </thead>
            <tbody>
            <?php foreach($ticketLists as $ticketList): ?>        
              <tr>
                <td><a href="agentops/view/detail?change=<?= $ticketList['ticketId']?>"><strong> <?= $ticketList['ticketId']?> </strong></a></td>
                <td><?= $ticketList['issueType']?></td>
                <td><?= $ticketList['reportedChannel']?></td>
                <td><?= $ticketList['status']?></td>
                <td><?= $ticketList['created_at']?></td>
                <td><?= $ticketList['updated_at']?></td>
                <td><?= core\DateTimeDiff::TimeDifference($ticketList['created_at'], $ticketList['updated_at'])?></td>
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
                        <a class="page-link" href="<?= $page > 1 ? route('agent/operations/logs?page=' . ($page - 1)) : '#' ?>" tabindex="-1">Previous</a>
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
                            <a class="page-link" href="<?= route('agent/operations/logs?page=' . $i) ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <!-- Next Button -->
                    <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="<?= $page < $pages ? route('agent/operations/logs?page=' . ($page + 1)) : '#' ?>">Next</a>
                    </li>
                </ul>
            </nav>

        </div>
      </div>
    </div>
  </div>
