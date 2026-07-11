# Laravel REST API with PEST Tests – AI-Native Enterprise Architecture

> An enterprise-ready Laravel 9 REST API demonstrating modern backend architecture, AI-assisted development, DTOs, Service Layer, Events, Queues, Audit Logs, Caching, automated testing, static analysis, and CI/CD.

## Features

### Core API
- Laravel 9 REST API
- Laravel Sanctum Authentication
- User Registration & Login
- Projects CRUD
- Tasks CRUD
- Search & Pagination
- PEST Tests

### Enterprise Architecture
- DTO (Data Transfer Objects)
- Service Layer
- Event-Driven Architecture
- Event Listeners
- Queued Listeners
- Audit Logs
- Response Caching
- Thin Controllers
- SOLID Principles

### AI-Native Development
- Custom PHP MCP Server
- Cursor AI
- CodeRabbit AI Reviews
- GitHub Actions
- Laravel Pint
- Larastan

## Architecture

```text
Request
   │
FormRequest
   │
DTO
   │
Controller
   │
Service
   ├──────────────┐
   │              │
 Model         Events
                  │
      ┌───────────┼────────────┐
      ▼           ▼            ▼
 Audit Logs   Queue       Cache
                  │
                  ▼
               Email
```

## Project Structure

```text
app/
├── DTOs/
│   ├── Auth/
│   ├── Project/
│   └── Task/
├── Events/
├── Listeners/
├── Mail/
├── Models/
├── Services/
│   ├── AuthService.php
│   ├── ProjectService.php
│   ├── TaskService.php
│   └── AuditLogService.php
└── Http/
    ├── Controllers/
    └── Requests/
```

## DTOs

DTOs isolate validated request data from business logic.

- RegisterDTO
- LoginDTO
- CreateProjectDTO
- UpdateProjectDTO
- CreateTaskDTO
- UpdateTaskDTO

Benefits:
- Type safety
- Cleaner controllers
- Easier testing
- Reusable business logic

## Service Layer

Controllers only orchestrate requests.

```text
Controller
   │
DTO
   │
Service
   │
Model
```

Business logic resides in:
- AuthService
- ProjectService
- TaskService

## Events

- ProjectCreated
- ProjectUpdated
- ProjectDeleted
- TaskCreated
- TaskUpdated
- TaskCompleted
- TaskDeleted

Flow:

```text
ProjectService
      │
ProjectCreated
      │
├── RecordAuditLog
├── SendProjectCreatedEmail
└── ClearCache
```

## Audit Logs

Every create/update/delete action is recorded.

Table:

- user_id
- event
- entity_type
- entity_id
- old_values
- new_values

## Queue

Configure:

```env
QUEUE_CONNECTION=database
```

Commands:

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

## Cache

Cached endpoints:

- GET /api/projects
- GET /api/projects/{id}
- GET /api/tasks
- GET /api/tasks/{id}

Cache is automatically invalidated using events/listeners.

## Testing

```bash
php artisan test

vendor/bin/pest
```

Uses SQLite for testing.

## Code Quality

```bash
vendor/bin/pint
vendor/bin/phpstan analyse
```

## Installation

```bash
git clone https://github.com/vickydevhub/Laravel-rest-api-with-pest-tests.git

cd Laravel-rest-api-with-pest-tests

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve
```

## AI Development Stack

- Cursor AI
- Custom PHP MCP Server
- CodeRabbit
- GitHub Actions
- Larastan
- Laravel Pint

## Enterprise Features

- ✅ DTO Pattern
- ✅ Service Layer
- ✅ Events
- ✅ Event Listeners
- ✅ Queue Processing
- ✅ Audit Logs
- ✅ Response Caching
- ✅ Search & Pagination
- ✅ Sanctum Authentication
- ✅ PEST Testing
- ✅ Larastan
- ✅ Laravel Pint
- ✅ GitHub Actions

## Roadmap

- Repository Pattern
- Notifications
- Policies
- API Resources
- OpenAPI / Swagger
- Redis
- Horizon
- Telescope
- Octane
- Multi-tenancy

## License

MIT
