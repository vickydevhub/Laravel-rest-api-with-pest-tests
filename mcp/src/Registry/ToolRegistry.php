<?php

namespace MCP\Registry;

use MCP\Tools\ToolInterface;

class ToolRegistry
{
    /**
     * @var ToolInterface[]
     */
    private array $tools = [];

    public function register(ToolInterface $tool): void
    {
        $this->tools[$tool->name()] = $tool;
    }

    public function all(): array
    {
        return $this->tools;
    }

    public function get(string $name): ?ToolInterface
    {
        return $this->tools[$name] ?? null;
    }
}