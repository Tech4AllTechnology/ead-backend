<?php

use Illuminate\Database\Seeder;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('country')->insert([
            'name' => 'Brasil',
            'initial' => 'BR',
            'created_at' => (date_create())->format('Y-m-d H:i:s')
        ]);
    }
}
