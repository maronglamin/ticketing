<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-semibold"><?= $pageName ?></h1>
    <!-- <div class="flex items-center gap-2">
        <button class="px-3 py-1.5 text-sm bg-white border border-gray-300 text-black rounded-md">Jan 20, 2023 - Feb 09, 2023</button>
        <button class="px-3 py-1.5 text-sm bg-black text-white rounded-md">Download</button>
    </div> -->
</div>
<div class="flex gap-4 mb-6 border-b border-gray-300">
    <a href="<?=route('dashboard/reports') ?>" class="px-4 py-2 text-sm <?= currntUrl('/uat_env/dashboard/reports', ' text-black border-b-2 border-black', 'text-gray-600')?>">Overview</a>
    <button class="px-4 py-2 text-sm">Analytics</button>
    <button class="px-4 py-2 text-sm text-gray-600">Export Reports</button>
    <button class="px-4 py-2 text-sm text-gray-600">Notifications</button>
</div>