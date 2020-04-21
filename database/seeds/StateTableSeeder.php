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
        DB::table('states')->insert([
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Acre',
                'initial' => 'AC',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Alagoas',
                'initial' => 'AL',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Amazonas',
                'initial' => 'AM',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Amapá',
                'initial' => 'AP',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Bahia',
                'initial' => 'BA',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Ceará',
                'initial' => 'CE',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Distrito Federal',
                'initial' => 'DF',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Espirito Santo',
                'initial' => 'ES',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Goias',
                'initial' => 'GO',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Maranhão',
                'initial' => 'MA',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Minas Gerais',
                'initial' => 'MG',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Mato Grosso do Sul',
                'initial' => 'MS',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Mato Grosso',
                'initial' => 'MT',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Pará',
                'initial' => 'PA',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Paraíba',
                'initial' => 'PB',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Pernambuco',
                'initial' => 'PE',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Piauí',
                'initial' => 'PI',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Paraná',
                'initial' => 'PR',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Rio de Janeiro',
                'initial' => 'RJ',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Rio Grande do Norte',
                'initial' => 'RN',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Rondônia',
                'initial' => 'RO',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Roraima',
                'initial' => 'RR',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Rio Grande do Sul',
                'initial' => 'RS',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Santa Catarina',
                'initial' => 'SC',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Sergipe',
                'initial' => 'SE',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'São Paulo',
                'initial' => 'SP',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ],
            [
                'id' => (string) Webpatser\Uuid\Uuid::generate(),
                'name' => 'Tocantis',
                'initial' => 'TO',
                'country_id' => \App\Country::first()->id,
                'created_at' => (date_create())->format('Y-m-d H:i:s')
            ]
                ]
        );
    }
}
