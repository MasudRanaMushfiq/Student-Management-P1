# Student Management System

> A full-featured student management web application built with **Laravel 13**, featuring role-based access control, a modular architecture, a RESTful API, and an admin dashboard.

[![PHP](https://img.shields.io/badge/PHP-8.3%2B-8892BF?logo=php)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?logo=laravel)](https://laravel.com)
[![License](https://img.shields.io/badge/license-MIT-green)](LICENSE)

---

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Project Structure](#project-structure)
- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Running the Application](#running-the-application)
- [Environment Variables](#environment-variables)
- [Database](#database)
- [API Reference](#api-reference)
- [Roles & Permissions](#roles--permissions)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)

---

## Overview

The **Student Management System** is a Laravel-based web application designed to streamline the administration of student records. It supports multiple user roles (Admin, Department Staff, Exam Staff), provides a full CRUD interface for student data, exposes a versioned REST API, and includes audit logging and PDF export capabilities.

---

## Features

- **Authentication** — Secure login and registration via Laravel Breeze (web) and Laravel Sanctum (API)
- **Role-Based Access Control** — Admin, Department, and Exam roles with granular permission management powered by Spatie Laravel Permission
- **Student CRUD** — Create, read, update, and delete student records with advanced search, bulk search, and filtering
- **Admin Dashboard** — User management, role assignment, audit log viewing
- **Department Portal** — Department-specific student listing, statistics, suggestions, and CSV/Excel export
- **Exam Portal** — Search and edit student records for examination purposes
- **REST API (v1)** — Full student resource API under `/api/v1/students` with Sanctum token authentication
- **PDF Export** — Generate student record PDFs using `barryvdh/laravel-dompdf`
- **Audit Logging** — Track key actions across the system
- **Modular Architecture** — Student module isolated under `Modules/Student` using `nwidart/laravel-modules`
- **Vite** — Modern frontend asset bundling

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13.x |
| Language | PHP 8.3+ |
| Authentication | Laravel Breeze, Laravel Sanctum 4.x |
| Authorization | Spatie Laravel Permission 7.x |
| Modules | nwidart/laravel-modules 13.x |
| PDF Generation | barryvdh/laravel-dompdf 3.x |
| Frontend | Blade Templates, Vite, CSS |
| Database | MySQL / SQLite |
| Testing | PHPUnit 12.x |
| Code Style | Laravel Pint |

---

## Project Structure

```
Student-Management-P1/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/
│   │       │   ├── DashboardController.php
│   │       │   └── UserManagementController.php
│   │       ├── AuthController.php          # API authentication
│   │       ├── WebAuthController.php       # Web authentication
│   │       ├── StudentController.php       # Core student CRUD + PDF
│   │       ├── DepartmentController.php    # Department portal
│   │       └── ExamController.php          # Exam portal
│   └── Models/
│       ├── User.php
│       ├── Student.php
│       ├── Department.php
│       ├── Hall.php
│       └── AuditLog.php
├── Modules/
│   └── Student/                            # Modular student resource
│       └── Http/Controllers/
│           └── StudentController.php       # Versioned API controller
├── database/
│   └── migrations/                         # 9 migration files
├── resources/
│   └── views/                              # Blade templates
├── routes/
│   ├── web.php
│   └── api.php
├── stubs/nwidart-stubs/                    # Module scaffolding stubs
└── tests/
```

---

## Getting Started

### Prerequisites

- PHP **8.3** or higher
- Composer
- Node.js & npm
- A database: **MySQL** (recommended) or SQLite

### Installation

1. **Clone the repository**

   ```bash
   git clone https://github.com/MasudRanaMushfiq/Student-Management-P1.git
   cd Student-Management-P1
   ```

2. **Run the automated setup script** (installs all dependencies, generates app key, and runs migrations):

   ```bash
   composer run setup
   ```

   Or run each step manually:

   ```bash
   composer install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   npm install
   npm run build
   ```

3. **Seed roles and permissions** *(if a seeder is available)*:

   ```bash
   php artisan db:seed
   ```

### Running the Application

Start all services concurrently (server, queue, log watcher, Vite dev server):

```bash
composer run dev
```

Or start just the Laravel development server:

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

---

## Environment Variables

Copy `.env.example` to `.env` and configure the following key values:

```env
APP_NAME="Student Management System"
APP_ENV=local
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=student_management
DB_USERNAME=root
DB_PASSWORD=

SANCTUM_STATEFUL_DOMAINS=localhost
```

---

## Database

Migrations create the following tables:

| Migration | Table |
|---|---|
| `create_users_table` | `users` |
| `create_cache_table` | `cache` |
| `create_jobs_table` | `jobs` |
| `create_personal_access_tokens_table` | `personal_access_tokens` |
| `create_departments_table` | `departments` |
| `create_halls_table` | `halls` |
| `create_students_table` | `students` |
| `create_permission_tables` | `roles`, `permissions`, `model_has_roles`, ... |
| `create_audit_logs_table` | `audit_logs` |

Run migrations:

```bash
php artisan migrate
```

---

## API Reference

### Authentication (Sanctum)

| Method | Endpoint | Description |
|---|---|---|
| `POST` | `/api/register` | Register a new user |
| `POST` | `/api/login` | Login and receive API token |
| `POST` | `/api/logout` | Revoke token |
| `GET` | `/api/user` | Get authenticated user |

### Student Resource (v1)

Base URL: `/api/v1/students`

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/api/v1/students` | List all students |
| `POST` | `/api/v1/students` | Create a new student |
| `GET` | `/api/v1/students/{student}` | Get a single student |
| `PUT/PATCH` | `/api/v1/students/{student}` | Update a student |
| `DELETE` | `/api/v1/students/{student}` | Delete a student |

All API endpoints require a valid **Sanctum Bearer token** in the `Authorization` header:

```
Authorization: Bearer <your-token>
```

---

## Roles & Permissions

The application uses [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission) for role-based access control.

| Role | Access |
|---|---|
| **Admin** | Full access — dashboard, user management, role assignment, audit logs, all students |
| **Department** | Department portal — student listing, search, statistics, export |
| **Exam** | Exam portal — student search, view, and record editing |

Roles are assigned via the admin panel at `POST /admin/users/{user}/role`.

---

## Testing

Run the full test suite:

```bash
composer run test
```

Or directly with PHPUnit:

```bash
php artisan test
```

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m 'Add some feature'`
4. Push to the branch: `git push origin feature/your-feature-name`
5. Open a Pull Request

Please make sure your code passes linting with Laravel Pint before submitting:

```bash
./vendor/bin/pint
```

---

## License

This project is open-source and available under the [MIT License](LICENSE).

---

> **Author:** [MasudRanaMushfiq](https://github.com/MasudRanaMushfiq)
>
> 
