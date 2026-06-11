@extends('layouts.client')
@section('title', 'Touchstar Medical Enterprises Inc. Client Ticket')
@section('content')
<style>

  /* Stat cards row */
  .stat-row { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 28px; }
  .stat-card { background: #fff; border: 1px solid #dbeafe; border-radius: 10px; padding: 14px 16px; }
  .stat-card .slabel { font-size: 10.5px; color: #64748b; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 6px; display: flex; align-items: center; gap: 5px; }
  .stat-card .sval { font-size: 22px; font-weight: 700; color: #1e3a5f; line-height: 1; }
  .stat-card .ssub { font-size: 11px; color: #94a3b8; margin-top: 4px; }
  .stat-card.open-c { border-left: 3px solid #3b82f6; }
  .stat-card.prog-c { border-left: 3px solid #f59e0b; }
  .stat-card.res-c  { border-left: 3px solid #10b981; }
  .stat-card.all-c  { border-left: 3px solid #8b5cf6; }

  /* Section card */
  .tms-card { background: #fff; border: 1px solid #dbeafe; border-radius: 12px; overflow: hidden; }
  .tms-card-header { padding: 16px 20px; border-bottom: 1px solid #eff6ff; display: flex; align-items: center; gap: 10px; }
  .tms-card-header h2 { font-size: 14px; font-weight: 600; color: #1e3a5f; margin: 0; flex: 1; }
  .tms-card-body { padding: 0; }

  /* Ticket rows */
  .ticket-row { display: flex; align-items: center; gap: 12px; padding: 12px 20px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: background 0.12s; }
  .ticket-row:last-child { border-bottom: none; }
  .ticket-row:hover { background: #f8faff; }
  .priority-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .p-critical { background: #ef4444; }
  .p-high     { background: #f97316; }
  .p-medium   { background: #f59e0b; }
  .p-low      { background: #10b981; }
  .ticket-id   { font-size: 11px; color: #93c5fd; font-weight: 700; min-width: 72px; }
  .ticket-info { flex: 1; min-width: 0; }
  .ticket-title { font-size: 13px; font-weight: 500; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .ticket-meta  { font-size: 11px; color: #94a3b8; margin-top: 2px; }
  .status-badge { font-size: 10.5px; font-weight: 600; padding: 3px 10px; border-radius: 20px; white-space: nowrap; }
  .s-open     { background: #dbeafe; color: #1d4ed8; }
  .s-progress { background: #fef3c7; color: #92400e; }
  .s-resolved { background: #d1fae5; color: #065f46; }
  .s-pending  { background: #ede9fe; color: #5b21b6; }
  .s-closed   { background: #f1f5f9; color: #475569; }

  /* Buttons */
  .tms-btn { display: inline-flex; align-items: center; gap: 6px; padding: 8px 16px; border-radius: 8px; font-size: 12.5px; font-weight: 600; cursor: pointer; border: none; transition: background 0.15s; }
  .tms-btn-primary { background: #185fa5; color: #fff; }
  .tms-btn-primary:hover { background: #1e4d8c; }
  .tms-btn-outline { background: #fff; color: #185fa5; border: 1px solid #93c5fd; }
  .tms-btn-outline:hover { background: #eff6ff; }
  .tms-btn-ghost { background: transparent; color: #64748b; border: 1px solid #e2e8f0; }
  .tms-btn-ghost:hover { background: #f1f5f9; }
  .tms-btn-danger { background: #fff; color: #dc2626; border: 1px solid #fca5a5; }
  .tms-btn-danger:hover { background: #fef2f2; }
  .tms-btn-success { background: #059669; color: #fff; border: none; }
  .tms-btn-success:hover { background: #047857; }

  /* ── Shared modal base ── */
  .tms-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(15, 30, 50, 0.55);
    z-index: 100; align-items: center; justify-content: center; padding: 16px;
  }
  .tms-overlay.open { display: flex; }
  .tms-modal {
    background: #fff; border-radius: 14px; width: 100%;
    max-width: 560px; max-height: 90vh; overflow-y: auto;
    animation: tmsSlideUp 0.2s ease;
  }
  .tms-modal-sm { max-width: 480px; }
  .tms-modal-lg { max-width: 560px; }
  @keyframes tmsSlideUp {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
  }

  /* Modal header */
  .tms-modal-header { padding: 20px 24px 16px; border-bottom: 1px solid #e2e8f0; display: flex; align-items: flex-start; gap: 12px; }
  .tms-modal-header .icon-wrap { width: 40px; height: 40px; background: #eff6ff; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .tms-modal-header .icon-wrap i { font-size: 20px; color: #185fa5; }
  .tms-modal-header h3 { font-size: 15px; font-weight: 700; color: #1e3a5f; margin: 0 0 3px; }
  .tms-modal-header p  { font-size: 12px; color: #64748b; margin: 0; }
  .tms-close-btn { margin-left: auto; width: 28px; height: 28px; border-radius: 6px; border: none; background: #f1f5f9; cursor: pointer; display: flex; align-items: center; justify-content: center; color: #64748b; flex-shrink: 0; transition: background 0.12s; }
  .tms-close-btn:hover { background: #e2e8f0; color: #1e293b; }

  /* Modal body */
  .tms-modal-body { padding: 20px 24px; display: flex; flex-direction: column; gap: 16px; }
  .tms-form-group { display: flex; flex-direction: column; gap: 5px; }
  .tms-form-group label { font-size: 12px; font-weight: 600; color: #334155; }
  .tms-form-group .hint { font-size: 11px; color: #94a3b8; margin-top: 2px; }
  .tms-form-control { width: 100%; padding: 9px 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 13px; color: #1e293b; outline: none; transition: border 0.15s, box-shadow 0.15s; background: #fff; font-family: inherit; }
  .tms-form-control:focus { border-color: #60a5fa; box-shadow: 0 0 0 3px rgba(96,165,250,0.15); }
  .tms-form-control::placeholder { color: #94a3b8; }
  textarea.tms-form-control { resize: vertical; min-height: 90px; line-height: 1.5; }
  select.tms-form-control { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; padding-right: 32px; cursor: pointer; }
  .tms-form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }

  /* File drop */
  .file-drop { border: 2px dashed #bfdbfe; border-radius: 8px; padding: 20px; text-align: center; cursor: pointer; transition: all 0.15s; background: #f8faff; }
  .file-drop:hover { border-color: #60a5fa; background: #eff6ff; }
  .file-drop i  { font-size: 24px; color: #93c5fd; margin-bottom: 6px; }
  .file-drop p  { font-size: 12px; color: #64748b; margin: 0; }
  .file-drop span { font-size: 11px; color: #93c5fd; }

  /* Modal footer */
  .tms-modal-footer { padding: 16px 24px; border-top: 1px solid #e2e8f0; display: flex; align-items: center; gap: 8px; }
  .tms-footer-note { font-size: 11px; color: #94a3b8; flex: 1; display: flex; align-items: center; gap: 4px; }

  /* Success state */
  .tms-modal-success { display: none; flex-direction: column; align-items: center; padding: 40px 24px; text-align: center; }
  .tms-modal-success.show { display: flex; }
  .success-icon { width: 64px; height: 64px; border-radius: 50%; background: #d1fae5; display: flex; align-items: center; justify-content: center; margin-bottom: 16px; }
  .success-icon i { font-size: 32px; color: #059669; }
  .tms-modal-success h3 { font-size: 17px; font-weight: 700; color: #1e3a5f; margin: 0 0 8px; }
  .tms-modal-success p  { font-size: 13px; color: #64748b; margin: 0 0 20px; line-height: 1.6; }

  /* Detail modal header */
  .tms-detail-header { background: #1e3a5f; padding: 20px 24px; color: #fff; border-radius: 14px 14px 0 0; }
  .tms-detail-header .dclose { float: right; background: rgba(255,255,255,0.12); border: none; color: #fff; width: 28px; height: 28px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; }
  .tms-detail-header .dclose:hover { background: rgba(255,255,255,0.2); }
  .tms-detail-header .did    { font-size: 11px; color: #7ea8cc; margin-bottom: 4px; }
  .tms-detail-header .dtitle { font-size: 15px; font-weight: 700; line-height: 1.3; }

  /* Detail grid */
  .detail-grid { display: grid; grid-template-columns: 1fr 1fr; }
  .detail-cell { padding: 12px 24px; border-bottom: 1px solid #f1f5f9; }
  .detail-cell:nth-child(odd) { border-right: 1px solid #f1f5f9; }
  .detail-cell .dlabel { font-size: 10.5px; color: #94a3b8; font-weight: 600; text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px; }
  .detail-cell .dval   { font-size: 13px; font-weight: 500; color: #1e293b; }

  /* Timeline */
  .detail-timeline    { padding: 16px 24px; }
  .detail-timeline h4 { font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.07em; margin: 0 0 12px; }
  .tl-item { display: flex; gap: 12px; margin-bottom: 12px; position: relative; }
  .tl-item:not(:last-child)::before { content: ''; position: absolute; left: 5px; top: 14px; bottom: -6px; width: 1px; background: #dbeafe; }
  .tl-dot { width: 11px; height: 11px; border-radius: 50%; background: #93c5fd; border: 2px solid #fff; flex-shrink: 0; margin-top: 3px; z-index: 1; }
  .tl-dot.filled { background: #185fa5; }
  .tl-text { font-size: 12px; color: #334155; line-height: 1.45; }
  .tl-time { font-size: 10.5px; color: #94a3b8; margin-top: 2px; }

  /* Comment list inside detail modal */
  .comment-list { padding: 0 24px 16px; display: flex; flex-direction: column; gap: 10px; }
  .comment-item { background: #f8faff; border: 1px solid #dbeafe; border-radius: 10px; padding: 10px 14px; }
  .comment-item .c-meta { display: flex; align-items: center; gap: 8px; margin-bottom: 5px; }
  .comment-item .c-avatar { width: 24px; height: 24px; border-radius: 50%; background: #185fa5; color: #bfdbfe; font-size: 10px; font-weight: 700; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .comment-item .c-name { font-size: 12px; font-weight: 600; color: #1e3a5f; }
  .comment-item .c-time { font-size: 10.5px; color: #94a3b8; margin-left: auto; }
  .comment-item .c-text { font-size: 12.5px; color: #334155; line-height: 1.5; }

  /* Comment modal input area */
  .comment-modal-overlay { z-index: 200; }

  /* Detail actions */
  .detail-actions { padding: 14px 24px; border-top: 1px solid #dbeafe; display: flex; gap: 8px; }

  /* Toast */
  .tms-toast { position: fixed; bottom: 24px; right: 24px; background: #1e3a5f; color: #fff; padding: 12px 18px; border-radius: 10px; font-size: 13px; font-weight: 500; display: flex; align-items: center; gap: 8px; z-index: 9999; transform: translateY(20px); opacity: 0; transition: all 0.3s ease; pointer-events: none; }
  .tms-toast.show { transform: translateY(0); opacity: 1; }
  .tms-toast i { color: #60a5fa; font-size: 16px; }

  /* Error field highlight */
  .tms-form-control.field-error { border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239,68,68,0.12); }

</style>
<div class="page">
  <div class="page-header">
    <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
      <div>
        <h1 class="page-title text-blue-500 font-bold">My Support Tickets</h1>
        <p class="text-blue-300 font-semibold">View the status of your reported issues or submit a new one.</p>
      </div>
      <button class="tms-btn tms-btn-primary" onclick="tmsOpenReportModal()">
        <i class="ti ti-plus" style="font-size:15px;"></i> Report a ticket
      </button>
    </div>
  </div>

  <!-- Stats -->
  <div class="stat-row">
    <div class="stat-card all-c">
      <div class="slabel"><i class="ti ti-ticket" style="font-size:13px;color:#8b5cf6;"></i> Total submitted</div>
      <div class="sval">12</div>
      <div class="ssub">All time</div>
    </div>
    <div class="stat-card open-c">
      <div class="slabel"><i class="ti ti-circle-dot" style="font-size:13px;color:#3b82f6;"></i> Open</div>
      <div class="sval">3</div>
      <div class="ssub">Awaiting action</div>
    </div>
    <div class="stat-card prog-c">
      <div class="slabel"><i class="ti ti-loader" style="font-size:13px;color:#f59e0b;"></i> In progress</div>
      <div class="sval">2</div>
      <div class="ssub">Being worked on</div>
    </div>
    <div class="stat-card res-c">
      <div class="slabel"><i class="ti ti-circle-check" style="font-size:13px;color:#10b981;"></i> Resolved</div>
      <div class="sval">7</div>
      <div class="ssub">Closed tickets</div>
    </div>
  </div>

  <!-- Ticket list -->
  <div class="tms-card">
    <div class="tms-card-header">
      <i class="ti ti-list-details" style="font-size:17px;color:#185fa5;"></i>
      <h2>My Tickets</h2>
      <div style="display:flex;gap:6px;align-items:center;">
        <div style="display:flex;background:#f1f5f9;border-radius:7px;padding:3px;gap:2px;">
          <span style="padding:4px 10px;border-radius:5px;font-size:11.5px;background:#fff;color:#185fa5;font-weight:600;cursor:pointer;border:1px solid #dbeafe;">All</span>
          <span style="padding:4px 10px;border-radius:5px;font-size:11.5px;color:#64748b;cursor:pointer;">Open</span>
          <span style="padding:4px 10px;border-radius:5px;font-size:11.5px;color:#64748b;cursor:pointer;">In Progress</span>
          <span style="padding:4px 10px;border-radius:5px;font-size:11.5px;color:#64748b;cursor:pointer;">Resolved</span>
        </div>
      </div>
    </div>
    <div class="tms-card-body">

      <div class="ticket-row" onclick="tmsOpenDetailModal('TKT-0081','HIS system unreachable — Emergency Dept.','In Progress','Critical','Jun 10, 9:42 AM','IT Support Team','Network / HIS Server')">
        <div class="priority-dot p-critical"></div>
        <div class="ticket-id">#TKT-0081</div>
        <div class="ticket-info">
          <div class="ticket-title">HIS system unreachable — Emergency Dept.</div>
          <div class="ticket-meta">Opened Jun 10, 2026 · IT Department · Assigned: Carlos M.</div>
        </div>
        <span class="status-badge s-progress">In Progress</span>
        <i class="ti ti-chevron-right" style="color:#cbd5e1;font-size:15px;margin-left:4px;"></i>
      </div>

      <div class="ticket-row" onclick="tmsOpenDetailModal('TKT-0078','Printer not working in Pharmacy dispensary','Open','High','Jun 10, 7:30 AM','Unassigned','Hardware / Printer')">
        <div class="priority-dot p-high"></div>
        <div class="ticket-id">#TKT-0078</div>
        <div class="ticket-info">
          <div class="ticket-title">Printer not working in Pharmacy dispensary</div>
          <div class="ticket-meta">Opened Jun 10, 2026 · Pharmacy · Unassigned</div>
        </div>
        <span class="status-badge s-open">Open</span>
        <i class="ti ti-chevron-right" style="color:#cbd5e1;font-size:15px;margin-left:4px;"></i>
      </div>

      <div class="ticket-row" onclick="tmsOpenDetailModal('TKT-0077','Lab LIS barcode scanner not reading','Pending Parts','Medium','Jun 9, 3:15 PM','Ana R.','Hardware / Scanner')">
        <div class="priority-dot p-medium"></div>
        <div class="ticket-id">#TKT-0077</div>
        <div class="ticket-info">
          <div class="ticket-title">Lab LIS barcode scanner not reading</div>
          <div class="ticket-meta">Opened Jun 9, 2026 · Laboratory · Assigned: Ana R.</div>
        </div>
        <span class="status-badge s-pending">Pending Parts</span>
        <i class="ti ti-chevron-right" style="color:#cbd5e1;font-size:15px;margin-left:4px;"></i>
      </div>

      <div class="ticket-row" onclick="tmsOpenDetailModal('TKT-0074','Monitor flicker on Billing workstation 12','Open','Low','Jun 9, 11:00 AM','Unassigned','Hardware / Monitor')">
        <div class="priority-dot p-low"></div>
        <div class="ticket-id">#TKT-0074</div>
        <div class="ticket-info">
          <div class="ticket-title">Monitor flicker on Billing workstation 12</div>
          <div class="ticket-meta">Opened Jun 9, 2026 · Billing · Unassigned</div>
        </div>
        <span class="status-badge s-open">Open</span>
        <i class="ti ti-chevron-right" style="color:#cbd5e1;font-size:15px;margin-left:4px;"></i>
      </div>

      <div class="ticket-row" onclick="tmsOpenDetailModal('TKT-0071','VPN access for remote staff','Resolved','Medium','Jun 7, 2:00 PM','Carlos M.','Network / VPN')">
        <div class="priority-dot p-medium"></div>
        <div class="ticket-id">#TKT-0071</div>
        <div class="ticket-info">
          <div class="ticket-title">VPN access issue for remote staff</div>
          <div class="ticket-meta">Opened Jun 7, 2026 · IT · Resolved by: Carlos M.</div>
        </div>
        <span class="status-badge s-resolved">Resolved</span>
        <i class="ti ti-chevron-right" style="color:#cbd5e1;font-size:15px;margin-left:4px;"></i>
      </div>

      <div class="ticket-row" onclick="tmsOpenDetailModal('TKT-0068','New user account for Dr. Santos','Resolved','Low','Jun 5, 9:00 AM','Maria L.','Access / User Account')">
        <div class="priority-dot p-low"></div>
        <div class="ticket-id">#TKT-0068</div>
        <div class="ticket-info">
          <div class="ticket-title">New user account for Dr. Santos</div>
          <div class="ticket-meta">Opened Jun 5, 2026 · HR · Resolved by: Maria L.</div>
        </div>
        <span class="status-badge s-resolved">Resolved</span>
        <i class="ti ti-chevron-right" style="color:#cbd5e1;font-size:15px;margin-left:4px;"></i>
      </div>

    </div>
  </div>
</div>

{{-- Toast --}}
<div class="tms-toast" id="tmsToast">
  <i class="ti ti-circle-check"></i>
  <span id="tms-toast-msg">Action completed.</span>
</div>
@include('clients.ticketModal')
<script>
(function () {
  'use strict';

  // ── Shared: overlay click to close ──────────────────────────
  window.tmsHandleOverlay = function (e, id) {
    if (e.target === document.getElementById(id)) {
      if (id === 'tmsReportModal')  tmsCloseReportModal();
      if (id === 'tmsDetailModal')  tmsCloseDetailModal();
      if (id === 'tmsCommentModal') tmsCloseCommentModal();
    }
  };

  // ── Toast ────────────────────────────────────────────────────
  window.tmsShowToast = function (msg, success = false) {
    const t = document.getElementById('tmsToast');
    const icon = t.querySelector('i');
    icon.className = success ? 'ti ti-circle-check' : 'ti ti-alert-circle';
    icon.style.color = success ? '#10b981' : '#f87171';
    document.getElementById('tms-toast-msg').textContent = msg;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), 3200);
  };

  // ── Keyboard close ───────────────────────────────────────────
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      tmsCloseCommentModal();
      tmsCloseDetailModal();
      tmsCloseReportModal();
    }
  });


  // ════════════════════════════════════════
  //  MODAL 1 — Report a Ticket
  // ════════════════════════════════════════

  window.tmsOpenReportModal = function () {
    document.getElementById('tmsReportModal').classList.add('open');
    document.body.style.overflow = 'hidden';
    document.getElementById('tmsFormState').style.display = '';
    document.getElementById('tmsSuccessState').classList.remove('show');
  };

  window.tmsCloseReportModal = function () {
    document.getElementById('tmsReportModal').classList.remove('open');
    document.body.style.overflow = '';
  };

  window.tmsToggleOther = function () {
    const val       = document.getElementById('f-cat').value;
    const container = document.getElementById('tms-other-container');
    const field     = document.getElementById('f-other-cat');
    container.style.display = val === 'Other' ? '' : 'none';
    if (val !== 'Other') field.value = '';
  };

  window.tmsHandleFiles = function (e) {
    const list = document.getElementById('tms-file-list');
    list.innerHTML = '';
    Array.from(e.target.files).forEach(function (f) {
      const row = document.createElement('div');
      row.style.cssText = 'display:flex;align-items:center;gap:8px;padding:6px 10px;background:#f8faff;border:1px solid #dbeafe;border-radius:6px;';
      row.innerHTML = '<i class="ti ti-file" style="font-size:14px;color:#60a5fa;"></i>'
        + '<span style="font-size:12px;color:#334155;flex:1;">' + f.name + '</span>'
        + '<span style="font-size:11px;color:#94a3b8;">' + (f.size / 1024).toFixed(0) + ' KB</span>';
      list.appendChild(row);
    });
  };

  window.tmsSubmitTicket = function () {
    const client  = document.getElementById('f-client').value.trim();
    const name    = document.getElementById('f-name').value.trim();
    const cat     = document.getElementById('f-cat').value;
    const otherCat= document.getElementById('f-other-cat').value.trim();
    const subject = document.getElementById('f-subject').value.trim();
    const desc    = document.getElementById('f-desc').value.trim();

    // Clear previous errors
    ['f-client','f-name','f-cat','f-subject','f-desc'].forEach(function (id) {
      document.getElementById(id).classList.remove('field-error');
    });

    let hasError = false;
    if (!client)  { document.getElementById('f-client').classList.add('field-error');  hasError = true; }
    if (!name)    { document.getElementById('f-name').classList.add('field-error');    hasError = true; }
    if (!cat)     { document.getElementById('f-cat').classList.add('field-error');     hasError = true; }
    if (cat === 'Other' && !otherCat) {
      document.getElementById('f-other-cat').classList.add('field-error'); hasError = true;
    }
    if (!subject) { document.getElementById('f-subject').classList.add('field-error'); hasError = true; }
    if (!desc)    { document.getElementById('f-desc').classList.add('field-error');    hasError = true; }

    if (hasError) {
      tmsShowToast('Please fill in all required fields.');
      return;
    }

    document.getElementById('tmsFormState').style.display = 'none';
    document.getElementById('tmsSuccessState').classList.add('show');
  };

  window.tmsReportAnother = function () {
    ['f-client','f-name','f-subject','f-desc','f-other-cat'].forEach(function (id) {
      document.getElementById(id).value = '';
      document.getElementById(id).classList.remove('field-error');
    });
    document.getElementById('f-cat').value = '';
    document.getElementById('f-cat').classList.remove('field-error');
    document.getElementById('tms-other-container').style.display = 'none';
    document.getElementById('tms-file-list').innerHTML = '';
    document.getElementById('tmsSuccessState').classList.remove('show');
    document.getElementById('tmsFormState').style.display = '';
  };


  // ════════════════════════════════════════
  //  MODAL 2 — Ticket Detail
  // ════════════════════════════════════════

  const statusBadgeMap = {
    'In Progress':  '<span class="status-badge s-progress">In Progress</span>',
    'Open':         '<span class="status-badge s-open">Open</span>',
    'Pending Parts':'<span class="status-badge s-pending">Pending Parts</span>',
    'Resolved':     '<span class="status-badge s-resolved">Resolved</span>',
    'Closed':       '<span class="status-badge s-closed">Closed</span>',
  };

  const timelineData = {
    'TKT-0081': [
      { filled: true,  text: 'Carlos M. started diagnosis — checking network routes', time: '9:56 AM · 14 mins ago' },
      { filled: true,  text: 'Ticket escalated to P1 Critical by IT Lead', time: '9:49 AM · 21 mins ago' },
      { filled: false, text: 'Ticket opened by Maria Cruz', time: '9:42 AM · 28 mins ago' },
    ],
    'TKT-0078': [
      { filled: false, text: 'Ticket opened by Maria Cruz — awaiting assignment', time: 'Jun 10, 7:30 AM' },
    ],
    'TKT-0077': [
      { filled: true,  text: 'Waiting for replacement scanner part from vendor', time: 'Jun 9, 5:00 PM' },
      { filled: true,  text: 'Diagnosed as hardware fault — barcode laser worn', time: 'Jun 9, 4:00 PM' },
      { filled: false, text: 'Ticket opened by Maria Cruz', time: 'Jun 9, 3:15 PM' },
    ],
    'TKT-0074': [
      { filled: false, text: 'Ticket opened by Maria Cruz — awaiting assignment', time: 'Jun 9, 11:00 AM' },
    ],
    'TKT-0071': [
      { filled: true,  text: 'Marked resolved — VPN config updated for remote accounts', time: 'Jun 7, 4:30 PM' },
      { filled: true,  text: 'Carlos M. applied firewall rule fix', time: 'Jun 7, 3:45 PM' },
      { filled: false, text: 'Ticket opened by Maria Cruz', time: 'Jun 7, 2:00 PM' },
    ],
    'TKT-0068': [
      { filled: true,  text: 'Account created and credentials sent to Dr. Santos', time: 'Jun 5, 11:00 AM' },
      { filled: false, text: 'Ticket opened by Maria Cruz', time: 'Jun 5, 9:00 AM' },
    ],
  };

  // Stores comments per ticket (keyed by ticket id)
  const commentStore = {};

  // Track currently open ticket id for the comment modal
  let currentTicketId = null;

  window.tmsOpenDetailModal = function (id, title, status, priority, opened, assigned, category) {
    currentTicketId = id;

    document.getElementById('d-id').textContent    = '#' + id;
    document.getElementById('d-title').textContent = title;
    document.getElementById('d-status').innerHTML  = statusBadgeMap[status] || status;
    document.getElementById('d-opened').textContent    = opened;
    document.getElementById('d-assigned').textContent  = assigned;
    document.getElementById('d-category').textContent  = category;

    // Category tags
    document.getElementById('d-tags').innerHTML = category.split(' / ').map(function (t) {
      return '<span style="font-size:10.5px;padding:2px 8px;border-radius:20px;background:#0c447c;color:#bfdbfe;font-weight:500;">' + t + '</span>';
    }).join('');

    // Timeline
    const tl = timelineData[id] || [];
    document.getElementById('d-timeline').innerHTML = tl.map(function (item) {
      return '<div class="tl-item">'
        + '<div class="tl-dot ' + (item.filled ? 'filled' : '') + '"></div>'
        + '<div><div class="tl-text">' + item.text + '</div>'
        + '<div class="tl-time">' + item.time + '</div></div>'
        + '</div>';
    }).join('');

    // Comments
    tmsRenderComments(id);

    // Update comment modal label
    document.getElementById('tms-comment-ticket-label').textContent = 'Replying to #' + id + ' — ' + title;

    document.getElementById('tmsDetailModal').classList.add('open');
    document.body.style.overflow = 'hidden';
  };

  window.tmsCloseDetailModal = function () {
    document.getElementById('tmsDetailModal').classList.remove('open');
    document.body.style.overflow = '';
    currentTicketId = null;
  };

  function tmsRenderComments (id) {
    const list     = document.getElementById('d-comments');
    const comments = commentStore[id] || [];
    if (comments.length === 0) {
      list.innerHTML = '<p style="font-size:12px;color:#94a3b8;padding:0 0 12px;">No comments yet. Be the first to add one.</p>';
      return;
    }
    list.innerHTML = comments.map(function (c) {
      const initials = c.name.split(' ').map(function (w) { return w[0]; }).join('').toUpperCase().slice(0, 2);
      return '<div class="comment-item">'
        + '<div class="c-meta">'
        + '<div class="c-avatar">' + initials + '</div>'
        + '<span class="c-name">' + c.name + '</span>'
        + '<span class="c-time">' + c.time + '</span>'
        + '</div>'
        + '<div class="c-text">' + c.text + '</div>'
        + '</div>';
    }).join('');
  }


  // ════════════════════════════════════════
  //  MODAL 3 — Add Comment
  // ════════════════════════════════════════

  window.tmsOpenCommentModal = function () {
    document.getElementById('tmsCommentModal').classList.add('open');
  };

  window.tmsCloseCommentModal = function () {
    document.getElementById('tmsCommentModal').classList.remove('open');
    // Clear fields
    document.getElementById('c-name').value  = '';
    document.getElementById('c-name').classList.remove('field-error');
    document.getElementById('c-body').value  = '';
    document.getElementById('c-body').classList.remove('field-error');
    document.getElementById('c-type').value  = 'Update';
    document.getElementById('c-file-preview').innerHTML = '';
  };

  window.tmsHandleCommentFile = function (e) {
    const preview = document.getElementById('c-file-preview');
    preview.innerHTML = '';
    const f = e.target.files[0];
    if (!f) return;
    const row = document.createElement('div');
    row.style.cssText = 'display:flex;align-items:center;gap:8px;padding:6px 10px;background:#f8faff;border:1px solid #dbeafe;border-radius:6px;';
    row.innerHTML = '<i class="ti ti-file" style="font-size:14px;color:#60a5fa;"></i>'
      + '<span style="font-size:12px;color:#334155;flex:1;">' + f.name + '</span>'
      + '<span style="font-size:11px;color:#94a3b8;">' + (f.size / 1024).toFixed(0) + ' KB</span>';
    preview.appendChild(row);
  };

  window.tmsSubmitComment = function () {
    const name = document.getElementById('c-name').value.trim();
    const body = document.getElementById('c-body').value.trim();
    const type = document.getElementById('c-type').value;

    document.getElementById('c-name').classList.remove('field-error');
    document.getElementById('c-body').classList.remove('field-error');

    let hasError = false;
    if (!name) { document.getElementById('c-name').classList.add('field-error'); hasError = true; }
    if (!body) { document.getElementById('c-body').classList.add('field-error'); hasError = true; }
    if (hasError) { tmsShowToast('Please fill in your name and message.'); return; }

    if (!currentTicketId) return;

    // Save comment
    if (!commentStore[currentTicketId]) commentStore[currentTicketId] = [];
    const now = new Date();
    commentStore[currentTicketId].push({
      name: name,
      text: '[' + type + '] ' + body,
      time: now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) + ' · just now',
    });

    // Refresh comment list in detail modal
    tmsRenderComments(currentTicketId);

    tmsCloseCommentModal();
    tmsShowToast('Comment posted successfully.', true);
  };

})();
</script>
@endsection