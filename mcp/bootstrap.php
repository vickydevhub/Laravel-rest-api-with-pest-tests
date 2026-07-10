<?php

require __DIR__.'/vendor/autoload.php';

use MCP\Registry\ToolRegistry;
use MCP\Tools\ArtisanTool;
use MCP\Tools\PestTool;
use MCP\Tools\RouteTool;

$registry = new ToolRegistry;

$registry->register(new RouteTool);
$registry->register(new ArtisanTool);
$registry->register(new PestTool);

return $registry;
