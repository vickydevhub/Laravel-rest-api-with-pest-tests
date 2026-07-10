<?php

namespace MCP\Transport;

class StdioTransport
{
    public function read(): ?array
    {
        $input = fgets(STDIN);

        if ($input === false) {
            exit(0);
        }

        $input = trim($input);

        if ($input === '') {
            return null;
        }

        $payload = json_decode($input, true);

        if (! is_array($payload)) {
            return null;
        }

        return $payload;
    }

    public function write(string $response): void
    {
        fwrite(STDOUT, $response."\n");
        fflush(STDOUT);
    }
}
