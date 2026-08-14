<nav class="bg-dark text-white py-2"> 
    <div class="container d-flex gap-3">
        <a  href="<?= route('new/ticket')?>" 
            class="btn btn-outline-light">
            Open a New Ticket
        </a>
        <button class="btn btn-warning">
            My Tickets (<?= $userCount['username']?>)
        </button>
        <button class="btn btn-warning">
            Tickets From my team (<?=$departmentCount['ticketCount']?>)
        </button>
    </div>
</nav>
    <!-- Main Content -->
    <div class="container mt-5">
       
    <?php if ($_SERVER['REQUEST_URI'] !== root(). '/filter/ticket'):?>
    <h2 class="fs-4 fw-bold">
        Welcome back!
    </h2>
    <p class="text-secondary">
        Here's a list of your tickets raised
    </p>
    <p><?=flash('success')?></p>

    <div class="row g-2 my-3 mb-4">
    <form 
        action="<?= route('filter/ticket') ?>"
        method="post">
        <div class="row align-items-center">
            <div class="col-auto">
                <input 
                    type="text" 
                    class="form-control" 
                    name="ticketId" 
                    placeholder="Ticket Id"
                >
            </div>

            <div class="col-auto">
                <select class="form-select" name="status">
                    <option value="">Status</option>
                    <option value="PENDING">PENDING</option>
                    <option value="CUSTOMER REVIEW">UAT TESTING</option>
                    <option value="ANALYSIS">LIVE</option>
                    <option value="RESOLVED">RESOLVED</option>
                    <option value="PROCESSING">DEVELOPMENT</option>
                    <option value="CLOSED">CLOSED</option>
                    <option value="REOPENED">REOPENED</option>
                </select>
            </div>

            <!-- Priority -->
            <div class="col-auto">
                <select 
                    class="form-select" 
                    name="priority"
                >
                    <option value="">Priority</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <!-- Start Date -->
            <!-- <div class="col-auto position-relative">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleDatePicker('start-date');">
                    📅 Start Date
                </button>
                <div id="start-date-picker" class="position-absolute bg-white border p-2" style="display: none; z-index: 10;">
                    <input type="datetime-local" id="start-date" name="startDate" class="form-control">
                </div>
            </div> -->

            <!-- End Date -->
            <!-- <div class="col-auto position-relative">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleDatePicker('end-date');">
                    📅 End Date
                </button>
                <div id="end-date-picker" class="position-absolute bg-white border p-2" style="display: none; z-index: 10;">
                    <input type="datetime-local" id="end-date" name="endDate" class="form-control">
                </div>
            </div> -->

            <!-- Search Button -->
            <div class="col-auto">
                <button 
                    type="submit" 
                    class="btn btn-outline-dark"
                >Search
            </button>
            </div>

            <!-- Export Button -->
            <!-- <div class="col-auto ms-auto">
                <button type="button" id="exportButton" class="btn btn-success">Export Report</button>
            </div> -->
        </div>
    </form>
</div>
<!-- </div> -->
        
<div class="table-responsive">
    <table class="table table-bordless text-white">
        <thead class="table-secondary">
            <tr>
                <th>Request_id</th>
                <th>Ticket Summary</th>
                <th>Priority</th>
                <th>Created at</th>
                <th>Status</th>		
                <th>Status</th>		
            </tr>
        </thead>
        <tbody>
        <?php foreach($data as $value):?>
            <tr class="text-dark">
                <td>
                    <a 
                        style="text-decoration: none;" 
                        href="<?= route('status/details?ticket='. $value['ticketId']) ?>">
                        <strong><?= $value['ticketId'] ?></strong>
                    </a>
                </td>
                <td>
                    <span class="badge bg-secondary">
                        <?= $value['department'] ?>
                    </span> 
                    <?= shortText($value['summary'], '50', '...')?>
                </td>
                <td>
                    <?= ($value['priority'] === 'High')? '<span class="badge bg-danger bi bi-arrow-up">'
                    . ' '. $value['priority'] .' </span>' : '<span class="badge bg-info bi bi-arrow-down text-dark">'
                    . ' '. $value['priority'] .' </span>'?>
                </td>
                <td>
                    <?= regularDate($value['make_at']) ?>
                </td>
                <td>
                    <strong><?= $value['status'] ?></strong>
                </td>
                <td>
                    <strong><?= $value['status'] ?></strong>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<p class="text-secondary text-center">
    Showing <?= $page ?> of <?= $pages ?>. Total Records <?= $records ?>
</p>
<nav aria-label="Page navigation example p-2">
    <ul class="pagination justify-content-end">
        <!-- Previous Button -->
        <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
            <a 
                class="page-link" 
                href="<?= $page > 1 ? route('dashboard?page=' . ($page - 1)) : '#' ?>" tabindex="-1">
                Previous
            </a>
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
                <a 
                    class="page-link" 
                    href="<?= route('dashboard?page=' . $i) ?>">
                    <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>

        <!-- Next Button -->
        <li class="page-item <?= $page >= $pages ? 'disabled' : '' ?>">
            <a 
                class="page-link" 
                href="<?= $page < $pages ? route('dashboard?page=' . ($page + 1)) : '#' ?>">
                Next
            </a>
        </li>
    </ul>
</nav>
<?php else:?>
<h2 class="fs-4 fw-bold">Filtered Tickets</h2>
    <p class="text-secondary mb-3">
        If the item does not display here, use reports for more search results. 
        <a 
            href="<?= route('dashboard')?>">
             Click to go back 
        </a>
    </p>
    <div class="row g-2 my-3 mb-4 pb-4">
    <form 
        action="<?= route('filter/ticket') ?>" 
        method="post">
        <div class="row align-items-center">
            <!-- Ticket ID -->
            <div class="col-auto">
                <input 
                    type="text"
                    class="form-control" 
                    name="ticketId" 
                    placeholder="Ticket Id"
                >
            </div>

            <!-- Status -->
            <div class="col-auto">
                <select class="form-select" name="status">
                    <option value="">Status</option>
                    <option value="NEW">NEW</option>
                    <option value="CUSTOMER REVIEW">CUSTOMER REVIEW</option>
                    <option value="ANALYSIS">ANALYSIS</option>
                    <option value="RESOLVED">RESOLVED</option>
                    <option value="PROCESSING">PROCESSING</option>
                    <option value="CLOSED">CLOSED</option>
                    <option value="REOPENED">REOPENED</option>
                </select>
            </div>

            <!-- Priority -->
            <div class="col-auto">
                <select class="form-select" name="priority">
                    <option value="">Priority</option>
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <!-- Start Date -->
            <!-- <div class="col-auto position-relative">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleDatePicker('start-date');">
                    📅 Start Date
                </button>
                <div id="start-date-picker" class="position-absolute bg-white border p-2" style="display: none; z-index: 10;">
                    <input type="datetime-local" id="start-date" name="startDate" class="form-control">
                </div>
            </div> -->

            <!-- End Date -->
            <!-- <div class="col-auto position-relative">
                <button type="button" class="btn btn-outline-secondary" onclick="toggleDatePicker('end-date');">
                    📅 End Date
                </button>
                <div id="end-date-picker" class="position-absolute bg-white border p-2" style="display: none; z-index: 10;">
                    <input type="datetime-local" id="end-date" name="endDate" class="form-control">
                </div>
            </div> -->

            <!-- Search Button -->
            <div class="col-auto">
                <button 
                    type="submit" 
                    class="btn btn-outline-dark">
                    Search
                </button>
            </div>

            <!-- Export Button -->
            <div class="col-auto ms-auto">
                <button 
                    type="button" 
                    id="exportButton" 
                    class="btn btn-outline-dark">
                    Export Report
                </button>
            </div>
        </div>
    </form>
	 </div>

     <div class="table-responsive mt-3">
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
                <?php foreach($filters as $value): ?>
                    <tr class="text-dark">
                        <td>
                            <a 
                                style="text-decoration: none;" 
                                href="<?= route('status/details?ticket='. $value['ticketId']) ?>">
                                <strong><?= $value['ticketId'] ?></strong>
                            </a>
                        </td>
                        <td>
                            <span 
                                class="badge bg-secondary">
                                <?= $value['department'] ?>
                            </span> 
                            <?= shortText($value['summary'], '90', '...')?>
                        </td>
                        <td>
                            <?= ($value['priority'] === 'High')
                            ? '<span 
                                class="badge bg-danger bi bi-arrow-up">'
                                . ' '. $value['priority'] .' 
                              </span>' 
                            : '<span 
                                class="badge bg-info bi bi-arrow-down text-dark">'
                                . ' '. $value['priority'] .
                                ' </span>'?>
                        </td>
                        <td>
                            <?= regularDate($value['Update_at']) ?>
                        </td>
                        <td>
                            <strong><?= $value['status'] ?></strong>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
            
        </div>
    <?php endif;?>
    
    </div>

<script>
    // Toggle Date Picker Display
    function toggleDatePicker(id) {
        const picker = document.getElementById(id + '-picker');
        picker.style.display = picker.style.display === "block" ? "none" : "block";
    }

    // Close the picker when the user selects a date
    function closeDatePicker(id) {
        const picker = document.getElementById(id + '-picker');
        picker.style.display = "none";
    }

        // Format date and time in a consistent manner
        function formatDateTime(date) {
        let year = date.getFullYear();
        let month = String(date.getMonth() + 1).padStart(2, '0');
        let day = String(date.getDate()).padStart(2, '0');
        let hours = String(date.getHours()).padStart(2, '0');
        let minutes = String(date.getMinutes()).padStart(2, '0');
        return `${year}-${month}-${day} ${hours}:${minutes}`;
    }

    // Auto-set default date values on load
    window.onload = function () {
        let now = new Date();

        // Start Date: Today at 00:00
        let startDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 0, 0, 0);
        
        // End Date: Today at 23:59
        let endDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), 23, 59, 59);

        document.getElementById("start-date").value = formatDateTime(startDate);
        document.getElementById("end-date").value = formatDateTime(endDate);

        // Add event listeners to close the picker on change
        document.getElementById("start-date").addEventListener("change", function () {
            this.value = this.value.replace(/[^0-9T:-]/g, '');  // Clean up any unwanted characters
            closeDatePicker('start-date');
        });

        document.getElementById("end-date").addEventListener("change", function () {
            this.value = this.value.replace(/[^0-9T:-]/g, '');  // Clean up any unwanted characters
            closeDatePicker('end-date');
        });
    };

    function exportJSONToCSV(filename, jsonData) {
    // Check if jsonData exists and is an array
    if (!Array.isArray(jsonData) || jsonData.length === 0) {
        console.error("No valid JSON data to export.");
        return;
    }

    // Get the headers from the first object in the array
    const headers = Object.keys(jsonData[0]);

    let csvContent = headers.join(',') + '\n';  // Add headers as the first row

    // Loop through each object in the JSON array
    jsonData.forEach(row => {
        let rowData = headers.map(header => {
            let cellData = row[header] === null || row[header] === undefined ? '' : row[header];
            // Escape commas and quotes in the cell data
            cellData = cellData.toString().replace(/"/g, '""');
            if (cellData.includes(',') || cellData.includes('"') || cellData.includes('\n')) {
                cellData = `"${cellData}"`;
            }
            return cellData;
        });
        csvContent += rowData.join(',') + '\n';  // Join row data with commas and add newline
    });

    // Create a Blob from the CSV data
    const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

    // Create an invisible link to download the CSV
    const link = document.createElement('a');
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, filename);
    } else {
        link.href = URL.createObjectURL(blob);
        link.download = filename;
        link.style.visibility = 'hidden';
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
}

// data from the back end 
let jsonData = <?= $export; ?>

// Add click event listener to the export button
document.getElementById('exportButton').addEventListener('click', function() {
    // Generate filename with current timestamp
    const now = new Date();
    const timestamp = now.getFullYear() + '-' +
                      String(now.getMonth() + 1).padStart(2, '0') + '-' +
                      String(now.getDate()).padStart(2, '0') + '_' +
                      String(now.getHours()).padStart(2, '0') + '-' +
                      String(now.getMinutes()).padStart(2, '0') + '-' +
                      String(now.getSeconds()).padStart(2, '0');
    const filename = `APSW_IMS_Ticketing_Export_report_${timestamp}.csv`;

    exportJSONToCSV(filename, jsonData);
});

</script>