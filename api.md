# API Endpoints

## Authentication

### POST /register
- **Description**: Registers a new user.
- **Request Body**:
  - `name`: string
  - `email`: string
  - `password`: string
- **Response**: 201 Created

### POST /login
- **Description**: Logs in a user and returns a token.
- **Request Body**:
  - `email`: string
  - `password`: string
- **Response**: 200 OK

---

## Projects

### GET /projects
- **Description**: Lists all user projects.
- **Response**: 200 OK

### POST /projects
- **Description**: Creates a new project.
- **Request Body**:
  - `name`: string
  - `description`: string (optional)
- **Response**: 201 Created

### GET /projects/{id}
- **Description**: Retrieves details of a specific project.
- **Response**: 200 OK

### PUT /projects/{id}
- **Description**: Updates a specific project.
- **Request Body**:
  - `name`: string (optional)
  - `description`: string (optional)
- **Response**: 200 OK

### DELETE /projects/{id}
- **Description**: Deletes a specific project.
- **Response**: 204 No Content

---

## Tasks

### GET /projects/{project_id}/tasks
- **Description**: Lists all tasks for a specific project.
- **Response**: 200 OK

### POST /projects/{project_id}/tasks
- **Description**: Creates a new task in a project.
- **Request Body**:
  - `title`: string
  - `description`: string (optional)
  - `due_date`: date
  - `status`: string (e.g., "pending", "in-progress", "completed")
- **Response**: 201 Created

### GET /projects/{project_id}/tasks/{id}
- **Description**: Retrieves details of a specific task.
- **Response**: 200 OK

### PUT /projects/{project_id}/tasks/{id}
- **Description**: Updates a specific task.
- **Request Body**:
  - `title`: string (optional)
  - `description`: string (optional)
  - `due_date`: date (optional)
  - `status`: string (optional)
- **Response**: 200 OK

### DELETE /projects/{project_id}/tasks/{id}
- **Description**: Deletes a specific task.
- **Response**: 204 No Content

---

## Task Assignment

### POST /tasks/{task_id}/assign
- **Description**: Assigns a task to a user.
- **Request Body**:
  - `user_id`: integer
- **Response**: 200 OK

### DELETE /tasks/{task_id}/assign
- **Description**: Unassigns a task from a user.
- **Response**: 204 No Content