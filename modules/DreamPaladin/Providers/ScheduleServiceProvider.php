<?php

namespace Modules\DreamPaladin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Modules\DreamPaladin\Console\TestConsole;

class ScheduleServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        $this->commands([
            TestConsole::class,
        ]);

        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command(TestConsole::class)->dailyAt('8:00');
        });
    }

    public function register()
    {
    }
}
