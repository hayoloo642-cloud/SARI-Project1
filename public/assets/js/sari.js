/* =========================================
   SARI x Jejak-Bali — interaksi halaman publik
   Navbar, favorit, ulasan, lightbox galeri,
   dan pencatat statistik kunjungan.
   ========================================= */
(function () {
  'use strict';

  const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';
  const body = document.body;
  const isAuth = body?.dataset.auth === '1';
  const userId = Number(body?.dataset.userId || 0);
  const loginUrl = body?.dataset.loginUrl || '/login';

  const $ = (sel, root = document) => root.querySelector(sel);
  const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

  async function api(url, options = {}) {
    const res = await fetch(url, {
      credentials: 'same-origin',
      ...options,
      headers: {
        Accept: 'application/json',
        'X-CSRF-TOKEN': csrf,
        'X-Requested-With': 'XMLHttpRequest',
        ...(options.body ? { 'Content-Type': 'application/json' } : {}),
        ...(options.headers || {}),
      },
    });

    let payload = null;
    try {
      payload = await res.json();
    } catch (e) {
      payload = null;
    }

    return { ok: res.ok, status: res.status, data: payload };
  }

  /* ---------- Navbar ---------- */
  function initNav() {
    const nav = $('.nav');
    const btn = $('#btn-menu');
    const menu = $('#nav-menu');

    if (nav) {
      const onScroll = () => nav.classList.toggle('tergulir', window.scrollY > 40);
      onScroll();
      window.addEventListener('scroll', onScroll, { passive: true });
    }

    if (!btn || !menu) return;

    const iconMenu = btn.innerHTML;
    const iconClose = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>';

    const setOpen = (open) => {
      menu.classList.toggle('aktif', open);
      btn.innerHTML = open ? iconClose : iconMenu;
      btn.setAttribute('aria-expanded', String(open));
      btn.setAttribute('aria-label', open ? 'Tutup menu' : 'Buka menu');
    };

    btn.addEventListener('click', () => setOpen(!menu.classList.contains('aktif')));
    $$('a', menu).forEach((a) => a.addEventListener('click', () => setOpen(false)));
    window.addEventListener('resize', () => {
      if (window.innerWidth > 960) setOpen(false);
    });
  }

  /* ---------- Favorit / bookmark ---------- */
  async function syncBookmarks() {
    const buttons = $$('[data-destinasi-id].btn-bookmark');
    if (!buttons.length || !isAuth) return;

    const res = await api('/api/bookmark');
    if (!res.ok || !res.data?.data) return;

    const byDestinasi = new Map();
    res.data.data
      .filter((b) => Number(b.user_id) === userId)
      .forEach((b) => byDestinasi.set(String(b.destinasi_id), b.id));

    buttons.forEach((btn) => {
      const id = byDestinasi.get(String(btn.dataset.destinasiId));
      if (id) {
        btn.dataset.saved = 'true';
        btn.dataset.bookmarkId = String(id);
        const label = $('span', btn);
        if (label) label.textContent = 'Tersimpan di Favorit';
        btn.setAttribute('aria-pressed', 'true');
      } else {
        btn.dataset.saved = 'false';
        btn.setAttribute('aria-pressed', 'false');
      }
    });
  }

  function initBookmarks() {
    $$('[data-destinasi-id].btn-bookmark').forEach((btn) => {
      btn.addEventListener('click', async (event) => {
        event.preventDefault();
        event.stopPropagation();

        if (!isAuth) {
          window.location.href = loginUrl;
          return;
        }

        const destinasiId = Number(btn.dataset.destinasiId);
        const saved = btn.dataset.saved === 'true';
        const bookmarkId = btn.dataset.bookmarkId;

        btn.disabled = true;

        try {
          let res;
          if (saved) {
            res = await api(`/api/bookmark/${bookmarkId}`, { method: 'DELETE' });
          } else {
            res = await api('/api/bookmark', {
              method: 'POST',
              body: JSON.stringify({ destinasi_id: destinasiId }),
            });
          }

          if (res.status === 401 || res.status === 419) {
            window.location.href = loginUrl;
            return;
          }

          if (!res.ok) {
            throw new Error(res.data?.message || 'Gagal mengubah favorit.');
          }

          if (saved) {
            btn.dataset.saved = 'false';
            delete btn.dataset.bookmarkId;
          } else {
            btn.dataset.saved = 'true';
            btn.dataset.bookmarkId = String(res.data?.data?.id || '');
          }

          btn.setAttribute('aria-pressed', btn.dataset.saved);
          const label = $('span', btn);
          if (label) label.textContent = saved ? 'Simpan Favorit' : 'Tersimpan di Favorit';
        } catch (err) {
          alert(err.message);
        } finally {
          btn.disabled = false;
        }
      });
    });

    syncBookmarks();
  }

  /* ---------- Ulasan ---------- */
  function initReviewForm() {
    const form = $('#form-ulasan');
    if (!form) return;

    const pesan = $('#ulasan-pesan');
    const btn = $('#btn-submit-ulasan');
    const nama = $('#ulasan-nama');
    const rating = $('#ulasan-rating');
    const komentar = $('#ulasan-komentar');

    form.addEventListener('submit', async (event) => {
      event.preventDefault();

      const isiNama = nama?.value.trim() || '';
      const isiKomentar = komentar?.value.trim() || '';
      if (!isiNama || !isiKomentar) return;

      btn && (btn.disabled = true);
      if (pesan) {
        pesan.style.display = 'block';
        pesan.style.color = 'var(--muted)';
        pesan.textContent = 'Mengirim ulasan...';
      }

      try {
        const res = await api('/api/ulasan', {
          method: 'POST',
          body: JSON.stringify({
            destinasi_id: Number(form.dataset.destinasiId),
            nama_pengunjung: isiNama,
            rating: Number(rating?.value || 5),
            komentar: isiKomentar,
          }),
        });

        if (!res.ok) {
          const errors = res.data?.errors;
          const first = errors ? Object.values(errors)[0]?.[0] : null;
          throw new Error(first || res.data?.message || 'Gagal mengirim ulasan.');
        }

        if (pesan) {
          pesan.style.color = '#0b7a4b';
          pesan.textContent = res.data?.message
            ? 'Terima kasih! Ulasan Anda tersimpan dan akan tampil setelah disetujui pengelola.'
            : 'Terima kasih! Ulasan Anda menunggu persetujuan.';
        }
        if (komentar) komentar.value = '';
      } catch (err) {
        if (pesan) {
          pesan.style.color = '#b3261e';
          pesan.textContent = err.message;
        }
      } finally {
        btn && (btn.disabled = false);
      }
    });
  }

  /* ---------- Lightbox galeri ---------- */
  function initLightbox() {
    const slides = $$('.detail-galeri-slide[data-lightbox-src]');
    if (!slides.length) return;

    const wrap = document.createElement('div');
    wrap.className = 'lightbox-wrap';
    wrap.id = 'lightbox-modal';
    wrap.setAttribute('role', 'dialog');
    wrap.setAttribute('aria-modal', 'true');
    wrap.innerHTML = `
      <div class="lightbox-content">
        <button class="lightbox-close" type="button" aria-label="Tutup foto">&times;</button>
        <button class="lightbox-nav lightbox-prev" type="button" aria-label="Foto sebelumnya">&#10094;</button>
        <img id="lightbox-main-img" class="lightbox-img" src="" alt="">
        <button class="lightbox-nav lightbox-next" type="button" aria-label="Foto berikutnya">&#10095;</button>
        <div id="lightbox-caption" class="lightbox-cap"></div>
        <div id="lightbox-counter" class="lightbox-counter"></div>
      </div>`;
    document.body.appendChild(wrap);

    const img = $('#lightbox-main-img', wrap);
    const cap = $('#lightbox-caption', wrap);
    const counter = $('#lightbox-counter', wrap);
    let index = 0;

    const render = () => {
      const slide = slides[index];
      img.src = slide.dataset.lightboxSrc;
      img.alt = slide.dataset.lightboxAlt || '';
      cap.textContent = slide.dataset.lightboxAlt || '';
      counter.textContent = `Foto ${index + 1} / ${slides.length}`;
    };

    const open = (i) => {
      index = i;
      render();
      wrap.classList.add('aktif');
      document.body.style.overflow = 'hidden';
    };

    const close = () => {
      wrap.classList.remove('aktif');
      document.body.style.overflow = '';
    };

    const move = (step) => {
      index = (index + step + slides.length) % slides.length;
      render();
    };

    slides.forEach((slide, i) => {
      slide.addEventListener('click', () => open(i));
      slide.setAttribute('tabindex', '0');
      slide.setAttribute('role', 'button');
      slide.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          open(i);
        }
      });
    });

    $('.lightbox-close', wrap).addEventListener('click', close);
    $('.lightbox-prev', wrap).addEventListener('click', () => move(-1));
    $('.lightbox-next', wrap).addEventListener('click', () => move(1));
    wrap.addEventListener('click', (e) => {
      if (e.target === wrap) close();
    });

    document.addEventListener('keydown', (e) => {
      if (!wrap.classList.contains('aktif')) return;
      if (e.key === 'Escape') close();
      if (e.key === 'ArrowLeft') move(-1);
      if (e.key === 'ArrowRight') move(1);
    });
  }

  /* ---------- Statistik kunjungan ---------- */
  function initVisitStats() {
    const hero = $('.detail-hero');
    if (!hero) return;

    const form = $('#form-ulasan');
    const destinasiId = form?.dataset.destinasiId;
    if (!destinasiId) return;

    const key = `sari_visit_${destinasiId}`;
    try {
      if (sessionStorage.getItem(key)) return;
      sessionStorage.setItem(key, '1');
    } catch (e) {
      /* storage diblokir — tetap kirim sekali per muat halaman */
    }

    const now = new Date();
    const tanggal = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}-${String(now.getDate()).padStart(2, '0')}`;

    api('/api/statistik-kunjungan', {
      method: 'POST',
      body: JSON.stringify({ destinasi_id: Number(destinasiId), tanggal, jumlah: 1 }),
    }).catch(() => {});
  }

  /* ---------- Peta destinasi (Leaflet) ---------- */
  function initDestinationMap() {
    const el = document.getElementById('map-destinasi');
    const dataEl = document.getElementById('peta-destinasi-data');
    if (!el || !dataEl || typeof L === 'undefined') return;

    let items = [];
    try {
      items = JSON.parse(dataEl.textContent || '[]');
    } catch (e) {
      return;
    }

    const map = L.map(el, { scrollWheelZoom: false }).setView([-8.4, 115.15], 9);
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 18,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright" target="_blank" rel="noopener">OpenStreetMap</a>',
    }).addTo(map);

    const bounds = [];
    items.forEach((d) => {
      if (!d.lat || !d.lng) return;
      const marker = L.marker([d.lat, d.lng]).addTo(map);
      marker.bindPopup(
        `<h4>${d.nama}</h4><p style="margin:0 0 0.4rem;font-size:0.82rem;color:#5d6a63;">${d.kategori || 'Destinasi'}</p>` +
        `<a href="/destinasi/${d.slug}">Lihat detail &rarr;</a>`
      );
      bounds.push([d.lat, d.lng]);
    });

    if (bounds.length === 1) {
      map.setView(bounds[0], 12);
    } else if (bounds.length > 1) {
      map.fitBounds(bounds, { padding: [40, 40], maxZoom: 11 });
    }
  }

  document.addEventListener('DOMContentLoaded', () => {
    initNav();
    initBookmarks();
    initReviewForm();
    initLightbox();
    initVisitStats();
    initDestinationMap();
  });
})();
