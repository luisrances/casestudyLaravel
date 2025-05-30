<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SetupProject extends Command
{
    protected $signature = 'setup:project';
    protected $description = 'Set up the project by creating the database and running migrations, seeders, and optimizations';

    public function handle()
    {
        $dbName = config('database.connections.mysql.database');
        $charset = config('database.connections.mysql.charset', 'utf8mb4');
        $collation = config('database.connections.mysql.collation', 'utf8mb4_unicode_ci');

        // Temporarily set database name to null to allow CREATE DATABASE
        config(['database.connections.mysql.database' => null]);
        DB::statement("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET $charset COLLATE $collation");

        // Restore database name and reconnect
        config(['database.connections.mysql.database' => $dbName]);
        DB::reconnect();

        // Run migrations
        Artisan::call('migrate', ['--force' => true]);
        $this->info("Database '$dbName' migrated successfully.");

        // Run seeders
        Artisan::call('db:seed', ['--force' => true]);
        $this->info("Database seeded successfully.");

        // Create storage symlink
        Artisan::call('storage:link');
        $this->info("Storage link created successfully.");

        // Optimize the application
        Artisan::call('optimize');
        $this->info("Application optimized successfully.");
    }
}
