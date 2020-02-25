<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = new Role();
        $roleAdmin->name = 'role_admin';
        $roleAdmin->description = 'An admin';
        $roleAdmin->save();

        $roleUser = new Role();
        $roleUser->name = 'role_user';
        $roleUser->description = 'Ordinary user';
        $roleUser->save();

        $roleDirector = new Role();
        $roleDirector->name = 'role_director';
        $roleDirector->description = 'A director';
        $roleDirector->save();
    }
}
