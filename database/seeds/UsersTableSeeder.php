<?php

use Illuminate\Database\Seeder;

use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV')=='local'){
            // To not register every time when in dev:
            User::create(['name'=>'user', 'email'=>'user@user.user', 'password'=>Hash::make('user'), 'email_verified_at'=>Carbon::now()->format('Y-m-d H:i:s')]);
        }
        
        factory(App\User::class, 50)->create();
    }
}
