@extends('layouts.app')
@section('title', 'Customer Satisfaction Results')
@section('content')

<style>
  /* Read-only star rating used inside the employee tracking modal */
  .ec-stars-readonly { display: inline-flex; gap: 1px; }
  .ec-stars-readonly .ec-star { font-size: 13px; line-height: 1; color: #e4e4e7; }
  .ec-stars-readonly .ec-star.filled { color: #C9A84C; }

  #employeeCsatModal.is-open { display: block; }

  /* Monthly bar chart */
  .csat-bar-chart { align-items: flex-end; }
  .csat-bar-col { display: flex; flex-direction: column; align-items: center; justify-content: flex-end; flex: 1; height: 100%; gap: 4px; }
  .csat-bar-pair { display: flex; align-items: flex-end; gap: 3px; height: 100%; }
  .csat-bar { width: 9px; border-radius: 3px 3px 0 0; transition: opacity .15s ease; }
  .csat-bar-2026 { background: #18181b; }
  .csat-bar-2025 { background: #e4e4e7; }
  .csat-bar-pair:hover .csat-bar { opacity: .75; }
  .csat-bar-labels span { font-size: 10px; color: #a1a1aa; flex: 1; text-align: center; }

  /* Top performers */
  .top-performer-row { display: flex; align-items: center; justify-content: space-between; gap: 10px; padding: 10px 0; border-bottom: 1px solid #f4f4f5; }
  .top-performer-row:last-child { border-bottom: none; padding-bottom: 0; }
  .top-performer-rank { width: 22px; height: 22px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; flex-shrink: 0; }
</style>
 <header class="flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-bold italic text-slate-800">
            Customer Satisfaction
        </h2>
        <p class="text-sm text-slate-500 mt-1">
            Monitor customer feedback, ratings and response trends.
        </p>
    </div>   
</header>

<!-- Full Width Main Content -->
<div class="w-full flex flex-col">
  <!-- Page Content -->
  <main class="flex-1 px-8 py-8 space-y-6">

    <!-- KPI Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Avg CSAT Score</span>
          <div class="w-8 h-8 bg-emerald-50 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
            </svg>
          </div>
        </div>
        <p class="text-2xl font-bold text-zinc-900">4.6 / 5</p>
        <p class="text-xs text-emerald-600 mt-1 font-medium">+0.2 from last month</p>
      </div>
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Total Responses</span>
          <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
            </svg>
          </div>
        </div>
        <p class="text-2xl font-bold text-zinc-900">3,842</p>
        <p class="text-xs text-emerald-600 mt-1 font-medium">+18.4% from last month</p>
      </div>
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Satisfaction Rate</span>
          <div class="w-8 h-8 bg-violet-50 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <p class="text-2xl font-bold text-zinc-900">87.3%</p>
        <p class="text-xs text-emerald-600 mt-1 font-medium">+3.1% from last month</p>
      </div>
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="flex items-center justify-between mb-3">
          <span class="text-xs font-medium text-zinc-400 uppercase tracking-wider">Detractors</span>
          <div class="w-8 h-8 bg-rose-50 rounded-lg flex items-center justify-center">
            <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018a2 2 0 01.485.06l3.76.94m-7 10v5a2 2 0 002 2h.096c.5 0 .905-.405.905-.904 0-.715.211-1.413.608-2.008L17 13V4m-7 10h2m5-10h2a2 2 0 012 2v6a2 2 0 01-2 2h-2.5"></path>
            </svg>
          </div>
        </div>
        <p class="text-2xl font-bold text-zinc-900">5.2%</p>
        <p class="text-xs text-red-500 mt-1 font-medium">-0.8% from last month</p>
      </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-1 gap-5">
      <!-- Donut Chart - Score Distribution -->
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="mb-4">
          <h2 class="text-sm font-semibold text-zinc-900">Score Distribution</h2>
          <p class="text-xs text-zinc-400 mt-0.5">Breakdown of ratings</p>
        </div>
        <div class="flex flex-col items-center">
          <div class="relative w-36 h-36">
            <svg viewBox="0 0 36 36" class="w-36 h-36 -rotate-90">
              <circle cx="18" cy="18" r="15.9155" fill="none" stroke="#f4f4f5" stroke-width="3.5"></circle>
              <circle class="donut-seg-5" cx="18" cy="18" r="15.9155" fill="none" stroke="#16a34a" stroke-width="3.5" stroke-dasharray="42 58" stroke-dashoffset="0"></circle>
              <circle class="donut-seg-4" cx="18" cy="18" r="15.9155" fill="none" stroke="#4ade80" stroke-width="3.5" stroke-dasharray="28 72" stroke-dashoffset="-42"></circle>
              <circle class="donut-seg-3" cx="18" cy="18" r="15.9155" fill="none" stroke="#fbbf24" stroke-width="3.5" stroke-dasharray="17 83" stroke-dashoffset="-70"></circle>
              <circle class="donut-seg-2" cx="18" cy="18" r="15.9155" fill="none" stroke="#f87171" stroke-width="3.5" stroke-dasharray="8 92" stroke-dashoffset="-87"></circle>
              <circle class="donut-seg-1" cx="18" cy="18" r="15.9155" fill="none" stroke="#ef4444" stroke-width="3.5" stroke-dasharray="5 95" stroke-dashoffset="-95"></circle>
            </svg>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
              <span class="text-xl font-bold text-zinc-900">4.6</span>
              <span class="text-xs text-zinc-400">avg score</span>
            </div>
          </div>
          <div class="mt-4 w-full space-y-2">
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-sm bg-green-600 inline-block"></span><span class="text-zinc-600">5 Stars</span></div>
              <span class="font-semibold text-zinc-900">42%</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-sm bg-green-400 inline-block"></span><span class="text-zinc-600">4 Stars</span></div>
              <span class="font-semibold text-zinc-900">28%</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-sm bg-amber-400 inline-block"></span><span class="text-zinc-600">3 Stars</span></div>
              <span class="font-semibold text-zinc-900">17%</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-sm bg-red-400 inline-block"></span><span class="text-zinc-600">2 Stars</span></div>
              <span class="font-semibold text-zinc-900">8%</span>
            </div>
            <div class="flex items-center justify-between text-xs">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-sm bg-red-500 inline-block"></span><span class="text-zinc-600">1 Star</span></div>
              <span class="font-semibold text-zinc-900">5%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Employee CSAT Table -->
    <div class="bg-white rounded-xl border border-zinc-200">
      <div class="px-5 py-4 border-b border-zinc-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div>
          <h2 class="text-sm font-semibold text-zinc-900">Employee CSAT Details</h2>
          <p class="text-xs text-zinc-400 mt-0.5">Individual performance &amp; satisfaction scores</p>
        </div>
        <div class="flex items-center gap-2">
          <div class="relative">
            <svg class="w-4 h-4 text-zinc-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <input type="text" placeholder="Search employees..." class="pl-9 pr-4 py-2 text-sm border border-zinc-200 rounded-lg bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 w-full sm:w-56 transition-all employee-search-input"/>
          </div>
          <select class="text-sm border border-zinc-200 rounded-lg px-3 py-2 bg-zinc-50 text-zinc-600 focus:outline-none focus:ring-2 focus:ring-zinc-900/10 employee-dept-filter">
            <option value="">All Departments</option>
            <option value="support">Support</option>
            <option value="sales">Sales</option>
            <option value="tech">Tech</option>
          </select>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead>
            <tr class="border-b border-zinc-100 bg-zinc-50/50">
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider">Employee</th>
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider hidden sm:table-cell">Department</th>
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider">CSAT Score</th>
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider hidden md:table-cell">Responses</th>
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider hidden lg:table-cell">Satisfaction</th>
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider hidden lg:table-cell">Trend</th>
              <th class="text-left px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider">Status</th>
              <th class="text-right px-5 py-3 text-xs font-medium text-zinc-400 uppercase tracking-wider">Action</th>
            </tr>
          </thead>
          <tbody class="employee-table-body"><!-- Rows injected by JS --></tbody>
        </table>
      </div>
      <div class="px-5 py-4 border-t border-zinc-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <p class="text-xs text-zinc-400 employee-count-label">Showing 8 of 24 employees</p>
        <div class="flex items-center gap-1 employee-pagination">
          <button class="px-3 py-1.5 text-xs text-zinc-400 border border-zinc-200 rounded-lg hover:bg-zinc-50 transition-colors cursor-pointer">Previous</button>
          <button class="px-3 py-1.5 text-xs bg-zinc-900 text-white rounded-lg cursor-pointer">1</button>
          <button class="px-3 py-1.5 text-xs text-blue-500 border border-blue-200 rounded-lg hover:bg-zinc-50 transition-colors cursor-pointer">Next</button>
        </div>
      </div>
    </div>

    <!-- Bottom Row: Top Performers + Recent Feedback -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
      <!-- Top Performers -->
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h2 class="text-sm font-semibold text-zinc-900">Top Performers</h2>
            <p class="text-xs text-zinc-400 mt-0.5">Highest CSAT scores this month</p>
          </div>
          <span class="text-xs text-zinc-400 bg-zinc-50 border border-zinc-200 px-2 py-1 rounded-lg">January 2026</span>
        </div>
        <div class="space-y-3 top-performers-list"><!-- Injected by JS --></div>
      </div>

      <!-- Recent Feedback -->
      <div class="bg-white rounded-xl border border-zinc-200 p-5">
        <div class="flex items-center justify-between mb-4">
          <div>
            <h2 class="text-sm font-semibold text-zinc-900">Recent Feedback</h2>
            <p class="text-xs text-zinc-400 mt-0.5">Latest customer survey responses</p>
          </div>
          <button class="text-xs text-zinc-500 hover:text-zinc-900 transition-colors font-medium">View all</button>
        </div>
        <div class="space-y-3">
          <div class="p-3.5 rounded-lg border border-zinc-100 bg-zinc-50/50">
            <div class="flex items-center justify-between mb-1.5">
              <div class="flex items-center gap-2">
                <img src="https://placehold.co/28x28" class="w-7 h-7 rounded-full object-cover" alt="Customer"/>
                <span class="text-xs font-semibold text-zinc-800">Michael Torres</span>
              </div>
              <div class="flex gap-0.5"><span class="text-amber-400 text-xs">★★★★★</span></div>
            </div>
            <p class="text-xs text-zinc-500 leading-relaxed">Excellent service. The agent resolved the issue quickly and professionally.</p>
            <div class="flex items-center justify-between mt-2">
              <span class="text-xs text-zinc-400">Agent: Sarah Johnson</span>
              <span class="text-xs text-zinc-400">2h ago</span>
            </div>
          </div>
          <div class="p-3.5 rounded-lg border border-zinc-100 bg-zinc-50/50">
            <div class="flex items-center justify-between mb-1.5">
              <div class="flex items-center gap-2">
                <img src="https://placehold.co/28x28" class="w-7 h-7 rounded-full object-cover" alt="Customer"/>
                <span class="text-xs font-semibold text-zinc-800">Amanda Clarke</span>
              </div>
              <div class="flex gap-0.5">
                <span class="text-amber-400 text-xs">★★★★</span>
                <span class="text-zinc-300 text-xs">★</span>
              </div>
            </div>
            <p class="text-xs text-zinc-500 leading-relaxed">Good support overall. Follow-ups could be faster, but the issue was resolved.</p>
            <div class="flex items-center justify-between mt-2">
              <span class="text-xs text-zinc-400">Agent: Mark Evans</span>
              <span class="text-xs text-zinc-400">5h ago</span>
            </div>
          </div>
          <div class="p-3.5 rounded-lg border border-rose-100 bg-rose-50/30">
            <div class="flex items-center justify-between mb-1.5">
              <div class="flex items-center gap-2">
                <img src="https://placehold.co/28x28" class="w-7 h-7 rounded-full object-cover" alt="Customer"/>
                <span class="text-xs font-semibold text-zinc-800">Robert Singh</span>
              </div>
              <div class="flex gap-0.5">
                <span class="text-amber-400 text-xs">★★</span>
                <span class="text-zinc-300 text-xs">★★★</span>
              </div>
            </div>
            <p class="text-xs text-zinc-500 leading-relaxed">Took too long and the issue was not fully resolved. Needs improvement.</p>
            <div class="flex items-center justify-between mt-2">
              <span class="text-xs text-zinc-400">Agent: Chris Lee</span>
              <span class="text-xs text-zinc-400">8h ago</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
</div>

<div id="employeeCsatModal" class="fixed inset-0 z-50 hidden">
  <div class="absolute inset-0 bg-zinc-900/50 backdrop-blur-[2px] employee-csat-modal-backdrop"></div>

  <div class="relative z-10 flex min-h-full items-center justify-center p-4">
    <div class="bg-white w-full max-w-4xl max-h-[88vh] rounded-2xl shadow-2xl flex flex-col overflow-hidden">

      <!-- Modal Header -->
      <div class="px-6 py-5 border-b border-zinc-100 flex items-start justify-between bg-gradient-to-r from-[#0B1F3A] to-[#122a4d]">
        <div class="flex items-center gap-3">
          <img id="ecModalAvatar" src="https://placehold.co/48x48" class="w-12 h-12 rounded-full object-cover ring-2 ring-[#C9A84C]/50" alt="Employee">
          <div>
            <h3 id="ecModalName" class="text-base font-bold text-white">Employee Name</h3>
            <p class="text-xs text-[#C9A84C] font-medium tracking-wide" id="ecModalDept">Department · Employee ID</p>
          </div>
        </div>
        <button type="button" class="employee-csat-modal-close text-white/60 hover:text-white transition-colors p-1">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Modal Stat Strip -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-px bg-zinc-100 border-b border-zinc-100">
        <div class="bg-white px-4 py-3">
          <p class="text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">Avg Score</p>
          <p id="ecStatAvg" class="text-lg font-bold text-zinc-900 mt-0.5">4.8 / 5</p>
        </div>
        <div class="bg-white px-4 py-3">
          <p class="text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">Responses</p>
          <p id="ecStatResponses" class="text-lg font-bold text-zinc-900 mt-0.5">126</p>
        </div>
        <div class="bg-white px-4 py-3">
          <p class="text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">Satisfaction</p>
          <p id="ecStatSatisfaction" class="text-lg font-bold text-emerald-600 mt-0.5">93.4%</p>
        </div>
        <div class="bg-white px-4 py-3">
          <p class="text-[10px] font-semibold text-zinc-400 uppercase tracking-wider">30-Day Trend</p>
          <p id="ecStatTrend" class="text-lg font-bold text-emerald-600 mt-0.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
            +0.3
          </p>
        </div>
      </div>

      <!-- Modal Body -->
      <div class="flex-1 overflow-y-auto px-6 py-5">

        <div class="flex items-center gap-2 mb-3">
          <span class="text-[10px] font-bold tracking-[.16em] uppercase text-[#C9A84C]">Response History</span>
          <hr class="flex-1 border-none h-px bg-gradient-to-r from-[#C9A84C]/40 to-transparent">
        </div>

        <div id="ecHistoryList" class="space-y-3">
          <!-- Individual response cards injected by JS -->
        </div>

        <div id="ecHistoryEmpty" class="hidden text-center py-10">
          <p class="text-sm text-zinc-400">No survey responses recorded for this employee yet.</p>
        </div>

        <!-- History pagination -->
        <div class="flex items-center justify-between mt-4 pt-4 border-t border-zinc-100">
          <p id="ecHistoryCount" class="text-xs text-zinc-400">Showing 5 of 126 responses</p>
          <div class="flex items-center gap-1">
            <button type="button" class="ec-history-prev px-3 py-1.5 text-xs text-zinc-500 border border-zinc-200 rounded-lg hover:bg-zinc-50 transition-colors cursor-pointer">Previous</button>
            <button type="button" class="ec-history-next px-3 py-1.5 text-xs text-white bg-zinc-900 rounded-lg hover:bg-zinc-800 transition-colors cursor-pointer">Next</button>
          </div>
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="px-6 py-4 border-t border-zinc-100 flex items-center justify-between bg-zinc-50/60">
        <p class="text-[11px] text-zinc-400 flex items-center gap-1.5">
          <svg class="w-3.5 h-3.5 stroke-emerald-500 fill-none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
          Confidential — visible to authorized administrators only
        </p>
        <div class="flex items-center gap-2">
          <button type="button" class="employee-csat-modal-close px-4 py-2 text-xs font-semibold text-zinc-600 border border-zinc-200 rounded-lg hover:bg-white transition-colors cursor-pointer">Close</button>
          
        </div>
      </div>

    </div>
  </div>
</div>
<script>
(function () {
  'use strict';

  const MOCK_EMPLOYEES = [
    { emp_id: 101, name: 'Sarah Johnson', department: 'Support', avg_score: 4.8, responses: 126, satisfaction: 93.4, trend: 0.3, status: 'active', avatar: 'https://placehold.co/40x40' },
    { emp_id: 102, name: 'Mark Evans',    department: 'Sales',   avg_score: 4.1, responses: 88,  satisfaction: 81.2, trend: -0.1, status: 'active', avatar: 'https://placehold.co/40x40' },
    { emp_id: 103, name: 'Chris Lee',     department: 'Tech',    avg_score: 3.6, responses: 54,  satisfaction: 68.9, trend: -0.4, status: 'watch',  avatar: 'https://placehold.co/40x40' },
  ];

  const MOCK_HISTORY = {
    101: [
      { date: '2026-01-18', client: 'Touchstar Client A', o1: 5, o2: 5, did_well: 'Fast response and resolved calibration issue same day.', improve: '' },
      { date: '2026-01-12', client: 'Touchstar Client B', o1: 5, o2: 4, did_well: 'Very professional on-site visit.', improve: 'Could send confirmation email sooner.' },
      { date: '2026-01-05', client: 'Touchstar Client C', o1: 4, o2: 5, did_well: 'Clear explanation of the service report.', improve: '' },
    ],
    102: [
      { date: '2026-01-15', client: 'Touchstar Client D', o1: 4, o2: 4, did_well: 'Good follow-through.', improve: 'Response time could be quicker.' },
    ],
    103: [
      { date: '2026-01-10', client: 'Touchstar Client E', o1: 3, o2: 3, did_well: '', improve: 'Ticket took longer than expected to close.' },
    ],
  };
  // Monthly average CSAT score, current year vs previous year (1-5 scale)
  const MOCK_MONTHLY_TREND = [
    { label: 'Jan', y2026: 4.6, y2025: 4.2 },
    { label: 'Feb', y2026: 4.5, y2025: 4.1 },
    { label: 'Mar', y2026: 4.7, y2025: 4.3 },
    { label: 'Apr', y2026: 4.4, y2025: 4.0 },
    { label: 'May', y2026: 4.6, y2025: 4.2 },
    { label: 'Jun', y2026: 4.8, y2025: 4.4 },
    { label: 'Jul', y2026: 4.5, y2025: 4.1 },
    { label: 'Aug', y2026: 4.3, y2025: 4.0 },
    { label: 'Sep', y2026: 4.6, y2025: 4.3 },
    { label: 'Oct', y2026: 4.7, y2025: 4.2 },
    { label: 'Nov', y2026: 4.5, y2025: 4.1 },
    { label: 'Dec', y2026: 4.6, y2025: 4.4 },
  ];

  const HISTORY_PAGE_SIZE = 5;
  let activeEmployeeId = null;
  let historyPage = 1;

  const modal = document.getElementById('employeeCsatModal');
  const tableBody = document.querySelector('.employee-table-body');
  const countLabel = document.querySelector('.employee-count-label');
  const barChartEl = document.querySelector('.csat-bar-chart');
  const barLabelsEl = document.querySelector('.csat-bar-labels');
  const topPerformersEl = document.querySelector('.top-performers-list');

  function starsHtml(score) {
    let html = '<span class="ec-stars-readonly">';
    for (let i = 1; i <= 5; i++) {
      html += '<span class="ec-star' + (i <= Math.round(score) ? ' filled' : '') + '">★</span>';
    }
    return html + '</span>';
  }

  function statusBadge(status) {
    const map = {
      active: 'bg-emerald-50 text-emerald-700 border-emerald-200',
      watch: 'bg-amber-50 text-amber-700 border-amber-200',
      inactive: 'bg-zinc-50 text-zinc-500 border-zinc-200',
    };
    const label = { active: 'Active', watch: 'Needs Attention', inactive: 'Inactive' }[status] || 'Active';
    const cls = map[status] || map.active;
    return '<span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-semibold border ' + cls + '">' + label + '</span>';
  }

  function renderEmployeeTable(employees) {
    if (!tableBody) return;
    tableBody.innerHTML = employees.map(function (e) {
      const trendUp = e.trend >= 0;
      const trendColor = trendUp ? 'text-emerald-600' : 'text-red-500';
      const trendIcon = trendUp
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>';
      return (
        '<tr class="border-b border-zinc-50 last:border-0 hover:bg-zinc-50/60 transition-colors">' +
          '<td class="px-5 py-3">' +
            '<div class="flex items-center gap-2.5">' +
              '<img src="' + e.avatar + '" class="w-8 h-8 rounded-full object-cover" alt="' + e.name + '">' +
              '<span class="font-medium text-zinc-800">' + e.name + '</span>' +
            '</div>' +
          '</td>' +
          '<td class="px-5 py-3 hidden sm:table-cell text-zinc-500">' + e.department + '</td>' +
          '<td class="px-5 py-3">' +
            '<div class="flex items-center gap-2">' + starsHtml(e.avg_score) + '<span class="text-zinc-700 font-semibold text-xs">' + e.avg_score.toFixed(1) + '</span></div>' +
          '</td>' +
          '<td class="px-5 py-3 hidden md:table-cell text-zinc-500">' + e.responses + '</td>' +
          '<td class="px-5 py-3 hidden lg:table-cell text-zinc-700 font-medium">' + e.satisfaction.toFixed(1) + '%</td>' +
          '<td class="px-5 py-3 hidden lg:table-cell">' +
            '<span class="inline-flex items-center gap-1 text-xs font-semibold ' + trendColor + '">' +
              '<svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">' + trendIcon + '</svg>' +
              (trendUp ? '+' : '') + e.trend.toFixed(1) +
            '</span>' +
          '</td>' +
          '<td class="px-5 py-3">' + statusBadge(e.status) + '</td>' +
          '<td class="px-5 py-3 text-right">' +
            '<button type="button" class="ec-view-btn text-xs font-semibold text-[#0B1F3A] hover:text-[#C9A84C] transition-colors cursor-pointer" data-emp-id="' + e.emp_id + '">View</button>' +
          '</td>' +
        '</tr>'
      );
    }).join('');

    if (countLabel) {
      countLabel.textContent = 'Showing ' + employees.length + ' of ' + employees.length + ' employees';
    }

    tableBody.querySelectorAll('.ec-view-btn').forEach(function (btn) {
      btn.addEventListener('click', function () {
        openEmployeeCsatModal(parseInt(btn.dataset.empId, 10));
      });
    });
  }

  function renderMonthlyBarChart(months) {
    if (!barChartEl || !barLabelsEl) return;
    const maxScore = 5;

    barChartEl.innerHTML = months.map(function (m) {
      const h26 = Math.max(4, Math.round((m.y2026 / maxScore) * 100));
      const h25 = Math.max(4, Math.round((m.y2025 / maxScore) * 100));
      return (
        '<div class="csat-bar-col">' +
          '<div class="csat-bar-pair" title="' + m.label + ' 2026: ' + m.y2026.toFixed(1) + ' \u00b7 2025: ' + m.y2025.toFixed(1) + '">' +
            '<div class="csat-bar csat-bar-2026" style="height:' + h26 + '%"></div>' +
            '<div class="csat-bar csat-bar-2025" style="height:' + h25 + '%"></div>' +
          '</div>' +
        '</div>'
      );
    }).join('');

    barLabelsEl.innerHTML = months.map(function (m) {
      return '<span>' + m.label + '</span>';
    }).join('');
  }

  function renderTopPerformers(employees) {
    if (!topPerformersEl) return;
    const ranked = employees.slice().sort(function (a, b) { return b.avg_score - a.avg_score; }).slice(0, 5);
    const rankColors = ['bg-amber-100 text-amber-700', 'bg-zinc-100 text-zinc-600', 'bg-orange-100 text-orange-700'];

    topPerformersEl.innerHTML = ranked.map(function (e, i) {
      const rankCls = rankColors[i] || 'bg-zinc-50 text-zinc-400';
      return (
        '<div class="top-performer-row">' +
          '<div class="flex items-center gap-3">' +
            '<span class="top-performer-rank ' + rankCls + '">' + (i + 1) + '</span>' +
            '<img src="' + e.avatar + '" class="w-8 h-8 rounded-full object-cover" alt="' + e.name + '">' +
            '<div>' +
              '<p class="text-xs font-semibold text-zinc-800">' + e.name + '</p>' +
              '<p class="text-[11px] text-zinc-400">' + e.department + '</p>' +
            '</div>' +
          '</div>' +
          '<div class="flex items-center gap-2">' + starsHtml(e.avg_score) + '<span class="text-xs font-bold text-zinc-900">' + e.avg_score.toFixed(1) + '</span></div>' +
        '</div>'
      );
    }).join('');
  }

  function renderHistoryPage() {
    const all = MOCK_HISTORY[activeEmployeeId] || [];
    const start = (historyPage - 1) * HISTORY_PAGE_SIZE;
    const pageItems = all.slice(start, start + HISTORY_PAGE_SIZE);

    const listEl = document.getElementById('ecHistoryList');
    const emptyEl = document.getElementById('ecHistoryEmpty');
    const countEl = document.getElementById('ecHistoryCount');

    if (!all.length) {
      listEl.innerHTML = '';
      emptyEl.classList.remove('hidden');
    } else {
      emptyEl.classList.add('hidden');
      listEl.innerHTML = pageItems.map(function (r) {
        return (
          '<div class="rounded-xl border border-zinc-100 bg-zinc-50/50 px-4 py-3.5">' +
            '<div class="flex items-center justify-between flex-wrap gap-2 mb-2">' +
              '<span class="text-xs font-semibold text-zinc-700">' + r.client + '</span>' +
              '<span class="text-[11px] text-zinc-400">' + r.date + '</span>' +
            '</div>' +
            '<div class="grid grid-cols-1 sm:grid-cols-2 gap-2 mb-2">' +
              '<div class="flex items-center justify-between bg-white border border-zinc-100 rounded-lg px-3 py-2">' +
                '<span class="text-[11px] text-zinc-500">Overall satisfaction</span>' + starsHtml(r.o1) +
              '</div>' +
              '<div class="flex items-center justify-between bg-white border border-zinc-100 rounded-lg px-3 py-2">' +
                '<span class="text-[11px] text-zinc-500">Likelihood to recommend</span>' + starsHtml(r.o2) +
              '</div>' +
            '</div>' +
            (r.did_well ? '<p class="text-xs text-zinc-600"><span class="font-semibold text-zinc-500">What did we do well: </span>' + r.did_well + '</p>' : '') +
            (r.improve ? '<p class="text-xs text-zinc-600 mt-1"><span class="font-semibold text-zinc-500">What Can we Improve: </span>' + r.improve + '</p>' : '')  +
          '</div>'
        );
      }).join('');
    }

    countEl.textContent = 'Showing ' + pageItems.length + ' of ' + all.length + ' responses';
    document.querySelector('.ec-history-prev').disabled = historyPage <= 1;
    document.querySelector('.ec-history-next').disabled = start + HISTORY_PAGE_SIZE >= all.length;
  }

  function openEmployeeCsatModal(empId) {
    const employee = MOCK_EMPLOYEES.find(function (e) { return e.emp_id === empId; });
    if (!employee) return;

    activeEmployeeId = empId;
    historyPage = 1;

    document.getElementById('ecModalAvatar').src = employee.avatar;
    document.getElementById('ecModalName').textContent = employee.name;
    document.getElementById('ecModalDept').textContent = employee.department + ' \u00b7 EMP-' + employee.emp_id;
    document.getElementById('ecStatAvg').textContent = employee.avg_score.toFixed(1) + ' / 5';
    document.getElementById('ecStatResponses').textContent = employee.responses;
    document.getElementById('ecStatSatisfaction').textContent = employee.satisfaction.toFixed(1) + '%';
    document.getElementById('ecStatTrend').innerHTML =
      '<svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">' +
      (employee.trend >= 0
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>') +
      '</svg>' + (employee.trend >= 0 ? '+' : '') + employee.trend.toFixed(1);
    document.getElementById('ecStatTrend').className = 'text-lg font-bold mt-0.5 flex items-center gap-1 ' + (employee.trend >= 0 ? 'text-emerald-600' : 'text-red-500');

    renderHistoryPage();

    modal.classList.remove('hidden');
    modal.classList.add('is-open');
    document.body.style.overflow = 'hidden';
  }

  function closeEmployeeCsatModal() {
    modal.classList.add('hidden');
    modal.classList.remove('is-open');
    document.body.style.overflow = '';
    activeEmployeeId = null;
  }

  document.querySelectorAll('.employee-csat-modal-close, .employee-csat-modal-backdrop').forEach(function (el) {
    el.addEventListener('click', closeEmployeeCsatModal);
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
      closeEmployeeCsatModal();
    }
  });

  document.querySelector('.ec-history-prev').addEventListener('click', function () {
    if (historyPage > 1) { historyPage--; renderHistoryPage(); }
  });
  document.querySelector('.ec-history-next').addEventListener('click', function () {
    const all = MOCK_HISTORY[activeEmployeeId] || [];
    if (historyPage * HISTORY_PAGE_SIZE < all.length) { historyPage++; renderHistoryPage(); }
  });

  // document.getElementById('ecExportBtn').addEventListener('click', function () {
  //   // Wire this to a real export route, e.g.:
  //   // window.location.href = '/admin/csat/employees/' + activeEmployeeId + '/export';
  //   alert('Export report for employee #' + activeEmployeeId + ' (wire this button to your export route).');
  // });

  // Expose for external row-render scripts if you already have your own AJAX loader
  window.openEmployeeCsatModal = openEmployeeCsatModal;
  window.renderEmployeeTable = renderEmployeeTable;
  window.renderMonthlyBarChart = renderMonthlyBarChart;
  window.renderTopPerformers = renderTopPerformers;

  // Initial render (replace these three with real fetch() calls to your Laravel endpoints)
  renderEmployeeTable(MOCK_EMPLOYEES);
  renderMonthlyBarChart(MOCK_MONTHLY_TREND);
  renderTopPerformers(MOCK_EMPLOYEES);
})();
</script>
@endsection