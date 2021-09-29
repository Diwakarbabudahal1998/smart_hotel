<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $fillable=['checked_in','checked_out','rate','extra','total_amount','status','payment_status','user_id','guest_id','room_id'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function room(){
        return $this->belongsToMany(Room::class);
    }

    public function guest(){
        return $this->belongsTo(Guest::class,'guest_id');
    }

    public function payments(){
        return $this->hasMany(BookingPayment::class);
    }
}
