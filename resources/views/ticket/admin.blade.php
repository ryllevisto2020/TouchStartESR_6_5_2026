@extends('layouts.app')
@section('title', 'Touchstar Medical Enterprises Inc. Service Tickets')
@section('content')
<style>
    .btn { display: inline-flex; align-items: center; gap: 6px; padding: 7px 14px; border-radius: 8px; font-size: 12.5px; font-weight: 500; cursor: pointer; border: none; transition: background 0.15s; }
  .btn-primary { background: #185fa5; color: #fff; }
  .btn-primary:hover { background: #1e4d8c; }
  .btn-outline { background: #fff; color: #185fa5; border: 1px solid #93c5fd; }
  .btn-outline:hover { background: #eff6ff; }
  .content { padding: 20px 24px; flex: 1; overflow-y: auto; }
  .stats-row { display: grid; grid-template-columns: repeat(5, 1fr); gap: 12px; margin-bottom: 20px; }
  .stat-card { background: #fff; border: 1px solid #dbeafe; border-radius: 10px; padding: 14px 16px; }
  .stat-card .label { font-size: 11px; color: #64748b; font-weight: 500; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 6px; display: flex; align-items: center; gap: 5px; }
  .stat-card .value { font-size: 24px; font-weight: 700; color: #1e3a5f; line-height: 1; }
  .stat-card .sub { font-size: 11px; color: #64748b; margin-top: 4px; }
  .stat-card.urgent { border-left: 3px solid #ef4444; }
  .stat-card.open { border-left: 3px solid #3b82f6; }
  .stat-card.progress { border-left: 3px solid #f59e0b; }
  .stat-card.resolved { border-left: 3px solid #10b981; }
  .stat-card.total { border-left: 3px solid #8b5cf6; }
  .panel-row { display: flex; gap: 16px; }
  .ticket-panel { flex: 1; background: #fff; border: 1px solid #dbeafe; border-radius: 10px; overflow: hidden; }
  .panel-header { padding: 14px 16px; border-bottom: 1px solid #eff6ff; display: flex; align-items: center; gap: 8px; }
  .panel-header h3 { font-size: 13px; font-weight: 600; color: #1e3a5f; flex: 1; }
  .filter-tabs { display: flex; gap: 4px; }
  .ftab { padding: 4px 10px; border-radius: 6px; font-size: 11.5px; cursor: pointer; color: #64748b; }
  .ftab.active { background: #eff6ff; color: #185fa5; font-weight: 600; }
  .ticket-row { display: flex; align-items: center; gap: 10px; padding: 10px 16px; border-bottom: 1px solid #f1f5f9; cursor: pointer; transition: background 0.12s; }
  .ticket-row:hover { background: #f8faff; }
  .ticket-row.selected { background: #eff6ff; border-left: 3px solid #185fa5; }
  .ticket-id { font-size: 11px; color: #93c5fd; font-weight: 600; min-width: 66px; }
  .ticket-info { flex: 1; min-width: 0; }
  .ticket-title { font-size: 12.5px; font-weight: 500; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .ticket-meta { font-size: 11px; color: #94a3b8; margin-top: 2px; }
  .priority-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .p-critical { background: #ef4444; }
  .p-high { background: #f97316; }
  .p-medium { background: #f59e0b; }
  .p-low { background: #10b981; }
  .status-badge { font-size: 10.5px; font-weight: 600; padding: 2px 8px; border-radius: 20px; white-space: nowrap; }
  .s-open { background: #dbeafe; color: #1d4ed8; }
  .s-progress { background: #fef3c7; color: #92400e; }
  .s-resolved { background: #d1fae5; color: #065f46; }
  .s-closed { background: #f1f5f9; color: #475569; }
  .s-pending { background: #ede9fe; color: #5b21b6; }
  .detail-panel { width: 300px; background: #fff; border: 1px solid #dbeafe; border-radius: 10px; overflow: hidden; flex-shrink: 0; }
  .detail-header { background: #1e3a5f; padding: 14px 16px; color: #fff; }
  .detail-header .did { font-size: 11px; color: #7ea8cc; margin-bottom: 2px; }
  .detail-header .dtitle { font-size: 13.5px; font-weight: 600; line-height: 1.3; }
  .detail-body { padding: 14px 16px; }
  .detail-row { display: flex; justify-content: space-between; align-items: center; padding: 7px 0; border-bottom: 1px solid #f1f5f9; }
  .detail-row:last-child { border-bottom: none; }
  .detail-label { font-size: 11.5px; color: #64748b; display: flex; align-items: center; gap: 5px; }
  .detail-val { font-size: 12px; font-weight: 500; color: #1e293b; }
  .avatar { width: 24px; height: 24px; border-radius: 50%; background: #185fa5; color: #bfdbfe; font-size: 10px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; }
  .timeline { padding: 12px 16px; border-top: 1px solid #f1f5f9; }
  .timeline h4 { font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.06em; margin: 0 0 10px; }
  .t-item { display: flex; gap: 10px; margin-bottom: 10px; }
  .t-dot { width: 8px; height: 8px; border-radius: 50%; background: #93c5fd; margin-top: 4px; flex-shrink: 0; }
  .t-dot.filled { background: #185fa5; }
  .t-text { font-size: 11.5px; color: #334155; line-height: 1.4; }
  .t-time { font-size: 10.5px; color: #94a3b8; margin-top: 1px; }
  .action-bar { padding: 12px 16px; border-top: 1px solid #dbeafe; display: flex; gap: 8px; }
  .dept-tag { font-size: 10.5px; padding: 2px 8px; border-radius: 20px; background: #dbeafe; color: #1d4ed8; font-weight: 500; }
    </style>
<div class="main">
    
    <!-- Content Area -->
    <div class="content">

      <!-- Stats Row -->
      <div class="stats-row">
        <div class="stat-card total">
          <div class="label"><i class="ti ti-ticket" style="font-size:13px;color:#8b5cf6;"></i> Total Tickets</div>
          <div class="value">247</div>
          <div class="sub">↑ 12 from last week</div>
        </div>
        <div class="stat-card open">
          <div class="label"><i class="ti ti-circle-dot" style="font-size:13px;color:#3b82f6;"></i> Open</div>
          <div class="value">47</div>
          <div class="sub">Awaiting assignment</div>
        </div>
        <div class="stat-card progress">
          <div class="label"><i class="ti ti-loader" style="font-size:13px;color:#f59e0b;"></i> In Progress</div>
          <div class="value">31</div>
          <div class="sub">Actively being worked</div>
        </div>
        <div class="stat-card resolved">
          <div class="label"><i class="ti ti-circle-check" style="font-size:13px;color:#10b981;"></i> Resolved</div>
          <div class="value">163</div>
          <div class="sub">This month</div>
        </div>
        <div class="stat-card urgent">
          <div class="label"><i class="ti ti-alert-circle" style="font-size:13px;color:#ef4444;"></i> Urgent / P1</div>
          <div class="value">6</div>
          <div class="sub">Needs immediate action</div>
        </div>
      </div>
      <div class="">
        <i class="ti ti-search"></i>
      </div>
      <button class="btn btn-outline"><i class="ti ti-filter" style="font-size:14px;"></i> Filter</button>
      <button class="btn btn-primary"><i class="ti ti-plus" style="font-size:14px;"></i> New Ticket</button>
      <div style="position:relative;cursor:pointer;">
        <i class="ti ti-bell" style="font-size:19px;color:#185fa5;"></i>
        <div style="position:absolute;top:-3px;right:-3px;width:8px;height:8px;background:#ef4444;border-radius:50%;border:2px solid #fff;"></div>
      </div>
    </div>

      <!-- Ticket List + Detail Panel -->
      <div class="panel-row">

        <!-- Ticket List -->
        <div class="ticket-panel">
          <div class="panel-header">
            <h3>Active Tickets</h3>
            <div class="filter-tabs">
              <span class="ftab active">All</span>
              <span class="ftab">Open</span>
              <span class="ftab">In Progress</span>
              <span class="ftab">Pending</span>
            </div>
            <button class="btn btn-outline" style="padding:4px 10px;font-size:11.5px;margin-left:8px;">
              <i class="ti ti-sort-descending" style="font-size:13px;"></i> Sort
            </button>
          </div>

          <div class="ticket-row selected">
            <div class="priority-dot p-critical"></div>
            <div class="ticket-id">#TKT-0081</div>
            <div class="ticket-info">
              <div class="ticket-title">HIS system unreachable — Emergency Dept.</div>
              <div class="ticket-meta">Assigned: Carlos M. · Emergency · 14 mins ago</div>
            </div>
            <span class="status-badge s-progress">In Progress</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-critical"></div>
            <div class="ticket-id">#TKT-0080</div>
            <div class="ticket-info">
              <div class="ticket-title">PACS viewer crash on Radiology workstation 3</div>
              <div class="ticket-meta">Assigned: Maria L. · Radiology · 28 mins ago</div>
            </div>
            <span class="status-badge s-open">Open</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-high"></div>
            <div class="ticket-id">#TKT-0079</div>
            <div class="ticket-info">
              <div class="ticket-title">Nurse call system offline — Ward 4B</div>
              <div class="ticket-meta">Assigned: David S. · Nursing · 1 hr ago</div>
            </div>
            <span class="status-badge s-progress">In Progress</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-high"></div>
            <div class="ticket-id">#TKT-0078</div>
            <div class="ticket-info">
              <div class="ticket-title">Printer not working in Pharmacy dispensary</div>
              <div class="ticket-meta">Unassigned · Pharmacy · 2 hrs ago</div>
            </div>
            <span class="status-badge s-open">Open</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-medium"></div>
            <div class="ticket-id">#TKT-0077</div>
            <div class="ticket-info">
              <div class="ticket-title">Lab LIS barcode scanner not reading</div>
              <div class="ticket-meta">Assigned: Ana R. · Laboratory · 3 hrs ago</div>
            </div>
            <span class="status-badge s-pending">Pending Parts</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-medium"></div>
            <div class="ticket-id">#TKT-0076</div>
            <div class="ticket-info">
              <div class="ticket-title">VPN access issue for remote radiologist</div>
              <div class="ticket-meta">Assigned: Carlos M. · IT · 5 hrs ago</div>
            </div>
            <span class="status-badge s-progress">In Progress</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-low"></div>
            <div class="ticket-id">#TKT-0075</div>
            <div class="ticket-info">
              <div class="ticket-title">Request: new user account for Dr. Santos</div>
              <div class="ticket-meta">Assigned: Maria L. · HR · 1 day ago</div>
            </div>
            <span class="status-badge s-resolved">Resolved</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-low"></div>
            <div class="ticket-id">#TKT-0074</div>
            <div class="ticket-info">
              <div class="ticket-title">Monitor flicker on Billing workstation 12</div>
              <div class="ticket-meta">Unassigned · Billing · 1 day ago</div>
            </div>
            <span class="status-badge s-open">Open</span>
          </div>

          <div class="ticket-row">
            <div class="priority-dot p-critical"></div>
            <div class="ticket-id">#TKT-0073</div>
            <div class="ticket-info">
              <div class="ticket-title">ICU patient monitor data feed disconnected</div>
              <div class="ticket-meta">Assigned: David S. · ICU · 2 days ago</div>
            </div>
            <span class="status-badge s-resolved">Resolved</span>
          </div>

          <div style="padding:12px 16px;display:flex;align-items:center;justify-content:space-between;border-top:1px solid #f1f5f9;">
            <span style="font-size:11.5px;color:#64748b;">Showing 9 of 47 open tickets</span>
            <div style="display:flex;gap:4px;">
              <button class="btn btn-outline" style="padding:4px 10px;font-size:11.5px;"><i class="ti ti-chevron-left" style="font-size:12px;"></i></button>
              <button class="btn btn-outline" style="padding:4px 10px;font-size:11.5px;">1</button>
              <button class="btn btn-primary" style="padding:4px 10px;font-size:11.5px;">2</button>
              <button class="btn btn-outline" style="padding:4px 10px;font-size:11.5px;">3</button>
              <button class="btn btn-outline" style="padding:4px 10px;font-size:11.5px;"><i class="ti ti-chevron-right" style="font-size:12px;"></i></button>
            </div>
          </div>
        </div>

        <!-- Detail Panel -->
        <div class="detail-panel">
          <div class="detail-header">
            <div class="did">#TKT-0081 · P1 Critical</div>
            <div class="dtitle">HIS system unreachable — Emergency Dept.</div>
            <div style="display:flex;gap:6px;margin-top:10px;flex-wrap:wrap;">
              <span class="dept-tag" style="background:#0c447c;color:#bfdbfe;">Emergency</span>
              <span class="dept-tag" style="background:#0c447c;color:#bfdbfe;">HIS / EMR</span>
            </div>
          </div>

          <div class="detail-body">
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-circle-dot" style="font-size:13px;color:#3b82f6;"></i> Status</span>
              <span class="status-badge s-progress">In Progress</span>
            </div>
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-alert-triangle" style="font-size:13px;color:#ef4444;"></i> Priority</span>
              <span class="detail-val" style="color:#ef4444;">● Critical</span>
            </div>
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-user" style="font-size:13px;"></i> Assigned To</span>
              <span class="detail-val" style="display:flex;align-items:center;gap:5px;"><div class="avatar">CM</div> Carlos M.</span>
            </div>
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-user-exclamation" style="font-size:13px;"></i> Reported By</span>
              <span class="detail-val">Dr. A. Villanueva</span>
            </div>
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-clock" style="font-size:13px;"></i> Opened</span>
              <span class="detail-val">Jun 10, 9:42 AM</span>
            </div>
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-hourglass" style="font-size:13px;"></i> SLA Deadline</span>
              <span class="detail-val" style="color:#ef4444;">10:42 AM <span style="font-size:10.5px;">(44 min left)</span></span>
            </div>
            <div class="detail-row">
              <span class="detail-label"><i class="ti ti-device-desktop" style="font-size:13px;"></i> Affected Asset</span>
              <span class="detail-val">HIS-SERVER-01</span>
            </div>
          </div>

          <div class="timeline">
            <h4>Activity</h4>
            <div class="t-item">
              <div class="t-dot filled"></div>
              <div>
                <div class="t-text">Carlos M. started diagnosis — checking network routes</div>
                <div class="t-time">9:56 AM · 14 mins ago</div>
              </div>
            </div>
            <div class="t-item">
              <div class="t-dot filled"></div>
              <div>
                <div class="t-text">Ticket escalated to P1 Critical by IT Lead</div>
                <div class="t-time">9:49 AM · 21 mins ago</div>
              </div>
            </div>
            <div class="t-item">
              <div class="t-dot"></div>
              <div>
                <div class="t-text">Ticket opened by Dr. Villanueva</div>
                <div class="t-time">9:42 AM · 28 mins ago</div>
              </div>
            </div>
          </div>

          <div class="action-bar">
            <button class="btn btn-primary" style="flex:1;justify-content:center;">
              <i class="ti ti-message" style="font-size:13px;"></i> Reply
            </button>
            <button class="btn btn-outline" style="justify-content:center;">
              <i class="ti ti-transfer" style="font-size:13px;"></i> Reassign
            </button>
            <button class="btn btn-outline" style="justify-content:center;">
              <i class="ti ti-circle-check" style="font-size:13px;"></i>
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection