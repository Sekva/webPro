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
        'password' => bcrypt('123456'),
        'foto' => '/storage/defaul.png',
        'descricao' => 'kkkk aiugfoaudyf 13134augf oaugfoydagf'
      ]);

      DB::table('users')->insert([

        'name' => 'nanainha',
        'email' => 'asd2@asd.com',
        'password' => bcrypt('123456'),
        'foto' => '/storage/defaul.png',
        'descricao' => 'jgfdfd aiugfoaudyf 13134augf oaugfoydagf'
      ]);

      DB::table('users')->insert([

        'name' => 'Oto gato',
        'email' => 'asd3@asd.com',
        'password' => bcrypt('123456'),
        'foto' => '/storage/defaul.png',
        'descricao' => 'asdadasd aiugfoaudyf 13134augf oaugfoydagf'
      ]);

      DB::table('users')->insert([

        'name' => 'nanainha',
        'email' => 'asd4@asd.com',
        'password' => bcrypt('123456'),
        'foto' => '/storage/defaul.png',
        'descricao' => 'uyt aiugfoaudyf 13134augf oaugfoydagf'
      ]);

    }
}
