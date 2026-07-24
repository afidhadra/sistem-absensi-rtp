---
version: alpha
name: Sistem Absensi RTP
description: |
  Absensi kampus dengan OTP 5 menit. UI compact, anti-AI-generic, 
  dengan karakter Gen-Z Indonesia. Tiga role (admin/dosen/mahasiswa) 
  dalam satu panel daisyUI light theme.
colors:
  # daisyUI light theme — semantic tokens, tidak override
  # reference hex adalah approximate dari Oklch source
  primary: "#6C1EEB"
  primary-content: "#EEEBFF"
  secondary: "#F87272"
  accent: "#37CDBE"
  neutral: "#1D2323"
  neutral-content: "#E7E7E7"
  base-100: "#FFFFFF"
  base-200: "#FAFAFA"
  base-300: "#F2F2F2"
  base-content: "#333333"
  info: "#3ABFF8"
  success: "#36D399"
  warning: "#FBBD23"
  error: "#F87272"
typography:
  h1:
    fontFamily: Poppins
    fontSize: 1.25rem
    fontWeight: 700
    lineHeight: 1.3
  h2:
    fontFamily: Poppins
    fontSize: 0.875rem
    fontWeight: 600
    lineHeight: 1.4
  body-md:
    fontFamily: Poppins
    fontSize: 0.875rem
    lineHeight: 1.5
  body-sm:
    fontFamily: Poppins
    fontSize: 0.75rem
    lineHeight: 1.5
  label-caps:
    fontFamily: Poppins
    fontSize: 0.75rem
    fontWeight: 600
    letterSpacing: "0.02em"
  display-large:
    fontFamily: Poppins
    fontSize: 1.875rem
    fontWeight: 800
    lineHeight: 1.1
    letterSpacing: "-0.02em"
rounded:
  none: 0px
  sm: 6px
  md: 10px
  lg: 16px
  xl: 20px
  full: 9999px
spacing:
  xs: 2px
  sm: 4px
  md: 8px
  lg: 12px
  xl: 16px
  section: 24px
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.primary-content}"
    rounded: "{rounded.md}"
    padding: 6px 12px
    typography: "{typography.body-sm}"
  button-ghost:
    backgroundColor: transparent
    textColor: "{colors.base-content}"
    rounded: "{rounded.md}"
    padding: 6px 12px
  button-outline:
    backgroundColor: transparent
    textColor: "{colors.primary}"
    rounded: "{rounded.md}"
    border: 1px solid currentColor
    padding: 6px 12px
  card-surface:
    backgroundColor: "{colors.base-100}"
    rounded: "{rounded.lg}"
    shadow: sm
    padding: 16px
  card-outline:
    backgroundColor: transparent
    border: 1px solid "{colors.base-300}"
    rounded: "{rounded.lg}"
    padding: 16px
  card-accent-primary:
    backgroundColor: "{colors.base-100}"
    borderLeft: "4px solid {colors.primary}"
    rounded: "{rounded.lg}"
    shadow: sm
    padding: 16px
  stat-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.primary-content}"
    rounded: "{rounded.lg}"
    padding: 12px
  stat-outline:
    backgroundColor: transparent
    border: 1px solid "{colors.base-300}"
    textColor: "{colors.base-content}"
    rounded: "{rounded.lg}"
    padding: 12px
  input-field:
    backgroundColor: "{colors.base-100}"
    border: 1px solid "{colors.base-300}"
    rounded: "{rounded.sm}"
    padding: 8px 12px
    typography: "{typography.body-md}"
  page-header:
    borderLeft: "4px solid {colors.primary}"
    paddingLeft: 10px
    typography: "{typography.h1}"
  table:
    rounded: "{rounded.lg}"
    backgroundColor: "{colors.base-100}"
  table-header:
    typography: "{typography.label-caps}"
    textColor: "{colors.base-content} 50%"
  progress-bar:
    backgroundColor: "{colors.base-200}"
    rounded: "{rounded.full}"
  badge:
    rounded: "{rounded.full}"
    padding: 2px 6px
    typography: "{typography.body-sm}"
  toast:
    rounded: "{rounded.md}"
    shadow: lg
    padding: 12px 16px
  sidebar-panel:
    backgroundColor: "{colors.neutral}"
    textColor: "{colors.neutral-content}"
    width: 256px
  avatar-initial:
    rounded: "{rounded.full}"
    backgroundColor: "{colors.primary}"
    textColor: "{colors.primary-content}"
    size: 32px
    typography: "{typography.body-sm}"
    fontWeight: 700
  divider:
    width: 1px
    backgroundColor: "{colors.base-300}"
    height: 12px
---

## Overview

Sistem Absensi RTP adalah aplikasi absensi kampus real-time. Tiga role dengan
panel masing-masing. Desain mengutamakan **compact density, anti-AI-generic,
dan karakter non-formal Indonesia**.

Tidak seperti panel admin biasa yang menggunakan card seragam dengan shadow
dan spacing longgar, RTP menggunakan:
- Variasi card (filled, outline, accent-border, border-only)
- Warna sebagai alat hierarki visual (bukan dekorasi)
- Tipografi kompak (Poppins, font-size kecil, line-height rapat)
- Micro-interactions murah (hover:shadow-md, transition-colors)
- Empty states dengan ikon SVG (bukan "Belum ada data" polos)

Target: mahasiswa Gen-Z dan dosen yang bosan dengan template AI.

## Colors

Palet berasal dari **daisyUI light theme** tanpa override. Semua warna
diakses via semantic class (`bg-primary`, `text-base-content/50`, dll).

- **Primary (#6C1EEB):** Aksen utama — tombol Generate OTP, sidebar highlight,
  accent bar pada page-header dan form card.
- **Base-200 (#FAFAFA):** Background halaman. Satu-satunya surface halus
  yang membedakan card (base-100) dari page.
- **Base-300 (#F2F2F2):** Border default untuk outline card, divider,
  dan input border.
- **Warning (#FBBD23):** OTP aktif, flash alert.
- **Success (#36D399):** Status Hadir, badge sukses.
- **Error (#F87272):** Tombol hapus, alert error, status ditolak.
- **Neutral (#1D2323) + neutral-content (#E7E7E7):** Sidebar panel.

Card accent colors (cycling 4):
- Primary → Secondary → Accent → Info
- Digunakan di dashboard cards untuk visual variasi ($loop->index % 4)

### Status → Color Mapping

| Komponen | Warna | CSS |
|----------|-------|-----|
| Hadir / success | Hijau | `badge-success`, `border-l-success` |
| Tunggu OTP | Abu | `badge-ghost`, `border-l-base-300` |
| OTP aktif | Kuning | `badge-warning`, `bg-warning/10` |
| OTP expired | Abu | `badge-ghost` |
| OTP used | Hijau | `badge-success` |
| Error / ditolak | Merah | `alert-error`, `text-error` |

## Typography

**Poppins** — satu font untuk semua. Hierarki melalui weight & size, bukan
font family. Karakter Poppins yang geometris cocok dengan compact UI.

| Level | Size | Weight | Penggunaan |
|-------|------|--------|------------|
| display-large | 30px | 800 | Login page brand tagline |
| h1 | 20px | 700 | Dashboard title (layout inline) |
| h2 | 14px | 600 | Section header (Absensi Hari Ini) |
| body-md | 14px | 400 | Input text, card body |
| body-sm | 12px | 400 | Label, subtitle, metadata |
| label-caps | 12px | 600 + 0.02em | Table header (uppercase) |

## Layout & Spacing

Baseline 4px. Compact — lebih rapat dari default daisyUI.

```
space-y-6  → space-y-4   (antara sections)
gap-4      → gap-3       (grid gap)
p-5        → p-4 / p-3   (card padding)
py-8       → py-6 / py-8 (empty state)
mb-6       → mb-4        (page-header margin)
```

Breakpoints: default Tailwind (sm:640, md:768, lg:1024). Sidebar collapse
di lg (daisyUI `lg:drawer-open`).

## Elevation & Depth

Minimal. Tidak ada shadow besar atau blur.

- `shadow-sm` — default card (hover jadi `shadow-md`)
- `shadow-lg` — toast (paling tinggi)
- Tanpa shadow: table, outline card, stat outline
- Elevation dari border (`border border-base-300`) bukan shadow

## Shapes

| Bentuk | Value | Penggunaan |
|--------|-------|------------|
| `rounded-sm` | 6px | Input, button, label |
| `rounded-md` | 10px | Button, alert, badge panel |
| `rounded-lg` | 16px | Card, table wrapper |
| `rounded-xl` | 20px | Stat card (jika terpisah) |
| `rounded-full` | 50% | Avatar, badge pill |

## Components

### Page Header
`<div class="border-l-4 border-primary pl-2.5"><h1 class="text-sm font-bold">`

Accent bar kiri — pengganti judul besar. Menghemat ruang vertikal dan
memberi identitas visual. Tombol aksi (Tambah) di kanan dengan `btn-xs`.

### Card
Tiga varian dengan fungsi berbeda:
- **card-surface** (`bg-base-100 shadow-sm`) — dashboard cards
- **card-outline** (`border border-base-300`) — stat sekunder, form
- **card-accent-primary** (`border-l-4 border-l-primary`) — form, attendance bar

Hover: `hover:shadow-md transition-shadow` pada semua card.

### Stat Card
- **Stat primary** (`bg-primary text-primary-content`) — 1 kartu paling penting.
  Menjadi focal point visual, bukan rata semua.
- **Stat outline** (`border border-base-300`) — 3 kartu pendukung.

Prinsip: mata mendarat di satu angka (stat primary), lalu scan sisanya.
4 kartu identik = AI-generic.

### Table
`table table-zebra table-sm` + header `text-xs uppercase text-base-content/50`.

Wrapper: `overflow-x-auto rounded-xl bg-base-100 shadow`.

Empty state: [SVG icon] + "Belum ada data." (center kolom).

Pagination: Laravel default, 20 per halaman.

### Button
Semua `btn-xs` — mahasiswa Gen-Z ga butuh tombol besar.

- `btn-primary` — aksi utama (Generate OTP, Simpan, Kirim)
- `btn-ghost` — aksi sekunder (Absensi, Batal, filter)
- `btn-outline` — aksi create (Tambah Dosen, + Mahasiswa)
- `btn-error` — aksi destruktif (Hapus, di confirm modal)

### Form
Card wrapper: `card border border-base-300 border-l-4 border-l-primary`.
Label: `label-text text-xs`.
Input: `input input-bordered w-full`.
Spacing: `space-y-3` dalam card-body.
Action: `<x-form-actions />` (Simpan + Batal).

### Badge
`badge badge-sm` — varian sesuai status:
- `badge-success` — Hadir, Digunakan, Aktif
- `badge-warning` — OTP Aktif (di card dosen)
- `badge-ghost` — Belum, Kedaluwarsa, Tunggu OTP

### Empty State
[SVG icon 32px opacity-20] + text "Belum ada {context}."
Digunakan di semua tabel dan dashboard list.

### Sidebar
Panel lebar 256px, `bg-neutral text-neutral-content`.
- Icon shield-check + "RTP." — brand
- Menu items: label "Nama Menu" (text saja, tanpa ikon)
- Grouped dengan divider label uppercase
- Avatar initial bulat + nama user + logout

### Toast
daisyUI `toast toast-end toast-top`.
Alpine store, auto-hide 3 detik. Flash session bridge.

### Confirm Modal
daisyUI `modal` + Alpine `$store.confirm`.
Label dinamis: "Hapus" (delete), "Keluar" (logout).

## Do's and Don'ts

- **Do** preserve daisyUI semantic tokens — jangan hardcode hex di Blade.
- **Do** compact spacing — text-xs, py-3, gap-3. Roomi = AI-generic.
- **Do** vary card styles — tidak semua card harus shadow.
- **Do** use color for meaning, not decoration (success=green, error=red).
- **Don't** make all stat cards identical — standout satu, outline sisanya.
- **Don't** use shadow-lg atau blur — terlalu berat untuk absensi kampus.
- **Don't** introduce new font families — Poppins untuk semuanya.
- **Don't** use JS chart libraries — data <1000 record, progress bar cukup.
- **Don't** nest component variants — `card-accent-primary`, bukan `card.accent`.
