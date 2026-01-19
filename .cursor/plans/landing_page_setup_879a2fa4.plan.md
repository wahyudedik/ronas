---
name: Landing Page Setup
overview: Add a dashboard-only setup area to manage all landing page sections via database-backed models, forms, and front-end rendering on the College home page.
todos: []
---

# Landing Page Setup (Dashboard)

## Approach

- Create database tables/models for landing page content (hero, stats, programs, student life, testimonials, news, events).
- Build admin CRUD UI under dashboard to edit each section.
- Render the College home page from database content with safe fallbacks.

## Key Files

- New migrations/models for landing content under `app/Models/` and `database/migrations/`.
- Admin controller + routes under `app/Http/Controllers/` and [`routes/web.php`](routes/web.php).
- Admin views under `resources/views/admin/landing/`.
- Public rendering updated in [`resources/views/college/index.blade.php`](resources/views/college/index.blade.php).

## Steps

1. Define schema: create tables for each section (e.g., `landing_heroes`, `landing_stats`, `landing_programs`, `landing_student_life`, `landing_testimonials`, `landing_news`, `landing_events`) including ordering and visibility fields.
2. Create models and a single `LandingPageController` (or multiple section controllers) to handle CRUD in the dashboard.
3. Add admin routes (e.g., `/dashboard/landing/*`) protected by `auth` and permission `manage users` or a new `manage landing` permission.
4. Build dashboard UI to edit each section: list + edit forms, with upload support for images if needed.
5. Update the College home page to fetch the new data and render sections dynamically, with default/fallback content if empty.
6. Add a seeder to populate initial landing content from current static HTML so the page looks the same after the switch.

## Todos

- `schema`: Add migrations + models for landing sections.
- `admin-ui`: Build dashboard CRUD for each section.
- `routes-auth`: Add admin routes and permissions.
- `frontend`: Render database-backed content on `college/index`.
- `seed`: Seed initial landing content from current template.