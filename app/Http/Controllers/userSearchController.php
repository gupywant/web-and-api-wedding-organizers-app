<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Item;
use App\Model\ItemType;
use App\Model\ItemImage;

class userSearchController extends Controller
{

	public function lokasi(Request $request){
		$data['city'] = Item::select('city')->groupBy('city')->get();

		return response($data, 200, ['Content-Type => application/json']);		
	}

	public function kategori(Request $request){
		$data['type'] = ItemType::select('name')->groupBy('name')->get();

		return response($data, 200, ['Content-Type => application/json']);		
	}

	public function result(Request $request){
		$tipe = ItemType::where('name',$request->type)->first();
		$data['item'] = Item::selectRaw('item.*,(select file_name from item_image a where id_image = (select min(id_image) from item_image where id_item = item.id_item )) as file_name,item_type.name as type_name')->leftJoin('item_type','item.id_type','=','item_type.id_type')->where([['item.city',$request->lokasi],['item.id_type',$tipe->id_type],['item.price_day','>=',$request->min],['item.price_day','<=',$request->max],['item.name','like',"%$request->search%"]])->get();


		return response($data, 200, ['Content-Type => application/json']);	
	}

	public function detail(Request $request){
		$data['item'] = Item::where('id_item',$request->id_item)->first();
		$data['image'] = ItemImage::where('id_item',$request->id_item)->get();

		return response($data, 200, ['Content-Type => application/json']);
	}
    
}
