@extends('layouts.website')

@section('title', 'SINAS - Gallery')

@section('content')

<header class="hero-vital py-5">
  <div class="container py-4">
    <span class="eyebrow" style="color:var(--gold);">Gallery</span>
    <h1 class="font-display mt-2 mb-2" style="color:#fff; font-size:clamp(2rem,4vw,2.8rem);">A look around campus.</h1>
    <p style="color:rgba(255,255,255,0.75); max-width:600px;">Skills labs, ceremonies, community outreach and the facilities students train in every week.</p>
  </div>
</header>

<section class="section-pad pt-5">
  <div class="container">
    <div class="d-flex flex-wrap gap-2 mb-4" id="galleryFilters"></div>
    <div id="galleryPublicGrid" class="row g-3"></div>
    <div id="galleryEmpty" class="text-center text-ink-soft py-5 d-none">
      <i class="bi bi-images fs-1 d-block mb-3 opacity-50"></i>
      No photos uploaded yet — check back soon.
    </div>
  </div>
</section>

@endsection