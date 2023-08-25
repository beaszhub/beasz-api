<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Enums\RoleType;
use App\Models\Role;
use Carbon\Carbon;
use App\Enums\Gender;
use App\Enums\Status;
use App\Enums\RegisterType;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Country;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('type', RoleType::admin)->first();

        $country = Country::where('name', 'Malaysia')->first();

        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@beasz.net',
                'email_verified_at' => Carbon::now(),
                'phone' => '+60123456788',
                'phone_verified_at' => Carbon::now(),
                'gender' => Gender::male,
                'register_type' => RegisterType::manual,
                'status' => Status::active,
                'password' => Hash::make('admin'),
                'role_id' => $admin->id,
                'country_id' => $country->id,
            ]
        ];

        foreach($users as $user) 
        {
            $newUser = User::create($user);

            $newUser->store()->create([
                'name' => $newUser->name,
            ]);
        }
    }
}
