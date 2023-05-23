<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DronePlan extends Model
{
    use HasFactory;
    protected $fillable = [
        'drone_id',
        'plan_id',
    ];

    public static function store($request, $id = null){
        $dronePlan = $request->only(['drone_id', 'plan_id',]);
        $dronePlan = self::updateOrCreate(['id' => $id], $dronePlan);

        return $dronePlan;
    }
}
