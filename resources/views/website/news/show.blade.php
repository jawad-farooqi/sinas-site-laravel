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

    <article>

        <div class="mb-3">

            @if ($news->isExpired())
                <span class="badge bg-danger">
                    Expired
                </span>
            @else
                <span class="badge bg-success">
                    Published
                </span>
            @endif

            <span class="badge bg-secondary">
                {{ $news->category->name }}
            </span>

        </div>

        <h1>
            {{ $news->title }}
        </h1>

        <div class="text-muted mb-4">

            Published:
            {{ $news->published_at?->format('d M Y, h:i A') }}

            @if ($news->expires_at)
                <br>

                @if ($news->isExpired())
                    Expired:
                @else
                    Expires:
                @endif

                {{ $news->expires_at->format('d M Y, h:i A') }}
            @endif

        </div>

        @if ($news->featured_image)

            <img
                src="{{ asset('storage/' . $news->featured_image) }}"
                class="img-fluid rounded mb-4"
                alt="{{ $news->title }}"
            >

        @endif

        <div class="news-content">

            {!! $news->content !!}

        </div>

        @if (!empty($news->attachments))

            <hr class="my-5">

            <h3>Attachments</h3>

            <div class="list-group">

                @foreach ($news->attachments as $attachment)

                    <a
                        href="{{ asset('storage/' . $attachment->file_path) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        {{ $attachment->original_name }}
                    </a>

                @endforeach

            </div>

        @endif

    </article>

</div>

@endsection



@endsection