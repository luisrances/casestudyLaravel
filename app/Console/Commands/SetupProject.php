<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SetupProject extends Command
{
    protected $signature = 'setup:project';
    protected $description = 'Set up the project by creating the database and running migrations';

    public function handle()
    {
        $dbName = config('database.connections.mysql.database');
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        config(['database.connections.mysql.database' => null]);
        DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET $charset COLLATE $collation");

        config(['database.connections.mysql.database' => $dbName]);
        DB::reconnect();

        Artisan::call('migrate', ['--force' => true]);

        $this->info("Database '$dbName' created and migrated successfully.");
    }
}
