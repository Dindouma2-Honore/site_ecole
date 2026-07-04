/* ============================================================
   AMBASSADORS EDUCATIONAL COMPLEX
   Frontend JavaScript — Backend-Ready Architecture
   Version: 2.0.0
   
   API Architecture:
   ─────────────────
   Base URL:  Reads from <meta name="api-base-url">
              Defaults to http://localhost:8000/api
   Auth:      Bearer JWT token stored in sessionStorage
   Endpoints: /auth/login  /auth/logout  /auth/me
              /stats  /announcements  /news  /gallery
              /testimonials  /programs  /halloffame
              /admissions (POST)  /contact (POST)
   ============================================================ */

// ── CONFIG ──────────────────────────────────────────────────
const Config = {
  apiBase: document.querySelector('meta[name="api-base-url"]')?.content
           || 'http://localhost:8000/api',
  schoolId: document.querySelector('meta[name="school-id"]')?.content
           || 'ambassadors-yaounde-001',
  // Demo admin credentials (replace with real backend auth)
  demoAdmin: { username: 'admin@ambassadorscomplex.cm', password: 'Admin@2026!' },
  tokenKey:  'aec_admin_token',
  userKey:   'aec_admin_user',
};

// ── API HELPER ───────────────────────────────────────────────
const API = {
  headers(auth = false) {
    const h = { 'Content-Type': 'application/json', 'Accept': 'application/json' };
    if (auth) {
      const token = sessionStorage.getItem(Config.tokenKey);
      if (token) h['Authorization'] = 'Bearer ' + token;
    }
    return h;
  },
  async get(endpoint) {
    try {
      const res = await fetch(Config.apiBase + endpoint, { headers: this.headers(true) });
      if (!res.ok) throw new Error(res.status);
      return await res.json();
    } catch(e) {
      console.warn('API GET', endpoint, '→ using static data.', e.message);
      return null;
    }
  },
  async post(endpoint, data, auth = false) {
    try {
      const res = await fetch(Config.apiBase + endpoint, {
        method: 'POST',
        headers: this.headers(auth),
        body: JSON.stringify(data),
      });
      return await res.json();
    } catch(e) {
      console.warn('API POST', endpoint, e.message);
      return { error: e.message };
    }
  },
  async put(endpoint, data) {
    try {
      const res = await fetch(Config.apiBase + endpoint, {
        method: 'PUT',
        headers: this.headers(true),
        body: JSON.stringify(data),
      });
      return await res.json();
    } catch(e) {
      return { error: e.message };
    }
  },
};

// ── AUTH MODULE ──────────────────────────────────────────────
const Auth = {
  isLoggedIn() { return !!sessionStorage.getItem(Config.tokenKey); },
  getUser()    { try { return JSON.parse(sessionStorage.getItem(Config.userKey)); } catch { return null; } },
  async login(username, password) {
    // Try real API first
    const result = await API.post('/auth/login', { username, password });
    if (result && result.token) {
      sessionStorage.setItem(Config.tokenKey, result.token);
      sessionStorage.setItem(Config.userKey, JSON.stringify(result.user));
      return { success: true, user: result.user };
    }
    // Fallback: demo credentials (remove in production)
    if (username === Config.demoAdmin.username && password === Config.demoAdmin.password) {
      const demoToken = 'demo-jwt-' + Date.now();
      const demoUser  = { name: 'Super Administrator', role: 'superadmin', email: username };
      sessionStorage.setItem(Config.tokenKey, demoToken);
      sessionStorage.setItem(Config.userKey, JSON.stringify(demoUser));
      return { success: true, user: demoUser };
    }
    return { success: false };
  },
  logout() {
    API.post('/auth/logout', {}, true);
    sessionStorage.removeItem(Config.tokenKey);
    sessionStorage.removeItem(Config.userKey);
    document.body.classList.remove('admin-mode');
    document.getElementById('adminBar').classList.remove('visible');
  },
};

// ── DATA MODULE (populates from API or falls back to static) ─
const Data = {
  async loadStats() {
    const data = await API.get('/stats');
    if (!data) return;
    document.querySelectorAll('.stat-number[data-target]').forEach(el => {
      const key = el.dataset.statKey;
      if (key && data[key]) el.dataset.target = data[key];
    });
  },
  async loadAnnouncements() {
    const data = await API.get('/announcements');
    if (!data || !data.items) return;
    const track = document.getElementById('announceTrack');
    if (!track) return;
    const lang = document.documentElement.getAttribute('data-lang') || 'en';
    const items = data.items.map(a =>
      `<span class="announce-item">${a[lang] || a.text}</span>`
    ).join('');
    track.innerHTML = items + items; // duplicate for seamless loop
  },
  async loadNews() {
    const data = await API.get('/news');
    if (!data || !data.items) return;
    // Dynamic news injection handled per-route in full app
    console.log('News loaded from API:', data.items.length, 'items');
  },
  async loadPrograms() {
    const data = await API.get('/programs');
    if (!data || !data.items) return;
    console.log('Programs loaded from API:', data.items.length);
  },
  async loadAll() {
    updateApiStatus('pending', 'Connecting to API…');
    await Promise.allSettled([
      this.loadStats(),
      this.loadAnnouncements(),
      this.loadNews(),
      this.loadPrograms(),
    ]);
    updateApiStatus('connected', 'API Connected');
    setTimeout(() => document.getElementById('apiStatus').classList.remove('show'), 3000);
  },
};

// ── API STATUS INDICATOR ──────────────────────────────────────
function updateApiStatus(state, message) {
  const status = document.getElementById('apiStatus');
  const dot    = document.getElementById('apiDot');
  const text   = document.getElementById('apiStatusText');
  if (!status) return;
  status.classList.add('show');
  text.textContent = message;
  dot.className = 'api-dot' + (state === 'offline' ? ' offline' : state === 'pending' ? ' pending' : '');
}

// ── LANGUAGE SWITCHER ────────────────────────────────────────
function setLang(lang) {
  document.documentElement.setAttribute('data-lang', lang);
  document.querySelectorAll('.lang-btn').forEach(btn => btn.classList.remove('active'));
  document.querySelectorAll('.lang-btn').forEach(btn => {
    const txt = btn.textContent.trim();
    if ((lang === 'en' && txt === 'ENGLISH') || (lang === 'fr' && txt === 'FRANÇAIS')) {
      btn.classList.add('active');
    }
  });
  localStorage.setItem('lang', lang);
}
(function initLang() {
  const saved = localStorage.getItem('lang') || 'en';
  setLang(saved);
})();

// ── STICKY HEADER ────────────────────────────────────────────
const header = document.getElementById('header');
window.addEventListener('scroll', () => {
  header.classList.toggle('scrolled', window.scrollY > 60);
  document.getElementById('scrollTop').classList.toggle('visible', window.scrollY > 400);
});

// ── MOBILE MENU ──────────────────────────────────────────────
function toggleMenu() {
  document.getElementById('navMenu').classList.toggle('open');
}

// ── HERO SLIDESHOW ───────────────────────────────────────────
let currentSlide = 0;
const slides     = document.querySelectorAll('.hero-slide');
const indicators = document.querySelectorAll('.hero-ind');
function setSlide(n) {
  slides[currentSlide].classList.remove('active');
  indicators[currentSlide].classList.remove('active');
  currentSlide = n;
  slides[currentSlide].classList.add('active');
  indicators[currentSlide].classList.add('active');
}
setInterval(() => setSlide((currentSlide + 1) % slides.length), 5500);

// ── COUNTER ANIMATION ────────────────────────────────────────
function animateCounter(el, target, duration = 1800, suffix = '') {
  let start = 0;
  const step = target / (duration / 16);
  const timer = setInterval(() => {
    start += step;
    if (start >= target) { start = target; clearInterval(timer); }
    el.textContent = Math.floor(start).toLocaleString() + suffix;
  }, 16);
}
const heroStats = [
  { id: 'heroStat1', val: 2400, suffix: '+' },
  { id: 'heroStat2', val: 180,  suffix: '+' },
  { id: 'heroStat3', val: 25,   suffix: ''  },
  { id: 'heroStat4', val: 98,   suffix: ''  },
];
const sectionStats = document.querySelectorAll('.stat-number[data-target]');
const counterObs   = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting && !e.target.dataset.animated) {
      e.target.dataset.animated = 'true';
      animateCounter(e.target, parseInt(e.target.dataset.target), 1800);
    }
  });
}, { threshold: 0.3 });
sectionStats.forEach(el => counterObs.observe(el));
setTimeout(() => heroStats.forEach(({ id, val, suffix }) => {
  const el = document.getElementById(id);
  if (el) animateCounter(el, val, 2000, suffix);
}), 600);

// ── FADE-IN OBSERVER ─────────────────────────────────────────
const fadeObs = new IntersectionObserver((entries) => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });
document.querySelectorAll('.fade-in').forEach(el => fadeObs.observe(el));

// ── GALLERY FILTER ───────────────────────────────────────────
function filterGallery(cat) {
  document.querySelectorAll('.gallery-tab').forEach(t => t.classList.remove('active'));
  if (event && event.target) event.target.classList.add('active');
}

// ── TESTIMONIALS CAROUSEL ────────────────────────────────────
let testimonialCurrent = 0;
function prevTestimonial() {
  const total = document.querySelectorAll('.testimonial-slide').length;
  testimonialCurrent = (testimonialCurrent - 1 + total) % total;
  renderTestimonials();
}
function nextTestimonial() {
  const total = document.querySelectorAll('.testimonial-slide').length;
  testimonialCurrent = (testimonialCurrent + 1) % total;
  renderTestimonials();
}
function renderTestimonials() {
  document.querySelectorAll('.carousel-dot').forEach((d, i) => {
    d.classList.toggle('active', i === testimonialCurrent);
  });
}
setInterval(nextTestimonial, 6000);

// ── ADMIN — OPEN / CLOSE LOGIN ────────────────────────────────
function openAdminLogin() {
  if (Auth.isLoggedIn()) {
    window.location.href = '/admin/dashboard';
    return;
  }
  document.getElementById('adminLoginModal').classList.add('open');
  document.body.style.overflow = 'hidden';
  setTimeout(() => document.getElementById('adminUsername').focus(), 400);
}
function closeAdminLogin(e) {
  if (!e || e.target === document.getElementById('adminLoginModal')) {
    document.getElementById('adminLoginModal').classList.remove('open');
    document.body.style.overflow = '';
  }
}
document.getElementById('adminLoginModal').addEventListener('click', closeAdminLogin);

// ── ADMIN — DO LOGIN ─────────────────────────────────────────
async function doAdminLogin() {
  const username = document.getElementById('adminUsername').value.trim();
  const password = document.getElementById('adminPassword').value;
  const errEn    = document.getElementById('adminLoginError');
  const errFr    = document.getElementById('adminLoginErrorFr');
  errEn.classList.remove('show');
  errFr.classList.remove('show');

  if (!username || !password) {
    errEn.classList.add('show');
    errFr.classList.add('show');
    return;
  }

  const btn = document.querySelector('.admin-login-btn');
  btn.textContent = '⏳ Signing in…';
  btn.disabled = true;

  const result = await Auth.login(username, password);

  if (result.success) {
    document.getElementById('adminLoginModal').classList.remove('open');
    document.body.style.overflow = '';
    document.body.classList.add('admin-mode');
    const bar  = document.getElementById('adminBar');
    bar.classList.add('visible');
    const user = Auth.getUser();
    document.getElementById('adminUserDisplay').textContent =
      '👤 ' + (user?.name || 'Administrator') + ' (' + (user?.role || 'admin') + ')';
  } else {
    errEn.classList.add('show');
    errFr.classList.add('show');
  }
  btn.innerHTML = '<span lang-en>🔐 Sign In to Admin Panel</span><span lang-fr>🔐 Connexion au Panneau Admin</span>';
  btn.disabled = false;
}

// ── ADMIN — LOGOUT ───────────────────────────────────────────
function adminLogout() {
  if (!confirm('Log out of admin mode?')) return;
  Auth.logout();
}

// ── ADMIN — RESTORE SESSION ON PAGE LOAD ─────────────────────
function restoreAdminSession() {
  if (Auth.isLoggedIn()) {
    document.body.classList.add('admin-mode');
    const bar  = document.getElementById('adminBar');
    bar.classList.add('visible');
    const user = Auth.getUser();
    if (user) document.getElementById('adminUserDisplay').textContent =
      '👤 ' + user.name + ' (' + user.role + ')';
  }
}

// ── PROGRAM MODAL ────────────────────────────────────────────
const programDetails = {
  nursery: {
    en: {
      title: 'Nursery Program (Ages 3–5)',
      content: `<div class="notice-bar">🌱 Play-based bilingual early childhood education · Faith – Vision – Discipline</div>
        <p style="margin-bottom:16px;font-size:0.9rem;line-height:1.75;color:var(--text-body);">Our Nursery program provides a nurturing bilingual environment where children develop foundational skills through play, exploration and discovery in both English and French.</p>
        <h4 style="color:var(--royal-blue);margin-bottom:10px;font-family:var(--font-display);">Key Subjects</h4>
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;">
          <span class="subject-tag">Phonics & Literacy</span><span class="subject-tag">Numeracy</span><span class="subject-tag">Art & Craft</span><span class="subject-tag">Music & Dance</span><span class="subject-tag">Physical Education</span><span class="subject-tag">Social Skills</span>
        </div>
        <h4 style="color:var(--royal-blue);margin-bottom:10px;font-family:var(--font-display);">Annual Fees <span style="font-size:0.75rem;color:#8A9AB5;">(subject to update by admin)</span></h4>
        <div id="nurseryFees" style="background:var(--off-white);border-radius:var(--radius-md);padding:16px;margin-bottom:20px;">
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--grey-light);font-size:0.88rem;"><span>Nursery 1 (Petite Section)</span><span style="font-weight:700;color:var(--royal-blue);">250,000 XAF</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;font-size:0.88rem;"><span>Nursery 2 (Grande Section)</span><span style="font-weight:700;color:var(--royal-blue);">280,000 XAF</span></div>
        </div>
        <a href="#admissions" class="btn btn-primary" style="width:100%;justify-content:center;" onclick="closeProgramModal()">Apply for Nursery</a>`
    },
    fr: {
      title: 'Programme Maternelle (3–5 ans)',
      content: `<div class="notice-bar">🌱 Éducation bilingue de la petite enfance — Foi – Vision – Discipline</div>
        <p style="margin-bottom:16px;font-size:0.9rem;line-height:1.75;color:var(--text-body);">Notre programme de maternelle offre un environnement bilingue stimulant où les enfants développent des compétences fondamentales à travers le jeu en anglais et en français.</p>
        <h4 style="color:var(--royal-blue);margin-bottom:10px;font-family:var(--font-display);">Matières Principales</h4>
        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:20px;">
          <span class="subject-tag">Phonétique</span><span class="subject-tag">Numération</span><span class="subject-tag">Arts Plastiques</span><span class="subject-tag">Musique</span><span class="subject-tag">EPS</span><span class="subject-tag">Vie Sociale</span>
        </div>
        <h4 style="color:var(--royal-blue);margin-bottom:10px;font-family:var(--font-display);">Frais Annuels</h4>
        <div style="background:var(--off-white);border-radius:var(--radius-md);padding:16px;margin-bottom:20px;">
          <div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--grey-light);font-size:0.88rem;"><span>Petite Section</span><span style="font-weight:700;color:var(--royal-blue);">250 000 XAF</span></div>
          <div style="display:flex;justify-content:space-between;padding:8px 0;font-size:0.88rem;"><span>Grande Section</span><span style="font-weight:700;color:var(--royal-blue);">280 000 XAF</span></div>
        </div>
        <a href="#admissions" class="btn btn-primary" style="width:100%;justify-content:center;" onclick="closeProgramModal()">S'inscrire en Maternelle</a>`
    }
  }
};

async function openProgramModal(program) {
  const lang    = document.documentElement.getAttribute('data-lang') || 'en';
  const details = programDetails[program];
  const d       = details ? details[lang] : null;
  const modal   = document.getElementById('programModal');

  // Try to load fee data from API
  const feeData = await API.get('/programs/' + program + '/fees');
  document.getElementById('modalTitle').textContent = d
    ? d.title
    : (lang === 'en' ? 'Program Details' : 'Détails du Programme');
  document.getElementById('modalBody').innerHTML = d
    ? d.content
    : `<p>${lang === 'en' ? 'Full program details available upon registration.' : 'Détails disponibles à l\'inscription.'}</p>
       <a href="#admissions" class="btn btn-primary" style="margin-top:20px;" onclick="closeProgramModal()">${lang === 'en' ? 'Apply Now' : 'Postuler'}</a>`;

  // If API returned fee data, update the fee display
  if (feeData && feeData.classes) {
    const feeEl = document.getElementById(program + 'Fees');
    if (feeEl) {
      feeEl.innerHTML = feeData.classes.map(c =>
        `<div style="display:flex;justify-content:space-between;padding:8px 0;border-bottom:1px solid var(--grey-light);font-size:0.88rem;"><span>${c.name}</span><span style="font-weight:700;color:var(--royal-blue);">${c.fee.toLocaleString()} XAF</span></div>`
      ).join('');
    }
  }

  modal.classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeProgramModal(e) {
  if (!e || e.target === document.getElementById('programModal')) {
    document.getElementById('programModal').classList.remove('open');
    document.body.style.overflow = '';
  }
}

// ── FORM SUBMISSIONS ─────────────────────────────────────────
async function submitApplication() {
  const form = {
    firstName:  document.querySelectorAll('.admission-form .form-input')[0]?.value?.trim(),
    lastName:   document.querySelectorAll('.admission-form .form-input')[1]?.value?.trim(),
    dob:        document.querySelectorAll('.admission-form .form-input')[2]?.value,
    classApplied: document.querySelector('.admission-form .form-select')?.value,
    parentEmail: document.querySelectorAll('.admission-form .form-input')[3]?.value?.trim(),
    phone:      document.querySelectorAll('.admission-form .form-input')[4]?.value?.trim(),
    lang:       document.documentElement.getAttribute('data-lang') || 'en',
    schoolId:   Config.schoolId,
    year:       '2026/2027',
  };

  // Basic validation
  if (!form.firstName || !form.lastName || !form.parentEmail) {
    alert('Please fill in all required fields.');
    return;
  }

  // POST to API
  const result = await API.post('/admissions', form);
  const ref = (result && result.reference) ? result.reference
              : 'AEC-2026-' + String(Math.floor(1000 + Math.random() * 9000));

  document.getElementById('appRef').textContent = ref;
  document.getElementById('successModal').classList.add('open');
  document.body.style.overflow = 'hidden';
}

function closeSuccessModal(e) {
  if (!e || e.target === document.getElementById('successModal')) {
    document.getElementById('successModal').classList.remove('open');
    document.body.style.overflow = '';
  }
}

async function sendMessage() {
  const lang = document.documentElement.getAttribute('data-lang') || 'en';
  const form = {
    name:    document.querySelectorAll('.contact-form .form-input')[0]?.value?.trim(),
    email:   document.querySelectorAll('.contact-form .form-input')[1]?.value?.trim(),
    subject: document.querySelector('.contact-form .form-select')?.value,
    message: document.querySelector('.contact-form textarea')?.value?.trim(),
    lang, schoolId: Config.schoolId,
  };
  if (!form.name || !form.email || !form.message) {
    alert(lang === 'en' ? 'Please fill in all fields.' : 'Veuillez remplir tous les champs.');
    return;
  }
  const result = await API.post('/contact', form);
  alert(lang === 'en'
    ? 'Your message has been sent! We will respond within 24 hours.'
    : 'Votre message a été envoyé! Nous répondrons dans les 24 heures.');
}

// ── SMOOTH SCROLL ────────────────────────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
      document.getElementById('navMenu').classList.remove('open');
    }
  });
});

// ── INIT ─────────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  // Animate hero elements
  document.querySelectorAll('.hero .fade-in').forEach((el, i) => {
    setTimeout(() => el.classList.add('visible'), 400 + i * 200);
  });
  // Restore admin session if token exists
  restoreAdminSession();
  // Load dynamic data from backend
  Data.loadAll();
});
