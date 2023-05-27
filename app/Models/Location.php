<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Location extends Model
{
    use HasFactory;


    protected $fillable =[
        "latitude",
        "longitude",
        'drone_id',
    ];

    public static function store($request, $id = null){

        $locations = $request->only(["latitude","longitude","drone_id"]);
        $locations = self::updateOrCreate(['id'=>$id],$locations);
        
        return $locations;
    }

    public function drone():BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }

}
