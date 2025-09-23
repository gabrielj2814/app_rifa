<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InitDataDBCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:init-data-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inicializa los datos basicos en la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $this->info("Registrando Roles");
        Artisan::call("db:seed --class=RolesSeeder");

        $this->info("Registrando Usuario Root");
        Artisan::call("db:seed --class=UserRootSeeder");
    }
}
