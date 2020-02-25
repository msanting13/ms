<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role_admin = Role::where('name','role_admin')->first();
        
        $user = new User();
        $user->name = 'Nemesio G. Loayon';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('password');
        $user->save();
        $user->roles()->attach($role_admin);
    }
}
