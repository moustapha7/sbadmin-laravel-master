<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'diedhiou',
            'email'=> 'tapha@gmail.com',
            'password' => bcrypt('passer'),
            'position' => 'Technical Manager',
            'first_name' => 'tapha',
            'phone' => '771326617',
            'team_id' => '1'
        ]);
    }
}
