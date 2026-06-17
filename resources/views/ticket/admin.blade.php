<div>
  @extends('layouts.app') @section('title', 'Touchstar Medical Enterprises Inc. Service Tickets') @section('content')
  <div class="max-w-full bg-slate-50 font-sans">
    <!-- Header -->
    <div class="bg-white border-b border-slate-200 px-6 py-4">
      <div class="max-w-full mx-auto flex flex-col md:flex-row md:items-center md:justify-between gap-3">
        <div>
          <h1 class="text-xl font-bold text-slate-800 tracking-tight">Service Tickets</h1>
          <p class="text-xs text-slate-500 mt-0.5">Touchstar Medical Enterprises Inc.</p>
        </div>
        <div class="flex flex-wrap items-center gap-2">
          <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white border border-blue-200 text-blue-700 text-xs font-medium hover:bg-blue-50 transition duration-150">
            <img src="https://placehold.co/14x14" alt="export" class="opacity-60 rounded-sm"/>
            Export
          </button>
          <button class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-700 text-white text-xs font-medium hover:bg-blue-800 transition duration-150">
            <img src="https://placehold.co/14x14" alt="add" class="opacity-80 rounded-sm"/>
            New Ticket
          </button>
        </div>
      </div>
    </div>
    <div class="max-w-full mx-auto px-4 md:px-6 py-6">
      <!-- Stats Row -->
      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 mb-6">
        <div class="bg-white border border-blue-100 rounded-xl p-4 shadow-sm">
          <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Total Tickets</p>
          <p class="text-2xl font-bold text-slate-800">248</p>
          <span class="text-xs text-blue-600 font-medium">All time</span>
        </div>
        <div class="bg-white border border-blue-100 rounded-xl p-4 shadow-sm">
          <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Open</p>
          <p class="text-2xl font-bold text-yellow-500">34</p>
          <span class="text-xs text-yellow-600 font-medium">Pending action</span>
        </div>
        <div class="bg-white border border-blue-100 rounded-xl p-4 shadow-sm">
          <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">In Progress</p>
          <p class="text-2xl font-bold text-blue-600">19</p>
          <span class="text-xs text-blue-500 font-medium">Being handled</span>
        </div>
        <div class="bg-white border border-blue-100 rounded-xl p-4 shadow-sm">
          <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Resolved</p>
          <p class="text-2xl font-bold text-green-600">187</p>
          <span class="text-xs text-green-600 font-medium">Completed</span>
        </div>
        <div class="bg-white border border-blue-100 rounded-xl p-4 shadow-sm">
          <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide mb-1">Overdue</p>
          <p class="text-2xl font-bold text-red-500">8</p>
          <span class="text-xs text-red-500 font-medium">Needs attention</span>
        </div>
      </div>
      <!-- Filters & Search -->
      <div class="bg-white border border-slate-200 rounded-xl px-4 py-3 mb-4 flex flex-col md:flex-row gap-3 items-start md:items-center justify-between shadow-sm">
        <div class="flex flex-wrap gap-2 items-center">
          <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide mr-1">Status:</span>
          <button class="ticket-filter-btn px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-700 text-white transition duration-150" data-filter="all">All</button>
          <button class="ticket-filter-btn px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition duration-150" data-filter="open">Open</button>
          <button class="ticket-filter-btn px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition duration-150" data-filter="in-progress">In Progress</button>
          <button class="ticket-filter-btn px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition duration-150" data-filter="resolved">Resolved</button>
          <button class="ticket-filter-btn px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-600 hover:bg-blue-50 hover:text-blue-700 transition duration-150" data-filter="overdue">Overdue</button>
        </div>
        <div class="flex gap-2 w-full md:w-auto">
          <input type="text" placeholder="Search tickets..." class="ticket-search block w-full md:w-56 px-3 py-2 text-xs placeholder-slate-400 bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 transition"/>
          <select class="block px-3 py-2 text-xs bg-slate-50 border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-200 text-slate-600">
            <option>Sort: Newest</option>
            <option>Sort: Oldest</option>
            <option>Sort: Priority</option>
          </select>
        </div>
      </div>
      <!-- Tickets Table -->
      <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead>
              <tr class="border-b border-slate-100 bg-slate-50"><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Ticket ID</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Subject</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Client</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Assigned To</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Priority</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Status</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Date</th><th class="text-left text-xs font-semibold text-slate-500 uppercase tracking-wide px-5 py-3">Actions</th></tr>
            </thead>
            <tbody class="ticket-table-body divide-y divide-slate-50">
              <!-- Row 1 -->
              <tr class="ticket-row hover:bg-blue-50/40 transition duration-100" data-status="open">
                <td class="px-5 py-3.5">
                  <span class="font-mono text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">#TKT-0041</span>
                </td>
                <td class="px-5 py-3.5">
                  <p class="font-medium text-slate-800 text-xs">ECG Machine Calibration</p>
                  <p class="text-xs text-slate-400 mt-0.5">Unit malfunctioning after update</p>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="client" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-700 font-medium">St. Luke's Hospital</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="technician" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-600">J. Reyes</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-600">High</span>
                </td>
                <td class="px-5 py-3.5">
                  <span class="ticket-status-badge text-xs font-semibold px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700">Open</span>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">Jun 12, 2025</td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-lg hover:bg-blue-100 text-blue-600 transition" title="View">
                      <img src="https://placehold.co/14x14" alt="view" class="opacity-70 rounded-sm"/>
                    </button>
                    <button class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition" title="Edit">
                      <img src="https://placehold.co/14x14" alt="edit" class="opacity-70 rounded-sm"/>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Row 2 -->
              <tr class="ticket-row hover:bg-blue-50/40 transition duration-100" data-status="in-progress">
                <td class="px-5 py-3.5">
                  <span class="font-mono text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">#TKT-0040</span>
                </td>
                <td class="px-5 py-3.5">
                  <p class="font-medium text-slate-800 text-xs">Ventilator Pressure Check</p>
                  <p class="text-xs text-slate-400 mt-0.5">Scheduled preventive maintenance</p>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="client" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-700 font-medium">Philippine General Hospital</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="technician" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-600">M. Santos</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-100 text-orange-600">Medium</span>
                </td>
                <td class="px-5 py-3.5">
                  <span class="ticket-status-badge text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">In Progress</span>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">Jun 11, 2025</td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-lg hover:bg-blue-100 text-blue-600 transition" title="View">
                      <img src="https://placehold.co/14x14" alt="view" class="opacity-70 rounded-sm"/>
                    </button>
                    <button class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition" title="Edit">
                      <img src="https://placehold.co/14x14" alt="edit" class="opacity-70 rounded-sm"/>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Row 3 -->
              <tr class="ticket-row hover:bg-blue-50/40 transition duration-100" data-status="resolved">
                <td class="px-5 py-3.5">
                  <span class="font-mono text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">#TKT-0039</span>
                </td>
                <td class="px-5 py-3.5">
                  <p class="font-medium text-slate-800 text-xs">Infusion Pump Replacement</p>
                  <p class="text-xs text-slate-400 mt-0.5">Faulty unit replaced with new</p>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="client" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-700 font-medium">Makati Medical Center</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="technician" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-600">A. Cruz</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">Low</span>
                </td>
                <td class="px-5 py-3.5">
                  <span class="ticket-status-badge text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Resolved</span>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">Jun 10, 2025</td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-lg hover:bg-blue-100 text-blue-600 transition" title="View">
                      <img src="https://placehold.co/14x14" alt="view" class="opacity-70 rounded-sm"/>
                    </button>
                    <button class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition" title="Edit">
                      <img src="https://placehold.co/14x14" alt="edit" class="opacity-70 rounded-sm"/>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Row 4 -->
              <tr class="ticket-row hover:bg-blue-50/40 transition duration-100" data-status="overdue">
                <td class="px-5 py-3.5">
                  <span class="font-mono text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">#TKT-0038</span>
                </td>
                <td class="px-5 py-3.5">
                  <p class="font-medium text-slate-800 text-xs">Defibrillator Battery Test</p>
                  <p class="text-xs text-slate-400 mt-0.5">Annual compliance check overdue</p>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="client" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-700 font-medium">Capitol Medical Center</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="technician" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-600">B. Lim</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-red-100 text-red-600">High</span>
                </td>
                <td class="px-5 py-3.5">
                  <span class="ticket-status-badge text-xs font-semibold px-2.5 py-1 rounded-full bg-red-100 text-red-600">Overdue</span>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">Jun 01, 2025</td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-lg hover:bg-blue-100 text-blue-600 transition" title="View">
                      <img src="https://placehold.co/14x14" alt="view" class="opacity-70 rounded-sm"/>
                    </button>
                    <button class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition" title="Edit">
                      <img src="https://placehold.co/14x14" alt="edit" class="opacity-70 rounded-sm"/>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Row 5 -->
              <tr class="ticket-row hover:bg-blue-50/40 transition duration-100" data-status="open">
                <td class="px-5 py-3.5">
                  <span class="font-mono text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">#TKT-0037</span>
                </td>
                <td class="px-5 py-3.5">
                  <p class="font-medium text-slate-800 text-xs">Ultrasound Probe Cleaning</p>
                  <p class="text-xs text-slate-400 mt-0.5">Probe showing artifacts on screen</p>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="client" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-700 font-medium">The Medical City</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="technician" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-600">J. Reyes</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-100 text-orange-600">Medium</span>
                </td>
                <td class="px-5 py-3.5">
                  <span class="ticket-status-badge text-xs font-semibold px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700">Open</span>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">Jun 12, 2025</td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-lg hover:bg-blue-100 text-blue-600 transition" title="View">
                      <img src="https://placehold.co/14x14" alt="view" class="opacity-70 rounded-sm"/>
                    </button>
                    <button class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition" title="Edit">
                      <img src="https://placehold.co/14x14" alt="edit" class="opacity-70 rounded-sm"/>
                    </button>
                  </div>
                </td>
              </tr>
              <!-- Row 6 -->
              <tr class="ticket-row hover:bg-blue-50/40 transition duration-100" data-status="resolved">
                <td class="px-5 py-3.5">
                  <span class="font-mono text-xs font-semibold text-blue-700 bg-blue-50 px-2 py-0.5 rounded">#TKT-0036</span>
                </td>
                <td class="px-5 py-3.5">
                  <p class="font-medium text-slate-800 text-xs">Oxygen Concentrator Service</p>
                  <p class="text-xs text-slate-400 mt-0.5">Filter replacement completed</p>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="client" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-700 font-medium">Asian Hospital</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-2">
                    <img src="https://placehold.co/28x28" alt="technician" class="w-7 h-7 rounded-full object-cover"/>
                    <span class="text-xs text-slate-600">M. Santos</span>
                  </div>
                </td>
                <td class="px-5 py-3.5">
                  <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-slate-100 text-slate-500">Low</span>
                </td>
                <td class="px-5 py-3.5">
                  <span class="ticket-status-badge text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700">Resolved</span>
                </td>
                <td class="px-5 py-3.5 text-xs text-slate-500">Jun 09, 2025</td>
                <td class="px-5 py-3.5">
                  <div class="flex items-center gap-1">
                    <button class="p-1.5 rounded-lg hover:bg-blue-100 text-blue-600 transition" title="View">
                      <img src="https://placehold.co/14x14" alt="view" class="opacity-70 rounded-sm"/>
                    </button>
                    <button class="p-1.5 rounded-lg hover:bg-slate-100 text-slate-500 transition" title="Edit">
                      <img src="https://placehold.co/14x14" alt="edit" class="opacity-70 rounded-sm"/>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <!-- Empty State (hidden by default) -->
        <div class="ticket-empty-state hidden flex flex-col items-center justify-center py-14 text-center">
          <img src="https://placehold.co/64x64" alt="no results" class="mb-3 opacity-30 rounded"/>
          <p class="text-sm font-semibold text-slate-400">No tickets found</p>
          <p class="text-xs text-slate-300 mt-1">Try adjusting your search or filter.</p>
        </div>
        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row items-center justify-between px-5 py-3 border-t border-slate-100 gap-2">
          <p class="text-xs text-slate-400">
            Showing
            <span class="font-semibold text-slate-600">1–6</span>
            of
            <span class="font-semibold text-slate-600">248</span>
            tickets
          </p>
          <div class="flex items-center gap-1">
            <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-500 hover:bg-blue-50 hover:text-blue-700 transition">Previous</button>
            <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-700 text-white">1</button>
            <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-500 hover:bg-blue-50 hover:text-blue-700 transition">2</button>
            <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-500 hover:bg-blue-50 hover:text-blue-700 transition">3</button>
            <span class="text-xs text-slate-400 px-1">...</span>
            <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-500 hover:bg-blue-50 hover:text-blue-700 transition">42</button>
            <button class="px-3 py-1.5 rounded-lg text-xs font-medium bg-slate-100 text-slate-500 hover:bg-blue-50 hover:text-blue-700 transition">Next</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection
</div>