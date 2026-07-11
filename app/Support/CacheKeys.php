<?php

namespace App\Support;

class CacheKeys
{
    public const PROJECTS = 'projects.all';

    public const TASKS = 'tasks.all';

    public static function project(int $id): string
    {
        return "projects.{$id}";
    }

    public static function task(int $id): string
    {
        return "tasks.{$id}";
    }
}
