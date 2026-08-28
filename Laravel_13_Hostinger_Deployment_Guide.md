# Laravel 13 Deployment on Hostinger Shared Hosting

## Purpose

This guide documents the deployment method that worked for my Laravel 13 application on Hostinger, including the folder structure, `public_html` setup, `.htaccess`, `index.php`, `.env`, database, Vite assets, storage, cache, and troubleshooting.

The important idea is:

> Keep the Laravel application outside `public_html`, and expose only Laravel's `public` directory through `public_html`.

This keeps files such as `.env`, `app/`, `routes/`, `vendor/`, and `storage/` outside the public web root.

---

# 1. Understand the deployment structure

My Hostinger setup is approximately:

```text
/home/u234989298/
└── domains/
    └── darkorchid-ibex-341102.hostingersite.com/
        ├── public_html/
        │   ├── index.php
        │   ├── .htaccess
        │   ├── build/
        │   ├── favicon.ico
        │   └── other files from Laravel's public/
        │
        └── sinas/
            ├── app/
            ├── bootstrap/
            ├── config/
            ├── database/
            ├── public/
            ├── resources/
            ├── routes/
            ├── storage/
            ├── vendor/
            ├── .env
            ├── artisan
            └── composer.json
```

In this example:

```text
Laravel application:
 /home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas

Public web root:
 /home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/public_html
```

Your actual username, domain, and application folder may be different on another website.

---

# 2. Before deploying: prepare the local Laravel project

On the local PC, make sure the application works first.

Test:

```bash
php artisan serve
```

Open the local website and test:

- Home page
- `/news`
- `/gallery`
- `/vision`
- Authentication
- Admin/Filament
- Forms and validation
- Image uploads
- Database operations

Also make sure there are no local-only paths in the application.

## Important

Do NOT copy your local `.env` blindly to production.

The production `.env` needs the Hostinger database credentials and production settings.

---

# 3. Build the Vite assets locally

Laravel uses Vite for frontend assets.

Run:

```bash
npm install
npm run build
```

This creates:

```text
public/build/
```

and normally:

```text
public/build/manifest.json
```

This is important because a production server may show:

```text
Vite manifest not found at:
public/build/manifest.json
```

if the frontend assets were not built.

After running:

```bash
npm run build
```

make sure the local project contains:

```text
public/
└── build/
    ├── manifest.json
    └── assets/
        └── ...
```

The `build` directory must eventually be copied into Hostinger's `public_html`.

---

# 4. Prepare the Laravel application archive

A convenient method is to create a ZIP of the Laravel project.

The ZIP should contain things such as:

```text
app/
bootstrap/
config/
database/
resources/
routes/
storage/
vendor/
artisan
composer.json
composer.lock
.env.example
```

Do NOT expose the following through `public_html`:

```text
.env
app/
bootstrap/
config/
database/
resources/
routes/
storage/
vendor/
```

They belong outside the public web root.

## About vendor/

There are two possible approaches:

### Option A — Upload `vendor/`

This is convenient when Composer is difficult to run on shared hosting.

Make sure the dependencies were installed correctly for the production PHP version.

### Option B — Run Composer on Hostinger

If Composer is available and the server PHP version is compatible:

```bash
composer install --no-dev --optimize-autoloader
```

This is generally cleaner for production.

If you do not have SSH/Composer access, uploading the already-built `vendor/` directory can be used instead.

---

# 5. Create the website in Hostinger

In Hostinger:

1. Create the website/domain.
2. Open File Manager.
3. Locate the domain directory.
4. Find `public_html`.

For this project the relevant area is:

```text
domains/
└── darkorchid-ibex-341102.hostingersite.com/
    └── public_html/
```

---

# 6. Upload the Laravel application outside public_html

Create/upload the Laravel application as:

```text
domains/
└── darkorchid-ibex-341102.hostingersite.com/
    ├── public_html/
    └── sinas/
```

The complete Laravel application goes into:

```text
sinas/
```

For example:

```text
sinas/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── artisan
├── composer.json
└── composer.lock
```

Do not put the entire Laravel application directly into `public_html`.

---

# 7. Copy the contents of Laravel's public directory

Open:

```text
sinas/public/
```

You will see files such as:

```text
index.php
.htaccess
favicon.ico
build/
...
```

Copy the CONTENTS of `sinas/public/` into:

```text
public_html/
```

Do NOT create:

```text
public_html/public/
```

The correct result is:

```text
public_html/
├── index.php
├── .htaccess
├── build/
└── ...
```

while the original Laravel project remains:

```text
sinas/
└── public/
```

The original `sinas/public` can remain there; it is simply not the web root.

---

# 8. Configure public_html/index.php

This is one of the most important deployment steps.

Because `public_html` is no longer directly connected to the Laravel project using the normal relative paths, its `index.php` must point to the actual Laravel application.

For this specific deployment:

```text
Laravel:
 /home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas
```

Use:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

if (file_exists($maintenance = '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/storage/framework/maintenance.php')) {
    require $maintenance;
}

require '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/vendor/autoload.php';

/** @var Application $app */
$app = require_once '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/bootstrap/app.php';

$app->handleRequest(Request::capture());
```

### Why are these paths absolute?

Normally Laravel's original `public/index.php` may use paths such as:

```php
require __DIR__.'/../vendor/autoload.php';
```

That assumes the `public` directory is immediately inside the Laravel application.

In this Hostinger arrangement:

```text
public_html/
sinas/
```

are separate locations.

Therefore:

```php
__DIR__.'/../vendor/autoload.php'
```

would point to the wrong place.

The absolute path tells PHP exactly where the Laravel application is.

---

# 9. Configure bootstrap/app.php

This is different from `public_html/index.php`.

The Laravel application's own:

```text
sinas/bootstrap/app.php
```

should use Laravel's normal relative routing paths:

```php
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
```

### Important distinction

`public_html/index.php`:

```text
Uses absolute Hostinger paths
```

`sinas/bootstrap/app.php`:

```text
Uses Laravel's normal relative paths
```

Do NOT change:

```php
web: __DIR__.'/../routes/web.php'
```

to:

```php
web: '/home/u234989298/.../routes/web.php'
```

Laravel's `__DIR__` is already inside:

```text
sinas/bootstrap/
```

so:

```text
__DIR__.'/../routes/web.php'
```

correctly resolves to:

```text
sinas/routes/web.php
```

---

# 10. Configure .htaccess

The `.htaccess` inside `public_html` should contain Laravel's rewrite rules.

Use:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Handle X-XSRF-Token Header
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Redirect Trailing Slashes If Not A Folder
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

The final rule is especially important:

```apache
RewriteRule ^ index.php [L]
```

It sends Laravel routes such as:

```text
/test
/news
/gallery
/admin
```

to Laravel's front controller when they are not physical files/directories.

---

# 11. Create the production database

In Hostinger:

1. Open the database/MySQL section.
2. Create a MySQL database.
3. Create the database user if required.
4. Give the user access to the database.
5. Record:

```text
DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD
```

Do not assume these values are the same as your local computer.

---

# 12. Configure the production .env

The `.env` file belongs here:

```text
sinas/.env
```

NOT:

```text
public_html/.env
```

A typical production configuration:

```env
APP_NAME="Sinas"
APP_ENV=production
APP_KEY=base64:YOUR_APPLICATION_KEY
APP_DEBUG=false
APP_URL=https://your-domain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=your-hostinger-db-host
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

Keep:

```env
APP_DEBUG=false
```

on the live website.

## APP_KEY

If the project already has a valid `APP_KEY`, keep it.

Do not casually generate a new key on an existing production application because encrypted data/cookies can become unreadable.

---

# 13. Database migration

If the Hostinger database is new, migrate the database structure.

If you have command-line access:

```bash
php artisan migrate --force
```

If you do not have SSH access, use an appropriate database import/export method.

For example, export the required database from your local environment and import it into the Hostinger MySQL database using the Hostinger database tools/phpMyAdmin.

For a new production database, make sure the tables required by:

- Laravel
- authentication
- Filament
- your application modules

exist.

---

# 14. Storage and uploaded files

Laravel uses:

```text
storage/
```

for application storage.

If the application uses:

```php
Storage::disk('public')
```

you normally need Laravel's public storage link:

```text
public/storage
→ storage/app/public
```

On a standard Laravel installation this is created using:

```bash
php artisan storage:link
```

If you cannot run Artisan on Hostinger, the storage arrangement may need to be created manually depending on Hostinger's file/link support.

For uploaded images, do not unnecessarily put them directly into random locations inside `public_html`.

Use Laravel's storage system consistently.

---

# 15. Permissions

Laravel needs to be able to write to:

```text
storage/
bootstrap/cache/
```

The important directories include:

```text
sinas/storage/
sinas/storage/framework/
sinas/storage/logs/
sinas/storage/app/
sinas/bootstrap/cache/
```

If Laravel reports permission errors, adjust permissions using Hostinger File Manager according to the hosting environment.

Do not make the entire Laravel project world-writable.

---

# 16. Clear Laravel cache

After changing `.env`, routes, configuration, or deployment files, Laravel may still use cached information.

If Artisan is available:

```bash
php artisan optimize:clear
```

This clears Laravel's cached:

- configuration
- routes
- views
- events

Then, if desired, production caches can be rebuilt:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Do this only after confirming the application works.

---

# 17. Vite production files

After:

```bash
npm run build
```

the local project should contain:

```text
public/build/
├── manifest.json
└── assets/
```

Copy:

```text
local-project/public/build/
```

to:

```text
public_html/build/
```

A common production error is:

```text
Vite manifest not found at:
.../public/build/manifest.json
```

This means the production build files are missing or are in the wrong location.

For this deployment, the browser needs:

```text
public_html/build/manifest.json
```

---

# 18. Test the website in a logical order

Do not immediately start changing configuration if something fails.

Test in this order:

## Test 1 — Homepage

```text
https://your-domain.com/
```

## Test 2 — Existing view route

For example:

```text
https://your-domain.com/news
```

## Test 3 — Simple Laravel route

Add temporarily to:

```text
sinas/routes/web.php
```

```php
Route::get('/test', function () {
    return 'Laravel test route is working!';
});
```

Then visit:

```text
https://your-domain.com/test
```

## Test 4 — Authentication

Test:

```text
/login
```

and logout.

## Test 5 — Filament

Test:

```text
/admin
```

## Test 6 — Database

Create/read/update/delete a test record.

## Test 7 — File uploads

Upload an image/file through the application.

---

# 19. Very important route debugging lesson

During this deployment, the `/test` route initially returned 404 even though routes such as:

```text
/news
/gallery
/vision
```

were working.

We eventually tested the actual public entry point by temporarily changing:

```text
public_html/index.php
```

to:

```php
<?php

echo "INDEX.PHP IS WORKING";
exit;
```

When `/test` displayed:

```text
INDEX.PHP IS WORKING
```

we proved:

```text
Browser
    ↓
Hostinger
    ↓
.htaccess
    ↓
public_html/index.php
```

was working.

Then we tested Laravel bootstrapping:

```php
<?php

require '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/vendor/autoload.php';

$app = require_once '/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/bootstrap/app.php';

echo 'Laravel application bootstrapped successfully';

exit;
```

That also worked.

Therefore:

```text
index.php                         ✓
Composer autoload                 ✓
bootstrap/app.php                 ✓
Laravel bootstrap                 ✓
```

The remaining problem was in the routing/application layer.

### Lesson

When debugging Laravel on shared hosting, test the chain one layer at a time:

```text
Domain
  ↓
.htaccess
  ↓
public_html/index.php
  ↓
vendor/autoload.php
  ↓
bootstrap/app.php
  ↓
routes/web.php
  ↓
route
  ↓
controller/view
```

Do not change several files simultaneously.

---

# 20. Filament deployment considerations

For a Laravel application using Filament:

```text
/admin
```

is a Laravel/Filament route.

Therefore, if:

```text
/news
```

works but:

```text
/admin
```

does not, do not automatically assume that Filament is broken.

First establish whether Laravel itself is receiving the `/admin` request.

Also verify that the production installation contains the Filament dependencies under:

```text
vendor/
```

and that the Filament panel provider is correctly registered.

For example, your project may contain:

```text
app/Providers/Filament/
```

or the corresponding Filament configuration generated by the installed Filament version.

---

# 21. PHP version compatibility

This was an important issue during the project setup.

Laravel 13 requires a compatible PHP version. Make sure the Hostinger website is configured to use a PHP version supported by your application's Laravel/dependency versions.

Check the PHP version in Hostinger's PHP configuration.

Also remember that:

```text
PHP used by the web server
```

and:

```text
PHP used by CLI/Composer
```

can sometimes differ.

If Composer reports a platform error such as:

```text
Your Composer dependencies require a PHP version >= ...
```

do not ignore it.

The PHP version used to install dependencies must be compatible with the production PHP environment.

---

# 22. Composer deployment

If Composer is available on the server:

```bash
cd /path/to/sinas
composer install --no-dev --optimize-autoloader
```

Then:

```bash
php artisan optimize:clear
```

For production, after testing:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

If you cannot use SSH/Composer, upload a correctly generated `vendor/` directory instead.

Do not mix dependencies generated for an incompatible PHP version with the production server.

---

# 23. Git deployment for future updates

Once the first deployment works, Git can make future deployments much easier.

The normal workflow is:

```text
Local PC
   ↓
git add .
   ↓
git commit
   ↓
git push
   ↓
Hostinger
   ↓
git pull
   ↓
composer install/update if required
   ↓
npm run build locally or build on server
   ↓
clear/cache Laravel
```

Do NOT commit:

```text
.env
```

Use `.env.example` for documenting required environment variables.

---

# 24. Updating an existing production website

For a normal code update:

1. Backup the production database if the change is important.
2. Update the application code.
3. Update dependencies if `composer.lock` changed.
4. Deploy the new Vite build.
5. Run migrations if database structure changed.
6. Clear/rebuild Laravel caches.
7. Test the application.

Typical command sequence:

```bash
composer install --no-dev --optimize-autoloader

php artisan migrate --force

php artisan optimize:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Do not run database-destructive commands such as:

```bash
php artisan migrate:fresh
```

on a production database unless you intentionally want to delete the existing database tables/data.

---

# 25. Common problems and what they usually mean

## A. `vendor/autoload.php` not found

Check:

```text
public_html/index.php
```

and make sure:

```php
require '/home/.../sinas/vendor/autoload.php';
```

points to the actual `vendor/autoload.php`.

---

## B. `bootstrap/app.php` not found

Check:

```php
$app = require_once '/home/.../sinas/bootstrap/app.php';
```

in:

```text
public_html/index.php
```

---

## C. Vite manifest not found

Make sure:

```text
public_html/build/manifest.json
```

exists.

Locally run:

```bash
npm run build
```

and upload the resulting:

```text
public/build/
```

to:

```text
public_html/build/
```

---

## D. Laravel pages return 404

Check:

1. `public_html/.htaccess`
2. `public_html/index.php`
3. `sinas/bootstrap/app.php`
4. `sinas/routes/web.php`
5. Laravel route cache
6. Whether the request is actually reaching Laravel

A simple route:

```php
Route::get('/test', function () {
    return 'TEST';
});
```

is an excellent diagnostic.

---

## E. All routes return 404

Test:

```php
echo "INDEX.PHP IS WORKING";
exit;
```

in `public_html/index.php`.

If that works, the web server and rewrite are reaching the front controller.

Then test Laravel bootstrapping.

---

## F. Existing view routes work but a new simple route does not

Check whether the new route is actually present in the deployed:

```text
sinas/routes/web.php
```

file.

Also clear Laravel caches:

```bash
php artisan optimize:clear
```

Remember that File Manager edits are made on the server, while your local project may contain different code.

---

## G. HTTP 500

Check:

```text
sinas/storage/logs/laravel.log
```

The Laravel log is often much more useful than the browser's generic 500 page.

Temporarily enabling:

```env
APP_DEBUG=true
```

can reveal errors during development/debugging, but it should NOT remain enabled on a public production website.

---

# 26. Security checklist

Before considering deployment finished:

- [ ] `.env` is outside `public_html`
- [ ] `APP_DEBUG=false`
- [ ] Strong database password
- [ ] No passwords/API keys committed to Git
- [ ] Only Laravel's public files are exposed
- [ ] `storage/` and `bootstrap/cache/` have appropriate permissions
- [ ] HTTPS is enabled
- [ ] Admin account uses a strong password
- [ ] Production database is backed up
- [ ] Temporary diagnostic files are deleted
- [ ] No test routes remain
- [ ] No `dd()` statements remain
- [ ] No `echo ...; exit;` debugging code remains in `index.php`

Especially delete temporary files such as:

```text
public_html/clear-cache.php
```

if one was created for deployment troubleshooting.

---

# 27. Final deployment checklist

Use this checklist every time.

## Local computer

- [ ] Laravel application works locally
- [ ] Database migrations work
- [ ] Authentication works
- [ ] Filament works
- [ ] Forms/validation work
- [ ] Uploads work
- [ ] `npm run build` completed
- [ ] `public/build/manifest.json` exists
- [ ] `.env` is not being uploaded as the production configuration
- [ ] Code is committed to Git if using Git

## Hostinger

- [ ] Website created
- [ ] PHP version is compatible
- [ ] Laravel application uploaded outside `public_html`
- [ ] `public/` contents copied into `public_html`
- [ ] `public_html/index.php` points to the actual Laravel directory
- [ ] `public_html/.htaccess` is present
- [ ] Production `.env` created inside Laravel directory
- [ ] Database created
- [ ] Database credentials added to `.env`
- [ ] Database migrated/imported
- [ ] `vendor/` exists and is compatible with production PHP
- [ ] `public_html/build/manifest.json` exists
- [ ] Storage is configured
- [ ] Laravel cache cleared
- [ ] Website tested
- [ ] `/admin` tested
- [ ] Login tested
- [ ] Uploads tested
- [ ] Temporary diagnostic files removed
- [ ] `APP_DEBUG=false`

---

# 28. The most important paths to remember

For this particular deployment:

```text
Laravel application:

/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas
```

Public web root:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/public_html
```

Laravel routes:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/routes/web.php
```

Laravel environment:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/.env
```

Composer autoloader:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/vendor/autoload.php
```

Laravel bootstrap:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/bootstrap/app.php
```

Public entry point:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/public_html/index.php
```

Vite manifest:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/public_html/build/manifest.json
```

Laravel log:

```text
/home/u234989298/domains/darkorchid-ibex-341102.hostingersite.com/sinas/storage/logs/laravel.log
```

---

# 29. Simple mental model

The easiest way to remember the entire deployment is:

```text
                    INTERNET
                       │
                       ▼
                public_html/
                       │
             ┌─────────┴─────────┐
             │                   │
        .htaccess            index.php
                                 │
                                 ▼
                         Laravel application
                              /sinas
                                 │
             ┌───────────────────┼───────────────────┐
             │                   │                   │
          routes/              app/               vendor/
             │
             ▼
          web.php
             │
             ▼
       Laravel routes
             │
             ▼
       Controllers/Views
```

`public_html` is the **door to the website**.

`sinas` is the **actual Laravel application**.

Only the files Laravel needs to serve publicly should be exposed through `public_html`.

---

# 30. Recommended repeatable deployment procedure

For the next Laravel project, follow this order:

```text
1. Finish and test Laravel locally
        ↓
2. Configure production-compatible PHP
        ↓
3. npm install
        ↓
4. npm run build
        ↓
5. Prepare Laravel application
        ↓
6. Create Hostinger website
        ↓
7. Upload Laravel app outside public_html
        ↓
8. Copy public/ contents → public_html/
        ↓
9. Fix public_html/index.php paths
        ↓
10. Keep bootstrap/app.php paths relative
        ↓
11. Add production .env
        ↓
12. Create/configure MySQL database
        ↓
13. Migrate/import database
        ↓
14. Ensure vendor/ exists
        ↓
15. Ensure public_html/build/ exists
        ↓
16. Configure storage
        ↓
17. Clear Laravel caches
        ↓
18. Test homepage
        ↓
19. Test simple /test route
        ↓
20. Test login
        ↓
21. Test /admin
        ↓
22. Test database operations
        ↓
23. Test uploads
        ↓
24. Remove all temporary debugging code
        ↓
25. Set APP_DEBUG=false
        ↓
26. Take a production backup
```

This sequence minimizes confusion because each layer is verified before moving to the next one.
