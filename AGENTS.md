# Saiwons Collection — Development Instructions

## 1. Purpose and current state

Act as a senior Laravel architect and full-stack engineer. Inspect the actual project before each task, protect existing behavior and data, and choose the simplest maintainable implementation that meets approved requirements. Be especially careful with inventory, checkout, payments, and database operations.

Saiwons Collection is a premium, online-only eCommerce platform for Nepal. It currently serves a branded introductory page; a complete storefront and eCommerce workflows have not been built.

As of TASK 005, the completed foundation includes:

- TASK 001: initial project audit and architecture review.
- TASK 002: local environment configuration and frontend dependency lockfile.
- TASK 003: Laravel Sail with a dedicated MySQL 8.4 service, isolated test database, and local phpMyAdmin.
- TASK 004: environment verification, the three default Laravel migrations, database isolation testing, and setup documentation.
- TASK 005: Tailwind 4 brand tokens, a reusable Blade storefront layout, header, navigation, footer, and a branded introductory page.

The current repository has Laravel 13, Sail PHP 8.5, MySQL 8.4, Blade, Tailwind CSS 4, Vite 8, PHPUnit, and Pint. Only Laravel's default users, cache, and jobs migrations exist and have run. There are no catalog, cart, order, payment, customer authentication, or admin features yet. The visible category and shopping-tool labels are marked as coming soon; do not treat them as working routes.

Before implementing a feature, confirm the installed versions, current files, configuration, and approved business behavior. Do not infer functionality from this document alone.

## 2. Business model and initial scope

Saiwons Collection is a **single-vendor, online-only** store. Saiwons Collection owns the catalog and centralized inventory. Customers purchase online; administrators manage online operations. Orders are fulfilled through delivery.

Initial product groups are fashion and clothing, accessories, electronics, and gadgets. The catalog must remain open to future categories. Clothing may need size, color, images, discounts, variant SKUs, prices, and stock. Electronics may need brand, model, specifications, warranty details, images, and variations where applicable. Confirm detailed rules before creating schema or workflows.

Do not build third-party seller registration, vendor dashboards, commissions, or marketplace logic for the initial release. Do not build POS, physical outlet or branch management, store locators, walk-in checkout, in-store pickup, or multi-location retail inventory. Do not assume a physical storefront exists. A stock storage location may be considered later if operations require it; it does not change the current centralized inventory model.

Build features incrementally. Do not generate the complete catalog, admin, and checkout system from conceptual lists in this document.

## 3. Stack and local development

Use the existing Laravel monolith and its installed dependencies. Backend: Laravel 13, PHP in Sail, MySQL 8.4, Eloquent, Laravel validation, sessions, queues when needed, and cache when justified. Frontend: Blade, Tailwind CSS 4, Vite 8, and reusable Blade components. Use Alpine.js for a justified lightweight interaction and Livewire only when server-driven interactivity has a clear benefit. Do not add another frontend framework or package without a technical reason.

The project uses its existing GitHub repository. Laravel Sail is the local development environment. The project-specific Compose stack in `compose.yaml` has three services:

| Service | Local binding | Purpose |
| --- | --- | --- |
| `laravel.test` | `127.0.0.1:8001` | Laravel app; Vite uses `127.0.0.1:5174` |
| `mysql` | `127.0.0.1:3307` | MySQL 8.4, with a persistent named volume |
| `phpmyadmin` | `127.0.0.1:8081` | Local database administration |

Inside Sail, use `DB_HOST=mysql` and `DB_PORT=3306`. The development database is `saiwons_collection`. Keep credentials in ignored local environment files, preserve the existing `APP_KEY`, and never print, log, or commit secrets. The Compose services use `restart: "no"` and localhost bindings. Do not change unrelated Docker projects or add services without a requirement.

Useful commands:

```bash
./vendor/bin/sail up -d
./vendor/bin/sail ps
./vendor/bin/sail artisan <command>
./vendor/bin/sail composer <command>
./vendor/bin/sail npm <command>
./vendor/bin/sail test
./vendor/bin/sail pint --test
./vendor/bin/sail logs
./vendor/bin/sail stop
```

Use Sail for project runtime commands when practical. Check port availability and existing services before Docker changes. Never remove another project's resources or delete this project's MySQL volume without explicit authorization; `docker compose down -v` is destructive.

## 4. Database design, isolation, and safety

Design a normalized MySQL schema with appropriate primary keys, foreign keys, indexes, constraints, and decimal money fields. Never store money as floating point. Avoid duplicate data unless there is a clear reason. Conceptual areas include users, roles, categories, brands, products, images, attributes, variants, centralized inventory, carts, addresses, orders, payments, shipping, and delivery. These are design considerations, not approval to create every table.

The development database is `saiwons_collection`. Automated database tests must use only `saiwons_collection_test` with its separate test credentials. `phpunit.xml` fixes the test connection, host, database name, and username; the ignored `.env.testing` supplies the test password. Verify this isolation before database-writing tests. Never point tests at the development database.

`database/docker/create-testing-database.sh` creates the test database and grants its test account access to that database. Docker MySQL initialization scripts run only when the data volume is empty. Preserve the named volume; do not delete or recreate it to rerun initialization.

Review a migration's effect and target database before running it. Require explicit authorization for destructive schema or data operations, including `migrate:fresh`, `migrate:refresh`, `db:wipe`, database deletion, volume deletion, and destructive manual SQL. Never delete production or development data without approval. Do not silently reset data to make a test pass.

## 5. Laravel architecture and future API reuse

Keep a clean Laravel monolith and follow standard directories. Do not introduce microservices or speculative layers.

- Controllers handle HTTP requests, coordinate validation and authorization, call application logic, and return responses. Keep complex business rules out of controllers.
- Eloquent models own relationships, casts, query scopes, and model-specific behavior. Avoid oversized models.
- Use Form Requests for complex validation and policies for resource authorization. Hiding a frontend button is never an authorization check.
- Add service classes when a workflow coordinates multiple components, such as checkout, orders, inventory, or payments. Do not create services for trivial CRUD.
- Wrap related critical writes in database transactions and preserve consistency when an operation fails.

A Flutter app may be introduced later. Keep catalog, price, inventory, checkout, payment, and order rules reusable outside Blade controllers. Do not build APIs before they are requested. When needed, use appropriate authentication, validation, policies, rate limits, API Resources, consistent errors, and versioned routes where useful. Do not expose internal database structures directly.

## 6. Catalog and centralized inventory

Use one unified product catalog for fashion and electronics; do not create separate product tables by category. Support flexible category-specific information without a needlessly complex attribute system. A purchasable variant may have its own SKU, price, attributes, images, and stock. Confirm product and variant rules before migrations.

Centralized inventory must have one reliable stock source of truth at the appropriate product or variant level. Prevent negative stock and overselling. Validate availability on the server before checkout, and use transactions with database locking or another concurrency-safe update strategy for stock changes. Never trust frontend stock values. Keep stock consistent across checkout failure, cancellation, and any approved restoration flow. Record inventory adjustments when the workflow requires an audit trail.

Add indexes for expected catalog and inventory queries. Avoid N+1 queries, paginate large lists, and load only needed columns.

## 7. Cart, checkout, delivery, and payment

The eventual cart should support product and variant selection, quantity changes, removal, prices, and subtotals. Guest carts are a decision to confirm before implementation. Validate requested products and variants and recalculate prices and totals on the server.

Checkout should collect approved customer and delivery details, show a server-calculated order summary and shipping charges, choose an approved payment method, and confirm the order. Do not trust frontend prices, totals, stock, or payment claims. Prevent duplicate checkout requests and payment confirmations. Use transactions for order creation, stock deduction, and related writes; handle failures without inconsistent inventory or orders.

Fulfillment is **delivery-based**. Orders need a delivery address and clear delivery or fulfillment status; provide order tracking/status management as requirements are defined. Keep **payment status separate from fulfillment status**: payment confirmation must not itself mark an order delivered, and delivery progress must not imply payment was received. Define status transitions and cancellation or refund behavior before implementation.

Cash on Delivery, eSewa, and Khalti are possible methods, not approved integrations. Do not integrate a gateway until requested. Verify gateway callbacks and transaction status server-side, store references securely, and never store sensitive card data or expose payment credentials.

## 8. Authentication, administration, and security

Use secure Laravel authentication and sessions for future customer accounts. Registration, login, password reset, and email verification should be scoped when requirements are approved. Separate customer and administrator permissions. Customers may access only their own account and orders; administrative actions need server-side authorization.

Build a custom admin interface incrementally for approved modules such as catalog, inventory, orders, customers, delivery, and reporting. Use readable tables, search/filtering where useful, accessible forms, validation feedback, empty states, and explicit confirmation for destructive actions. Avoid generic dashboard templates and complex permission packages without a demonstrated need.

Security rules apply everywhere:

- Validate external input and uploads; restrict file types and protect private files.
- Escape untrusted output, use Laravel CSRF protection, and use Eloquent or parameterized queries.
- Guard mass assignment, enforce authentication and authorization, and rate-limit sensitive actions where appropriate.
- Protect customer information; prevent unauthorized order access and duplicate payment processing.
- Keep passwords, API keys, and database credentials out of source files, logs, commits, and user-facing output.
- Never disable a security control simply to make a feature work.

## 9. Brand, storefront, and accessibility

Create a distinctive, premium, mobile-first storefront for Saiwons Collection. The approved brand colors are **Primary `#0077B6`** and **Secondary `#00B4D8`**. Supporting colors are white `#FFFFFF`, dark text `#17212B`, light background `#F8FAFC`, and border `#E5E7EB`. Use the Tailwind 4 tokens in `resources/css/app.css` consistently.

The official slogan is exactly: **"Simplicity is the best style and so it is our style."** The official logo asset is `public/images/saiwons-collection-logo.png`. Use that asset; do not invent a replacement, embed the slogan into it, or confuse its promotional tagline with the official slogan.

The shared storefront foundation lives in `resources/views/layouts/storefront.blade.php` and `resources/views/components/storefront/`. Extend these conventions when building approved pages. Use reusable components for repeated interface patterns without creating unused component libraries. Search, account, cart, and category destinations currently have no working pages; do not add fake links or imply they work.

Use clear hierarchy, readable type, restrained color and motion, good imagery, responsive spacing, and comfortable touch targets. Prevent horizontal overflow. Use semantic landmarks, labels, meaningful image alt text, visible keyboard focus, accessible validation errors, sufficient contrast, and reduced-motion support. Avoid generic Bootstrap-style storefronts or unnecessary JavaScript.

Expand the current introductory page into a complete homepage, then build category and product views, customer pages, and admin views incrementally as requirements are approved. Do not add product listings, newsletter behavior, or other features merely because they appear in a future design outline.

## 10. SEO and performance

Public pages should use semantic HTML, descriptive titles and meta descriptions, readable product and category slugs, image alt text, and canonical URLs where appropriate. Add structured data, XML sitemaps, robots directives, and social metadata when the relevant public pages exist. Avoid duplicate content.

Keep pages fast: optimize and size images, lazy-load noncritical media, avoid layout shifts, minimize JavaScript and dependencies, and build assets through Vite. On the backend, use eager loading, pagination, relevant indexes, and queues or caching only when they solve an identified need. Do not add premature caching complexity.

## 11. Testing and code quality

Use the existing PHPUnit setup and Laravel Pint. Add meaningful feature tests for important workflows and unit tests for isolated rules. Prioritize authentication, authorization, catalog variants, cart validation, inventory concurrency, checkout, order processing, payment verification, and delivery status as those features are built. Cover validation failures, unauthorized access, and important edge cases; avoid unnecessary mocking and tests that merely repeat the implementation.

Run relevant checks for the change: PHP syntax, Pint, PHPUnit, Blade compilation, Vite build, route checks, and Git diff review as applicable. Run database tests only against the isolated test database. Never claim a check passed unless it actually ran successfully. Report blocked, skipped, or incomplete verification precisely.

Follow Laravel and PSR conventions, clear naming, focused methods, dependency injection where useful, and consistent formatting. Avoid fat controllers, duplicated business logic, excessive helpers, unrelated refactors, and unnecessary packages.

## 12. Work process, Git safety, and future scope

For each task:

1. Read this file and inspect relevant code, configuration, tests, dependencies, and Git status.
2. For substantial work, explain the intended change and real risks; clarify essential unknowns while continuing safe independent work.
3. Make focused edits that preserve existing behavior and data. Do not invent business rules or implement unapproved future features.
4. Run applicable checks, review the diff, and verify the target database and environment before state-changing commands.
5. Report what changed, checks that ran, failures or limitations, and the next practical step in concise English.

Preserve existing uncommitted work. Keep the GitHub repository and working tree intact. Never commit or push unless explicitly requested; never force-push without approval. Do not commit `.env`, `.env.testing`, `vendor/`, `node_modules/`, or secrets. Do not modify unrelated application code, Docker projects, databases, or volumes.

Liquor sales, nighttime delivery, location-specific restrictions, age verification, and restricted-product rules are **outside the initial scope**. Do not implement them unless requested and applicable Nepalese law, licensing, age, and delivery requirements have been verified. Keep future expansion possible without designing the current store around hypothetical services.
