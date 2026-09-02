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

@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1 class="mb-4">News & Announcements</h1>

    <div class="row">

        @forelse ($news as $item)

            <div class="col-md-6 col-lg-4 mb-4">

                <article class="card h-100">

                    @if ($item->featured_image)
                        <img
                            src="{{ asset('storage/' . $item->featured_image) }}"
                            class="card-img-top"
                            alt="{{ $item->title }}"
                        >
                    @endif

                    <div class="card-body">

                        @if ($item->isExpired())
                            <span class="badge bg-danger">
                                Expired
                            </span>
                        @else
                            <span class="badge bg-success">
                                Published
                            </span>
                        @endif

                        <span class="badge bg-secondary">
                            {{ $item->category->name }}
                        </span>

                        <h2 class="h5 mt-2">
                            {{ $item->title }}
                        </h2>

                        <p>
                            {{ $item->excerpt }}
                        </p>

                        <small class="text-muted">
                            {{ $item->published_at?->format('d M Y') }}
                        </small>

                    </div>

                    <div class="card-footer">

                        <a
                            href="{{ route('news.show', $item->slug) }}"
                            class="btn btn-primary"
                        >
                            Read More
                        </a>

                    </div>

                </article>

            </div>

        @empty

            <p>No news available.</p>

        @endforelse

    </div>

    {{ $news->links() }}

</div>

@endsection



@endsection