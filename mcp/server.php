<?php

declare(strict_types=1);

ini_set('display_errors', 'stderr');
ini_set('log_errors', '1');
error_reporting(E_ALL);

while (ob_get_level() > 0) {
    ob_end_clean();
}

require __DIR__.'/vendor/autoload.php';

use MCP\Protocol\Request;
use MCP\Protocol\Response;
use MCP\Server\McpServer;
use MCP\Transport\StdioTransport;

$registry = require __DIR__.'/bootstrap.php';

$server = new McpServer($registry);
$transport = new StdioTransport();

try {
    while (true) {
        $payload = $transport->read();

        if ($payload === null) {
            continue;
        }

        $request = Request::fromArray($payload);

        if ($request->method === 'notifications/initialized') {
            continue;
        }

        if ($request->id === null) {
            continue;
        }

        switch ($request->method) {
            case 'initialize':
                $transport->write(
                    $server->initialize($request->id, $request->params)
                );
                break;

            case 'ping':
                $transport->write(
                    Response::success($request->id, new \stdClass())
                );
                break;

            case 'tools/list':
                $transport->write(
                    $server->listTools($request->id)
                );
                break;

            case 'tools/call':
                $transport->write(
                    $server->callTool(
                        $request->id,
                        $request->params['name'] ?? '',
                        $request->params['arguments'] ?? []
                    )
                );
                break;

            default:
                $transport->write(
                    Response::error(
                        $request->id,
                        -32601,
                        'Method not found: ' . $request->method
                    )
                );
        }
    }
} catch (\Throwable $exception) {
    fwrite(STDERR, '[Laravel MCP Server] ' . $exception->getMessage() . PHP_EOL);
    exit(1);
}
