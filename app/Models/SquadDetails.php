<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadDetails extends Model
{
    use HasFactory;
    protected $table = 'squad_details';
    protected $fillable= ['swimmer_id','squad_id'];
    public function squad(){
        return $this->belongsTo(squad::class);
    }
    public function swimmers(){
        return $this->hasMany(Swimmer::class,'swimmer_id','id');
    }
}
