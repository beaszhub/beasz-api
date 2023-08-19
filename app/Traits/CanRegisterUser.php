<?php

namespace App\Traits;

use App\Enums\Status;
use App\Enums\RoleType;
use App\Enums\RegisterType;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait CanRegisterUser
{
    function registerUser(Request $request): User
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $role = Role::where('type', RoleType::customer)->first();
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'phone_verified_at' => $request->input('register_type') == RegisterType::phone ? Carbon::now() : null,
            'status' => Status::active,
            'password' => Str::random(60),
            'role_id' => $role->id
        ]);

        return $user;
    }
}