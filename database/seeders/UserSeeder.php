<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Accounting;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role       = Role::where('name', 'superadmin')->first();
        $superadmin = User::create([
         'name'     => 'Super Admin',
         'hotel_name'=>'Test Hotel',
         'email'    => 'admin@admin.com',
         'password' => Hash::make('password'),
      
         'username' => 'SuperAdmin',
         'status'   => true,
        ]);
        $superadmin->roles()->attach($role);
        $accounting=Accounting::create([
            'user_id'=>$superadmin->id,
            'cash_in_hand'=>0,
            'cash_in_bank'=>0
        ]);
    }
}
