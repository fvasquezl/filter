<?php

use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class)->create([
           'code' =>'DG',
           'name' =>'Direccion General',
           'slug' =>'direccion-general',
           'level' =>1,
        ]);

        factory(Department::class,10)->create();
    }
}
