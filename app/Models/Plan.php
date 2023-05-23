<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'area',
        'datetime',
        'duration',
        'status',
        'create_by_id',

    ];
    
    public static function store($request, $id = null)
    {
        $plan = $request->only(['name', 'area', 'datetime', 'duration', 'status', 'create_by_id']);
        $plan = self::updateOrCreate(['id' => $id], $plan);

        return $plan;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function drones()
    {
        $this->belongsToMany(Drone::class, 'drone_plans');
    }
}
