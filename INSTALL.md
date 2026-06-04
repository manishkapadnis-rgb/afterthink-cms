# Afterthink Studio PHP CMS Installation Guide

## Requirements
- PHP 8.0 or newer
- MySQL 5.7+ / MariaDB compatible
- Apache or Nginx with PHP support
- `mod_rewrite` enabled in Apache for pretty URLs

## Installation steps

1. Copy the `afterthink_cms` folder into your web server document root.
2. Create a MySQL database named `afterthink_cms`.
3. Import the `database.sql` file into the new database.
   - Example using the command line:
     ```bash
     mysql -u root -p afterthink_cms < path/to/database.sql
     ```
4. Update database credentials in `includes/config.php`:
   - `DB_HOST`
   - `DB_NAME`
   - `DB_USER`
   - `DB_PASS`
5. Ensure upload permissions are set on `assets/uploads/`:
   - Linux/macOS: `chmod -R 755 assets/uploads`
6. Set `BASE_URL` in `includes/config.php` if the site is installed in a subfolder.
7. Open the site in your browser:
   - Frontend: `http://yourdomain.com/afterthink_cms/`
   - Admin login: `http://yourdomain.com/afterthink_cms/admin/login.php`

## Admin login
- Username: `admin`
- Password: `admin123`

## Notes
- Use `admin/hero_slider.php`, `admin/about.php`, `admin/services.php`, `admin/portfolio.php`, and other admin pages to manage site content.
- Add portfolio categories in `portfolio_categories.php` and gallery categories in `gallery_categories.php` if those pages are included.
- If you deploy to a different directory, update `BASE_URL` and `robots.txt` accordingly.
- To enable pretty URLs, ensure `.htaccess` is allowed and Apache `AllowOverride All` is set.
