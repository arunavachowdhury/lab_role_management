<?php

use Illuminate\Database\Seeder;
use App\Sample;
use App\TestItem;
use App\UOM;
use App\User;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        // Sample::truncate();
        // TestItem::truncate();
        // UOM::truncate();
        Role::truncate();
        User::truncate();

        // factory(Role::class, 4)->create();
        Role::create([
            'name'=> 'Director',
            'description'=> 'Director type'
        ]);

        Role::create([
            'name'=> 'Admin',
            'description'=> 'Admin type'
        ]);
        Role::create([
            'name'=> 'Employee',
            'description'=> 'Employee type'
        ]);
        Role::create([
            'name'=> 'Technician',
            'description'=> 'Technician type'
        ]);
        
        factory(User::class, 20)->create()->each(
            function ($user){
                $roles = \App\Role::all()->random(mt_rand(1, 2))->pluck('id');
                $user->roles()->attach($roles);
            }
        );
    }
}
