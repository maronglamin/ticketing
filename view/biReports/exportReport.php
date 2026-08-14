<?php include('view/biReports/component/nav.links.php')?>

<div class="flex flex-col md:flex-row bg-white rounded-lg p-6 border border-gray-300 shadow-md">
    <div class="w-full md:ml-6 mt-4 md:mt-0">
        <div class="flex justify-between items-center mb-4">
            <h3 id="reportTitle" class="text-lg font-semibold text-black">Quick Overview of the workflow reports</h3>
            <div class="flex items-center gap-2 p-6">
            <a
                href="<?=route('report/export') ?>"
                class="px-3 py-1.5 text-sm bg-white border border-gray-300 text-black rounded-md"
            >Back</a>
            </div>
        </div>

        <p class="p-6 text-black">The use the tab above to navigate to the export report, quick overview coming soon</p>
    </div>
</div>