<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Faustino Vasquez',
            'email' => 'fvasquez@local.com',
            'password' => bcrypt('123456'),
            'department_id' => 1,
        ]);

        factory(User::class,20)->create();
    }
}
