<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        DB::table('admins')->insert([
            'username' => "admin",
            'email' => 'admin@admin.admin',
            'password' => Hash::make('123456789'),
            'phone' => "",
            'rule_id' => 1,
            'active' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
        ]);
    }
}