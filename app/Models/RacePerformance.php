<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RacePerformance extends Model
{
    use HasFactory;
    protected $fillable = [
        'swimmer_id','race_type','stroke_id','placement','location','duration','distance_id','training_date','performance_score','gala_event_id'
    ];

    public function galaEvent(){
        return $this->belongsTo(GalaEvent::class);
    }
    public function swimmer(){
        return $this->belongsTo(Swimmer::class);
    }
    public function stroke(){
        return $this->belongsTo(Stroke::class,'stroke_id','id');
    }
    public function distance(){
        return $this->belongsTo(Distance::class,'distance_id','id');
    }
}
