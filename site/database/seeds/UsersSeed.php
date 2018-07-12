<?php

use Illuminate\Database\Seeder;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([

        'name' => 'Nome o caba',
        'email' => 'aqqqqqsd@asd.com',
        'password' => bcrypt('123456'),
        'foto' => '/storage/defaul.png',
        'descricao' => 'fgsygbfiufgiapdbfaufvbuoygfpuyfgkuav aiugfoaudyf 13134augf oaugfoydagf'
      ]);

      DB::table('users')->insert([

        'name' => 'nanainha',
        'email' => 'nanainha@asd.com',
        'password' => bcrypt('12asfhsi3456'),
        'foto' => '/storage/defaul.png',
        'descricao' => 'fgsygbajfhgsyugu348253745234725fiufgiapdbfaufvbuoygfpuyfgkuav aiugfoaudyf 13134augf oaugfoydagf'
      ]);

    }
}
