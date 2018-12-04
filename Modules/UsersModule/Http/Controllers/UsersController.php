<?php

namespace Modules\UsersModule\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Session;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Countries;
use App\Cities;
use App\Users;
use App\Rules;
use App\UserInfo;
use App\DoctorSpecialization;
use App\SponsorCategory;
use App\GeoRegion;
// use App\Age_Ranges;

class UsersController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
       
    }

    public function index_backend()
    {
        // check current usere rule that based on it, filter backend-users will work as follows: 
        if (Auth::user()->isSuperAdmin()) {
            $rule_names = ['Backend User', 'Data Entry', 'Organizer', 'Sponsor', 'Admin Doctor'];   // Current user is Super Admin, it will list Super Admins, Admins and data entry
        } else if (Auth::user()->isAdmin()) {                     // Current user is Admin it will list Admins & Data entry only
            $rule_names = ['Backend User', 'Data Entry', 'Organizer', 'Sponsor', 'Admin Doctor'];
        } else {
            $rule_names = ['Organizer', 'Sponsor', 'Data Entry'];                           // else it will list data entry only
        }

        $data['users'] = Users::whereHas('rules', function ($q) use ($rule_names) {
            $q->whereIn('rules.name', $rule_names);
        })->get();

        $rules = Auth::user()->rules->last()->id == 3 ? [1, 3, 4, 5, 6, 7] : [1, 4, 5, 6, 7];
        $data['rules'] = Rules::whereIn('id', $rules)->get();
        return view('usersmodule::backend.backend_users', $data);
    }

    public function test()
    {
        $users = Users::find(5);
        $rules = $users->rules->toArray();
        var_dump($rules);

    }

    public function mobile_status(Request $request, $id)
    {
        $user = Users::find($id);
        $user->is_active = $request->is_active;
        $user->save();
        return redirect()->back()->with('success', 'تم تغيير الحاله بنجاح');
    }

    public function mobile_filter(Request $request)
    {
        $data['mobiles'] = Users::where(function ($q) use ($request) {
            $q->whereHas('rules', function ($q) {
                $q->where('rule_id', 2);
            });

            if (isset($request->countries)) {
                $q->whereIn('country_id', $request->countries);
            }
            if (isset($request->cities)) {
                $q->whereIn('city_id', $request->cities);
            }
            // if (isset($request->age)) {
            //     $range = Age_Ranges::find($request->age);
            //     $to = date('Y') - $range->from;
            //     $from = date('Y') - $range->to;
            //     $to_date = date("$to-12-31 23:59:59");
            //     $from_date = date("$from-01-01 00:00:00");
            //     $q->whereBetween('birthdate', array($from_date, $to_date))->get();
            // }

            if (isset($request->gender)) {
                $q->whereIn('gender_id', $request->gender);
            }

        })->get();

        $data['countries'] = Countries::all();
        $data['cities'] = Cities::all();
        // $data['age_ranges'] = Age_Ranges::all();

        return view('usersmodule::mobile.mobile_users', $data);
        // return redirect()->back()
        //             ->with('mobiles', $data['mobiles'])
        //             ->with('countries', $data['countries'])
        //             ->with('cities', $data['cities'])
        //             ->with('age_ranges', $data['age_ranges']);   
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('usersmodule::create');
    }

    /** Show insert form */
    public function backend_create()
    {
        $data['userTypes'] = Rules::all();
        $data['sponsorCategories'] = SponsorCategory::all();
        $data['cities'] = Cities::all();
        $data['regions']= GeoRegion::all();
        $data['specs'] = DoctorSpecialization::all();

        return view('usersmodule::backend.addBackEndUser', $data);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function backend_store(Request $request)
    {
        // dd($request->all());

        $this->validate($request, [
            'user_type' => 'required',
            'fullname'  => 'required',
            'username'  => 'required|unique:users',
            'email'     => 'required|email',
            'address'   => 'required',
            'password'  => 'required',
            'mobile'    => 'required',
            'categories'=> '',
            'cities'    => '',
            'regions'   => '',
            'user_photo'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'activation'=> '',
            'notification' => '',
        ]);

        try {
            $user = new Users;

            $user->first_name = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->mobile = $request->phone;
            $user->is_active = $request->status;
            
            if ($request->hasFile('user_photo')) {
                $destinationPath = 'backend_users';
                $fileNameToStore = $destinationPath . '/' . $request->name . time() . rand(111, 999) . '.' . Input::file('user_photo')->getClientOriginalExtension();
                Input::file('user_photo')->move($destinationPath, $fileNameToStore);
                $user->photo = $fileNameToStore;
            }

            $user->save();
            $user->rules()->attach([$request->user_type, 1]);

            $userInfo = new UserInfo;
            $userInfo->user_id = $user->id;
            $userInfo->address = $request->address;
            // $userInfo->city_id = $request->
            $userInfo->save();

            // TODO: NOTIFICATIONS

        } catch(Exception $ex) {
            Session::flash('warning', 'Can not add backend user لا يمكن اضافة المستخدم');
            return redirect()->back();
        }

        return redirect("/users_backend");
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('usersmodule::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */

    public function backend_edit(Users $user)
    {
        $data['user']=$user;
        $data['rule_id'] = $user->rules()->where('rule_id','!=',1)->first()->id;
        $data['address'] = ($user->userInfo) ? $user->userInfo->adderss : "";
        $data['userTypes'] = Rules::all();
        $data['sponsorCategories'] = SponsorCategory::all();
        $data['cities'] = Cities::all();
        $data['regions']= GeoRegion::all();
        $data['specs'] = DoctorSpecialization::all();

        return view('usersmodule::backend.editBackEndUser', $data);
    }

    /**
     * Update User
     * 
     *  */
    public function backend_update(Users $user, Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'firstName' => 'required|min:3|max:100',
        //     // 'lastName'  => 'required|min:3|max:100',
        //     'username' => 'required|min:3|max:100|unique:users,deleted_at',
        //     'rule' => 'required',
        //     // 'password'  => 'required|min:6|confirmed',
        //     // 'password_confirmation' => 'required|min:6',
        //     'email' => 'required|email|max:40',
        //     'phone' => 'required|digits_between:1,14',
        //     'image' => 'image|mimes:jpg,jpeg,png|max:5120',
        // ]);

        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }
        // $user = Users::find($id);
        // if ($request->hasFile('image')) {
        //     $destinationPath = 'backend_users';
        //     $fileNameToStore = $destinationPath . '/' . $request->username . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
        //     File::delete($user->photo);
        //     Input::file('image')->move($destinationPath, $fileNameToStore);
        //     $user->photo = $fileNameToStore;
        // }

        // $user->first_name = $request->firstName;
        // $user->last_name = $request->lastName;
        // $user->username = $request->username;
        // $user->email = $request->email;
        // // $user->password     = bcrypt($request->password);
        // $user->mobile = $request->phone;
        // $user->is_active = $request->status;
        // $user->save();
        // $user->rules()->detach();
        // $user->rules()->attach([$request->rule, 1]);

        // if ($user->id == Auth::id()) {
        //     Auth::logout();
        //     return redirect('/login');
        // }
        $this->validate($request, [
            'user_type' => 'required',
            'fullname'  => 'required',
            'address'   => 'required',
            'password'  => 'required',
            'mobile'    => 'required',
            'categories'=> '',
            'cities'    => '',
            'regions'   => '',
            'user_photo'=> 'required|image|mimes:jpeg,png,jpg|max:2048',
            'activation'=> '',
            'notification' => '',
        ]);
        try {

            $user->first_name = $request->fullname;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->mobile = $request->phone;
            $user->is_active = ($request->activation == 1) ? 1:0;
            
            if ($request->hasFile('user_photo')) {
                $destinationPath = 'backend_users';
                $fileNameToStore = $destinationPath . '/' . $request->name . time() . rand(111, 999) . '.' . Input::file('user_photo')->getClientOriginalExtension();
                Input::file('user_photo')->move($destinationPath, $fileNameToStore);
                $user->photo = $fileNameToStore;
            }

            $user->save();
            $user->rules()->detach();
            $user->rules()->attach([$request->user_type, 1]);

            if($user->info)
            {
                $user->userInfo->address = $request->address;
                // $userInfo->city_id = $request->
                $user->info->save();
    
            }else{
                $userInfo = new UserInfo;
                $userInfo->user_id = $user->id;
                $userInfo->address = $request->address;
                $userInfo->save();

            }

            // TODO: NOTIFICATIONS

        } catch(Exception $ex) {
            Session::flash('warning', 'Can not add backend user لا يمكن اضافة المستخدم');
            return redirect()->back();
        }
        return redirect("/users_backend");
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
    public function destroy(Request $request)
    {
        $user = Users::find($request->id);
        $user->userInfo()->delete();
        $user->delete();

        return response()->json(['success', 'User deleted!']);
    }

    public function destroy_all(Request $request)
    {
        foreach ($request->ids as $id) {
            $user = Users::find($id);
            $user->userInfo()->delete();
            $user->save();
        }

        return response()->json(['success', 'Users deleted!']);
    }

}
