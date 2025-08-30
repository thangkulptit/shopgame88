<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\UserClient;

class LoginClientController extends Controller
{
    use AuthenticatesUsers;
    public function redirectToProvider($driver)
    {
        return Socialite::driver($driver)->redirect();
    }

    public function handleProviderCallback($driver) {
        try {
            $user = Socialite::driver($driver)->user();
        } catch (\Exception $e) {
            return redirect()->route('login');
        }

        $existingUser = UserClient::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser                    = new UserClient;
            $newUser->name_social       = $driver;
            $newUser->uid               = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->avatar            = $user->getAvatar();
            $newUser->money             = 0;
            $newUser->key               = 0;
            $newUser->save();
            auth()->login($newUser, true);
        }
        return redirect($this->redirectPath());
    }

    public function postLogin(Request $request){
        if ($request->ajax()) {
            $arrLogin = [
                'username' => $request->get('username_login'),
                'password' => $request->get('password_login')
            ];
            if (Auth::guard('users_client')->attempt($arrLogin)) {
                if( Auth::guard('users_client')->check() ) {
                    return response()->json([
                        'error' => false,
                        'msg' => 'Đăng nhập thành công!',
                        'status' => 'success'
                    ]);
                }
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'Tài khoản hoặc mật khẩu không đúng'
                ]);
            }
        }
    }
}
