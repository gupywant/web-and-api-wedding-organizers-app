<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemBookmark;
use App\Model\User;

class bookmarkController extends Controller
{
    public function add(Request $request){
    	date_default_timezone_set("Asia/jakarta");
    	$date = Date('Y-m-d H:m:s');

    	$user = User::where('token',$request->token)->first();
    	$bookmarkCheck = ItemBookmark::where([['id_user',$user->id_user],['id_item',$request->id_item]])->first();
    	if(empty($bookmarkCheck)){
    		$new = new ItemBookmark;
    		$new->id_user = $user->id_user;
    		$new->id_item = $request->id_item;
    		$new->created_at = $date;
    		$new->updated_at = $date;
    		$new->save();

    		$data["message"] = "Berhasil tambah ke bookmark";
    		$data["status"] = "success";
    	}else{
    		$data["message"] = "Service sudah pernah dibookmark";
    		$data["status"] = "failed";
    	}

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function list(Request $request){
    	$user = User::where('token',$request->token)->first();
    	$data['list'] = ItemBookmark::selectRaw('item.name,item.city,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_bookmark.*')->leftJoin('item','item.id_item','=','item_bookmark.id_item')->where('id_user',$user->id_user)->get();
        $data["status"] = "success";

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function delete(Request $request){
    	ItemBookmark::where('id_bookmark',$request->id_bookmark)->delete();
    	$data["message"] = "Bookmark berhasil dihapus";
    	$data["status"] = "success";


    	return response($data, 200, ['Content-Type => application/json']);

    }
}
