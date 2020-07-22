<?php

namespace App\Http\Controllers;

use App\Cities;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function formCheck()
    {
        $title = 'make order';
        return view('order.create', compact('title'));
    }

    public function checkOrder($city_id, $date)
    {
        $city = Cities::findOrFail($city_id);
        //Convert the date string into a unix timestamp.
        $unixTimestamp = strtotime($date);
        $dayNumber = date("d", $unixTimestamp);

        $cityDeleveryTimes = $city->times()->where('status', '0')->get();

        // get our delevery_at variables from all delevery times
        $delevTimes = [];
        foreach ($cityDeleveryTimes as $time) {
            array_push($delevTimes, $time->dateStart, $time->dateEnd);
        }

        // return $delevTimes;

        // $delevTimes = implode("->", $delevTimes);

        // $delevTimes = str_replace('->', ',', $delevTimes);
        // $delevTimes = array_map('intval', explode(',', $delevTimes));

        // // Get the day of the week using date function.
        // $dayOfWeek = date("l", $unixTimestamp);

        function floorSearch($arr, $n, $x)
        {
            if (!empty($arr)) {

                $maxDay = max($arr);
                $minDay = min($arr);

                // If last element is smaller
                // than x
                if ($x > $maxDay) {
                    return -1;
                }

                // If first element is greater
                // than x
                if ($x < $minDay) {
                    return -1;
                }

                // // Linearly search for the
                // // first element greater than x

                for ($i = 0; $i < $n; $i++) {

                    if (array_key_exists($i, $arr) and $arr[$i] > $x) {

                        return $i;
                    }
                }
            }
            return -1;
        }

        // Driver Code
        $arr = $delevTimes;
        $n = sizeof($arr);
        $x = $dayNumber;

        $index = floorSearch($arr, $n, $x);

        // // check if the index if the array of our delivery times
        if(array_key_exists($index,$arr)){

            if (in_array($arr[$index], $delevTimes)) {

                $deleverystart = null;

                if (array_key_exists($index - 1, $arr)) {

                    $deleverystart = $delevTimes[$index - 1];

                } else {

                    $deleverystart = $delevTimes[$index];
                }
            }
        }else{
            return response()->json(['msg' => 'no delevery times for this day choose an other day '], 500);
        }


        if ($index != -1) {

            // $ourCityDelevTimes = $city->times()->where('status', 0)->where('dateEnd', ">=", $deleveryend)->get();
            $ourCityDelevTimes = $city->times()->where('status', 0)->where('dateEnd', ">", $deleverystart)->get();

            $output = [];
            foreach ($ourCityDelevTimes as $cityDelev) {

                array_push($output, [
                    'day_name' => Carbon::parse($cityDelev->created_at)->format('l'),
                    'date' => Carbon::parse($cityDelev->created_at)->format('yy-m-d'),
                    'delivery_times' => [
                        "id" => $cityDelev->id,
                        "startDate" => $cityDelev->dateStart,
                        "endDate" => $cityDelev->dateStart,
                        "delevery_at" => $cityDelev->delevery_at,
                        "created_at" => Carbon::parse($cityDelev->created_at)->format('yy-m-d'),
                        "updated_at" => Carbon::parse($cityDelev->updated_at)->format('yy-m-d'),
                    ],
                    'nbDaysOfOrder' => $cityDelev->dateEnd - $dayNumber,
                ]
                );
            }

            return response()->json(['dates' => $output], 200);

        } else {
            return response()->json(['msg' => 'no delevery times for this day choose an other day '], 500);
        }

        //     }
        // } else {

        //     return response()->json(['msg' => 'no delevery times for this day choose an other day '], 500);
        // }

    }
}
