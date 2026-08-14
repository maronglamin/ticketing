<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <?php foreach($kpi as $transaction):?>
        <div class="bg-gray-100 p-6 rounded-lg border border-gray-300 text-black">
            <span class="text-sm text-gray-600">Monthly <?= ($transaction['Transaction_type'])?> Transactions</span>
            <div class="text-2xl font-semibold mb-2">GMD <?= format_number($transaction['TotalAmount'])?></div>
            <div class="text-sm text-gray-500"><?= $transaction['TotalCount']?> <?= ($transaction['CountDifference'] == 1) ? '<strong>Transaction</strong>' : '<strong>Transaction</strong>' ?>, Diff <?= $transaction['CountDifference']?> in previous Month</div>
        </div>
    <?php endforeach;?>
    <?php if(!empty($settleKPI)) :?>
    <div class="bg-gray-100 p-6 rounded-lg border border-gray-300 text-black">
        <span class="text-sm text-gray-600">Monthly Agent Settlement</span>
        <div class="text-2xl font-semibold mb-2"><?= format_number($settleKPI['TotalAmount'])?></div>
        <div class="text-sm text-gray-500"><?= $settleKPI['TotalCount']?> Count for the Month</div>
    </div>
    <?php endif;?>
    <!-- <div class="bg-gray-100 p-6 rounded-lg border border-gray-300 text-black">
        <span class="text-sm text-gray-600">Sales</span>
        <div class="text-2xl font-semibold mb-2">+12,234</div>
        <div class="text-sm text-gray-500">+19% from last month</div>
    </div>
    <div class="bg-gray-100 p-6 rounded-lg border border-gray-300 text-black">
        <span class="text-sm text-gray-600">Active Now</span>
        <div class="text-2xl font-semibold mb-2">+573</div>
        <div class="text-sm text-gray-500">+201 since last hour</div>
    </div> -->
</div>
