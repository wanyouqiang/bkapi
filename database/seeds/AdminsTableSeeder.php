<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'username' => 'admin',
            'display_name' => '万有强',
            'email' => 'wanyouqiang@xiyuemedia.com',
            'password' => bcrypt('admin')
        ]);
    }
}
