<?php

namespace MCP\Support;

class CommandRunner
{
    public function run(string $command): array
    {
        $output = shell_exec($command . ' 2>&1');

        return [
            'success' => $output !== null,
            'command' => $command,
            'output' => trim((string) $output),
        ];
    }
}