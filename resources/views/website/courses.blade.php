@extends('layouts.website')

@section('title', 'SINAS - Courses')

@section('content')

<header class="hero-vital py-5">
  <div class="container py-4 position-relative">
    <span class="eyebrow" style="color:var(--gold);">Programs</span>
    <h1 class="font-display mt-2 mb-2" style="color:#fff; font-size:clamp(2rem,4vw,2.8rem);">Every program leads to a license, a placement, and a practice.</h1>
    <p style="color:rgba(255,255,255,0.75); max-width:640px;">Three entry points, one standard of clinical readiness. Compare tracks below or filter by how much time you have.</p>
  </div>
</header>

<section class="section-pad pt-5">
  <div class="container">

    <div id="bsn" class="row g-5 align-items-start mb-5 pb-5 border-bottom reveal">
      <div class="col-lg-4">
        <span class="badge-vital mb-3 d-inline-block">Traditional track</span>
        <h2 class="font-display h3">Bachelor of Science in Nursing</h2>
        <p class="text-ink-soft small">4 years &middot; 128 credit hours &middot; on-campus</p>
        <div class="d-flex gap-4 font-mono small text-teal mt-3">
          <span><i class="bi bi-clock"></i> 4 yrs</span>
          <span><i class="bi bi-clipboard2-pulse"></i> 800 clinical hrs</span>
        </div>
      </div>
      <div class="col-lg-8">
        <p class="text-ink-soft">A full generalist BSN for students entering nursing directly from secondary school or transferring pre-requisite credit. Clinical placements begin in semester two.</p>
        <div class="row g-3 mt-2">
          <div class="col-md-6"><div class="card-vital p-3"><p class="fw-semibold small mb-1">Year 1–2</p><p class="small text-ink-soft mb-0">Anatomy, physiology, pharmacology, fundamentals of patient care, skills lab intensives.</p></div></div>
          <div class="col-md-6"><div class="card-vital p-3"><p class="fw-semibold small mb-1">Year 3–4</p><p class="small text-ink-soft mb-0">Med-surg, pediatric, maternal, psychiatric and community rotations plus a capstone practicum.</p></div></div>
        </div>
      </div>
    </div>

    <div id="absn" class="row g-5 align-items-start mb-5 pb-5 border-bottom reveal">
      <div class="col-lg-4">
        <span class="badge-vital gold mb-3 d-inline-block">Accelerated track</span>
        <h2 class="font-display h3">Accelerated BSN</h2>
        <p class="text-ink-soft small">18 months &middot; 68 credit hours &middot; hybrid</p>
        <div class="d-flex gap-4 font-mono small text-teal mt-3">
          <span><i class="bi bi-clock"></i> 18 mo</span>
          <span><i class="bi bi-clipboard2-pulse"></i> 800 clinical hrs</span>
        </div>
      </div>
      <div class="col-lg-8">
        <p class="text-ink-soft">Built for career-changers holding a bachelor's degree in any field. Prerequisite science coursework transfers in; nursing theory and clinical hours are compressed into a year-round calendar with no reduction in hours.</p>
        <div class="row g-3 mt-2">
          <div class="col-md-6"><div class="card-vital p-3"><p class="fw-semibold small mb-1">Admission requirement</p><p class="small text-ink-soft mb-0">Completed bachelor's degree, minimum 3.0 GPA, prerequisite science courses within 7 years.</p></div></div>
          <div class="col-md-6"><div class="card-vital p-3"><p class="fw-semibold small mb-1">Format</p><p class="small text-ink-soft mb-0">Two evening lecture blocks weekly, daytime clinical rotations, year-round terms.</p></div></div>
        </div>
      </div>
    </div>

    <div id="msn" class="row g-5 align-items-start mb-5 pb-5 border-bottom reveal">
      <div class="col-lg-4">
        <span class="badge-vital coral mb-3 d-inline-block">Graduate track</span>
        <h2 class="font-display h3">MSN — Family Nurse Practitioner</h2>
        <p class="text-ink-soft small">2 years &middot; 46 credit hours &middot; hybrid</p>
        <div class="d-flex gap-4 font-mono small text-teal mt-3">
          <span><i class="bi bi-clock"></i> 2 yrs</span>
          <span><i class="bi bi-clipboard2-pulse"></i> 700 clinical hrs</span>
        </div>
      </div>
      <div class="col-lg-8">
        <p class="text-ink-soft">Advanced practice preparation for licensed RNs pursuing primary-care certification. Precepted placements are arranged across Meridian's partner clinic network.</p>
        <div class="row g-3 mt-2">
          <div class="col-md-6"><div class="card-vital p-3"><p class="fw-semibold small mb-1">Admission requirement</p><p class="small text-ink-soft mb-0">Active RN license, BSN with 3.2 GPA, minimum one year acute-care experience.</p></div></div>
          <div class="col-md-6"><div class="card-vital p-3"><p class="fw-semibold small mb-1">Certification</p><p class="small text-ink-soft mb-0">Graduates sit for the AANP or ANCC family nurse practitioner exam.</p></div></div>
        </div>
      </div>
    </div>

    <div class="row g-5 align-items-start reveal">
      <div class="col-lg-4">
        <span class="badge-vital mb-3 d-inline-block">Continuing education</span>
        <h2 class="font-display h3">Certificate programs</h2>
        <p class="text-ink-soft small">8–16 weeks &middot; evenings &middot; open enrollment</p>
      </div>
      <div class="col-lg-8">
        <div class="row g-3">
          <div class="col-md-4"><div class="card-vital p-3 h-100"><p class="fw-semibold small mb-1">Wound Care Certificate</p><p class="small text-ink-soft mb-0">8 weeks. For licensed RNs and LPNs.</p></div></div>
          <div class="col-md-4"><div class="card-vital p-3 h-100"><p class="fw-semibold small mb-1">Perinatal Nursing</p><p class="small text-ink-soft mb-0">12 weeks. Includes 60 precepted hours.</p></div></div>
          <div class="col-md-4"><div class="card-vital p-3 h-100"><p class="fw-semibold small mb-1">Nurse Educator Prep</p><p class="small text-ink-soft mb-0">16 weeks. For RNs moving into faculty roles.</p></div></div>
        </div>
      </div>
    </div>

  </div>
</section>

<section class="section-pad bg-teal-deep text-white">
  <div class="container text-center reveal">
    <h2 class="font-display mb-3" style="font-size:1.9rem;">Not sure which track fits?</h2>
    <p class="mb-4" style="color:rgba(255,255,255,0.75);">Our admissions team reviews transcripts and prior credit within five business days.</p>
    <a href="admissions.html" class="btn-vital btn-coral">See admission requirements <i class="bi bi-arrow-right"></i></a>
  </div>
</section>

@endsection