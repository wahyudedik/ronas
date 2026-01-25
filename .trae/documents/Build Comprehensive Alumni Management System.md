I will build a comprehensive Alumni Management System as requested. This will be implemented as a new module within your existing Laravel application.

Here is the detailed implementation plan:

# Alumni Management System Implementation Plan

## 1. Database Structure & Models
I will create the following models and migrations strictly following your schema requirements, with minor Laravel-standard additions (like `slugs` for SEO):

*   **AlumniStory**
    *   `id`, `title`, `slug`, `content`, `alumni_name`, `graduation_year`, `featured_image`
    *   `status` (pending/approved/rejected), `user_id` (relation to user table)
*   **AlumniEvent**
    *   `id`, `event_name`, `slug`, `description`, `date` (datetime), `location`, `registration_link`, `featured_image`
*   **GetInvolvedOption**
    *   `id`, `title`, `description`, `type` (mentorship/volunteering/etc), `requirements`, `contact_info`
*   **DonationCampaign**
    *   `id`, `campaign_name`, `slug`, `description`, `target_amount`, `current_amount`, `deadline`, `payment_methods` (JSON)

## 2. Admin Backend (Dashboard)
I will add a new "Alumni Management" section to your existing Dashboard:

*   **Controllers**:
    *   `Admin\AlumniStoryController`: Approve/Reject stories, CRUD.
    *   `Admin\AlumniEventController`: Manage alumni-specific events.
    *   `Admin\GetInvolvedController`: Manage opportunities.
    *   `Admin\DonationController`: Manage campaigns and view donation progress.
*   **Views**:
    *   CRUD forms (Create, Edit, List) for all the above using your existing Admin UI components (`<x-app-layout>`, etc.).
*   **Permissions**:
    *   Add permissions: `manage alumni` to the existing role system.

## 3. Public Frontend (College Site)
I will overhaul the `/alumni` section:

*   **Alumni Landing Page (`/alumni`)**:
    *   **Success Stories Carousel**: Highlighting featured alumni.
    *   **Upcoming Events**: Calendar/List view.
    *   **Get Involved Grid**: Cards showing opportunities.
    *   **Donation Progress**: Visual bars for active campaigns.
*   **Sub-pages**:
    *   `/alumni/stories/{slug}`: Read full story.
    *   `/alumni/events/{slug}`: Event details & registration.
    *   `/alumni/donate/{slug}`: Donation form (with mock payment gateway integration).
    *   `/alumni/submit-story`: User form to submit their own success story (Auth required).

## 4. Seeders & Testing
*   **AlumniSeeder**: Will populate the database with the requested sample data (10 stories, 5 events, 3 options, 2 campaigns, 20 users).
*   **Feature Tests**: `AlumniTest.php` to verify public access, admin CRUD, and user submissions.

## 5. Technical Details
*   **Routing**: New routes in `web.php` under `college.` and `admin.` namespaces.
*   **Validation**: Form Requests for all inputs.
*   **File Upload**: Integration with the existing `public` disk storage.

I will begin by creating the Migrations and Models. Shall I proceed?