<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\models\Products;
use App\models\Cart;
use App\models\Transactions;
use App\models\Orders;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request){
        $cart = $request->session()->get('cart');

        $total = 0;
        foreach ($cart as $id => $item) {
            $product = Products::find($id);
            if($item->quantity > $product->product_quantity){
                return redirect('shopCarts')->withErrors('Sản phẩm '. $product->product_name .' này không còn đủ hàng như yêu cầu của bạn');
                break;
            }
            $total += $item->quantity * $product->product_price;
        }


        $transaction = Transactions::create([
            'user_id' => Auth::user()->id,                
            'total_money' => $total,               
            'status' => 1,               
        ]);
        foreach ($cart as $id => $item) {
            Products::find($id)->decrement('product_quantity', $item->quantity);
            $order = Orders::create([               
                'transaction_id' => $transaction->id,               
                'product_id' => $id,
                'quantity' => $item->quantity,
                'price' => $item->product_price,
                'status' => 1,              
            ]);
        }
        Cart::where('user_id', Auth::user()->id )->delete();
        
        $request->session()->put('cart', null);
        return redirect('home')->with('success', 'Đơn hàng đã được gửi. ');
        
    }

    // xoa san pham trong gio hàng
    public function rmProduct(Request $request){
        $cart = $request->session()->get('cart');
        if(array_key_exists($request->product_id,$cart)) {
            if( Auth::check() ){
                $item = Cart::where('user_id', Auth::user()->id )
                            ->where('product_id', $request->product_id)
                            ->delete();
            }
            unset($cart[$request->product_id]);
        }
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    // Change quantity of product
    public function chageQuatyProduct(Request $request){
        $cart = $request->session()->get('cart');
        if(array_key_exists($request->product_id,$cart)) {
            if( Auth::check() ){
                $item = Cart::where('user_id', Auth::user()->id )
                            ->where('product_id', $request->product_id)
                            ->update(['quantity' => $request->quantity ]);
            }
            $cart[$request->product_id]->quantity = $request->quantity;
        }
        $request->session()->put('cart', $cart);
        return redirect()->back();
    }

    // show carts
    public function shopCarts()
    {
        return view('users.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Products::find($request->product_id);
        $cart = $request->session()->get('cart');
        
        if(!is_null($cart)){
            if(array_key_exists($request->product_id,$cart)) {
                if( Auth::check() ){
                    $product = Cart::where('user_id', Auth::user()->id )
                                ->where('product_id',$request->product_id)
                                ->update(['quantity' => $cart[$request->product_id]->quantity + 1] );
                }
                $cart[$request->product_id]->quantity += 1;
            }else{
                if( Auth::check() ){
                    Cart::create([
                        'user_id' => Auth::user()->id,                
                        'product_id' => $product->id,               
                        'quantity' => 1,               
                    ]);
                }
                $product->quantity = 1;
                $cart[$product->id] = $product;
                
            }
        }else{
            if( Auth::check() ){
                Cart::create([
                    'user_id' => Auth::user()->id,                
                    'product_id' => $product->id,               
                    'quantity' => 1,               
                ]);
            }
            $product->quantity = 1;
            $cart[$product->id] = $product;
        }
        
        $request->session()->put('cart', $cart);
        $request->session()->flash('success', 'Added product to cart');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
