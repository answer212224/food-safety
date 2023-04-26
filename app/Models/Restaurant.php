<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'shop',
        'address',
        'location',
    ];

    public function restaurant_workspaces()
    {
        return $this->hasMany(RestaurantWorkspace::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
