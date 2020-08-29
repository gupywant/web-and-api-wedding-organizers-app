<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Model\Admin;
use App\Model\User;
use App\Model\Item;
use App\Model\ItemImage;
use App\Model\ItemBooking;
use App\Model\ItemBookmark;
use App\Model\ItemView;
use App\Model\ItemViewUser;
use Session;

class adminController extends Controller
{
	
    public function addUserIndex(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
        
    	return view('user.userAdd');
    }

    public function addUser(Request $request){
    	date_default_timezone_set("Asia/jakarta");
    	$date = Date('Y-m-d H:m:s');

    	if($request->userType!=3){
    		$email = Admin::where('username',$request->username)->first();
    		if(!empty($email)){
    			return back()->with('alert','Email Sudah dipakai');
    		}
    		if(empty($request->company)){
    			return back()->with('alert','Masukkan Nama Perusahaan');
    		}

	    	$userAdd = new Admin;
	    	$userAdd->username = $request->username;
	    	$userAdd->name = $request->name;
	    	$userAdd->password = Hash::make("N3wUser");
	    	$userAdd->type = $request->userType;
	    	$userAdd->gender = $request->gender;
	    	$userAdd->tlp = $request->tlp;
	    	$userAdd->address = $request->address;
	    	$userAdd->city = $request->city;
	    	$userAdd->birth_date = $request->birth_date;
	    	$userAdd->company_name = $request->company;
	    	$userAdd->province = $request->province;
	    	$userAdd->postal_code = $request->postal_code;
	    	$userAdd->created_at = $date;
	    	$userAdd->updated_at = $date;
	    	$userAdd->description = $request->description;
	    	$userAdd->activate = 1;
	    	$userAdd->save();
	    }else{
	    	$email = User::where('username',$request->username)->first();
    		if(!empty($email)){
    			return back()->with('alert','Email Sudah dipakai');
    		}


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
	    	$userAdd->activate = 1;
	    	$userAdd->save();
	    }

	    return back()->with('message','Silahkan Login dengan email yang didaftarkan dan passwod "N3wUser"');
    }

    public function ownUpdate(Request $request){
    	date_default_timezone_set("Asia/jakarta");
    	$date = date('Y-m-d');	
    	$id = Session::get('id');
		$update = array(
			'username' => $request->username, 
			'name' => $request->name,
			'type' => $request->userType,
			'gender' => $request->gender,
			'tlp' => $request->tlp,
			'address' => $request->address,
			'city' => $request->city,
			'birth_date' => $request->birth_date,
			'company_name' => $request->company,
			'province' => $request->province,
			'postal_code' => $request->postal_code,
			'description' => $request->description,
			'updated_at' => $date
		);

		Admin::where('id_admin',$id)->update($update);

    	return back()->with('message','Data Berhasil Diupdate');
    }

    public function adminUpdate(Request $request,$id){
    	date_default_timezone_set("Asia/jakarta");
    	$date = date('Y-m-d');	
		$update = array(
			'username' => $request->username, 
			'name' => $request->name,
			'type' => $request->userType,
			'gender' => $request->gender,
			'tlp' => $request->tlp,
			'address' => $request->address,
			'city' => $request->city,
			'birth_date' => $request->birth_date,
			'company_name' => $request->company,
			'province' => $request->province,
			'postal_code' => $request->postal_code,
			'description' => $request->description,
			'updated_at' => $date
		);

		Admin::where('id_admin',$id)->update($update);

    	return back()->with('message','Data Berhasil Diupdate');
    }

    public function userUpdate(Request $request,$id){
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

		User::where('id_user',$id)->update($update);

    	return back()->with('message','Data Berhasil Diupdate');
    }

    public function deleteAdmin($id){
    	$item = Item::where('id_admin',$id)->get();
    	foreach ($item as $key => $value) {
    		ItemBookmark::where('id_item',$value->id_item)->delete();
	    	ItemImage::where('id_item',$value->id_item)->delete();
	    	ItemBooking::where('id_item',$value->id_item)->delete();
            $idView = ItemView::where('id_item',$value->id_item)->first();
            ItemViewUser::where('id_view',$idView->id_view)->delete();
	    	ItemView::where('id_item',$value->id_item)->delete();
	    }
    	Item::where('id_admin',$id)->delete();
    	Admin::where('id_admin',$id)->delete();
    	return back()->with('message','Admin Berhasil Dihapus');
    }

    public function deleteUser($id){
    	ItemBooking::where('id_user',$id)->delete();
        ItemViewUser::where('id_user',$id)->delete();
    	ItemBookmark::where('id_user',$id)->delete();
    	User::where('id_user',$id)->delete();

    	return back()->with('message','User Berhasil Dihapus');
    }

    public function resetPasswordAdmin($id){
    	date_default_timezone_set("Asia/jakarta");
    	
    	$update = array('password' => Hash::make('N3wUser') );
    	Admin::where('id_admin',$id)->update($update);
    	return back()->with('message','Password Berhasil direset, Login dengan password <strong>N3wUser</strong>');
    }

    public function resetPasswordUser($id){
    	$update = array('password' => Hash::make('N3wUser') );
    	User::where('id_user',$id)->update($update);
    	return back()->with('message','Password Berhasil direset, Login dengan password <strong>N3wUser</strong>');
    }

    public function adminDetail($id){
    	$data['user'] = Admin::where('id_admin',$id)->first();
    	$data['id'] = $data['user']->id_admin;
    	$data['route'] = route('user.adminUpdate',$data['user']->id_admin);
    	return view('user.userDetail',$data);
    }

    public function userDetail($id){
    	$data['user'] = User::where('id_user',$id)->first();
    	$data['id'] = $data['user']->id_user;
    	$data['route'] = route('user.userUpdate',$data['user']->id_user);
    	return view('user.userDetail',$data);
    }

    public function ownDetail(){
    	$data['user'] = Admin::where('id_admin',Session::get('id'))->first();
    	$data['id'] = $data['user']->id_Admin;
    	$data['route'] = route('user.ownUpdate');
    	return view('user.ownDetail',$data);
    }

    public function userListIndex(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
    	$data['user'] = User::all();
    	$data['table'] = true;
    	return view('user.userList',$data);
    }

    public function adminListIndex(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
    	$data['admin'] = Admin::all();
    	$data['table'] = true;
    	return view('user.adminList',$data);
    }

    public function changePassword(Request $request){
    	$old = Admin::where('id_admin',Session::get('id'))->first();
    	if(!Hash::check($request->oldpw,$old->password)){
			return back()->with('alert','Password lama salah');
    	}
    	if($request->pw!=$request->pw2){
    		return back()->with('alert','Password Baru dan Konfirmasi tidak sama');
    	}
    	if(strlen($request->pw)<8){
			return back()->with('alert','Password minimal 8 karakter');	
		}
		$update = array('password' => Hash::make($request->pw) );
		Admin::where('id_admin',Session::get('id'))->update($update);
		return back()->with('message','Password Berhasil Diubah');
    }
}
