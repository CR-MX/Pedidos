<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class LlenaColonias extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'llena_colonias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Este comando llena la DB con los estados,localidades y colonias de Mexico';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        DB::unprepared(file_get_contents(__DIR__.'/mexico.sql'));
    }
}
