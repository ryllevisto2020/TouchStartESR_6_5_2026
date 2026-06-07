<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CSAT Survey — Touchstar Medical</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@3.19.0/dist/tabler-icons.min.css">
<style>
*{box-sizing:border-box;margin:0;padding:0}
:root{--navy:#1565c0;--gold:#C9A84C;--gold-pale:#FBF6E9;--radius-md:8px;--radius-lg:12px}
body{font-family:'DM Sans',system-ui,sans-serif;background:#f0f4fa;min-height:100vh;display:flex;align-items:flex-start;justify-content:center;padding:2rem 1rem 4rem}
.survey-wrap{max-width:720px;width:100%}
.header-bar{background:var(--navy);border-radius:var(--radius-lg) var(--radius-lg) 0 0;border-bottom:3px solid var(--gold);padding:1.75rem 2rem}
.header-logo-row{display:flex;align-items:flex-start;justify-content:space-between;gap:1rem}
.org-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(201,168,76,0.18);border:1px solid rgba(201,168,76,0.4);color:#F3E6B2;font-size:10px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;padding:4px 12px;border-radius:999px;margin-bottom:8px}
.header-title{font-size:1.6rem;font-weight:500;color:#fff;line-height:1.2}
.header-sub{font-size:0.82rem;color:rgba(255,255,255,0.65);margin-top:6px;line-height:1.6;max-width:420px}
.chips{display:flex;flex-wrap:wrap;gap:8px;margin-top:1rem}
.chip{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,0.1);border:1px solid rgba(255,255,255,0.2);color:rgba(255,255,255,0.8);font-size:11px;padding:4px 10px;border-radius:999px}
.chip i{color:var(--gold);font-size:13px}
.card-body{background:#fff;border:0.5px solid #e2e8f0;border-top:none;border-radius:0 0 var(--radius-lg) var(--radius-lg);padding:1.75rem 2rem}
.legend-bar{display:flex;flex-wrap:wrap;gap:10px;background:#f8f9fa;border:0.5px solid #e2e8f0;border-radius:var(--radius-md);padding:.7rem 1rem;margin-bottom:1.5rem}
.legend-bar span{font-size:11px;color:#64748b;display:flex;align-items:center;gap:4px}
.legend-bar .star-txt{color:var(--gold);font-size:13px}
.section-label{display:flex;align-items:center;gap:8px;margin-bottom:1rem}
.section-label span{font-size:10px;font-weight:600;letter-spacing:0.16em;text-transform:uppercase;color:var(--gold)}
.section-label hr{flex:1;border:none;height:0.5px;background:#e2e8f0}
.question-list{border:0.5px solid #e2e8f0;border-radius:var(--radius-md);overflow:hidden;margin-bottom:1.5rem}
.q-row{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;padding:.9rem 1.1rem;border-bottom:0.5px solid #f0f2f6;background:#fff;transition:background .15s}
.q-row:last-child{border-bottom:none}
.q-row:hover{background:#f8f9fa}
.q-left{display:flex;align-items:center;gap:.75rem;flex:1;min-width:0}
.q-num{width:26px;height:26px;border-radius:50%;background:var(--navy);color:#fff;font-size:11px;font-weight:500;display:flex;align-items:center;justify-content:center;flex-shrink:0}
.q-text{font-size:.835rem;color:#1f2a3f;line-height:1.4}
.q-sub{font-size:.72rem;color:#64748b;font-style:normal;margin-left:4px}
.star-group{display:flex;gap:3px;flex-direction:row-reverse}
.star-group input{display:none}
.star-group label{cursor:pointer;font-size:1.5rem;color:#DDE1EA;transition:color .15s;line-height:1}
.star-group input:checked ~ label,
.star-group label:hover,
.star-group label:hover ~ label{color:var(--gold)}
.overall-box{background:#f8f9fa;border:0.5px solid rgba(201,168,76,0.3);border-radius:var(--radius-md);padding:1rem 1.25rem;margin-bottom:1.5rem}
.overall-box .q-row{background:transparent;border-color:rgba(201,168,76,0.15);padding:.75rem 0}
.overall-box .q-row:first-child{padding-top:0}
.overall-box .q-row:last-child{border-bottom:none;padding-bottom:0}
.overall-box .q-text{font-weight:500}
textarea{width:100%;border:0.5px solid #cbd5e0;border-radius:var(--radius-md);padding:.65rem .85rem;font-size:.84rem;color:#1f2a3f;background:#f8f9fa;resize:none;transition:border-color .2s;font-family:inherit;line-height:1.5}
textarea:focus{outline:none;border-color:var(--gold);background:#fff;box-shadow:0 0 0 3px rgba(201,168,76,0.12)}
.txt-label{font-size:10px;font-weight:600;letter-spacing:.1em;text-transform:uppercase;color:#64748b;margin-bottom:6px;display:flex;align-items:center;gap:8px}
.opt-pill{font-size:10px;background:rgba(201,168,76,0.1);border:0.5px solid rgba(201,168,76,0.35);color:#9A7D34;padding:2px 8px;border-radius:999px;font-weight:500;text-transform:lowercase;letter-spacing:0}
.textarea-wrap{margin-bottom:.9rem}
.contact-row{margin-bottom:1.5rem}
.contact-q{font-size:.84rem;font-weight:500;color:#1f2a3f;margin-bottom:.6rem}
.pill-group{display:flex;gap:.5rem}
.cpill{display:inline-flex;align-items:center;padding:.4rem 1.4rem;border-radius:999px;border:0.5px solid #cbd5e0;font-size:.84rem;font-weight:500;color:#2d4059;cursor:pointer;transition:all .15s}
.cpill input{display:none}
.cpill.active{background:var(--navy);border-color:var(--navy);color:#fff}
.contact-fields{display:none;grid-template-columns:1fr 1fr;gap:.75rem;margin-top:.75rem}
.contact-fields.show{display:grid}
.cf-group label{font-size:10px;font-weight:600;text-transform:uppercase;letter-spacing:.08em;color:#64748b;display:block;margin-bottom:4px}
.cf-group input{width:100%;border:none;border-bottom:1px solid var(--navy);background:transparent;padding:.4rem 0;font-size:.84rem;color:#1f2a3f;font-family:inherit}
.cf-group input:focus{outline:none;border-bottom-width:2px}
.err-bar{display:none;align-items:center;gap:.5rem;background:#FEF2F2;border:0.5px solid #fca5a5;color:#991b1b;border-radius:var(--radius-md);padding:.7rem 1rem;font-size:.84rem;margin-bottom:1rem}
.err-bar.show{display:flex}
.submit-bar{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:.75rem;padding-top:1.25rem;border-top:0.5px solid #e2e8f0}
.privacy-note{font-size:.72rem;color:#64748b;display:flex;align-items:center;gap:6px}
.privacy-note i{color:#059669;font-size:15px}
.submit-btn{display:inline-flex;align-items:center;gap:6px;padding:.55rem 1.5rem;border-radius:999px;background:var(--navy);color:#fff;font-size:.82rem;font-weight:500;letter-spacing:.08em;text-transform:uppercase;border:none;cursor:pointer;transition:opacity .2s,transform .2s}
.submit-btn:hover{opacity:.88;transform:translateY(-1px)}
.submit-btn:disabled{opacity:.55;pointer-events:none}
.success-bar{display:none;align-items:center;gap:.75rem;background:#ECFDF5;border:0.5px solid #6ee7b7;color:#065f46;border-radius:var(--radius-md);padding:.9rem 1.1rem;font-size:.84rem;font-weight:500;margin-top:1rem}
.success-bar.show{display:flex}
.success-icon{width:28px;height:28px;border-radius:50%;background:var(--navy);color:var(--gold);display:flex;align-items:center;justify-content:center;font-size:14px;flex-shrink:0}
.progress-bar-wrap{height:4px;background:#e2e8f0;border-radius:999px;margin-bottom:1.5rem;overflow:hidden}
.progress-fill{height:100%;background:var(--gold);border-radius:999px;transition:width .3s ease;width:0%}
.rating-error .star-group label{color:#fca5a5 !important}
@keyframes spin{to{transform:rotate(360deg)}}
</style>
</head>
<body>

<div class="survey-wrap">
  <div class="header-bar">
    <div class="header-logo-row">
      <div>
        <div class="org-badge"><i class="ti ti-star"></i> Technical Services Division</div>
        <div class="header-title">Post-Service Customer<br>Satisfaction Survey</div>
        <div class="header-sub">Your insight helps us refine our medical service excellence — it takes less than 2 minutes.</div>
      </div>
      <button onclick="handleClose()" style="background:rgba(255,255,255,0.1);border:0.5px solid rgba(255,255,255,0.25);border-radius:50%;width:34px;height:34px;color:#fff;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0" aria-label="Close survey">
        <i class="ti ti-x" style="font-size:14px"></i>
      </button>
    </div>
    <div class="chips">
      <span class="chip"><i class="ti ti-building-hospital"></i> Metro General Hospital</span>
      <span class="chip"><i class="ti ti-user"></i> Eng. R. Santos</span>
      <span class="chip"><i class="ti ti-calendar"></i> June 7, 2025</span>
    </div>
  </div>

  <div class="card-body">
    <div class="progress-bar-wrap"><div class="progress-fill" id="progressFill"></div></div>

    <div class="legend-bar">
      <span><span class="star-txt">★</span> Very dissatisfied</span>
      <span><span class="star-txt">★★</span> Dissatisfied</span>
      <span><span class="star-txt">★★★</span> Neutral</span>
      <span><span class="star-txt">★★★★</span> Satisfied</span>
      <span><span class="star-txt">★★★★★</span> Very satisfied</span>
    </div>

    <form id="csatForm" novalidate>

      <!-- SERVICE PERFORMANCE -->
      <div class="section-label"><span>Service performance evaluation</span><hr></div>
      <div class="question-list">

        <div class="q-row" id="row-perf1">
          <div class="q-left"><span class="q-num">1</span><span class="q-text">Service team responded promptly within SLA</span></div>
          <div class="star-group" data-name="perf1" data-required="true">
            <input type="radio" name="perf1" id="p1-5" value="5"><label for="p1-5" title="5 stars">★</label>
            <input type="radio" name="perf1" id="p1-4" value="4"><label for="p1-4" title="4 stars">★</label>
            <input type="radio" name="perf1" id="p1-3" value="3"><label for="p1-3" title="3 stars">★</label>
            <input type="radio" name="perf1" id="p1-2" value="2"><label for="p1-2" title="2 stars">★</label>
            <input type="radio" name="perf1" id="p1-1" value="1"><label for="p1-1" title="1 star">★</label>
          </div>
        </div>

        <div class="q-row" id="row-perf2">
          <div class="q-left"><span class="q-num">2</span><span class="q-text">Issue was resolved correctly during first visit</span></div>
          <div class="star-group" data-name="perf2" data-required="true">
            <input type="radio" name="perf2" id="p2-5" value="5"><label for="p2-5">★</label>
            <input type="radio" name="perf2" id="p2-4" value="4"><label for="p2-4">★</label>
            <input type="radio" name="perf2" id="p2-3" value="3"><label for="p2-3">★</label>
            <input type="radio" name="perf2" id="p2-2" value="2"><label for="p2-2">★</label>
            <input type="radio" name="perf2" id="p2-1" value="1"><label for="p2-1">★</label>
          </div>
        </div>

        <div class="q-row" id="row-perf3">
          <div class="q-left"><span class="q-num">3</span><span class="q-text">Service engineer was professional and courteous</span></div>
          <div class="star-group" data-name="perf3" data-required="true">
            <input type="radio" name="perf3" id="p3-5" value="5"><label for="p3-5">★</label>
            <input type="radio" name="perf3" id="p3-4" value="4"><label for="p3-4">★</label>
            <input type="radio" name="perf3" id="p3-3" value="3"><label for="p3-3">★</label>
            <input type="radio" name="perf3" id="p3-2" value="2"><label for="p3-2">★</label>
            <input type="radio" name="perf3" id="p3-1" value="1"><label for="p3-1">★</label>
          </div>
        </div>

        <div class="q-row" id="row-perf4">
          <div class="q-left"><span class="q-num">4</span><span class="q-text">Engineer demonstrated strong technical knowledge</span></div>
          <div class="star-group" data-name="perf4" data-required="true">
            <input type="radio" name="perf4" id="p4-5" value="5"><label for="p4-5">★</label>
            <input type="radio" name="perf4" id="p4-4" value="4"><label for="p4-4">★</label>
            <input type="radio" name="perf4" id="p4-3" value="3"><label for="p4-3">★</label>
            <input type="radio" name="perf4" id="p4-2" value="2"><label for="p4-2">★</label>
            <input type="radio" name="perf4" id="p4-1" value="1"><label for="p4-1">★</label>
          </div>
        </div>

        <div class="q-row" id="row-perf5">
          <div class="q-left"><span class="q-num">5</span><span class="q-text">Preventive maintenance was performed thoroughly <em class="q-sub">(if applicable)</em></span></div>
          <div class="star-group" data-name="perf5" data-required="false">
            <input type="radio" name="perf5" id="p5-5" value="5"><label for="p5-5">★</label>
            <input type="radio" name="perf5" id="p5-4" value="4"><label for="p5-4">★</label>
            <input type="radio" name="perf5" id="p5-3" value="3"><label for="p5-3">★</label>
            <input type="radio" name="perf5" id="p5-2" value="2"><label for="p5-2">★</label>
            <input type="radio" name="perf5" id="p5-1" value="1"><label for="p5-1">★</label>
          </div>
        </div>

        <div class="q-row" id="row-perf6">
          <div class="q-left"><span class="q-num">6</span><span class="q-text">Findings and recommendations were clearly explained</span></div>
          <div class="star-group" data-name="perf6" data-required="true">
            <input type="radio" name="perf6" id="p6-5" value="5"><label for="p6-5">★</label>
            <input type="radio" name="perf6" id="p6-4" value="4"><label for="p6-4">★</label>
            <input type="radio" name="perf6" id="p6-3" value="3"><label for="p6-3">★</label>
            <input type="radio" name="perf6" id="p6-2" value="2"><label for="p6-2">★</label>
            <input type="radio" name="perf6" id="p6-1" value="1"><label for="p6-1">★</label>
          </div>
        </div>

        <div class="q-row" id="row-perf7">
          <div class="q-left"><span class="q-num">7</span><span class="q-text">Service report and documentation was accurate and complete</span></div>
          <div class="star-group" data-name="perf7" data-required="true">
            <input type="radio" name="perf7" id="p7-5" value="5"><label for="p7-5">★</label>
            <input type="radio" name="perf7" id="p7-4" value="4"><label for="p7-4">★</label>
            <input type="radio" name="perf7" id="p7-3" value="3"><label for="p7-3">★</label>
            <input type="radio" name="perf7" id="p7-2" value="2"><label for="p7-2">★</label>
            <input type="radio" name="perf7" id="p7-1" value="1"><label for="p7-1">★</label>
          </div>
        </div>

      </div>

      <!-- OVERALL SCORES -->
      <div class="section-label"><span>Overall scores</span><hr></div>
      <div class="overall-box">
        <div class="q-row" id="row-overall1">
          <div class="q-left"><span class="q-text">Overall satisfaction with the service</span></div>
          <div class="star-group" data-name="overall1" data-required="true">
            <input type="radio" name="overall1" id="o1-5" value="5"><label for="o1-5">★</label>
            <input type="radio" name="overall1" id="o1-4" value="4"><label for="o1-4">★</label>
            <input type="radio" name="overall1" id="o1-3" value="3"><label for="o1-3">★</label>
            <input type="radio" name="overall1" id="o1-2" value="2"><label for="o1-2">★</label>
            <input type="radio" name="overall1" id="o1-1" value="1"><label for="o1-1">★</label>
          </div>
        </div>
        <div class="q-row" id="row-overall2">
          <div class="q-left"><span class="q-text">Likelihood to recommend our service</span></div>
          <div class="star-group" data-name="overall2" data-required="true">
            <input type="radio" name="overall2" id="o2-5" value="5"><label for="o2-5">★</label>
            <input type="radio" name="overall2" id="o2-4" value="4"><label for="o2-4">★</label>
            <input type="radio" name="overall2" id="o2-3" value="3"><label for="o2-3">★</label>
            <input type="radio" name="overall2" id="o2-2" value="2"><label for="o2-2">★</label>
            <input type="radio" name="overall2" id="o2-1" value="1"><label for="o2-1">★</label>
          </div>
        </div>
      </div>

      <!-- YOUR VOICE -->
      <div class="section-label"><span>Your voice</span><hr></div>

      <div class="textarea-wrap">
        <div class="txt-label">What did we do well? <span class="opt-pill">optional</span></div>
        <textarea name="did_well" rows="3" placeholder="Share a highlight…"></textarea>
      </div>
      <div class="textarea-wrap">
        <div class="txt-label">What can we improve? <span class="opt-pill">optional</span></div>
        <textarea name="improve" rows="3" placeholder="Constructive feedback…"></textarea>
      </div>

      <!-- CONTACT -->
      <div class="contact-row">
        <div class="contact-q">May we contact you regarding your feedback?</div>
        <div class="pill-group">
          <label class="cpill" id="pill-yes">
            <input type="radio" name="contact" value="yes" onchange="toggleContact('yes')"> Yes
          </label>
          <label class="cpill active" id="pill-no">
            <input type="radio" name="contact" value="no" checked onchange="toggleContact('no')"> No
          </label>
        </div>
        <div class="contact-fields" id="contactFields">
          <div class="cf-group">
            <label>Name</label>
            <input type="text" name="contact_name" placeholder="Your name">
          </div>
          <div class="cf-group">
            <label>Contact / email</label>
            <input type="text" name="contact_info" placeholder="Phone or email">
          </div>
        </div>
      </div>

      <!-- ERROR -->
      <div class="err-bar" id="errBar">
        <i class="ti ti-alert-circle"></i>
        <span id="errMsg">Please complete all required star ratings before submitting.</span>
      </div>

      <!-- SUBMIT -->
      <div class="submit-bar">
        <p class="privacy-note"><i class="ti ti-shield-check"></i> Confidential — used only for quality improvement</p>
        <button type="submit" class="submit-btn" id="submitBtn">
          Submit survey <i class="ti ti-arrow-right"></i>
        </button>
      </div>

      <div class="success-bar" id="successBar">
        <div class="success-icon"><i class="ti ti-check"></i></div>
        Thank you! Your feedback has been recorded successfully.
      </div>

    </form>
  </div>
</div>

<script>
const REQUIRED = ['perf1','perf2','perf3','perf4','perf6','perf7','overall1','overall2'];

function updateProgress() {
  const rated = REQUIRED.filter(n => document.querySelector(`input[name="${n}"]:checked`)).length;
  document.getElementById('progressFill').style.width = Math.round((rated / REQUIRED.length) * 100) + '%';
}

document.querySelectorAll('.star-group input').forEach(function(inp) {
  inp.addEventListener('change', function() {
    const row = document.getElementById('row-' + this.name);
    if (row) row.querySelector('.star-group').classList.remove('rating-error');
    hideErr();
    updateProgress();
  });
});

function toggleContact(val) {
  const yes = document.getElementById('pill-yes');
  const no  = document.getElementById('pill-no');
  const fields = document.getElementById('contactFields');
  if (val === 'yes') {
    yes.classList.add('active');
    no.classList.remove('active');
    fields.classList.add('show');
  } else {
    no.classList.add('active');
    yes.classList.remove('active');
    fields.classList.remove('show');
  }
}

function showErr(msg) {
  const b = document.getElementById('errBar');
  document.getElementById('errMsg').textContent = msg;
  b.classList.add('show');
}

function hideErr() {
  document.getElementById('errBar').classList.remove('show');
}

document.getElementById('csatForm').addEventListener('submit', function(e) {
  e.preventDefault();

  const missing = REQUIRED.filter(n => !document.querySelector(`input[name="${n}"]:checked`));

  if (missing.length) {
    missing.forEach(function(n) {
      const row = document.getElementById('row-' + n);
      if (row) row.querySelector('.star-group').classList.add('rating-error');
    });
    showErr('Please rate all ' + missing.length + ' required field' + (missing.length > 1 ? 's' : '') + ' before submitting.');
    const firstMissing = document.getElementById('row-' + missing[0]);
    if (firstMissing) firstMissing.scrollIntoView({ behavior: 'smooth', block: 'center' });
    return;
  }

  hideErr();

  const btn = document.getElementById('submitBtn');
  btn.disabled = true;
  btn.innerHTML = '<i class="ti ti-loader-2" style="animation:spin 1s linear infinite"></i> Submitting…';

  /* ── Replace the setTimeout below with your actual fetch() call ── */
  setTimeout(function() {
    btn.style.display = 'none';
    document.getElementById('successBar').classList.add('show');
    document.getElementById('progressFill').style.width = '100%';
  }, 1200);

  /*
  LARAVEL BACKEND WIRING (drop in to replace the setTimeout above):

  const SUBMIT_URL = '/client/csat/{serviceRecord}';
  const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

  fetch(SUBMIT_URL, {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' },
    body: new FormData(this),
  })
  .then(res => res.json().then(data => ({ ok: res.ok, data })))
  .then(({ ok, data }) => {
    if (ok) {
      btn.style.display = 'none';
      document.getElementById('successBar').classList.add('show');
      document.getElementById('progressFill').style.width = '100%';
      setTimeout(() => { window.location.href = '/client/landing'; }, 2500);
    } else {
      showErr(data.message ?? 'Something went wrong. Please try again.');
      btn.disabled = false;
      btn.innerHTML = 'Submit survey <i class="ti ti-arrow-right"></i>';
    }
  })
  .catch(() => {
    showErr('Network error. Please check your connection and try again.');
    btn.disabled = false;
    btn.innerHTML = 'Submit survey <i class="ti ti-arrow-right"></i>';
  });
  */
});

function handleClose() {
  window.history.back();
}
</script>
</body>
</html>