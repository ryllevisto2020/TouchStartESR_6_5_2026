@extends('layouts.client')
@section('title', 'Service Report History')
@section('content')

<script>
console.log({{ Js::from($client_service_record->items()) }})

const machines = {{ Js::from($machines) }}
const RECORDS = {{ Js::from($client_service_record->items()) }}

function typeIcon(t){ return {Troubleshooting:"fa-wrench",Installation:"fa-screwdriver-wrench",Warranty:"fa-file-contract",Calibration:"fa-ruler-combined","Preventive Maintenance":"fa-shield-check"}[t]||"fa-tools"; }
function typeBadge(t){ return {Troubleshooting:"bg-orange-100 text-orange-800",Installation:"bg-purple-100 text-purple-800",Warranty:"bg-teal-100 text-teal-800",Calibration:"bg-indigo-100 text-indigo-800","Preventive Maintenance":"bg-blue-100 text-blue-800"}[t]||"bg-gray-100 text-gray-700"; }
function mIcon(n){ if(/ventilator|evita|hamilton/i.test(n)) return "fa-lungs"; if(/mri|ct|logiq|acuson|dc-70|ultrasound/i.test(n)) return "fa-radiation"; if(/sysmex|hema/i.test(n)) return "fa-microscope"; return "fa-heartbeat"; }
function mColor(n){ if(/ventilator|evita|hamilton/i.test(n)) return "bg-violet-50 text-violet-400 border-violet-100"; if(/mri|ct|logiq|acuson|dc-70/i.test(n)) return "bg-amber-50 text-amber-500 border-amber-100"; if(/sysmex|hema/i.test(n)) return "bg-emerald-50 text-emerald-500 border-emerald-100"; return "bg-blue-50 text-blue-400 border-blue-100"; }
</script>

<div class="no-print">

  <main class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8 flex items-start justify-between flex-wrap gap-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Service Reports</h1>
        <p class="text-gray-500 text-sm mt-1">{{ $client_detail->client_name }} — Complete service history &amp; maintenance records</p>
      </div>
      <button onclick="batchPrint()" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-colors text-sm gap-2 shadow-sm">
        <i class="fas fa-print"></i> Batch Print
      </button>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
      <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-blue-500 flex items-center gap-4">
        <div class="p-2.5 rounded-xl bg-blue-50 text-blue-600 text-lg"><i class="fas fa-clipboard-list"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">Total Services</p><p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p></div>
      </div>
      <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-green-500 flex items-center gap-4">
        <div class="p-2.5 rounded-xl bg-green-50 text-green-600 text-lg"><i class="fas fa-calendar-check"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">This Month</p><p class="text-2xl font-bold text-gray-900">{{ $stats['this_month'] }}</p></div>
      </div>
      <div class="bg-white rounded-xl shadow-sm p-5 border-l-4 border-purple-500 flex items-center gap-4">
        <div class="p-2.5 rounded-xl bg-purple-50 text-purple-600 text-lg"><i class="fas fa-user-cog"></i></div>
        <div><p class="text-xs text-gray-500 font-medium">Engineers</p><p class="text-2xl font-bold text-gray-900">{{ $stats['engineers'] }}</p></div>
      </div>

    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('client.service.history') }}">
    <div class="bg-white rounded-xl shadow-sm mb-8">
      <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
        <i class="fas fa-sliders text-gray-400 text-sm"></i>
        <h3 class="text-sm font-semibold text-gray-900">Filter Service Reports</h3>
      </div>
      <div class="p-5">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
          <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Machine / Serial Number</label>
            <select name="machine_id">
              <option value="">All Serial Numbers</option>
              @foreach ($machines as $m)
                <option value="{{ $m->id }}" @selected(request('machine_id') == $m->id)>{{ $m->serial_number }} — {{ $m->name }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Service Type</label>
            <select name="service_type">
              <option value="all">All Types</option>
              @foreach ($serviceTypes as $type)
                <option value="{{ $type }}" @selected(request('service_type') == $type)>{{ $type }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Service Engineer</label>
            <select name="service_engineer">
              <option value="all">All Engineers</option>
              @foreach ($engineers as $eng)
                <option value="{{ $eng }}" @selected(request('service_engineer') == $eng)>{{ $eng }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Equipment Status</label>
            <select name="equipment_status">
              <option value="all">All Status</option>
              <option value="Operational" @selected(request('equipment_status') == 'Operational')>Operational</option>
              <option value="Not Operational" @selected(request('equipment_status') == 'Not Operational')>Not Operational</option>
            </select>
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">From Date</label>
            <input type="date" name="date_from" value="{{ request('date_from') }}">
          </div>
          <div>
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">To Date</label>
            <input type="date" name="date_to" value="{{ request('date_to') }}">
          </div>
          <div class="lg:col-span-2">
            <label class="block text-xs font-semibold text-gray-500 mb-1.5">Search Problem Description</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search in root cause, actions taken, recommendations…">
          </div>
        </div>
        <div class="flex justify-between items-center mt-5 pt-4 border-t border-gray-100">
          <span class="text-xs text-gray-400">
            Showing {{ $client_service_record->firstItem() ?? 0 }}–{{ $client_service_record->lastItem() ?? 0 }} of {{ $client_service_record->total() }} results
          </span>
          <div class="flex gap-2">
            <a href="{{ route('client.service.history') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-xs gap-1.5 font-medium transition-colors">
              <i class="fas fa-rotate-left"></i> Reset
            </a>
            <button type="submit" class="inline-flex items-center px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-xs gap-1.5 font-medium transition-colors">
              <i class="fas fa-filter"></i> Apply Filters
            </button>
          </div>
        </div>
      </div>
    </div>
    </form>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-sm font-semibold text-gray-900">Service Records</h3>
        <span class="text-xs text-gray-400 bg-gray-100 px-2 py-0.5 rounded-full">{{ $client_service_record->count() }} of {{ $client_service_record->total() }}</span>
      </div>
      <div class="overflow-x-auto">
        <table class="min-w-full">
          <thead class="bg-gray-50 border-b border-gray-100">
            <tr>
              <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
              <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Machine</th>
              <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Service Type</th>
              <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Engineer</th>
              <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
          </thead>
          <tbody id="tbl" class="divide-y divide-gray-50"></tbody>
        </table>
      </div>
      <div class="px-6 py-3 border-t border-gray-100 flex items-center justify-between">
        <span class="text-xs text-gray-400">
          Showing {{ $client_service_record->firstItem() ?? 0 }}–{{ $client_service_record->lastItem() ?? 0 }} of {{ $client_service_record->total() }} results
        </span>
        <div class="flex gap-1">
          <a href="{{ $client_service_record->onFirstPage() ? '#' : $client_service_record->previousPageUrl() }}"
             class="pag-btn {{ $client_service_record->onFirstPage() ? 'opacity-40 pointer-events-none' : '' }}">&laquo;</a>

          @for ($i = 1; $i <= $client_service_record->lastPage(); $i++)
            <a href="{{ $client_service_record->url($i) }}"
               class="pag-btn {{ $client_service_record->currentPage() == $i ? 'active' : '' }}">{{ $i }}</a>
          @endfor

          <a href="{{ $client_service_record->hasMorePages() ? $client_service_record->nextPageUrl() : '#' }}"
             class="pag-btn {{ $client_service_record->hasMorePages() ? '' : 'opacity-40 pointer-events-none' }}">&raquo;</a>
        </div>
      </div>
    </div>
  </main>
</div>

<!-- MODAL -->
<div id="modal" class="hidden fixed inset-0 bg-black/50 z-50 overflow-y-auto">
  <div class="relative mx-auto my-8 w-11/12 max-w-3xl bg-white rounded-2xl shadow-2xl overflow-hidden">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5 flex items-center justify-between">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center">
          <i id="m-icon" class="fas fa-tools text-white text-sm"></i>
        </div>
        <div>
          <p class="text-white font-bold text-sm" id="m-machine">—</p>
          <p class="text-blue-200 text-xs mono" id="m-serial">—</p>
        </div>
      </div>
      <div class="flex items-center gap-2">
        <button onclick="printSingle()" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-white/20 hover:bg-white/30 text-white rounded-lg text-xs font-medium transition-colors">
          <i class="fas fa-print"></i> Print
        </button>
        <button onclick="closeModal()" class="w-8 h-8 flex items-center justify-center rounded-xl bg-white/20 hover:bg-white/30 text-white">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>

    <div class="p-6 max-h-[80vh] overflow-y-auto space-y-5">
      <!-- Summary grid -->
      <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
          <p class="text-xs text-gray-400 font-medium mb-0.5">Service Date</p>
          <p class="text-sm font-semibold text-gray-800" id="m-date">—</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
          <p class="text-xs text-gray-400 font-medium mb-0.5">Service Type</p>
          <p style="word-wrap: break-word;" class="text-sm font-semibold text-gray-800" id="m-type">—</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
          <p class="text-xs text-gray-400 font-medium mb-0.5">Engineer</p>
          <p class="text-sm font-semibold text-gray-800" id="m-engineer">—</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100">
          <p class="text-xs text-gray-400 font-medium mb-0.5">Model</p>
          <p class="text-sm font-semibold text-gray-800 mono" id="m-model">—</p>
        </div>
        <div class="bg-gray-50 rounded-xl p-3 border border-gray-100 col-span-2">
          <p class="text-xs text-gray-400 font-medium mb-1">Equipment Status</p>
          <span id="m-status" class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold"></span>
        </div>
      </div>

      <!-- ID Verification -->
      <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2">Identification / Verification</p>
        <p class="text-sm text-gray-700 leading-relaxed" id="m-idver">—</p>
      </div>

      <!-- Details -->
      <div class="space-y-3">
        <div class="border border-red-100 bg-red-50/40 rounded-xl p-4">
          <p class="text-xs font-bold text-red-600 uppercase tracking-wide mb-2"><i class="fas fa-magnifying-glass mr-1"></i>Root Cause / Findings</p>
          <p class="text-sm text-gray-700 leading-relaxed" id="m-root">—</p>
        </div>
        <div class="border border-green-100 bg-green-50/40 rounded-xl p-4">
          <p class="text-xs font-bold text-green-700 uppercase tracking-wide mb-2"><i class="fas fa-check-circle mr-1"></i>Actions Taken</p>
          <p class="text-sm text-gray-700 leading-relaxed" id="m-actions">—</p>
        </div>
        <div class="border border-blue-100 bg-blue-50/40 rounded-xl p-4">
          <p class="text-xs font-bold text-blue-700 uppercase tracking-wide mb-2"><i class="fas fa-lightbulb mr-1"></i>Recommendations</p>
          <p class="text-sm text-gray-700 leading-relaxed" id="m-reco">—</p>
        </div>
      </div>

      <!-- Parts Replaced -->
      <div id="parts-block">
        <p class="text-xs font-bold text-gray-500 uppercase tracking-wide mb-2"><i class="fas fa-gears mr-1"></i>Parts Replaced</p>
        <div class="rounded-xl border border-gray-200 overflow-hidden">
          <table class="min-w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
              <tr>
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase w-16">Qty</th>
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">Part / Item</th>
                <th class="px-4 py-2.5 text-left text-xs font-semibold text-gray-500 uppercase">SI/DR No.</th>
              </tr>
            </thead>
            <tbody id="parts-rows" class="divide-y divide-gray-100"></tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="px-6 py-4 border-t border-gray-100 flex justify-end gap-2">
      <button onclick="printSingle()" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition-colors">
        <i class="fas fa-print"></i> Print Report
      </button>
      <button onclick="closeModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors">
        <i class="fas fa-times"></i> Close
      </button>
    </div>
  </div>
</div>

<!-- Lightbox -->
<div id="lightbox" class="hidden fixed inset-0 bg-black/85 z-[60] flex items-center justify-center" onclick="closeLB()">
  <button class="absolute top-5 right-5 text-white text-xl w-10 h-10 rounded-xl bg-white/20 hover:bg-white/30 flex items-center justify-center" onclick="closeLB()"><i class="fas fa-times"></i></button>
  <img id="lb-img" src="" alt="" class="max-w-[90vw] max-h-[90vh] object-contain rounded-xl shadow-2xl">
</div>

<script>
let currentId = null;

function render() {
  document.getElementById('tbl').innerHTML = RECORDS.map(r => {
    const machine_name = machines.find(x => x.id == r.machine_id).name;
    const machine_serial = machines.find(x => x.id == r.machine_id).serial_number;
    const mc = mColor(machine_name);
    const tc = typeBadge(r.service_type);
    const sc = r.equipment_status === 'Operational' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
    const si = r.equipment_status === 'Operational' ? 'fa-circle-check' : 'fa-circle-xmark';
    return `<tr onclick="openModal(${r.id})">
      <td class="px-5 py-3.5 whitespace-nowrap">
        <div class="text-sm font-semibold text-gray-900">${r.service_date}</div>
      </td>
      <td class="px-5 py-3.5">
        <div class="flex items-center gap-3">
          <div class="w-10 h-10 rounded-xl border flex items-center justify-center text-sm flex-shrink-0 ${mc}"><i class="fas ${mIcon(machine_name)}"></i></div>
          <div>
            <div class="text-sm font-semibold text-gray-900">${machine_name}</div>
            <div class="text-xs text-gray-400 mono">SN: ${machine_serial}</div>
          </div>
        </div>
      </td>
      <td class="px-5 py-3.5">
        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold ${tc}"><i class="fas ${typeIcon(r.service_type)} text-[9px]"></i>${r.service_type}</span>
      </td>
      <td class="px-5 py-3.5 text-sm text-gray-800">${r.service_engineer}</td>
      <td class="px-5 py-3.5"><span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold ${sc}"><i class="fas ${si} text-[9px]"></i>${r.equipment_status}</span></td>
      <td class="px-5 py-3.5" onclick="event.stopPropagation()">
        <div class="flex gap-1.5">
          <button onclick="openModal(${r.id})" class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 flex items-center justify-center transition-colors" title="View"><i class="fas fa-eye text-sm"></i></button>
          <button onclick="printOne(${r.id})" class="w-8 h-8 rounded-lg bg-green-50 hover:bg-green-100 text-green-600 flex items-center justify-center transition-colors" title="Print"><i class="fas fa-print text-sm"></i></button>
        </div>
      </td>
    </tr>`;
  }).join('');
}

function openModal(id) {
  const r = RECORDS.find(x => x.id === id);
  const machine_name = machines.find(x => x.id == r.machine_id).name;
  const machine_serial = machines.find(x => x.id == r.machine_id).serial_number;
  const machine_model = machines.find(x => x.id == r.machine_id).model;
  if (!r) return;
  currentId = id;

  document.getElementById('m-machine').textContent = machine_name;
  document.getElementById('m-serial').textContent = machine_serial;
  document.getElementById('m-date').textContent = r.service_date;
  document.getElementById('m-type').textContent = r.service_type;
  document.getElementById('m-model').textContent = machine_model;
  document.getElementById('m-engineer').textContent = r.service_engineer;
  document.getElementById('m-idver').textContent = r.identification_verification;
  document.getElementById('m-root').textContent = r.root_cause_findings;
  document.getElementById('m-actions').textContent = r.action_taken;
  document.getElementById('m-reco').textContent = r.recommendations;
  document.getElementById('m-icon').className = `fas ${typeIcon(r.service_type)} text-white text-sm`;

  const sb = document.getElementById('m-status');
  const op = r.equipment_status === 'Operational';
  sb.className = `inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold ${op ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}`;
  sb.innerHTML = `<i class="fas ${op ? 'fa-circle-check' : 'fa-circle-xmark'} text-[9px]"></i>${r.equipment_status}`;

  // Parts
  const pb = document.getElementById('parts-block');
  const parts = JSON.parse(r.parts_replaced || '[]');
  if (parts.length) {
    pb.classList.remove('hidden');
    document.getElementById('parts-rows').innerHTML = parts.map(p =>
      `<tr><td class="px-4 py-2.5 font-bold text-gray-900">${p.qty || ""}</td><td class="px-4 py-2.5 text-gray-800">${p.particulars || ""}</td><td class="px-4 py-2.5 mono text-gray-600 text-xs">${p.si_dr_no || ""}</td></tr>`
    ).join('');
  } else { pb.classList.add('hidden'); }

  document.getElementById('modal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeModal() {
  document.getElementById('modal').classList.add('hidden');
  document.body.style.overflow = '';
}

function openLB(src) { document.getElementById('lb-img').src = src; document.getElementById('lightbox').classList.remove('hidden'); }
function closeLB() { document.getElementById('lightbox').classList.add('hidden'); }

function printOne(id) {let url = "{{ route('clients.print', ':id') }}";url = url.replace(':id', "id="+id);window.open(url, '_blank', 'width=1100,height=800,scrollbars=yes');}
function printSingle() { if (currentId) printOne(currentId); }
function batchPrint() {window.open('{{route('clients.batch')}}', '_blank', 'width=1200,height=900,scrollbars=yes');}
document.getElementById('modal').addEventListener('click', e => { if (e.target === document.getElementById('modal')) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') { closeModal(); closeLB(); } });

render();
</script>
@endsection