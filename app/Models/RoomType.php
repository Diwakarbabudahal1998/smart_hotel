<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable=['type_name'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
