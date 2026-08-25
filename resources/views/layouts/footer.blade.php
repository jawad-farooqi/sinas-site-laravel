<!-- ===================== FOOTER ===================== -->
<footer class="mc-footer pt-5 pb-4">
  <div class="container">
    <div class="row g-4 mb-4">
      <div class="col-lg-4">
        <a href="{{ route('home') }}" class="d-flex align-items-center gap-2 mb-3">
          <span class="brand-mark font-mono fw-bold">
            <img src="{{ asset('images/sinas-logo.png') }}"
                 alt="SINAS Logo"
                 style="width: 80px; height: auto;">
        </span>
          <span class="font-display fw-600 text-white" style="font-size:1.1rem;">Saidu Institute of Nursing and Allied Health Sciences</span>
        </a>
        <p class="small">Chinar Bagh Colony, Chail Shagai, Saidu Sharif, Swat  — training students in nursing and allied health disciplines to serve public, private, and community healthcare systems. since 2026.</p>
      </div>
      <div class="col-6 col-lg-2">
        <h4 class="text-white h6 mb-3">Explore</h4>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="{{ route('courses') }}">Courses</a></li>
          <li class="mb-2"><a href="{{ route('gallery') }}">Gallery</a></li>
          <li class="mb-2"><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
      </div>
      <div class="col-6 col-lg-2">
        <h4 class="text-white h6 mb-3">Account</h4>
        <ul class="list-unstyled small">
          <li class="mb-2"><a href="{{ route('login') }}">Log in</a></li>
        </ul>
      </div>
      <div class="col-lg-4">
        <h4 class="text-white h6 mb-3">Contact</h4>
        <p class="small font-mono mb-1">sinas.swat@gmail.com</p>
        <p class="small font-mono mb-0">0319-9309590</p>
      </div>
    </div>
    <div class="pt-4 border-top d-flex flex-wrap justify-content-between gap-2" style="border-color:rgba(255,255,255,0.12) !important;">
      <p class="small mb-0">&copy; 2026 SINAS - All rights reserved.</p>
      
    </div>
  </div>
</footer>
 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/auth.js') }}"></script>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
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