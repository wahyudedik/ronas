---
name: news-events-db
overview: Add DB-backed News & Events with public listing/detail pages, admin CRUD, landing section integration, and seed data with permissions.
todos:
  - id: create-models
    content: Add News/Event models + migrations (slug + fields).
    status: completed
  - id: public-pages
    content: Public controllers + routes + list/detail views.
    status: completed
  - id: landing-hook
    content: Landing section uses latest News/Events.
    status: completed
  - id: admin-crud
    content: Admin CRUD routes/controllers/views + permissions + nav.
    status: completed
  - id: seed-data
    content: Seed News/Event data and register seeders.
    status: completed
---

# News & Events Setup Plan

## Overview

Implement DB-backed News & Events with public listing/detail routes (`/news/{slug}`, `/events/{slug}`), admin CRUD (user/admin), and use these records for the landing page sections. Add seed data and permissions.

## Files to Touch

- Routes: [`routes/web.php`](routes/web.php)
- Public controllers: `app/Http/Controllers/CollegeNewsController.php`, `app/Http/Controllers/CollegeEventsController.php`
- Admin controllers: `app/Http/Controllers/Admin/NewsController.php`, `app/Http/Controllers/Admin/EventController.php`
- Models: `app/Models/News.php`, `app/Models/Event.php`
- Migrations: `database/migrations/*_create_news_table.php`, `database/migrations/*_create_events_table.php`
- Views (public):
- [`resources/views/college/news.blade.php`](resources/views/college/news.blade.php)
- [`resources/views/college/news-details.blade.php`](resources/views/college/news-details.blade.php)
- [`resources/views/college/events.blade.php`](resources/views/college/events.blade.php)
- [`resources/views/college/event-details.blade.php`](resources/views/college/event-details.blade.php)
- Views (admin): `resources/views/admin/news/*`, `resources/views/admin/events/*`
- Landing integration: [`app/Http/Controllers/LandingPageController.php`](app/Http/Controllers/LandingPageController.php), [`resources/views/college/index.blade.php`](resources/views/college/index.blade.php)
- Navigation/permissions: [`resources/views/layouts/navigation.blade.php`](resources/views/layouts/navigation.blade.php), [`database/seeders/UserSeeder.php`](database/seeders/UserSeeder.php)
- Seeders: `database/seeders/NewsSeeder.php`, `database/seeders/EventSeeder.php`, [`database/seeders/DatabaseSeeder.php`](database/seeders/DatabaseSeeder.php)

## Implementation Steps

1. **Create models + migrations**

- `news` table: title, slug (unique), category, excerpt, content, author_name, author_image, image, published_at, is_active, sort_order.
- `events` table: title, slug (unique), category, description, event_date, event_time, location, participants, image, registration_url, is_active, sort_order.
- Add model casts for date fields and helpers for slug creation.

2. **Public controllers + routes**

- Replace `Route::view('/news')` & `Route::view('/events')` with controller actions for listing and detail.
- Add `/news/{slug}` and `/events/{slug}` detail routes with route-model binding.
- Listing uses pagination and `is_active` (and optional published date ordering).

3. **Landing page integration**

- Update `LandingPageController` to load latest active News/Event items for the landing sections.
- Update landing view to link to detail routes via slug (no manual `link_url`).

4. **Admin CRUD (user/admin)**

- Add admin routes under `auth` + permission middleware (new permissions: `manage news`, `manage events`).
- Build admin views for list/create/edit with image upload handling (similar to landing items).
- Add menu links in `resources/views/layouts/navigation.blade.php` for News/Events.

5. **Seeders + permissions**

- Add `NewsSeeder` and `EventSeeder` with sample records + images (using existing public assets).
- Update `UserSeeder` to create permissions (`manage news`, `manage events`) and grant to admin + user roles.
- Register new seeders in `DatabaseSeeder`.

## Implementation Todos

- `create-models`: Add `News`/`Event` models + migrations (slug, fields, casts).
- `public-pages`: Build public controllers + update routes and Blade pages for listing/detail.
- `landing-hook`: Wire landing page sections to latest News/Events.
- `admin-crud`: Add admin controllers, views, routes, and permissions + nav links.
- `seed-data`: Add seeders and register them in `DatabaseSeeder`.