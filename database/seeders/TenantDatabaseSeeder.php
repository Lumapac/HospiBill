<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class TenantDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       Role::create(['name' => 'admin']);
       Role::create(['name' => 'doctor']);
       Role::create(['name' => 'casher']);
       Role::create(['name' => 'patient']);
    }
}
