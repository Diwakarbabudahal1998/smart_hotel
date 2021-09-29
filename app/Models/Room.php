<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable=['name','type','rate'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function booking(){
        return $this->belongsToMany(Booking::class);
    }
}
