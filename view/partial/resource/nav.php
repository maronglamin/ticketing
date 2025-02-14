<nav class="flex items-center justify-between px-6 py-4 bg-gray-100 border-b border-gray-300">
    <div class="flex items-center gap-8">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                <span class="text-gray-700"><img src="<?= root()?>/public/img/undraw_profile.svg" alt="Profile" width="30"></span>
            </div>
            <span class="text-gray-800"><?= fullname() ?></span>
        </div>
        <div class="flex gap-6">
            <a href="<?= route('dashboard')?>"><span class="<?= currntUrl('/uat_env/dashboard/reports', 'text-teal-950 border-b-2 border-black', 'text-gray-600')?>">Dashboard</span></a>
            <a href="<?= route('dashboard')?>"><span class="<?= currntUrl('/uat_env/dashboard/', 'text-teal-950 border-b-2 border-black', 'text-gray-600')?>">APSW Operations</span></a>
            <a href="<?= route('dashboard')?>"><span class="<?= currntUrl('/uat_env/dashboard/', 'text-teal-950 border-b-2 border-black', 'text-gray-600')?>">APSW Finance</span></a>
            <a href="<?= route('dashboard')?>"><span class="<?= currntUrl('/uat_env/dashboard/', 'text-teal-950 border-b-2 border-black', 'text-gray-600')?>">APSW Audit & Compliance</span></a>
            <a href="<?= route('dashboard')?>"><span class="<?= currntUrl('/uat_env/dashboard/', 'text-teal-950 border-b-2 border-black', 'text-gray-600')?>">Account Signatures</span></a>
            <a href="<?= route('dashboard')?>"><span class="<?= currntUrl('/uat_env/dashboard/', 'text-teal-950 border-b-2 border-black', 'text-gray-600')?>">Work Flow</span></a>
        </div>
    </div>
    <!-- <div class="relative">
        <input type="text" placeholder="Search..." class="bg-white border border-gray-300 rounded-md pl-10 pr-4 py-2 text-gray-700 w-64 focus:outline-none focus:ring-1 focus:ring-gray-400">
    </div> -->
</nav>

    <!-- Main Content -->
    <main class="p-6">