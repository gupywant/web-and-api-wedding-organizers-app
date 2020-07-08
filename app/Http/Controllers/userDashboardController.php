<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemType;
use App\Model\ItemImage;
use App\Model\Item;
use App\Model\ItemBooking;
use App\Model\ItemView;
use App\Model\ItemBookmark;
use App\Model\User;
use App\Model\Tips;

class userDashboardController extends Controller
{
    public function dashboard(Request $request){
    	$user = User::where('token',$request->token)->first();
    	$data['user'] = substr($user->name,0,20);
    	$data['banner'] = Item::selectRaw('item.*,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item)) as file_name,item_type.name as type_name')->leftJoin('item_type','item.id_type','=','item_type.id_type')->limit(5)->get();
    	$data['popularVenue'] = Item::selectRaw('item.*,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_type.name as type_name')->leftJoin('item_type','item.id_type','=','item_type.id_type')->leftJoin('item_view','item_view.id_item','=','item.id_item')->where('item_type.name','venue')->orderBy('item_view.count','desc')->limit(5)->get();
    	$data['nearVenue'] = Item::selectRaw('item.*,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_type.name as type_name')->leftJoin('item_type','item.id_type','=','item_type.id_type')->where("item.city",'like',"%$user->city%")->limit(5)->get();
    	$data['tips'] = Tips::get();
        $data['status'] = 'success';
    	
    	return response($data, 200, ['Content-Type => application/json']);

    }
}
