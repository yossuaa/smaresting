<button
    id="menuBtn"
    class="lg:hidden fixed top-4 left-4 z-[9999] bg-emerald-500 text-white w-10 h-10 rounded-xl shadow-lg text-[18px]">
    ☰
</button>
<aside
    id="mobileSidebar"
    class="app-sidebar theme-sidebar fixed left-0 top-0 h-screen w-[260px] lg:w-[300px]
           border-r flex flex-col overflow-y-auto
           z-[9998] transition-all duration-300
           -translate-x-full lg:translate-x-0">

    <div class="absolute -top-24 -left-24 w-72 h-72 bg-emerald-500/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 -right-24 w-72 h-72 bg-cyan-500/10 rounded-full blur-3xl"></div>

    <div class="relative z-10">
        <div class="px-5 py-6 lg:px-7 lg:py-10 border-b" style="border-color: var(--border)">
             
            <div class="flex items-center gap-4">
                <div>
                    <div class="w-20 h-20 rounded-2xl bg-emerald-500 flex items-center justify-center shadow-lg shadow-emerald-600/30 mb-8">
                        <img src="{{ asset('images/logo.png') }}" alt="Smaresting" class="w-14 h-14 object-contain"/>
                    </div>
                    <h1 class="theme-title text-[24px] lg:text-[34px] font-bold leading-none">Smaresting</h1>
                    <p class="text-emerald-400 text-[17px] mt-1">Smart Lighting</p>
                </div>
            </div>
            <div class="theme-card mt-7 rounded-2xl px-4 py-3 lg:px-5 lg:py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="theme-muted text-[14px]">System Status</p>
                        <p class="theme-title text-[18px] font-semibold mt-1">Residential Area</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 bg-emerald-400 rounded-full animate-pulse"></span>
                        <span class="text-emerald-400 text-[14px] font-semibold">Online</span>
                    </div>
                </div>
            </div>
        </div>

        <nav class="p-5 space-y-3">

            <a href="/dashboard"
               class="group flex items-center gap-4 px-4 py-3 lg:px-5 lg:py-4 rounded-2xl text-[16px] lg:text-[20px] font-semibold transition-all duration-300
               {{ request()->is('dashboard') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'theme-title hover:bg-emerald-500/10' }}">
                Dashboard
            </a>

            <a href="/monitoring"
               class="group flex items-center gap-4 px-4 py-3 lg:px-5 lg:py-4 rounded-2xl text-[16px] lg:text-[20px] font-semibold transition-all duration-300
               {{ request()->is('monitoring') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'theme-title hover:bg-emerald-500/10' }}">
               
                Monitoring
            </a>

            <a href="/data-sensor"
               class="group flex items-center gap-4 px-4 py-3 lg:px-5 lg:py-4 rounded-2xl text-[16px] lg:text-[20px] font-semibold transition-all duration-300
               {{ request()->is('data-sensor') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'theme-title hover:bg-emerald-500/10' }}">
              Riwayat
            </a>

            <a href="/analytics"
               class="group flex items-center gap-4 px-4 py-3 lg:px-5 lg:py-4 rounded-2xl text-[16px] lg:text-[20px] font-semibold transition-all duration-300
               {{ request()->is('analytics') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'theme-title hover:bg-emerald-500/10' }}">
               
                Analytics
            </a>

            <a href="/settings"
               class="group flex items-center gap-4 px-4 py-3 lg:px-5 lg:py-4 rounded-2xl text-[16px] lg:text-[20px] font-semibold transition-all duration-300
               {{ request()->is('settings') ? 'bg-emerald-500 text-white shadow-lg shadow-emerald-500/30' : 'theme-title hover:bg-emerald-500/10' }}">
                Pengaturan
            </a>

        </nav>
    </div>

    <div class="relative z-10 p-5 border-t mt-4" style="border-color: var(--border)">
        <div class="theme-card mb-4 rounded-2xl px-4 py-3 lg:px-5 lg:py-4">
            <p class="theme-muted text-[14px]">Smart Residential</p>
            <p class="theme-title text-[17px] font-semibold mt-1">Street Lighting System</p>
        </div>

        <a href="/logout"
           class="flex items-center justify-center gap-3 border border-rose-400/60 text-rose-400 py-4 rounded-2xl text-[16px] lg:text-[20px] font-semibold hover:bg-rose-500 hover:text-white hover:border-rose-500 transition-all duration-300">
            Logout
        </a>
    </div>
<style>
@media (max-width: 640px) {
    .app-sidebar {
        width: 260px !important;
    }

    .app-sidebar h1 {
        font-size: 24px !important;
    }

    .app-sidebar a {
        font-size: 16px !important;
    }
}
</style>

<script>
const menuBtn = document.getElementById('menuBtn');
const sidebar = document.getElementById('mobileSidebar');

menuBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('-translate-x-full');
});
</script>
</aside>