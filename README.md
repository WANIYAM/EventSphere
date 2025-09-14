---
title: User Guide -- Laravel 12 + MySQL Project
---

# 1. Introduction

This application is built using Laravel 12 (PHP Framework) with MySQL as
the database. It is designed to be secure, scalable, and user-friendly.

# 2. System Requirements

Ensure the following requirements are met before running the project:

-   Operating System: Windows 10/11, Linux, or macOS

-   PHP 8.2 or higher

-   Composer 2.6 or higher

-   MySQL 8.0 or higher

-   Node.js & NPM (latest stable version)

-   Web Server: Apache or Nginx

# 3. Installation Steps

1\. Setting up project:\
composer create-project laravel/laravel project-name\
cd project-name

2\. Install dependencies:\
composer install\
npm install && npm run build

3\. Copy the environment file:\
cp .env.example .env

4\. Update database settings in .env file.

5\. Generate application key:\
php artisan key:generate

6\. Run migrations and seeders:\
php artisan migrate \--seed

# 4. Running the Project

Start the development server using:\
php artisan serve\
\
Access the app at: http://127.0.0.1:8000

# 5. User Roles

-   Guest Users: Can register, log in, and view public pages.

-   Authenticated Users: Can access dashboard, profile, and perform
    limited actions.

-   Admin Users: Full access to manage users, roles, and settings.

# 6. Features

-   Secure Authentication (login, register, password reset)

-   User Profile Management

-   Role-Based Access Control (RBAC)

-   CRUD Operations (Create, Read, Update, Delete)

-   Search & Filter functionality

-   Responsive UI (mobile & desktop friendly)

# 7. Database

Default tables include: users, roles, permissions, password_resets, and
custom tables as per application requirements.

# 8. Deployment

For production:\
php artisan config:cache\
php artisan route:cache\
php artisan migrate \--force\
npm run build

# 9. Troubleshooting

-   If .env changes don't reflect: php artisan config:clear,
    cache:clear, route:clear

-   Database errors: Check database credentials in .env file

-   404 errors: Run php artisan route:list to verify routes

# 10. Credentials

-   **FOR ADMIN DASHBOARD**

```{=html}
<!-- -->
```
-   **Email** : <admin@gmail.com>

-   **Password:** password

```{=html}
<!-- -->
```
-   **FOR ORGANIZER DASHBOARD**

```{=html}
<!-- -->
```
-   **Email** : <organizer@gmail.com>

-   **Password:** password

```{=html}
<!-- -->
```
-   **FOR PARTICIPANT DASHBOARD**

```{=html}
<!-- -->
```
-   **Email :** <student@gmail.com>

-   **Password:** password
