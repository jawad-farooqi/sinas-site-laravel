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


<!-- Gallery -->
<section class="college-gallery-section">
    <div class="container">

        <div class="college-gallery">

            <!-- Principal Office -->
            <a href="{{ asset('images/gallery/principal-office.jpeg') }}"
               class="gallery-card gallery-card-large"
               data-gallery="college-gallery">

                <img
                    src="{{ asset('images/gallery/principal-office.jpeg') }}"
                    alt="Principal Office"
                    loading="lazy"
                >

                <div class="gallery-overlay">
                    <div>
                        <span>Administration</span>
                    </div>

                    <span class="gallery-view-icon">
                        +
                    </span>
                </div>

            </a>


            <!-- Library -->
            <a href="{{ asset('images/gallery/library.jpeg') }}"
               class="gallery-card"
               data-gallery="college-gallery">

                <img
                    src="{{ asset('images/gallery/library.jpeg') }}"
                    alt="College Library"
                    loading="lazy"
                >

                <div class="gallery-overlay">
                    <div>
                        <span>Library</span>
                    </div>

                    <span class="gallery-view-icon">
                        +
                    </span>
                </div>

            </a>

            <a href="{{ asset('images/gallery/library2.jpeg') }}"
               class="gallery-card"
               data-gallery="college-gallery">

                <img
                    src="{{ asset('images/gallery/library2.jpeg') }}"
                    alt="College Library"
                    loading="lazy"
                >

                <div class="gallery-overlay">
                    <div>
                        <span>Library Secondary View</span>
                    </div>

                    <span class="gallery-view-icon">
                        +
                    </span>
                </div>

            </a>

            <!-- Skills Lab -->
            <a href="{{ asset('images/gallery/skills-lab.jpeg') }}"
               class="gallery-card gallery-card-wide"
               data-gallery="college-gallery">

                <img
                    src="{{ asset('images/gallery/skills-lab.jpeg') }}"
                    alt="Nursing Skills Laboratory"
                    loading="lazy"
                >

                <div class="gallery-overlay">
                    <div>
                        <span>Nursing Skills Lab</span>
                    </div>

                    <span class="gallery-view-icon">
                        +
                    </span>
                </div>

            </a>


            <!-- Classroom -->
            <a href="{{ asset('images/gallery/classroom.jpeg') }}"
               class="gallery-card"
               data-gallery="college-gallery">

                <img
                    src="{{ asset('images/gallery/classroom.jpeg') }}"
                    alt="Nursing College Classroom"
                    loading="lazy"
                >

                <div class="gallery-overlay">
                    <div>
                        <span>Classroom</span>
                    </div>

                    <span class="gallery-view-icon">
                        +
                    </span>
                </div>

            </a>


            <!-- Campus -->
            <a href="{{ asset('images/gallery/corridor.jpeg') }}"
               class="gallery-card gallery-card-wide"
               data-gallery="college-gallery">

                <img
                    src="{{ asset('images/gallery/corridor.jpeg') }}"
                    alt="College Corridor"
                    loading="lazy"
                >

                <div class="gallery-overlay">
                    <div>
                        <span>Our Campus</span>
                    </div>

                    <span class="gallery-view-icon">
                        +
                    </span>
                </div>

            </a>

        </div>

    </div>
</section>


@endsection