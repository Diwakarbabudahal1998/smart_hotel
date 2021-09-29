<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\Table;
use Illuminate\Http\Request;

class OrderController extends ApiBaseController
{
 // create order
 public function tableOrderstore(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   $table = Table::find($request->table_id);

   if (!isset($table)) {
    return $this->errorData("table does not exists");
   }
   $table->status = "reserved";
   $table->save();
   $oldorder = Order::where('table_id', $table->id)->where('status', '!=', 'complete')->where('type', 'table')->first();
   if (isset($oldorder->id)) {
    $oldorder->total_price = $request->total_price;
    $oldorder->user_id     = $user->id;
    $oldorder->table_id    = $request->table_id;
    if ($oldorder->save()) {
     foreach ($request->menus as $key => $reqmenu) {
      $menu = OrderMenu::where('order_id', $oldorder->id)->where('menu_id', $reqmenu["id"])->where('status', '!=', 'canceled')->where('addons', json_encode($reqmenu["addons"]))->first();
      if (!isset($menu->id)) {
       $newmenu           = new OrderMenu();
       $newmenu->user_id  = $user->id;
       $newmenu->order_id = $oldorder->id;
       $newmenu->menu_id  = $reqmenu["id"];
       $newmenu->quantity = $reqmenu["quantity"];
       $newmenu->status   = "pending";
       if (isset($reqmenu["note"])) {
        $newmenu->note = $reqmenu["note"];
       }
       if (isset($reqmenu["addons"])) {
        $newmenu->addons = json_encode($reqmenu["addons"]);
       }
       $newmenu->save();
      } else {
       if ($menu->status == 'pending') {
        $menu->quantity = $reqmenu['quantity'];
        $menu->save();
       } elseif ($menu->quantity == $reqmenu['quantity']) {
        $menu->quantity = $reqmenu['quantity'];
        $menu->save();
       } else {
        $menus_add           = new OrderMenu();
        $menus_add->user_id  = $user->id;
        $menus_add->order_id = $oldorder->id;
        $menus_add->menu_id  = $reqmenu["id"];
        $menus_add->quantity = $reqmenu["quantity"] - $menu->quantity;
        $menus_add->status   = "pending";
        if (isset($reqmenu["note"])) {
         $menus_add->note = $reqmenu["note"];
        }
        if (isset($reqmenu["addons"])) {
         $menus_add->addons = json_encode($reqmenu["addons"]);
        }
        $menus_add->save();
       }
      }
     }
    }
    $data = [
     "type"  => "updatetableorder",
     "order" => Order::where('id', $oldorder->id)->with('menus.menu')->first(),
    ];
    return $this->successResponse("success order updated");
   } else {
    $table->status = "reserved";
    $table->save();
    $order                 = new Order();
    $order->type           = "table";
    $order->status         = "pending";
    $order->total_discount = $request->total_discount;
    $order->total_tax      = $request->total_tax;
    $order->total_price    = $request->total_price;
    $order->user_id        = $user->id;
    $order->table_id       = $request->table_id;
    if (isset($request->menus)) {
     if ($order->save()) {
      foreach ($request->menus as $key => $reqmenu) {
       $menu           = new OrderMenu();
       $menu->user_id  = $user->id;
       $menu->order_id = $order->id;
       $menu->menu_id  = $reqmenu["id"];
       $menu->quantity = $reqmenu["quantity"];
       $menu->status   = "pending";
       if (isset($reqmenu["note"])) {
        $menu->note = $reqmenu["note"];
       }
       if (isset($reqmenu["addons"])) {
        $menu->addons = json_encode($reqmenu["addons"]);
       }
       $menu->save();
      }
     }
    }
    $table->save();
    $data = [
     "type"  => "newtableorder",
     "order" => Order::where('id', $order->id)->with('menus.menu')->first(),
    ];
    return $this->successResponse("successfully order created");
   }

  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Unable to order", $e);
  }
 }
 //hotel Guest Order
 public function guestOrder(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   //code...
   if (($request->room_id && $request->table_id)) {
    $table         = Table::find($request->table_id);
    $table->status = 'reserved';
    $table->save();
    $oldorder = Order::where('table_id', $table->id)->where('status', '!=', 'complete')->where('type', 'room')->first();
    if (isset($oldorder->id)) {
     $oldorder->total_price = $request->total_price;
     $oldorder->user_id     = $user->id;
     $oldorder->table_id    = $request->table_id;
     if ($oldorder->save()) {
      foreach ($request->menus as $key => $reqmenu) {
       $menu = OrderMenu::where('order_id', $oldorder->id)->where('menu_id', $reqmenu["id"])->where('status', '!=', 'canceled')->where('addons', json_encode($reqmenu["addons"]))->first();
       if (!isset($menu->id)) {
        $newmenu           = new OrderMenu();
        $newmenu->user_id  = $user->id;
        $newmenu->order_id = $oldorder->id;
        $newmenu->menu_id  = $reqmenu["id"];
        $newmenu->quantity = $reqmenu["quantity"];
        $newmenu->status   = "pending";
        if (isset($reqmenu["note"])) {
         $newmenu->note = $reqmenu["note"];
        }
        if (isset($reqmenu["addons"])) {
         $newmenu->addons = json_encode($reqmenu["addons"]);
        }
        $newmenu->save();
       } else {
        if ($menu->status == 'pending') {
         $menu->quantity = $reqmenu['quantity'];
         $menu->save();
        } elseif ($menu->quantity == $reqmenu['quantity']) {
         $menu->quantity = $reqmenu['quantity'];
         $menu->save();
        } else {
         $menus_add           = new OrderMenu();
         $menus_add->user_id  = $user->id;
         $menus_add->order_id = $oldorder->id;
         $menus_add->menu_id  = $reqmenu["id"];
         $menus_add->quantity = $reqmenu["quantity"] - $menu->quantity;
         $menus_add->status   = "pending";
         if (isset($reqmenu["note"])) {
          $menus_add->note = $reqmenu["note"];
         }
         if (isset($reqmenu["addons"])) {
          $menus_add->addons = json_encode($reqmenu["addons"]);
         }
         $menus_add->save();
        }
       }
      }
     }
     $data = [
      "type"  => "updateroomandtableorder",
      "order" => Order::where('id', $oldorder->id)->with('menus.menu')->first(),
     ];
     return $this->successResponse("success order updated");

    } else {
     $table->status = "reserved";
     $table->save();
     $order                 = new Order();
     $order->type           = "room";
     $order->status         = "pending";
     $order->total_discount = $request->total_discount;
     $order->total_tax      = $request->total_tax;
     $order->total_price    = $request->total_price;
     $order->user_id        = $user->id;
     $order->table_id       = $request->table_id;
     $order->room           = $request->room;
     if (isset($request->menus)) {
      if ($order->save()) {
       foreach ($request->menus as $key => $reqmenu) {
        $menu           = new OrderMenu();
        $menu->user_id  = $user->id;
        $menu->order_id = $order->id;
        $menu->menu_id  = $reqmenu["id"];
        $menu->quantity = $reqmenu["quantity"];
        $menu->status   = "pending";
        if (isset($reqmenu["note"])) {
         $menu->note = $reqmenu["note"];
        }
        if (isset($reqmenu["addons"])) {
         $menu->addons = json_encode($reqmenu["addons"]);
        }
        $menu->save();
       }
      }
     }
     $table->save();

     $data = [
      "type"  => "newroomandtableorder",
      "order" => Order::where('id', $order->id)->with('menus.menu')->first(),
     ];
     return $this->successResponse("successfully order created");
    }
   }
  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Unable to order", $e);
  }
 }
 // Complete  table order
 public function completeTableOrder(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   //code...
   $order         = Order::whereId($request->order_id)->where('user_id', $user->id)->where('type', 'table')->where('status', '!=', 'complete')->first();
   $order->status = "complete";
   $order->save();
   $table         = Table::find($order->table_id);
   $table->status = "empty";
   $table->save();
   $ordermenu = OrderMenu::where('user_id', $user->id)->where('order_id', $order->id)->get();
   foreach ($ordermenu as $key => $menu) {
    $menu->status = "complete";
    $menu->save();
   }
   return $this->successResponse('Order Completed Successfully');
  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Unable to Complete your Order.", $e);
  }
 }
 //complete room and table order
 public function completeRoomOrder(Request $request)
 {
  $user = auth()->guard('api')->user();
  try {
   //code...
   $order         = Order::whereId($request->order_id)->where('user_id', $user->id)->where('type', 'room')->where('status', '!=', 'complete')->first();
   $order->status = "complete";
   $order->save();
   $table         = Table::find($order->table_id);
   $table->status = "empty";
   $table->save();
   $ordermenu = OrderMenu::where('user_id', $user->id)->where('order_id', $order->id)->get();
   foreach ($ordermenu as $key => $menu) {
    $menu->status = "complete";
    $menu->save();
   }
   return $this->successResponse('Order Completed Successfully');

  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Unable to Complete your Order.", $e);
  }
 }
 //get table order
 public function getOrderByTable(Request $request)
 {
  try {
   //code...
   $table      = Table::find($request->table_id);
   $tableorder = Order::where('table_id', $request->table_id)->where('status', '!=', 'complete')->where('type', 'table')
    ->with('menus', function ($q) {
     $q->where('status', '!=', 'canceled');
     $q->with('menu');
    })->first();
   if (isset($tableorder)) {
    foreach ($tableorder->menus as $key => $menuwithaddon) {
     $menuwithaddon->decodeaddon = json_decode($menuwithaddon->addons, true);
    }
   }
   $data = ["table" => $table, "tableorder" => $tableorder];
   return $this->successData("success", $data);
  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Unable to Get your Order.", $e);
  }
 }
 //get Room order
 public function getOrderByRoom(Request $request)
 {
  try {
   //code...
   $table            = Table::find($request->table_id);
   $room_table_order = Order::where('table_id', $request->table_id)->where('status', '!=', 'complete')
    ->with('menus', function ($q) {
     $q->where('status', '!=', 'canceled');
     $q->with('menu');
    })->first();
   if (isset($room_table_order)) {
    foreach ($room_table_order->menus as $key => $menuwithaddon) {
     $menuwithaddon->decodeaddon = json_decode($menuwithaddon->addons, true);
    }
   }
   $data = ["table" => $table, "room_table_order" => $room_table_order];
   return $this->successData("success", $data);
  } catch (\Exception $e) {
   return $this->errorData("Internal Server Error! Unable to Get your Order.", $e);
  }
 }
}