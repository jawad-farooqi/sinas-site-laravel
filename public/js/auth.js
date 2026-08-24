/* ==========================================================================
   Meridian College of Nursing — Auth / Authorization (client-side demo)
   Roles: admin, faculty, student, applicant
   Storage: localStorage (demo only — a real deployment must verify roles
   and sessions on a server, never trust client-side role checks alone).
   ========================================================================== */

const MC_AUTH = (() => {
  const USERS_KEY = "mc_users";
  const SESSION_KEY = "mc_session";

  const PERMISSIONS = {
    admin:     ["news:write", "gallery:write", "faculty:write", "departments:write", "users:write", "dashboard:view"],
    faculty:   ["news:write", "gallery:write", "dashboard:view"],
    student:   ["dashboard:view"],
    applicant: []
  };

  function seed() {
    if (localStorage.getItem(USERS_KEY)) return;
    const demoUsers = [
      { id: "u1", name: "Dr. Amara Reyes", email: "admin@meridian.edu", password: "Admin123!", role: "admin", status: "active", joined: "2022-01-14" },
      { id: "u2", name: "James Whitfield, RN", email: "faculty@meridian.edu", password: "Faculty123!", role: "faculty", status: "active", joined: "2022-08-02" },
      { id: "u3", name: "Priya Anand", email: "student@meridian.edu", password: "Student123!", role: "student", status: "active", joined: "2024-09-01" },
      { id: "u4", name: "Marcus Doyle", email: "applicant@meridian.edu", password: "Applicant123!", role: "applicant", status: "pending", joined: "2026-06-11" }
    ];
    localStorage.setItem(USERS_KEY, JSON.stringify(demoUsers));
  }

  function getUsers() {
    seed();
    return JSON.parse(localStorage.getItem(USERS_KEY) || "[]");
  }

  function saveUsers(users) {
    localStorage.setItem(USERS_KEY, JSON.stringify(users));
  }

  function register({ name, email, password, role }) {
    const users = getUsers();
    if (users.some(u => u.email.toLowerCase() === email.toLowerCase())) {
      return { ok: false, error: "An account with this email already exists." };
    }
    const user = {
      id: "u" + Date.now(),
      name, email, password,
      role: role || "applicant",
      status: role === "applicant" || !role ? "pending" : "active",
      joined: new Date().toISOString().slice(0, 10)
    };
    users.push(user);
    saveUsers(users);
    setSession(user);
    return { ok: true, user };
  }

  function login(email, password) {
    const users = getUsers();
    const user = users.find(u => u.email.toLowerCase() === email.toLowerCase() && u.password === password);
    if (!user) return { ok: false, error: "Incorrect email or password." };
    setSession(user);
    return { ok: true, user };
  }

  function setSession(user) {
    localStorage.setItem(SESSION_KEY, JSON.stringify({ id: user.id, name: user.name, email: user.email, role: user.role }));
  }

  function currentUser() {
    const raw = localStorage.getItem(SESSION_KEY);
    return raw ? JSON.parse(raw) : null;
  }

  function logout() {
    localStorage.removeItem(SESSION_KEY);
  }

  function can(permission) {
    const user = currentUser();
    if (!user) return false;
    return (PERMISSIONS[user.role] || []).includes(permission);
  }

  function requireRole(roles, redirectTo = "login.html") {
    const user = currentUser();
    if (!user) { window.location.href = redirectTo + "?next=" + encodeURIComponent(window.location.pathname.split("/").pop()); return null; }
    if (roles && !roles.includes(user.role)) { window.location.href = "unauthorized.html"; return null; }
    return user;
  }

  return { getUsers, saveUsers, register, login, logout, currentUser, can, requireRole, PERMISSIONS };
})();
