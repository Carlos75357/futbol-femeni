<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'type',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isConvidat(): bool
    {
        return $this->role === 'convidat';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'administrador';
    }

    public function isArbitre(): bool
    {
        return $this->role === 'arbitre';
    }

    public function equip()
    {
        return $this->hasOne(Equip::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class );
    }

    public function arbitre()
    {
        return $this->belongsTo(User::class );
    }

    public function partits()
    {
        return $this->hasMany(Partit::class);
    }
}