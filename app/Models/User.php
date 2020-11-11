<?php

namespace App\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password'
    ];

    protected $rules = array(
        'email' => 'required|string|email|unique:users',
        'password' => 'required|string|min:6'
    );

    public function validate($params)
    {
        $validator = Validator::make($params, $this->rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->messages();
        return false;
    }
}
