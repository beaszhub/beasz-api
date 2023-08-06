<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Enums\RoleType;
use App\Models\Role;
use App\Enums\Status;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'type' =>  RoleType::developer,
                'description' => 'Role for system engineer, use for system development, all access.',
                'status' =>  Status::active,
            ],
            [
                'type' => RoleType::admin,
                'description' => 'Role for person-in-charge (PIC), use for staff or product owner to administer the system.',
                'status' =>  Status::active,
            ],
            [
                'type' => RoleType::merchant,
                'description' => 'Role for users who are business partners.',
                'status' =>  Status::active,
            ],
            [
                'type' => RoleType::customer,
                'description' => 'Role for users who use the system for purchase or rent, use for low level system access.',
                'status' =>  Status::active,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
