
{{-- ══════════════════════════════════════
     MODAL 1: Report a Ticket
══════════════════════════════════════ --}}
<div class="tms-overlay" id="tmsReportModal" onclick="tmsHandleOverlay(event,'tmsReportModal')">
  <div class="tms-modal tms-modal-lg" role="dialog" aria-modal="true" aria-labelledby="tms-modal-title">

    {{-- Form state --}}
    <div id="tmsFormState">
      <div class="tms-modal-header">
        <div class="icon-wrap"><i class="ti ti-ticket"></i></div>
        <div>
          <h3 id="tms-modal-title">Report a new ticket</h3>
          <p>Describe your issue clearly so our team can respond quickly.</p>
        </div>
        <button class="tms-close-btn" onclick="tmsCloseReportModal()"><i class="ti ti-x" style="font-size:14px;"></i></button>
      </div>

      <div class="tms-modal-body">

        {{-- Client name + Full name --}}
        <div class="tms-form-row">
          <div class="tms-form-group">
            <label>Subject / Title <span style="color:#ef4444;">*</span></label>
            <input type="text" class="tms-form-control" placeholder="Subject / Title" id="f-subject" />
          </div>
          <div class="tms-form-group">
            <label>Medtech Reported Name <span style="color:#ef4444;">*</span></label>
            <input type="text" class="tms-form-control" placeholder="e.g. Maria Cruz" id="f-name" />
          </div>
        </div>

        {{-- Issue category --}}
        <div class="tms-form-group">
          <label>Issue Category <span style="color:#ef4444;">*</span></label>
          <select class="tms-form-control" id="f-cat" onchange="tmsToggleOther()">
            <option value="">Select category…</option>
            <option>REQUEST PMS/VISIT</option>
            <option>TROUBLESHOOTING/ERROR</option>
            <option>INSTALLATION</option>
            <option>DEMONSTRATION</option>
            <option>MACHINE CALIBRATION</option>
            <option>INTERFACE ERRORS</option>
            <option>RESULT ERROR</option>
            <option>REQUEST FOR EQUIPMENT PULL-OUT</option>
            <option>STARLIS CONCERN</option>
            <option>SAMPLE RUNNING ERRORS</option>
            <option>CONTROL ERRORS</option>
            <option value="Other">Other</option>
          </select>
        </div>

        {{-- Other category (shown when Other is selected) --}}
        <div class="tms-form-group" id="tms-other-container" style="display:none;">
          <label>Please Specify <span style="color:#ef4444;">*</span></label>
          <input type="text" class="tms-form-control" id="f-other-cat" placeholder="Enter issue category" />
        </div>

        {{-- Description --}}
        <div class="tms-form-group">
          <label>Detailed Description <span style="color:#ef4444;">*</span></label>
          <textarea class="tms-form-control" rows="4" placeholder="Describe what happened, when it started, what you've already tried, and any error messages you see…" id="f-desc"></textarea>
          <div class="hint">More detail = faster resolution. Include error codes if applicable.</div>
        </div>

        {{-- Attachments --}}
        <div class="tms-form-group">
          <label>Attachments <span style="color:#94a3b8;font-weight:400;">(optional)</span></label>
          <div class="file-drop" onclick="document.getElementById('f-file').click()">
            <i class="ti ti-cloud-upload"></i>
            <p>Drop files here or <span>click to browse</span></p>
            <p style="margin-top:4px;font-size:11px;color:#94a3b8;">Screenshots, logs, photos — max 10 MB each</p>
            <input type="file" id="f-file" style="display:none;" multiple accept="image/*,.pdf,.log,.txt" onchange="tmsHandleFiles(event)" />
          </div>
          <div id="tms-file-list" style="margin-top:6px;display:flex;flex-direction:column;gap:4px;"></div>
        </div>

      </div>{{-- /modal-body --}}

      <div class="tms-modal-footer">
        <div class="tms-footer-note">
          <i class="ti ti-shield-check" style="font-size:14px;color:#10b981;"></i>
          Your ticket will be assigned a tracking number immediately.
        </div>
        <button class="tms-btn tms-btn-ghost" onclick="tmsCloseReportModal()">Cancel</button>
        <button class="tms-btn tms-btn-primary" onclick="tmsSubmitTicket()">
          <i class="ti ti-send" style="font-size:14px;"></i> Submit ticket
        </button>
      </div>
    </div>{{-- /tmsFormState --}}

    {{-- Success state --}}
    <div class="tms-modal-success" id="tmsSuccessState">
      <div class="success-icon"><i class="ti ti-circle-check"></i></div>
      <h3>Ticket submitted!</h3>
      <p>Your ticket <strong id="tms-new-ticket-id">#TKT-0082</strong> has been created.<br>Our team will respond within your SLA window.<br>You'll receive an update by email.</p>
      <div style="display:flex;gap:8px;">
        <button class="tms-btn tms-btn-outline" onclick="tmsCloseReportModal()">Back to my tickets</button>
        <button class="tms-btn tms-btn-primary" onclick="tmsReportAnother()">
          <i class="ti ti-plus" style="font-size:13px;"></i> Report another
        </button>
      </div>
    </div>

  </div>
</div>


{{-- ══════════════════════════════════════
     MODAL 2: Ticket Detail View
══════════════════════════════════════ --}}
<div class="tms-overlay" id="tmsDetailModal" style="z-index:150;" onclick="tmsHandleOverlay(event,'tmsDetailModal')">
  <div class="tms-modal tms-modal-lg" role="dialog" aria-modal="true">

    <div class="tms-detail-header">
      <button class="dclose" onclick="tmsCloseDetailModal()" style="float:right;background:rgba(243, 241, 241, 0.12);border:none;color:#fff;width:28px;height:28px;border-radius:6px;cursor:pointer;display:flex;align-items:center;justify-content:center;">
        <i class="ti ti-x" style="font-size:14px;"></i>
      </button>
      <div class="did" id="d-id">#TKT-0081</div>
      <div class="dtitle" id="d-title">HIS system unreachable — Emergency Dept.</div>
      <div style="display:flex;gap:6px;margin-top:10px;flex-wrap:wrap;" id="d-tags"></div>
    </div>

    <div class="detail-grid">
      <div class="detail-cell">
        <div class="dlabel">Status</div>
        <div class="dval" id="d-status"></div>
      </div>
      <div class="detail-cell">
        <div class="dlabel">Pending</div>
        <div class="dval" id="d-pending"></div>
      </div>
      <div class="detail-cell">
        <div class="dlabel">Assigned to</div>
        <div class="dval" id="d-assigned"></div>
      </div>
      <div class="detail-cell" style="grid-column:span 2;">
        <div class="dlabel">Category</div>
        <div class="dval" id="d-category"></div>
      </div>
    </div>

    {{-- Activity timeline --}}
    <div class="detail-timeline">
      <h4>Activity timeline</h4>
      <div id="d-timeline"></div>
    </div>

    {{-- Comments section --}}
    <div style="padding:0 24px 4px;border-top:1px solid #f1f5f9;">
      <h4 style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:0.07em;margin:14px 0 10px;">Comments</h4>
    </div>
    <div class="comment-list" id="d-comments">
      {{-- comments injected by JS --}}
    </div>

    <div class="detail-actions">
      <button class="tms-btn tms-btn-primary" style="flex:1;justify-content:center;" onclick="tmsOpenCommentModal()">
        <i class="ti ti-message" style="font-size:14px;"></i> Add comment
      </button>
      <button class="tms-btn tms-btn-danger" onclick="tmsCloseDetailModal()">
        <i class="ti ti-x" style="font-size:14px;"></i> Close
      </button>
    </div>

  </div>
</div>


{{-- ══════════════════════════════════════
     MODAL 3: Add Comment
══════════════════════════════════════ --}}
<div class="tms-overlay comment-modal-overlay" id="tmsCommentModal" onclick="tmsHandleOverlay(event,'tmsCommentModal')">
  <div class="tms-modal tms-modal-sm" role="dialog" aria-modal="true" aria-labelledby="tms-comment-title">

    <div class="tms-modal-header">
      <div class="icon-wrap"><i class="ti ti-message"></i></div>
      <div>
        <h3 id="tms-comment-title">Add a comment</h3>
        <p id="tms-comment-ticket-label">Replying to ticket…</p>
      </div>
      <button class="tms-close-btn" onclick="tmsCloseCommentModal()"><i class="ti ti-x" style="font-size:14px;"></i></button>
    </div>

    <div class="tms-modal-body">
      {{-- Comment type --}}
      <div class="tms-form-group">
        <label>Comment Type</label>
        <select class="tms-form-control" id="c-type">
          <option value="Update">General update</option>
          <option value="Question">Question for IT team</option>
          <option value="Follow-up">Follow-up</option>
          <option value="Additional info">Additional information</option>
        </select>
      </div>

      {{-- Comment body --}}
      <div class="tms-form-group">
        <label>Message <span style="color:#ef4444;">*</span></label>
        <textarea class="tms-form-control" id="c-body" rows="4" placeholder="Write your comment here…"></textarea>
        <div class="hint">Be as specific as possible — error messages, timestamps, and screenshots help.</div>
      </div>

      {{-- Optional attachment --}}
      <div class="tms-form-group">
        <label>Attachment <span style="color:#94a3b8;font-weight:400;">(optional)</span></label>
        <div class="file-drop" onclick="document.getElementById('c-file').click()" style="padding:14px;">
          <i class="ti ti-paperclip" style="font-size:20px;"></i>
          <p>Click to attach a file</p>
          <p style="font-size:11px;color:#94a3b8;margin-top:2px;">Images, PDFs or logs — max 10 MB</p>
          <input type="file" id="c-file" style="display:none;" accept="image/*,.pdf,.log,.txt" onchange="tmsHandleCommentFile(event)" />
        </div>
        <div id="c-file-preview" style="margin-top:6px;display:flex;flex-direction:column;gap:4px;"></div>
      </div>

    </div>

    <div class="tms-modal-footer">
      <div class="tms-footer-note">
        <i class="ti ti-eye" style="font-size:14px;color:#60a5fa;"></i>
        Visible to the assigned Service Staff.
      </div>
      <button class="tms-btn tms-btn-ghost" onclick="tmsCloseCommentModal()">Cancel</button>
      <button class="tms-btn tms-btn-success" onclick="tmsSubmitComment()">
        <i class="ti ti-send" style="font-size:14px;"></i> Post comment
      </button>
    </div>

  </div>
</div>