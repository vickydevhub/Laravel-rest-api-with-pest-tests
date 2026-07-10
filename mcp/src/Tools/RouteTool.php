<?php

namespace MCP\Tools;

class RouteTool implements ToolInterface
{
    public function name(): string
    {
        return 'laravel_routes';
    }

    public function description(): string
    {
        return 'List all Laravel routes.';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => new \stdClass(),
            'additionalProperties' => false,
        ];
    }

    public function execute(array $arguments = []): mixed
    {
        $projectRoot = realpath(__DIR__ . '/../../..');

        $artisan = $projectRoot . DIRECTORY_SEPARATOR . 'artisan';

        if (! file_exists($artisan)) {
            return [
                'success' => false,
                'message' => 'Laravel artisan file not found.',
            ];
        }

        $command = sprintf(
            'php "%s" route:list --json 2>&1',
            $artisan
        );

        $output = shell_exec($command);

        if ($output === null) {
            return [
                'success' => false,
                'message' => 'Unable to execute artisan.',
            ];
        }

        $routes = json_decode($output, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'raw_output' => $output,
            ];
        }

        return [
            'success' => true,
            'count' => count($routes),
            'routes' => $routes,
        ];
    }
}