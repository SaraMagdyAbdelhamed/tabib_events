<?php

namespace App\Http\Controllers;

use Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeLanguage extends Controller
{
    public function changeLang(Request $request) {
        $url = $request->url;
        $locale = $request->locale;

        $user = Auth::user();
        $user->lang_id = $locale == 'ar' ? 1 : 2;
        $user->save();

        \App::setLocale( \Helper::getUserLocale() );

        return \Redirect::to($url);
    }
}
