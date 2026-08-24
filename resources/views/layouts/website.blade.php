<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>
    @yield('title', 'SINAS')
</title>

<meta name="description" content="Meridian College of Nursing offers accredited BSN and MSN programs with hands-on clinical training and a 96% NCLEX pass rate.">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600;9..144,700&family=Inter:wght@400;500;600;700&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===================== NAVBAR ===================== -->
<nav class="navbar navbar-expand-lg mc-nav py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
      <span class="brand-mark font-mono fw-bold">M</span>
      <span class="font-display fw-600" style="font-size:1.15rem;">Meridian <span class="text-teal">Nursing</span></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <i class="bi bi-list fs-2"></i>
    </button>
    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link nav-link-vital active" href="index.html">Home</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital" href="courses.html">Courses</a></li>
                <li class="nav-item"><a class="nav-link nav-link-vital" href="news.html">News</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital" href="gallery.html">Gallery</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital" href="admissions.html">Admissions</a></li>
        <li class="nav-item"><a class="nav-link nav-link-vital" href="contact.html">Contact</a></li>
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


@yield('content')

<!-- ===================== FOOTER ===================== -->
<footer class="mc-footer pt-5 pb-4">
  <div class="container">
    <div class="row g-4 mb-4">
      <div class="col-lg-4">
        <a href="index.html" class="d-flex align-items-center gap-2 mb-3">
          <span class="brand-mark font-mono fw-bold">M</span>
          <span class="font-display fw-600 text-white" style="font-size:1.1rem;">Meridian Nursing</span>
        </a>
        <p class="small">120 Harrow Street, Cedarville — training nurses for public, private and community health systems since 1987.</p>
      </div>
      <div class="col-6 col-lg-2">
        <h4 class="text-white h6 mb-3">Explore</h4>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="courses.html">Courses</a></li>
          <li class="mb-2"><a href="admissions.html">Admissions</a></li>
          <li class="mb-2"><a href="contact.html">Contact</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h4 class="text-white h6 mb-3">Account</h4>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="login.html">Log in</a></li>
          <li class="mb-2"><a href="register.html">Apply / Register</a></li>
          <li class="mb-2"><a href="dashboard.html">Staff dashboard</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <h4 class="text-white h6 mb-3">Demo accounts</h4>
        <p class="small font-mono mb-1">admin@meridian.edu / Admin123!</p>
        <p class="small font-mono mb-0">faculty@meridian.edu / Faculty123!</p>
      </div>
    </div>
    <div class="pt-4 border-top d-flex flex-wrap justify-content-between gap-2" style="border-color:rgba(255,255,255,0.12) !important;">
      <p class="small mb-0">&copy; 2026 Meridian College of Nursing. All rights reserved.</p>
      <p class="small mb-0">Design concept &amp; demo build</p>
    </div>
  </div>
</footer>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/auth.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/main.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const list = document.getElementById("landingNewsList");
    if (!list) return;
    const fmt = (iso) => new Date(iso + "T00:00:00").toLocaleDateString(undefined, { year: "numeric", month: "long", day: "numeric" });
    const items = MC_DASH.get("news").slice().sort((a, b) => b.date.localeCompare(a.date)).slice(0, 3);
    list.innerHTML = items.length ? items.map(n => `
      <div class="col-md-4 reveal">
        <div class="card-vital p-4 h-100">
          <p class="font-mono small text-teal mb-2"><i class="bi bi-calendar3 me-1"></i>${fmt(n.date)}</p>
          <h3 class="h6 mb-0">${escapeHTML(n.title)}</h3>
        </div>
      </div>`).join("") : `<p class="text-ink-soft">No announcements published yet.</p>`;
  });
</script>
</body>
</html>
