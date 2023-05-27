<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Drone extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_id',
        'type_of_drones',
        'model',
        'battery',
        'payload',
        'serial_number',
        'instructions',
        'price',
        'user_id',
     
    ];
    public static function store($request, $id = null)
    {
        $drone = $request->only(['drone_id', 'type_of_drones', 'instructions', 'model', 'battery', 'payload', 'serial_number', 'price', 'user_id']);
        $drone = self::updateOrCreate(['id' => $id], $drone);

        return $drone;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'drone_plans');
    }

    public function maps():HasMany
    {
        return $this->hasMany(Map::class);
    }

    public function locations():HasMany
    {
        return $this->hasMany(Location::class);
    }
}
