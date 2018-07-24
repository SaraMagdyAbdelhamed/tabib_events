<?php

namespace Modules\OffersAndDeals\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Offer;
use App\OfferOfferCategory;

class OffersAndDealsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['offers']=Offer::all();
        return view('offersanddeals::offers_and_deals.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('offersanddeals::offers_and_deals.index');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return view('offersanddeals::offers_and_deals.create');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('offersanddeals::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('offersanddeals::offers_and_deals.update');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        return view('offersanddeals::offers_and_deals.index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function delete($id)
    {
        Offer::destroy($id);
        OfferOfferCategory::where('offer_id',$id)->delete();
    }
}
