<?php

/**
 *  Author:  Ahmed Yacoub
 *  Email:   ahmed.yacoub@outlook.com
 *  Date: May 1, 2018
 */

namespace Modules\Main\Http\Controllers;

use Helper;
use Session; 
       
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;    
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; 
 
use App\Fixed;  
use App\Entity;
use App\EntityLocalization;
use App\SystemSetting;
use App\EventCategory;
use App\FamousCategory;
use App\Sponsor;
use App\Trend;


class MainController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // view about us
    public function about() {
        return view('main::about_us')
                ->with('about_us_english', Fixed::where('name', 'LIKE', 'About Us')->first()->body)
                ->with('about_us_arabic', Helper::localization('fixed_pages', 'body', 1, '2'));
    }

    // view terms n conditions
    public function terms() {
        return view('main::terms')
                ->with('about_us_english', Fixed::where('name', 'LIKE', 'Terms and Conditions')->first()->body)
                ->with('about_us_arabic', Helper::localization('fixed_pages', 'body', 2, 2));
    }


    // view privacy page
    public function privacy() {
        return view('main::privacy')
                ->with('about_us_english', Fixed::where('name', 'LIKE', 'Privacy and Policy')->first()->body)
                ->with('about_us_arabic', Helper::localization('fixed_pages', 'body', 3, '2'));
    }

    // view contact us page
    public function contact() {
        $query = SystemSetting::where('name', 'contact_us')->first();
        $email = $query ? $query->value : '';

        return view('main::contact')
                ->with('email', $email);
    }

    /**
     *  Updates fixed pages [about us, terms & conditions, privacy and policy and contact us]
     *  @param  $id        idicates the following fields to be updated     `fixed_pages`.id for English version && `entity_localizations`.item_id for Arabic version.
     *  @param  Request $request    incoming data from POST request.
     *  @return redirect back to its edit page
     *  Usage:
     *  in edit form do the following:  <form action="{{ route('submit_form_route', ['page_number' => 1]) }}"...        for editing about us page for example.  
     *  
     *  1   => edit about us.
     *  2   => edit terms.
     *  3   => edit privacy.
     */
    public function update_fixed( $id, Request $request ) {
        $this->validate($request, [
            'arabicContent'  => 'required',
            'englishContent' => 'required'
        ],[
            'arabicContent.required'    => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required'   => 'English content is empty, please edit it and try again!'
        ]);

        // update arabic 
       try {
            Helper::edit_entity_localization('fixed_pages', 'body', $id , 2, $request->arabicContent);
       } catch(\Exception $ex) {
            Helper::add_localization(5, 'body', $id, $request->arabicContent, 2);
       }

        // update english
        try {
            $name = $id == 1 ? 'About Us' : ($id == 2 ? 'Terms and Conditions' : ($id == 3 ? 'Privacy and Policy' : 0));    // 1 => about us, 2 => terms, 3 => privacy
            $fixed = Fixed::where('name', 'LIKE', $name)->first();
            $fixed->body = $request->englishContent;
            $fixed->updated_by = Auth::id();
            $fixed->save();

        } catch(\Exception $ex) {
            $page = new Fixed;
            $page->body = $request->englishContent;
            $page->created_by = Auth::id();
            $fixed->save();
        }

        Session::flash('success', 'Success تم الاضافة بنجاح');
        return redirect()->back();
    }

    /**
     * Updates contact email
     * @param   Request $request        incoming request data
     * @return redirect to contact page
     */
    public function update_contact( Request $request ) {

        // Validate incoming requests
        $this->validate($request, [
            'email' =>  'required|email'
        ], [
            'email.required'    => 'Email is required, please try again من فضلك ادخل البريد الالكتروني ثم حاول ثانية',
            'email.email'       => 'Your input is not a valid email format البريد الالكتروني الذي ادخلته صيغته غير صحيحة'
        ]);

        // Insert into DB
        try {
            $email = SystemSetting::where('name', 'contact_us')->first();
            $email->value = $request->email;
            $email->save();
        } catch(\Exception $ex) {
            $newEmail = new SystemSetting;
            $newEmail->name = 'contact_us';
            $newEmail->value = $request->email;
            $newEmail->save();
        }

        Session::flash('success', 'Email updated successfully تم تحديث البريد الالكتروني بنجاح');
        return redirect()->back();
    }

    // view event categories page
    public function event_category() {
        return view('main::event_category')
                ->with('events', EventCategory::all());
    }

    // Add new event category
    public function event_store( Request $request ) {

        // validate data
        $this->validate($request, [
            'arabicContent'  => 'required',
            'englishContent' => 'required'
        ],[
            'arabicContent.required'    => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required'   => 'English content is empty, please edit it and try again!'
        ]);

        // english version
        try {
            $event = new EventCategory;
            $event->name = $request->englishContent;
            $event->created_by = Auth::id();
            $event->save();
        } catch(\Exception $ex) {
            Session::flash('warning', 'Error occured during adding event!');
            return redirect()->back();
        }

        // arabic version
        try {
            Helper::add_localization(15, 'name', $event->id, $request->arabicContent, 2);
        } catch(\Exception $ex) {
            $event->delete();
            Session::flash('warning', 'حدث خطا ما عند ادخال الحدث');
            return redirect()->back();
        }

        Session::flash('success', 'Event Added successfully تم إضافة الحدث بنجاح');
        return redirect()->back();
    }

    // Update an event category
    public function event_update( Request $request ) {

        // validate data
        $this->validate($request, [
            'id' => 'required',
            'arabicContent'  => 'required',
            'englishContent' => 'required'
        ],[
            'arabicContent.required'    => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required'   => 'English content is empty, please edit it and try again!'
        ]);

        // english version
        try {
            $event = EventCategory::find($request->id);
            $event->name = $request->englishContent;
            $event->created_by = Auth::id();
            $event->save();
        } catch(\Exception $ex) {
            Session::flash('warning', 'Error occured during adding event!');
            return redirect()->back();
        }

        // arabic version
        try {
            Helper::edit_entity_localization('interests', 'name', $request->id, 2, $request->arabicContent);
        } catch(\Exception $ex) {
            Session::flash('warning', 'حدث خطا ما عند ادخال الحدث');
            return redirect()->back();
        }

        Session::flash('success', 'Event Added successfully تم إضافة الحدث بنجاح');
        return redirect()->back();
    }

    // Delete a single event category
    public function event_delete( Request $request ) {
        $id = $request->id;

        // delete from localization - Arabic version
        try {
            EntityLocalization::where('entity_id', 15)->where('item_id', $id)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            EventCategory::where('id', $id)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }


    // Delete multiple records
    public function event_deleteSelected( Request $request ) {
        $ids = $request->ids;

        // delete from localization - Arabic version
        try {
            EntityLocalization::whereIn('item_id', $ids)->where('entity_id', 15)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            EventCategory::whereIn('id', $ids)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }


    // view famous attractions
    public function famous() {
        return view('main::famous')
                ->with('attractions', FamousCategory::all());
    }

    // Add new event category
    public function famous_store( Request $request ) {

        // validate data
        $this->validate($request, [
            'arabicContent'  => 'required',
            'englishContent' => 'required'
        ],[
            'arabicContent.required'    => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required'   => 'English content is empty, please edit it and try again!'
        ]);

        // english version
        try {
            $event = new FamousCategory;
            $event->name = $request->englishContent;
            $event->created_by = Auth::id();
            $event->save();
        } catch(\Exception $ex) {
            Session::flash('warning', 'Error occured during adding event!');
            return redirect()->back();
        }

        // arabic version
        try {
            Helper::add_localization(12, 'name', $event->id, $request->arabicContent, 2);
        } catch(\Exception $ex) {
            $event->delete();
            Session::flash('warning', 'حدث خطا ما عند ادخال الحدث');
            return redirect()->back();
        }

        Session::flash('success', 'Event Added successfully تم إضافة الحدث بنجاح');
        return redirect()->back();
    }

    // Update an event category
    public function famous_update( Request $request ) {

        // validate data
        $this->validate($request, [
            'id' => 'required',
            'arabicContent'  => 'required',
            'englishContent' => 'required'
        ],[
            'arabicContent.required'    => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required'   => 'English content is empty, please edit it and try again!'
        ]);

        // english version
        try {
            $event = FamousCategory::find($request->id);
            $event->name = $request->englishContent;
            $event->updated_by = Auth::id();
            $event->save();
        } catch(\Exception $ex) {
            Session::flash('warning', 'Error occured during adding event!');
            return redirect()->back();
        }

        // arabic version
        try {
            Helper::edit_entity_localization('fa_categories', 'name', $request->id, 2, $request->arabicContent);
        } catch(\Exception $ex) {
            Session::flash('warning', 'حدث خطا ما عند ادخال الحدث');
            return redirect()->back();
        }

        Session::flash('success', 'Event Added successfully تم إضافة الحدث بنجاح');
        return redirect()->back();
    }

    // Delete a single event category
    public function famous_delete( Request $request ) {
        $id = $request->id;

        // delete from localization - Arabic version
        try {
            EntityLocalization::where('entity_id', 12)->where('item_id', $id)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            FamousCategory::where('id', $id)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }

    // Delete multiple records
    public function famous_deleteSelected( Request $request ) {
        $ids = $request->ids;

        // delete from localization - Arabic version
        try {
            EntityLocalization::whereIn('item_id', $ids)->where('entity_id', 12)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            FamousCategory::whereIn('id', $ids)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }


    /** SPONSORS */
    // view sponsors
    public function sponsors() {
        return view('main::sponsors')
                    ->with('sponsors', Sponsor::all());
    }

    public function sponsor_store(Request $request) {

        $this->validate($request, [
            'arabic'  =>  'required',
            'english'  =>  'required',
            'logoAr'  =>  'required|image|mimes:jpeg,jpg,png',
            'logoEn'  =>  'required|image|mimes:jpeg,jpg,png'
        ],[
            'arabic.required'   => 'اسم الراعي باللغة العربية غير موجود ، برجاء كتابته ثم المحاولة مجددا',
            'english.required'  => 'Sponsor name is required, please type it and try again!',
            'logoAr.required'   => 'شعار الراعي غير متواجد ، برجاء اختيار شعار ثم المحاولة مرة اخري',
            'logoAr.image'      => 'الشعار الذي ادخلته ليس صورة',
            'logoAr.mimes'      => 'اصيغة الشعار الذي ادخلته غير صالحة ، برجاء اختيار شعار بامتداد jpg jpeg png',
            'logoEn.image'      => 'Logo is not a valid image',
            'logoEn.mimes'      => 'Logo extension is not supported, please choose a logo with an extension of jpg, jpeg or png'
        ]);

        // Logo
        if($request->logoAr && $request->logoEn) {

            $imgAr = $request->logoAr;
            $imgEn = $request->logoEn;

            $now = time();

            $newAr = $now.'_'.$imgAr->getClientOriginalName(); // current time + original image name
            $newEn = $now.'_'.$imgEn->getClientOriginalName(); // current time + original image name

            $imgAr->move('logo/ar', $newAr);               // move to public/logo/ar
            $imgEn->move('logo/en', $newEn);               // move to public/logo/en

            $imgPathAr = 'logo/ar/'.$newAr;       // new path: public/useres_images/new.jgp 
            $imgPathEn = 'logo/en/'.$newEn;
        }

        // english
        try {
            $sponsor = new Sponsor;
            $sponsor->name = $request->english;
            $sponsor->logo_ar   = $imgPathAr;
            $sponsor->logo_en   = $imgPathEn;
            $sponsor->created_by = Auth::id();
            $sponsor->save();
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Can not add in English');
            return redirect()->back();
        }

        // arabic
        try {
            Helper::add_localization(11, 'name', $sponsor->id, $request->arabic, 2);
        } catch (\Exception $ex) {
            $sponsor->delete();
            dd($ex);
            Session::flash('warning', 'لا يمكن الاضافة باللغة العربية');
            return redirect()->back();
        }

        Session::flash('success', 'Success - تمت الاضافة بنجاح');
        return redirect()->back();
    }

    public function sponsor_update(Request $request) {
        $this->validate($request, [
            'hiddenID' => 'required',
            'arabic'   =>  'required',
            'english'  =>  'required',
        ]);

        // Logo
        if($request->logoAr || $request->logoEn) {
            $now = time();

            if($request->logoAr) {
                $imgAr = $request->logoAr;
                $newAr = $now.'_'.$imgAr->getClientOriginalName(); // current time + original image name
                $imgAr->move('logo/ar', $newAr);               // move to public/logo/ar
                $imgPathAr = 'logo/ar/'.$newAr;       // new path: public/useres_images/new.jgp 
            }

            if($request->logoEn) {
                $imgEn = $request->logoEn;  
                $newEn = $now.'_'.$imgEn->getClientOriginalName(); // current time + original image name
                $imgEn->move('logo/en', $newEn);               // move to public/logo/en
                $imgPathEn = 'logo/en/'.$newEn;
            }
        }

        // english
        try {
            $sponsor = Sponsor::find($request->hiddenID);
            $sponsor->name = $request->english;
            
            if($request->logoAr) {
                $sponsor->logo_ar   = $imgPathAr;
            }
            if($request->logoEn) {
                $sponsor->logo_en   = $imgPathEn;
            }
            $sponsor->updated_by = Auth::id();
            $sponsor->save();
            
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Can not edit in English');
            return redirect()->back();
        }

        // arabic
        try {
            Helper::edit_entity_localization('sponsors', 'name', $sponsor->id, 2, $request->arabic);
        } catch (\Exception $ex) {
            $sponsor->delete();
            dd($ex);
            Session::flash('warning', 'لا يمكن الاضافة باللغة العربية');
            return redirect()->back();
        }
        Session::flash('success', 'Success - تمت التعديل بنجاح');

        return redirect()->back();
    }

    public function sponsor_delete(Request $request) {
        try {
            Sponsor::find($request->id)->delete();
        } catch(\Exception $ex) {
            Session::flash('warning', 'can not delete this record.');
            return response()->json(['error', 'can not delete this record.']);
        }

        return response()->json(['success', 'record deleted successfully!']);
    }

    public function sponsor_deleteSelected(Request $request) {
        try {
            Sponsor::whereIn('id', $request->id)->delete();
        } catch(\Exception $ex) {
            Session::flash('warning', 'can not delete those records.');
            return response()->json(['error', 'can not delete those records.']);
        }

        return response()->json(['success', 'records deleted successfully!']);
    }


    /** TRENDS */
    // view trends
    public function trends() {
        return view('main::trends')
                    ->with('trends', Trend::all());
    }

    public function trends_store(Request $request) {

        // validation
        $this->validate($request, [
            'arabic'    => 'required',
            'english'   => 'required'
        ]);

        // insert english
        try {
            $trend = new Trend;
            $trend->name = $request->english;
            $trend->created_by = Auth::id();
            $trend->save();
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'can not add');
            return redirect()->back();
        }

        // insert arabic
        try {
            Helper::add_localization(16, 'name', $trend->id, $request->arabic, 2);
        } catch(\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'لا يمكن الاضافة');
            return redirect()->back();
        }

        Session::flash('success', 'Success - تم الاضافة بنجاح');
        return redirect()->back();
    }

    public function trends_update(Request $request) {
        $this->validate($request, [
            'hiddenID' => 'required',
            'arabic'   =>  'required',
            'english'  =>  'required',
        ]);

        // english
        try {
            $trend = Trend::find($request->hiddenID);
            $trend->name = $request->english;
            $trend->updated_by = Auth::id();
            $trend->save();
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Can not edit in English');
            return redirect()->back();
        }

        // arabic
        try {
            Helper::edit_entity_localization('trending_keywords', 'name', $trend->id, 2, $request->arabic);
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'لا يمكن التعديل باللغة العربية');
            return redirect()->back();
        }
        Session::flash('success', 'Success - تمت التعديل بنجاح');

        return redirect()->back();
    }

    public function trends_delete(Request $request) {
        $id = $request->id;

        // delete from localization - Arabic version
        try {
            EntityLocalization::where('entity_id', 16)->where('item_id', $id)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            Trend::where('id', $id)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }

    public function trends_deleteSelected(Request $request) {
        $ids = $request->ids;

        // delete from localization - Arabic version
        try {
            EntityLocalization::whereIn('item_id', $ids)->where('entity_id', 16)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            Trend::whereIn('id', $ids)->delete();
        } catch(\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }


    /** NOTIFICATIONS */
    // view notifications
    public function notifications() {

        if( SystemSetting::where('name', 'notification_distance')->first() ) {
            $value =  SystemSetting::where('name', 'notification_distance')->first()->value;
            $chunks = explode(',', $value);
        } else {
            $chunks = 0;
        }

        return view('main::notifications')
                    ->with('distance', $chunks[0])
                    ->with('unit', $chunks[1]);
    }

    public function notifications_store(Request $request) {

        $this->validate($request, [
            'notification' => 'required',
            'measurement'  => 'required'
        ]);

        try {

            if ( SystemSetting::where('name', 'notification_distance')->first() ) {
                $notification = SystemSetting::where('name', 'notification_distance')->first();
            } else {
                $notification = new SystemSetting;
            }
            
            $notification->name = 'notification_distance';
            $notification->value = $request->notification .','. $request->measurement;
            $notification->save();
        } catch(\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'can not add new notification');
            return redirect()->back();
        }

        Session::flash('success', 'Success - تم الاضافة بنجاح');
        return redirect()->back();
    }

    public function notifications_update(Request $request) {
        
    }

    public function notifications_delete(Request $request) {
        
    }

    public function notifications_deleteSelected(Request $request) {
        
    }


}
