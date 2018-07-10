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
        'email' => 'asd@asd.com',
        'password' => '123456',
        'foto' => 'asdqew',
        'descricao' => 'fgsygbfiufgiapdbfaufvbuoygfpuyfgkuav aiugfoaudyf 13134augf oaugfoydagf'
      ]);

      DB::table('users')->insert([

        'name' => 'nanainha',
        'email' => 'nanainha@asd.com',
        'password' => '12asfhsi3456',
        'foto' => 'asdqew',
        'descricao' => 'fgsygbajfhgsyugu348253745234725fiufgiapdbfaufvbuoygfpuyfgkuav aiugfoaudyf 13134augf oaugfoydagf'
      ]);

    }
}
