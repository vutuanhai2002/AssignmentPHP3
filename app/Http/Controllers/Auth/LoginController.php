<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }
    public  function postLogin(Request $request) {
        $rules = [
            'email'=>'required|email',
            'password'=>'required'
        ];
        $messages = [
            'email.required'=> 'Mời bạn nhập email',
            'email.email'=> 'Mời bạn nhập đúng định dạng email',
            'password.required'=> 'Mời bạn nhập password',

        ];
        $valadator = Validator::make($request->all(),$rules,$messages);
        if($valadator->fails()){
            return redirect('login')->withErrors($valadator);
        }else {
            $email = $request->input('email');
            $password = $request->input('password');
            if(Auth::attempt(['email'=>$email, 'password'=>$password])) {
                return redirect('/');
            }else {
                Session::flash('error', 'Sai tài khoản mật khẩu');
                return  redirect('login');
            }
        }
    }
    public function getSignup(){

        return view('auth.signup');
    }

    public function postSignup(AuthRequest $request){

        $params = [];
        $params['cols'] = $request->post();
        unset($params['cols']['_token']);
        $modelUser= new Account();
        if($params['cols']['repassword'] != $params['cols']['password']){
            return redirect('signup')->with('error', 'Mật khẩu nhập lại không khớp !')->withInput();
        }
        unset($params['cols']['repassword']);
        $res = $modelUser->saveNewUser($params);
        if ($res > 0) {
            Session::flash('success', 'Tạo tài khoản thành công. Đăng nhập ngay!');
            return redirect('/login');
        }else {
            Session::flash('error', 'Lỗi thêm mới');
            return redirect('/signup');
        }

    }


    public function  getLogout() {
        Auth::logout();
        return redirect('login');
    }
}
