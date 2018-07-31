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
use App\GeoRegion;
use App\Genders;

// Excel package
use Rap2hpoutre\FastExcel\FastExcel;


class DoctorsController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        /**  get doctors(users) registred through mobile app */
        $data['mobiles'] = Users::whereHas('rules', function ($q) {
            // filter users through table `user_rules`
            $q->where('rule_id', 2);
        })->whereHas('userInfo', function ($q) {
            // filter users through table `user_info` 
            $q->where('is_profile_completed', 0)
                ->where('is_backend', 0);
        })->get();


        /**  get doctors(users) registred through backend. **/
        $data['general'] = Users::whereHas('rules', function ($q) {
            // filter users through table `user_rules`
            $q->where('rule_id', 2);
        })->whereHas('userInfo', function ($q) {
            // filter users through table `user_info` 
            $q->where('is_profile_completed', 0)
                ->where('is_backend', 1);
        })->get();


        //  get doctors(users) registred in my list
        $data['myList'] = Users::whereHas('rules', function ($q) {
            // filter users through table `user_rules`
            $q->where('rule_id', 2);
        })->whereHas('userInfo', function ($q) {
            // filter users through table `user_info` 
            $q->where('is_profile_completed', 1);
        })->get();

        $data['countries'] = Countries::all();
        $data['cities'] = Cities::all();
        // $data['age_ranges'] = Age_Ranges::all();
        return view('usersmodule::mobile_users', $data);
    }

    public function create()
    {
        $data['countries'] = Countries::all();
        $data['specs'] = DoctorSpecialization::all();

        return view('usersmodule::addNewDoctor', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // Validate incoming request
        $this->validate($request, [
            'doctorName' => 'required|min:3',
            'doctorEmail' => 'required|email',
            'doctorTeleCode' => 'required',
            'mobile1' => 'required',
            'mobile2' => '',
            'mobile3' => '',
            'doctorCountry' => 'required',
            'doctorCity' => 'required',
            'doctorRegion' => 'required',
            'doctorAddress' => 'required',
            'password' => 'required|min:8',
            'gender' => 'required',
            'activation' => '',
        ]);

        // Insert new doctor into users
        try {
            // Creating new user
            $doctor = new Users;
            $doctor->username = $request->doctorName;
            $doctor->email = $request->doctorEmail;
            $doctor->tele_code = $request->doctorTeleCode;
            $doctor->mobile = $request->mobile1;
            $doctor->country_id = $request->doctorCountry;
            $doctor->city_id = $request->doctorCity;
            $doctor->password = bcrypt($request->password);
            $doctor->gender_id = $request->gender;
            $doctor->is_active = $request->activation ? : 0;
            
            // Insert doctor's image if exists
            if ($request->hasfile('doctorImage')) {
                $image = $request->doctorImage;
                $newName = time() . '_' . $image->getClientOriginalName();
                $image->move('doctors', $newName);
                $path = 'doctors/' . $newName;
                $doctor->photo = $path;
            }
            $doctor->save();    // save new user

            // Insert into `user_info`
            $userInfo = new UserInfo;
            $userInfo->user_id = $doctor->id;
            $userInfo->mobile2 = $request->mobile2 ? : null;   // it could be null
            $userInfo->mobile3 = $request->mobile3 ? : null;   // it could be null
            $userInfo->region_id = $request->doctorRegion;
            $userInfo->address = $request->doctorAddress;
            $userInfo->specialization_id = $request->doctorSpecialization ? : null; // it could be null
            $userInfo->is_profile_completed = $request->activation ? 1 : 0;
            $userInfo->is_backend = 1;
            $userInfo->save();  // save new user's info

            // Insert into `users_rules`
            $doctor->rules()->attach(2);

        } catch (Exception $exp) {
            dd($exp);
            Session::flash('warning', 'can not add new doctor! خطأ ، لا يمكن إضافة طبيب جديد');
            return redirect()->back();
        }


        // Flash success and redirect to its home page
        Session::flash('success', 'Doctor added successfully! تم إضافة الطبيب بنجاح');
        return redirect('/users_mobile');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $user = Users::find($request->id);
        $user->userInfo()->delete();
        
        if ( $user->rules ) {
            $user->rules()->detach($user->id);
        }

        $user->delete();

        return response()->json(['success', 'User deleted!']);
    }

    public function destroy_all(Request $request)
    {
        foreach ($request->ids as $id) {
            $user = Users::find($id);
            $user->userInfo()->delete();
        
            if ( $user->rules ) {
                $user->rules()->detach($user->id);
            }
        
            $user->save();
        }

        return response()->json(['success', 'Users deleted!']);
    }


    /**
     * @param   $id     route model binding => user's id
     * @return  view    if not found: redirect to /users_mobile list, if found show him/her.
     */
    public function mobile_show($id)
    {
        // find this user
        $user = Users::find($id);  

        // check if user exists
        if ($user == null) {
            // not found
            Session::flash('warning', 'Not found! غير موجود');
            return redirect('/users_mobile');
        } else {
            // user found
            $data['user'] = $user->whereHas('rules', function ($q) {
                // filter users through table `user_rules`
                $q->where('rule_id', 2);
            })->whereHas('userInfo', function ($q) {
                // filter users through table `user_info` 
                $q->where('is_profile_completed', 0)
                    ->where('is_backend', 0);
            })->first();

            return view('usersmodule::mobileUsersShow', $data);
        }

    }

    /** update mobile user is_active field */
    public function status_update(Request $request)
    {

        // check if user's id sent among request && if checkbox is already checked
        if ($request->id && isset($request->activation)) {
            $user = Users::find($request->id);
            $user->is_active = 1;
            $user->save();

            $user->userInfo->is_profile_completed = 1;
            $user->userInfo->save();

            /** TODO: SEND NOTIFICATIONS */

            Session::flash('success', 'Doctor activated! تم تفعيل الطبيب');
            return redirect('/users_mobile');
        } else if ($request->id && !isset($request->activation)) {
            $user = Users::find($request->id);
            $user->is_active = 0;
            $user->save();

            Session::flash('success', 'Doctor deactivated! تم الغاء تفعيل الطبيب');
            return redirect('/users_mobile');
        } else {
            Session::flash('warning', 'Doctor not found! لم يتم العثور علي هذا الطبيب');
            return redirect('/users_mobile');
        }
    }


    /**
     * @param   $id     route model binding => user's id
     * @return  view    if not found: redirect to /users_mobile list, if found show him/her.
     */
    public function myList_show($id)
    {
        // find this user
        $user = Users::find($id);  

        // check if user exists
        if ($user == null) {
            // not found
            Session::flash('warning', 'Not found! غير موجود');
            return redirect('/users_mobile');
        } else {
            // user found
            $data['user'] = Users::whereHas('rules', function ($q) {
                // filter users through table `user_rules`
                $q->where('rule_id', 2);
            })->whereHas('userInfo', function ($q) {
                // filter users through table `user_info` 
                $q->where('is_profile_completed', 1);
            })->first();

            return view('usersmodule::myListShowUser', $data);
        }

    }

    /** Activate or Deactivate a Doctor */
    public function myList_status_update(Request $request)
    {
        // check if user's id sent among request && if checkbox is already checked
        if ($request->id && isset($request->activation)) {
            $user = Users::find($request->id);
            $user->is_active = 1;
            $user->save();

            /** TODO: SEND NOTIFICATIONS */

            Session::flash('success', 'Doctor activated! تم تفعيل الطبيب');
            return redirect('/users_mobile');
        } else if ($request->id && !isset($request->activation)) {
            $user = Users::find($request->id);
            $user->is_active = 0;
            $user->save();

            Session::flash('success', 'Doctor deactivated! تم الغاء تفعيل الطبيب');
            return redirect('/users_mobile');
        } else {
            Session::flash('warning', 'Doctor not found! لم يتم العثور علي هذا الطبيب');
            return redirect('/users_mobile');
        }
    }

    public function AJAX_getCities(Request $request)
    {
        $cities = Countries::find($request->id)->cities;
        return response()->json(['cities' => $cities]);
    }

    public function AJAX_getRegions(Request $request)
    {
        $regions = Cities::find($request->id)->regions;
        return response()->json(['regions' => $regions]);
    }
    

    /** Edit form for a general list doctor */
    public function generalDoctorEdit($id)
    {

        // find this doctor
        $data['doctor'] = Users::find($id)->whereHas('rules', function ($q) {
            // filter users through table `user_rules`
            $q->where('rule_id', 2);
        })->whereHas('userInfo', function ($q) {
            // filter users through table `user_info` 
            $q->where('is_profile_completed', 0)
                ->where('is_backend', 1);
        })->first();

        // check if this doctor does exists
        if ($data['doctor'] != null) {

            $data['countries'] = Countries::all();
            $data['cities'] = Cities::where('country_id', $data['doctor']->country->id)->get();
            $data['regions'] = GeoRegion::where('city_id', $data['doctor']->city->id)->get();
            $data['specs'] = DoctorSpecialization::all();

            return view('usersmodule::editDoctor', $data);
        } else {
            Session::flash('warning', 'Doctor not found! لم نتمكن من العثور علي هذا الطبيب');
            return redirect()->back();
        }
    }

    /** Update a general list doctor */
    public function generalDoctorUpdate(Request $request)
    {
        $doctor = Users::find($request->id);

        if ($doctor != null) {
            // dd($request->all());

            // Validate incoming request
            $this->validate($request, [
                'doctorName' => 'required|min:3',
                'doctorEmail' => 'required|email',
                'doctorTeleCode' => 'required',
                'mobile1' => 'required',
                'mobile2' => '',
                'mobile3' => '',
                'doctorCountry' => 'required',
                'doctorCity' => 'required',
                'doctorRegion' => '',
                'doctorAddress' => 'required',
                'password' => $request->password ? 'required|min:8' : '',
                'gender' => 'required',
                'activation' => '',
            ]);

            // Insert new doctor into users
            try {
                // Updating a current user
                $doctor->username = $request->doctorName;
                $doctor->email = $request->doctorEmail;
                $doctor->tele_code = $request->doctorTeleCode;
                $doctor->mobile = $request->mobile1;
                $doctor->country_id = $request->doctorCountry;
                $doctor->city_id = $request->doctorCity;
                
                if ( $request->password ) {
                    $doctor->password = bcrypt($request->password);
                }
                
                $doctor->gender_id = $request->gender;
                $doctor->is_active = $request->activation ? : 0;
            
            // Insert doctor's image if exists
                if ($request->hasfile('doctorImage')) {
                    File::delete($doctor->photo);   // delete old

                    $image = $request->doctorImage;
                    $newName = time() . '_' . $image->getClientOriginalName();
                    $image->move('doctors', $newName);
                    $path = 'doctors/' . $newName;
                    $doctor->photo = $path;
                }
                $doctor->save();    // save new user

            // Insert into `user_info`
                $userInfo = UserInfo::where('user_id', $doctor->id)->first();
                $userInfo->user_id = $doctor->id;
                $userInfo->mobile2 = $request->mobile2 ? : null;   // it could be null
                $userInfo->mobile3 = $request->mobile3 ? : null;   // it could be null
                $userInfo->region_id = $request->doctorRegion;
                $userInfo->address = $request->doctorAddress;
                $userInfo->specialization_id = $request->doctorSpecialization ? : null; // it could be null
                $userInfo->is_profile_completed = 0;
                $userInfo->is_backend = 1;
                $userInfo->save();  // save new user's info

            // Insert into `users_rules`
                $doctor->rules()->attach(2);

            } catch (Exception $exp) {
                dd($exp);
                Session::flash('warning', 'can not update new doctor! خطأ ، لا يمكن تعديل طبيب جديد');
                return redirect()->back();
            }


        // Flash success and redirect to its home page
            Session::flash('success', 'Doctor updated successfully! تم تعديل الطبيب بنجاح');
            return redirect('/users_mobile');
        } else {
            Session::flash('warning', 'can not update this doctor! لا يمكن تعديل معلومات الطبيب');
            return redirect()->back();
        }
    }

    /** Import excel file to DB */
    public function storeExcel(Request $request) 
    {
        if ( $request->hasfile('excel_file') ) {
            $users = (new FastExcel)->import($request->excel_file);

            foreach($users as $user) {
                // Insert new doctor into users
                try {
                    // Creating new user
                    $doctor = new Users;
                    $doctor->username   = $user["name"];
                    $doctor->email      = $user["email"];
                    $doctor->tele_code  = $user["tele_code"];
                    $doctor->mobile     = $user["mobile1"];
                    $doctor->country_id = Helper::getIdOrInsert(Countries::class, $user['country']);
                    $doctor->city_id    = Helper::getIdOrInsert(Cities::class, $user['city']);
                    $doctor->password   = bcrypt($request->password);
                    $doctor->gender_id  = Helper::getIdOrInsert(Genders::class, $user['gender']);
                    $doctor->is_active  = strtolower($user['is_active']) == 'yes' ? 1 : 0;
                    
                    // Insert doctor's image if exists
                    // if ($request->hasfile('doctorImage')) {
                    //     $image = $request->doctorImage;
                    //     $newName = time() . '_' . $image->getClientOriginalName();
                    //     $image->move('doctors', $newName);
                    //     $path = 'doctors/' . $newName;
                    //     $doctor->photo = $path;
                    // }
                    $doctor->save();    // save new user

                    // Insert into `user_info`
                    $userInfo = new UserInfo;
                    $userInfo->user_id      = $doctor->id;
                    $userInfo->mobile2      = $user['mobile2']  ? : null;   // it could be null
                    $userInfo->mobile3      = $user['mobile3']  ? : null;   // it could be null
                    $userInfo->region_id    = $user['region'] ? Helper::getIdOrInsert(DoctorSpecialization::class, $user['region']) : '';
                    $userInfo->address      = $user['address'];
                    $userInfo->specialization_id    = $user['specialization'] != '' ? Helper::getIdOrInsert(DoctorSpecialization::class, $user['specialization']) : '';  // it could be null
                    $userInfo->is_profile_completed = 0;
                    $userInfo->is_backend   = 1;
                    $userInfo->save();  // save new user's info

                    // Insert into `users_rules`
                    $doctor->rules()->attach(2);

                } catch (Exception $exp) {
                    dd($exp);
                    Session::flash('warning', 'can not add new doctor! خطأ ، لا يمكن إضافة طبيب جديد');
                    return redirect()->back();
                }
            }
            

        } else {
            Session::flash('warning', 'Error uploading excel file! خطأ في تحميل ملف الاكسيل');
            return redirect()->back();
        }

        // Flash success and redirect to its home page
        Session::flash('success', 'Doctor added successfully! تم إضافة الطبيب بنجاح');
        return redirect('/users_mobile');
    }
}