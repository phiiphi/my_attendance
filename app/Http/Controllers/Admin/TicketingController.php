<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticketing;
use Illuminate\Support\Facades\Gate;



class TicketingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //
        if (! Gate::allows('can_manage_ticketing')) {
            return abort(401);
        }

        $tickets = Ticketing::all();
        return view('admin.ticketing.index', compact('tickets'));

        // return view('admin.ticket.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
         //
         if (! Gate::allows('can_manage_ticketing')) {
            return abort(401);
        }

        return view('admin.ticketing.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //
        $validateData = $this->validate($request,[
            'ticket_number'        =>  'required',
            'ticket_description'   =>  'required',
            'price'                =>  'required',
            'car_number'           =>  'required',
            
        ]);
        // dd($request);

        $ticket = new Ticketing();
        $ticket->ticket_number               = $request->ticket_number;
        $ticket->ticket_description          = $request->ticket_description;
        $ticket->price                       = $request->price;
        $ticket->car_number                  = $request->car_number;
        $ticket->save();
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
        //
        $ticket = Ticketing::find($id)->findOrFail($id);
        return view('admin.ticketing.edit', compact('ticket' ));
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
        //
        $validateData = $this->validate($request,[
            'ticket_number'        =>  'required',
            'ticket_description'   =>  'required',
            'price'                =>  'required',
            'car_number'           =>  'required',
            
        ]);
           #find row and insert
           $ticket = Ticketing::find($id);
           $ticket->ticket_number               = $request->input('ticket_number');
           $ticket->ticket_description          = $request->input('ticket_description');
           $ticket->price                       = $request->input('price');
           $ticket->car_number                  = $request->input('car_number');
           $ticket->save();
           return redirect()->route('admin.ticketing.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticketing $ticket)
    {
        if (! Gate::allows('can_manage_ticketing')) {
            return abort(401);
        }

        $ticket->delete();

        return redirect()->route('admin.ticketing.index');
    }
}
