<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function userindex(){

            // $user = DB::table('users')->get();
            //                return view('user_index',['bien'=>$user]);
        // view('',['key'=>$val])

            $user = User::get();
            return $user;
    }
    public function show(){
        return view('user_index');
    }
    public function datatables(){
        $user = DB::table('users')->get();

        return view('datatables',['user'=>$user]);
    }
}
