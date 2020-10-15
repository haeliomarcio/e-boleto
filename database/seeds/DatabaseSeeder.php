<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com.br',
            'password' => Hash::make('admin@123'),
            'type' => 'admin',
        ]);

        DB::table('users')->insert([
            'name' => 'Max',
            'email' => 'teste@teste.com.br',
            'password' => Hash::make('teste@123'),
            'type' => 'editor',
        ]);
    }
}
