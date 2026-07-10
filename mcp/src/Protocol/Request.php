<?php

namespace MCP\Protocol;

class Request
{
    public function __construct(
        public readonly string $method,
        public readonly array $params = [],
        public readonly int|string|null $id = null,
    ) {
    }

    public static function fromArray(array $payload): self
    {
        return new self(
            method: $payload['method'] ?? '',
            params: $payload['params'] ?? [],
            id: $payload['id'] ?? null,
        );
    }
}