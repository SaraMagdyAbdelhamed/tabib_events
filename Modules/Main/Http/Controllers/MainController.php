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
use App\OfferCategory;
use App\SponsorCategory;
use App\DoctorsCategory;


class MainController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // view about us
    public function about()
    {
        return view('main::about_us')
            ->with('about_us_english', Fixed::where('name', 'LIKE', 'About Us')->first()->body)
            ->with('about_us_arabic', Helper::localization('fixed_pages', 'body', 1, '2'));
    }

    // view terms n conditions
    public function terms()
    {
        return view('main::terms')
            ->with('about_us_english', Fixed::where('name', 'LIKE', 'Terms and Conditions')->first()->body)
            ->with('about_us_arabic', Helper::localization('fixed_pages', 'body', 2, 2));
    }


    // view privacy page
    public function privacy()
    {
        return view('main::privacy')
            ->with('about_us_english', Fixed::where('name', 'LIKE', 'Privacy and Policy')->first()->body)
            ->with('about_us_arabic', Helper::localization('fixed_pages', 'body', 3, '2'));
    }

    // view contact us page
    public function contact()
    {
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
    public function update_fixed($id, Request $request)
    {
        $this->validate($request, [
            'arabicContent' => 'required',
            'englishContent' => 'required'
        ], [
            'arabicContent.required' => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required' => 'English content is empty, please edit it and try again!'
        ]);

        // update arabic 
        try {
            Helper::edit_entity_localization('fixed_pages', 'body', $id, 2, $request->arabicContent);
        } catch (\Exception $ex) {
            Helper::add_localization(5, 'body', $id, $request->arabicContent, 2);
        }

        // update english
        try {
            $name = $id == 1 ? 'About Us' : ($id == 2 ? 'Terms and Conditions' : ($id == 3 ? 'Privacy and Policy' : 0));    // 1 => about us, 2 => terms, 3 => privacy
            $fixed = Fixed::where('name', 'LIKE', $name)->first();
            $fixed->body = $request->englishContent;
            $fixed->updated_by = Auth::id();
            $fixed->save();

        } catch (\Exception $ex) {
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
    public function update_contact(Request $request)
    {

        // Validate incoming requests
        $this->validate($request, [
            'email' => 'required|email'
        ], [
            'email.required' => 'Email is required, please try again من فضلك ادخل البريد الالكتروني ثم حاول ثانية',
            'email.email' => 'Your input is not a valid email format البريد الالكتروني الذي ادخلته صيغته غير صحيحة'
        ]);

        // Insert into DB
        try {
            $email = SystemSetting::where('name', 'contact_us')->first();
            $email->value = $request->email;
            $email->save();
        } catch (\Exception $ex) {
            $newEmail = new SystemSetting;
            $newEmail->name = 'contact_us';
            $newEmail->value = $request->email;
            $newEmail->save();
        }

        Session::flash('success', 'Email updated successfully تم تحديث البريد الالكتروني بنجاح');
        return redirect()->back();
    }

    /** Event Categories */
    // view event categories page
    public function event_category()
    {
        return view('main::event_category')
            ->with('events', EventCategory::all());
    }

    // Add new event category
    public function category_store(Request $request)
    {
        $id = $request->op;     // get operation number 

        switch($id) {
            /** Event Categories */
            case 1:
                $event = new EventCategory;
                $entity_id = 1;
                $image_folder_path = 'event_category';
                break;

            /** Sponsor Categories */
            case 2:
                $event = new SponsorCategory;
                $entity_id = 12;
                $image_folder_path = 'sponsor_category';
                break;

            /** Offer Categories */
            case 3:
                $event = new OfferCategory;
                $entity_id = 7;
                $image_folder_path = 'offer_category';
                break;

            /** Doctors Specialization Categories */
            case 4:
                $event = new DoctorsCategory;
                $entity_id = 11;
                $image_folder_path = 'doctors_speciality';
                break;

            default:
                return redirect()->back();
            break;
        }

        // validate data
        $this->validate($request, [
            'arabicContent' => 'required',
            'englishContent' => 'required'
        ], [
            'arabicContent.required' => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required' => 'English content is empty, please edit it and try again!'
        ]);


        // english version
        try {
            $event->name  = $request->englishContent;

            /** Add the image if there any */
            // Validate image
            if ( $request->hasfile('image') ) {
                $image = $request->image;
                $image_original_name = $image->getClientOriginalName();             // get original name
                $image_new_name      = time().'_'.$image_original_name;             // set new name
                $image->move($image_folder_path, $image_new_name);                  // move it to public/event_category
                $newPath = $image_folder_path .'/'. $image_new_name;                // save its new path

                $event->image = $newPath ? : '';                                    // insert new image path to DB
            } 

            
            $event->created_by = Auth::id();
            $event->save();
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error occured during adding event!');
            return redirect()->back();
        }

        // arabic version
        try {
            Helper::add_localization($entity_id, 'name', $event->id, $request->arabicContent, 2);
        } catch (\Exception $ex) {
            $event->delete();
            Session::flash('warning', 'حدث خطا ما عند ادخال الحدث');
            return redirect()->back();
        }

        Session::flash('success', 'Event Added successfully تم إضافة الحدث بنجاح');
        return redirect()->back();
    }

    // Update an event category
    public function category_update(Request $request)
    {
        
        $id = $request->op;     // get operation number 

        switch($id) {
            /** Event Categories */
            case 1:
                $event = EventCategory::find($request->id);
                $entity_table = 'categories';
                $image_folder_path = 'event_category';
                break;

            /** Sponsor Categories */
            case 2:
                $event = SponsorCategory::find($request->id);
                $entity_table = 'sponsor_categories';
                $image_folder_path = 'sponsor_category';
                break;

            /** Offer Categories */
            case 3:
                $event = OfferCategory::find($request->id);
                $entity_table = 'offer_categories';
                $image_folder_path = 'offer_category';
                break;

            /** Doctors Specialization Categories */
            case 4:
                $event = DoctorsCategory::find($request->id);
                $entity_table = 'specializations';
                $image_folder_path = 'doctors_speciality';
                break;

            default:
                return redirect()->back();
            break;
        }
        
        // validate data
        $this->validate($request, [
            'id' => 'required',
            'arabicContent' => 'required',
            'englishContent' => 'required'
        ], [
            'arabicContent.required' => 'تعديل المحتوي العربي فارغ ، برجاء تعديله والمحاولة مرة اخري',
            'englishContent.required' => 'English content is empty, please edit it and try again!'
        ]);

        
        // english version
        try {
            $event->name = $request->englishContent;

            // Validate image
            if ( $request->hasfile('image') ) {
                $image = $request->image;
                $image_original_name = $image->getClientOriginalName();             // get original name
                $image_new_name      = time().'_'.$image_original_name;             // set new name
                $image->move('event_category', $image_new_name);                    // move it to public/event_category
                $newPath = 'event_category/' . $image_new_name;                     // save its new path
                $event->image = $newPath;                                           // insert new image
            } else if( isset($event->image) ) {
                $newPath = $event->image;
                $event->image = $newPath;                                           // keep old image
            }

            $event->created_by = Auth::id();
            $event->save();
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'Error occured during adding event!');
            return redirect()->back();
        }

        // arabic version
        try {
            Helper::edit_entity_localization($entity_table, 'name', $request->id, 2, $request->arabicContent);
        } catch (\Exception $ex) {
            Session::flash('warning', 'حدث خطا ما عند ادخال الحدث');
            return redirect()->back();
        }

        Session::flash('success', 'Event Added successfully تم إضافة الحدث بنجاح');
        return redirect()->back();
    }

    // Delete a single event category
    public function category_delete(Request $request)
    {
        $id = $request->id;

        $op = $request->op;     // get operation number 

        switch($op) {
            /** Event Categories */
            case 1:
                $model = new EventCategory;
                $entity_id = 1;
                break;

            /** Sponsor Categories */
            case 2:
                $model = new SponsorCategory;
                $entity_id = 12;
                break;

            /** Offer Categories */
            case 3:
                $model = new OfferCategory;
                $entity_id = 7;
                break;

            /** Doctors Specialization Categories */
            case 4:
                $model = new DoctorsCategory;
                $entity_id = 11;
                break;

            default:
                return redirect()->back();
            break;
        }

        // delete from localization - Arabic version
        try {
            EntityLocalization::where('entity_id', $entity_id)->where('item_id', $id)->delete();
        } catch (\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            $model::where('id', $id)->delete();
        } catch (\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }


    // Delete multiple records
    public function category_deleteSelected(Request $request)
    {
        $ids = $request->ids;

        $op = $request->op;     // get operation number 

        switch($op) {
            /** Event Categories */
            case 1:
                $model = new EventCategory;
                $entity_id = 1;
                break;

            /** Sponsor Categories */
            case 2:
                $model = new SponsorCategory;
                $entity_id = 12;
                break;

            /** Offer Categories */
            case 3:
                $model = new OfferCategory;
                $entity_id = 7;
                break;

            /** Doctors Specialization Categories */
            case 4:
                $model = new DoctorsCategory;
                $entity_id = 11;
                break;

            default:
                return redirect()->back();
            break;
        }
        // delete from localization - Arabic version
        try {
            EntityLocalization::whereIn('item_id', $ids)->where('entity_id', $entity_id)->delete();
        } catch (\Exception $ex) {
            return response()->json(['error', 'error deleting arabic']);
        }

        // delete from interests    - English version
        try {
            $model::whereIn('id', $ids)->delete();
        } catch (\Exception $ex) {
            return response()->json(['error', 'error deleting english']);
        }

        // return success response
        return response()->json(['success', 'success']);
    }


    /** Sponsor Categories */
    public function sponsor_category()
    {
        return view('main::sponsor_category')
            ->with('events', SponsorCategory::all());
    }


    /** Offer Categories */
    public function offers_category()
    {
        return view('main::offer_category')
            ->with('events', OfferCategory::all());
    }


    /** Doctor Specialities */
    public function speciality_category()
    {
        return view('main::doctor_speciality')
            ->with('events', DoctorsCategory::all());
    }

    /** NOTIFICATIONS */
    // view notifications
    public function notifications()
    {

        if (SystemSetting::where('name', 'notification_distance')->first()) {
            $value = SystemSetting::where('name', 'notification_distance')->first()->value;
            $chunks = explode(',', $value);
        } else {
            $chunks = 0;
        }

        return view('main::notifications')
            ->with('distance', $chunks[0])
            ->with('unit', $chunks[1]);
    }

    public function notifications_store(Request $request)
    {

        $this->validate($request, [
            'notification' => 'required',
            'measurement' => 'required'
        ]);

        try {

            if (SystemSetting::where('name', 'notification_distance')->first()) {
                $notification = SystemSetting::where('name', 'notification_distance')->first();
            } else {
                $notification = new SystemSetting;
            }

            $notification->name = 'notification_distance';
            $notification->value = $request->notification . ',' . $request->measurement;
            $notification->save();
        } catch (\Exception $ex) {
            dd($ex);
            Session::flash('warning', 'can not add new notification');
            return redirect()->back();
        }

        Session::flash('success', 'Success - تم الاضافة بنجاح');
        return redirect()->back();
    }

    public function notifications_update(Request $request)
    {

    }

    public function notifications_delete(Request $request)
    {

    }

    public function notifications_deleteSelected(Request $request)
    {

    }


}
