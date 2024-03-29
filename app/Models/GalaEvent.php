<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalaEvent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'gala_date','distance_id','stroke_id','race_type','gender','location'
    ];

    public function racePerformance(){
        return $this->hasMany(RacePerformance::class,'gala_event_id','id');
    }

    public function stroke(){
        return $this->belongsTo(Stroke::class,'stroke_id','id');
    }
    public function distance(){
        return $this->belongsTo(Distance::class,'distance_id','id');
    }
}
