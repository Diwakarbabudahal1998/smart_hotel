<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
 use HasFactory;
 protected $_fillable = [
  'user_id',
  'addon_name',
  'addon_description',
  'addon_amount',
 ];
 public function user()
 {
  return $this->belongsTo(User::class, 'user_id');
 }
}