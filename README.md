# wordpress-plugin-projects

This repository contains 13 different WordPress plugin projects. Each plugin was created to solve a specific problem while working on client projects. Below is a detailed explanation of each plugin, including the motivation, scenario, and the problems they address.

---

## 1. csv-data-uploader
**Scenario & Motivation:**
While working on a client project, there was a need to allow non-technical users to bulk import student data into a custom database table from CSV files, without giving them direct database access. This plugin was created to solve the problem of safe, user-friendly data import.

**Features:**
- Shortcode `[csv-data-uploader]` to display a frontend upload form.
- On activation, creates a `students_data` table.
- Handles AJAX file uploads and inserts each row into the database.
- Supports fields: name, email, age, phone, photo.

---

## 2. custom-woocommerce-product
**Scenario & Motivation:**
Managing WooCommerce products can be overwhelming for store managers, especially when they need a simplified interface or want to restrict access to only certain product fields. This plugin was built to provide a custom admin form for product creation, streamlining the process and reducing errors.

**Features:**
- Adds a menu in the WordPress admin for product creation.
- Custom form for product details (name, price, SKU, image, etc.).
- Uses WooCommerce APIs to create products programmatically.
- Requires WooCommerce to be installed and active.

---

## 3. custom-wordpress-shortcode
**Scenario & Motivation:**
Shortcodes are a powerful way to add dynamic content to WordPress. This plugin was created as a boilerplate to quickly scaffold new plugins that need custom shortcodes, dynamic tables, and admin menus. It solves the problem of repetitive setup for new projects.

**Features:**
- On activation, creates a custom `books` table.
- Adds admin and public hooks for styles/scripts.
- Provides a sample shortcode `[cws-display-message]`.
- Demonstrates plugin internationalization and admin notices.

---

## 4. hello-world-plugin
**Scenario & Motivation:**
Every developer needs a starting point. This plugin was created as a first step into WordPress plugin development, focusing on basic admin notices and dashboard widgets. It solves the problem of understanding the plugin structure and WordPress hooks.

**Features:**
- Shows different types of admin notices (success, error, info, warning).
- Adds a custom widget to the WordPress admin dashboard.

---

## 5. my-custom-widget
**Scenario & Motivation:**
Clients often request custom widgets for their sidebars, such as displaying recent posts or a static message. This plugin was built to provide a flexible widget with configurable options, solving the problem of hardcoded sidebar content.

**Features:**
- Widget options for title, display type (recent posts or static message), number of posts, and custom message.
- Admin panel scripts and styles for widget configuration.
- Frontend display adapts based on widget settings.

---

## 6. my-metabox-plugin
**Scenario & Motivation:**
SEO is crucial for page ranking, and clients wanted an easy way to add meta titles and descriptions to individual pages. This plugin was created to add a custom metabox for SEO fields, solving the problem of missing or inconsistent meta tags.

**Features:**
- Adds a "My Custom Metabox - SEO" to the page editor.
- Saves meta title and description as post meta.
- Outputs meta tags in the page `<head>` for SEO.

---

## 7. shortcode-plugin
**Scenario & Motivation:**
Shortcodes are often requested for embedding dynamic content. This plugin was created to demonstrate the basics of shortcode development, including parameter handling and database queries, solving the problem of repetitive shortcode logic.

**Features:**
- `[message]` shortcode: displays a styled static message.
- `[student name="..." email="..."]` shortcode: displays student info.
- `[list-posts]` and `[list-posts number="10"]` shortcodes: list recent posts using direct DB queries or WP_Query.

---

## 8. table-data-csv-backup
**Scenario & Motivation:**
Data backup is essential, especially for custom tables. This plugin was created to allow admins to export the `students_data` table to CSV, solving the problem of manual database exports and providing a user-friendly backup solution.

**Features:**
- Adds an admin menu for CSV export.
- Generates and downloads a CSV file of all student data.

---

## 9. woocommerce-product-importer
**Scenario & Motivation:**
Bulk product import is a common requirement for e-commerce sites. This plugin was built to allow admins to import WooCommerce products from a CSV file, solving the problem of manual product entry and reducing onboarding time for new stores.

**Features:**
- Admin menu for uploading a CSV file.
- Each row in the CSV creates a new WooCommerce product.
- Requires WooCommerce to be installed and active.

---

## 10. wp-crud-apis
**Scenario & Motivation:**
Modern applications often need to interact with WordPress via APIs. This plugin was created to expose REST API endpoints for CRUD operations on a custom `students_table`, solving the problem of integrating external systems or SPAs with WordPress data.

**Features:**
- On activation, creates a `students_table`.
- Provides REST endpoints for listing, creating, updating, and deleting students.
- Endpoints follow the `/students/v1/` namespace.

---

## 11. wp-crud-employees
**Scenario & Motivation:**
A client needed a full employee management system within WordPress, including frontend forms and AJAX operations. This plugin was created to provide a complete CRUD interface for employees, solving the problem of managing employee data without external tools.

**Features:**
- On activation, creates an `employees_table` and a WordPress page with a shortcode.
- Shortcode `[wp-employee-form]` renders the employee management UI.
- AJAX-powered add, edit, delete, and list operations.
- Supports employee profile images.

---

## 12. wp-login-customizer
**Scenario & Motivation:**
Branding the login page is a frequent client request. This plugin was created to allow easy customization of the WordPress login page's logo, text color, and background color, solving the problem of hardcoded or generic login screens.

**Features:**
- Adds a settings page under "Settings" for login page customization.
- Options to set login page logo URL, text color, and background color.
- Applies custom styles to the login page based on saved settings.

---

## 13. yoodule-stripe
**Scenario & Motivation:**
This was my first attempt at creating a WordPress Plugin back in 2022. It was for a job interview. I was tasked to:

1. Create a WordPress plugin called Yoodule Stripe.

2. Once installed, a WordPress admin menu called Yoodule Stripe would be inserted, when clicked redirects to a plugin page where the Stripe api credentials can be specified and saved to the database as a WordPress option.

3. Create a shortcode named [yoodule_stripe], this shortcode once inserted on any page should render a table using jQuery Datatables. The table in question will get data using jQuery.Datatables({ajax:...}), which would make an Ajax request fetching all the prices from Stripe and all pagination requests would be passed via Ajax to backend and rendered accordingly.

4. The plugin source code should be hosted on a public git repository and once installed, it should be easy to switch to a different stripe account by changing the api credentials in step 2.

**Features:**
- Adds a "Yoodule Stripe" admin menu for saving Stripe API credentials (secret and publishable keys).
- Credentials are stored securely as WordPress options and can be updated at any time to switch accounts.
- Shortcode `[yoodule_stripe]` renders a jQuery DataTable on any page, fetching Stripe prices via AJAX.
- DataTable supports server-side pagination, search, and is always up-to-date with Stripe.
- Uses the official Stripe PHP SDK for secure API communication.

---