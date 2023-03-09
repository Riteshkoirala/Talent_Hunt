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
    public function signUpGoogle(Request $request){

        session(['role' =>$request->role]);
        return Socialite::driver('google')
            ->redirect();
    }
    public function getData(Request $request)
    {
        $user = Socialite::driver('google')->user();
        $email = $user->email;

        if(!session('role')) {
            $findUser = User::where('email', $email)->first();

            if ($findUser) {
                Auth::login($findUser, true);

                if ($findUser->role == 'seeker') {
                    return redirect()->intended(RouteServiceProvider::HOME);
                } else {
                    return redirect()->intended(RouteServiceProvider::RECRUITER);
                }
            }
        }
        else {

            $validator = Validator::make(
                ['email' => $email],
                ['email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class]],
            );

            if ($validator->fails()) {
                $request->session()->forget('role');
                $errors = $validator->errors();
                foreach ($errors->all() as $error) {
                    echo $error . '<br>';
                }
            } else {
                $user = User::create([
                    'email' => $user->email,
                    'email_verified_at' => Carbon::now(),
                    'role' => session('role'),
                ]);
                $request->session()->forget('role');
                Auth::login($user, true);

                if ($user->role == 'seeker') {
                    return redirect()->intended(RouteServiceProvider::HOME);
                } else {
                    return redirect()->intended(RouteServiceProvider::RECRUITER);
                }
            }
        }
    }

    public function create(){
        return view('auth.role');
    }

    public function signInGoogle(){

        return Socialite::driver('google')
            ->redirect();
    }


}
