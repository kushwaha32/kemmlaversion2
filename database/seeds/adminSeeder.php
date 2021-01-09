<?php

use Illuminate\Database\Seeder;
use App\Admin;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Admin::create([
            'name' => 'raj kushwaha',
            'email' => 'admin@admin.com',
            'password' => Hash::make('raj123')
         ]);
    }
}
