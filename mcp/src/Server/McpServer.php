<?php

namespace MCP\Server;

use MCP\Protocol\Response;
use MCP\Registry\ToolRegistry;

class McpServer
{
    private const SUPPORTED_PROTOCOL_VERSIONS = [
        '2025-03-26',
        '2024-11-05',
    ];

    public function __construct(
        private ToolRegistry $registry
    ) {}

    public function listTools(int|string|null $id): string
    {
        $tools = [];

        foreach ($this->registry->all() as $tool) {
            $tools[] = [
                'name' => $tool->name(),
                'description' => $tool->description(),
                'inputSchema' => $tool->inputSchema(),
            ];
        }

        return Response::success($id, [
            'tools' => $tools,
        ]);
    }

    public function initialize(int|string|null $id, array $params = []): string
    {
        $requestedVersion = $params['protocolVersion'] ?? self::SUPPORTED_PROTOCOL_VERSIONS[0];
        $protocolVersion = in_array($requestedVersion, self::SUPPORTED_PROTOCOL_VERSIONS, true)
            ? $requestedVersion
            : self::SUPPORTED_PROTOCOL_VERSIONS[0];

        return Response::success($id, [
            'protocolVersion' => $protocolVersion,
            'serverInfo' => [
                'name' => 'Laravel MCP Server',
                'version' => '1.0.0',
            ],
            'capabilities' => [
                'tools' => new \stdClass,
            ],
        ]);
    }

    public function callTool(
        int|string|null $id,
        string $toolName,
        array $arguments = []
    ): string {
        $tool = $this->registry->get($toolName);

        if (! $tool) {
            return Response::error(
                $id,
                -32601,
                'Tool not found.'
            );
        }

        $result = $tool->execute($arguments);

        return Response::success($id, $this->formatToolResult($result));
    }

    private function formatToolResult(mixed $result): array
    {
        if (! is_array($result)) {
            return [
                'content' => [
                    [
                        'type' => 'text',
                        'text' => (string) $result,
                    ],
                ],
            ];
        }

        $isError = ($result['success'] ?? true) === false;

        return [
            'content' => [
                [
                    'type' => 'text',
                    'text' => json_encode(
                        $result,
                        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
                    ),
                ],
            ],
            'isError' => $isError,
        ];
    }
}
