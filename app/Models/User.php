<?php

namespace App\Models;

use App\Models\Customers;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $guarded = ['id'];

    protected $attributes = [
        'role' => 'pengunjung'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function programs()
    {
        return $this->belongsToMany(Program::class, 'donasi')->withPivot('jml_donasi', 'doa');
    }

    public function pencairan_danas()
    {
        return $this->hasMany(PencairanDana::class);
    }

    public function news()
    {
        return $this->hasMany(News::class);
    }
}
