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

## 📘 API Documentation

This project uses **[Laravel Scribe](https://scribe.knuckles.wtf/)** to generate API documentation.

### Generate docs
```bash
php artisan scribe:generate
```
## 🐳 Running with Docker

This project supports running inside Docker for easier setup.

### Build the Docker image
```bash
docker build -t laravel-rest-api-app .

## Run the Container 

docker run -d -p 8000:8000 --name laravel-rest-api laravel-rest-api-app

```

## Access the application

API will be available at: http://localhost:8000

## Container management

# List running containers
docker ps

# Stop the container
docker stop laravel-rest-api

# Start the container again
docker start laravel-rest-api

# Remove container
docker rm laravel-rest-api

## Logs

docker logs -f laravel-rest-api

# 🤖 AI-Native Development

This repository demonstrates how AI can be integrated throughout the Software Development Lifecycle (SDLC).

## AI Development Stack

- Custom PHP MCP Server
- Cursor AI Integration
- CodeRabbit AI Reviews
- GitHub Actions
- Laravel Pint
- Larastan
- PEST Testing

---

## Model Context Protocol (MCP)

The project includes a custom PHP implementation of an MCP (Model Context Protocol) server that enables AI assistants to interact directly with the Laravel application.

### Current MCP Tools

| Tool | Description |
|------|-------------|
| `laravel_routes` | Lists all Laravel routes |
| `artisan` | Executes allow-listed Laravel Artisan commands |
| `pest` | *(Coming Soon)* Execute the PEST test suite |
| `phpstan` | *(Coming Soon)* Static analysis |
| `pint` | *(Coming Soon)* Code formatting |
| `git` | *(Coming Soon)* Git operations |
| `database` | *(Coming Soon)* Database inspection |

---

### Cursor Integration

Create:

```text
.cursor/mcp.json
```

Example:

```json
{
  "mcpServers": {
    "laravel-mcp": {
      "command": "C:\\xampp\\php\\php.exe",
      "args": [
        "C:\\xampp\\htdocs\\Laravel-rest-api-with-pest-tests\\mcp\\server.php"
      ]
    }
  }
}
```

Restart Cursor after saving the configuration.

The AI assistant can then invoke the MCP tools directly.

Example prompts:

```
List all Laravel routes.
```

```
Run php artisan about.
```

```
Show the migration status.
```

---

### MCP Project Structure

```text
mcp/
├── bootstrap.php
├── server.php
├── composer.json
└── src/
    ├── Protocol/
    ├── Registry/
    ├── Server/
    └── Tools/
        ├── ToolInterface.php
        ├── RouteTool.php
        └── ArtisanTool.php
```

---

### Security

The MCP server exposes only approved tools.

Current protections:

- Allow-listed Artisan commands
- Read-only route inspection
- No destructive operations
- Tool registration through a central registry

Future enhancements:

- Authentication
- Authorization
- Audit logging
- Tool permissions

# 🤖 AI-Assisted Development Workflow

This project demonstrates an AI-assisted Software Development Lifecycle (SDLC) using modern development tools and GitHub automation.

## Local Development

### Pre-Commit Quality Checks

Every commit automatically executes:

- Laravel Pint (PSR-12 Code Formatting)
- Larastan (PHPStan Static Analysis)
- Pest Test Suite

If any check fails, the commit is rejected.

### Pre-Push Validation

Before code is pushed to GitHub:

- Pest tests are executed
- Push is blocked if tests fail

---

## Continuous Integration

GitHub Actions automatically validates every Pull Request.

### CI Pipeline

- Checkout Repository
- Setup PHP
- Install Composer Dependencies
- Validate composer.json
- Composer Security Audit
- Laravel Pint
- Larastan (PHPStan)
- Pest Tests

Only code that passes all quality gates should be merged.

---

## AI Code Review

This repository uses **CodeRabbit AI** for automated Pull Request reviews.

Features include:

- AI-generated Pull Request summaries
- Code quality recommendations
- Laravel best practice suggestions
- Security analysis
- Performance recommendations
- Architecture feedback

---

## AI Governance

The project includes an `AGENTS.md` file defining guidelines for AI-assisted development.

AI agents are instructed to:

- Follow PSR-12
- Follow Laravel best practices
- Apply SOLID principles
- Write Pest tests
- Review security concerns
- Avoid breaking existing functionality
- Work only within feature branches

---

## Quality Gates

The following automated checks are enforced:

- ✅ Laravel Pint
- ✅ Larastan (PHPStan)
- ✅ Pest Tests
- ✅ Composer Validation
- ✅ Composer Security Audit
- ✅ GitHub Actions CI
- ✅ CodeRabbit AI Review

---

## Development Workflow

```text
Developer
    │
Git Commit
    │
Pre-Commit Hook
    ├── Laravel Pint
    ├── Larastan
    └── Pest
    │
Git Push
    │
GitHub Actions CI
    ├── Composer Validate
    ├── Composer Audit
    ├── Laravel Pint
    ├── Larastan
    └── Pest
    │
Pull Request
    │
CodeRabbit AI Review
    │
Merge
```


## 📖 License

This project is open-sourced under the MIT license.


---


