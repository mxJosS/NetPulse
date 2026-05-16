<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return ['email_verified_at' => 'datetime', 'password' => 'hashed'];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isEngineer(): bool
    {
        return $this->role === 'engineer';
    }

    public function workOrders()
    {
        return $this->hasMany(WorkOrder::class);
    }

    public function initials(): string
    {
        return collect(explode(' ', $this->name))
            ->map(fn ($name) => mb_substr($name, 0, 1))
            ->map(fn ($name) => mb_strtoupper($name))
            ->take(2)
            ->join('');
    }
}
