<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squad extends Model
{
    use HasFactory;
    protected $table= 'squad';
    protected $fillable= ['squad_name','coach_id'];

    public function squadDetails(){
        return $this->hasMany(SquadDetails::class);
    }
    public function user(){
        return $this->belongsTo(User::class,'coach_id','id');
    }
}
