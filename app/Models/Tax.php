<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;
    protected $fillable=['tax_name','tax_percent','tax_status'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
