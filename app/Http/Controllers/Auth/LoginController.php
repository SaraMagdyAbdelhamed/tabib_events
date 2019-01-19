<?php

namespace App\Http\Controllers\Auth;

use Helper;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Users;
use Auth;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        logout as performLogout;
    }

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new Users;
    }

    // Custom login
    public function login( Request $request ) {

        // validate incoming login request
        $this->validate($request, [
            'username' => 'required:max:20',
            'password' => 'required|min:3|max:8'
        ]);

        $username = $request->username;               // incoming username
        $password = bcrypt( $request->password );     // incoming password

        // find this user
        // $user = Users::where('username', $username)->first();

        // try to authenticate user
        if ( Auth::attempt(['username' => $username, 'password' => $request->password]) ) {

            // check rules first, and logout if not allowed
            if ( !Helper::hasRule(['Super Admin','Admin Doctor' , 'Data Entry', 'Organizer', 'Sponsor']) ) {
                $this->performLogout($request);
                return redirect('/login')
                            ->with('error', 'هذا المستخدم غير مسموح له بالدخول')
                            ->with('error_en', 'This user not allowed to access this application!');
            }

            // add last login timestamp
            $user = Auth::user();
            $userLocale = Helper::getUserLocale();
            $user->last_login = Carbon::now()->setTimezone($request->timezone);
            $user->timezone = $request->timezone;
            $user->save();

            return redirect('/about');

        } else {
            return redirect('/login')->with('error', 'من فضلك ، تأكد من الاسم وكلمة السر ثم حاول ثانيةَ')
                                    ->with('error_en', 'Invalid username or password, Please be sure from your user name or password');
        }
    }

    // Custom logout
    public function logout(Request $request) {
        $this->performLogout($request);
        return redirect('/');
    }


}
