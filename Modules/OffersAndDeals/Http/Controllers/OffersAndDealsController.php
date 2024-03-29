<?php

namespace Modules\OffersAndDeals\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Offer;
use App\OfferOfferCategory;
use App\OfferCategory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Helper;
use App\Users;
use Session;

class OffersAndDealsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['offers'] = Offer::all();
        return view('offersanddeals::offers_and_deals.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $start_date = str_replace('/', '-', $request->start_date_);
        $end_date = str_replace('/', '-', $request->end_date_);

        if ($request->has('activation')) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        $user = Users::find(\Auth::id());
        if ($user->isSponsor()) {
            $sponsor_id = $user->id;
        } else {
            $sponsor_id = $request->offer_sponsor;
        }
        if ($request->hasFile('offer_image')) {

            $destinationPath = 'offer_images';
            $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $request->offer_image->getClientOriginalExtension();

            Input::file('offer_image')->move($destinationPath, $fileNameToStore);

            $offer = Offer::Create([

                'name' => $request->offer_title,
                'description' => $request->offer_description,
                'image' => $fileNameToStore,
                'is_active' => $is_active,
                'start_datetime' => date('Y-m-d', strtotime($start_date)),
                'end_datetime' => date('Y-m-d', strtotime($end_date)),
                'sponsor_id' => $sponsor_id
            ]);

            foreach ($request->offer_category as $cat) {
                OfferOfferCategory::create([
                    'offer_id' => $offer->id,
                    'offer_category_id' => $cat
                ]);
            }
            // }
        }
        $data['offers'] = Offer::all();
        Helper::flashLocaleMsg(Session::get('locale'), 'success', 'Offer Added successfully!', ' تم أضافه العرض بنجاح');
        return redirect('/offers_and_deals');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data['categories'] = OfferCategory::all();
        $data['sponsors'] = Users::whereHas('rules', function ($q) {
            $q->where('rules.name', 'like', '%Sponsor%');
        })->with('rules')->get();
        $user = Users::find(\Auth::id());
        $data['isSponsor'] = $user->isSponsor();
        return view('offersanddeals::offers_and_deals.create', $data);
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
    public function edit(Request $request)
    {
        $data['categories'] = OfferCategory::all();
        $data['offer'] = Offer::find($request->route('id'));
        $data['sponsors'] = Users::whereHas('rules', function ($q) {
                $q->where('rules.name', 'like', '%Sponsor%');
        })->with('rules')->get();
        $user = Users::find(\Auth::id());
        $data['isSponsor'] = $user->isSponsor();

        return view('offersanddeals::offers_and_deals.update', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $start_date = str_replace('/', '-', $request->start_date_);
        $end_date = str_replace('/', '-', $request->end_date_);
       // dd( date('Y-m-d', strtotime($start_date))) ;

        $offer = Offer::find($id);
        if ($request->has('activation')) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        $user = Users::find(\Auth::id());
        if ($user->isSponsor()) {
            $sponsor_id = $user->id;
        } else {
            $sponsor_id = $request->offer_sponsor;
        }
        if ($request->hasFile('offer_image')) {
            // dd($request->offer_image->getClientOriginalExtension());
            // foreach ($request->offer_image as $key => $file) {

            $destinationPath = 'offer_images';
            $fileNameToStore = $destinationPath . '/' . time() . rand(111, 999) . '.' . $request->offer_image->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('offer_image')->move($destinationPath, $fileNameToStore);
           
            $offer->update([

                'name' => $request->offer_title,
                'description' => $request->offer_description,
                'image' => $fileNameToStore,
                'is_active' => $is_active,
                'start_datetime' => date('Y-m-d', strtotime($start_date)),
                'end_datetime' => date('Y-m-d', strtotime($end_date)),
                'sponsor_id' => $sponsor_id
            ]);


            // }
        } else {
            $offer->update([

                'name' => $request->offer_title,
                'description' => $request->offer_description,
                'is_active' => $is_active,
                'start_datetime' => date('Y-m-d', strtotime($start_date)),
                'end_datetime' => date('Y-m-d', strtotime($end_date)),
                'sponsor_id' => $sponsor_id
            ]);
        }
        OfferOfferCategory::where('offer_id', $offer->id)->delete();
        foreach ($request->offer_category as $cat) {
            OfferOfferCategory::create([
                'offer_id' => $offer->id,
                'offer_category_id' => $cat
            ]);
        }

        Helper::flashLocaleMsg(Session::get('locale'), 'success', 'Offer Updated successfully!', ' تم تعديل العرض بنجاح');
        return redirect('/offers_and_deals');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function delete(Request $request)
    {
        $id = $request->id;

        try {
            Offer::destroy($id);
            OfferOfferCategory::where('offer_id', $id)->delete();
        } catch (\Exception $e) {
            return response()->json('error', 'Something went wrong, code: '.$e->getMessage());
        }

        return response()->json(['success' => 'success']);
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            try {
                Offer::destroy($id);
                OfferOfferCategory::where('offer_id', $id)->delete();
            } catch (\Exception $e) {
                return response()->json('error', 'Something went wrong, code: ' . $e->getMessage());
            }
        }
        return response()->json(['success' => 'success']);
    }
}
