<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class GoogleSigninController extends Controller
{

    public function signUpGoogle(Request $request) {
        $request->validate([
            'role'=>'required',
        ]);
        $role = $request->role;

        return Socialite::driver('google')
            ->with(['state' => 'value='.$role])
            ->redirect();
    }

    public function getData(Request $request) {
        $user = Socialite::driver('google')->stateless()->user();
        $email = $user->email;

        $roles = $request->input('state');
        parse_str($roles, $result);

        $user = User::firstOrNew(['email' => $email]);

        if (!$user->exists) {
            if (empty($result['value'])) {
                return view('auth.role')->with('message','You have not registered so register yourself first');
            } else {
                $user->fill([
                    'email_verified_at' => Carbon::now(),
                    'role' => $result['value'],
                ])->save();
            }
        }

        Auth::login($user, true);

        $redirectRoute = ($user->role == 'seeker') ? RouteServiceProvider::HOME : RouteServiceProvider::RECRUITER;
        return redirect()->intended($redirectRoute);
    }

    public function create() {
        return view('auth.role');
    }

    public function signInGoogle() {
        return Socialite::driver('google')
            ->with(['state' => 'value='])
            ->redirect();
    }
}
