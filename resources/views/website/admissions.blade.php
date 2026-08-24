@extends('layouts.website')

@section('title', 'SINAS - Admissions')

@section('content')

<header class="hero-vital py-5">
  <div class="container py-4">
    <span class="eyebrow" style="color:var(--gold);">Admissions</span>
    <h1 class="font-display mt-2 mb-2" style="color:#fff; font-size:clamp(2rem,4vw,2.8rem);">Rolling admissions. No application fee. A real answer in three weeks.</h1>
  </div>
</header>

<section class="section-pad pt-5">
  <div class="container">
    <div class="row g-4 mb-5">
      <div class="col-md-3 col-6 reveal">
        <div class="card-vital p-4 text-center h-100">
          <p class="font-mono text-teal mb-1">Step 1</p>
          <h3 class="h6">Submit transcripts</h3>
          <p class="small text-ink-soft mb-0">Official secondary or prior college transcripts.</p>
        </div>
      </div>
      <div class="col-md-3 col-6 reveal">
        <div class="card-vital p-4 text-center h-100">
          <p class="font-mono text-teal mb-1">Step 2</p>
          <h3 class="h6">Prerequisite review</h3>
          <p class="small text-ink-soft mb-0">Our team confirms science and math credit within 5 days.</p>
        </div>
      </div>
      <div class="col-md-3 col-6 reveal">
        <div class="card-vital p-4 text-center h-100">
          <p class="font-mono text-teal mb-1">Step 3</p>
          <h3 class="h6">Interview</h3>
          <p class="small text-ink-soft mb-0">A 20-minute conversation with faculty, in person or video.</p>
        </div>
      </div>
      <div class="col-md-3 col-6 reveal">
        <div class="card-vital p-4 text-center h-100">
          <p class="font-mono text-teal mb-1">Step 4</p>
          <h3 class="h6">Decision</h3>
          <p class="small text-ink-soft mb-0">Written decision within 3 weeks of a complete file.</p>
        </div>
      </div>
    </div>

    <div class="row g-5">
      <div class="col-lg-7 reveal">
        <h2 class="h4 mb-3">Requirements by program</h2>
        <div class="accordion" id="reqAccordion">
          <div class="accordion-item border-0 mb-3 card-vital">
            <h3 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#reqBSN">Bachelor of Science in Nursing</button>
            </h3>
            <div id="reqBSN" class="accordion-collapse collapse show" data-bs-parent="#reqAccordion">
              <div class="accordion-body small text-ink-soft">
                High school diploma or equivalent &middot; minimum 3.0 GPA &middot; completed biology and chemistry with lab &middot; two academic references &middot; personal statement (500 words).
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 mb-3 card-vital">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reqABSN">Accelerated BSN</button>
            </h3>
            <div id="reqABSN" class="accordion-collapse collapse" data-bs-parent="#reqAccordion">
              <div class="accordion-body small text-ink-soft">
                Completed bachelor's degree in any field &middot; minimum 3.0 GPA &middot; prerequisite sciences within the last 7 years &middot; one professional reference.
              </div>
            </div>
          </div>
          <div class="accordion-item border-0 mb-3 card-vital">
            <h3 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#reqMSN">MSN — Family Nurse Practitioner</button>
            </h3>
            <div id="reqMSN" class="accordion-collapse collapse" data-bs-parent="#reqAccordion">
              <div class="accordion-body small text-ink-soft">
                Active unrestricted RN license &middot; BSN with 3.2 GPA &middot; minimum one year acute-care experience &middot; statement of clinical intent.
              </div>
            </div>
          </div>
        </div>

        <h2 class="h4 mt-5 mb-3">Tuition &amp; deadlines</h2>
        <div class="table-responsive">
          <table class="table table-vital align-middle">
            <thead><tr><th>Program</th><th>Per year</th><th>Fall deadline</th><th>Spring deadline</th></tr></thead>
            <tbody>
              <tr><td>BSN</td><td class="font-mono">$28,400</td><td class="font-mono">Mar 1</td><td class="font-mono">Oct 1</td></tr>
              <tr><td>Accelerated BSN</td><td class="font-mono">$34,900</td><td class="font-mono">Jan 15</td><td class="font-mono">Jun 15</td></tr>
              <tr><td>MSN — FNP</td><td class="font-mono">$21,700</td><td class="font-mono">Apr 1</td><td class="font-mono">Nov 1</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="col-lg-5 reveal">
        <div class="card-vital p-4">
          <span class="badge-vital mb-3 d-inline-block">Request info</span>
          <h2 class="h5 mb-3">Get a personalized checklist</h2>
          <form class="form-vital needs-validation" novalidate onsubmit="event.preventDefault(); this.classList.add('was-validated'); if(this.checkValidity()){ this.closest('.card-vital').innerHTML='<div class=\'text-center py-4\'><i class=\'bi bi-check-circle fs-1 text-teal\'></i><p class=\'mt-3 mb-0 fw-semibold\'>Checklist on its way.</p><p class=\'small text-ink-soft\'>We\'ll email your program-specific checklist shortly.</p></div>'; }">
            <div class="mb-3"><label class="form-label">Full name</label><input required class="form-control" type="text"></div>
            <div class="mb-3"><label class="form-label">Email</label><input required class="form-control" type="email"></div>
            <div class="mb-3">
              <label class="form-label">Program of interest</label>
              <select class="form-select" required>
                <option value="" selected disabled>Choose one</option>
                <option>Bachelor of Science in Nursing</option>
                <option>Accelerated BSN</option>
                <option>MSN — Family Nurse Practitioner</option>
                <option>Certificate program</option>
              </select>
            </div>
            <button class="btn-vital w-100 justify-content-center" type="submit">Send my checklist</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection