<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Map extends Model
{
    use HasFactory;
    protected $fillable = [
        'images',
        'address',
        'drone_id',
    ];

    public static function store($request, $id = null){

        $maps = $request->only(['images', 'address','drone_id']);
        $maps = self::updateOrCreate(['id'=>$id],$maps);
        return $maps;
    }


    public function drone():BelongsTo
    {
        return $this->belongsTo(Drone::class);
    }

    public function farms():HasMany
    {
        return $this->hasMany(Farm::class);
    }

}
