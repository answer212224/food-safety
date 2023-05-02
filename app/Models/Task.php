<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Task extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function restaurant(): BelongsTo
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function taskHasDefects()
    {
        return $this->hasMany(TaskHasDefect::class);
    }

    public function restaurantWorkSpaces(): HasManyThrough
    {
        return $this->hasManyThrough(RestaurantWorkspace::class, Restaurant::class);
    }
}
