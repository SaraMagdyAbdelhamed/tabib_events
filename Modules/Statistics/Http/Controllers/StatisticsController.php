<?php

namespace Modules\Statistics\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Users;
use App\Helpers\Helper;
class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
      $data['allUsers_no'] = Users::count();
      $data['maleUsers_no'] = Users::where('gender_id',1)->count();
      $data['femaleUsers_no'] = Users::where('gender_id',2)->count();
      $user = Users::find(45);
      // dd( date('Y-m-d', strtotime($user->birthdate)));
      $data['kids'] = Helper::ageRange_count(0,15);
      $data['age15_18'] = Helper::ageRange_count(15,18);
      $data['age18_25'] = Helper::ageRange_count(18,25);
      $data['age18_25'] = Helper::ageRange_count(18,25);
      $data['age25_120'] = Helper::ageRange_count(25,120);
     // dd(Carbon::parse($user->birthdate)->age);
        return view('statistics::index',$data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('statistics::create');
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
        return view('statistics::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('statistics::edit');
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
