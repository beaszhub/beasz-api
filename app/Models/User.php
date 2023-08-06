<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

use App\Traits\HasUuid;
use App\Enums\Gender;
use App\Enums\Status;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;
    use HasUuid;

    protected $fillable = [
        'name', 
        'id_no',
        'passport_no',
        'email',
        'email_verified_at',
        'phone',
        'phone_verified_at',
        'dob',
        'gender',
        'status',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function gender()
    {
        return Gender::getKey($this->gender);
    }

    public function status()
    {
        return Status::getKey($this->status);
    }

}
