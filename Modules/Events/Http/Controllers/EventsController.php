<?php

/**
 *  Author:  Ahmed Yacoub
 *  Email:   ahmed.yacoub@outlook.com
 *  Date: May 1, 2018
 */

namespace Modules\Events\Http\Controllers;

use Helper;
use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\EventBackend;
use App\Genders;
use App\Age_Ranges;
use App\EventCategory;
use App\Currency;
use App\EventHashtags;
use App\BigEvent;
use App\Library\Services\NotificationsService;
use App\EventMedia;
use App\EventTicket;
use App\EventPost;
use App\EventBookingTicket;


class EventsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $NotifcationService;

    public function __construct()
    {
            //blockio init
        $this->NotifcationService = new NotificationsService();

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('events::backend')
            ->with('events', EventBackend::where('is_backend', 1)->get())
            ->with('categories', EventCategory::all());
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data['genders'] = Genders::all();
        $data['age_range'] = Age_Ranges::all();
        $data['categories'] = EventCategory::all();
        $data['currencies'] = Currency::all();

        return view('events::create', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // return response()->json(['data' => $request->all()]);
        // dd($request->all());
        // dd($_FILES);

        // Validate incoming request inputs with the following validation rules.
        $this->validate($request, [
            'english_event_name' => 'required|min:2|max:100',
            'english_description' => 'required|min:2|max:250',
            'lat' => 'required',
            'lng' => 'required',
            'english_venu' => 'required|min:2|max:50',
            'english_hashtags' => 'required',
            'gender' => 'required',
            'age_range' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'categories' => 'required',

            'arabic_event_name' => ($request->arabic_event_name ? 'min:2|max:100' : ''),
            'arabic_description' => ($request->arabic_description ? 'min:2|max:250' : ''),
            // 'arabic_venu' => 'required|',
            // 'arabic_hashtags' => 'required|',

            'is_paid' => 'required',
            'price' => ($request->price ? 'sometimes|numeric' : ''),
            'currency' => ($request->currency ? 'sometimes|numeric' : ''),
            'number_of_tickets' => ($request->number_of_tickets ? 'numeric' : ''),

            'website' => 'required',
            'email' => 'required',
            'code_number' => 'required',
            'mobile_number' => 'required',

            // 'youtube_ar_1' => 'required|',
            // 'youtube_en_1' => 'required|',
            // 'youtube_ar_2' => 'required|',
            // 'youtube_en_2' => 'required|',
            // 'arabic_images'         => 'max:5',
            // 'arabic_images.*'       => 'max:5',
            // 'english_images'        => 'max:5',
            // 'english_images.*'      => 'max:5'
        ]);


        // Insert Event in events table
        try {
            $event = new EventBackend;

            $event->name = $request->english_event_name;
            $event->description = $request->english_description;
            $event->longtuide = $request->lng;
            $event->latitude = $request->lat;
            $event->address = $request->address;
            $event->venue = $request->english_venu;

            $event->age_range_id = $request->age_range;
            $event->gender_id = $request->gender;

            // concatinate start_date + start_time to make them start_datetime
            $event->start_datetime = date('Y-m-d', strtotime($request->start_date)) . ' ' . date('h:i:s', strtotime($request->start_time));

            // concatinate end_date + end_time to make them end_datetime
            $event->end_datetime = date('Y-m-d', strtotime($request->end_date)) . ' ' . date('h:i:s', strtotime($request->end_time));

            $event->suggest_big_event = $request->is_big_event ? : 0;   // check if value is missing then replace it with zero
            $event->is_active = $request->is_active ? : 0;            // check if value is missing then replace it with zero

            $event->is_paid = $request->is_paid;

            $event->website = $request->website;
            $event->email = $request->email;
            $event->code = $request->code_number;
            $event->mobile = $request->mobile_number;
            $event->created_by = Auth::id();

            $event->save();

            /**  INSERT English Hashtags **/
            // Explode english hashtags
            $hashtags = explode(',', $request->english_hashtags);

            // search if the hashtag is already exists, if exists get its ID, if not exists insert the hashtag into `hash_tags` table and get its id.
            for ($i = 0; $i < count($hashtags); $i++) {
                // insert hashtag into `hash_tag` table only if it isn't exists.
                if (EventHashtags::where('name', '=', $hashtags[$i])->first() == null) {
                    $hash = new EventHashtags;
                    $hash->name = $hashtags[$i];
                    $hash->save();
                }

                $id = EventHashtags::where('name', '=', $hashtags[$i])->first()->id;    // get hashtage id from `hash_tag` table

                // attach event's hashtags with
                $event->hashtags()->attach($id);
            }

            /**  INSERT Categories **/
            for ($i = 0; $i < count($request->categories); $i++) {
                $event->categories()->attach($request->categories[$i]);
            }

            /**  Youtube links  **/
            $event->media()->createMany([
                ['link' => ($request->youtube_en_1 ? : ''), 'type' => 2],
                ['link' => ($request->youtube_en_2 ? : ''), 'type' => 2],
                ['link' => ($request->youtube_ar_1 ? : ''), 'type' => 2],
                ['link' => ($request->youtube_ar_2 ? : ''), 'type' => 2],
            ]);

            // Check if there is any images or files and move them to public/events
            // Arabic Event Images
            if ($request->hasfile('arabic_images')) {

                // Setup every image
                foreach ($request->file('arabic_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('events/arabic', $name);
                    $data_arabic[] = 'events/arabic/' . $name;
                }

                /** Arabic Images **/
                if (isset($data_arabic) && !empty($data_arabic)) {
                    foreach ($data_arabic as $img_ar) {
                        $media = new EventMedia;

                        $media->event_id = $event->id;
                        $media->link = $img_ar;
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
                    $image->move('events/english', $name);
                    $data_english[] = 'events/english/' . $name;
                }

                /** English Images **/
                if (isset($data_english) && !empty($data_english)) {
                    foreach ($data_english as $img_en) {
                        $media = new EventMedia;

                        $media->event_id = $event->id;
                        $media->link = $img_en;
                        $media->type = 1;
                        $media->save();
                    }
                }

            }

            if (!$request->hasfile('arabic_images') || !$request->hasfile('english_images')) {
                $default = new EventMedia;
                $default->event_id = $event->id;
                $default->link = 'events/default/events.png';
                $default->type = 1;
                $default->save();
            }

            /** Ticket price **/
            if ($request->is_paid == 1) {
                try {
                    $ticket = new EventTicket;
                    $ticket->event_id = $event->id;
                    $ticket->name = 'default';
                    $ticket->price = $request->price;
                    $ticket->available_tickets = $request->number_of_tickets;
                    $ticket->current_available_tickets = $request->number_of_tickets;
                    $ticket->currency_id = $request->currency;
                    $ticket->save();
                } catch (\Exception $ex) {
                    Session::flash('warning', 'price error!');
                    return redirect()->back();
                }
            }


        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error 1');
            return redirect()->back();
        }

        // Insert Arabic localizations
        try {
            Helper::add_localization(4, 'name', $event->id, ($request->arabic_event_name ? : 'بدون اسم'), 2);             // arabic_event_name
            Helper::add_localization(4, 'description', $event->id, ($request->arabic_description ? : 'بدون وصف'), 2);     // arabic_description
            Helper::add_localization(4, 'venue', $event->id, ($request->arabic_venu ? : 'بدون عنوان'), 2);                  // arabic_venu

            // Explode hashtags into an array
            if (isset($request->arabic_hashtags) && !empty($request->arabic_hashtags)) {
                $arabic_hashtags = explode(',', $request->arabic_hashtags);
                for ($i = 0; $i < count($arabic_hashtags); $i++) {
                    // Add arabic hashtags in entity_localization table
                    Helper::add_localization(17, 'hash_tags', $event->id, $arabic_hashtags[$i], 2);                        // arabic_hashtags
                }
            }

        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error 2');
            return redirect()->back();
        }

        //Push Notifcations to users about this event
        $this->NotifcationService->EventInterestsPush($event);

        // flash success message & redirect to list backend events
        Session::flash('success', 'Event Added Successfully! تم إضافة الحدث بنجاح');
        return redirect('/events/backend');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($id)
    {
        $data['event'] = EventBackend::find($id);

        // redirect back if not found!
        if ( $data['event'] == NULL ) {
            Session::flash('warning', 'Not found! غير موجود');
            return redirect('/events/backend');
        }

        if( $data['event']->is_backend != 1 ) {
            Session::flash('warning', 'Not found! غير موجود');
            return redirect('/events/backend');
        } 

        //TICKETS
        $data['tickets'] = EventTicket::where('event_id', '=', $id)->get();
        $data['booked_tickets'] = EventBookingTicket::where('event_id', '=', $id)->get();

        return view('events::backend_event_show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $data['event'] = EventBackend::find($id);

        // redirect back if not found!
        if ( $data['event'] == NULL ) {
            Session::flash('warning', 'Not found! غير موجود');
            return redirect('/events/backend');
        }
        
        $data['genders'] = Genders::all();
        $data['age_range'] = Age_Ranges::all();
        $data['categories'] = EventCategory::all();
        $data['currencies'] = Currency::all();
        $data['ticket'] = EventTicket::where('event_id', $id)->first();

        $data['youtube_links'] = isset($data['event']->media) ? $data['event']->media()->where('type', 2)->get() : '';
        $data['arabic_images'] = isset($data['event']->media) ? $data['event']->media()->where('type', 1)->where('link', 'like', '%arabic%')->get() : '';
        $data['english_images'] = isset($data['event']->media) ? $data['event']->media()->where('type', 1)->where('link', 'like', '%english%')->get() : '';
        $data['default_image'] = 'events/default/events.png';

        return view('events::backend_event_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
        // return response()->json(['data' => $request->all()]);
        // dd($request->all());
        // dd($_FILES);

        // Validate incoming request inputs with the following validation rules.
        $this->validate($request, [
            'english_event_name' => 'required|min:2|max:100',
            'english_description' => 'required|min:2|max:250',
            'lat' => 'required',
            'lng' => 'required',
            'english_venu' => 'required|min:2|max:50',
            'english_hashtags' => 'required',
            'gender' => 'required',
            'age_range' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'categories' => 'required',

            'arabic_event_name' => ($request->arabic_event_name ? 'min:2|max:100' : ''),
            'arabic_description' => ($request->arabic_description ? 'sometimes|min:2|max:250' : ''),
            // 'arabic_venu' => 'required|',
            // 'arabic_hashtags' => 'required|',

            'is_paid' => 'required',
            'price' => ($request->price ? 'sometimes|numeric' : ''),
            'currency' => ($request->currency ? 'sometimes|numeric' : ''),
            'number_of_tickets' => ($request->number_of_tickets ? 'numeric' : ''),

            'website' => 'required',
            'email' => 'required',
            'code_number' => 'required',
            'mobile_number' => 'required',

            // 'youtube_ar_1' => 'required|',
            // 'youtube_en_1' => 'required|',
            // 'youtube_ar_2' => 'required|',
            // 'youtube_en_2' => 'required|',
            // 'arabic_images'         => 'max:5',
            // 'arabic_images.*'       => 'max:5',
            // 'english_images'        => 'max:5',
            // 'english_images.*'      => 'max:5'
        ]);


        // Insert Event in events table
        try {
            $event = EventBackend::find($request->id);

            $event->name = $request->english_event_name;
            $event->description = $request->english_description;
            $event->longtuide = $request->lng;
            $event->latitude = $request->lat;
            $event->address = $request->address;
            $event->venue = $request->english_venu;

            $event->age_range_id = $request->age_range;
            $event->gender_id = $request->gender;

            // concatinate start_date + start_time to make them start_datetime
            $event->start_datetime = date('Y-m-d', strtotime($request->start_date)) . ' ' . date('h:i:s', strtotime($request->start_time));

            // concatinate end_date + end_time to make them end_datetime
            $event->end_datetime = date('Y-m-d', strtotime($request->end_date)) . ' ' . date('h:i:s', strtotime($request->end_time));

            $event->suggest_big_event = $request->is_big_event ? : 0;   // check if value is missing then replace it with zero
            $event->is_active = $request->is_active ? : 0;            // check if value is missing then replace it with zero

            $event->is_paid = $request->is_paid;

            $event->website = $request->website;
            $event->email = $request->email;
            $event->code = $request->code_number;
            $event->mobile = $request->mobile_number;
            $event->updated_by = Auth::id();

            $event->save();


            /**  INSERT English Hashtags **/
            // remove old hashtags
            $event->hashtags()->detach();

            // Explode english hashtags
            $hashtags = explode(',', $request->english_hashtags);

            // search if the hashtag is already exists, if exists get its ID, if not exists insert the hashtag into `hash_tags` table and get its id.
            for ($i = 0; $i < count($hashtags); $i++) {
                // insert hashtag into `hash_tag` table only if it isn't exists.
                if (EventHashtags::where('name', '=', $hashtags[$i])->first() == null) {
                    $hash = new EventHashtags;
                    $hash->name = $hashtags[$i];
                    $hash->save();
                }

                $id = EventHashtags::where('name', '=', $hashtags[$i])->first()->id;    // get hashtage id from `hash_tag` table

                // attach event's hashtags with
                $event->hashtags()->attach($id);
            }

            /**  INSERT Categories **/
            // remove old categories
            $event->categories()->detach();

            // add new categories
            for ($i = 0; $i < count($request->categories); $i++) {
                $event->categories()->attach($request->categories[$i]);
            }

            /**  Youtube links  **/
            $event->media()->where('type', 2)->delete();
            $event->media()->createMany([
                ['link' => ($request->youtube_en_1 ? : ''), 'type' => 2],
                ['link' => ($request->youtube_en_2 ? : ''), 'type' => 2],
                ['link' => ($request->youtube_ar_1 ? : ''), 'type' => 2],
                ['link' => ($request->youtube_ar_2 ? : ''), 'type' => 2],
            ]);

            // Check if there is any images or files and move them to public/events
            // Arabic Event Images
            if ($request->hasfile('arabic_images')) {

                // Delete old arabic images
                $event->media()->where('type', 1)->where('link', 'like', '%arabic%')->delete();

                foreach ($request->file('arabic_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('events/arabic', $name);
                    $data_arabic[] = 'events/arabic/' . $name;
                }

                /** Arabic Images **/
                if (isset($data_arabic) && !empty($data_arabic)) {
                    foreach ($data_arabic as $img_ar) {
                        $media = new EventMedia;

                        $media->event_id = $event->id;
                        $media->link = $img_ar;
                        $media->type = 1;
                        $media->save();
                    }
                }
            }
            
            // English Event Images
            if ($request->hasfile('english_images')) {

                // Delete old english images
                $event->media()->where('type', 1)->where('link', 'like', '%english%')->delete();

                foreach ($request->file('english_images') as $image) {
                    $name = time() . '_' . $image->getClientOriginalName();
                    $image->move('events/english', $name);
                    $data_english[] = 'events/english/' . $name;
                }
                /** English Images **/
                if (isset($data_english) && !empty($data_english)) {
                    foreach ($data_english as $img_en) {
                        $media = new EventMedia;

                        $media->event_id = $event->id;
                        $media->link = $img_en;
                        $media->type = 1;
                        $media->save();
                    }
                }
            }

            /** Ticket price **/
            if ($request->is_paid == 1) {

                if (EventTicket::where('event_id', $event->id)->first() != null) {
                    $ticket = EventTicket::where('event_id', $event->id)->first();
                } else {
                    $ticket = new EventTicket;
                }

                $ticket->event_id = $request->id;
                $ticket->name = $request->english_event_name;
                $ticket->price = $request->price;
                $ticket->available_tickets = $request->number_of_tickets;
                $ticket->current_available_tickets = $request->number_of_tickets;
                $ticket->currency_id = $request->currency;
                $ticket->save();
            }

        } catch (\Exception $ex) {
            Session::flash('warning', 'Error 1');
            return redirect()->back();
        }

        // Insert Arabic localizations
        try {
            Helper::edit_entity_localization('events', 'name', $event->id, 2, $request->arabic_event_name);             // arabic_event_name
            Helper::edit_entity_localization('events', 'description', $event->id, 2, $request->arabic_description);             // arabic_description
            Helper::edit_entity_localization('events', 'venue', $event->id, 2, $request->arabic_venu);             // arabic_venu

            // remove old hashtags localizations
            Helper::remove_localization(17, 'hash_tags', $event->id, 2);

            // Explode hashtags into an array
            $arabic_hashtags = explode(',', $request->arabic_hashtags);
            for ($i = 0; $i < count($arabic_hashtags); $i++) {
                // Add arabic hashtags in entity_localization table
                Helper::add_localization(17, 'hash_tags', $event->id, $arabic_hashtags[$i], 2);                        // arabic_hashtags
            }
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error 2');
            return redirect()->back();
        }

        // flash success message & redirect to list backend events
        Session::flash('success', 'Event Added Successfully! تم إضافة الحدث بنجاح');
        return redirect('/events/backend');
    }

    /**
     * Remove the specified resource from storage.
     * @param $request  an object of the incoming request.
     * @return Response
     */
    public function destroy(Request $request)
    {
        // find that record
        $event = EventBackend::find($request->id);

        $event->media()->delete();          // delete english & arabic youtube links
        $event->hashtags()->detach();       // delete hashtags
        $event->categories()->detach();     // delete categories
        $event->delete();                   // delete events

        Session::flash('success', 'Event deleted successfully! تم مسح الحدث بنجاح');
        return response()->json(['success', 'event deleted!']);
    }


    /**
     * Delete multi records using AJAX
     * @param $request  an object of the incoming request.
     * @return Response
     */
    public function destroySelected(Request $request)
    {

        foreach ($request->ids as $id) {
            // find that record
            $event = EventBackend::find($id);

            // delete english images or files

            // delete arabic images or files

            $event->media()->delete();          // delete english & arabic youtube links
            $event->hashtags()->detach();       // delete hashtags
            $event->categories()->detach();     // delete categories
            $event->delete();                   // delete events
        }

        Session::flash('success', 'Event deleted successfully! تم مسح الحدث بنجاح');
        return response()->json(['success', 'event deleted!']);
    }

    public function filter(Request $request)
    {
        // dd($request->all());
        $events = new EventBackend;
        $flag = 0;

        // category
        if (isset($request->categories) && !empty($request->categories)) {
            $flag = 1;
            $cats = $request->categories;
            $events = $events->whereHas('categories', function ($q) use ($cats) {
                $q->whereIn('event_categories.interest_id', $cats);
            });
        }

        // active
        if ($request->active == 1 && !isset($request->inactive)) {
            $flag = 1;
            $events = $events->where('is_active', 1);
        } else
            if ($request->active == null && $request->inactive == 1) {
            $flag = 1;
            $events = $events->where('is_active', 0);
        }

        // start datetime
        if (isset($request->start_from) && !empty($request->start_from)) {
            $flag = 1;
            $Datetime = date('Y-m-d', strtotime($request->start_from));
            $events = $events->where('start_datetime', '>=', $Datetime);
        }

        if (isset($request->start_to) && !empty($request->start_to)) {
            $flag = 1;
            $Datetime = date('Y-m-d', strtotime($request->start_to));
            $events = $events->where('start_datetime', '<=', $Datetime);
        }



        // end datetime
        if (isset($request->end_from) && !empty($request->end_from)) {
            $flag = 1;
            $Datetime = date('Y-m-d', strtotime($request->end_from));
            $events = $events->where('end_datetime', '>=', $Datetime);
        }

        if (isset($request->end_to) && !empty($request->end_to)) {
            $flag = 1;
            $Datetime = date('Y-m-d', strtotime($request->end_to));
            $events = $events->where('end_datetime', '<=', $Datetime);
        }

        if ($flag == 0) {
            $events = $events->all();
        } else {
            $events = $events->get();
        }

        $data['categories'] = EventCategory::all();
        return view('events::backend', $data)->with('events', $events);
    }

    //Big Events
    public function big_events()
    {
        return view('events::big_events')
            ->with('events', EventBackend::all())->with('big_events', BigEvent::orderBy('sort_order', 'asc')->get());

    }

    public function bigevents_post(Request $request)
    {
        $ids = $request['big_events'];
        $ids_array = array();

        foreach ($ids as $order => $id) {
            $bigevent = BigEvent::where('event_id', $id)->first();
            if ($bigevent) {
                $bigevent->sort_order = $order + 1;
                $bigevent->save();
            } else {
                $bigevent = new BigEvent;
                $bigevent->event_id = $id;
                $bigevent->sort_order = $order + 1;
                $bigevent->save();
            }
            array_push($ids_array, $id);

        }
        //delete old events which are not found in new selected ones
        BigEvent::whereNotIn('event_id', $ids_array)->delete();
        //return response()->json(lang('keywords.orderSaved'));
        return response()->json(trans('keywords.orderSaved'));
    }

    public function bigevents_select($value, Request $request)
    {
        if ($value == 2) {
            $events = EventBackend::where('is_active', '=', 1)->where('suggest_big_event', '=', 1)->get();
        } else {
            $events = EventBackend::where('is_active', '=', 1)->get();

        }
        $options = array();
        foreach ($events as $k => $v) {
            $options[$k] = '<option value="' . $v->id . '" onclick="saveSort()">' . $v->nameMultilang . '</option>';
        }
        //dd(response()->json($options));
        return response()->json($options);
            // ->with('categories', EventCategory::all());
    }

    public function bigevents_post_old(Request $request)
    {
        $ids = $request['big_events'];
        BigEvent::truncate();
        foreach ($ids as $order => $id) {
            $bigevent = new BigEvent;
            $bigevent->event_id = $id;
            $bigevent->sort_order = $order + 1;
            $bigevent->save();
        }
        return response()->json($ids);
    }


}
