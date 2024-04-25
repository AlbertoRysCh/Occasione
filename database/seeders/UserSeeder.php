<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = Role::create(['name' => 'admin']);

        $user = User::create([
            'name' => 'Admin Occasione',
            'email' => 'admin.occasione@gmail.com',
            'password' => bcrypt('123456789')
        ])->assignRole('admin');

         $user->createAsStripeCustomer();
       // User::factory(100)->create();
    }
}
