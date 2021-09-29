<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','icon','type'];
    use HasFactory;

    public function menus(){
        return $this->hasMany(Menu::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
