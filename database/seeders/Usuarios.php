<?php


namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'name' => 'Administrator',
                'email' => 'admin@app.com',
                'password' => bcrypt('password'),
                'role' => 'ADMIN',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'user1',
                'email' => 'user_1@app.com',
                'password' => bcrypt('12345678'),
                'role' => 'USER',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'user2',
                'email' => 'user_2@app.com',
                'password' => bcrypt('12345678'),
                'role' => 'USER',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ]);
    }
}
