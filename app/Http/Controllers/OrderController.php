<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Card;

class OrderController extends Controller
{
    public function index(Request $request){
    	$orders = Order::where('remark',$request->remark)->get();
    	return $orders;
    }
    
    public function randomCard(){
    	$card = Card::inRandomOrder()->first();
    	return $card;
    }
    
    public function report(Request $request){
    	$account = $request->account;
    	$status = $request->status;
    	$order = Order::where('account',$account)->first();
    	if($order){
    		$order->status = $status;
    		$order->save();
    	}
    }
}
