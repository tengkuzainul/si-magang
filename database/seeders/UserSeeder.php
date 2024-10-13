<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'username' => '123456789',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Siswa',
                'email' => 'siswa@gmail.com',
                'username' => '14870099122211',
                'password' => Hash::make('siswa123'),
                'email_verified_at' => now()
            ],
            [
                'name' => 'Guru Pembimbing',
                'email' => 'guru@gmail.com',
                'username' => '198706170023399',
                'password' => Hash::make('guru123'),
                'email_verified_at' => now()
            ],
        ];

        foreach ($accounts as $acc) {
            $user = User::create($acc);

            if ($user->name == 'Administrator') {
                $user->syncRoles('super-admin');
            }
            if ($user->name == 'Siswa') {
                $user->syncRoles('siswa');
            }
            if ($user->name == 'Guru Pembimbing') {
                $user->syncRoles('guru-pembimbing');
            }
        }
    }
}
