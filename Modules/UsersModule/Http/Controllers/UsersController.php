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

use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use App\Countries;
use App\Cities;
use App\Users;
use App\Rules;
use App\Age_Ranges;

class UsersController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data['mobiles'] = Users::whereHas('rules', function ($q) {
            $q->where('rule_id', 2);
        })->get();
        $data['countries'] = Countries::all();
        $data['cities'] = Cities::all();
        $data['age_ranges'] = Age_Ranges::all();
        return view('usersmodule::mobile_users', $data);
    }

    public function index_backend()
    {
        // check current usere rule that based on it, filter backend-users will work as follows: 
        if (Auth::user()->isSuperAdmin()) {
            $rule_names = ['Super Admin', 'Admin', 'Data Entry'];   // Current user is Super Admin, it will list Super Admins, Admins and data entry
        } else if (Auth::user()->isAdmin()) {                     // Current user is Admin it will list Admins & Data entry only
            $rule_names = ['Admin', 'Data Entry'];
        } else {
            $rule_names = ['Data Entry'];                           // else it will list data entry only
        }

        $data['users'] = Users::whereHas('rules', function ($q) use ($rule_names) {
            $q->whereIn('rules.name', $rule_names);
        })->get();

        $rules = Auth::user()->rules->last()->id == 3 ? [3, 4, 5] : [4, 5];
        $data['rules'] = Rules::whereIn('id', $rules)->get();
        return view('usersmodule::backend_users', $data);
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
            if (isset($request->age)) {
                $range = Age_Ranges::find($request->age);
                $to = date('Y') - $range->from;
                $from = date('Y') - $range->to;
                $to_date = date("$to-12-31 23:59:59");
                $from_date = date("$from-01-01 00:00:00");
                $q->whereBetween('birthdate', array($from_date, $to_date))->get();
            }

            if (isset($request->gender)) {
                $q->whereIn('gender_id', $request->gender);
            }

        })->get();

        $data['countries'] = Countries::all();
        $data['cities'] = Cities::all();
        $data['age_ranges'] = Age_Ranges::all();

        return view('usersmodule::mobile_users', $data);
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

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function backend_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|min:3|max:100',
            // 'lastName'  => 'required|min:3|max:100',
            'username'  => 'required|min:3|max:100|unique:users,deleted_at',
            'rule'      => 'required',
            // 'password'  => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required|min:6',
            'email'     => 'required|email|max:40',
            'phone'     => 'required|digits_between:1,14',
            'image'     => 'required|image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect('/users_backend#popupModal_1')
                ->withErrors($validator)
                ->withInput();
        }

        $user = new Users;

        if ($request->hasFile('image')) {
            $destinationPath = 'backend_users';
            $fileNameToStore = $destinationPath . '/' . $request->name . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
            // dd($fileNameToStore);
            Input::file('image')->move($destinationPath, $fileNameToStore);
            $user->photo = $fileNameToStore;
        }

        $user->first_name   = $request->firstName;
        $user->last_name    = $request->lastName; 
        $user->username     = $request->username;
        $user->email        = $request->email;
        $user->password     = bcrypt($request->password);
        $user->mobile       = $request->phone;
        $user->is_active    = $request->status;
        $user->save();
        $user->rules()->attach([$request->rule, 1]);

        return redirect()->back();
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
    public function backend_edit($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|min:3|max:100',
            // 'lastName'  => 'required|min:3|max:100',
            'username'  => 'required|min:3|max:100|unique:users,deleted_at',
            'rule' => 'required',
            // 'password'  => 'required|min:6|confirmed',
            // 'password_confirmation' => 'required|min:6',
            'email' => 'required|email|max:40',
            'phone' => 'required|digits_between:1,14',
            'image' => 'image|mimes:jpg,jpeg,png|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user = Users::find($id);
        if ($request->hasFile('image')) {
            $destinationPath = 'backend_users';
            $fileNameToStore = $destinationPath . '/' . $request->username . time() . rand(111, 999) . '.' . Input::file('image')->getClientOriginalExtension();
            File::delete($user->photo);
            Input::file('image')->move($destinationPath, $fileNameToStore);
            $user->photo = $fileNameToStore;
        }

        $user->first_name   = $request->firstName;
        $user->last_name    = $request->lastName; 
        $user->username     = $request->username;
        $user->email        = $request->email;
        // $user->password     = bcrypt($request->password);
        $user->mobile       = $request->phone;
        $user->is_active    = $request->status;
        $user->save();
        $user->rules()->detach();
        $user->rules()->attach([$request->rule, 1]);

        if($user->id == Auth::id()) {
            Auth::logout();
            return redirect('/login');
        }
        return redirect()->back();
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
    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
    }

    public function destroy_all()
    {
        $ids = $_POST['ids'];
        foreach ($ids as $id) {
            Users::find($id)->delete();
        }
    }
}
