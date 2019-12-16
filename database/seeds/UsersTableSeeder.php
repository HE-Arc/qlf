<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User::create(['name'=>'user', 'email'=>'user@user.user', 'password'=>Hash::make('user')]);
        
        factory(App\User::class, 50)->create();
    }
}
