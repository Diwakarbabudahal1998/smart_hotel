<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
 use HasFactory;
 protected $_fillable = [
  'order_id',
  'menu_id',
  'quantity',
  'status',
 ];
 public function orders()
 {
  return $this->belongsTo(Order::class, 'order_id');
 }
 public function menu()
 {
  return $this->belongsTo(Menu::class, 'menu_id');
 }
}