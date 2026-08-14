<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold"><?= $pageName ?></h1>
    <div class="flex items-center gap-2">
        <!-- <a href="" class="px-3 py-1.5 text-sm bg-white border border-gray-300 text-black rounded-md">Transaction Report</a> -->
        <a href="<?=route('report/export') ?>" class="px-3 py-1.5 text-sm bg-black text-white rounded-md">Transaction Report</a>
    </div>
</div>
<div class="flex gap-4 mb-6 border-b border-gray-300">
    <a href="<?=route('dashboard/reports') ?>" class="px-4 py-2 text-sm <?= currntUrl('/dashboard/reports', ' text-black border-b-2 border-black', 'text-gray-600')?>">Overview</a>
    <button class="px-4 py-2 text-sm">Analytics</button>
    <a href="<?= route('report/export') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/export', ' text-black border-b-2 border-black', 'text-gray-600')?>">Export Reports</a>
    <button class="px-4 py-2 text-sm text-gray-600">Notifications</button>
</div>

<?php require base_path('view/partial/resource/KPI.php');?> 
<!-- Recent Sales -->
<!-- <div class="grid md:grid-cols-12 lg:grid-cols-6 gap-4 mb-8">
    <div class="col-span-2 bg-gray-100 rounded-lg p-6 border border-gray-300">
        <h3 class="text-lg font-semibold text-black mb-2">Withdraw to Trust Top Unique Agents</h3>
        <p class="text-sm text-gray-500 mb-6">Top 7 agents Ranked base on the transaction count.</p>
        
        <?php #foreach($topAgentTrxnCount as $txnCount):?>
            <div class="space-y-5 mb-3">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-300"></div>
                        <div>
                            <div class="text-sm font-medium text-black"><?= shortText($txnCount['agent_name'], 25, '...')?></div>
                            <div class="text-xs text-gray-500">Txn count: <?= ' ' .$txnCount['transaction_count'] . ' and Average value of ' . format_number($txnCount['average_debit_amount'])?></div>
                        </div>
                    </div>
                    <div class="text-sm font-medium text-black"><?= format_number($txnCount['total_debit_amount'])?></div>
                </div>
            </div>
        <?php # endforeach;?>
    </div>
    <div class="col-span-4 bg-gray-100 rounded-lg p-6 border border-gray-300">
        <h3 class="text-lg font-semibold text-black mb-2">Summary</h3>
        <p class="text-sm text-gray-500">A quick overview of the recent sales performance.</p>

        <!-- Recent Sales -->
<!-- <div class="grid grid-cols-12 gap-4 mt-2">
    <div class="col-span-6 bg-gray-100 rounded-lg p-6 border border-gray-300">
        <h3 class="text-lg font-semibold text-black mb-2">Withdraw to Trust Top unique Agent</h3>
        <p class="text-sm text-gray-500 mb-6">You made 265 sales this month.</p>
        <div class="space-y-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-300"></div>
                    <div>
                        <div class="text-sm font-medium text-black">Olivia Martin</div>
                        <div class="text-xs text-gray-500">olivia.martin@email.com</div>
                    </div>
                </div>
                <div class="text-sm font-medium text-black">+$1,999.00</div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-gray-300"></div>
                    <div>
                        <div class="text-sm font-medium text-black">Jackson Lee</div>
                        <div class="text-xs text-gray-500">jackson.lee@email.com</div>
                    </div>
                </div>
                <div class="text-sm font-medium text-black">+$39.00</div>
            </div>
        </div>
    </div>
    <div class="col-span-6 bg-gray-100 rounded-lg p-6 border border-gray-300">
        <h3 class="text-lg font-semibold text-black mb-2">Summary</h3>
        <p class="text-sm text-gray-500">A quick overview of the recent sales performance.</p>
    </div>
</div>

    </div>
</div> -->

<div class="col-span-12 bg-white rounded-lg p-6 border border-gray-300 mt-6">
<h3 class="text-lg font-semibold text-black mb-2">Top 7 Comulative Settlement Amount by Agent</h3>
<p class="text-sm text-gray-500 mb-6">For detail on this report, SEE Comulative agent settlement report</p>
    
    <!-- Responsive Table Container -->
    <div class="w-full overflow-x-auto">
        <table class="min-w-full border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Agent Name</th>
                    <th class="px-4 py-2 border">Wallet Number</th>
                    <th class="px-4 py-2 border">Total Count</th>
                    <th class="px-4 py-2 border">Total Amount</th>
                    <th class="px-4 py-2 border">Average Transaction Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($topAgentTrxnCount as $value):?>
                    <tr>
                        <td class="px-4 py-2 text-start"><?= $value['agent_name']?></td>
                        <td class="px-4 py-2 text-start"><?= $value['agent_wallet_number']?></td>
                        <td class="px-4 py-2 text-end"><?= $value['transaction_count']?></td>
                        <td class="px-4 py-2 text-end"><?= format_number($value['total_debit_amount'])?></td>
                        <td class="px-4 py-2 text-end"><?= format_number($value['average_debit_amount'])?></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

    <!-- <div class="flex justify-between items-center mt-4">
        <p class="text-sm text-gray-600">1 - 5 of 50 records</p>
        <div class="flex space-x-2 items-center">
            <button class="px-3 py-1 text-sm bg-gray-300 text-black rounded">Previous</button>
            
            <div class="flex space-x-1">
                <button class="px-3 py-1 text-sm bg-blue-500 text-white rounded">1</button>
                <button class="px-3 py-1 text-sm bg-gray-300 text-black rounded">2</button>
                <button class="px-3 py-1 text-sm bg-gray-300 text-black rounded">3</button>
                <button class="px-3 py-1 text-sm bg-gray-300 text-black rounded">4</button>
                <span class="px-2 py-1 text-sm text-gray-600">...</span>
                <button class="px-3 py-1 text-sm bg-gray-300 text-black rounded">10</button>
            </div>
    
            <button class="px-3 py-1 text-sm bg-blue-500 text-white rounded">Next</button>
        </div>
    </div> -->
    
</div>


