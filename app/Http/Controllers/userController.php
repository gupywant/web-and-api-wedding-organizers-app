<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
use Mail;

class userController extends Controller
{
    public function login(Request $request){
    	$checkUser = User::where("username",$request->username)->first();
    	if(!empty($checkUser)){
    		if(Hash::check($request->password,$checkUser->password)){
    			$data["status"] = "success";
			    $data['message'] = "Login Berhasil";
			    $data['token'] = $checkUser->token;
    		}else{
    			$data["status"] = "failed";
   				$data['message'] = "Email Atau Password Salah";
   				$data['token'] = null;
    		}
    	}else{
    		$data["status"] = "failed";
   			$data['message'] = "Email Atau Password Salah";
   			$data['token'] = null;
    	}
    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function register(Request $request){
    	date_default_timezone_set("Asia/jakarta");
    	$date = Date('Y-m-d H:m:s');

    	$checkUser = User::where("username",$request->username)->first();
    	if(empty($checkUser)){
            if(strlen($request->password)>=8){
                if($request->password==$request->passwordConfirm){
        	    	$rand = str_random(8);
        	    	$userAdd = new User;
        	    	$userAdd->username = $request->username;
        	    	$userAdd->name = $request->name;
        	    	$userAdd->password = Hash::make("N3wUser");
        	    	$userAdd->gender = $request->gender;
        	    	$userAdd->tlp = $request->tlp;
        	    	$userAdd->address = $request->address;
        	    	$userAdd->city = $request->city;
        	    	$userAdd->birth_date = $request->birth_date;
        	    	$userAdd->province = $request->province;
        	    	$userAdd->postal_code = $request->postal_code;
        	    	$userAdd->created_at = $date;
        	    	$userAdd->updated_at = $date;
        	    	$userAdd->description = $request->description;
        	    	$userAdd->token = Hash::make($request->username.$rand);
        	    	$userAdd->activate = 0;
        	    	$userAdd->save();

                    try{
                        Mail::send('email', ['link' => route('user.activation',$userAdd->token)], function ($message) use ($request)
                        {
                            $message->subject("Aktifasi Pendaftaran - Bride Moment");
                            $message->to($request->username);
                        });
                    }catch(Exception $e){
                        $data += array('status' => "failed",'message' => $e->getMessage());
                    }

        	    	$data["status"] = "success";
           			$data['message'] = "Berhasil Terdaftar";
                }else{
                    $data["status"] = "failed";
                    $data['message'] = "Password Tidak Sama";
                }
            }else{
                $data["status"] = "failed";
                $data['message'] = "Password Minimal 8 Karakter";  
            }
	    }else{
	    	$data["status"] = "failed";
   			$data['message'] = "Email Sudah Dipakai";
	    }
    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function update(Request $request){
    	date_default_timezone_set("Asia/jakarta");
    	$date = date('Y-m-d');	
		$update = array(
			'username' => $request->username, 
			'name' => $request->name,
			'gender' => $request->gender,
			'tlp' => $request->tlp,
			'address' => $request->address,
			'city' => $request->city,
			'province' => $request->province,
			'postal_code' => $request->postal_code,
			'description' => $request->description,
			'updated_at' => $date
		);

		User::where('token',$return->token)->update($update);

		$data["status"] = "success";
   		$data['message'] = "Profile Berhasil Diupdate";

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function password(Request $request){
    	$update = array('password' => $request->password );
    	User::where('token',$request->token)->update($update);

		$data["status"] = "success";
   		$data['message'] = "Password Berhasil Diupdate";

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function profile(Request $request){
    	$data['profile'] = User::where('token',$request->token)->first();

    	$data["status"] = "success";

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function activation($key){
        $update = array(
            "activate" => 1
        );
        User::where('token',$key)->update($update);

        echo "<script>alert('aktivasi selesai')</script>";
    }
}
