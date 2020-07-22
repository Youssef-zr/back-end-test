<?php

use App\Partners;
use Illuminate\Database\Seeder;

class partnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $partners = [
            ['nada', '0672112786'],
            ['hassan', '0652145786'],
            ['mohamed', '0682145784'],
        ];

        $a = 0;

        while ($a <= 2) {

            $data = [];
            $data['name'] = $partners[$a][0];
            $data['phone'] = $partners[$a][1];
            $data['city_id'] = $a + 1;

            $partner = new Partners();

            $partner->fill($data)->save();

            $a++;
        }
    }
}
