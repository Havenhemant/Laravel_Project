<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   
    protected $fillable = [
        'username',
        'email',
        'password',
        'role', 
    ];

   
    protected $hidden = [
        'password',
        'remember_token',
    ];

   
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

   
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
    public function orders()
{
    return $this->hasMany(Order::class, 'customer_id');
}
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}

?>