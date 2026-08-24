/* Meridian College of Nursing — shared front-end behavior */

document.addEventListener("DOMContentLoaded", () => {
  reflectAuthState();
  wireLogout();
  wireRevealOnScroll();
  wireContactForm();
  wireCounters();
  injectPulseDividers();
});

/* Replace <span data-pulse-divider="divider|hero"> placeholders with SVG */
function injectPulseDividers() {
  document.querySelectorAll("[data-pulse-divider]").forEach(el => {
    el.outerHTML = mcPulseSVG(el.dataset.pulseDivider || "divider");
  });
}

/* Show Log in / Sign up vs. account menu depending on session */
function reflectAuthState() {
  const user = window.MC_AUTH ? MC_AUTH.currentUser() : null;
  const guestSlot = document.getElementById("nav-guest");
  const userSlot = document.getElementById("nav-user");
  if (!guestSlot || !userSlot) return;

  if (user) {
    guestSlot.classList.add("d-none");
    userSlot.classList.remove("d-none");
    const nameEl = userSlot.querySelector("[data-user-name]");
    const roleEl = userSlot.querySelector("[data-user-role]");
    if (nameEl) nameEl.textContent = user.name.split(" ")[0];
    if (roleEl) { roleEl.textContent = user.role; roleEl.className = "role-badge " + user.role; }
    const dashLink = userSlot.querySelector("[data-dash-link]");
    if (dashLink && user.role === "applicant") dashLink.classList.add("d-none");
  } else {
    guestSlot.classList.remove("d-none");
    userSlot.classList.add("d-none");
  }
}

function wireLogout() {
  document.querySelectorAll("[data-logout]").forEach(btn => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      MC_AUTH.logout();
      window.location.href = "index.html";
    });
  });
}

/* Fade/rise elements into view */
function wireRevealOnScroll() {
  const items = document.querySelectorAll(".reveal");
  if (!items.length) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        io.unobserve(entry.target);
      }
    });
  }, { threshold: 0.15 });
  items.forEach(el => io.observe(el));
}

/* Animate the mono stat numbers in the hero / stat strips */
function wireCounters() {
  const counters = document.querySelectorAll("[data-count-to]");
  if (!counters.length) return;
  const io = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const el = entry.target;
      const target = parseFloat(el.dataset.countTo);
      const suffix = el.dataset.suffix || "";
      const duration = 1200;
      const start = performance.now();
      function tick(now) {
        const p = Math.min(1, (now - start) / duration);
        const val = Math.floor(p * target);
        el.textContent = val + suffix;
        if (p < 1) requestAnimationFrame(tick);
        else el.textContent = target + suffix;
      }
      requestAnimationFrame(tick);
      io.unobserve(el);
    });
  }, { threshold: 0.4 });
  counters.forEach(el => io.observe(el));
}

/* Contact form — front-end validation + simulated submit */
function wireContactForm() {
  const form = document.getElementById("contactForm");
  if (!form) return;
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!form.checkValidity()) {
      form.classList.add("was-validated");
      return;
    }
    const btn = form.querySelector("button[type=submit]");
    const original = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = "Sending&hellip;";
    setTimeout(() => {
      form.classList.add("d-none");
      document.getElementById("contactSuccess").classList.remove("d-none");
      btn.disabled = false;
      btn.innerHTML = original;
    }, 900);
  });
}

/* Build a decorative pulse-trace SVG divider, injected wherever
   <span data-pulse-divider> appears, so markup stays clean. */
function mcPulseSVG(variant = "divider") {
  const path = variant === "hero"
    ? "M0,80 L120,80 L150,20 L180,140 L210,80 L280,80 L310,50 L340,110 L370,80 L500,80 L530,30 L560,130 L590,80 L720,80 L750,60 L780,100 L810,80 L960,80 L990,20 L1020,140 L1050,80 L1200,80"
    : "M0,23 L60,23 L75,6 L90,40 L105,23 L160,23 L175,12 L190,34 L205,23 L280,23 L295,3 L310,43 L325,23 L400,23";
  return `<svg class="${variant === "hero" ? "pulse-hero-line" : "pulse-divider"}" viewBox="0 0 ${variant === "hero" ? "1200 160" : "400 46"}" preserveAspectRatio="none" aria-hidden="true"><path class="pulse-draw" d="${path}"/></svg>`;
}
