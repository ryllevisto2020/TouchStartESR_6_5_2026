<div class="relative" id="bellWrap">

    {{-- Bell button --}}
    <button
                onclick="toggleBellDropdown()"
                class="relative w-[38px] h-[38px] rounded-full bg-white border border-slate-200 shadow-sm
                    flex items-center justify-center hover:bg-yellow-100 hover:border-yellow-200 transition-colors"
                aria-label="CSAT Notifications"
            >
                <svg class="w-[17px] h-[17px] stroke-slate-500 fill-none" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 2l3.09 6.26L22 9.27l-5 4.87
                            1.18 6.88L12 17.77l-6.18 3.25L7 14.14
                            2 9.27l6.91-1.01L12 2z"/>
                </svg>

                <span class="absolute -top-1 -right-1 flex items-center justify-center
                            min-w-[18px] h-[18px] px-1 bg-red-500 text-white text-[9px] font-bold
                            rounded-full border-2 border-white animate-pulse">1</span>
        </button>

    {{-- Dropdown --}}
    <div
        id="bellDropdown"
        class="hidden absolute right-0 top-[calc(100%+10px)] w-80 bg-white
               border border-slate-200 rounded-2xl shadow-xl overflow-hidden z-50"
    >
        {{-- Header --}}
        <div class="px-4 py-3 bg-gradient-to-r from-[#1565c0] to-[#0d47a1]
                    flex items-center justify-between border-b-2 border-[#C9A84C]">
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-[#C9A84C]" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969
                             0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755
                             1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197
                             -1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588
                             -1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
                <span class="text-white text-sm font-semibold">Satisfaction Surveys</span>
            </div>
            <span class="text-[9px] font-bold bg-red-500 text-white px-2 py-0.5 rounded-full">1 Pending</span>
        </div>

        {{-- List --}}
        <div class="max-h-72 overflow-y-auto divide-y divide-gray-50">
            <a
                href="#"
                onclick="toggleBellDropdown(); openCsatModal(); return false;"
                class="flex items-start gap-3 px-4 py-3 hover:bg-amber-50 transition-colors group cursor-pointer"
            >
                <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center mt-0.5">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2
                                 M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate group-hover:text-[#0B1F3A]">
                        Preventive Maintenance
                    </p>
                    <p class="text-xs text-gray-500 mt-0.5">Engineer: Juan Dela Cruz</p>
                    <p class="text-xs text-gray-400">June 9, 2025</p>
                </div>
                <svg class="w-4 h-4 text-gray-300 group-hover:text-[#C9A84C] flex-shrink-0 mt-1 transition-colors"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-2.5 bg-gray-50 border-t border-gray-100">
            <a href="#"
               class="flex items-center justify-center gap-1.5 text-xs font-semibold
                      text-[#0B1F3A] hover:text-[#C9A84C] transition-colors">
                View all pending surveys
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</div>
@include('survey.rate')
<script>
document.addEventListener('DOMContentLoaded', function () {

    window.toggleBellDropdown = function () {
        document.getElementById('bellDropdown').classList.toggle('hidden');
    };

    // Close on outside click
    document.addEventListener('click', function (e) {
        const wrap = document.getElementById('bellWrap');
        if (wrap && !wrap.contains(e.target)) {
            document.getElementById('bellDropdown')?.classList.add('hidden');
        }
    });

});
</script>