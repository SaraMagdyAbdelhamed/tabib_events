<?php

namespace Modules\Events\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Currency;
use App\Category;
use App\Users;
use App\Specialization;


class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('events::events.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['doctors']=Users::wherehas('rules',function($q){
            $q->where('rule_id',2);
        })->get();
        $data['categories']=Category::all();
        $data['specializations']=Specialization::all();
        $data['currencies']=Currency::all();
        // dd($data);
        return view('events::events.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        dd($request->all());

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('events::events.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('events::events.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
