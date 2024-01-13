<?php
    
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            [
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role_id' => 1
            ],
            [
                'name' => 'Penjual 1',
                'email' => 'penjual1@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role_id' => 2
            ],
            [
                'name' => 'Penjual 2',
                'email' => 'penjual2@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role_id' => 2
            ],
            [
                'name' => 'Pembeli',
                'email' => 'Pembeli@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role_id' => 3
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);
    }
}
