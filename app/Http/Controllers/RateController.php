<?php

namespace App\Http\Controllers;

use App\models\Rate;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function rating(Request $request){
    	$rate = Rate::updateOrCreate(
		    ['order_id' => $request->order_id, 'user_id' => $request->user_id ],
		    ['rate_mark' => $request->rating]
		);
		return redirect()->back()->with('success', 'Cám ơn quý khách đã nhận xét sản phẩm.');;
    }
}
