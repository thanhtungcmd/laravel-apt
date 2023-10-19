<?php

function module_path($path): string {
    return __DIR__.'/../'. $path;
}

function route_path(string $path): string {
    return base_path(). '/modules/'. $path;
}
