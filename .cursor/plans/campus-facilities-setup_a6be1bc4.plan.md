---
name: campus-facilities-setup
overview: Add a full Campus Facilities setup with DB-backed categories, virtual tour, highlights carousel, and campus map. Provide admin CRUD for admin+user roles, expose the data on the campus facilities page and a new landing section, and include seed data.
todos: []
---

# Campus Facilities Setup Plan

## Scope

- Add new data models + migrations for Campus Facilities content (categories + items, virtual tour + features, highlights carousel, campus map settings + categories + actions).
- Add admin CRUD UI and routes protected by `manage facilities` permission (admin + user role).
- Render data on the public `campus-facilities` page and add a new landing section for highlights/link.
- Add seed data and wire into the existing seeder flow.

## Files to touch

- Data + models: `app/Models/*`, `database/migrations/*`
- Public controllers/views: `app/Http/Controllers/CollegeCampusFacilitiesController.php`, `resources/views/college/campus-facilities.blade.php`, `app/Http/Controllers/LandingPageController.php`, `resources/views/college/index.blade.php`
- Admin: `routes/web.php`, `resources/views/layouts/navigation.blade.php`, `resources/views/admin/facilities/*`, `app/Http/Controllers/Admin/*`
- Seeders: `database/seeders/CampusFacilitiesSeeder.php`, `database/seeders/UserSeeder.php`, `database/seeders/DatabaseSeeder.php`, `database/seeders/LandingPageSeeder.php`

## Steps

1. **Migrations + models**

- Create tables and models for:
- `CampusFacilityCategory` + `CampusFacilityItem` (category cards and bullet items).
- `CampusVirtualTour` + `CampusVirtualTourFeature` (tour section and feature list).
- `CampusHighlight` (carousel entries).
- `CampusMapSetting` + `CampusMapCategory` + `CampusMapAction` (map sidebar and actions).
- Add relationships (category -> items, tour -> features, etc.) and common fields (`sort_order`, `is_active`, `icon_class`, `image`, `url` where needed).

2. **Admin CRUD + permissions**

- Add `manage facilities` permission in `database/seeders/UserSeeder.php` and assign to admin+user.
- Add admin route group in `routes/web.php` (prefix `dashboard/facilities`, middleware `permission:manage facilities`).
- Implement controllers mirroring existing patterns (toggle + reorder for list types, single setting edit for `CampusVirtualTour` and `CampusMapSetting`).
- Add admin views under `resources/views/admin/facilities/` and add a new admin index card in the dashboard menu + nav link in `resources/views/layouts/navigation.blade.php`.

3. **Public rendering**

- Create `CollegeCampusFacilitiesController` to load active data and replace the current view route in `routes/web.php`.
- Convert `resources/views/college/campus-facilities.blade.php` to render categories, tour, highlights, and map from DB.
- Update `LandingPageController` + `resources/views/college/index.blade.php` to add a `campus_facilities` landing section (e.g., show top highlights/categories and link to the campus facilities page), controlled by `LandingSection`.

4. **Seed data**

- Add `CampusFacilitiesSeeder` with sample entries for each section.
- Update `DatabaseSeeder` to call it and `LandingPageSeeder` to add the new `campus_facilities` section entry.

## Implementation Todos

- **schema**: add migrations/models for facilities, tour, highlights, and map
- **admin**: add permission, routes, controllers, and admin views
- **public**: wire controllers + update campus facilities page and landing section
- **seed**: create seeder + register in DatabaseSeeder/LandingPageSeeder