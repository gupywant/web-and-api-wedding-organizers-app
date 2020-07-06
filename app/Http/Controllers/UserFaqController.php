<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Faq;

class UserFaqController extends Controller
{
    public function faq(Request $request){
    	$data['faq'] = Faq::get();

    	$data["status"] = "success";

    	return response($data, 200, ['Content-Type => application/json']);
    }
}
