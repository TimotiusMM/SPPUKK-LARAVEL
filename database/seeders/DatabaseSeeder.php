<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Role;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        Kelas::factory()->count(100)->create();

        User::create([
            'nama' => 'Marcelino Modo',
            'username' => 'Timo',
            'password' => Hash::make('admin'),
            'role' => Role::ADMIN,
        ]);
    }
}
