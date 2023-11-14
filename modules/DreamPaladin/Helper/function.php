<?php

function module_name(): string
{
    return "DreamPaladin";
}

function module_name_lower(): string
{
    return strtolower(module_name());
}

function module_name_upper(): string
{
    return strtoupper(module_name());
}

function module_namespace():string
{
    return "Modules\'". module_name() ."\Http\Controllers";
}

function module_path($path): string {
    return __DIR__.'/../'. $path;
}

function route_path(string $path): string {
    return base_path(). '/modules/'. $path;
}

