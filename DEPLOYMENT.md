# Afterthink Studio CMS — Deployment Guide

A database-driven PHP (MVC) CMS. Frontend routes through a single front
controller (`index.php`); the admin lives under `/admin`.

## Requirements

- PHP 8.0+ (developed on 8.4) with PDO MySQL and `fileinfo` extensions
- MySQL 5.7+ / MariaDB 10.4+
- Apache with `mod_rewrite` (or Nginx with an equivalent rewrite)

## 1. Files

Deploy the project so its **root** (the folder containing `index.php`) is the
web root of the domain/subdomain. For Hostinger this is the subdomain's
document root, e.g. `public_html/afterthinkstudio`.

## 2. Database

1. Create a database and import the schema:
   ```bash
   mysql -u USER -p DBNAME < database.sql
   ```
   For an existing install created before hero slides / sort ordering / rate
   limiting were added, run the idempotent upgrade instead:
   ```bash
   mysql -u USER -p DBNAME < database_migration.sql
   ```

## 3. Configuration (`config.php`)

```php
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_NAME', getenv('DB_NAME') ?: 'your_db');
define('DB_USER', getenv('DB_USER') ?: 'your_user');
define('DB_PASS', getenv('DB_PASS') ?: 'your_password');
define('BASE_URL', getenv('BASE_URL') ?: 'https://your-domain');
```

- `BASE_URL` may be left to auto-detect (scheme + host + sub-path) or set
  explicitly. Environment variables override the file values.
- On shared hosting, prefer `127.0.0.1` for `DB_HOST` (TCP) if the socket
  `localhost` connection is refused.

## 4. Uploads

`uploads/` must be writable by the web server (e.g. `chmod 755 uploads`).
`uploads/.htaccess` blocks script execution inside the directory — keep it.

## 5. Rewrites

`.htaccess` ships a front-controller rewrite that works at a domain root or in
a subfolder (no `RewriteBase`). Ensure Apache `AllowOverride All` is set. For
Nginx use:

```nginx
location / { try_files $uri $uri/ /index.php?$query_string; }
```

## 6. Admin

- URL: `https://your-domain/admin/login.php`
- Default seeded credentials: `admin@afterthink.com` / `Admin123!`
- **Change the password immediately** under *Profile*.

## 7. Post-deploy checklist

- [ ] Homepage hero, services, projects, testimonials load from DB
- [ ] `/services`, `/portfolio`, `/project/<slug>`, `/blog`, `/blog/<slug>`, `/contact`
- [ ] Admin login + all modules (Hero Slider, Pages, Services, Projects,
      Gallery, Testimonials, Team, Blog, Media, Settings, Inquiries)
- [ ] Contact form stores an inquiry (visible under *Inquiries*)
- [ ] Media upload + delete works
- [ ] `last_login` updates on login; 6 bad logins trigger the lockout

See `HOSTINGER_SETUP.md` for host-specific steps.
