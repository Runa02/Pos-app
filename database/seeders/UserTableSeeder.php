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
                'role' => 'admin'
            ],
            [
                'name' => 'Penjual 1',
                'email' => 'penjual1@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role' => 'penjual'
            ],
            [
                'name' => 'Penjual 2',
                'email' => 'penjual2@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role' => 'penjual'
            ],
            [
                'name' => 'Pembeli',
                'email' => 'Pembeli@gmail.com',
                'password' => bcrypt('12345678'),
                'foto' => '/img/user.jpg',
                'role' => 'pembeli'
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
