<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swimmer extends Model
{
    protected $fillable = ['user_id','gender','swimmer_type','swimmer_status','membership_id','squad_id'];
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function parent(){
        return $this->belongsTo(User::class,'parent_id','id');
    }
    public function squad(){
        return $this->belongsTo(Squad::class,'squad_id','id');
    }
}
