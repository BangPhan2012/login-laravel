<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\MessageBag;

class AuthController extends Controller
{
    public function postRegister(Request $req){
        $this -> validate($req,
            [
                'email'=>'required|email|unique:user1,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'vui long nhập email',
                'email.email'=>'không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự'
            ]);
        $user = new User();
        $user ->name = $req ->fullname;
        $user ->email = $req ->email;
        $user ->password = Hash::make($req->password);
        $user -> save();
        return redirect() -> back() -> with('thanhcong','Tạo tài khoản thành công');
    }

    public function postLogin(Request $req){
        $rules =[
            
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
        ];
        $message =[
                'email.required'=>'vui long nhập email',
                'email.email'=>'không đúng định dạng email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu không được quá 20 ký tự'
        ];  

        
        $validator = Validator::make($req->all(), $rules, $message);

        if($validator -> fails()){
                return response() -> json([
                    'errors' => true,
                    'code' => 1,
                    'message' => $validator ->errors()
                ],200);
            }
        else {
                $email =$req->input('email');
                $password = $req->input('password');


                if(Auth::attempt(['email'=>$email, 'password'=>$password] , $req->has('remember'))){
                    return response()->json([
                        'errors' => false,                        
                        'message' =>'success'

                    ],200);
                }
                else {
                    # code...
                    $errors = 'Email hoac mật khẩu không đúng';
                    return response()->json([
                        'errors'=>true,
                        'message'=>$errors
                    ],200);
                }
                
            }







            
           
    }
}
