<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

use App\Permission;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', '=', 'Professor')->first();
        $permissions = Permission::all();
        $user = User::create(
            [
                'name' => str_random(10),
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
                'application' => (date_create())->format('YmdHisv'),
                'birthday' => (date_create())->format('Y-m-d'),
                'mother_name' => str_random(10),
                'father_name' => str_random(10),
                'profession' => str_random(10),
                'identity_number' => Crypt::encryptString(str_random(10)),
                'issuing_authority' => str_random(10),
                'issuing_date' => (date_create())->format('Y-m-d'),
                'marital_status' => 'SOLTEIRO',
                'cpf' => Crypt::encryptString(rand()),
                'scholarship_level' => 'SUPERIOR_COMPLETO',
                'latest_school' => str_random(10),
                'voter_id_number' => Crypt::encryptString(str_random(10)),
                'voter_id_zone' => Crypt::encryptString(str_random(10)),
                'voter_id_section' => Crypt::encryptString(str_random(10)),
                'current_university_campus_id' => null,
                'naturalness_country' => \App\Country::first()->id,
                'voter_id_state' => \App\State::first()->id,
                'naturalness_state' => \App\State::first()->id,
                'status' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s'),
                'issuing_id_state' => \App\State::first()->id
            ]
        );

        $user->attachRole($adminRole);
//        foreach ($permissions as $permission) {
//            $user->attachPermission($permission);
//        }
    }
}
