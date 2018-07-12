<?php

namespace Modules\Offers\Http\Controllers;

use Auth;
use File;
use App\Helpers\Helper;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use App\Offer;
use App\EntityLocalization;


class OffersController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['attractions'] = Offer::all();
        return view('offers::list', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        if( $request->hasFile('image_ar') || $request->hasFile('image_en') ) {
            // Get images
            $image_ar = $request->image_ar;
            $image_en = $request->image_en;

            // Rename it
            $imageArNewName = time().$image_ar->getClientOriginalName();
            $imageEnNewName = time().$image_en->getClientOriginalName();

            // Move it to public/offers
            $image_ar->move('offer_images', $imageArNewName);
            $image_en->move('offer_images', $imageEnNewName);

            // Save its path
            $imageArPath = 'offer_images/'.$imageArNewName;
            $imageEnPath = 'offer_images/'.$imageEnNewName;
        }

        // Store English in `offers` table
        try {
            $offer = new Offer;
            
            $offer->name        = $request->image_en_name;
            $offer->description = $request->image_en_desc;

            if( $request->hasFile('image_en') ) {
                $offer->image_en    = $imageEnPath;
            }

            if( $request->hasFile('image_ar') ) {
                $offer->image_ar    = $imageArPath;
            }

            $offer->is_active       = $request->offer_status == 1 ? $request->offer_status : 0;
            $offer->created_by      = Auth::id();
            $offer->save();

        } catch(\Exception $ex) {
            return response()->json(['fail' => 'Faild to store offer in English! '. $ex]);
        }

        // Store Arabic in `entity_localization`
        try {
            Helper::add_localization(9, 'name', $offer->id, $request->image_ar_name, 2);
            Helper::add_localization(9, 'description', $offer->id, $request->image_ar_desc, 2);
        } catch(\Exception $ex) {
            return response()->json(['fail' => 'Faild to store offer in Arabic! '.$ex ]);
        }


        return response()->json(['success' => 'Offer added successfully!']);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('offers::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit(Request $request)
    {
        $offer = Offer::find($request->id);
        $row = [
            'id'    => $offer->id,
            'name_en'  => $offer->name,
            'desc_en'  => $offer->description,
            'name_ar'  => Helper::localization('offers', 'name', $request->id, 2),
            'desc_ar'  => Helper::localization('offers', 'description', $request->id, 2),
            'is_active'=> $offer->is_active
        ];
        return response()->json($row);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        $input = $request->all();

        // Request has arabic image file?!
        if( $request->hasFile('image_ar') ) {
            // Get images
            $image_ar = $request->image_ar;

            // Rename it
            $imageArNewName = time().$image_ar->getClientOriginalName();

            // Move it to public/offers
            $image_ar->move('offer_images', $imageArNewName);

            // Save its path
            $imageArPath = 'offer_images/'.$imageArNewName;
        }

        // Request has english image file!?
        if( $request->hasFile('image_en') ) {
            // Get images
            $image_en = $request->image_en;

            // Rename it
            $imageEnNewName = time().$image_en->getClientOriginalName();

            // Move it to public/offers
            $image_en->move('offer_images', $imageEnNewName);

            // Save its path
            $imageEnPath = 'offer_images/'.$imageEnNewName;
        }

        // Store English in `offers` table
        try {
            $offer = Offer::find($request->id);
            
            $offer->name        = $request->image_en_name;
            $offer->description = $request->image_en_desc;

            if( $request->hasFile('image_en') ) {
                if ( File::exists($offer->image_en) ) {
                    File::delete($offer->image_en);
                }
                $offer->image_en    = $imageEnPath;
            }

            if( $request->hasFile('image_ar') ) {
                if ( File::exists($offer->image_ar) ) {
                    File::delete($offer->image_ar);
                }
                $offer->image_ar    = $imageArPath;
            }

            $offer->is_active       = $request->offer_status == 1 ? $request->offer_status : 0;
            $offer->created_by      = Auth::id();
            $offer->save();

        } catch(\Exception $ex) {
            return response()->json(['fail' => 'Faild to store offer in English! '. $ex]);
        }

        // Store Arabic in `entity_localization`
        try {
            Helper::edit_entity_localization('offers', 'name', $offer->id, 2, $request->image_ar_name);
            Helper::edit_entity_localization('offers', 'description', $offer->id, 2, $request->image_ar_desc);
        } catch(\Exception $ex) {
            return response()->json(['fail' => 'Faild to store offer in Arabic! '.$ex ]);
        }


        return response()->json(['success' => 'Offer added successfully!']);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        // find record
        $offer = Offer::find($request->id);
        $path_ar = $offer->image_ar;        // path without public
        $path_en = $offer->image_en;        // path without public

        // delete its images
        if ( File::exists($path_ar) ) {
            File::delete($path_ar);
        }
        if ( File::exists($path_en) ) {

            File::delete($path_en);
        }

        // delete localization if there 
        if ( EntityLocalization::where('item_id', $offer->id)->get() != NULL ) {
            EntityLocalization::where('item_id', $offer->id)->delete();
        }

        // delete record
        $offer->delete();

        return response()->json(['success' => 'success!']);
    }

    public function destroySelected(Request $request)
    {
        foreach($request->ids as $id) {
            // find record
            $offer = Offer::find($id);
            $path_ar = $offer->image_ar;        // path without public
            $path_en = $offer->image_en;        // path without public

            // delete its images
            if ( File::exists($path_ar) ) {
                File::delete($path_ar);
            }
            if ( File::exists($path_en) ) {

                File::delete($path_en);
            }

            // delete localization if there 
            if ( EntityLocalization::where('item_id', $offer->id)->get() != NULL ) {
                EntityLocalization::where('item_id', $offer->id)->delete();
            }

            // delete record
            $offer->delete();
        }

        return response()->json(['success' => 'success!']);
    }
}
