<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Model\Item;
use App\Model\ItemBooking;
use App\Model\User;

class adminBookingController extends Controller
{
    
    public function bookingList(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }

    	$data['booking'] = ItemBooking::selectRaw('user.name as user_name,item.name,item.city,admin.company_name,admin.name as admin_name,item_type.name as type_name,item_booking.*')->leftJoin('item','item.id_item','item_booking.id_item')->leftJoin('admin','admin.id_admin','=','item.id_admin')->leftJoin('item_type','item_type.id_type','item.id_type')->leftJoin('user','user.id_user','item_booking.id_user')->orderBy('admin.name')->get();
    	$data['table'] = true;
        return view('user.bookingList',$data);
    }

    public function bookingAddIndex(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }

    	$data['user'] = User::orderBy('username')->get();
    	$data['services'] = Item::select('item.*','admin.company_name')->leftJoin('admin','admin.id_admin','=','item.id_admin')->orderBy('admin.name')->get();
    	$data['select'] = true;
    	return view('user.bookingAdd',$data);
    }

    public function bookingDate(Request $request){
    	$all = ItemBooking::selectRaw('start_date ,end_date')->leftJoin('item','item.id_item','=','item_booking.id_item')->where('item.id_item',$request->id_item)->get();
    	$data['disableDate']  = array();
    	foreach ($all as $key => $value) {
    		$new = array("from"=>substr($value->start_date,0,10),"to"=>substr($value->end_date,0,10));
    		array_push($data['disableDate'],$new);
    	}
    	echo json_encode($data);
    }

    public function bookingAddNew(Request $request){
    	$date = Date('Y-m-d');
        $start_date = $request->start_date." 00:00:00";
        $end_date = $request->end_date." 23:59:00";
        $checkBooking = ItemBooking::whereRaw("((start_date between '$start_date' and '$end_date') or (end_date between '$start_date' and '$end_date')) and id_item=$request->id_item")->first();
        if(empty($checkBooking)){    
            $booking = new ItemBooking;
            $booking->id_user = $request->id_user;
            $booking->id_item = $request->id_item;
            $booking->start_date = $request->start;
            $booking->end_date = $request->end;
            $booking->status = 0;
            $booking->created_at = $date;
            $booking->updated_at = $date;
            $booking->save();

            return back()->with('message','Booking Berhasil ditambahkan');
        }else{
            return back()->with('message','Tanggal sudah dipesan');
        }
    }

    public function bookingDelete($id){
    	ItemBooking::where('id_booking',$id)->delete();
    	return back()->with('message','Booking Berhasil Dihapus');
    }

    public function statusUpdate(Request $request,$id){
    	$update = array('status' => $request->status );
    	ItemBooking::where('id_booking',$id)->update($update);
    	return back()->with('message','Status Berhasil Diupdate');
    }

    public function ownBookingList(){
    	$data['booking'] = ItemBooking::selectRaw('item.name,item.city,admin.company_name,item_type.name as type_name,item_booking.*')->leftJoin('item','item.id_item','item_booking.id_item')->leftJoin('admin','admin.id_admin','=','item.id_admin')->leftJoin('item_type','item_type.id_type','item.id_type')->where('admin.id_admin',Session::get('id'))->orderBy('admin.name')->get();
    	$data['table'] = true;
    	return view('user.ownBookingList',$data);
    }
}
