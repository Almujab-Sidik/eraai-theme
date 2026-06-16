# PRD — Halaman AUTOMATION

| Item | Keterangan |
|---|---|
| Nama Halaman | Automation |
| Slug / URL | `/automation` |
| Stack | WordPress, SCF (Secure Custom Fields), PHP, CSS |
| Tipe | Halaman statis berbasis custom fields |
| Status Dokumen | Draft v1 |
| Tanggal | 4 Juni 2026 |

---

## 1. Ringkasan

Halaman Automation adalah halaman konten standar yang dirender oleh template PHP khusus dan mengambil seluruh isinya dari field SCF. Tujuannya agar konten halaman (judul, deskripsi, daftar item, gambar, CTA) dapat diubah lewat admin WordPress tanpa menyentuh kode. Styling, markup, dan logika render sudah tersedia; dokumen ini berfungsi sebagai spesifikasi acuan untuk struktur halaman, field, dan kriteria penerimaan.

## 2. Tujuan

- Menyediakan halaman Automation yang konsisten dan dapat dikelola sepenuhnya melalui SCF.
- Memisahkan konten dari kode sehingga update konten tidak butuh deploy.
- Memastikan halaman tampil benar dan responsif di desktop, tablet, dan mobile.

## 3. Non-Goals (Di Luar Lingkup)

- **Bukan halaman fungsional/tool** — tidak ada logika otomasi yang berjalan, hanya konten informatif.
- **Tidak ada integrasi data dinamis** (API eksternal, query custom post type kompleks) di versi ini.
- **Tidak membahas pembuatan ulang styling/CSS** — aset visual dianggap sudah final.
- **Tidak ada A/B testing atau personalisasi** konten per user.

## 4. Struktur Halaman & Section

Halaman disusun dari beberapa section berurutan. Setiap section dipetakan ke satu grup field SCF.

| # | Section | Tujuan | Konten Utama |
|---|---|---|---|
| 1 | Hero | Pesan pembuka | Heading, subheading, gambar/ilustrasi, tombol CTA |
| 2 | Intro / Deskripsi | Penjelasan singkat | Teks paragraf, opsional gambar pendamping |
| 3 | Daftar Fitur/Item | Poin-poin utama | Repeater berisi ikon, judul, deskripsi |
| 4 | Konten Tambahan | Blok fleksibel | Heading + WYSIWYG |
| 5 | CTA Penutup | Ajakan akhir | Heading, teks, tombol |

> Catatan: section dapat dikosongkan dari admin; section kosong tidak dirender (lihat kriteria penerimaan).

## 5. Struktur Field SCF

Field Group: **`Automation Page Fields`**, dipasang pada Page dengan template `Automation` (atau slug `automation`).

### 5.1 Hero
| Field Label | Field Name | Tipe | Wajib |
|---|---|---|---|
| Hero Heading | `hero_heading` | Text | Ya |
| Hero Subheading | `hero_subheading` | Textarea | Tidak |
| Hero Image | `hero_image` | Image (return: array/URL) | Tidak |
| Hero Button Label | `hero_btn_label` | Text | Tidak |
| Hero Button URL | `hero_btn_url` | URL | Tidak |

### 5.2 Intro
| Field Label | Field Name | Tipe | Wajib |
|---|---|---|---|
| Intro Heading | `intro_heading` | Text | Tidak |
| Intro Text | `intro_text` | WYSIWYG/Textarea | Tidak |

### 5.3 Daftar Fitur (Repeater: `feature_items`)
| Sub-Field | Field Name | Tipe |
|---|---|---|
| Ikon | `item_icon` | Image / Text (class ikon) |
| Judul | `item_title` | Text |
| Deskripsi | `item_desc` | Textarea |

### 5.4 Konten Tambahan
| Field Label | Field Name | Tipe |
|---|---|---|
| Section Heading | `extra_heading` | Text |
| Section Content | `extra_content` | WYSIWYG |

### 5.5 CTA Penutup
| Field Label | Field Name | Tipe |
|---|---|---|
| CTA Heading | `cta_heading` | Text |
| CTA Text | `cta_text` | Textarea |
| CTA Button Label | `cta_btn_label` | Text |
| CTA Button URL | `cta_btn_url` | URL |

> Nama field di atas adalah usulan; sesuaikan dengan konvensi penamaan yang sudah dipakai di proyek.

## 6. Alur Render (PHP)

1. WordPress memuat template halaman Automation (`page-automation.php` atau template berdasarkan slug).
2. Template memanggil `get_field()` untuk tiap field/grup SCF.
3. Tiap section dibungkus pengecekan: render hanya jika field intinya terisi.
4. Repeater `feature_items` di-loop dengan `have_rows()` / `the_row()`.
5. Output di-escape dengan benar (`esc_html`, `esc_url`, `esc_attr`, `wp_kses_post` untuk WYSIWYG).
6. Class CSS yang sudah ada diterapkan pada markup sesuai desain final.

## 7. Styling & Responsiveness

- Menggunakan CSS yang sudah tersedia (tidak ada perubahan visual baru).
- Layout responsif minimal di 3 breakpoint: mobile (≤ 768px), tablet (769–1024px), desktop (> 1024px).
- Gambar mendukung atribut `alt` dan tidak melebihi container.

## 8. Kriteria Penerimaan

- [ ] Halaman tampil di `/automation` memakai template yang benar.
- [ ] Semua field SCF terhubung dan nilainya tampil di front-end.
- [ ] Section yang field intinya kosong **tidak dirender** (tidak ada blok kosong/markup yatim).
- [ ] Repeater `feature_items` menampilkan jumlah item sesuai input admin.
- [ ] Tombol CTA hanya muncul jika label **dan** URL terisi, dan tautannya berfungsi.
- [ ] Seluruh output di-escape; tidak ada raw output yang berisiko XSS.
- [ ] Tampilan benar di mobile, tablet, dan desktop tanpa overflow horizontal.
- [ ] Gambar punya atribut `alt`.

## 9. Catatan Teknis

- Pastikan field group SCF di-export ke `acf-json` / PHP register agar versioned di repo (bukan hanya di DB).
- Sediakan fallback teks untuk field opsional yang kosong jika diperlukan desain.
- Jika halaman dibuat per-instance via admin, kunci penempatan field group ke template, bukan ke page ID tertentu.

## 10. Open Questions

- Apakah field group dikunci ke **page template** atau **slug halaman**? (perlu konfirmasi tim dev)
- Apakah daftar fitur perlu batas maksimal jumlah item?
- Apakah perlu dukungan multibahasa (WPML/Polylang) untuk halaman ini?
