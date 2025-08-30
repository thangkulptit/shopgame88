<?php

namespace App\Http\Controllers\front;
use App\UserClient;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    public function postRegister(Request $request) {
        if($request->ajax()) {
            $username = $request->get('username_register');
            $password = $request->get('password_register');
            $email = $request->get('email_register');
            $fullname = $request->get('fullname_register');

            if (isset($username)) {
                $user = UserClient::where('username', $username);
                if ($user->exists()) {
                    return response()->json([
                        'error' => true,
                        'msg' => 'Tài khoản đã tồn tại!'
                    ]);
                }
            }
            $uid = $this->getUIDrandom();

            $userClient = new UserClient();
            $userClient->uid = $uid;
            $userClient->username = $username;
            $userClient->password = bcrypt($password);
            $userClient->email = $email;
            $userClient->name = $fullname;
            $userClient->money = 0;
            $userClient->key = 0;
            $userClient->save();
            if (Auth::guard('users_client')->attempt(['username'=>$username, 'password'=>$password])) {
                if(Auth::guard('users_client')->check()) {
                    return response()->json([
                        'error' => false,
                        'msg' => 'Đăng ký tài khoản thành công!'
                    ]);
                }
                
            } else {
                return response()->json([
                    'error' => true,
                    'msg' => 'Đăng ký tài khoản thất bại!'
                ]);
            }
            
        }
    }

    public function getUIDrandom() {
        do {
           $uid = rand(1000, 999999999);
           $checkUIDExisted = UserClient::where('uid', $uid); 
        }while($checkUIDExisted->exists());
        return $uid;
    }
}
