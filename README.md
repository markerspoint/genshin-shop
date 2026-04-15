# Genshin Character Marketplace (Laravel)

This project is a Laravel 11 app with:
- Public landing page (`/`)
- Auth (`/login`, `/register`)
- Dashboard marketplace (`/dashboard`) for buy/sell character listings

## Requirements

- PHP `8.2+`
- Composer
- Node.js `18+`
- `pnpm` (or npm/yarn, but commands below use pnpm)
- MySQL/MariaDB

## 1. Clone and Install

```bash
git clone <your-repo-url>
cd genshin
composer install
pnpm install
```

## 2. Environment Setup

If `.env` does not exist:

```bash
cp .env.example .env
php artisan key:generate
```

Update database settings in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=genshin
DB_USERNAME=root
DB_PASSWORD=
```

Create the database first (example):

```sql
CREATE DATABASE genshin;
```

## 3. Run Migrations

```bash
php artisan migrate
```

This creates required tables including `characters`, `sessions`, `cache`, and `jobs`.

## 4. Run the App Locally

Use 2 terminals:

Terminal A (Laravel server):
```bash
php artisan serve
```

Terminal B (Vite dev server):
```bash
pnpm run dev
```

Open:
- App: `http://127.0.0.1:8000`

## Production Build (optional local test)

```bash
pnpm run build
```

## Auth + Dashboard Flow

1. Register at `/register`
2. Login at `/login`
3. Go to `/dashboard`
4. Use:
   - **Sell Character** to create listing
   - **Marketplace** to buy listing
   - **Manage Listings** to edit/remove listing

## Useful Commands

```bash
# Check routes
php artisan route:list

# Clear caches
php artisan optimize:clear

# Re-run migrations from scratch (DANGEROUS: wipes data)
php artisan migrate:fresh
```

## Troubleshooting

- `Base table or view not found`: run `php artisan migrate`
- Styles/scripts not updating: restart `pnpm run dev`
- 419 Page Expired: refresh page and retry form submit
- DB connection errors: verify `.env` DB credentials and DB service status

