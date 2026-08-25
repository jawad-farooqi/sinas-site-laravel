@extends('layouts.website')

@section('title', 'SINAS - Contact')

@section('content')

<header class="hero-vital py-5">
  <div class="container py-4">
    <span class="eyebrow" style="color:var(--gold);">Contact</span>
    <h1 class="font-display mt-2 mb-2" style="color:#fff; font-size:clamp(2rem,4vw,2.8rem);">Ask us anything — a person answers, not a queue.</h1>
  </div>
</header>

<section class="section-pad pt-5">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-5 reveal">
        <h2 class="h5 mb-3">Campus &amp; offices</h2>
        <div class="card-vital p-4 mb-3">
          <p class="fw-semibold small mb-1"><i class="bi bi-geo-alt text-teal me-2"></i>Address</p>
          <p class="small text-ink-soft mb-0">Chinar Bagh Colony, Chail Shagai, Saidu Sharif, Swat</p>
        </div>
        <div class="card-vital p-4 mb-3">
          <p class="fw-semibold small mb-1"><i class="bi bi-telephone text-teal me-2"></i>Admissions office</p>
          <p class="small text-ink-soft mb-0">0319-9309590 · Mon–Fri, 8am–4pm</p>
        </div>
        <div class="card-vital p-4 mb-3">
          <p class="fw-semibold small mb-1"><i class="bi bi-envelope text-teal me-2"></i>Email</p>
          <p class="small text-ink-soft mb-0">
              <span class="email-protected"
                    data-user="info"
                    data-domain="sinas.edu.pk"></span>
          </p>
          <p class="small text-ink-soft mb-0">
              <span class="email-protected"
                    data-user="sinas.swat"
                    data-domain="gmail.com"></span>
          </p>

          <script>
          document.addEventListener('DOMContentLoaded', function () {
              document.querySelectorAll('.email-protected').forEach(function (el) {
                  const email = el.dataset.user + '@' + el.dataset.domain;

                  const link = document.createElement('a');
                  link.href = 'mailto:' + email;
                  link.textContent = email;
                  link.className = 'text-ink-soft text-decoration-none';

                  el.replaceWith(link);
              });
          });
          </script>
        </div>
        <div class="card-vital p-4">
          <p class="fw-semibold small mb-2"><i class="bi bi-map text-teal me-2"></i>Campus map</p>
          <div class="rounded-2 d-flex align-items-center justify-content-center" style="height:160px; background: var(--teal-mist);">
            <span class="font-mono small text-teal">Map preview</span>
          </div>
        </div>
      </div>

      <div class="col-lg-7 reveal">
        <div class="card-vital p-4 p-md-5">
          <h2 class="h5 mb-4">Send a message</h2>
          <form id="contactForm" class="form-vital needs-validation" novalidate>
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">First name</label>
                <input type="text" class="form-control" required>
                <div class="invalid-feedback">Please enter your first name.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Last name</label>
                <input type="text" class="form-control" required>
                <div class="invalid-feedback">Please enter your last name.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" required>
                <div class="invalid-feedback">A valid email is required.</div>
              </div>
              <div class="col-md-6">
                <label class="form-label">Phone (optional)</label>
                <input type="tel" class="form-control">
              </div>
              <div class="col-12">
                <label class="form-label">I'm asking about</label>
                <select class="form-select" required>
                  <option value="" selected disabled>Choose a topic</option>
                  <option>Admissions</option>
                  <option>Financial aid</option>
                  <option>Transfer credit</option>
                  <option>Campus visit</option>
                  <option>Other</option>
                </select>
                <div class="invalid-feedback">Please choose a topic.</div>
              </div>
              <div class="col-12">
                <label class="form-label">Message</label>
                <textarea class="form-control" rows="4" required></textarea>
                <div class="invalid-feedback">Let us know what's on your mind.</div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn-vital w-100 justify-content-center">Send message</button>
              </div>
            </div>
          </form>
          <div id="contactSuccess" class="d-none text-center py-4">
            <i class="bi bi-check-circle fs-1 text-teal"></i>
            <p class="mt-3 mb-0 fw-semibold">Message sent.</p>
            <p class="small text-ink-soft">Our team replies within one business day.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection