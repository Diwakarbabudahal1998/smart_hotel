<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;
    protected $fillable=['name','age','gender','phone_no','email','address','country','booking_type',];

    public function user(){
       return $this->belongsTo(User::class,'user_id');
    }
}
