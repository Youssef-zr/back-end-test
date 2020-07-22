<?php

use App\Cities;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class citiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $cities = ['Tangier', 'casa', 'rabat'];
        $a = 0;

        while ($a <= 2) {

            $data = [];
            $data['name'] = $cities[$a];
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();

            $city = new Cities();
            $city->fill($data)->save();

            $a++;
        }
    }
}
