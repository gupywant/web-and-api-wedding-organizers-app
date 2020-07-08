<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Faq;
use Session;

class AdminFaqController extends Controller
{
    public function index(){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }

    	$data['faq'] = Faq::get();
    	return view('user.faqList',$data);
    }

    public function faqAdd(Request $request){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }

    	date_default_timezone_set("Asia/jakarta");
    	$date = date('Y-m-d H:i:s');	

    	$addFaq = new Faq;
    	$addFaq->pertanyaan = $request->pertanyaan;
    	$addFaq->jawaban = $request->jawaban;
    	$addFaq->updated_at = $date;
    	$addFaq->created_at = $date;
    	$addFaq->save();

    	return back()->with('message','Faq Berhasil Ditambah');
    }

    public function deleteFaq($id){
        if(Session::get('role')!=1){
            return back()->with('alert','Akses Hanya Untuk Admin');
        }
        
        Faq::where('id_faq',$id)->delete();
        return back()->with('message','Faq Berhasil Dihapus');
    }
}
