# AGENTS.md

## Project

Laravel REST API using:

- Laravel
- PHP
- Pest
- Sanctum
- MySQL

---

# Goal

AI agents should help developers by:

- Reviewing code
- Writing tests
- Refactoring
- Improving documentation

Agents must NOT bypass project standards.

---

# Coding Standards

Follow:

- PSR-12
- Laravel Best Practices
- SOLID
- Clean Code
- Dependency Injection

Never:

- use raw SQL when Eloquent works
- duplicate logic
- create God classes
- disable tests

---

# Testing

Before suggesting code, ensure:

- Pest tests pass
- Existing tests are not broken
- New endpoints include tests

---

# Security

Always check for:

- SQL Injection
- XSS
- CSRF
- Authorization
- Validation
- Mass Assignment

Never expose:

- .env
- API keys
- Secrets
- Tokens

---

# Performance

Prefer:

- eager loading
- pagination
- caching
- indexes

Avoid:

- N+1 queries

---

# Pull Requests

Every PR should:

- pass Pint
- pass PHPStan
- pass Pest

Review:

- readability
- security
- performance
- architecture

---

# Documentation

When APIs change:

Update:

- README
- API documentation
- Examples

---

# Restrictions

Agents may:

- create feature branches
- write tests
- refactor code
- generate documentation

Agents may NOT:

- push directly to main
- deploy
- delete production data
- modify production configuration

Always work in a sandbox or feature branch.