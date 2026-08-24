/* ==========================================================================
   Meridian College of Nursing — Admin Dashboard
   Mock data layer backed by localStorage. Every "write" action here checks
   MC_AUTH.can() first, so faculty accounts see the same shell but only the
   panels their role permission list actually grants.
   ========================================================================== */

const MC_DASH = (() => {
  const KEYS = { news: "mc_news", faculty: "mc_faculty", departments: "mc_departments", gallery: "mc_gallery" };

  function seed() {
    if (!localStorage.getItem(KEYS.departments)) {
      localStorage.setItem(KEYS.departments, JSON.stringify([
        { id: "d1", name: "Fundamentals of Nursing", head: "Dr. Amara Reyes", faculty: 8, students: 210, desc: "Foundational patient care, clinical skills labs, and first-year theory." },
        { id: "d2", name: "Medical-Surgical Nursing", head: "James Whitfield, RN", faculty: 11, students: 265, desc: "Adult acute and chronic illness care across surgical and medical units." },
        { id: "d3", name: "Pediatric & Maternal Health", head: "Dr. Louisa Okafor", faculty: 7, students: 140, desc: "Obstetric, neonatal, and pediatric nursing practice and theory." },
        { id: "d4", name: "Psychiatric & Mental Health", head: "Dr. Samuel Ibe", faculty: 5, students: 95, desc: "Behavioral health assessment, therapeutic communication, and crisis care." },
        { id: "d5", name: "Community & Public Health", head: "Elena Marsh, RN", faculty: 6, students: 118, desc: "Population health, home visits, and preventive-care fieldwork." }
      ]));
    }
    if (!localStorage.getItem(KEYS.faculty)) {
      localStorage.setItem(KEYS.faculty, JSON.stringify([
        { id: "f1", name: "Dr. Amara Reyes", title: "Dean & Professor", dept: "Fundamentals of Nursing", email: "a.reyes@meridian.edu", status: "active" },
        { id: "f2", name: "James Whitfield, RN", title: "Associate Professor", dept: "Medical-Surgical Nursing", email: "j.whitfield@meridian.edu", status: "active" },
        { id: "f3", name: "Dr. Louisa Okafor", title: "Program Chair", dept: "Pediatric & Maternal Health", email: "l.okafor@meridian.edu", status: "active" },
        { id: "f4", name: "Dr. Samuel Ibe", title: "Assistant Professor", dept: "Psychiatric & Mental Health", email: "s.ibe@meridian.edu", status: "on leave" },
        { id: "f5", name: "Elena Marsh, RN", title: "Clinical Instructor", dept: "Community & Public Health", email: "e.marsh@meridian.edu", status: "active" }
      ]));
    }
    if (!localStorage.getItem(KEYS.news)) {
      localStorage.setItem(KEYS.news, JSON.stringify([
        { id: "n1", title: "Class of 2026 Pinning Ceremony set for December", date: "2026-08-10", excerpt: "Graduating BSN students will be pinned at the Whitcombe Auditorium; families welcome.", files: ["pinning-flyer.pdf"] },
        { id: "n2", title: "New simulation lab opens in Founders Hall", date: "2026-07-22", excerpt: "Twelve high-fidelity manikins now support med-surg and OB simulation rotations.", files: ["sim-lab-1.jpg", "sim-lab-2.jpg"] },
        { id: "n3", title: "Meridian earns five-year CCNE re-accreditation", date: "2026-06-30", excerpt: "The BSN and MSN programs were both re-accredited without conditions.", files: [] }
      ]));
    }
    if (!localStorage.getItem(KEYS.gallery)) {
      localStorage.setItem(KEYS.gallery, JSON.stringify([
        { id: "g1", caption: "Skills lab — IV insertion practice", category: "Campus Life" },
        { id: "g2", caption: "White Coat Ceremony, 2025 cohort", category: "Events" },
        { id: "g3", caption: "Community health outreach van", category: "Community" },
        { id: "g4", caption: "Founders Hall simulation suite", category: "Facilities" }
      ]));
    }
  }

  function get(key) { seed(); return JSON.parse(localStorage.getItem(KEYS[key]) || "[]"); }
  function set(key, val) { localStorage.setItem(KEYS[key], JSON.stringify(val)); }

  return { KEYS, get, set };
})();

document.addEventListener("DOMContentLoaded", () => {
  if (!document.body.classList.contains("dash-page")) return;

  const user = MC_AUTH.requireRole(["admin", "faculty"]);
  if (!user) return;

  document.querySelectorAll("[data-me-name]").forEach(el => el.textContent = user.name);
  document.querySelectorAll("[data-me-role]").forEach(el => { el.textContent = user.role; el.className = "role-badge " + user.role; });

  // Hide admin-only nav items / panels for faculty accounts
  if (!MC_AUTH.can("users:write")) {
    document.querySelectorAll("[data-admin-only]").forEach(el => el.remove());
  }

  wireSidebarNav();
  renderOverview();
  renderNews();
  wireNewsForm();
  if (MC_AUTH.can("users:write")) { renderUsers(); wireUserForm(); }
  renderFaculty();
  wireFacultyForm();
  renderDepartments();
  wireDepartmentForm();
  renderGallery();
  wireGalleryForm();
});

/* ---------------- Sidebar / panel switching ---------------- */
function wireSidebarNav() {
  const links = document.querySelectorAll(".dash-link[data-panel]");
  links.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      links.forEach(l => l.classList.remove("active"));
      link.classList.add("active");
      document.querySelectorAll(".dash-panel").forEach(p => p.classList.add("d-none"));
      document.getElementById("panel-" + link.dataset.panel).classList.remove("d-none");
      document.getElementById("panelTitle").textContent = link.dataset.title || link.textContent.trim();
      const offcanvasEl = document.getElementById("dashSidebarOffcanvas");
      if (offcanvasEl && window.bootstrap) {
        const inst = bootstrap.Offcanvas.getInstance(offcanvasEl);
        if (inst) inst.hide();
      }
    });
  });
}

/* ---------------- Overview ---------------- */
function renderOverview() {
  const news = MC_DASH.get("news"), faculty = MC_DASH.get("faculty"), depts = MC_DASH.get("departments"), users = MC_DASH.get("faculty");
  const set = (id, val) => { const el = document.getElementById(id); if (el) el.textContent = val; };
  set("statNews", MC_DASH.get("news").length);
  set("statFaculty", MC_DASH.get("faculty").length);
  set("statDepts", MC_DASH.get("departments").length);
  set("statUsers", MC_AUTH.getUsers().length);
  const feed = document.getElementById("overviewFeed");
  if (feed) {
    feed.innerHTML = MC_DASH.get("news").slice(0, 4).map(n => `
      <div class="d-flex justify-content-between align-items-start py-2 border-bottom">
        <div>
          <p class="mb-0 fw-semibold small">${escapeHTML(n.title)}</p>
          <p class="mb-0 text-ink-soft small font-mono">${n.date}</p>
        </div>
      </div>`).join("");
  }
}

/* ---------------- News (multi-file upload) ---------------- */
function renderNews() {
  const tbody = document.getElementById("newsTableBody");
  if (!tbody) return;
  const items = MC_DASH.get("news").slice().sort((a, b) => b.date.localeCompare(a.date));
  tbody.innerHTML = items.map(n => `
    <tr>
      <td>
        <p class="fw-semibold mb-1">${escapeHTML(n.title)}</p>
        <p class="text-ink-soft small mb-0">${escapeHTML(n.excerpt)}</p>
      </td>
      <td class="font-mono small">${n.date}</td>
      <td>${n.files.length ? n.files.map(f => `<span class="file-chip mb-1">📎 ${escapeHTML(f)}</span>`).join("<br>") : '<span class="text-ink-soft small">None</span>'}</td>
      <td class="text-end">
        <button class="btn btn-sm btn-outline-vital" data-del-news="${n.id}" ${MC_AUTH.can("news:write") ? "" : "disabled"}>Remove</button>
      </td>
    </tr>`).join("") || `<tr><td colspan="4" class="text-center text-ink-soft py-4">No articles yet. Publish your first update.</td></tr>`;

  tbody.querySelectorAll("[data-del-news]").forEach(btn => {
    btn.addEventListener("click", () => {
      const items = MC_DASH.get("news").filter(n => n.id !== btn.dataset.delNews);
      MC_DASH.set("news", items);
      renderNews(); renderOverview();
      toast("Article removed.");
    });
  });
}

function wireNewsForm() {
  const form = document.getElementById("newsForm");
  if (!form) return;
  if (!MC_AUTH.can("news:write")) { form.querySelectorAll("input,textarea,button").forEach(el => el.disabled = true); return; }

  const dropzone = document.getElementById("newsDropzone");
  const fileInput = document.getElementById("newsFiles");
  const fileList = document.getElementById("newsFileList");
  let staged = [];

  function renderStaged() {
    fileList.innerHTML = staged.map((f, i) => `
      <span class="file-chip">📎 ${escapeHTML(f.name)} <button type="button" class="btn-close btn-close-sm ms-1" data-remove-staged="${i}" aria-label="Remove file"></button></span>
    `).join(" ");
    fileList.querySelectorAll("[data-remove-staged]").forEach(btn => {
      btn.addEventListener("click", () => { staged.splice(+btn.dataset.removeStaged, 1); renderStaged(); });
    });
  }

  function addFiles(fileListObj) {
    Array.from(fileListObj).forEach(f => staged.push(f));
    renderStaged();
  }

  dropzone.addEventListener("click", () => fileInput.click());
  fileInput.addEventListener("change", () => addFiles(fileInput.files));
  ["dragenter", "dragover"].forEach(evt => dropzone.addEventListener(evt, (e) => { e.preventDefault(); dropzone.classList.add("drag-over"); }));
  ["dragleave", "drop"].forEach(evt => dropzone.addEventListener(evt, (e) => { e.preventDefault(); dropzone.classList.remove("drag-over"); }));
  dropzone.addEventListener("drop", (e) => { if (e.dataTransfer.files.length) addFiles(e.dataTransfer.files); });

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const title = document.getElementById("newsTitle").value.trim();
    const excerpt = document.getElementById("newsExcerpt").value.trim();
    if (!title || !excerpt) { form.classList.add("was-validated"); return; }
    const items = MC_DASH.get("news");
    items.push({ id: "n" + Date.now(), title, excerpt, date: new Date().toISOString().slice(0, 10), files: staged.map(f => f.name) });
    MC_DASH.set("news", items);
    form.reset(); staged = []; renderStaged();
    renderNews(); renderOverview();
    toast("Article published.");
  });
}

/* ---------------- Users (admin only) ---------------- */
function renderUsers() {
  const tbody = document.getElementById("usersTableBody");
  if (!tbody) return;
  const users = MC_AUTH.getUsers();
  tbody.innerHTML = users.map(u => `
    <tr>
      <td>
        <p class="fw-semibold mb-0">${escapeHTML(u.name)}</p>
        <p class="text-ink-soft small mb-0">${escapeHTML(u.email)}</p>
      </td>
      <td>
        <select class="form-select form-select-sm" style="width:130px" data-role-select="${u.id}">
          ${["admin", "faculty", "student", "applicant"].map(r => `<option value="${r}" ${r === u.role ? "selected" : ""}>${r}</option>`).join("")}
        </select>
      </td>
      <td><span class="badge-vital ${u.status === "active" ? "" : "coral"}">${u.status}</span></td>
      <td class="font-mono small">${u.joined}</td>
      <td class="text-end">
        <button class="btn btn-sm btn-outline-vital" data-del-user="${u.id}">Remove</button>
      </td>
    </tr>`).join("");

  tbody.querySelectorAll("[data-role-select]").forEach(sel => {
    sel.addEventListener("change", () => {
      const users = MC_AUTH.getUsers().map(u => u.id === sel.dataset.roleSelect ? { ...u, role: sel.value, status: sel.value === "applicant" ? u.status : "active" } : u);
      MC_AUTH.saveUsers(users);
      renderUsers();
      toast("Role updated.");
    });
  });
  tbody.querySelectorAll("[data-del-user]").forEach(btn => {
    btn.addEventListener("click", () => {
      const users = MC_AUTH.getUsers().filter(u => u.id !== btn.dataset.delUser);
      MC_AUTH.saveUsers(users);
      renderUsers();
      toast("User removed.");
    });
  });
}

function wireUserForm() {
  const form = document.getElementById("userForm");
  if (!form) return;
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("userName").value.trim();
    const email = document.getElementById("userEmail").value.trim();
    const role = document.getElementById("userRole").value;
    if (!name || !email) { form.classList.add("was-validated"); return; }
    const users = MC_AUTH.getUsers();
    if (users.some(u => u.email.toLowerCase() === email.toLowerCase())) { toast("That email is already registered.", true); return; }
    users.push({ id: "u" + Date.now(), name, email, password: "Temp" + Math.floor(Math.random() * 9000 + 1000) + "!", role, status: "active", joined: new Date().toISOString().slice(0, 10) });
    MC_AUTH.saveUsers(users);
    form.reset();
    renderUsers();
    toast("Account created.");
  });
}

/* ---------------- Faculty ---------------- */
function renderFaculty() {
  const tbody = document.getElementById("facultyTableBody");
  if (!tbody) return;
  const faculty = MC_DASH.get("faculty");
  tbody.innerHTML = faculty.map(f => `
    <tr>
      <td class="fw-semibold">${escapeHTML(f.name)}</td>
      <td>${escapeHTML(f.title)}</td>
      <td>${escapeHTML(f.dept)}</td>
      <td class="small text-ink-soft">${escapeHTML(f.email)}</td>
      <td><span class="badge-vital ${f.status === "active" ? "" : "gold"}">${f.status}</span></td>
      <td class="text-end"><button class="btn btn-sm btn-outline-vital" data-del-faculty="${f.id}" ${MC_AUTH.can("faculty:write") ? "" : "disabled"}>Remove</button></td>
    </tr>`).join("") || `<tr><td colspan="6" class="text-center text-ink-soft py-4">No faculty on file.</td></tr>`;

  tbody.querySelectorAll("[data-del-faculty]").forEach(btn => {
    btn.addEventListener("click", () => {
      MC_DASH.set("faculty", MC_DASH.get("faculty").filter(f => f.id !== btn.dataset.delFaculty));
      renderFaculty(); renderOverview();
      toast("Faculty member removed.");
    });
  });

  const deptSelect = document.getElementById("facultyDept");
  if (deptSelect) {
    const depts = MC_DASH.get("departments");
    deptSelect.innerHTML = depts.map(d => `<option>${escapeHTML(d.name)}</option>`).join("");
  }
}

function wireFacultyForm() {
  const form = document.getElementById("facultyForm");
  if (!form) return;
  if (!MC_AUTH.can("faculty:write")) { form.querySelectorAll("input,select,button").forEach(el => el.disabled = true); return; }
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("facultyName").value.trim();
    const title = document.getElementById("facultyTitle").value.trim();
    const dept = document.getElementById("facultyDept").value;
    const email = document.getElementById("facultyEmail").value.trim();
    if (!name || !title || !email) { form.classList.add("was-validated"); return; }
    const list = MC_DASH.get("faculty");
    list.push({ id: "f" + Date.now(), name, title, dept, email, status: "active" });
    MC_DASH.set("faculty", list);
    form.reset();
    renderFaculty(); renderOverview();
    toast("Faculty member added.");
  });
}

/* ---------------- Departments ---------------- */
function renderDepartments() {
  const wrap = document.getElementById("departmentCards");
  if (!wrap) return;
  const depts = MC_DASH.get("departments");
  wrap.innerHTML = depts.map(d => `
    <div class="col-md-6 col-xl-4">
      <div class="card-vital p-4 h-100">
        <div class="d-flex justify-content-between align-items-start">
          <h3 class="h6 mb-1">${escapeHTML(d.name)}</h3>
          <button class="btn btn-sm btn-outline-vital" data-del-dept="${d.id}" ${MC_AUTH.can("departments:write") ? "" : "disabled"}>&times;</button>
        </div>
        <p class="text-ink-soft small mb-2">${escapeHTML(d.desc)}</p>
        <p class="small mb-1"><strong>Head:</strong> ${escapeHTML(d.head)}</p>
        <div class="d-flex gap-3 font-mono small text-teal mt-2">
          <span>${d.faculty} faculty</span><span>${d.students} students</span>
        </div>
      </div>
    </div>`).join("");

  wrap.querySelectorAll("[data-del-dept]").forEach(btn => {
    btn.addEventListener("click", () => {
      MC_DASH.set("departments", MC_DASH.get("departments").filter(d => d.id !== btn.dataset.delDept));
      renderDepartments(); renderOverview(); renderFaculty();
      toast("Department removed.");
    });
  });
}

function wireDepartmentForm() {
  const form = document.getElementById("departmentForm");
  if (!form) return;
  if (!MC_AUTH.can("departments:write")) { form.querySelectorAll("input,textarea,button").forEach(el => el.disabled = true); return; }
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("deptName").value.trim();
    const head = document.getElementById("deptHead").value.trim();
    const desc = document.getElementById("deptDesc").value.trim();
    if (!name || !head) { form.classList.add("was-validated"); return; }
    const list = MC_DASH.get("departments");
    list.push({ id: "d" + Date.now(), name, head, desc, faculty: 0, students: 0 });
    MC_DASH.set("departments", list);
    form.reset();
    renderDepartments(); renderOverview();
    toast("Department created.");
  });
}

/* ---------------- Gallery ---------------- */
function renderGallery() {
  const grid = document.getElementById("galleryGrid");
  if (!grid) return;
  const items = MC_DASH.get("gallery");
  grid.innerHTML = items.map(g => `
    <div class="col-6 col-md-4 col-xl-3">
      <div class="gallery-tile mb-2 d-flex align-items-center justify-content-center">
        <span class="font-mono small text-teal">${escapeHTML(g.category)}</span>
      </div>
      <div class="d-flex justify-content-between align-items-start">
        <p class="small mb-0">${escapeHTML(g.caption)}</p>
        <button class="btn btn-sm btn-outline-vital py-0 px-2" data-del-gallery="${g.id}" ${MC_AUTH.can("gallery:write") ? "" : "disabled"}>&times;</button>
      </div>
    </div>`).join("") || `<p class="text-ink-soft py-4">No images yet.</p>`;

  grid.querySelectorAll("[data-del-gallery]").forEach(btn => {
    btn.addEventListener("click", () => {
      MC_DASH.set("gallery", MC_DASH.get("gallery").filter(g => g.id !== btn.dataset.delGallery));
      renderGallery();
      toast("Image removed.");
    });
  });
}

function wireGalleryForm() {
  const form = document.getElementById("galleryForm");
  if (!form) return;
  if (!MC_AUTH.can("gallery:write")) { form.querySelectorAll("input,select,button").forEach(el => el.disabled = true); return; }
  const fileInput = document.getElementById("galleryFiles");
  const fileList = document.getElementById("galleryFileList");
  fileInput.addEventListener("change", () => {
    fileList.innerHTML = Array.from(fileInput.files).map(f => `<span class="file-chip">🖼 ${escapeHTML(f.name)}</span>`).join(" ");
  });
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const category = document.getElementById("galleryCategory").value;
    const caption = document.getElementById("galleryCaption").value.trim();
    if (!caption || !fileInput.files.length) { form.classList.add("was-validated"); return; }
    const items = MC_DASH.get("gallery");
    Array.from(fileInput.files).forEach((f, i) => {
      items.push({ id: "g" + Date.now() + i, caption: fileInput.files.length > 1 ? `${caption} (${i + 1})` : caption, category });
    });
    MC_DASH.set("gallery", items);
    form.reset(); fileList.innerHTML = "";
    renderGallery();
    toast("Photos uploaded to gallery.");
  });
}

/* ---------------- Helpers ---------------- */
function escapeHTML(str) {
  return String(str).replace(/[&<>"']/g, (c) => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "'": "&#39;" }[c]));
}

function toast(message, isError = false) {
  const holder = document.getElementById("toastHolder");
  if (!holder) return;
  const el = document.createElement("div");
  el.className = `toast-vital align-items-center text-white border-0 rounded-2 mb-2 px-3 py-2 ${isError ? "bg-danger" : "bg-teal-deep"}`;
  el.style.cssText = "opacity:0; transform: translateY(8px); transition: all .25s ease;";
  el.textContent = message;
  holder.appendChild(el);
  requestAnimationFrame(() => { el.style.opacity = 1; el.style.transform = "translateY(0)"; });
  setTimeout(() => { el.style.opacity = 0; setTimeout(() => el.remove(), 250); }, 2600);
}
