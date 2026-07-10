<?php

namespace MCP\Support;

class LaravelProject
{
    public function root(): string
    {
        return realpath(__DIR__.'/../../..');
    }

    public function artisan(): string
    {
        return $this->root().DIRECTORY_SEPARATOR.'artisan';
    }

    public function vendorBin(string $binary): string
    {
        return $this->root()
            .DIRECTORY_SEPARATOR
            .'vendor'
            .DIRECTORY_SEPARATOR
            .'bin'
            .DIRECTORY_SEPARATOR
            .$binary;
    }

    public function logFile(): string
    {
        return $this->root()
            .DIRECTORY_SEPARATOR
            .'storage'
            .DIRECTORY_SEPARATOR
            .'logs'
            .DIRECTORY_SEPARATOR
            .'laravel.log';
    }
}
