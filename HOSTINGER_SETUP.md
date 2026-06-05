# Hostinger Setup — afterthinkstudio.creative-fusion.co.in

Step-by-step for deploying this CMS to Hostinger shared hosting with Git
auto-deploy.

## 1. Subdomain & document root

- Subdomain: `afterthinkstudio.creative-fusion.co.in`
- Document root: `public_html/afterthinkstudio`

The repository root (the folder with `index.php`) maps to that document root,
so the site serves at the subdomain root — URLs are clean, e.g.
`/about`, `/services`, `/project/<slug>` (no `/afterthink_php_cms` segment).

## 2. Git auto-deploy

The repo `manishkapadnis-rgb/afterthink-cms` is connected with auto-deploy on
the `main` branch. Pushing to `main` deploys to the subdomain automatically.
After a push, confirm the deployment reaches **Completed** in hPanel → Git.

## 3. Database (hPanel → Databases → MySQL)

1. The database and user already exist:
   - DB name / user: `u663620806_afterthink`
   - Host: `127.0.0.1` (use this rather than `localhost` if you hit
     `SQLSTATE[HY000] [1045] Access denied ... using password: YES`)
2. Import `database.sql` via **phpMyAdmin → Import** (fresh install) or
   `database_migration.sql` (upgrade an existing DB). The migration is
   idempotent and safe to re-run.

## 4. config.php

`config.php` is already set for this host:

```php
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'u663620806_afterthink');
define('DB_USER', getenv('DB_USER') ?: 'u663620806_afterthink');
define('DB_PASS', getenv('DB_PASS') ?: '********');
define('BASE_URL', getenv('BASE_URL') ?: 'https://afterthinkstudio.creative-fusion.co.in');
```

If the DB password is ever rotated in hPanel, update `DB_PASS` here (or set a
`DB_PASS` environment variable, which takes precedence).

## 5. Uploads directory

In hPanel → File Manager, ensure `uploads/` exists and is writable
(permissions `755`). Uploaded media is stored there and served from
`/uploads/...`. The directory's `.htaccess` prevents PHP execution.

## 6. HTTPS

Enable the free SSL certificate for the subdomain. The app auto-detects HTTPS
(via `HTTPS`, `X-Forwarded-Proto`, or port 443), so canonical/OG URLs and asset
links use `https://`.

## 7. Verify after deploy

1. Visit `https://afterthinkstudio.creative-fusion.co.in/` — hero slider,
   services, projects and testimonials should reflect database content.
2. Log in at `/admin/login.php` (`admin@afterthink.com` / `Admin123!`) and
   change the password under **Profile**.
3. Add a Hero Slide, a Service and a Blog Post; confirm they appear on the
   frontend.
4. Submit the contact form; confirm it appears under **Inquiries**.
5. Upload an image in **Media Library**; confirm it is reachable at its
   `/uploads/...` path.

## Common issues

| Symptom | Fix |
|---|---|
| `1045 Access denied … using password: YES` | Wrong `DB_PASS`, or use `127.0.0.1` instead of `localhost`. |
| Frontend shows placeholder content only | DB not imported, or DB connection failing (falls back to demo content). |
| 404/500 on clean URLs | `mod_rewrite` / `AllowOverride All` not enabled; confirm `.htaccess` is deployed. |
| Admin styles missing | Confirm `assets/css/admin.css` deployed and `BASE_URL` correct. |
