<div class="flex gap-4 mb-6 border-b border-gray-300">
<?php if(deptPermission('APSW IT') || deptPermission('APSW Operations')) :?>
    <a href="<?=route('dashboard/reports') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/export', ' text-black border-b-2 border-black', 'text-gray-600')?>">Overview</a>
    <a href="<?=route('report/create/money') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/create/money', ' text-black border-b-2 border-black', 'text-gray-600')?>">Create Money</a>
    <a href="<?=route('report/add/money') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/add/money', ' text-black border-b-2 border-black', 'text-gray-600')?>">Add Money</a>
    <a href="<?=route('report/kill/money') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/kill/money', ' text-black border-b-2 border-black', 'text-gray-600')?>">Kill Money</a>
    <a href="<?=route('report/comulation') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/comulation', ' text-black border-b-2 border-black', 'text-gray-600')?>">Settlement Comulative Report</a>
<?php endif;?>

<?php if(deptPermission('APSW IT') || deptPermission('APSW Finance')) :?>
    <a href="<?=route('report/notes') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/notes', ' text-black border-b-2 border-black', 'text-gray-600')?>">Payment instruction</a>
<?php endif;?>

<?php if(deptPermission('APSW IT') || deptPermission('APSW Call Center')) :?>
    <a href="<?=route('report/callcenter') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/callcenter', ' text-black border-b-2 border-black', 'text-gray-600')?>">CCR Daily Reports</a>
<?php endif;?>

<?php if(deptPermission('APSW IT') || deptPermission('APSW Agent Operations')) :?>
    <a href="<?=route('report/agentOps') ?>" class="px-4 py-2 text-sm <?= currntUrl('/report/agentOps', ' text-black border-b-2 border-black', 'text-gray-600')?>">Agent Ops Reports</a>
<?php endif;?>

</div>