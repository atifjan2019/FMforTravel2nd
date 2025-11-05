# Deploy to Coolify on Hostinger VPS

This guide shows how to deploy this Laravel app to a Coolify instance running on a Hostinger (or any) VPS. It covers a quick start using SQLite and a production-ready setup with Postgres plus queue workers and scheduler.

## Prerequisites

- A Hostinger VPS (Ubuntu 22.04+ recommended) with a public IP
- A domain (e.g., app.example.com) pointing to the VPS (A record)
- Docker installed (Coolify installer will handle it if missing)
- Your repository available on GitHub/GitLab (this repo)

## 1) Install Coolify on the VPS

SSH into the VPS as a sudo-enabled user and run:

```bash
curl -fsSL https://cdn.coollabs.io/coolify/install.sh | bash
```

- Open Coolify at: http://<your-vps-ip>:8000 and finish the onboarding.
- In Settings → Domains, add your domain (e.g., app.example.com) and enable SSL for automatic certificates (Traefik).

## 2) Add the application in Coolify

- Create → Application → Select “PHP” (recommended for Laravel) or “Git Repository”
- Connect your Git provider and select this repository
- Branch: main
- Root directory: /
- Publish directory: public

### Build commands

Choose one of the following approaches:

- Option A (use prebuilt assets):
  - Skip Node build (this repo includes `public/build`).
  - Build commands:
    - composer install --no-dev --optimize-autoloader --no-interaction
    - php artisan optimize

- Option B (build assets in Coolify):
  - Build commands:
    - composer install --no-dev --optimize-autoloader --no-interaction
    - npm ci
    - npm run build
    - php artisan optimize

### Start command

- Not required for Coolify PHP template (Caddy/PHP-FPM is managed by the platform).

### Persistent storage (Volumes)

Add persistent storage paths so uploads, caches, and (optionally) SQLite survive deployments:

- /app/storage
- /app/bootstrap/cache
- If using SQLite in production: /app/database/database.sqlite

### Environment variables

Set the following in Coolify → Application → Environment:

- APP_NAME=Al Nafi Travels
- APP_ENV=production
- APP_DEBUG=false
- APP_URL=https://YOUR_DOMAIN
- SESSION_DRIVER=file
- LOG_CHANNEL=stack

Database (choose one):

- SQLite (quick start):
  - DB_CONNECTION=sqlite
  - Ensure the file `database/database.sqlite` exists (it is committed in this repo). Also mark it as persistent storage above.

- Postgres (recommended for production):
  - Create a Postgres service in Coolify (Add → Database → Postgres). Note the credentials and internal hostname.
  - Set:
    - DB_CONNECTION=pgsql
    - DB_HOST=<coolify-internal-hostname> (e.g., srv-coolify-db)
    - DB_PORT=5432
    - DB_DATABASE=<db_name>
    - DB_USERNAME=<db_user>
    - DB_PASSWORD=<db_pass>

Mail (optional): configure MAIL_MAILER, MAIL_HOST, MAIL_PORT, MAIL_USERNAME, MAIL_PASSWORD, MAIL_ENCRYPTION, MAIL_FROM_ADDRESS, MAIL_FROM_NAME.

APP_KEY:

- Generate once if empty:
  - Actions → Run Command → `php artisan key:generate --force`
  - Coolify will persist your `.env` entries; otherwise, set APP_KEY manually from the output.

### Post-deploy commands

In the Application → Post-deploy (or as “Run Command” after first deploy):

- php artisan storage:link || true
- php artisan migrate --force
- php artisan cache:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache

## 3) Domain and SSL

- In Coolify, set the domain for this app (e.g., app.example.com)
- Enable “HTTPS/SSL (Traefik)” for automatic Let’s Encrypt certificates

## 4) Background jobs (queue & scheduler)

Queues:
- Duplicate this application as a “Background Service” (or add a Background task) pointing to the same repo and environment.
- Command: `php artisan queue:work --tries=3 --timeout=60 --verbose`
- Ensure it shares the same persistent storage (so logs/storage are consistent) and the same env vars.

Scheduler:
- Use Coolify’s “Cron Job” to run every minute:
  - Command: `php artisan schedule:run`
  - Alternatively, create a background service: `php artisan schedule:work`

## 5) First deploy checklist

- Deploy the app in Coolify
- Run the Post-deploy commands (if not configured to run automatically)
- Visit your domain and log in

## 6) Notes & tips

- Reports: Routes are wired under `/reports/*`
- If you use SQLite, consider migrating to Postgres/MySQL before heavy production usage
- Update APP_URL to match your domain to avoid mixed-content/session issues
- For better performance, keep caches warm (config/route/view) and ensure `APP_DEBUG=false`

## Troubleshooting

- 502/404 errors: Check Coolify logs for the app, verify Publish directory is `public`
- 500 errors: Check `/app/storage/logs/laravel.log` via Coolify shell or logs; ensure `php artisan config:cache` executed after env changes
- Asset issues: If you didn’t build in Coolify, confirm `public/build` exists. If not, enable the Node build step (npm ci && npm run build)
- DB connection: Verify DB_* env vars. For SQLite, confirm the file path is correct and persistent
