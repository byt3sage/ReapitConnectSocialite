<?php

namespace JaeTooleDev\ReapitConnectSocialite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

use Laravel\Socialite\Facades\Socialite;

class ReapitConnectLoginController extends Controller
{

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/reapit/success';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function redirectToProvider()
    {
        return Socialite::driver('reapit_connect')->redirect();
    }

    public function handleProviderCallback()
    {
        $reapitUser = Socialite::driver('reapit_connect')->user();

        if($user = User::where('email', $reapitUser->user['email'])->first()) {
            if(Auth::loginUsingId($user->id)) {
                return redirect()->route($this->redirectTo);
            }
        }
        $user = User::create([
            'name' => $reapitUser->user['name'],
            'email' => $reapitUser->user['email'],
            'password' => bcrypt($reapitUser->user['email'] . date('Y-m-d', strtotime(now())))
        ]);
        if(Auth::loginUsingId($user->id)) {
            return redirect()->route($this->redirectTo);
        }
    }
}
