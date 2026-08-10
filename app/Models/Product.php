<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['admin_id', 'name', 'category', 'description', 'price', 'stock', 'reorder_level', 'image'];
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
    public function isLowStock(): bool
{
    return $this->stock <= $this->reorder_level;
}
}

?>