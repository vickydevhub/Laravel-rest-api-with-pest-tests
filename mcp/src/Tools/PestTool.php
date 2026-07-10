<?php

namespace MCP\Tools;

class PestTool implements ToolInterface
{
    public function name(): string
    {
        return 'pest';
    }

    public function description(): string
    {
        return 'Run the Laravel PEST test suite.';
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

        $command = sprintf(
            'php "%s" test 2>&1',
            $artisan
        );

        $output = shell_exec($command);

        return [
            'success' => $output !== null,
            'output' => trim((string) $output),
        ];
    }
}