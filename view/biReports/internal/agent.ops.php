<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold"><?= $pageName ?></h1>
    <div class="flex items-center gap-2">
        <!-- <a href="" class="px-3 py-1.5 text-sm bg-white border border-gray-300 text-black rounded-md">Transaction Report</a> -->
        <a href="<?=route('report/export') ?>" class="px-3 py-1.5 text-sm bg-black text-white rounded-md">Dashboard</a>
    </div>
</div>

<?php include('view/biReports/component/nav.links.php')?>

<?php if ($_SERVER['REQUEST_URI'] !== root(). '/agent/reps/search'):?>
<div class="flex flex-col md:flex-row bg-white rounded-lg p-6 border border-gray-300 shadow-md m-6">
    <div class="w-full md:ml-6 mt-4 mr-4 md:mt-0">
    <div class="flex items-center justify-between mb-4">
            
            <!-- Left Side: Report Title -->
            <h3 id="reportTitle" class="text-lg font-semibold text-black">Agent/ADR Detail report</h3>

            <!-- Right Side: Inputs & Button -->
            <form action="<?= route('agent/reps/search')?>" method="post" class="flex items-center space-x-4">
                <!-- Start Time -->
                <div class="flex flex-col">
                    <label for="start-time" class="text-sm font-medium text-gray-600">Start Time</label>
                    <input type="datetime-local" id="start-date" name="startDate" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- End Time -->
                <div class="flex flex-col">
                    <label for="end-time" class="text-sm font-medium text-gray-600">End Time</label>
                    <input type="datetime-local" id="end-date" name="endDate" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Search Button -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Search
                </button>
            </form>
        </div>

        
        

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-max border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">Ticket ID</th>
                        <th class="border px-4 py-2">Ticket Channel</th>
                        <th class="border px-4 py-2">Resolver</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Reported Channel</th>
                        <th class="border px-4 py-2">Issue Type</th>
                        <th class="border px-4 py-2">Issue Category</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Created By</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Dynamic Rows -->
                </tbody>
            </table>
        </div>

        <!-- Pagination
        <div class="flex justify-between items-center mt-4">
            <p class="text-gray-600">1 - 5 of 50 records</p>
            <div class="flex items-center gap-2">
                <button class="px-3 py-1 bg-gray-300 text-black rounded-md" id="prevPage">Previous</button>
                <span id="pageNumbers" class="text-black"></span>
                <button class="px-3 py-1 bg-gray-300 text-black rounded-md" id="nextPage">Next</button>
            </div>
        </div> -->
    </div>
</div>

<?php else:?>

<div class="flex flex-col md:flex-row bg-white rounded-lg p-6 border border-gray-300 shadow-md m-6">
    <div class="w-full md:ml-6 mt-4 md:mt-0">
        <div class="flex justify-between items-center mb-4">
            <h3 id="reportTitle" class="text-lg font-semibold text-black">Export To CSV</h3>
            <div class="flex items-center gap-2 p-6">
                <button
                    id="exportButton"
                    class="bg-blue-600 text-white px-4 py-2 rounded-md"
                >Export
                </button>
            </div>
        </div>

        <div class="bg-gray-100 flex justify-center mb-3">
        <div class="w-full bg-white p-4 shadow-md rounded-lg">
        <!-- Toggle Button -->
        <div class="flex justify-between items-center cursor-pointer p-3 bg-gray-200 rounded-lg" onclick="toggleFilter()">
            <h2 class="text-lg font-semibold text-gray-700">Search Again</h2>
            <button id="toggleBtn" class="text-gray-700 font-medium">➕ Open</button>
        </div>

        <!-- Expandable Section (Initially Hidden) -->
        <div id="filterSection" class="overflow-hidden max-h-0 transition-all duration-500 ease-in-out">
            <div class="flex items-center justify-between m-4">
            
            <!-- Left Side: Report Title -->
            <h3 id="reportTitle" class="text-lg font-semibold text-black">Create Money Report</h3>

            <!-- Right Side: Inputs & Button -->
            <form action="<?= route('agent/reps/search')?>" method="post" class="flex items-center space-x-4">
                <!-- Start Time -->
                <div class="flex flex-col">
                    <label for="start-time" class="text-sm font-medium text-gray-600">Start Time</label>
                    <input type="datetime-local" id="start-date" name="startDate" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- End Time -->
                <div class="flex flex-col">
                    <label for="end-time" class="text-sm font-medium text-gray-600">End Time</label>
                    <input type="datetime-local" id="end-date" name="endDate" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Dropdown -->
                <!-- <div class="flex flex-col">
                    <label for="filter-type" class="text-sm font-medium text-gray-600">Status</label>
                    <select id="filter-type" name="status" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="REVIEWED">Reviewed</option>
                    <option value="PENDING">Pending</option>
                    <option value="APPROVED">Approved</option>
                    <option value="REJECTED">Rejected</option>
                    </select>
                </div> -->

                <!-- Search Button -->
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Search
                </button>
            </form>
        </div>
            <!-- </form> -->
        </div>
        </div>
        </div>

        
        

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-max border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                       <th class="border px-4 py-2">Ticket ID</th>
                        <th class="border px-4 py-2">Ticket Channel</th>
                        <th class="border px-4 py-2">Resolver</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Reported Channel</th>
                        <th class="border px-4 py-2">Issue Type</th>
                        <th class="border px-4 py-2">Issue Category</th>
                        <th class="border px-4 py-2">Description</th>
                        <th class="border px-4 py-2">Created By</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($results as $value):?>
                    <tr>
                        <td class="px-4 py-2 text-start"><?= $value['ticketId']?></td>
                        <td class="px-4 py-2 text-start"><?= $value['ticket_channel']?></td>
                        <td class="px-4 py-2 text-start"><?= $value['resolver']?></td>
                        <td class="px-4 py-2 text-end"><?= regularDate($value['created_at'])?></td>
                        <td class="px-4 py-2 text-end"><?= $value['reportedChannel']?></td>
                        <td class="px-4 py-2 text-end"><?= $value['issueType']?></td>
                        <td class="px-4 py-2 text-end"><?= $value['issueCat']?></td>
                        <td class="px-4 py-2 text-end"><?= $value['description']?></td>
                        <td class="px-4 py-2 text-end"><?= $value['maker_id']?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <?php if(empty($results)):?>
                <p class="text-center text-black px-3 py-1.5 font-semibold">No record found</p>
            <?php endif;?>        </div>
    </div>
</div>
<?php endif;?>