<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold"><?= $pageName ?></h1>
    <div class="flex items-center gap-2">
        <!-- <a href="" class="px-3 py-1.5 text-sm bg-white border border-gray-300 text-black rounded-md">Transaction Report</a> -->
        <a href="<?=route('report/export') ?>" class="px-3 py-1.5 text-sm bg-black text-white rounded-md">Dashboard</a>
    </div>
</div>

<?php include('view/biReports/component/nav.links.php')?>

<?php if ($_SERVER['REQUEST_URI'] !== root(). '/add/search'):?>
<div class="flex flex-col md:flex-row bg-white rounded-lg p-6 border border-gray-300 shadow-md">
    <div class="w-full md:ml-6 mt-4 md:mt-0">
    <div class="flex items-center justify-between mb-4">
            
            <!-- Left Side: Report Title -->
            <h3 id="reportTitle" class="text-lg font-semibold text-black">Add Money Report</h3>

            <!-- Right Side: Inputs & Button -->
            <form action="<?= route('add/search')?>" method="post" class="flex items-center space-x-4">
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
                <div class="flex flex-col">
                    <label for="filter-type" class="text-sm font-medium text-gray-600">Status</label>
                    <select id="filter-type" name="status" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="REVIEWED">Reviewed</option>
                    <option value="PENDING">Pending</option>
                    <option value="APPROVED">Approved</option>
                    <option value="REJECTED">Rejected</option>
                    </select>
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
                    <th class="border px-4 py-2">Form id</th>
                        <th class="border px-4 py-2">Bank</th>
                        <th class="border px-4 py-2">Bank Txn Ref#</th>
                        <th class="border px-4 py-2">Transaction Amount</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Approved by</th>
                        <th class="border px-4 py-2">Approved at</th>
                        <th class="border px-4 py-2">Reviewed by</th>
                        <th class="border px-4 py-2">Reviewed at</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Dynamic Rows -->
                </tbody>
            </table>
        </div>

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
            <h3 id="reportTitle" class="text-lg font-semibold text-black">Add Money Report</h3>

            <!-- Right Side: Inputs & Button -->
            <form action="<?= route('add/search')?>" method="post" class="flex items-center space-x-4">
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
                <div class="flex flex-col">
                    <label for="filter-type" class="text-sm font-medium text-gray-600">Status</label>
                    <select id="filter-type" name="status" class="p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="REVIEWED">Reviewed</option>
                    <option value="PENDING">Pending</option>
                    <option value="APPROVED">Approved</option>
                    <option value="REJECTED">Rejected</option>
                    </select>
                </div>

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
                        <th class="border px-4 py-2">Form id</th>
                        <th class="border px-4 py-2">Vendor Name</th>
                        <th class="border px-4 py-2"> Vendor Wallet #</th>
                        <th class="border px-4 py-2">Transaction Amount</th>
                        <th class="border px-4 py-2">Date</th>
                        <th class="border px-4 py-2">Status</th>
                        <th class="border px-4 py-2">Approved by</th>
                        <th class="border px-4 py-2">Approved at</th>
                        <th class="border px-4 py-2">Reviewed by</th>
                        <th class="border px-4 py-2">Reviewed at</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($results as $value):?>
                    <tr>
                        <td class="px-4 py-2 text-start"><?= $value['transaction_id']?></td>
                        <td class="px-4 py-2 text-start"><?= $value['wallet_name']?></td>
                        <td class="px-4 py-2 text-start"><?= $value['wallet_number']?></td>
                        <td class="px-4 py-2 text-end"><?= format_number($value['Transaction_amount'])?></td>
                        <td class="px-4 py-2 text-end"><?= regularDate($value['created_at'])?></td>
                        <td class="px-4 py-2 text-end"><?= $value['transaction_status']?></td>
                        <td class="px-4 py-2 text-end"><?= $value['Approved_by']?></td>
                        <td class="px-4 py-2 text-end"><?= ($value['approved_at'] == NULL)? '-' : regularDateTime($value['approved_at'])?></td>
                        <td class="px-4 py-2 text-end"><?= $value['review_by']?></td>
                        <td class="px-4 py-2 text-end"><?= ($value['reviewed_at'] == NULL)? '-' : regularDateTime($value['reviewed_at'])?></td>
                    </tr>
                <?php endforeach;?>
                </tbody>
            </table>
            <?php if(empty($results)):?>
                <p class="text-center text-black px-3 py-1.5 font-semibold">No record found</p>
            <?php endif;?>
        </div>
    </div>
</div>
<?php endif;?>
