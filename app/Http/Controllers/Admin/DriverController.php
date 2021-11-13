<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Gate;
use RealRashid\SweetAlert\Facades\Alert;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
   //
        if (! Gate::allows('can_manage_drivers')) {
            return abort(401);
        }

        $drivers = Driver::all();
        return view('admin.drivers.index', compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        if (! Gate::allows('can_manage_drivers')) {
            return abort(401);
        }

        return view('admin.drivers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name'            =>  'required',
            'surname'               =>  'required',
            'phone'                 =>  'required|unique:App\Models\Driver,phone',
            'lincense_weight'       =>  'required|unique:App\Models\Driver,lincense_weight',
            'car_number'            =>  'required',
            
        ]);

        $driver = new Driver();
        $driver->first_name       = $request->first_name;
        $driver->surname          = $request->surname;
        $driver->phone            = $request->phone;
        $driver->lincense_weight  = $request->lincense_weight;
        $driver->car_number       = $request->car_number;
        $driver->save();

        Alert::success('Congrats', 'Driver added Successful');
        return redirect()->route('admin.driver.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Driver::find($id)->findOrFail($id);
        return view('admin.drivers.edit', compact('driver' ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'first_name'            =>  'required',
            'surname'               =>  'required',
            'phone'                 =>  'required',
            'lincense_weight'       =>  'required',
            'car_number'            =>  'required',
            
        ]);
       #find row and insert
       $driver = Driver::find($id);
       $driver->first_name       = $request->input('first_name');
       $driver->surname          = $request->input('surname');
       $driver->phone            = $request->input('phone');
       $driver->lincense_weight  = $request->input('lincense_weight');
       $driver->car_number       = $request->input('car_number');
       $driver->save();

       Alert::success('Congrats', 'Operation Successful');


       return redirect()->route('admin.driver.index');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Driver $driver)
    {
        if (! Gate::allows('can_manage_drivers')) {
            return abort(401);
        }

        $driver->delete();

        return redirect()->route('admin.driver.index');
    }

    public function massDestroy(Driver $driver)
    {
        Driver::whereIn('id', request('ids'))->delete();
        return response()->noContent();
    }
}
