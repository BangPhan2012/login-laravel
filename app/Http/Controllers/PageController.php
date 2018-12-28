<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function getIndex(){
        return view('wrapper');
    }

    public function getManager(){
        $user = User::all();
        // return $user;
        return view('site.datatb',['user'=>$user]);
    }

    public function getTopnavigation(){
        return view('site.Topnavigation');
    }

    public function getLogin(){
        return view('site.Login');
    }

    public function getRegister(){
        return view('site.Register');
    }

    public function deleteuser(Request $req){
       
             $flight = User::find($req->id);
             $flight->delete();
              
    }

    public function edituser($id)
    {
        $user = User::find($id);
        return $user;
        return view('datatb',['user'=>$user]);
    }


   
    public function postedituser(Request $request){

            $rules = [
                'fullnameedit' =>  'required|min:3|max:20',
                'emailedit' => 'required|min:4|max:23'
            ];
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
                return $validator->errors()->first();
            }else{
                try{
                    $data = [
                        'name' => $request->fullnameedit,
                        'email'=> $request->emailedit
                    ];
                    DB::beginTransaction();
                    $user = User::find($request->id)->update($data);
                    if($user){
                        DB::commit();
                        return redirect('index/manager')-> with('thanhcong','Updatee user thành công');
                    }else{
                        DB::rollback();
                        return "loi ko the update ";
                    }
                    return $user;
                }catch(\Exception $ex){
                    return redirect()->back()->with('error','loi roi');
                }
            }
            
        }
    
        public function adduser(){
            return view('site.adduser');
        }

        public function postadduser(Request $req){
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
            $user ->id = $req ->id;
            $user ->name = $req ->fullname;
            $user ->email = $req ->email;
            $user ->password = Hash::make($req->password);
            $user -> save();
            return redirect('index/manager')-> with('thanhcong','Thêm user thành công');
        }
    
   

    
}


