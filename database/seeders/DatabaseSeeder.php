<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     RoleSeeder::class,
        //     UserSeeder::class,
        // ]);

        $accounts = [
            [
                'name' => 'Siswa 2',
                'email' => 'siswa2@gmail.com',
                'username' => '14870097211123',
                'password' => Hash::make('siswa123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Guru Pembimbing 2',
                'email' => 'guru2@gmail.com',
                'username' => '198706170023123',
                'password' => Hash::make('guru123'),
                'email_verified_at' => now()
            ],
        ];

        foreach ($accounts as $acc) {
            $user = User::create($acc);

            if ($user->name == 'Siswa 2') {
                $user->syncRoles('siswa');
            }
            if ($user->name == 'Guru Pembimbing 2') {
                $user->syncRoles('guru-pembimbing');
            }
        }
    }
}
