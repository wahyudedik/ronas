---
name: About Campus Setup
overview: Add database-backed About Campus sections (sejarah, misi-viSi, nilai inti, leadership/team) with role-based admin/user management, then render them on the About page and a new landing section plus menu anchors.
todos:
  - id: db-models
    content: Create migrations + models for About sections
    status: completed
  - id: admin-crud
    content: Add admin controllers/views + permission + routes
    status: completed
    dependencies:
      - db-models
  - id: public-render
    content: Render About data on landing + about page + menus
    status: completed
    dependencies:
      - admin-crud
---

# About Campus DB + UI Setup

## Scope

- Implement CRUD for About sections as separate resources (history, mission/vision, core values, leadership/team) with role-based access (`manage about`).
- Render dynamic content on `About` page and add a summary section on the landing page, plus add menu anchors for section navigation.

## Implementation Steps

1) **Database + Models**

- Add migrations for:
- `about_histories` (title, heading, description, image, is_active) + `about_history_milestones` (year, description, sort_order, is_active, about_history_id).
- `about_mission_visions` (type: mission/vision, title, description, is_active).
- `about_core_values` (icon_class, title, description, sort_order, is_active).
- `about_leadership_sections` (subtitle, title, description, image, experience_years, experience_text, is_active) + `about_leadership_highlights` (icon_class, title, description, sort_order, is_active, about_leadership_section_id) + `about_leadership_members` (name, role, bio, image, social_links json, sort_order, is_active).
- Add models in `app/Models` with relationships and fillable fields.

2) **Permissions + Routes**

- Add `manage about` permission in `database/seeders/UserSeeder.php`, assign to admin role by default.
- Create route group `dashboard/about` in `routes/web.php` guarded by `permission:manage about` with resource controllers for each About section and reorder/toggle actions.
- Add admin navigation link in `resources/views/layouts/navigation.blade.php` for users with `manage about`.

3) **Admin Controllers + Views**

- Implement controllers in `app/Http/Controllers/Admin` patterned after landing controllers (validation, image upload handling, reorder, toggle).
- Create admin views under `resources/views/admin/about/*` with index/create/edit and shared partial forms similar to `resources/views/admin/landing/*`.

4) **Public Rendering**

- Update `app/Http/Controllers/LandingPageController.php` to load About data for homepage.
- Update `resources/views/college/index.blade.php` to add an “About” section (summary of history + mission/vision + top values/leadership).
- Update `resources/views/college/about.blade.php` to use DB content instead of static placeholders, preserving section IDs (`#history`, `#leadership`, etc.).

5) **Menus/Anchors**

- Extend the About dropdown in `resources/views/college/layouts/app.blade.php` with links to section anchors: `About (History)`, `Mission & Vision`, `Core Values`, `Leadership/Team`.

## Files to Change (Key)

- Controllers: `app/Http/Controllers/Admin/*` (new), `app/Http/Controllers/LandingPageController.php`
- Models: `app/Models/*` (new)
- Routes: `routes/web.php`
- Views: `resources/views/admin/about/*`, `resources/views/college/index.blade.php`, `resources/views/college/about.blade.php`, `resources/views/college/layouts/app.blade.php`, `resources/views/layouts/navigation.blade.php`
- Migrations: `database/migrations/*` (new)
- Seeder: `database/seeders/UserSeeder.php`

## Notes / Defaults

- “Admin & user tertentu” handled via `manage about` permission; admins can grant this permission to specific users using existing user management.
- Image uploads stored using the same `storage/` pattern as landing heroes.