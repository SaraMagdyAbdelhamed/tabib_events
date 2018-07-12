<?php

namespace Modules\Famous\Http\Controllers;

use Helper;
use Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\FamousCategory;
use App\FamousAttraction;
use App\FamousAttractionMedia;

class FamousController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['attractions'] = FamousAttraction::all();
        $data['categories']  = FamousCategory::all();
        return view('famous::list', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['categories'] = FamousCategory::all();

        return view('famous::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'place_name'  => 'required|max:100',
            'lat'         => 'required',
            'lng'         => 'required',
            'place_categories'  => 'required',
            'other_info'  => ($request->other_info ? 'max:140' : ''),
        ]);

        // Insert English values
        try {
            // Add new famous attraction
            $famous = new FamousAttraction;

            $famous->name       = $request->place_name;
            $famous->address    = $request->address;
            $famous->longtuide  = $request->lng;
            $famous->latitude   = $request->lat;
            $famous->website    = $request->website;
            $famous->phone      = $request->phone_number;
            $famous->info       = $request->other_info;
            $famous->is_active  = $request->is_active ? 1 : 0;
            $famous->save();

            // Attach new categories
            for ($i = 0; $i < count($request->place_categories); $i++) {
                $famous->categories()->attach($request->place_categories[$i]);
            }

            // Attach days
            $days  = array();
            $start = array();
            $end  = array();
            
            if($request->sat) {
                $days[]     = $request->sat;
                $start[]    = $request->sat_start;
                $end[]      = $request->sat_end;
            }
            if($request->sun) {
                $days[] = $request->sun;
                $start[]    = $request->sun_start;
                $end[]      = $request->sun_end;
            }
            if($request->mon) {
                $days[] = $request->mon;
                $start[]    = $request->mon_start;
                $end[]      = $request->mon_end;
            }
            if($request->tue) {
                $days[] = $request->tue;
                $start[]    = $request->tue_start;
                $end[]      = $request->tue_end;
            }
            if($request->wed) {
                $days[] = $request->wed;
                $start[]    = $request->wed_start;
                $end[]      = $request->wed_end;
            }
            if($request->thu) {
                $days[] = $request->thu;
                $start[]    = $request->thu_start;
                $end[]      = $request->thu_end;
            }
            if($request->fri) {
                $days[] = $request->fri;
                $start[]    = $request->fri_start;
                $end[]      = $request->fri_end;
            }
            
            if( count($days) > 0 ) {
                for ($i = 0; $i < count($days); $i++) {
                    $famous->days()->attach( [$days[$i] => [ 'from'=>$start[$i], 'to'=>$end[$i] ]] );
                }
            }

            // Attach media
            $famous->media()->createMany([
                ['media' => ($request->youtube_en ? : ''), 'type' => 2],
                ['media' => ($request->youtube_ar ? : ''), 'type' => 2],
            ]);

                        // Check if there is any images or files and move them to public/events
            // Arabic Event Images
            if ($request->hasfile('arabic_images')) {

                // Setup every image
                foreach ($request->file('arabic_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('famous_images/arabic', $name);
                    $data_arabic[] = 'famous_images/arabic/' . $name;
                }

                /** Arabic Images **/
                if (isset($data_arabic) && !empty($data_arabic)) {
                    foreach ($data_arabic as $img_ar) {
                        $media = new FamousAttractionMedia;

                        $media->famous_attraction_id = $famous->id;
                        $media->media = $img_ar;
                        $media->type = 1;
                        $media->save();
                    }
                }                
            }
            
            // English Event Images
            if ($request->hasfile('english_images')) {

                // Setup every image
                foreach ($request->file('english_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('famous_images/english', $name);
                    $data_english[] = 'famous_images/english/' . $name;
                }

                /** English Images **/
                if (isset($data_english) && !empty($data_english)) {
                    foreach ($data_english as $img_en) {
                        $media = new FamousAttractionMedia;

                        $media->famous_attraction_id = $famous->id;
                        $media->media = $img_en;
                        $media->type = 1;
                        $media->save();
                    }
                }

            }

        } catch(\Exception $ex){
            dd($ex);
            Session::flash('warning', 'English error!');
            return redirect()->back();
        }

        // Insert Arabic values
        try {
            Helper::add_localization(19, 'name', $famous->id, ($request->place_name_ar ? : 'بدون اسم'), 2);
            Helper::add_localization(19, 'address', $famous->id, ($request->place_address_ar ? : 'بدون عنوان'), 2);
            Helper::add_localization(19, 'other_info', $famous->id, ($request->other_info_ar ? : 'بدون معلومات اضافية'), 2);

        } catch(\Exception $ex){
            Session::flash('warning', 'Arabic Error!');
            return redirect()->back();
        }

        // flash success & redirect ot list page
        Session::flash('success', 'Attraction added successfully! تم اضافة المزار بنجاح');
        return redirect('/attractions');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Request $request)
    {
        $famous = FamousAttraction::find($request->id);
        $categories = '';
        $days   = '';
        $start  = '';
        $end    = '';
        $keyword = '';

        // Get categories
        foreach($famous->categories as $cat) {
            // Concatinate all categories
            $categories .= ($request->lang == 'en' ? $cat->name.' ' :  \Helper::localization('fa_categories', 'name', $cat->id, 2, $cat->name).' ' );
        }

        // Get available days
        foreach($famous->days as $day) {
            // Concatinate all available days
            $days   .= ($request->lang == 'en' ? $day->name.', ' :  \Helper::localization('days', 'name', $day->id, 2, $day->name).' ، ' );
            $start  .= ($request->lang == 'en' ? $day->name.': '. $day->pivot->from.' ,  ' : \Helper::localization('days', 'name', $day->id, 2, $day->name).': '.$day->pivot->from.'   ،   ' );
            $end    .= ($request->lang == 'en' ? $day->name.': '.$day->pivot->to.' ,  ' : \Helper::localization('days', 'name', $day->id, 2, $day->name).': '.$day->pivot->to.'   ،   ' );
        }

        // get media
        $keyword = $request->lang == 'en' ? '%english%' : '%arabic%';
        $image   = $famous->media()->where('type', 1)->where('media', 'like', $keyword)->first() ? $famous->media()->where('type', 1)->where('media', 'like', $keyword)->first()->media : '';
        $youtube_ar = $famous->media()->where('type', 2)->first() ? $famous->media()->where('type', 2)->first()->media : '';
        $youtube_en = $famous->media()->where('type', 2)->orderBy('id', 'DESC')->first() ? $famous->media()->where('type', 2)->orderBy('id', 'DESC')->first()->media : '';

        $row = [
            'id'        => $famous->id,
            'name'      => $request->lang == 'en' ? $famous->name : \Helper::localization('famous_attractions', 'name', $famous->id, 2, $famous->name),
            'address'   => $request->lang == 'en' ? $famous->address : \Helper::localization('famous_attractions', 'address', $famous->id, 2, $famous->name),
            'lng'       => $famous->longtuide,
            'lat'       => $famous->latitude,
            'website'   => $famous->website,
            'phone'     => $famous->phone,
            'days'      => $days,
            'start'     => $start,
            'end'       => $end,
            'info'      => $request->lang == 'en' ? $famous->info : \Helper::localization('famous_attractions', 'other_info', $famous->id, 2, $famous->info),
            'is_active' => $famous->is_active,
            'categories'=> $categories,
            'image' => asset($image),
            'youtube_ar' => $youtube_ar,
            'youtube_en' => $youtube_en,
        ];
        return response()->json($row);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['categories'] = FamousCategory::all();
        $data['famous'] = FamousAttraction::find($id);

        // redirect back if not found!
        if ( $data['famous'] == NULL ) {
            Session::flash('warning', 'Not found! غير موجود');
            return redirect('/attractions');
        }

        $data['image_ar']   = $data['famous']->media()->where('type', 1)->where('media', 'like', '%arabic%')->first() ? $data['famous']->media()->where('type', 1)->where('media', 'like', '%arabic%')->first()->media : '';
        $data['image_en']   = $data['famous']->media()->where('type', 1)->where('media', 'like', '%english%')->first() ? $data['famous']->media()->where('type', 1)->where('media', 'like', '%english%')->first()->media : '';

        $data['youtube_ar'] = $data['famous']->media()->where('type', 2)->first() ? $data['famous']->media()->where('type', 2)->first()->media : '';
        $data['youtube_en'] = $data['famous']->media()->where('type', 2)->orderBy('id', 'DESC')->first() ? $data['famous']->media()->where('type', 2)->orderBy('id', 'DESC')->first()->media : '';


        return view('famous::edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'place_name'  => 'required|max:100',
            'lat'         => 'required',
            'lng'         => 'required',
            'place_categories'  => 'required',
            'other_info'  => ($request->other_info ? 'max:140' : ''),
        ]);

        // Update English values
        try {
            // Add new famous attraction
            $famous = FamousAttraction::find($request->id);

            $famous->name       = $request->place_name;
            $famous->address    = $request->address;
            $famous->longtuide  = $request->lng;
            $famous->latitude   = $request->lat;
            $famous->website    = $request->website;
            $famous->phone      = $request->phone_number;
            $famous->info       = $request->other_info;
            $famous->is_active  = $request->is_active ? 1 : 0;
            $famous->save();

            // Attach new categories
            $famous->categories()->detach();
            for ($i = 0; $i < count($request->place_categories); $i++) {
                $famous->categories()->attach($request->place_categories[$i]);
            }

            // Attach days
            $famous->days()->detach();
            $days  = array();
            $start = array();
            $end  = array();
            
            if($request->sat) {
                $days[]     = $request->sat;
                $start[]    = $request->sat_start;
                $end[]      = $request->sat_end;
            }
            if($request->sun) {
                $days[] = $request->sun;
                $start[]    = $request->sun_start;
                $end[]      = $request->sun_end;
            }
            if($request->mon) {
                $days[] = $request->mon;
                $start[]    = $request->mon_start;
                $end[]      = $request->mon_end;
            }
            if($request->tue) {
                $days[] = $request->tue;
                $start[]    = $request->tue_start;
                $end[]      = $request->tue_end;
            }
            if($request->wed) {
                $days[] = $request->wed;
                $start[]    = $request->wed_start;
                $end[]      = $request->wed_end;
            }
            if($request->thu) {
                $days[] = $request->thu;
                $start[]    = $request->thu_start;
                $end[]      = $request->thu_end;
            }
            if($request->fri) {
                $days[] = $request->fri;
                $start[]    = $request->fri_start;
                $end[]      = $request->fri_end;
            }
            
            if( count($days) > 0 ) {
                for ($i = 0; $i < count($days); $i++) {
                    $famous->days()->attach( [$days[$i] => [ 'from'=>$start[$i], 'to'=>$end[$i] ]] );
                }
            }

            // Attach media
            $famous->media()->where('type', 2)->delete();
            $famous->media()->createMany([
                ['media' => ($request->youtube_en ? : ''), 'type' => 2],
                ['media' => ($request->youtube_ar ? : ''), 'type' => 2],
            ]);

                        // Check if there is any images or files and move them to public/events
            // Arabic Event Images
            if ($request->hasfile('arabic_images')) {

                // delete old images if new exists
                $famous->media()->where('type', 1)->where('media', 'like', '%arabic%')->delete();

                // Setup every image
                foreach ($request->file('arabic_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('famous_images/arabic', $name);
                    $data_arabic[] = 'famous_images/arabic/' . $name;
                }

                /** Arabic Images **/
                if (isset($data_arabic) && !empty($data_arabic)) {
                    foreach ($data_arabic as $img_ar) {
                        $media = new FamousAttractionMedia;

                        $media->famous_attraction_id = $famous->id;
                        $media->media = $img_ar;
                        $media->type = 1;
                        $media->save();
                    }
                }                
            }
            
            // English Event Images
            if ($request->hasfile('english_images')) {

                // delete old images if new exists
                $famous->media()->where('type', 1)->where('media', 'like', '%english%')->delete();
                
                // Setup every image
                foreach ($request->file('english_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('famous_images/english', $name);
                    $data_english[] = 'famous_images/english/' . $name;
                }

                /** English Images **/
                if (isset($data_english) && !empty($data_english)) {
                    foreach ($data_english as $img_en) {
                        $media = new FamousAttractionMedia;

                        $media->famous_attraction_id = $famous->id;
                        $media->media = $img_en;
                        $media->type = 1;
                        $media->save();
                    }
                }

            }

        } catch(\Exception $ex){
            dd($ex);
            Session::flash('warning', 'English error!');
            return redirect()->back();
        }

        // Update Arabic values
        try {
            Helper::edit_entity_localization('famous_attractions', 'name', $famous->id, 2, ($request->place_name_ar ? : 'بدون اسم'));
            Helper::edit_entity_localization('famous_attractions', 'address', $famous->id, 2, ($request->place_address_ar ? : 'بدون عنوان'));
            Helper::edit_entity_localization('famous_attractions', 'other_info', $famous->id, 2, ($request->other_info_ar ? : 'بدون معلومات اضافية'));

        } catch(\Exception $ex){
            Session::flash('warning', 'Arabic Error!');
            return redirect()->back();
        }

        // flash success & redirect ot list page
        Session::flash('success', 'Attraction updated successfully! تم تعديل المزار بنجاح');
        return redirect('/attractions');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $famous = FamousAttraction::find($request->id);

        // detach categories
        $famous->categories()->detach();

        // detach days
        $famous->days()->detach();

        // detach media
        $famous->media()->delete();

        // delete famous attraction
        $famous->delete();

        Session::flash('success', 'Deleted successfully! تم الحذف بنجاح');
        return response()->json(['success' => 'deleted!']);
    }

    public function destroySelected(Request $request)
    {
        foreach($request->ids as $id) {
            $famous = FamousAttraction::find(id);

            // detach categories
            $famous->categories()->detach();

            // detach days
            $famous->days()->detach();

            // detach media
            $famous->media()->delete();

            // delete famous attraction
            $famous->delete();

            Session::flash('success', 'Deleted successfully! تم الحذف بنجاح');
            return response()->json(['success' => 'deleted!']);
        }
    }

    public function filter(Request $request) {
        // dd($request->all());

        $categories = array(); 
        $categories = $request->place_categories;

        // create new object
        $data['attractions'] = new FamousAttraction;

        // search by category
        if( $categories ){
            $data['attractions'] = $data['attractions']->whereHas('categories', function($q) use($categories) {
                $q->whereIn('fa_categories.id', $categories);
            });
        }

        // dd($data['attractions']->get());
        // search by active
        if( $request->is_active && $request->is_inActive ) {
            $data['attractions'] = $data['attractions'];
        }
        else if( $request->is_active ) {
            $data['attractions'] = $data['attractions']->where('is_active', 1);
        } 
        else if ( $request->is_inActive ) {
            // search by inactive
            $data['attractions'] = $data['attractions']->where('is_active', 0);
        }

        $data['categories']  = FamousCategory::all();

        if($data['attractions'] != NULL) {
            $data['attractions'] = $data['attractions']->get();
        } else {
            $data['attractions'] = $data['attractions']->all();
        }

        // return filtered results
        return view('famous::list', $data);
    }
}
