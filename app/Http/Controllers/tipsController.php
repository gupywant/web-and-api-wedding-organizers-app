<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Tips;
use Session;
use File;

class tipsController extends Controller
{
    public function list(Request $request){
        $data['tips'] = Tips::where('id_tips',$request->id_tips)->first();
        $data['status'] = 'success';
        
        return response($data, 200, ['Content-Type => application/json']);
    }

    public function tips(){
    	$data['tips'] = Tips::all();
    	return view('user.tipsList',$data);
    }

    public function tipsAdd(Request $request){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }

    	date_default_timezone_set("Asia/jakarta");
    	$date = date('Y-m-d H:i:s');

    	$tipsAdd = new Tips;
    	$tipsAdd->title = $request->title;
    	$tipsAdd->content = $request->content;
    	$tipsAdd->updated_at = $date;
    	$tipsAdd->created_at = $date;
    	$tipsAdd->save();

    	$file = $request->file('image');
    	if(!empty($file)){
	        //image check
	        $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml'];
	        $contentType = $file->getClientMimeType();

	        if(! in_array($contentType, $allowedMimeTypes) ){
	        	Tips::where('id_tips',$tipsAdd->id)->delete();
	            return back()->with('alert','Upload Hanya gambar');
	        }

	        $path = public_path().'/filesdat/tips/'.$tipsAdd->id;
	        if (!file_exists($path)) {
	            File::makeDirectory($path, $mode = 0777, true, true);
	        }

	        $file->move($path,$file->getClientOriginalName());

	        $update = array(
	        		'image' => $file->getClientOriginalName()
	        	);
	        Tips::where('id_tips',$tipsAdd->id)->update($update);
	    }

    	return back()->with('message','Tips berhasil ditambahkan');
    }

    public function deleteTips($id){
    	Tips::where('id_tips',$id)->delete();

    	return back()->with('message','Tips berhasil dihapus');
    }
}
