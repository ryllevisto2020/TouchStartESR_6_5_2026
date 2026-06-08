<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Report - MediTech Solutions</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { 'sans': ['Inter', 'system-ui', 'sans-serif'] }
                }
            }
        }
        const urlParams = new URLSearchParams(window.location.search);
        const reportId = urlParams.get('id');
        document.title = `Service Report #${reportId} - Touchstar Medical`;
    </script>

    <style>
        /* ── SCREEN ── */
        @media screen {
            body { background: #E5E7EB; }
            .print-container {
                max-width: 210mm;
                margin: 4rem auto 2rem;
                background: white;
                box-shadow: 0 20px 25px -5px rgba(0,0,0,.15);
            }
        }

        /* ── PRINT ── */
        @media print {
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
            .no-print { display: none !important; }
            .print-container { box-shadow: none !important; margin: 0 !important; max-width: 100% !important; }
            body { margin: 0; padding: 0; }
            @page { size: A4; margin: 8mm 10mm; }

            * { page-break-inside: avoid; }
        }

        /* ── COMPACT BASE ── */
        .report-body { font-size: 20px; line-height: 1.4; }

        /* Section header bar */
        .sec-hdr {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 4px;
        }
        .sec-icon {
            width: 20px; height: 20px;
            border-radius: 4px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        .sec-icon i { font-size: 11px; color: white; }
        .sec-title { font-size: 13px; font-weight: 700; color: #111827; }

        /* Field label + value */
        .field-label {
            font-size: 12px; font-weight: 700;
            color: #2563EB; text-transform: uppercase;
            letter-spacing: .04em; margin-bottom: 2px;
        }
        .field-val {
            font-size: 15px; font-weight: 500; color: #111827;
            background: white; border: 1px solid #D1D5DB;
            border-radius: 5px; padding: 3px 7px;
        }
        .field-val.mono { font-family: monospace; color: #1D4ED8; background: #EFF6FF; border-color: #BFDBFE; }
        .field-val.green { background: #D1FAE5; color: #065F46; border-color: #6EE7B7; }
        .field-val.red   { background: #FEE2E2; color: #991B1B; border-color: #FCA5A5; }

        /* Prose block */
        .prose-block {
            border: 1px solid #E5E7EB;
            border-radius: 6px;
            overflow: hidden;
        }
        .prose-block-hdr {
            background: #F9FAFB;
            border-bottom: 1px solid #E5E7EB;
            padding: 3px 8px;
            font-size: 12px; font-weight: 700;
            color: #374151; text-transform: uppercase; letter-spacing: .05em;
        }
        .prose-block-body {
            padding: 5px 8px;
            font-size: 12px; color: #111827; line-height: 1.5;
        }

        /* Parts table */
        .parts-table { width: 100%; border-collapse: collapse; font-size: 9.5px; }
        .parts-table th {
            background: #F3F4F6; padding: 3px 7px;
            text-align: left; font-weight: 700;
            color: #374151; text-transform: uppercase;
            font-size: 12px; letter-spacing: .04em;
            border-bottom: 1px solid #D1D5DB;
        }
        .parts-table td { padding: 3px 7px; border-bottom: 1px solid #F3F4F6; }
        .parts-table tr:last-child td { border-bottom: none; }

        /* Signature box */
        .sig-box {
            border-radius: 8px; padding: 8px 10px; text-align: center;
        }
        .sig-line { border-top: 1.5px solid #9CA3AF; margin-top: 4px; margin-bottom: 2px; }
    </style>
</head>
<body class="font-sans antialiased" onload="loadReportData()">

    <!-- Action Bar (screen only) -->
    <div class="no-print fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow">
        <div class="max-w-5xl mx-auto px-4 flex justify-between items-center py-2.5">
            <div class="flex items-center gap-2">
                <div class="bg-blue-600 rounded-lg p-1.5">
                    <i class="fas fa-file-medical-alt text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-900">Service Report</p>
                    <p class="text-xs text-gray-500" id="headerReportId">#Loading…</p>
                </div>
            </div>
            <div class="flex gap-2">
                <button onclick="window.print()"
                    class="inline-flex items-center px-4 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition shadow">
                    <i class="fas fa-print mr-1.5"></i> Print
                </button>
                <button onclick="window.close()"
                    class="inline-flex items-center px-4 py-1.5 bg-white hover:bg-gray-50 text-gray-700 text-xs font-semibold rounded-lg border border-gray-300 transition">
                    <i class="fas fa-times mr-1.5"></i> Close
                </button>
            </div>
        </div>
    </div>

    <!-- Print Container -->
    <div class="print-container bg-white">
        <div id="printContent" class="report-body p-6 print:p-0">
            <div class="text-center py-10">
                <i class="fas fa-spinner fa-spin text-3xl text-blue-600 mb-3"></i>
                <p class="text-gray-500 text-sm">Loading report data…</p>
            </div>
        </div>
    </div>

    <script>
        // ── Swap this block with your Laravel Blade syntax ──
        const MOCK_REPORTS = {{ Js::from($client_service_record) }};
        const client_detail = {{ Js::from($client_detail) }};
        const machines = {{ Js::from($machines) }};
        const employee_details = {{ Js::from($employee_details) }};

        function loadReportData() {
            const urlParams = new URLSearchParams(window.location.search);
            const reportId  = parseInt(urlParams.get('id'));
            const report    = MOCK_REPORTS.find(r => r.id === reportId);
            const machine_name = machines.find(r => r.id === report.machine_id).name;
            const model = machines.find(r => r.id === report.machine_id).model;
            const serial_number = machines.find(r => r.id === report.machine_id).serial_number;
            const emp_signature = employee_details.find(r => r.emp_id === report.completed_by_user_id).emp_signature;

            if (!report) {
                document.getElementById('printContent').innerHTML = `
                    <div class="text-center py-10">
                        <i class="fas fa-exclamation-triangle text-3xl text-red-500 mb-3"></i>
                        <p class="font-semibold text-gray-800">Report #${reportId} not found.</p>
                        <button onclick="window.close()" class="mt-3 px-3 py-1.5 bg-gray-200 hover:bg-gray-300 rounded text-xs">Close</button>
                    </div>`;
                return;
            }

            document.getElementById('headerReportId').textContent = `#${report.id}`;

            /* ── Helpers ── */
            const serviceTypes = (() => {
                try {
                    const p = JSON.parse(report.service_type);
                    return Array.isArray(p) ? p.join(', ') : p;
                } catch { return report.service_type; }
            })();

            const parts = (() => {
                try { return JSON.parse(report.parts_replaced) || []; }
                catch { return []; }
            })();

            const statusClass = report.equipment_status === 'Operational' ? 'green' : 'red';
            const medtechSig  = `${window.location.origin}/storage/${report.medtech_signature}`;
            const emp_sig = `${window.location.origin}/storage/${emp_signature}`

            /* ── Parts table ── */
            const partsHtml = parts.length ? `
                <div style="margin-top:10px;">
                    <div class="sec-hdr">
                        <div class="sec-icon" style="background:linear-gradient(135deg,#F97316,#DC2626)">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <span class="sec-title">Parts Replaced</span>
                    </div>
                    <div style="border:1px solid #E5E7EB;border-radius:6px;overflow:hidden;">
                        <table class="parts-table">
                            <thead>
                                <tr><th>Qty</th><th>Particulars</th><th>SI / DR No.</th></tr>
                            </thead>
                            <tbody>
                                ${parts.map(p => `
                                    <tr>
                                        <td style="font-weight:700;">${p.qty || ''}</td>
                                        <td>${p.particulars || ''}</td>
                                        <td style="font-family:monospace;">${p.si_dr_no || ''}</td>
                                    </tr>`).join('')}
                            </tbody>
                        </table>
                    </div>
                </div>` : '';

            /* ── Render ── */
            document.getElementById('printContent').innerHTML = `

                <!-- ═══ HEADER ═══ -->
                <div style="display:flex;align-items:center;justify-content:space-between;padding-bottom:8px;margin-bottom:8px;border-bottom:3px solid #1D4ED8;">
                    <img src="/images/logo.png" alt="Touchstar" style="height:52px;object-fit:contain;"
                        onerror="this.style.display='none';">
                    <div style="text-align:center;flex:1;padding:0 12px;">
                        <div style="font-size:15px;font-weight:900;color:#1D4ED8;text-transform:uppercase;letter-spacing:.08em;">
                            Touchstar Medical Enterprises Inc.
                        </div>
                        <div style="font-size:11px;font-weight:700;color:#374151;margin-top:1px;">SERVICE REPORT</div>
                    </div>
                    <div style="text-align:right;min-width:110px;">
                        <div style="font-size:9px;color:#6B7280;font-weight:600;text-transform:uppercase;">Report No.</div>
                        <div style="font-size:14px;font-weight:900;color:#1D4ED8;">#${report.id}</div>
                        <div style="font-size:9px;color:#6B7280;margin-top:1px;">${report.service_date}</div>
                    </div>
                </div>

                <!-- ═══ ROW 1: Machine Info + Service Info side by side ═══ -->
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">

                    <!-- Machine Info -->
                    <div>
                        <div class="sec-hdr">
                            <div class="sec-icon" style="background:linear-gradient(135deg,#3B82F6,#2563EB)">
                                <i class="fas fa-laptop-medical"></i>
                            </div>
                            <span class="sec-title">Machine Information</span>
                        </div>
                        <div style="background:#F8FAFC;border:1px solid #E2E8F0;border-radius:6px;padding:8px;display:grid;grid-template-columns:1fr 1fr;gap:6px;">
                            <div>
                                <div class="field-label">Client / Location</div>
                                <div class="field-val">${client_detail.client_name}</div>
                            </div>
                            <div>
                                <div class="field-label">Machine Name</div>
                                <div class="field-val">${machine_name}</div>
                            </div>
                            <div>
                                <div class="field-label">Model</div>
                                <div class="field-val">${model}</div>
                            </div>
                            <div>
                                <div class="field-label">Serial Number</div>
                                <div class="field-val mono">${serial_number}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Info -->
                    <div>
                        <div class="sec-hdr">
                            <div class="sec-icon" style="background:linear-gradient(135deg,#10B981,#059669)">
                                <i class="fas fa-tools"></i>
                            </div>
                            <span class="sec-title">Service Information</span>
                        </div>
                        <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:6px;padding:8px;display:grid;grid-template-columns:1fr 1fr;gap:6px;">
                            <div>
                                <div class="field-label">Service Type</div>
                                <div class="field-val" style="word-break:break-word;">${serviceTypes}</div>
                            </div>
                            <div>
                                <div class="field-label">Service Engineer</div>
                                <div class="field-val">${report.service_engineer}</div>
                            </div>
                            <div>
                                <div class="field-label">Equipment Status</div>
                                <div class="field-val ${statusClass}">${report.equipment_status}</div>
                            </div>
                            <div>
                                <div class="field-label">Approved By</div>
                                <div class="field-val">${report.approved_by}</div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- ═══ SERVICE DETAILS ═══ -->
                <div style="margin-bottom:10px;">
                    <div class="sec-hdr">
                        <div class="sec-icon" style="background:linear-gradient(135deg,#8B5CF6,#7C3AED)">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <span class="sec-title">Service Details</span>
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:6px;">
                        ${report.identification_verification ? `
                        <div class="prose-block">
                            <div class="prose-block-hdr">Identification / Verification</div>
                            <div class="prose-block-body">${report.identification_verification}</div>
                        </div>` : ''}
                        <div class="prose-block">
                            <div class="prose-block-hdr">Root Cause / Findings</div>
                            <div class="prose-block-body">${report.root_cause_findings}</div>
                        </div>
                        <div class="prose-block">
                            <div class="prose-block-hdr">Action Taken</div>
                            <div class="prose-block-body">${report.action_taken}</div>
                        </div>
                        ${report.recommendations ? `
                        <div class="prose-block">
                            <div class="prose-block-hdr">Recommendations</div>
                            <div class="prose-block-body">${report.recommendations}</div>
                        </div>` : ''}
                    </div>
                </div>

                <!-- ═══ PARTS (if any) ═══ -->
                ${partsHtml}

                <!-- ═══ SIGNATURES ═══ -->
                <div style="margin-top:12px;padding-top:8px;border-top:2px solid #E5E7EB;">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">

                        <!-- MedTech -->
                        <div class="sig-box" style="background:#EFF6FF;border:1.5px solid #BFDBFE;">
                            <div style="font-size:8px;font-weight:700;color:#1D4ED8;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">
                                Approved By (MedTech)
                            </div>
                            <div style="height:56px;display:flex;align-items:center;justify-content:center;background:white;border-radius:5px;overflow:hidden;">
                                <img src="${medtechSig}" style="max-height:52px;max-width:100%;object-fit:contain;"
                                    onerror="this.parentElement.innerHTML='<span style=color:#9CA3AF;font-size:9px;>No signature</span>';">
                            </div>
                            <div class="sig-line"></div>
                            <div style="font-size:10px;font-weight:700;color:#111827;">${report.approved_by}</div>
                            <div style="font-size:8.5px;color:#6B7280;">Medical Technologist</div>
                        </div>

                        <!-- Service Engineer -->
                        <div class="sig-box" style="background:#F0FDF4;border:1.5px solid #BBF7D0;">
                            <div style="font-size:8px;font-weight:700;color:#059669;text-transform:uppercase;letter-spacing:.05em;margin-bottom:4px;">
                                Service Engineer
                            </div>
                            <div style="height:56px;display:flex;align-items:center;justify-content:center;background:white;border-radius:5px;">
                                <img src="${emp_sig}" style="max-height:52px;max-width:100%;object-fit:contain;"
                                    onerror="this.parentElement.innerHTML='<span style=color:#9CA3AF;font-size:9px;>No signature</span>';">
                            </div>
                            <div class="sig-line"></div>
                            <div style="font-size:10px;font-weight:700;color:#111827;">${report.service_engineer}</div>
                            <div style="font-size:8.5px;color:#6B7280;">Service Engineer</div>
                        </div>

                    </div>
                </div>

                <!-- ═══ FOOTER ═══ -->
                <div style="margin-top:8px;padding-top:5px;border-top:1px solid #E5E7EB;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:12px;color:#9CA3AF;">
                        Generated: ${new Date().toLocaleDateString('en-US', { year:'numeric', month:'long', day:'numeric' })}
                    </span>
                    <span style="font-size:12px;color:#9CA3AF;">
                        © ${new Date().getFullYear()} Touchstar Medical Enterprises Inc. All rights reserved.
                    </span>
                </div>
            `;
        }
    </script>
</body>
</html>
