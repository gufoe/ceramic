<?php

namespace App;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    public $guarded = [];
    public $hidden = [
        'password',
    ];

    function projects() {
        return $this->hasMany(Project::class);
    }

    function sessions() {
        return $this->hasMany(Session::class);
    }

    function createSession() {
        return $this->sessions()->create([
            'token' => \Str::uuid(),
            'expires_at' => to_datetime('+1 week'),
        ]);
    }

    function setPasswordAttribute(string $pass) {
        $this->attributes['password'] = Hash::make($pass);
    }

    function hasPassword(string $pass) {
        return Hash::check($pass, $this->password);
    }
}
