<?php

use App\deleveryTimes;
use Illuminate\Database\Seeder;

class deleveryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $times = ['9->12', '14->18', '10->13', '15->19', '8->13', '18->20'];

        $a = 0;
        while ($a < count($times)) {

            $date = explode('->', $times[$a]);

            deleveryTimes::create([
                'delevery_at' => $times[$a],
                'dateStart' => $date[0],
                'dateEnd' => $date[1],
            ]);

            $a++;
        }

    }
}
