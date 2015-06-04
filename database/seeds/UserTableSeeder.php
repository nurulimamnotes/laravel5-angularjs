<?php

use Illuminate\Database\Seeder;
use App\User;
use Entrust\Role;

class UserTableSeeder extends Seeder
{

  public function run()
  {
    //Create base user
    $user = User::create([
        'name' => 'Administrator',
        'email' => 'admin@bits.co.id',
        'password' => Hash::make('suck-IT26'),
    ]);
    
    $plain_user = User::create([
        'name' => 'Retno Intan Purnamasari',
        'email' => 'retno@bits.co.id',
        'password' => Hash::make('retno-77'),
    ]);
    
    
    //Create default roles and permissions
    $admin = new Role();
    $admin->name         = 'admin';
    $admin->display_name = 'Administrator';
    $admin->description  = 'Spesial';
    $admin->save();
    
    $plain = new Role();
    $plain->name         = 'petugas';
    $plain->display_name = 'Petugas';
    $plain->description  = 'Petugas / Panitia';
    $plain->save();

    // role attach alias
    $user->attachRole($admin); // parameter can be an Role object, array, or id
    $plain_user->attachRole($plain);
  }

}
