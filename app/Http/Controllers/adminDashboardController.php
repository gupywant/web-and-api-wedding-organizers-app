<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Item;
use App\Model\ItemView;
use App\Model\ItemViewUser;
use App\Model\ItemBooking;
use DateTime;
use Session;

class adminDashboardController extends Controller
{
    public function index(){
    	date_default_timezone_set("Asia/jakarta");

    	$dateFirst = date('Y-m-01 H:i:s');
    	
    	$date = date('Y-m-d H:i:s');
    	$date = new DateTime($date);
    	$date = $date->format('Y-m-d H:i:s');

    	$dateLast = new DateTime($date);
     	$dateLast = $dateLast->modify('first day of previous month');
    	$dateLastFirst = $dateLast->format('Y-m-d H:i:s');
    	$dateLastEnd = $dateLast->format('Y-m-t H:i:s');

    	$newUser = User::whereRaw("created_at >= '$dateFirst' and created_at <= '$date'")->count();
    	$oldUser = User::whereRaw("created_at >= '$dateLastFirst' and created_at <= '$dateLastEnd'")->count();

    	$itemUser = Item::where('id_admin',Session::get('id'))->get();
    	$newViews = 0;
    	foreach ($itemUser as $key => $value) {
    		$itemView = ItemView::where('id_item',$value->id_item)->get();
    		foreach ($itemView as $key => $val) {
	    		$a = ItemViewUser::whereRaw("id_view = $val->id_view and created_at >= '$dateFirst' and created_at <= '$date'")->count();
	    		$newViews += $a;
	    	}
    	}
    	$oldViews = 0;
    	foreach ($itemUser as $key => $value) {
    		$itemView = ItemView::where('id_item',$value->id_item)->get();
    		foreach ($itemView as $key => $val) {
	    		$a = ItemViewUser::whereRaw("id_view = $val->id_view and created_at >= '$dateLastFirst' and created_at <= '$dateLastEnd'")->count();
	    		$oldViews += $a;
	    	}
	    	$itemView = "";
    	}
    	

    	$newServiceReserved = 0;
    	foreach ($itemUser as $key => $value) {
    		$newServiceReserved += ItemBooking::whereRaw("id_item = $value->id_item and created_at >= '$dateFirst' and created_at <= '$date'")->count();
    	}
    	$oldServiceReserved = 0;
    	foreach ($itemUser as $key => $value) {
    		$oldServiceReserved = ItemBooking::whereRaw("id_item = $value->id_item and created_at >= '$dateLastFirst' and created_at <= '$dateLastEnd'")->count();
    	}

    	$visitGraf = Item::select('item.name','item_view.count')->leftJoin('item_view','item.id_item','=','item_view.id_item')->where('id_admin',Session::get('id'))->orderBy('item_view.count','desc')->limit(5)->get();

    	$data['newViews'] = (int)$newViews;
    	$data['oldViews'] = $oldViews;

    	if($oldViews==0){
    		$oldViews = 1;
    	}
    	$data['percentageViews'] = round(($newViews/$oldViews)*100,2);

    	$data['newUser'] = $newUser;
    	$data['oldUser'] = $oldUser;
    	if($oldUser==0){
    		$oldUser = 1;
    	}
    	$data['percentageUsers'] = round(($newUser/$oldUser)*100,2);

    	$data['service'] = Item::where('id_admin',Session::get('id'))->count();

    	$data['newServiceReserved'] = $newServiceReserved;
    	$data['oldServiceReserved'] = $oldServiceReserved;

    	if($oldServiceReserved==0){
    		$oldServiceReserved = 1;
    	}
    	$allServiceReserved = ItemBooking::count();
    	$ownServiceReserved = 0;
    	foreach ($itemUser as $key => $value) {
    		$ownServiceReserved += ItemBooking::whereRaw("id_item = $value->id_item")->count();
    	}
    	$data['servicePerformance'] = round(($ownServiceReserved/$allServiceReserved)*100,2);
    	$data['percentageRserverdSerivice'] = round(($newServiceReserved/$oldServiceReserved)*100,2);

    	$data['visitGraf'] = $visitGraf;

//echo json_encode($data);
return view('user.dashboard',$data);
    }
}
