# Laravel REST API with PEST Tests

![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?style=flat&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.0+-777BB4?style=flat&logo=php&logoColor=white)
![Sanctum](https://img.shields.io/badge/Auth-Sanctum-6DB33F?style=flat&logo=laravel&logoColor=white)
![PEST](https://img.shields.io/badge/Tests-PEST-1D1D1D?style=flat&logo=php&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-blue?style=flat)


A simple **Laravel 9 REST API** project that demonstrates building APIs with authentication, CRUD operations, and testing using **PEST**.

---

## 🚀 Features

- Built with **Laravel 9** (supports PHP 8.0+).
- Authentication using **Laravel Sanctum**.
- RESTful APIs for managing **Projects** and **Tasks**.
- Unit and Feature testing with **PEST**.
- User-to-task assignment.
- Enum-based task statuses (`pending`, `in_progress`, `completed`).

---

## ⚙️ Tech Stack

- **Backend**: Laravel 9, PHP 8.0+
- **Auth**: Laravel Sanctum
- **Database**: MySQL (or SQLite for testing)
- **Testing**: PEST, PHPUnit

---

## 📂 Installation

```bash
# Clone the repo
git clone https://github.com/vickydevhub/Laravel-rest-api-with-pest-tests.git
cd Laravel-rest-api-with-pest-tests

# Install dependencies
composer install

# Copy .env file
cp .env.example .env

# Generate app key
php artisan key:generate

# Run migrations
php artisan migrate
```
## 🔑 Authentication

This project uses Laravel Sanctum for API authentication.

## Register a user
POST /api/register

## Login to get a toke

POST /api/login

## Include the token in the Authorization header for protected routes:

Authorization: Bearer <token>

## 📌 API Endpoints

## Auth

| Method | Endpoint        | Description           |
| ------ | --------------- | --------------------- |
| POST   | `/api/register` | Register a new user   |
| POST   | `/api/login`    | Login and get a token |

## Projects

| Method | Endpoint             | Description       |
| ------ | -------------------- | ----------------- |
| GET    | `/api/projects`      | List all projects |
| POST   | `/api/projects`      | Create project    |
| PUT    | `/api/projects/{id}` | Update project    |
| DELETE | `/api/projects/{id}` | Delete project    |


## tasks

| Method | Endpoint                   | Description              |
| ------ | -------------------------- | ------------------------ |
| GET    | `/api/projects/{id}/tasks` | List tasks for a project |
| POST   | `/api/projects/{id}/tasks` | Create task              |
| PUT    | `/api/tasks/{id}`          | Update task              |
| DELETE | `/api/tasks/{id}`          | Delete task              |
| POST   | `/api/tasks/{id}/assign`   | Assign task to a user    |

## 🧪 Running Tests

This project uses PEST for testing.

# Run all tests
php artisan test

# OR run directly with pest
./vendor/bin/pest

## 📖 License

This project is open-sourced under the MIT license.


---


