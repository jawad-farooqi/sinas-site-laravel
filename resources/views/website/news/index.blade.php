@extends('layouts.website')

@section('title', 'SINAS - News')

@section('content')



<header class="hero-vital py-5">
  <div class="container py-4">
    <span class="eyebrow" style="color:var(--gold);">News</span>
    <h1 class="font-display mt-2 mb-2" style="color:#fff; font-size:clamp(2rem,4vw,2.8rem);">Announcements from campus.</h1>
    <p style="color:rgba(255,255,255,0.75); max-width:600px;">Program updates, ceremonies, accreditation news and facility openings — published directly by faculty and administration.</p>
  </div>
</header>

<section class="section-pad pt-5">
  <div class="container">
    <div id="newsList" class="row g-4"></div>
    <div id="newsEmpty" class="text-center text-ink-soft py-5 d-none">
      <i class="bi bi-newspaper fs-1 d-block mb-3 opacity-50"></i>
      No articles published yet — check back soon.
    </div>
  </div>
</section>



@endsection