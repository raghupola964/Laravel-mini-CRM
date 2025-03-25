<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        \App\Models\Company::factory()->count(20)->create();
        \App\Models\Employee::factory()->count(20)->create();
    }
}


// C:\xampp\php\php artisan migrate:fresh --seed this wil drop all tables and re runs migrations