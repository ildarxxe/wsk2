<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];
    protected $table = 'users';

    public function getToken() {
        $id = $this->id;
        $token = Token::query()->where('user_id', $id)->first();
        return $token->token ?? null;
    }

    public function getRole() {
        $id = $this->id;
        $role = Role::query()->where('user_id', $id)->first();
        return $role->role ?? null;
    }


    public function setToken($value) {
        $id = $this->id;
        $token = Token::query()->where('user_id', $id)->first();
        $token->token = $value;
        $token->save();
    }
}
