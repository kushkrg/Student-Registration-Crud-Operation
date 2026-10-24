# Student Registration CRUD Operation in PHP & MySQL

A secure, beautiful **student registration system with full CRUD operations** — Create, Read, Update, Delete — built with **Core PHP + MySQL** (no framework). Register students with their photo and complete details, search them, view a rich profile page, edit, delete, and export everything to CSV.

## Features

- **Complete CRUD** — Add / View / Edit / Delete students with a full registration form (personal, family, contact & address details + photo)
- **Beautiful Student Profile Page** — gradient profile header with photo, age badge, grouped information cards, and a Print button (print-friendly)
- **Search & Pagination** — search by name, student ID, phone or email
- **CSV Export** — one click, exports exactly what your search shows, as a real `.csv` file
- **Safe Photo Upload** — JPG/PNG/WEBP only, 2 MB limit, random file names, and the upload folder blocks PHP execution
- **Modern Responsive UI** — Warm Paper & Deep Teal design, sidebar dashboard, stat cards, works on mobile
- **Dashboard Stats** — total students, male/female counts

## Setup (2 minutes)

1. Copy this project into `htdocs` (XAMPP) / `www` (WAMP) / `public_html` (hosting).
2. Open **phpMyAdmin → Import** and import `card_activation .sql` (creates the `user` database and the `card_activation` table — no personal data included).
   *(Yes, the SQL file name has a space — that's how the original project shipped it. It imports fine.)*
3. If your MySQL setup is not `root` with an empty password, update `db.php`.
4. Open the project folder in your browser — `index.php` is the students list.

> **Upgrading from the old version?** Your existing database keeps working — database (`user`), table (`card_activation`) and all column names are unchanged. The new SQL file is only needed for fresh installs.
>
> **Note:** this demo CRUD app has no login system by design. It stores personal data (including Aadhar numbers), so if you put it on a public server, protect the folder with your hosting's password-protection / `.htaccess` authentication — or use the login version of this project: [Student Registration System with Login System](https://github.com/kushkrg/student-registration-system-with-login-system).

## Project Structure

```
db.php                      Database connection (mysqli, utf8mb4)
includes/functions.php      Session, CSRF, flash messages, secure upload, validation
includes/student-form.php   Shared Add / Edit student form
header.php / footer.php     App layout (sidebar, topbar)
index.php                   Students list + search + pagination + stats
add.php                     Add student (full page form)
edit.php                    Edit student (photo preserved)
view.php                    Beautiful student profile page (+ print)
delete.php                  Delete student (POST + CSRF only)
export.php                  CSV export (follows the current search)
assets/css/style.css        Complete modern stylesheet (no Bootstrap/jQuery needed)
assets/js/app.js            Confirm dialogs + alerts
upload_images/              Student photos (PHP execution blocked by .htaccess)
card_activation .sql        Clean database schema
```

## Bugs & security fixes in this update (2026)

This project was originally written in 2021 as a learning project. This update fixes the serious issues found in the old code — **please upgrade**:

| # | Issue in old code | Fix |
|---|---|---|
| 1 | **SQL injection everywhere** — insert, update, list and `DELETE FROM card_activation WHERE id = $id` with the raw `$_GET` id | Every query is a prepared statement |
| 2 | **Delete worked via a GET link** (`delete.php?id=...`) with no CSRF protection | Delete is POST-only with a CSRF token + confirmation, and removes the photo file |
| 3 | **Stored XSS** — student data (names, emails, Aadhar) printed raw into the list, view and edit modals | All output escaped with `htmlspecialchars` (`e()` helper) |
| 4 | **Unrestricted file upload** — any file type with its original name in a public folder (PHP shell = server takeover) | Images only, 2 MB, random names, `upload_images/.htaccess` blocks PHP |
| 5 | **Edit page chaos** — `move_uploaded_file()` ran *after* the UPDATE even when no file was chosen, missing records printed raw "Error1"/"Error2", and the SELECT used the raw GET id | Clean edit page: safe load, friendly not-found handling, photo only changes when a new one is uploaded (and is otherwise preserved) |
| 6 | **Export was an HTML table labelled `.xls`** with a hardcoded personal filename, posted in a way that silently failed | Real CSV download via GET that follows your current search |
| 7 | **Hotlinked logo** — the page loaded its logo from an external `codingcush.com` upload URL, so the UI broke whenever that file moved | No external images; the brand is built into the layout |
| 8 | **Database failure handling** — `db.php` echoed "Not Connected" and kept running, crashing pages with confusing errors | Clean, generic error message with setup guidance |
| 9 | **650-line index.php** with per-student View/Edit/Delete modals generated in a loop (slow, fragile, duplicated the add/edit logic) | Slim list page + dedicated `add.php` / `edit.php` / `view.php` pages and one shared form |
| 10 | SQL dump shipped **personal/test data** and a broken schema (unused `file` longblob NOT NULL broke inserts on strict MySQL; `u_state` varchar(12) truncated state names) | Clean schema-only dump with fixed column types |
| 11 | No input validation | Server-side validation: email format, 12-digit Aadhar, 6-digit pincode, phone, required fields |

The UI was also rebuilt: the old version used Bootstrap 3 + DataTables CDN scripts; the new UI is one self-contained stylesheet with a modern sidebar dashboard.

## Requirements

- PHP 8.0+ with `mysqli` extension
- MySQL 5.7+ / MariaDB 10.3+
- Apache (XAMPP / WAMP / LAMP / shared hosting)

## Author

**Lavkush Kumar** — [Coding Cush](https://codingcush.com) · [YouTube](https://www.youtube.com/@CodingCush)

## License

Free to use for learning and your own projects. A product of Coding Cush.
