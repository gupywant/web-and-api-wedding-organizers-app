<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\ItemType;
use App\Model\ItemImage;
use App\Model\Item;
use App\Model\ItemBooking;
use App\Model\ItemView;
use App\Model\ItemBookmark;
use Session;
use File;

class itemController extends Controller
{
    public function allServiceListIndex(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
        
        $data['item'] = Item::selectRaw('item.*,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_type.name as type_name')->leftJoin('item_type','item.id_type','=','item_type.id_type')->get();
        $data['table'] = true;
    	return view('user.allServiceList',$data);
    }

    public function ownServiceListIndex(){
        $data['item'] = Item::selectRaw('item.*,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_type.name as type_name')->leftJoin('item_type','item.id_type','=','item_type.id_type')->where('item.id_admin',Session::get('id'))->get();
        $data['table'] = true;
    	return view('user.ownServiceList',$data);
    }

    public function serviceTypeIndex(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
        $data['type'] = ItemType::all();
        $data['table'] = true;
    	return view('user.serviceTipe',$data);
    }

    public function serviceTypeAdd(Request $request){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
        date_default_timezone_set("Asia/jakarta");

        $date = Date('Y-m-d H:i:s');
        $ftype = ItemType::where('name',$request->name)->first();
        if(empty($ftype)){
            $type = new ItemType;
            $type->name = $request->name;
            $type->description = $request->description;
            $type->updated_at = $date;
            $type->created_at = $date;
            $type->save();
            return back()->with('message','Tipe berhasil ditambah');
        }else{
            return back()->with('alert','Tipe Sudah Ada');
        }
    }

    public function serviceAddIndex(){
        $data['type'] = ItemType::all();
    	return view('user.serviceAdd',$data);
    }

    public function serviceAddNew(Request $request){
        date_default_timezone_set("Asia/jakarta");

        $date = Date('Y-m-d H:i:s');

       //add item
        $itemAdd = new Item;
        $itemAdd->id_admin = Session::get('id');
        $itemAdd->id_type = $request->type;
        $itemAdd->name = $request->name;
        $itemAdd->price_day = $request->price;
        $itemAdd->description = $request->descriptions;
        $itemAdd->address = $request->address;
        $itemAdd->city = $request->city;
        $itemAdd->province = $request->province;
        $itemAdd->postal_code = $request->postal_code;
        $itemAdd->updated_at = $date;
        $itemAdd->created_at = $date;
        $itemAdd->save();

        //add image
        $allFile = $request->file('foto');
        foreach ($request->foto as $key => $data) {
            $file = $allFile[$key];
            //image check
            $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
            $contentType = $file->getClientMimeType();

            if(! in_array($contentType, $allowedMimeTypes) ){
                return back()->with('alert','Upload Hanya gambar');
            }

            $path = public_path().'/filesdat/'.$itemAdd->id;
            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $file->move($path,$file->getClientOriginalName());

            $addImage = new ItemImage;
            $addImage->id_item = $itemAdd->id;
            $addImage->file_name = $file->getClientOriginalName();
            $addImage->updated_at = $date;
            $addImage->created_at = $date;
            $addImage->save();
        }

        return back()->with('message','service berhasil ditambah');
        /*$file = $request->file('foto');
        foreach ($request->foto as $key => $value) {
            $n = $file[0]->getClientMimeType();
            dd($n);
            //print_r($request->file("foto[$key]"));
        }*/
    }

    public function serviceUpdate(Request $request,$id){
        date_default_timezone_set("Asia/jakarta");
        
        $date = date('Y-m-d H:i:s');
        $update = array(
                'name' => $request->name,
                'price_day' => $request->price,
                'description' => $request->description,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code,
                'updated_at' => $date 
            );
        Item::where('id_item',$id)->update($update);
        //add image
        $allFile = $request->file('foto');
        foreach ($request->foto as $key => $data) {
            $file = $allFile[$key];
            //image check
            $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
            $contentType = $file->getClientMimeType();

            if(! in_array($contentType, $allowedMimeTypes) ){
                return back()->with('alert','Upload Hanya gambar');
            }

            $path = public_path().'/filesdat/'.$id;
            if (!file_exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $file->move($path,$file->getClientOriginalName());

            $addImage = new ItemImage;
            $addImage->id_item = $id;
            $addImage->file_name = $file->getClientOriginalName();
            $addImage->updated_at = $date;
            $addImage->created_at = $date;
            $addImage->save();
        }
        return back()->with('message','Service Berhasil Diupdate');
    }

    public function imageDelete($id){
        ItemImage::where('id_image',$id)->delete();
        return back()->with('message','Gambar Telah Dihapus');
    }

    public function serviceDetail($id){
        $data['item'] = Item::where('id_item',$id)->first();
        $data['type'] = ItemType::all();
        $data['image'] = ItemImage::where('id_item',$id)->get();
        return view('user.serviceDetail',$data);
    }

    public function serviceDelete($id){
        $item = Item::where('id_item',$id)->get();
        foreach ($item as $key => $value) {
            ItemImage::where('id_item',$id)->delete();
            ItemView::where('id_item',$id_item)->delete();
            ItemBooking::where('id_item',$id)->delete();
            ItemBookmark::where('id_item',$id)->delete();
        }
        Item::where('id_item',$id)->delete();

        return back()->with('message','Service Berhasil Dihapus');
    }

    public function serviceImageDelete($id){
        ItemImage::where('id_image',$id)->delete();
        return back()->with('message','Gambar Berhasil Dihapus');
    }

}
