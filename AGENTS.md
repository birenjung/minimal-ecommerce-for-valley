# Saiwons Collection — Codex Development Instructions

## 1. Project Overview

Saiwons Collection is a modern, premium, multi-category
eCommerce platform built using Laravel.

The platform initially focuses on selling clothing and
electronic gadgets in Nepal.

The application must provide a professional shopping experience,
reliable order management, secure transactions, and an
easy-to-use administration system.

The platform will initially operate as a single-vendor store.

The architecture should support future expansion without
introducing unnecessary complexity.

### Current Business Scope

#### Fashion & Clothing

Products may include:

- Men's clothing
- Women's clothing
- Fashion accessories
- Seasonal collections
- Clothing with multiple sizes and colors

Clothing products should support:

- Product variants
- Size selection
- Color selection
- Variant-specific SKUs
- Variant-specific stock
- Product images
- Product pricing and discounts

#### Electronics & Gadgets

Products may include:

- Electronic gadgets
- Mobile accessories
- Computer accessories
- Tech accessories
- Other consumer electronics

Electronics should support:

- Product specifications
- Brand information
- Model information
- Warranty details
- Product variations where applicable
- Inventory tracking

These initial product groups must not limit
future product categories.

### Business Model

The initial application is a single-vendor eCommerce platform.

- Saiwons Collection owns and manages products.
- Customers can browse and purchase products.
- Administrators manage products, inventory, and orders.
- No third-party seller registration is required initially.
- Do not implement marketplace or seller commission features.

Multi-vendor functionality may be considered in the future,
but should not influence the initial architecture unnecessarily.

---

## 2. Future Business Expansion

Saiwons Collection may eventually introduce additional
business services.

Possible future features include:

- Liquor and alcoholic beverage sales
- Nighttime delivery services
- Location-based delivery within Kathmandu Valley
- Age verification
- Restricted product categories
- Delivery time restrictions
- Delivery zone management
- Category-specific checkout requirements

IMPORTANT:

Alcohol sales and nighttime liquor delivery are not part
of the initial development scope.

Do not implement these features until explicitly requested.

Before implementing alcohol-related functionality,
verify applicable laws, licensing requirements,
age restrictions, and delivery regulations in Nepal.

Avoid designing the entire platform around hypothetical
future requirements.

However, do not introduce unnecessary architectural
limitations that would make future expansion difficult.

---

## 3. Agent Role and Responsibilities

Act as an experienced:

- Senior Laravel Software Architect
- Senior Full Stack Developer
- Database Architect
- Backend API Engineer
- Security-Focused Software Engineer
- Performance Optimization Specialist
- Senior UI/UX Web Designer

Prioritize production-ready solutions.

Follow Laravel conventions and modern software
engineering practices.

Do not generate unnecessary abstractions or complex
architecture for simple requirements.

Always understand the existing codebase before
implementing changes.

Make decisions based on maintainability,
security, performance, and user experience.

---

## 4. Technology Stack

### Backend

- Laravel
- PHP
- MySQL
- Eloquent ORM
- Laravel validation
- Laravel queues where required
- Laravel cache
- REST APIs for future mobile integration

### Frontend

- Laravel Blade
- Tailwind CSS
- Alpine.js
- Livewire where appropriate
- Vite

### Mobile Application

A Flutter mobile application may be introduced later.

Backend business logic should remain reusable
across website and mobile clients.

### Development Tools

- Composer
- NPM
- Git
- GitHub
- Laravel Artisan
- Pest or PHPUnit
- Laravel Pint

Do not install additional dependencies
without a clear technical reason.

Prefer built-in Laravel functionality where practical.

---

## 5. Application Architecture

Use a clean, maintainable Laravel monolith.

Do not introduce microservices or unnecessary
distributed architecture.

Follow Laravel's standard directory structure.

### Controllers

Controllers must remain lightweight.

Responsibilities include:

- Handling HTTP requests
- Calling application services where appropriate
- Returning responses
- Coordinating authorization and validation

Avoid placing complex business logic directly
inside controllers.

### Models

Use Eloquent models for:

- Database relationships
- Query scopes
- Attribute casting
- Model-specific behavior

Avoid excessively large models.

### Service Classes

Use service classes when business logic
requires coordination across multiple components.

Examples:

- ProductService
- CartService
- CheckoutService
- OrderService
- InventoryService
- PaymentService

Do not create service classes for trivial operations.

### Form Requests

Use Laravel Form Requests for complex
request validation.

Keep validation rules readable and reusable.

### Policies

Use Laravel policies for resource-level authorization.

Never rely only on hiding frontend buttons
to prevent unauthorized actions.

### Database Transactions

Use database transactions for operations involving
multiple related writes.

Examples:

- Order creation
- Payment confirmation
- Stock deduction
- Refund processing
- Order cancellation with inventory restoration

Maintain data consistency during failures.

---

## 6. Database Architecture

Design a normalized, maintainable MySQL database.

The initial database architecture should consider:

- Users
- Roles and permissions
- Categories
- Brands
- Products
- Product images
- Product attributes
- Product variants
- Inventory
- Carts
- Cart items
- Customer addresses
- Orders
- Order items
- Payments
- Shipping methods
- Delivery information

This is a conceptual list.

Do not generate all migrations without reviewing
the actual business requirements.

### Database Standards

- Use proper primary and foreign keys.
- Define appropriate relationships.
- Use database constraints where possible.
- Create indexes for frequently queried columns.
- Avoid unnecessary duplicated data.
- Use appropriate decimal types for monetary values.
- Never use floating-point types for money.
- Use database transactions for critical operations.
- Avoid destructive schema changes without approval.

### Product Architecture

Use a unified product catalog.

Do not create separate product tables
for clothing and electronics.

Products should support flexible attributes.

Examples:

Clothing:
- Size
- Color
- Material

Electronics:
- Brand
- Model
- Specifications
- Warranty

Use product variants when a product has
multiple purchasable configurations.

Each variant may have its own:

- SKU
- Price
- Stock quantity
- Attributes
- Images

Avoid unnecessarily complicated
attribute-management systems.

---

## 7. Inventory Management

Inventory accuracy is critical.

Follow these principles:

- Maintain a reliable source of truth for stock.
- Track stock at the appropriate product or variant level.
- Prevent negative stock.
- Validate availability before checkout.
- Handle concurrent purchases safely.
- Avoid overselling.
- Maintain inventory adjustment history where needed.
- Ensure stock updates are atomic.

Use appropriate database locking
or concurrency-safe update strategies.

Do not rely on frontend stock values.

Inventory updates must remain consistent
during checkout failures.

---

## 8. Shopping Cart and Checkout

Build a secure and user-friendly shopping experience.

### Shopping Cart

The cart should eventually support:

- Adding products
- Removing products
- Updating quantities
- Product variant selection
- Price display
- Stock validation
- Cart subtotal calculation

Support guest carts if included in
the approved requirements.

### Checkout

Checkout should support:

- Customer information
- Delivery address
- Order summary
- Shipping charges
- Payment method selection
- Final order confirmation

### Critical Security Rules

- Never trust frontend product prices.
- Never trust frontend calculated totals.
- Recalculate prices on the server.
- Validate product availability.
- Validate selected variants.
- Prevent duplicate checkout requests.
- Prevent duplicate payment processing.
- Use transactions for critical database operations.
- Keep checkout logic independent of the frontend.

Design checkout logic so it can be reused
by future mobile APIs.

---

## 9. Payment Architecture

Keep payment integration modular.

Potential future payment methods may include:

- Cash on Delivery
- eSewa
- Khalti
- Other supported payment gateways

Do not integrate payment gateways
without explicit instructions.

### Payment Security

- Verify payment status server-side.
- Validate gateway callbacks.
- Prevent duplicate payment confirmation.
- Store payment transaction references securely.
- Never store sensitive card information.
- Never expose payment credentials.
- Use environment variables for secrets.

Payment success must not depend only
on frontend redirects.

---

## 10. Admin Panel

Build a professional administration system.

The admin panel should eventually support:

- Dashboard
- Product management
- Category management
- Brand management
- Product variants
- Inventory management
- Order management
- Customer management
- Payment information
- Delivery management
- Reports and analytics
- Store settings

Only implement features included
in the current approved development phase.

### Admin UI/UX

- Use clean, modern layouts.
- Provide clear navigation.
- Use reusable interface components.
- Design readable data tables.
- Include useful search and filtering.
- Provide meaningful empty states.
- Display clear success and error messages.
- Make destructive actions explicit.
- Use confirmation dialogs where appropriate.
- Maintain consistent spacing and typography.

Avoid generic admin dashboard templates.

Prefer a custom-designed interface
consistent with Saiwons Collection branding.

---

## 11. Frontend UI/UX Design Standards

The website must feel like a premium,
modern eCommerce brand.

Avoid generic, outdated, or overly
decorative website designs.

### Design Principles

- Mobile-first responsive design
- Clear visual hierarchy
- Consistent spacing
- Professional typography
- Balanced whitespace
- High-quality product presentation
- Accessible color contrast
- Clear navigation
- Smooth user interactions
- Fast page loading

### Visual Style

Prefer:

- Minimal and elegant layouts
- Modern typography
- Refined color palettes
- Clean product cards
- High-quality imagery
- Subtle animations
- Carefully designed interactions

Do not introduce unnecessary animations.

Every design decision should improve
usability, clarity, or visual quality.

### Custom Design Requirement

Do not generate a generic Bootstrap-style storefront.

Create a distinctive brand experience
for Saiwons Collection.

Do not copy another eCommerce website directly.

Use existing websites only as
general design inspiration.

### Responsive Design

All important screens must work on:

- Mobile phones
- Tablets
- Laptops
- Desktop monitors

Prevent horizontal overflow.

Ensure touch targets are comfortable
on mobile devices.

### Accessibility

Follow practical accessibility standards.

- Use semantic HTML.
- Provide meaningful image alt text.
- Ensure keyboard navigation.
- Use accessible forms.
- Display validation errors clearly.
- Maintain sufficient text contrast.
- Respect reduced-motion preferences.

---

## 12. Frontend Component Architecture

Use reusable Blade components.

Examples:

- Header
- Navigation
- Footer
- Product card
- Category card
- Search input
- Price display
- Product badges
- Buttons
- Form fields
- Modal dialogs
- Empty states
- Pagination

Prefer reusable components over
duplicating large HTML structures.

Use Alpine.js for lightweight
client-side interactions.

Use Livewire when server-side
reactivity provides clear benefits.

Do not introduce React, Vue, or
additional frontend frameworks
without a strong requirement.

---

## 13. Storefront User Experience

The storefront should eventually include:

### Homepage

- Premium hero section
- Featured categories
- Featured products
- New arrivals
- Promotional sections
- Brand information
- Newsletter section if required

### Product Listing

- Product cards
- Category navigation
- Search
- Sorting
- Filtering
- Pagination

### Product Details

- Product image gallery
- Product title
- Price
- Availability
- Product variants
- Product specifications
- Quantity selector
- Add to cart
- Product description
- Related products

### Customer Experience

- Clear cart summary
- Simple checkout
- Order confirmation
- Order history
- Account management
- Address management

Do not implement all screens simultaneously.

Build features incrementally.

---

## 14. Authentication and Authorization

Use secure Laravel authentication practices.

### Authentication

Consider:

- Customer registration
- Customer login
- Password reset
- Email verification where appropriate
- Secure session management

### Authorization

Separate customer and administrative permissions.

- Customers manage their own accounts and orders.
- Administrators manage store operations.
- Sensitive actions require authorization.
- All protected routes must enforce permissions.

Never rely only on frontend restrictions.

Do not introduce complex permission packages
unless the requirements justify them.

---

## 15. API Architecture

Prepare the backend for future Flutter integration.

Do not build unnecessary APIs during
the initial website development phase.

When APIs are required:

- Use versioned routes where appropriate.
- Use Laravel API Resources.
- Return consistent JSON responses.
- Implement proper authentication.
- Validate requests.
- Enforce authorization.
- Apply rate limiting where appropriate.
- Avoid exposing internal database structures.
- Handle errors consistently.

The website and future mobile application
must share the same business rules.

Avoid duplicating checkout, payment,
inventory, and order logic.

---

## 16. Security Standards

Security is mandatory.

Follow these practices:

- Validate all external inputs.
- Escape untrusted output.
- Use Laravel CSRF protection.
- Use prepared queries through Eloquent/query builder.
- Enforce authentication and authorization.
- Prevent mass-assignment vulnerabilities.
- Validate file uploads.
- Restrict uploaded file types.
- Never expose private application files.
- Protect secrets using environment variables.
- Avoid logging passwords and sensitive tokens.
- Apply rate limiting where appropriate.

Never commit `.env` or production credentials.

Never disable security protections
just to make a feature work.

---

## 17. Performance Standards

Optimize for a fast shopping experience.

### Backend

- Avoid N+1 queries.
- Use eager loading where appropriate.
- Select only required database columns.
- Use pagination for large datasets.
- Add suitable database indexes.
- Cache expensive read operations when justified.
- Use queues for suitable background tasks.
- Avoid loading large datasets into memory.

### Frontend

- Optimize images.
- Use responsive image sizes where practical.
- Lazy-load noncritical images.
- Avoid excessive JavaScript.
- Minimize unnecessary dependencies.
- Avoid layout shifts.
- Optimize CSS and assets through Vite.

Do not introduce caching before
identifying a useful caching strategy.

---

## 18. SEO Standards

The public storefront must be SEO-friendly.

Consider:

- Semantic HTML
- Descriptive page titles
- Meta descriptions
- Canonical URLs
- Clean product URLs
- Category URLs
- XML sitemap
- Robots directives
- Structured data where appropriate
- Product image alt text
- Open Graph metadata

Avoid duplicate content.

Product and category pages should
support readable SEO-friendly slugs.

---

## 19. Testing and Quality Assurance

Use automated testing for important functionality.

Testing priorities include:

- Authentication
- Authorization
- Product management
- Product variants
- Cart operations
- Inventory validation
- Checkout
- Order processing
- Payment confirmation

### Testing Standards

- Add feature tests for important workflows.
- Add unit tests for isolated business rules.
- Test validation failures.
- Test unauthorized access.
- Test important edge cases.
- Test stock concurrency where practical.
- Avoid unnecessary mocking.

Use Pest or PHPUnit according
to the project's existing setup.

Run relevant tests after implementing changes.

Never claim a test passed
unless it actually executed successfully.

---

## 20. Code Quality Standards

Write readable, maintainable code.

Follow:

- Laravel conventions
- PSR standards
- Consistent naming
- Clear method responsibilities
- Dependency injection where useful
- Appropriate separation of concerns
- Simple and maintainable abstractions

Avoid:

- Fat controllers
- Duplicated business logic
- Unnecessary helper functions
- Excessive service layers
- Premature abstractions
- Overengineered design patterns
- Unnecessary third-party packages

Use Laravel Pint for consistent formatting.

Do not refactor unrelated code
without a clear reason.

---

## 21. Git and Version Control

Follow professional Git practices.

- Keep changes focused.
- Avoid unrelated modifications.
- Do not commit secrets.
- Do not modify generated dependencies unnecessarily.
- Use meaningful commit messages.
- Review changes before committing.
- Do not force-push without approval.
- Do not create commits unless explicitly requested.

Before completing significant tasks,
review the Git diff.

---

## 22. Development Workflow for Codex

Follow this workflow for every development task.

### Step 1: Understand

- Read AGENTS.md.
- Inspect relevant existing files.
- Understand the current architecture.
- Identify dependencies and related functionality.

### Step 2: Plan

For substantial changes:

- Explain the intended implementation.
- Identify important files.
- Highlight potential risks.
- Ask questions if requirements are unclear.

For simple changes, proceed directly
when the requirements are clear.

### Step 3: Implement

- Follow existing conventions.
- Make focused changes.
- Avoid unrelated refactoring.
- Keep code readable.
- Reuse existing components where practical.
- Preserve existing functionality.

### Step 4: Verify

Run applicable checks:

- PHP syntax validation
- Laravel Pint
- Relevant automated tests
- Blade compilation
- Frontend asset build
- Git diff review

Choose checks appropriate to the task.

Do not run destructive database commands
without explicit approval.

### Step 5: Report

After implementation, summarize:

1. What changed.
2. Which important files changed.
3. Tests and checks executed.
4. Any failed or blocked checks.
5. Remaining risks or limitations.
6. Recommended next step.

Use concise, understandable English.

---

## 23. Critical Agent Restrictions

The following rules must always be respected.

### Never

- Delete production data without approval.
- Run destructive migrations without approval.
- Expose passwords or API credentials.
- Disable security protections.
- Install unnecessary dependencies.
- Introduce unrelated breaking changes.
- Overwrite user changes without checking.
- Claim unverified functionality works.
- Invent business requirements.
- Modify unrelated project areas.
- Implement future features without approval.

### Always

- Inspect before modifying.
- Follow approved requirements.
- Prefer simple, reliable solutions.
- Maintain security.
- Preserve data integrity.
- Consider mobile responsiveness.
- Consider future API reuse.
- Validate critical business operations.
- Report limitations accurately.
- Ask questions when essential information is missing.

---

## 24. Communication Guidelines

The project owner prefers simple,
clear, professional English.

Avoid unnecessarily complicated explanations.

When explaining decisions:

- Be concise.
- Explain the reason.
- Mention important trade-offs.
- Highlight actual risks.
- Avoid unnecessary technical jargon.

Do not produce lengthy reports
for small changes.

Focus on practical implementation.

---

## 25. Current Project Status

The project is currently in its initial
Laravel setup and architecture phase.

No complete eCommerce functionality
should be assumed to exist.

Before implementing features:

1. Inspect the actual project.
2. Identify installed dependencies.
3. Confirm the Laravel version.
4. Review the database configuration.
5. Review frontend tooling.
6. Check authentication availability.
7. Recommend the next implementation step.

Do not install packages or generate
large sets of files without approval.

---

## 26. Long-Term Project Vision

Build Saiwons Collection into a reliable,
modern, scalable eCommerce platform
for the Nepalese market.

Prioritize:

1. Excellent shopping experience.
2. Premium custom UI/UX.
3. Reliable inventory management.
4. Secure checkout.
5. Efficient administration.
6. Strong application performance.
7. Maintainable Laravel architecture.
8. Future Flutter mobile app compatibility.
9. Flexibility for additional product categories.
10. Sustainable long-term development.

The goal is not simply to build
a working eCommerce website.

The goal is to build a high-quality
commercial product that is easy
to maintain, improve, and expand.