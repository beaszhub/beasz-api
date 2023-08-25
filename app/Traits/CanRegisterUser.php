<?php

namespace App\Traits;

use App\Enums\Status;
use App\Enums\RoleType;
use App\Enums\RegisterType;
use App\Models\Role;
use App\Models\User;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait CanRegisterUser
{
    function registerUser(Request $request): User
    {
        $register_type = $request->input('register_type');

        if ($register_type == RegisterType::phone) {

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = Role::where('type', RoleType::customer)->first();

            $country = Country::where('name', 'Malaysia')->first();

            $user = User::create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'phone_verified_at' => Carbon::now(),
                'register_type' => RegisterType::phone,
                'status' => Status::active,
                'password' => Str::random(60),
                'role_id' => $role->id,
                'country_id' => $country->id
            ]);

            return $user;
        }
    }
}
