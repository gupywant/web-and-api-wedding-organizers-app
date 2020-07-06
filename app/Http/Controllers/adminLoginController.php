<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Input;
use Redirect;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin;
use Illuminate\Support\Facades\Validator;
use Session;

class adminLoginController extends Controller{
     
    public function index(){
    	return view('login');
    }

    public function login(Request $request){
    	$Admin = Admin::where('username',$request->username)->first();
    	if(!empty($Admin)){
    		if(Hash::check($request->password,$Admin->password)){
    			Session::put('admin',true);
    			Session::put('username',$request->username);
                Session::put('id',$Admin->id_admin);
    			Session::put('role',$Admin->type);
    			return redirect(route('user.dashboard'));
    		}else{
    			return back()->with('alert','Username atau password salah');
    		}
    	}else{
    		return back()->with('alert','Username atau password salah');
    	}
    }

    public function logout(){
        Session::flush();
        return redirect(route('login'))->with('message','Logout Berhasil');
    }
}
