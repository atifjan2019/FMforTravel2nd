# Al Nafi Travels - Financial Management System

Welcome! This repo contains a Laravel-based financial management system tailored for travel businesses.

## Local development (quick start)

1. PHP 8.2+, Composer, and Node 18+ required
2. Copy env and generate key
	- cp .env.example .env
	- php artisan key:generate
3. Install dependencies and build assets
	- composer install
	- npm ci && npm run build
4. Migrate and seed (optional)
	- php artisan migrate --seed
5. Serve
	- php artisan serve

Default login (if seeded): admin@alnafi.com / password

## Production deployment

For step-by-step deployment to a Coolify-managed Hostinger VPS, see:

- DEPLOY_COOLIFY.md

That guide covers domain/SSL, environment variables, persistent storage, database options (SQLite/Postgres), background workers, and post-deploy commands.
