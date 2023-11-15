<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UsersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        $user = User::create([
            'email' => 'dnd@yopmail.com',
            'password' => Hash::make('1234567890'),
            'name' => 'DnD Admin',
            'kvk_number' => '12346543',
            'verification_code' => '36432'
        ]);
        $user->roles()->attach(Role::where('slug', 'admin')->first());
    }
}
