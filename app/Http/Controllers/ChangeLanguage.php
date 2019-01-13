<?php

namespace App\Http\Controllers;

use Auth;
use Session;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeLanguage extends Controller
{
    public function changeLang(Request $request) {
        $url = $request->url;
        $locale = $request->locale;
        $lang_locale = $locale == 'ar' ? 'en' : 'ar';
        
        $user = Auth::user();
        $user->lang_id = $locale == 'ar' ? 1 : 2;
        $user->save();

        \App::setLocale( \Helper::getUserLocale() );
        Session::put('locale', $lang_locale);

        return \Redirect::to($url);
    }
}
