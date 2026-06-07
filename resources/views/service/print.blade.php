<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Report - Touchstar Medical</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            font-size: 9px;
            line-height: 1.35;
            color: #111827;
            background: #E5E7EB;
        }

        /* ── SCREEN ── */
        @media screen {
            .wrap {
                max-width: 210mm;
                margin: 52px auto 24px;
                background: white;
                box-shadow: 0 8px 30px rgba(0,0,0,.18);
                padding: 10mm 11mm;
            }
        }

        /* ── PRINT ── */
        @media print {
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .no-print { display: none !important; }
            body { background: white; }
            .wrap { margin: 0; padding: 0; box-shadow: none; }
            @page { size: A4; margin: 7mm 9mm; }
            * { page-break-inside: avoid; }
        }

        /* ── ACTION BAR ── */
        .topbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 99;
            background: white; border-bottom: 1px solid #E5E7EB;
            box-shadow: 0 1px 6px rgba(0,0,0,.08);
            display: flex; justify-content: space-between; align-items: center;
            padding: 7px 20px;
        }
        .topbar-left { display: flex; align-items: center; gap: 8px; }
        .topbar-icon { background: #2563EB; border-radius: 6px; padding: 5px 7px; color: white; font-size: 12px; }
        .topbar-title { font-size: 11px; font-weight: 700; color: #111827; }
        .topbar-sub   { font-size: 10px; color: #6B7280; }
        .btn-print {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 14px; background: #2563EB; color: white;
            font-size: 10px; font-weight: 600; border: none; border-radius: 6px; cursor: pointer;
        }
        .btn-close {
            display: inline-flex; align-items: center; gap: 5px;
            padding: 5px 12px; background: white; color: #374151;
            font-size: 10px; font-weight: 600; border: 1px solid #D1D5DB; border-radius: 6px; cursor: pointer;
            margin-left: 6px;
        }

        /* ── DOC HEADER ── */
        .doc-header {
            display: flex; align-items: center; justify-content: space-between;
            padding-bottom: 7px; margin-bottom: 7px;
            border-bottom: 3px solid #1D4ED8;
        }
        .doc-header img { height: 44px; object-fit: contain; }
        .doc-header-center { text-align: center; flex: 1; padding: 0 10px; }
        .doc-header-center .company { font-size: 12px; font-weight: 900; color: #1D4ED8; text-transform: uppercase; letter-spacing: .07em; }
        .doc-header-center .doc-type { font-size: 9px; font-weight: 700; color: #374151; margin-top: 1px; }
        .doc-header-right { text-align: right; min-width: 90px; }
        .doc-header-right .lbl  { font-size: 7px; font-weight: 700; color: #9CA3AF; text-transform: uppercase; }
        .doc-header-right .rid  { font-size: 14px; font-weight: 900; color: #1D4ED8; }
        .doc-header-right .date { font-size: 7.5px; color: #6B7280; }

        /* ── SECTION HEADER ── */
        .sec-hdr { display: flex; align-items: center; gap: 5px; margin-bottom: 4px; }
        .sec-icon {
            width: 16px; height: 16px; border-radius: 3px;
            display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .sec-icon i { font-size: 7px; color: white; }
        .sec-title { font-size: 9px; font-weight: 800; color: #111827; text-transform: uppercase; letter-spacing: .04em; }

        /* ── TWO-COLUMN TOP ROW ── */
        .top-row { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; margin-bottom: 8px; }

        /* ── INFO CARD ── */
        .info-card {
            border: 1px solid #E2E8F0; border-radius: 5px; padding: 6px;
            display: grid; grid-template-columns: 1fr 1fr; gap: 4px;
        }

        .field-lbl {
            font-size: 7px; font-weight: 700; color: #2563EB;
            text-transform: uppercase; letter-spacing: .04em; margin-bottom: 1px;
        }
        .field-val {
            font-size: 8.5px; font-weight: 500; color: #111827;
            background: white; border: 1px solid #D1D5DB;
            border-radius: 3px; padding: 2px 5px;
        }
        .fv-mono  { font-family: monospace; color: #1D4ED8; background: #EFF6FF; border-color: #BFDBFE; }
        .fv-green { background: #D1FAE5; color: #065F46; border-color: #6EE7B7; font-weight: 700; }
        .fv-red   { background: #FEE2E2; color: #991B1B; border-color: #FCA5A5; font-weight: 700; }

        /* ── DETAIL GRID ── */
        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 5px; margin-bottom: 8px; }

        .prose-block { border: 1px solid #E5E7EB; border-radius: 4px; overflow: hidden; }
        .prose-hdr {
            background: #F9FAFB; border-bottom: 1px solid #E5E7EB;
            padding: 2px 6px; font-size: 7px; font-weight: 700;
            color: #374151; text-transform: uppercase; letter-spacing: .05em;
        }
        .prose-body {
            padding: 4px 6px; font-size: 8.5px; color: #111827;
            line-height: 1.45; white-space: pre-wrap;
        }

        /* ── PARTS TABLE ── */
        .parts-wrap { margin-bottom: 8px; }
        .parts-table { width: 100%; border-collapse: collapse; font-size: 8px; }
        .parts-table th {
            background: #F3F4F6; padding: 2px 6px;
            text-align: left; font-weight: 700; color: #374151;
            text-transform: uppercase; font-size: 7px; letter-spacing: .04em;
            border-bottom: 1px solid #D1D5DB;
        }
        .parts-table td { padding: 2px 6px; border-bottom: 1px solid #F3F4F6; font-size: 8.5px; }
        .parts-table tr:last-child td { border-bottom: none; }

        /* ── SIGNATURES ── */
        .sig-row {
            display: grid; grid-template-columns: 1fr 1fr; gap: 10px;
            padding-top: 7px; border-top: 1.5px solid #E5E7EB; margin-top: 8px;
        }
        .sig-box { border-radius: 6px; padding: 6px 8px; text-align: center; }
        .sig-lbl  { font-size: 7px; font-weight: 700; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 3px; }
        .sig-area {
            height: 48px; display: flex; align-items: center; justify-content: center;
            background: white; border-radius: 4px; overflow: hidden; margin-bottom: 3px;
        }
        .sig-area img { max-height: 44px; max-width: 100%; object-fit: contain; }
        .sig-line { border-top: 1px solid #9CA3AF; margin-bottom: 2px; }
        .sig-name { font-size: 8.5px; font-weight: 700; color: #111827; }
        .sig-role { font-size: 7.5px; color: #6B7280; }

        /* ── FOOTER ── */
        .doc-footer {
            margin-top: 6px; padding-top: 4px; border-top: 1px solid #E5E7EB;
            display: flex; justify-content: space-between; align-items: center;
            font-size: 7px; color: #9CA3AF;
        }
    </style>
</head>
<body onload="loadReportData()">

    <!-- Action Bar -->
    <div class="topbar no-print">
        <div class="topbar-left">
            <div class="topbar-icon"><i class="fas fa-file-medical-alt"></i></div>
            <div>
                <div class="topbar-title">Service Report</div>
                <div class="topbar-sub" id="headerReportId">#Loading…</div>
            </div>
        </div>
        <div>
            <button class="btn-print" onclick="window.print()"><i class="fas fa-print"></i> Print</button>
            <button class="btn-close" onclick="window.close()"><i class="fas fa-times"></i> Close</button>
        </div>
    </div>

    <div class="wrap">
        <div id="printContent">
            <div style="text-align:center;padding:40px 0;color:#9CA3AF;">
                <i class="fas fa-spinner fa-spin" style="font-size:24px;margin-bottom:8px;display:block;color:#2563EB;"></i>
                Loading report…
            </div>
        </div>
    </div>

    <script>
        const MOCK_REPORTS    = {{ Js::from($service_records) }};
        const machine         = {{ Js::from($machines) }};
        const employee_details = {{ Js::from($employee_details) }};

        function loadReportData() {
            const id     = parseInt(new URLSearchParams(window.location.search).get('id'));
            const report = MOCK_REPORTS.find(r => r.id === id);

            if (!report) {
                document.getElementById('printContent').innerHTML =
                    `<div style="text-align:center;padding:32px;color:#6B7280;">
                        <i class="fas fa-exclamation-triangle" style="color:#EF4444;font-size:20px;display:block;margin-bottom:6px;"></i>
                        Report #${id} not found.
                        <br><button onclick="window.close()" style="margin-top:8px;padding:4px 12px;border:1px solid #D1D5DB;border-radius:4px;font-size:10px;cursor:pointer;">Close</button>
                    </div>`;
                return;
            }

            /* ── Machine lookup ── */
            const mach        = machine.find(x => x.id === report.machine_id) || {};
            const client_name = mach.client_location || '—';
            const machine_name = mach.name          || '—';
            const model       = mach.model           || '—';
            const serial      = mach.serial_number   || '—';

            /* ── Employee / signature lookup ── */
            const emp = employee_details.find(x => x.emp_id == report.completed_by_user_id) || {};
            const engineer_sig_src = emp.emp_signature ? `/storage/${emp.emp_signature}` : '';

            document.getElementById('headerReportId').textContent = `#${report.id}`;

            /* ── Helpers ── */
            const serviceTypes = (() => {
                try { const p = JSON.parse(report.service_type); return Array.isArray(p) ? p.join(', ') : p; }
                catch { return report.service_type || '—'; }
            })();

            const parts = (() => {
                try { return JSON.parse(report.parts_replaced) || []; }
                catch { return []; }
            })();

            const statusClass  = report.equipment_status === 'Operational' ? 'fv-green' : 'fv-red';
            const medtechSig   = `${window.location.origin}/storage/${report.medtech_signature}`;

            /* ── Parts table ── */
            const partsHtml = parts.length ? `
                <div class="parts-wrap">
                    <div class="sec-hdr">
                        <div class="sec-icon" style="background:linear-gradient(135deg,#F97316,#DC2626)"><i class="fas fa-cogs"></i></div>
                        <span class="sec-title">Parts Replaced</span>
                    </div>
                    <div style="border:1px solid #E5E7EB;border-radius:4px;overflow:hidden;">
                        <table class="parts-table">
                            <thead><tr><th>Qty</th><th>Particulars</th><th>SI / DR No.</th></tr></thead>
                            <tbody>
                                ${parts.map(p => `<tr>
                                    <td style="font-weight:700;">${p.qty||''}</td>
                                    <td>${p.particulars||''}</td>
                                    <td style="font-family:monospace;">${p.si_dr_no||''}</td>
                                </tr>`).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>` : '';

            /* ── Detail prose blocks ── */
            const detailBlocks = [
                report.identification_verification
                    ? `<div class="prose-block"><div class="prose-hdr">Identification / Verification</div><div class="prose-body">${report.identification_verification}</div></div>` : '',
                `<div class="prose-block"><div class="prose-hdr">Root Cause / Findings</div><div class="prose-body">${report.root_cause_findings || 'N/A'}</div></div>`,
                `<div class="prose-block"><div class="prose-hdr">Action Taken</div><div class="prose-body">${report.action_taken || 'N/A'}</div></div>`,
                report.recommendations
                    ? `<div class="prose-block"><div class="prose-hdr">Recommendations</div><div class="prose-body">${report.recommendations}</div></div>` : ''
            ].filter(Boolean).join('');

            /* ── Render ── */
            document.getElementById('printContent').innerHTML = `

                <!-- HEADER -->
                <div class="doc-header">
                    <img src="/images/logo.png" alt="Touchstar"
                        onerror="this.style.display='none'">
                    <div class="doc-header-center">
                        <div class="company">Touchstar Medical Enterprises Inc.</div>
                        <div class="doc-type">SERVICE REPORT</div>
                    </div>
                    <div class="doc-header-right">
                        <div class="lbl">Report No.</div>
                        <div class="rid">#${report.id}</div>
                        <div class="date">${report.service_date}</div>
                    </div>
                </div>

                <!-- TOP ROW: Machine + Service Info -->
                <div class="top-row">
                    <div>
                        <div class="sec-hdr">
                            <div class="sec-icon" style="background:linear-gradient(135deg,#3B82F6,#1D4ED8)"><i class="fas fa-laptop-medical"></i></div>
                            <span class="sec-title">Machine Information</span>
                        </div>
                        <div class="info-card" style="background:#F8FAFC;">
                            <div><div class="field-lbl">Client / Location</div><div class="field-val">${client_name}</div></div>
                            <div><div class="field-lbl">Machine Name</div><div class="field-val">${machine_name}</div></div>
                            <div><div class="field-lbl">Model</div><div class="field-val">${model}</div></div>
                            <div><div class="field-lbl">Serial Number</div><div class="field-val fv-mono">${serial}</div></div>
                        </div>
                    </div>
                    <div>
                        <div class="sec-hdr">
                            <div class="sec-icon" style="background:linear-gradient(135deg,#10B981,#059669)"><i class="fas fa-tools"></i></div>
                            <span class="sec-title">Service Information</span>
                        </div>
                        <div class="info-card" style="background:#F0FDF4;border-color:#BBF7D0;">
                            <div><div class="field-lbl">Service Type</div><div class="field-val" style="word-break:break-word;">${serviceTypes}</div></div>
                            <div><div class="field-lbl">Service Engineer</div><div class="field-val">${report.service_engineer || '—'}</div></div>
                            <div><div class="field-lbl">Equipment Status</div><div class="field-val ${statusClass}">${report.equipment_status}</div></div>
                            <div><div class="field-lbl">Approved By</div><div class="field-val">${report.approved_by || '—'}</div></div>
                        </div>
                    </div>
                </div>

                <!-- SERVICE DETAILS -->
                <div class="sec-hdr">
                    <div class="sec-icon" style="background:linear-gradient(135deg,#8B5CF6,#6D28D9)"><i class="fas fa-clipboard-check"></i></div>
                    <span class="sec-title">Service Details</span>
                </div>
                <div class="detail-grid">${detailBlocks}</div>

                <!-- PARTS -->
                ${partsHtml}

                <!-- SIGNATURES -->
                <div class="sig-row">
                    <div class="sig-box" style="background:#EFF6FF;border:1px solid #BFDBFE;">
                        <div class="sig-lbl" style="color:#1D4ED8;">Approved By (MedTech)</div>
                        <div class="sig-area">
                            <img src="${medtechSig}"
                                onerror="this.parentElement.innerHTML='<span style=color:#D1D5DB;font-size:8px;>No signature</span>'">
                        </div>
                        <div class="sig-line"></div>
                        <div class="sig-name">${report.approved_by || '—'}</div>
                        <div class="sig-role">Medical Technologist</div>
                    </div>
                    <div class="sig-box" style="background:#F0FDF4;border:1px solid #BBF7D0;">
                        <div class="sig-lbl" style="color:#059669;">Service Engineer</div>
                        <div class="sig-area">
                            ${engineer_sig_src
                                ? `<img src="${engineer_sig_src}" onerror="this.parentElement.innerHTML='<span style=color:#D1D5DB;font-size:8px;>No signature</span>'">`
                                : `<span style="color:#D1D5DB;font-size:8px;">No signature</span>`}
                        </div>
                        <div class="sig-line"></div>
                        <div class="sig-name">${report.service_engineer || '—'}</div>
                        <div class="sig-role">Service Engineer</div>
                    </div>
                </div>

                <!-- FOOTER -->
                <div class="doc-footer">
                    <span>Generated: ${new Date().toLocaleDateString('en-US',{year:'numeric',month:'long',day:'numeric'})}</span>
                    <span>© ${new Date().getFullYear()} Touchstar Medical Enterprises Inc. All rights reserved.</span>
                </div>
            `;
        }
    </script>
</body>
</html>