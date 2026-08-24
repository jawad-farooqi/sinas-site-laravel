@extends('layouts.website')

@section('title', 'SINAS - Home')

@section('content') 

<!-- ===================== HERO ===================== -->
<header class="hero-vital">
  <div class="pulse-hero-line" aria-hidden="true">
    <svg viewBox="0 0 1200 160" preserveAspectRatio="none" width="100%" height="100%">
      <path class="pulse-draw" d="M0,80 L120,80 L150,20 L180,140 L210,80 L280,80 L310,50 L340,110 L370,80 L500,80 L530,30 L560,130 L590,80 L720,80 L750,60 L780,100 L810,80 L960,80 L990,20 L1020,140 L1050,80 L1200,80" fill="none" stroke="rgba(199,154,62,0.55)" stroke-width="1.5"/>
    </svg>
  </div>
  <div class="container section-pad position-relative" style="padding-top:6rem; padding-bottom:6rem;">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="eyebrow" style="color:var(--gold);">CCNE-accredited &middot; est. 1987</span>
        <h1 class="font-display mt-3 mb-4" style="color:#fff; font-size:clamp(2.4rem, 5vw, 3.6rem); line-height:1.08;">
          Steady hands begin<br> with steady training.
        </h1>
        <p class="fs-5 mb-4" style="color:rgba(255,255,255,0.78); max-width:540px;">
          Meridian prepares nurses for the moments that matter — through clinical hours from week one, faculty who still practice, and a pass-rate record employers already trust.
        </p>
        <div class="d-flex flex-wrap gap-3 mb-5">
          <a href="admissions.html" class="btn-vital btn-coral">Start your application <i class="bi bi-arrow-right"></i></a>
          <a href="courses.html" class="btn-outline-vital on-dark">Explore programs</a>
        </div>
        <div class="row g-3">
          <div class="col-4">
            <div class="stat-chip">
              <div class="num"><span data-count-to="96" data-suffix="%">0%</span></div>
              <div class="small" style="color:rgba(255,255,255,0.65);">NCLEX pass rate</div>
            </div>
          </div>
          <div class="col-4">
            <div class="stat-chip">
              <div class="num"><span data-count-to="38" data-suffix="+">0+</span></div>
              <div class="small" style="color:rgba(255,255,255,0.65);">Years training nurses</div>
            </div>
          </div>
          <div class="col-4">
            <div class="stat-chip">
              <div class="num"><span data-count-to="24" data-suffix="">0</span></div>
              <div class="small" style="color:rgba(255,255,255,0.65);">Partner clinical sites</div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="card-vital p-4" style="border-radius:14px;">
          <span class="badge-vital coral mb-3 d-inline-block">Fall 2027 intake</span>
          <h2 class="h4 mb-3">Applications now open</h2>
          <ul class="list-unstyled mb-4 small text-ink-soft">
            <li class="mb-2"><i class="bi bi-check2 text-teal me-2"></i>Rolling admissions, no application fee</li>
            <li class="mb-2"><i class="bi bi-check2 text-teal me-2"></i>Transfer credit review within 5 business days</li>
            <li class="mb-2"><i class="bi bi-check2 text-teal me-2"></i>Clinical placements guaranteed for BSN cohort</li>
          </ul>
          <a href="admissions.html" class="btn-vital w-100 justify-content-center">See deadlines</a>
        </div>
      </div>
    </div>
  </div>
</header>

<!-- ===================== PROGRAMS ===================== -->
<section class="section-pad">
  <div class="container">
    <div class="row align-items-end mb-5">
      <div class="col-md-8 reveal">
        <span class="eyebrow">Programs</span>
        <h2 class="font-display mt-2" style="font-size:2.2rem;">Three paths into practice</h2>
      </div>
      <div class="col-md-4 text-md-end reveal">
        <a href="courses.html" class="fw-semibold text-teal">View full catalog <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
    <div class="row g-4">
      <div class="col-md-4 reveal">
        <div class="card-vital p-4 h-100">
          <span class="badge-vital mb-3 d-inline-block">4-year</span>
          <h3 class="h5 mb-2">Bachelor of Science in Nursing</h3>
          <p class="text-ink-soft small mb-3">Full generalist preparation across med-surg, pediatric, maternal, psychiatric and community rotations.</p>
          <a href="courses.html#bsn" class="fw-semibold small text-teal">Program details <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-md-4 reveal">
        <div class="card-vital p-4 h-100">
          <span class="badge-vital gold mb-3 d-inline-block">18-month</span>
          <h3 class="h5 mb-2">Accelerated BSN</h3>
          <p class="text-ink-soft small mb-3">For career-changers with a prior bachelor's degree — compressed theory, same clinical hour requirements.</p>
          <a href="courses.html#absn" class="fw-semibold small text-teal">Program details <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
      <div class="col-md-4 reveal">
        <div class="card-vital p-4 h-100">
          <span class="badge-vital coral mb-3 d-inline-block">2-year</span>
          <h3 class="h5 mb-2">Master of Science, Family NP</h3>
          <p class="text-ink-soft small mb-3">Advanced practice training with 700+ precepted clinical hours across primary-care settings.</p>
          <a href="courses.html#msn" class="fw-semibold small text-teal">Program details <i class="bi bi-arrow-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>

<div class="container"><span data-pulse-divider="divider"></span></div>

<!-- ===================== LATEST NEWS ===================== -->
<section class="section-pad pt-4">
  <div class="container">
    <div class="row align-items-end mb-5">
      <div class="col-md-8 reveal">
        <span class="eyebrow">Latest news</span>
        <h2 class="font-display mt-2" style="font-size:2.2rem;">From campus</h2>
      </div>
      <div class="col-md-4 text-md-end reveal">
        <a href="news.html" class="fw-semibold text-teal">All announcements <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
    <div id="landingNewsList" class="row g-4"></div>
  </div>
</section>

<!-- ===================== WHY MERIDIAN ===================== -->
<section class="section-pad bg-teal-mist">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5 reveal">
        <span class="eyebrow">Why Meridian</span>
        <h2 class="font-display mt-2 mb-3" style="font-size:2rem;">Clinical hours from your first semester, not your last.</h2>
        <p class="text-ink-soft">Most programs save the bedside for year three. Ours starts week four, in small supervised groups, so the habits that matter — assessment, documentation, bedside manner — are built early and repeated often.</p>
      </div>
      <div class="col-lg-7">
        <div class="row g-4">
          <div class="col-sm-6 reveal">
            <div class="card-vital p-4 h-100">
              <i class="bi bi-clipboard2-pulse fs-3 text-teal mb-3 d-block"></i>
              <h3 class="h6">Simulation-first labs</h3>
              <p class="small text-ink-soft mb-0">High-fidelity manikins model real complications before students meet real patients.</p>
            </div>
          </div>
          <div class="col-sm-6 reveal">
            <div class="card-vital p-4 h-100">
              <i class="bi bi-people fs-3 text-teal mb-3 d-block"></i>
              <h3 class="h6">12:1 clinical ratio</h3>
              <p class="small text-ink-soft mb-0">Small cohorts mean direct instructor feedback on every rotation, every week.</p>
            </div>
          </div>
          <div class="col-sm-6 reveal">
            <div class="card-vital p-4 h-100">
              <i class="bi bi-mortarboard fs-3 text-teal mb-3 d-block"></i>
              <h3 class="h6">Faculty who still practice</h3>
              <p class="small text-ink-soft mb-0">Every instructor carries an active license and a current clinical caseload.</p>
            </div>
          </div>
          <div class="col-sm-6 reveal">
            <div class="card-vital p-4 h-100">
              <i class="bi bi-briefcase fs-3 text-teal mb-3 d-block"></i>
              <h3 class="h6">92% hired within 6 months</h3>
              <p class="small text-ink-soft mb-0">Partner hospitals recruit directly from our senior clinical rotations.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===================== TESTIMONIAL ===================== -->
<section class="section-pad">
  <div class="container">
    <div class="row justify-content-center text-center reveal">
      <div class="col-lg-8">
        <i class="bi bi-quote fs-1 text-teal opacity-50"></i>
        <p class="font-display" style="font-size:1.5rem; color:var(--teal-deep);">"I walked into my first ICU shift already knowing how to hold a code sheet steady. That's the difference three years of Meridian's simulation labs made."</p>
        <p class="fw-semibold mb-0 mt-3">Renata Cole, BSN '24</p>
        <p class="small text-ink-soft font-mono">RN, Overlake Medical Center</p>
      </div>
    </div>
  </div>
</section>

<!-- ===================== CTA ===================== -->
<section class="section-pad bg-teal-deep text-white">
  <div class="container text-center reveal">
    <h2 class="font-display mb-3" style="font-size:2rem;">Applications for Fall 2027 close March 1.</h2>
    <p class="mb-4" style="color:rgba(255,255,255,0.75);">No application fee. Decisions within three weeks of a complete file.</p>
    <a href="admissions.html" class="btn-vital btn-coral">Begin your application <i class="bi bi-arrow-right"></i></a>
  </div>
</section>


@endsection