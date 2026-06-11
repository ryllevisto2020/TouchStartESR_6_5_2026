{{--
    survey/rate.blade.php
    Self-contained CSAT modal — include once in layouts/client.blade.php
    All functions are namespaced under "csat_" to avoid collisions with
    other modals or JS on the page.
--}}

<div
    id="csatModalOverlay"
    onclick="csat_handleOverlayClick(event)"
    class="hidden fixed inset-0 z-[999] bg-[#0B1F3A]/70 items-center justify-center p-4"
    style="will-change: opacity;"
>
    <div
        id="csatModalCard"
        class="w-full max-w-[720px] max-h-[92vh] overflow-y-auto bg-white rounded-[28px] shadow-2xl"
        style="scrollbar-width:thin; scrollbar-color:#C9A84C #F0F4FA; will-change: transform, opacity;"
    >

        {{-- Header --}}
        <div class="relative bg-gradient-to-br from-[#1565c0] to-[#0d47a1] rounded-t-[28px] px-8 py-7 border-b-[3px] border-[#C9A84C] overflow-hidden">
            <div class="absolute -top-14 -right-10 w-64 h-64 rounded-full bg-[#C9A84C]/10 pointer-events-none"></div>
            <div class="relative z-10 flex items-start justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-1.5 bg-[#C9A84C]/20 border border-[#C9A84C]/40 text-[#F3E6B2] text-[9px] font-bold tracking-[.14em] uppercase px-3 py-1 rounded-full mb-2">
                        <svg class="w-2.5 h-2.5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        Technical Services Division
                    </div>
                    <h2 class="font-serif text-[1.55rem] text-white leading-snug">Post-Service Customer<br>Satisfaction Survey</h2>
                    <p class="text-[.78rem] text-white/65 mt-1.5 leading-relaxed max-w-sm">Your insight helps us refine our medical service excellence — takes less than 2 minutes.</p>
                </div>
                <button
                    onclick="csat_close()"
                    class="w-8 h-8 rounded-full bg-white/10 border border-white/20 text-white text-sm flex items-center justify-center hover:bg-[#C9A84C] hover:text-[#0B1F3A] hover:border-[#C9A84C] hover:rotate-90 transition-all flex-shrink-0"
                >✕</button>
            </div>
            <div class="relative z-10 flex flex-wrap gap-1.5 mt-4">
                <span class="inline-flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/80 text-[11px] px-2.5 py-1 rounded-full">
                    <svg class="w-3 h-3 fill-none stroke-[#C9A84C]" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/></svg>
                    Metro General Hospital
                </span>
                <span class="inline-flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/80 text-[11px] px-2.5 py-1 rounded-full">
                    <svg class="w-3 h-3 fill-none stroke-[#C9A84C]" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Eng. R. Santos
                </span>
                <span class="inline-flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/80 text-[11px] px-2.5 py-1 rounded-full">
                    <svg class="w-3 h-3 fill-none stroke-[#C9A84C]" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    June 5, 2025
                </span>
            </div>
        </div>

        {{-- Body --}}
        <div class="px-8 py-7">

            {{-- Progress --}}
            <div class="h-1 bg-slate-200 rounded-full mb-6 overflow-hidden">
                <div id="csatProgressFill" class="h-full bg-gradient-to-r from-[#C9A84C] to-yellow-400 rounded-full w-0 transition-all duration-300"></div>
            </div>

            {{-- Legend --}}
            <div class="flex flex-wrap gap-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 mb-5 text-[10.5px] text-slate-500">
                <span class="flex items-center gap-1"><span class="text-[#C9A84C] text-xs">★</span> Very dissatisfied</span>
                <span class="flex items-center gap-1"><span class="text-[#C9A84C] text-xs">★★</span> Dissatisfied</span>
                <span class="flex items-center gap-1"><span class="text-[#C9A84C] text-xs">★★★</span> Neutral</span>
                <span class="flex items-center gap-1"><span class="text-[#C9A84C] text-xs">★★★★</span> Satisfied</span>
                <span class="flex items-center gap-1"><span class="text-[#C9A84C] text-xs">★★★★★</span> Very satisfied</span>
            </div>

            <form id="csatSurveyForm" novalidate>

                {{-- Performance --}}
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[9.5px] font-bold tracking-[.16em] uppercase text-[#C9A84C] whitespace-nowrap">Service performance evaluation</span>
                    <hr class="flex-1 border-none h-px bg-gradient-to-r from-[#C9A84C]/40 to-transparent">
                </div>
                <div class="border border-slate-200 rounded-xl overflow-hidden divide-y divide-slate-50 mb-5">
                    @php
                    $questions = [
                        ['id'=>'csat_p1','label'=>'Service team responded promptly within Service Level Agreement','num'=>1],
                        ['id'=>'csat_p2','label'=>'Issue was resolved correctly during first visit','num'=>2],
                        ['id'=>'csat_p3','label'=>'Service engineer was professional and courteous','num'=>3],
                        ['id'=>'csat_p4','label'=>'Engineer demonstrated strong technical knowledge','num'=>4],
                        ['id'=>'csat_p5','label'=>'Preventive maintenance was performed thoroughly','sub'=>'if applicable','num'=>5,'optional'=>true],
                        ['id'=>'csat_p6','label'=>'Findings and recommendations were clearly explained','num'=>6],
                        ['id'=>'csat_p7','label'=>'Service report and documentation was accurate and complete','num'=>7],
                    ];
                    @endphp
                    @foreach($questions as $q)
                    <div id="row-{{ $q['id'] }}" class="flex items-center justify-between flex-wrap gap-2 px-4 py-3.5 bg-white hover:bg-amber-50/50 transition-colors">
                        <div class="flex items-center gap-3 flex-1">
                            <span class="w-6 h-6 rounded-full bg-[#1565c0] text-white text-[10px] font-semibold flex items-center justify-center flex-shrink-0">{{ $q['num'] }}</span>
                            <span class="text-[.82rem] text-slate-800 leading-snug">
                                {{ $q['label'] }}
                                @isset($q['sub'])<em class="text-slate-400 not-italic text-[.7rem] ml-1">({{ $q['sub'] }})</em>@endisset
                            </span>
                        </div>
                        <div class="csat-stars">
                            @for($s=5;$s>=1;$s--)
                            <input type="radio" name="{{ $q['id'] }}" id="{{ $q['id'] }}-{{ $s }}" value="{{ $s }}">
                            <label for="{{ $q['id'] }}-{{ $s }}">★</label>
                            @endfor
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Overall --}}
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[9.5px] font-bold tracking-[.16em] uppercase text-[#C9A84C] whitespace-nowrap">Overall scores</span>
                    <hr class="flex-1 border-none h-px bg-gradient-to-r from-[#C9A84C]/40 to-transparent">
                </div>
                <div class="bg-slate-50 border border-[#C9A84C]/25 rounded-xl px-4 py-3 divide-y divide-[#C9A84C]/10 mb-5">
                    <div id="row-csat_o1" class="flex items-center justify-between flex-wrap gap-2 py-3 pt-0">
                        <span class="text-[.82rem] font-semibold text-slate-800">Overall satisfaction with the service</span>
                        <div class="csat-stars">
                            <input type="radio" name="csat_o1" id="csat_o1-5" value="5"><label for="csat_o1-5">★</label>
                            <input type="radio" name="csat_o1" id="csat_o1-4" value="4"><label for="csat_o1-4">★</label>
                            <input type="radio" name="csat_o1" id="csat_o1-3" value="3"><label for="csat_o1-3">★</label>
                            <input type="radio" name="csat_o1" id="csat_o1-2" value="2"><label for="csat_o1-2">★</label>
                            <input type="radio" name="csat_o1" id="csat_o1-1" value="1"><label for="csat_o1-1">★</label>
                        </div>
                    </div>
                    <div id="row-csat_o2" class="flex items-center justify-between flex-wrap gap-2 py-3 pb-0">
                        <span class="text-[.82rem] font-semibold text-slate-800">Likelihood to recommend our service</span>
                        <div class="csat-stars">
                            <input type="radio" name="csat_o2" id="csat_o2-5" value="5"><label for="csat_o2-5">★</label>
                            <input type="radio" name="csat_o2" id="csat_o2-4" value="4"><label for="csat_o2-4">★</label>
                            <input type="radio" name="csat_o2" id="csat_o2-3" value="3"><label for="csat_o2-3">★</label>
                            <input type="radio" name="csat_o2" id="csat_o2-2" value="2"><label for="csat_o2-2">★</label>
                            <input type="radio" name="csat_o2" id="csat_o2-1" value="1"><label for="csat_o2-1">★</label>
                        </div>
                    </div>
                </div>

                {{-- Your voice --}}
                <div class="flex items-center gap-2 mb-3">
                    <span class="text-[9.5px] font-bold tracking-[.16em] uppercase text-[#C9A84C] whitespace-nowrap">Your voice</span>
                    <hr class="flex-1 border-none h-px bg-gradient-to-r from-[#C9A84C]/40 to-transparent">
                </div>
                <div class="mb-3">
                    <div class="text-[9.5px] font-bold tracking-[.1em] uppercase text-slate-500 mb-1.5 flex items-center gap-2">
                        What did we do well?
                        <span class="text-[9px] bg-[#C9A84C]/10 border border-[#C9A84C]/30 text-yellow-700 px-2 py-0.5 rounded-full normal-case tracking-normal font-medium">optional</span>
                    </div>
                    <textarea name="did_well" rows="3" placeholder="Share a highlight…"
                        class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-[.82rem] text-slate-800 bg-slate-50 resize-none placeholder:text-slate-400 focus:outline-none focus:border-[#C9A84C] focus:bg-white focus:ring-2 focus:ring-[#C9A84C]/10 transition-all"></textarea>
                </div>
                <div class="mb-5">
                    <div class="text-[9.5px] font-bold tracking-[.1em] uppercase text-slate-500 mb-1.5 flex items-center gap-2">
                        What can we improve?
                        <span class="text-[9px] bg-[#C9A84C]/10 border border-[#C9A84C]/30 text-yellow-700 px-2 py-0.5 rounded-full normal-case tracking-normal font-medium">optional</span>
                    </div>
                    <textarea name="improve" rows="3" placeholder="Constructive feedback…"
                        class="w-full border border-slate-300 rounded-xl px-3.5 py-2.5 text-[.82rem] text-slate-800 bg-slate-50 resize-none placeholder:text-slate-400 focus:outline-none focus:border-[#C9A84C] focus:bg-white focus:ring-2 focus:ring-[#C9A84C]/10 transition-all"></textarea>
                </div>

                {{-- Contact --}}
                <div class="mb-5">
                    <div class="text-[.82rem] font-medium text-slate-800 mb-2">May we contact you regarding your feedback?</div>
                    <div class="flex gap-2">
                        <label class="inline-flex items-center px-5 py-1.5 rounded-full border border-slate-300 text-[.8rem] font-semibold text-slate-700 cursor-pointer transition-all has-[:checked]:bg-[#0B1F3A] has-[:checked]:border-[#0B1F3A] has-[:checked]:text-white">
                            <input type="radio" name="csat_contact" value="yes" class="hidden" onchange="csat_toggleContact('yes')"> Yes
                        </label>
                        <label class="inline-flex items-center px-5 py-1.5 rounded-full border border-slate-300 text-[.8rem] font-semibold text-slate-700 cursor-pointer transition-all has-[:checked]:bg-[#0B1F3A] has-[:checked]:border-[#0B1F3A] has-[:checked]:text-white">
                            <input type="radio" name="csat_contact" value="no" class="hidden" checked onchange="csat_toggleContact('no')"> No
                        </label>
                    </div>
                    <div id="csatContactFields" class="hidden grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-[9.5px] font-bold uppercase tracking-[.08em] text-slate-500 mb-1">Name</label>
                            <input type="text" name="contact_name" placeholder="Your name"
                                class="w-full border-b-2 border-[#1565c0] bg-transparent pb-1.5 text-[.82rem] text-slate-800 focus:outline-none placeholder:text-slate-400">
                        </div>
                        <div>
                            <label class="block text-[9.5px] font-bold uppercase tracking-[.08em] text-slate-500 mb-1">Contact / email</label>
                            <input type="text" name="contact_info" placeholder="Phone or email"
                                class="w-full border-b-2 border-[#1565c0] bg-transparent pb-1.5 text-[.82rem] text-slate-800 focus:outline-none placeholder:text-slate-400">
                        </div>
                    </div>
                </div>

                {{-- Error --}}
                <div id="csatErrBar" class="hidden items-center gap-2 bg-red-50 border border-red-200 text-red-800 rounded-xl px-3.5 py-2.5 text-[.8rem] mb-3">
                    <svg class="w-4 h-4 stroke-current fill-none flex-shrink-0" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span id="csatErrMsg">Please complete all required star ratings before submitting.</span>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between flex-wrap gap-3 pt-4 border-t border-slate-200">
                    <p class="text-[.72rem] text-slate-400 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5 stroke-emerald-500 fill-none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Confidential — used only for quality improvement
                    </p>
                    <button type="submit" id="csatSubmitBtn"
                        class="inline-flex items-center gap-1.5 px-6 py-2.5 rounded-full bg-gradient-to-br from-[#1565c0] to-[#0d47a1] text-white text-[.78rem] font-bold tracking-[.1em] uppercase border-none cursor-pointer shadow-lg shadow-blue-700/30 hover:opacity-90 hover:-translate-y-px hover:shadow-xl transition-all disabled:opacity-50 disabled:pointer-events-none">
                        Submit Survey
                        <svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </button>
                </div>

                <div id="csatSuccessBar" class="hidden items-center gap-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl px-4 py-3 text-[.82rem] font-medium mt-3">
                    <div class="w-7 h-7 rounded-full bg-[#0B1F3A] text-[#C9A84C] flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    Thank you! Your feedback has been recorded successfully.
                </div>

            </form>
        </div>
    </div>
</div>

{{-- ── Scoped styles for this modal only ── --}}
<style>
.csat-stars { display:flex; flex-direction:row-reverse; gap:3px; }
.csat-stars input { display:none; }
.csat-stars label { cursor:pointer; font-size:1.4rem; color:#DDE1EA; line-height:1; transition:color .12s, transform .12s; display:inline-block; }
.csat-stars label:hover, .csat-stars label:hover ~ label, .csat-stars input:checked ~ label { color:#C9A84C; }
.csat-stars label:hover { transform:scale(1.15); }
.csat-err-row .csat-stars label { color:#FECACA !important; }
#csatModalCard::-webkit-scrollbar { width:5px; }
#csatModalCard::-webkit-scrollbar-thumb { background:#C9A84C; border-radius:8px; }
@keyframes csatCardIn { from{opacity:0;transform:translateY(14px)} to{opacity:1;transform:translateY(0)} }
.csat-card-in { animation:csatCardIn .25s ease both; }
@keyframes csatSpin { to { transform:rotate(360deg); } }
.csat-spinning { animation:csatSpin 1s linear infinite; }
</style>

{{-- ── Scoped JS — all functions prefixed csat_ ── --}}
<script>
(function () {
    const REQUIRED = ['csat_p1','csat_p2','csat_p3','csat_p4','csat_p6','csat_p7','csat_o1','csat_o2'];

    function reset() {
        document.getElementById('csatSurveyForm').reset();
        document.getElementById('csatProgressFill').style.width = '0%';

        ['csatErrBar','csatSuccessBar'].forEach(function(id) {
            const el = document.getElementById(id);
            if (el) { el.classList.add('hidden'); el.classList.remove('flex'); }
        });

        const cf = document.getElementById('csatContactFields');
        if (cf) { cf.classList.add('hidden'); cf.classList.remove('grid'); }

        const btn = document.getElementById('csatSubmitBtn');
        if (btn) {
            btn.style.display = '';
            btn.disabled = false;
            btn.innerHTML = 'Submit Survey <svg class="w-3.5 h-3.5 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>';
        }

        REQUIRED.forEach(function(n) {
            document.getElementById('row-' + n)?.classList.remove('csat-err-row');
        });
    }

    // ── Public open function ──────────────────────────────────────
    window.openCsatModal = function () {
        reset();

        const overlay = document.getElementById('csatModalOverlay');
        const card    = document.getElementById('csatModalCard');

        overlay.classList.remove('hidden');
        overlay.classList.add('flex');

        // Re-trigger entrance animation cleanly
        card.classList.remove('csat-card-in');
        void card.offsetWidth;
        card.classList.add('csat-card-in');

        document.body.style.overflow = 'hidden';
    };

    // Alias for landing page card onclick="openModal()"
    window.openModal      = window.openCsatModal;
    // Alias for old bell onclick="openCsatModal(id)"
    window.csat_open      = window.openCsatModal;

    // ── Close ─────────────────────────────────────────────────────
    window.csat_close = function () {
        const overlay = document.getElementById('csatModalOverlay');
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        document.body.style.overflow = '';
    };

    window.csat_handleOverlayClick = function (e) {
        if (e.target === document.getElementById('csatModalOverlay')) csat_close();
    };

    // ── Contact toggle ────────────────────────────────────────────
    window.csat_toggleContact = function (val) {
        const f = document.getElementById('csatContactFields');
        if (val === 'yes') { f.classList.remove('hidden'); f.classList.add('grid'); }
        else               { f.classList.add('hidden');    f.classList.remove('grid'); }
    };

    // ── Progress ──────────────────────────────────────────────────
    function updateProgress() {
        const rated = REQUIRED.filter(function(n) {
            return document.querySelector('input[name="' + n + '"]:checked');
        }).length;
        document.getElementById('csatProgressFill').style.width =
            Math.round((rated / REQUIRED.length) * 100) + '%';
    }

    // ── Star change listeners ─────────────────────────────────────
    document.addEventListener('change', function (e) {
        if (!e.target.closest('#csatSurveyForm')) return;
        const name = e.target.name;
        document.getElementById('row-' + name)?.classList.remove('csat-err-row');
        const eb = document.getElementById('csatErrBar');
        if (eb) { eb.classList.add('hidden'); eb.classList.remove('flex'); }
        updateProgress();
    });

    // ── Form submit ───────────────────────────────────────────────
    document.addEventListener('submit', function (e) {
        if (e.target.id !== 'csatSurveyForm') return;
        e.preventDefault();

        const missing = REQUIRED.filter(function(n) {
            return !document.querySelector('input[name="' + n + '"]:checked');
        });

        if (missing.length) {
            missing.forEach(function(n) {
                document.getElementById('row-' + n)?.classList.add('csat-err-row');
            });
            document.getElementById('csatErrMsg').textContent =
                'Please rate all ' + missing.length + ' required field' + (missing.length > 1 ? 's' : '') + ' before submitting.';
            const eb = document.getElementById('csatErrBar');
            eb.classList.remove('hidden'); eb.classList.add('flex');
            document.getElementById('row-' + missing[0])?.scrollIntoView({ behavior: 'smooth', block: 'center' });
            return;
        }

        const eb = document.getElementById('csatErrBar');
        eb.classList.add('hidden'); eb.classList.remove('flex');

        const btn = document.getElementById('csatSubmitBtn');
        btn.disabled = true;
        btn.innerHTML = '<svg class="csat-spinning w-3.5 h-3.5 stroke-current fill-none" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 12a8 8 0 018-8V0"/></svg> Submitting…';

        // ── swap this setTimeout for your fetch() call when wiring backend ──
        setTimeout(function () {
            btn.style.display = 'none';
            document.getElementById('csatProgressFill').style.width = '100%';
            const sb = document.getElementById('csatSuccessBar');
            sb.classList.remove('hidden'); sb.classList.add('flex');
            setTimeout(csat_close, 2500);
        }, 1200);
    });

})();
</script>