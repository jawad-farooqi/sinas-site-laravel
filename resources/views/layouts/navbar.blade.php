<!-- ===================== NAVBAR ===================== -->
<nav class="navbar navbar-expand-lg mc-nav py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
      <span class="brand-mark font-mono fw-bold"><img src="{{ asset('images/sinas-logo.png') }}" alt="SINAS Logo" class="img-fluid"></span>
      <span class="font-display fw-600" style="font-size:1.15rem;">SINAS <span class="text-teal">Nursing College</span></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <i class="bi bi-list fs-2"></i>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link nav-link-vital {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital {{ request()->routeIs('courses') ? 'active' : '' }}" href="{{ route('courses') }}">Courses</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital {{ request()->routeIs('news') ? 'active' : '' }}" href="{{ route('news') }}">News</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital {{ request()->routeIs('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">Gallery</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital {{ request()->routeIs('admissions') ? 'active' : '' }}" href="{{ route('admissions') }}">Admissions</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
      </ul>
      <div id="nav-guest" class="d-flex gap-2">
        <a href="login.html" class="btn-outline-vital">Log in</a>
        <a href="register.html" class="btn-vital">Apply now</a>
      </div>
      <div id="nav-user" class="d-none dropdown">
        <button class="btn-outline-vital dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown">
          <span data-user-name>Account</span>
          <span class="role-badge" data-user-role>role</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end mt-2 shadow border-0" style="border-radius:8px;">
          <li><a class="dropdown-item" href="dashboard.html" data-dash-link><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
          <li><a class="dropdown-item" href="#" data-logout><i class="bi bi-box-arrow-right me-2"></i>Log out</a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>