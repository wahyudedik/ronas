I will implement the comprehensive News & Events system as requested. Here is the detailed plan:

## Phase 1: Database Architecture & Models
1.  **Create Category Tables**:
    -   Create `news_categories` table (`id`, `name`, `slug`, `description`).
    -   Create `event_categories` table (`id`, `name`, `slug`, `description`).
2.  **Refactor Existing Tables**:
    -   **News**: Modify to support `category_id`, `author_id`, `status` (draft/published), `meta_tags`.
    -   **Events**: Modify to support `category_id`, `start/end_date`, `start/end_time`, `venue`, `capacity`, `registration_deadline`.
3.  **New Tables**:
    -   **EventRegistrations**: Track user signups for events.
    -   **Media**: Simple table to manage uploaded files/images.
4.  **Models**: Update `News`, `Event` and create `NewsCategory`, `EventCategory`, `EventRegistration` with proper relationships and scopes.

## Phase 2: Seeders & Dummy Data
1.  **Category Seeders**: Create standard categories (e.g., "Company News", "Webinars").
2.  **Content Seeders**: Generate realistic dummy data for news and events.
3.  **User Roles Seeder**: Setup `Admin`, `Editor`, `User` roles using `spatie/laravel-permission`.

## Phase 3: Backend Logic (Admin)
1.  **Controllers**:
    -   Update `NewsController` and `EventController` to handle new fields and relations.
    -   Create `CategoryController` for managing categories.
    -   Create `EventRegistrationController` for managing attendees.
2.  **Features**:
    -   Image Upload handling.
    -   Rich Text editing support (backend logic).
    -   Filtering and Search logic.

## Phase 4: Frontend Implementation (Blade Views)
1.  **Public Listing Pages**:
    -   `News Listing`: Pagination, Category Filter, Search.
    -   `Event Listing`: Calendar/List view, Filter by status (Upcoming/Past).
2.  **Detail Pages**:
    -   Full article view with related news.
    -   Event details with Registration form.
3.  **Widgets**:
    -   Latest News & Upcoming Events sections for Landing Page.

## Phase 5: Routes & Permissions
1.  **Middleware**: Protect Admin routes with `role:admin|editor`.
2.  **Public Routes**: Open access for listings and details.
3.  **Registration**: Authenticated user flow for event registration.

I will start by creating the necessary migrations and models.
