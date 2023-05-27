<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'user_id',
        'map_id',
    ];


    public static function store($request, $id = null){
        $farm = $request->only(['name', 'user_id','map_id']);
        $farm = self::updateOrCreate(['id'=>$id],$farm);
        return $farm;
    }

    public function map():BelongsTo
    {
        return $this->belongsTo(Map::class);
    }

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }

}
