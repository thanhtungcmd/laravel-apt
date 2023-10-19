<?php

namespace Modules\DreamPaladin\Console;

use Illuminate\Console\Command;

class TestConsole extends Command
{

    protected $signature = 'dream:test';

    protected $description = 'Test dream';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        dd(123);
    }

}
