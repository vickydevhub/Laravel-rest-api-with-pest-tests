<?php

namespace App\DTOs\Task;

class CreateTaskDTO
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $description,
        public readonly string $status,
        public readonly int $projectId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name'],
            description: $data['description'] ?? null,
            status: $data['status'],
            projectId: $data['project_id'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'project_id' => $this->projectId,
        ];
    }
}
