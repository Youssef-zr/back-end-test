<?php

namespace App\Http\Controllers;

use App\Cities;
use App\deleveryTimes;
use Illuminate\Http\Request;
use Validator;

class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $title = 'our cities';
        $Cities = Cities::all();

        return view('cities.index',['title'=>$title,'Cities'=>$Cities]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required|string|min:5'];
        $niceName =[
            'name'=>'city name'
        ];

        $data = $this->validate($request,$rules,[],$niceName);

        Cities::create($data);

        $request->session()->flash('msgSucess', 'City created successfully');

        return back();

    }

    public function attachDelevery($city_id)
    {

        $city = Cities::findOrFail($city_id);

        $city_delevery_times = $city->times()->get();
        $countDelevDisabled = $city->times()->where('status', '0')->count();

        $existDelevery = [];
        foreach ($city_delevery_times as $delevery) {
            array_push($existDelevery, $delevery->pivot->delevery_id);
        }

        $deleveryTimes = deleveryTimes::whereNotIn('id', $existDelevery)->get();

        return view('cities.attachTimes', compact('deleveryTimes', 'city', 'city_delevery_times', 'countDelevDisabled'));
    }

    public function storeDeleveries(Request $request, $city_id)
    {
        $rule = ['times' => 'required|min:1'];

        $data = $this->validate($request, $rule);

        $city = Cities::findOrFail($city_id);
        $city->times()->attach($request->times);

        $request->session()->flash('msgSuccess', 'times added successfully');
        return back();

    }

    public function cityDeleveryStatus($city_id, $delevery_id, $status)
    {

        $city = Cities::findOrFail($city_id);

        // change status of delevery time for this city
        $city->times()->where('delevery_id', $delevery_id)->update(['status' => $status]);


        request()->session()->flash('msgSuccess', 'record updated successfully');

        return back();
    }

    public function chanageDeleveriesStatus($city_id, $status)
    {
        $city = Cities::findOrFail($city_id);

        // change status of all  deleveries time for this city
        $city->times()->update(['status' => $status]);


        request()->session()->flash('msgSuccess', 'records updated successfully');

        return back();
    }

    public function ourCities()
    {
        $cities = cities::all();

        return response()->json(['data' => $cities], 200);

    }
}
