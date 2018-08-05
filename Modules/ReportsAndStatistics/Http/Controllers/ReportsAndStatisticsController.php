<?php

namespace Modules\ReportsAndStatistics\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Excel;
use App\Exports\SponsorsExport;
use App\Exports\EventsExport;

use Session;
use App\Users;
use App\Rules;
use App\UserInfo;
use App\EventBackend;
use App\OfferCategory;
use App\Offer;
use App\Category;

class ReportsAndStatisticsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        //all doctors
        $data['doctors'] = Users::whereHas('rules', function ($q) {
            $q->where('rule_id', 2);
        })->count();
        //doctors added by orgnizers
        $ids = Users::whereHas('rules', function ($q) {
            $q->where('rule_id', 5);
        })->pluck('id')->toArray();
        $data['doc_org'] = Users::whereIn('created_by',$ids)->count(); 
        // doctors that created from mobile app
        $data['doc_mob'] = Users::whereHas('rules', function ($q) {
            // filter users through table `user_rules`
            $q->where('rule_id', 2);
        })->whereHas('userInfo', function ($q) {
            $q->where('is_backend', 0);
        })->count();
        //number of all events
        $data['events'] = EventBackend::count();
        //number of events that added by organizers
        $data['event_org'] = EventBackend::whereHas('user', function ($q) {
            $q->whereHas('rules', function ($q) {
                $q->where('rule_id', 5);
            });
        })->count();
        //number of events that added by superadmin
        $data['event_super'] = EventBackend::whereHas('user', function ($q) {
            $q->whereHas('rules', function ($q) {
                $q->where('rule_id', 3);
            });
        })->count();
        return view('reportsandstatistics::index',$data);
    }

    public function sponsor()
    {
        $data['offers'] = Offer::all();
        $data['categories'] = OfferCategory::all();
        $data['sponsors'] = Users::whereHas('rules' , function($q){
            $q->where('rule_id',6);
        })->get();
        return view('reportsandstatistics::sponsor_report',$data);
    }

    public function sponsor_filter(Request $request){
        $data['offers'] = Offer::where(function($q) use($request){
            $start_date = date('Y-m-d H:i:s',strtotime($request->start_date));
            $end_date = date('Y-m-d 23:59:59',strtotime($request->end_date));

            if($request->has('sponsor_name') )
            {
             $q->where('sponsor_id',$request->sponsor_name);;
         }

         if($request->has('offers') )
         {
            $q->whereHas('categories', function ($q) use($request) {
                $q->whereIn('offer_category_id',$request->offers);
            });
        }

        if($request->filled('start_date') && $request->filled('end_date') )
        {
            $q->whereBetween('start_datetime', array($start_date, $end_date));
        }
        elseif($request->filled('start_date'))
        {
            $q->where('start_datetime','>=',$start_date);
        }
        elseif($request->filled('end_date'))
        {
            $q->where('start_datetime','<=',$end_date);
        }



    })->get();

        $data['categories'] = OfferCategory::all();
        $data['sponsors'] = Users::whereHas('rules' , function($q){
            $q->where('rule_id',6);
        })->get();

        foreach($data['offers'] as $offer)
        {
            $filter_ids[]=$offer->id;
        }
        if(!empty($filter_ids))
        {
            Session::flash('filter_ids',$filter_ids);
        }
        else{
            $filter_ids[]=0;
            Session::flash('filter_ids',$filter_ids);
        }

        return view('reportsandstatistics::sponsor_report',$data);

    }


    public function sponsor_excel()
    {   
      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'offers'.time().'.xlsx';
      if(isset($_GET['ids'])){
         $ids = $_GET['ids'];
         Excel::store(new SponsorsExport($ids),$filepath.$filename);
         return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      Excel::store((new SponsorsExport($filters)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
  }
  else{
      Excel::store((new SponsorsExport()),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
  }
}

    // public function getOffer(Request $request){
    //     $offers= OfferCategory::where('created_by', $request->id)->pluck('name', 'id');
    //     return $offers;
    // }

    public function event()
    {
    $data['organizers'] = Users::whereHas('rules' , function($q){
        $q->where('rule_id',5);
    })->get();
    $data['categories'] = EventCategory::all();
    $data['events'] = EventBackend::all() ;
    return view('reportsandstatistics::event_report',$data);
    }

    public function event_filter(Request $request){
        $data['events'] = EventBackend::where(function($q) use($request){
            $start_date = date('Y-m-d H:i:s',strtotime($request->start_date));
            $end_date = date('Y-m-d 23:59:59',strtotime($request->end_date));

            if($request->has('organizer_name') )
            {
             $q->where('created_by',$request->organizer_name);;
         }

         if($request->has('categories') )
         {
            $q->whereHas('categories', function ($q) use($request) {
                $q->whereIn('category_id',$request->categories);
            });
        }

        if($request->filled('start_date') && $request->filled('end_date') )
        {
            $q->whereBetween('start_datetime', array($start_date, $end_date));
        }
        elseif($request->filled('start_date'))
        {
            $q->where('start_datetime','>=',$start_date);
        }
        elseif($request->filled('end_date'))
        {
            $q->where('start_datetime','<=',$end_date);
        }



    })->get();

        $data['organizers'] = Users::whereHas('rules' , function($q){
            $q->where('rule_id',5);
        })->get();
        $data['categories'] = EventCategory::all();

        foreach($data['events'] as $event)
        {
            $filter_ids[]=$event->id;
        }
        if(!empty($filter_ids))
        {
            Session::flash('filter_ids',$filter_ids);
        }
        else{
            $filter_ids[]=0;
            Session::flash('filter_ids',$filter_ids);
        }

        return view('reportsandstatistics::event_report',$data);

    }

        public function event_excel()
    {   
      $filepath ='public/excel/';
      $PathForJson='storage/excel/';
      $filename = 'events'.time().'.xlsx';
      if(isset($_GET['ids'])){
         $ids = $_GET['ids'];
         Excel::store(new EventsExport($ids),$filepath.$filename);
         return response()->json($PathForJson.$filename);
     }
     elseif ($_GET['filters']!='') {
      $filters = json_decode($_GET['filters']);
      Excel::store((new EventsExport($filters)),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
  }
  else{
      Excel::store((new EventsExport()),$filepath.$filename);
      return response()->json($PathForJson.$filename); 
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('reportsandstatistics::create');
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
        return view('reportsandstatistics::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('reportsandstatistics::edit');
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
