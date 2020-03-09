<?php

use Illuminate\Database\Seeder;

class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('state')->insert([
            [
                'name' => 'Acre',
                'initial' => 'AC',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Alagoas',
                'initial' => 'AL',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Amazonas',
                'initial' => 'AM',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Amapá',
                'initial' => 'AP',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Bahia',
                'initial' => 'BA',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Ceará',
                'initial' => 'CE',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Distrito Federal',
                'initial' => 'DF',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Espirito Santo',
                'initial' => 'ES',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Goias',
                'initial' => 'GO',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Maranhão',
                'initial' => 'MA',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Minas Gerais',
                'initial' => 'MG',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Mato Grosso do Sul',
                'initial' => 'MS',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Mato Grosso',
                'initial' => 'MT',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pará',
                'initial' => 'PA',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paraíba',
                'initial' => 'PB',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Pernambuco',
                'initial' => 'PE',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Piauí',
                'initial' => 'PI',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Paraná',
                'initial' => 'PR',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rio de Janeiro',
                'initial' => 'RJ',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rio Grande do Norte',
                'initial' => 'RN',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rondônia',
                'initial' => 'RO',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Roraima',
                'initial' => 'RR',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Rio Grande do Sul',
                'initial' => 'RS',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Santa Catarina',
                'initial' => 'SC',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Sergipe',
                'initial' => 'SE',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'São Paulo',
                'initial' => 'SP',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Tocantis',
                'initial' => 'TO',
                'country_id' => 1,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ]
                ]
        );
    }
}
