<?php

namespace MCP\Tools;

class ArtisanTool implements ToolInterface
{
    /**
     * Allowed Artisan commands.
     */
    private array $allowedCommands = [
        'about',
        'migrate:status',
        'route:list --json',
        'schedule:list',
    ];

    public function name(): string
    {
        return 'artisan';
    }

    public function description(): string
    {
        return 'Execute safe Laravel Artisan commands.';
    }

    public function inputSchema(): array
    {
        return [
            'type' => 'object',
            'properties' => [
                'command' => [
                    'type' => 'string',
                    'description' => 'Allowed commands: about, migrate:status, route:list --json, schedule:list',
                ],
            ],
            'required' => ['command'],
            'additionalProperties' => false,
        ];
    }

    public function execute(array $arguments = []): mixed
    {
        $command = $arguments['command'] ?? '';

        if (! in_array($command, $this->allowedCommands, true)) {
            return [
                'success' => false,
                'message' => 'Command is not allowed.',
            ];
        }

        $projectRoot = realpath(__DIR__.'/../../..');

        $artisan = $projectRoot.DIRECTORY_SEPARATOR.'artisan';

        $fullCommand = sprintf(
            'php "%s" %s 2>&1',
            $artisan,
            $command
        );

        $output = shell_exec($fullCommand);

        return [
            'success' => true,
            'command' => $command,
            'output' => trim($output),
        ];
    }
}
