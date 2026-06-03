# 🗂️ TODO — Dealers UI Redesign Plan

> **Status:** ✅ All changes implemented!

---

## 🎯 Goal

Improve the visual presentation of the four Dealers CRUD templates so they look polished and professional enough to present to a senior developer. The changes are **purely cosmetic/HTML-structure changes** — no controller, model, or route code will be touched.

---

## 📁 Files to Modify

| File | Current State | What Will Change |
|---|---|---|
| `templates/Dealers/index.php` | Plain HTML table, no styling beyond CakePHP's milligram defaults | Stats card + styled table + action badges |
| `templates/Dealers/add.php` | Raw fieldset form, sidebar nav | Modern card-style form layout |
| `templates/Dealers/edit.php` | Same as add, with a sidebar delete link | Same card-style form + danger-delete area |
| `templates/Dealers/view.php` | Unstyled detail table, sidebar nav | Profile-card-style detail view |

---

## 📋 Detailed Changes Per File

---

### 1. `templates/Dealers/index.php`

**What will be added / changed:**

- **Stats Bar** — A row of summary cards at the top using inline styles (no extra CSS file needed). Cards will show:
  - 📦 **Total Dealers** — using `$this->Paginator->counter('{{count}}')` to display the total record count from the paginator.
  - 📄 **Current Page** — using `$this->Paginator->counter('{{page}} / {{pages}}')`.
  - 📋 **Records on this Page** — using `$this->Paginator->counter('{{current}}')`.
- **Page Header** — Replace plain `<h3>` with a styled header row containing the title on the left and the "New Dealer" button on the right, styled as a modern primary button.
- **Styled Table** — Add `style` attributes to `<table>`, `<thead>`, and rows for:
  - Alternating row colors (zebra striping via `:nth-child` or inline class tricks).
  - Rounded header with a dark background color.
  - Compact, readable font sizing.
- **Action Buttons** — Replace plain text links (View / Edit / Delete) with badge-style inline buttons:
  - View → blue badge
  - Edit → yellow/orange badge
  - Delete → red badge (postLink form button)
- **Paginator** — Keep existing CakePHP paginator, just wrap it more cleanly with a centered style.

> **No new PHP variables are introduced.** All count/page data comes from the already-available `$this->Paginator` helper that CakePHP provides out of the box.

---

### 2. `templates/Dealers/add.php`

**What will be added / changed:**

- **Remove sidebar layout** — The `<aside>` + two-column `<div class="row">` structure will be replaced with a single centered card layout. The "List Dealers" back link will be moved to the top of the card as a plain `← Back` link.
- **Card Container** — Wrap the form inside a styled card: white background, rounded corners, subtle box shadow, and padding.
- **Page Header inside card** — A colored header strip at the top of the card with the title "➕ Add New Dealer" and an icon.
- **Form Field Styling** — Each `$this->Form->control()` call will have `'class'` and `'label'` options added:
  - Labels in bold, field names translated to readable Indonesian (e.g., `Nama Dealer`, `Alamat`, `No. Telepon`, `No. HP`).
  - Inputs styled with padding and a border.
- **Submit Button** — Styled as a full-width primary button with a green color and hover effect (inline style).

---

### 3. `templates/Dealers/edit.php`

**What will be added / changed:**

- Same card layout as `add.php`.
- **Page Header** — "✏️ Edit Dealer" with the dealer name shown in the subtitle (using `$dealer->nama`).
- **Back link** — Moved to top of card.
- **Danger Zone Section** — A clearly separated section at the bottom of the card with a red border and a "🗑️ Delete this Dealer" `postLink` button. This replaces the awkward sidebar delete link with something more intentional and visible — styled to look like a "Danger Zone" area.
- **Same field improvements** as `add.php`.

---

### 4. `templates/Dealers/view.php`

**What will be added / changed:**

- **Remove sidebar layout** — Same approach as add/edit: ditch the `<aside>` columns and go with a centered card.
- **Profile Card Header** — A colored header band at the top of the card showing:
  - A large avatar-style circle with the dealer's initials (e.g., first letter of `$dealer->nama`), extracted with a simple `strtoupper(substr($dealer->nama, 0, 1))`.
  - The dealer name as a large `<h2>`.
  - Dealer ID as a subtle subtext badge (e.g., `#001`).
- **Detail Grid** — Replace the plain `<table>` with a 2-column CSS grid of label+value rows:
  - 🏠 Alamat
  - 📞 No. Telepon
  - 📱 No. HP
- **Action Buttons Row** — Replace sidebar nav with a row of action buttons at the bottom of the card:
  - "✏️ Edit" → blue button
  - "🗑️ Delete" → red postLink button (with confirm dialog)
  - "← Back to List" → ghost/outline button

---

## 🖌️ Styling Approach

All styling will use **inline `style` attributes** only, to stay compatible with CakePHP's existing Milligram CSS setup and avoid introducing new `.css` files. No TailwindCSS. No external UI libraries.

Color palette being used:

| Role | Color |
|---|---|
| Primary (buttons, header) | `#4f46e5` (indigo) |
| Danger (delete) | `#dc2626` (red) |
| Warning (edit) | `#d97706` (amber) |
| Success (add/submit) | `#16a34a` (green) |
| Background card | `#ffffff` |
| Border | `#e5e7eb` |
| Text muted | `#6b7280` |

---

## ✅ Checklist

- [x] `index.php` — Stats cards added, table styled, action badges
- [x] `add.php` — Card layout, improved form fields, styled submit
- [x] `edit.php` — Card layout, Danger Zone section, improved fields
- [x] `view.php` — Profile card, initials avatar, detail grid, action row

---

> **Done!** All four templates have been redesigned. Run the dev server and navigate to `/dealers` to see the result.
