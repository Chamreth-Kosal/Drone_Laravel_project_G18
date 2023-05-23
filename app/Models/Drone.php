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
        'type_of_drones',
        'model',
        'serial_number',
        'instructions',
        'price',
        'user_id'
    ];
    public static function store($request, $id = null)
    {
        $drone = $request->only(['type_of_drones', 'instructions', 'model', 'serial_number', 'price', 'user_id']);
        $drone = self::updateOrCreate(['id' => $id], $drone);

        return $drone;
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'drone_plans');
    }

}
