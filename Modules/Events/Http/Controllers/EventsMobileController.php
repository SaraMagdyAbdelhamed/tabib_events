<?php

namespace Modules\Events\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\EventMobile;
use App\EventCategory;
use App\EventTicket;
use App\EventBookingTicket;
use App\EventPost;
use App\EntityLocalization;
use App\Genders;
use App\Age_Ranges;
use App\Currency;
use App\EventHashtags;
use App\Helpers\Helper;
use App\EventMedia;
use App\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Library\Services\NotificationsService;
use Illuminate\Support\Facades\Validator;

class EventsMobileController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */

    private $NotifcationService;

    public function __construct()
    {
        //blockio init
        $this->NotifcationService = new NotificationsService();

    }

    public function index()
    {
        $mobileUser = Helper::hasRule(['Mobile User']);
        if ($mobileUser) {
            $current_events = EventMobile::CurrentEvents()->where('created_by', Auth::id())->get();
            $pending_events = EventMobile::PendingEvents()->where('created_by', Auth::id())->get();
            $rejected_events = EventMobile::EventsRejected()->where('created_by', Auth::id())->get();

        } else {
            $current_events = EventMobile::CurrentEvents()->get();
            $pending_events = EventMobile::PendingEvents()->get();
            $rejected_events = EventMobile::EventsRejected()->get();
        }
        $categories = EventCategory::all();
        return view('events::eventsMobile.list')
                    // ->with('events', EventMobile::MobileApproved()->get());
            ->with(compact('current_events', 'pending_events', 'categories', 'rejected_events'));
    }

    public function event_filter(Request $request)
    {
        if (isset($request->categories)) {
            $data['current_events'] = $events = EventMobile::whereHas('categories', function ($q) use ($request) {
                $q->whereIn('event_categories.interest_id', $request->categories);
                $q->where('is_backend', '=', 0);
                $q->where('event_status_id', 2);

                if (isset($request->startdate_from) && !isset($request->startdate_to)) {

                    $from_date = date('Y-m-d', strtotime($request->startdate_from));
                    $to_date = Carbon::now()->format('Y-m-d');
                    $q->whereBetween('start_datetime', array($from_date, $to_date))->get();
                } elseif (isset($request->startdate_from) && isset($request->startdate_to)) {

                    $from_date = date('Y-m-d', strtotime($request->startdate_from));
                    $to_date = date('Y-m-d', strtotime($request->startdate_to));
                    $q->whereBetween('start_datetime', array($from_date, $to_date))->get();

                }


                if (!isset($request->enddate_from) && isset($request->endtdate_to)) {
                    $from_date = Carbon::now()->format('Y-m-d');
                    $to_date = date('Y-m-d', strtotime($request->endtdate_to));

                    $q->whereBetween('end_datetime', array($from_date, $to_date))->get();
                } elseif (isset($request->enddate_from) && isset($request->enddate_to)) {

                    $from_date = date('Y-m-d', strtotime($request->enddate_from));
                    $to_date = date('Y-m-d', strtotime($request->enddate_to));
                    $q->whereBetween('end_datetime', array($from_date, $to_date))->get();

                }
                $q->whereIn('event_categories.interest_id', $request->categories);
                $q->select('events.*');
                if (isset($request->status)) {
                    $q->whereIn('is_active', $request->status);
                }

                if (Helper::hasRule(['Mobile User'])) {

                    $q->where('created_by', Auth::id());
                }
            })->get();

        } else {
            $data['current_events'] = EventMobile::where(function ($q) use ($request) {
                $q->where('is_backend', '=', 0);
                $q->where('event_status_id', 2);

                if (isset($request->status)) {
                    $q->whereIn('is_active', $request->status);
                }

                if (isset($request->startdate_from) && !isset($request->startdate_to)) {

                    $from_date = date('Y-m-d', strtotime($request->startdate_from));
                    $to_date = Carbon::now()->format('Y-m-d');
                    $q->whereBetween('start_datetime', array($from_date, $to_date))->get();
                } elseif (isset($request->startdate_from) && isset($request->startdate_to)) {

                    $from_date = date('Y-m-d', strtotime($request->startdate_from));
                    $to_date = date('Y-m-d', strtotime($request->startdate_to));
                    $q->whereBetween('start_datetime', array($from_date, $to_date))->get();

                }


                if (!isset($request->enddate_from) && isset($request->endtdate_to)) {
                    $from_date = Carbon::now()->format('Y-m-d');
                    $to_date = date('Y-m-d', strtotime($request->endtdate_to));

                    $q->whereBetween('end_datetime', array($from_date, $to_date))->get();
                } elseif (isset($request->enddate_from) && isset($request->enddate_to)) {

                    $from_date = date('Y-m-d', strtotime($request->enddate_from));
                    $to_date = date('Y-m-d', strtotime($request->enddate_to));
                    $q->whereBetween('end_datetime', array($from_date, $to_date))->get();

                }
                if (Helper::hasRule(['Mobile User'])) {

                    $q->where('created_by', Auth::id());
                }
            })->get();
        }
      // dd($data['current_events']);
        $data['categories'] = EventCategory::all();
        //$data['current_events'] = EventMobile::CurrentEvents()->get();
        $data['pending_events'] = EventMobile::PendingEvents()->get();
        $data['rejected_events'] = EventMobile::EventsRejected()->get();
        return view('events::eventsMobile.list', $data);

    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function view($id)
    {
        $mobileUser = Helper::hasRule(['Mobile User']);
        if ($mobileUser) {
            if (!Helper::hisEvent($id)) {
                return redirect('/events/mobile');
            }
        }
        //INFO
        $data['event'] = EventMobile::find($id);
        $data['categories'] = EventMobile::join('event_categories as c', 'events.id', '=', 'c.event_id')->where(function ($q) use ($id) {
            $q->where('is_backend', '=', 0);
            $q->where('event_status_id', 2);
            $q->where('event_id', $id);
            $q->select('interest_id');
        })->get();
 
       //POSTS
        $data['event_posts'] = EventPost::where('event_id', '=', $id)->get();

        //TICKETS
        $data['tickets'] = EventTicket::where('event_id', '=', $id)->get();
        $data['booked_tickets'] = EventBookingTicket::where('event_id', '=', $id)->get();

        return view('events::eventsMobile.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        // mobile event
        $mobileUser = Helper::hasRule(['Mobile User']);
        if ($mobileUser) {
            if (!Helper::hisEvent($id)) {
                return redirect('/events/mobile');
            }
        }
        $data['event'] = EventMobile::find($id);
        $data['genders'] = Genders::all();
        $data['age_range'] = Age_Ranges::all();
        $data['categories'] = EventCategory::all();
        $data['currencies'] = Currency::all();
        $data['bigEventCount'] = EventMobile::BigEvent($id);
        $data['event_tickets'] = EventTicket::where('event_id', '=', $id)->first();
        $data['event_media'] = EventMedia::where('event_id', '=', $id)->where('type', '=', 2)->get();
        $data['images'] = EventMedia::where('event_id', '=', $id)->where('type', '=', 1)->get();
        $event = EventMobile::find($id);
        $data['event_categories'] = $event->categories()->select('*')->where('event_id', '=', $id)->get();
        $data['arabic_hashtags'] = EntityLocalization::where('entity_id', '=', 4)
            ->where('field', '=', 'hashtag')
            ->where('item_id', '=', $id)
            ->where('lang_id', '=', 2)
            ->get(); 
        //dd($data['arabic_hashtags']);
        return view('events::eventsMobile.edit', $data);
    }


    public function update(Request $request)
    {
        $mobileUser = Helper::hasRule(['Mobile User']);
        if ($mobileUser) {
            if (!Helper::hisEvent($request['event_id'])) {
                return redirect('/events/mobile');
            }
        }
        //dd($request);
        // Validate incoming request inputs with the following validation rules.
        $this->validate($request, [
            'english_event_name' => 'required|min:2|max:100',
            'english_description' => 'required|min:2|max:250',
            // 'lat'                   => 'required|min:2|max:50',
            // 'lng'                   => 'required',
            'english_venu' => 'required',
            'english_hashtags' => 'required',
            'gender' => 'required',
            'age_range' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
            'categories' => 'required',

            'arabic_event_name' => ($request->arabic_event_name ? 'min:2|max:100' : ''),
            'arabic_description' => ($request->arabic_description ? 'required|min:2|max:250' : ''),
            // 'arabic_venu' => 'required|',
            // 'arabic_hashtags' => 'required|',
            'is_paid' => 'required',
            'price' => ($request->price ? 'numeric' : ''),
            'currency' => ($request->currency ? 'numeric' : ''),
            'number_of_tickets' => ($request->number_of_tickets ? 'numeric' : ''),
            //'arabic_hashtags'       => 'required|',
            'is_paid' => 'required',
            'website' => 'required',
            'email' => 'required',
            'code_number' => 'required',
            'mobile_number' => 'required',

            // 'youtube_ar_1'          => 'required|',
            // 'youtube_en_1'          => 'required|',
            // 'youtube_ar_2'          => 'required|',
            // 'youtube_en_2'          => 'required|',
            // 'arabic_images'         => 'mimes:png,jpg|max:1024',
            // 'english_images'        => 'mimes:png,jpg|max:1024',
        ]);

        $imageRules = array(
            'image' => 'image|mimes:png,jpg|max:1024',
        );
 
        // Check if there is any images or files and move them to public/events
        // Arabic Event Images
        if ($request->hasfile('arabic_images')) {
            $imgs_count = count($_FILES['arabic_images']['name']);
            if ($imgs_count > 5) {
                Session::flash('error', 'لم يتم التحديث الحد الاأقصى للصور هو 5 صور');
                return redirect('/events/mobile');
            } else {
                foreach ($request->file('arabic_images') as $image) {
                    $imagev = array('image' => $image);
                    $imageValidator = Validator::make($imagev, $imageRules);
                    if ($imageValidator->fails()) {
                        $messages = $imageValidator->messages();
                        return redirect('/events/mobile')
                            ->withErrors($messages);
                    }
                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/events/arabic', $name);
                    $data_arabic[] = '/public/arabic/' . $name;
                    $media = new EventMedia;
                    $media->event_id = $request['event_id'];
                    $media->link = '/events/arabic/' . $name;
                    $media->type = 1;
                    $media->save();
                }
            }
        }

        // English Event Images
        if ($request->hasfile('english_images')) {
            $imgs_count = count($_FILES['english_images']['name']);
            if ($imgs_count > 5) {
                Session::flash('error', 'لم يتم التحديث الحد الاأقصى للصور هو 5 صور');
                return redirect('/events/mobile');
            } else {
                foreach ($request->file('english_images') as $image) {
                    $imagev = array('image' => $image);
                    $imageValidator = Validator::make($imagev, $imageRules);
                    if ($imageValidator->fails()) {
                        $messages = $imageValidator->messages();
                        return redirect('/events/mobile')
                            ->withErrors($messages);
                    }
                    $name = $image->getClientOriginalName();
                    $image->move(public_path() . '/events/english', $name);
                    $data_english[] = '/public/english/' . $name;

                    $media = new EventMedia;
                    $media->event_id = $request['event_id'];
                    $media->link = '/events/english/' . $name;
                    $media->type = 1;
                    $media->save();
                }
            }
        }

        // Explode english hashtags
        $hashtags = explode(',', $request->english_hashtags);

        // Insert Event in events table
        try {
            //$event = new EventBackend;
            $event = EventMobile::find($request['event_id']);
           // dd($request['event_id']);
            $event->name = $request->english_event_name;
            $event->description = $request->english_description;
            if (isset($request->lng) && isset($request->lat)) {
                $event->longtuide = $request->lng;
                $event->latitude = $request->lat;
                $event->address = $request->address;
            } else {
                $event->longtuide = $event->longtuide;
                $event->latitude = $event->latitude;
                $event->address = $event->address;
            }
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
            // $event->created_by  = Auth::id();
            // TODO: youtube links & images

            $event->Update();

            /**  INSERT English Hashtags **/
            // search if the hashtag is already exists, if exists get its ID, if not exists insert the hashtag into `hash_tags` table and get its id.
            $event->hashtags()->detach();
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

            /** update Categories **/
            //first remove old and records in pivot then insert the new categories
            $event->categories()->detach();
            for ($i = 0; $i < count($request->categories); $i++) {
                $event->categories()->attach($request->categories[$i]);
            }

            /**  Youtube links  **/
           // $event->media()->update(['category_id' => $newCatId]);
            if (!isset($request->youtube_ar_1) && isset($request->youtube_ar_2)) {
                $request->youtube_ar_1 = $request->youtube_en_1;
            } elseif (!isset($request->youtube_ar_2) && isset($request->youtube_ar_1)) {
                $request->youtube_ar_2 = $request->youtube_en_2;
            } elseif (!isset($request->youtube_ar_1) && !isset($request->youtube_ar_2)) {
                $request->youtube_ar_1 = $request->youtube_en_1;
                $request->youtube_ar_2 = $request->youtube_en_2;
            }
            $event->media()->where('type', 2)->delete();
            $event->media()->createMany([
                ['link' => $request->youtube_en_1, 'type' => 2],
                ['link' => $request->youtube_en_2, 'type' => 2],
                ['link' => $request->youtube_ar_1, 'type' => 2],
                ['link' => $request->youtube_ar_2, 'type' => 2],
            ]);

        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error 1');
            return redirect()->back();
        }

        // Insert Arabic localizations
        //remove old one first then insert newer
        Helper::remove_localization(4, 'name', $event->id, 2);
        Helper::remove_localization(4, 'description', $event->id, 2);
        Helper::remove_localization(4, 'venue', $event->id, 2);
        Helper::remove_localization(4, 'hashtag', $event->id, 2);
        try {
            Helper::add_localization(4, 'name', $event->id, $request->arabic_event_name, 2);             // arabic_event_name
            Helper::add_localization(4, 'description', $event->id, $request->arabic_description, 2);             // arabic_description
            Helper::add_localization(4, 'venue', $event->id, $request->arabic_venu, 2);             // arabic_venu

            // Explode hashtags into an array
            $arabic_hashtags = explode(',', $request->arabic_hashtags);
            for ($i = 0; $i < count($arabic_hashtags); $i++) {
                // Add arabic hashtags in entity_localization table
                Helper::add_localization(4, 'hashtag', $event->id, $arabic_hashtags[$i], 2);                        // arabic_hashtags
            }
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error 2');
            return redirect()->back();
        }

        //tickets
        $tickets = EventTicket::where('event_id', '=', $request['event_id'])->first();
        if (!empty($tickets)) {
            $tickets->price = $request->price;
            $tickets->currency_id = $request->currency;
            $tickets->available_tickets = $request->number_of_tickets;
            $tickets->save();
        } else {
            $ticket = new EventTicket;
            $ticket->event_id = $event->id;
            $ticket->name = $request->english_event_name;
            $ticket->price = $request->price;
            $ticket->available_tickets = $request->number_of_tickets;
            $ticket->current_available_tickets = $request->number_of_tickets;
            $ticket->currency_id = $request->currency;
            $ticket->save();
        }

        // flash success message & redirect to list backend events
        Session::flash('success', 'Event updated Successfully! تم تحديث الحدث بنجاح');
        return redirect('/events/mobile');
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('events::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('events::show');
    }




    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    // public function update(Request $request)
    // {
    // }

    /**
     * Accept the specified Event.
     * @param  Id $id
     * @return Response
     */
    public function accept($id)
    {
        $accepted = EventMobile::find($id);
        $accepted->update(['event_status_id' => 2, 'is_active' => 1]);
        $accepted->save();
      //Notify Event Owner about Acceptance
         //get Event Owner
        $event_owner = $accepted->user;
        if ($event_owner) {
            $notification_message['en'] = 'YOUR EVENT IS APPROVED';
            $notification_message['ar'] = 'تم الموافقة على الحدث';
            $notifcation = $this->NotifcationService->save_notification($notification_message, 3, 4, $accepted->id, $event_owner->id);
            $this->NotifcationService->PushToSingleUser($event_owner, $notifcation);
        }
      //get users have this event in their interests
        $this->NotifcationService->EventInterestsPush($accepted);

    }

    /**
     * Accept the Selected Events.
     *
     */

    public function accept_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $accepted = EventMobile::find($id);
            $accepted->update(['event_status_id' => 2]);
            $accepted->save();
          //Notify Each event owner
            $event_owner = $accepted->user;
            if ($event_owner) {
                $notification_message['en'] = 'YOUR EVENT IS APPROVED';
                $notification_message['ar'] = 'تم الموافقة على الحدث';
                $notification = $this->NotifcationService->save_notification($notification_message, 3, 4, $accepted->id, $event_owner->id);
                $this->NotifcationService->PushToSingleUser($event_owner, $notification);
            }
          //get users have this event in their interests
            $this->NotifcationService->EventInterestsPush($accepted);
        }

    }

    public function reject(Request $request)
    {
        $id = $request['event_id'];
        $rejected = EventMobile::find($id);
        $rejected->update(['event_status_id' => 3, 'rejection_reason' => $request['reason']]);
      // arabic rejection reson "instead of these 5 lines later we can create function in EntityLocalization model takes these 4 parameters and return 1"
        $reason_ar = new EntityLocalization;
        $reason_ar->entity_id = 4;
        $reason_ar->field = 'rejection_reason';
        $reason_ar->item_id = $id;
        $reason_ar->value = $request['reason_ar'];
        if ($rejected->save() && $reason_ar->save()) {
            $response = array(
                'status' => 'success',
                'msg' => 'Event rejected successfully',
            );
       //send Notification to Event Owner
            $event_owner = $rejected->user;
            if ($event_owner) {
                $notification_message['en'] = 'YOUR EVENT IS Rejected';
                $notification_message['ar'] = 'لم يتم الموافقة على الحدث';
                $notifcation = $this->NotifcationService->save_notification($notification_message, 4, 4, $rejected->id);
                $this->NotifcationService->PushToSingleUser($event_owner, $notifcation);
            }

      //  return Response::json($response);
            return response()->json($response);  // <<<<<<<<< see this line
        } else {
            $response = array(
                'status' => 'error',
                'msg' => 'Something goes wrong!',
            );
            return response()->json($response);
        }


    }

    public function pending($id)
    {
        $accepted = EventMobile::find($id);
        $accepted->update(['event_status_id' => 1, 'is_active' => 1]);
        $accepted->save();
    }

    public function pending_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $accepted = EventMobile::find($id);
            $accepted->update(['event_status_id' => 1]);
            $accepted->save();
        }

    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $mobileUser = Helper::hasRule(['Mobile User']);
        if ($mobileUser) {
            if (!Helper::hisEvent($id)) {
                return redirect('/events/mobile');
            }
        }

        $event = EventMobile::find($id);
        $event->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            $mobileUser = Helper::hasRule(['Mobile User']);
            if ($mobileUser) {
                if (!Helper::hisEvent($id)) {
                    return redirect('/events/mobile');
                }
            }
            EventMobile::find($id)->delete();
        }
    }

    public function post_destroy($id)
    {
        $event = EventPost::find($id);
        $event->delete();
    }

    public function post_destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            EventPost::find($id)->delete();
        }
    }
}
