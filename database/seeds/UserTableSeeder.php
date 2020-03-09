<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => str_random(10),
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'application' => (date_create())->format('YmdHisv'),
            'birthday' => (date_create())->format('Y-m-d'),
            'mother_name' => str_random(10),
            'father_name' => str_random(10),
            'profession' => str_random(10),
            'identity_number' => str_random(10),
            'issuing_authority' => str_random(10),
            'issuing_date' => (date_create())->format('Y-m-d'),
            'marital_status' => str_random(10),
            'cpf' => rand(),
            'scholarship_level' => str_random(10),
            'latest_school' => str_random(10),
            'voter_id_number' => str_random(10),
            'voter_id_zone' => str_random(10),
            'voter_id_section' => str_random(10),
            'polo_id' => rand(),
            'course_id' => rand(),
            'naturalness_country' => 1,
            'voter_id_state' => 27,
            'naturalness_state' => 27,
            'status' => str_random(10),
            'created_at' => (date_create())->format('Y-m-d H:i:s')
        ]);
    }
}
