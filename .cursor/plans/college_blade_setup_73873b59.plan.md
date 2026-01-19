---
name: College Blade Setup
overview: Convert the static College HTML into Blade views using a shared layout, wire them to public web routes, and integrate a dashboard entry for quick access (Breeze already installed).
todos: []
---

# College Blade Integration Plan

## Approach

- Create a shared Blade layout for the College site with common header/footer assets, then split each page’s unique body into content sections.
- Add public web routes for each page path (e.g., `/about`, `/admissions`) pointing to their respective Blade views.
- Update the dashboard view to include links/shortcuts to the College pages for easy access.

## Key Files

- Layout and views under `resources/views/college/` (new).
- Routes in [`routes/web.php`](routes/web.php).
- Dashboard in [`resources/views/dashboard.blade.php`](resources/views/dashboard.blade.php).

## Steps

1. Create `resources/views/college/layouts/app.blade.php` containing the shared `<head>`, header/nav, footer, and asset includes from the HTML template.
2. For each HTML page in `public/College/`, create a matching Blade view under `resources/views/college/` that extends the shared layout and injects only the page-specific `<main>` content (keeping page-specific body classes). Examples:

- `resources/views/college/index.blade.php`
- `resources/views/college/about.blade.php`
- `resources/views/college/admissions.blade.php`
- ... for all listed pages.

3. Update [`routes/web.php`](routes/web.php) with named routes for each page path pointing to the new views.
4. Update [`resources/views/dashboard.blade.php`](resources/views/dashboard.blade.php) to add a “College Site” section with links to all public routes.

## Notes

- Keep all assets referenced from `public/College/assets` by using `/College/assets/...` paths in the shared layout.
- Preserve active nav state using route name checks in the layout.

## Todos

- `create-layout`: Build shared College layout in Blade.
- `create-views`: Port all HTML pages into Blade views extending the layout.
- `routes`: Add public routes for each College page.
- `dashboard-links`: Add a dashboard section linking to the College pages.