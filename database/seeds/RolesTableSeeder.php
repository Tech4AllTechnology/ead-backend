<?php

use App\User;
use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Roles
         *
         */
        if (Role::where('name', '=', 'Admin')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Admin',
                'slug'        => 'admin',
                'description' => 'Admin Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('name', '=', 'Diretor Geral')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Diretor Geral',
                'slug'        => 'general_director',
                'description' => 'Diretor Geral Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('name', '=', 'Diretor Administrativo')->first() === null) {
            $adminRole = Role::create([
                'name'        => 'Diretor Administrativo',
                'slug'        => 'administrative_director',
                'description' => 'Diretor Administrativo Role',
                'level'       => 5,
            ]);
        }

        if (Role::where('name', '=', 'Diretor Pedagocico')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Diretor Pedagocico',
                'slug'        => 'pedagogical_director',
                'description' => 'Diretor Pedagocico Role',
                'level'       => 4,
            ]);
        }

        if (Role::where('name', '=', 'Diretor Financeiro')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Diretor Financeiro',
                'slug'        => 'financial_director',
                'description' => 'Diretor Financeiro Role',
                'level'       => 4,
            ]);
        }

        if (Role::where('name', '=', 'Coordenador Administrativo')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Coordenador Administrativo',
                'slug'        => 'administrative_coordinator',
                'description' => 'Coordenador Administrativo Role',
                'level'       => 3,
            ]);
        }

        if (Role::where('name', '=', 'Coordenador do Polo')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Coordenador do Polo',
                'slug'        => 'campus_coordinator',
                'description' => 'Coordenador do Polo Role',
                'level'       => 3,
            ]);
        }

        if (Role::where('name', '=', 'Professor')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Professor',
                'slug'        => 'professor',
                'description' => 'Professor Role',
                'level'       => 2,
            ]);
        }

        if (Role::where('name', '=', 'Aluno')->first() === null) {
            $userRole = Role::create([
                'name'        => 'Aluno',
                'slug'        => 'student',
                'description' => 'Aluno Role',
                'level'       => 1,
            ]);
        }
    }
}
