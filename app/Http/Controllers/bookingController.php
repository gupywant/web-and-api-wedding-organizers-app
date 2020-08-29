<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemBooking;
use App\Model\User;

class bookingController extends Controller
{
    public function add(Request $request){
    	$user = User::where('token',$request->token)->first();
    	$start_date = $request->start_date." 00:00:00";
    	$end_date = $request->end_date." 23:59:00";
    	$checkBooking = ItemBooking::whereRaw("(start_date between '$start_date' and '$end_date') or (end_date between '$start_date' and '$end_date') and id_item=$request->id_item")->get();
    	if(empty($checkBooking[0]->start_date)){
    		$new = new ItemBooking;
    		$new->id_user = $user->id_user;
    		$new->id_item = $request->id_item;
    		$new->start_date = $start_date;
    		$new->end_date = $end_date;
    		$new->status = 0;
    		$new->save();

    		$data["message"] = "Booking berhasil direquest";
    		$data["status"] = "success";
    	}else{
    		$data["message"] = "$request->id_item | $request->start_date 00:00:00";
    		$data["status"] = "failed";
    	}
    	return response($data, 200, ['Content-Type => application/json']);

    }

    public function requesting(Request $request){
    	$user = User::where('token',$request->token)->first();
    	$data['list'] = ItemBooking::selectRaw('item.name,item.city,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_booking.*')->leftJoin('item','item.id_item','=','item_booking.id_item')->where([['id_user',$user->id_user],['status',0]])->get();

    	$data["status"] = "success";

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function reserved(Request $request){
    	$user = User::where('token',$request->token)->first();
    	$data['list'] = ItemBooking::selectRaw('item.name,item.city,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_booking.*')->leftJoin('item','item.id_item','=','item_booking.id_item')->where([['id_user',$user->id_user],['status',1]])->get();

    	$data["status"] = "success";

    	return response($data, 200, ['Content-Type => application/json']);
    }

    public function delete(Request $request){
    	ItemBooking::where('id_booking',$request->id_booking)->delete();
    	$data["message"] = "Booking berhasil dicancel";
    	$data["status"] = "success";


    	return response($data, 200, ['Content-Type => application/json']);

    }
}
