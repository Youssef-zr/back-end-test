<?php

namespace App\Http\Controllers;

use App\deleveryTimes;
use Illuminate\Http\Request;

class DeleveryTimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'our delivery times';
        $deliveryTimes = deleveryTimes::all();

        return view('delevery.index', compact('title', 'deliveryTimes'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'dateStart' => 'required|lt:dateEnd',
            'dateEnd' => 'required'
        ];

        $niceNames =[
            'dateStart'=>"delivery start",
            'dateEnd'=>"delivery end"
        ];

        $data = $this->validate($request, $rules, [], $niceNames);

        deleveryTimes::create([
            'delevery_at' => $request->dateStart.'->'.$request->dateEnd,
            'dateStart' => $request->dateStart,
            'dateEnd' => $request->dateEnd,
        ]);

        $request->session()->flash('msgSuccess', 'record created successfully');

        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\deleveryTimes  $deleveryTimes
     * @return \Illuminate\Http\Response
     */
    public function show(deleveryTimes $deleveryTimes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\deleveryTimes  $deleveryTimes
     * @return \Illuminate\Http\Response
     */
    public function edit(deleveryTimes $deleveryTimes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\deleveryTimes  $deleveryTimes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, deleveryTimes $deleveryTimes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\deleveryTimes  $deleveryTimes
     * @return \Illuminate\Http\Response
     */
    public function destroy(deleveryTimes $deleveryTimes)
    {
        //
    }
}
