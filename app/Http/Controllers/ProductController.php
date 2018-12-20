<?php

namespace App\Http\Controllers;
use App\models\Products;
use App\models\Category;
use App\models\Rate;
use App\models\Orders;
use App\models\Transactions;
use App\models\Cart;
use App\models\Comments;
use App\models\Order_histories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::all();
        $categories = Category::all('id','category_name');
        return view('admins.products',['products'=> $products, 'categories' => $categories]);
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
        request()->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->file('logo')) {
            $imageName = request()->logo->getClientOriginalName() .'-'. time().'.'. request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('img/products'), $imageName);
            Products::create([
                'product_name' => $request->product_name,
                'product_description' => $request->product_description,
                'product_url' => $request->product_url,
                'category_id' => $request->category_id,
                'product_quantity' => $request->product_quantity,
                'product_price' => $request->product_price,
                'product_condition' => $request->product_condition,
                'product_keyword' => $request->product_keyword,
                'product_content' => $request->product_content,
                'product_image' => $imageName,
                
            ]);
            return redirect('products')->with('success', 'Product created successfully.');
        }
        return Redirect::back()->withErrors(['image', 'The image null or wrong type']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Products::find($id);
        $categoryId = $product->category_id;
        $categories = Category::all('id','category_name');

        return view('admins.product_update',['product' => $product, 'categoryId' => $categoryId, 'categories' => $categories]);
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
        $product = Products::find($id);
        if ($request->file('logo')) {
            request()->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

            $imageName = request()->logo->getClientOriginalName() .'-'. time().'.'. request()->logo->getClientOriginalExtension();
            request()->logo->move(public_path('img/products'), $imageName);

            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->product_url = $request->product_url;
            $product->category_id = $request->category_id;
            $product->product_quantity = $request->product_quantity;
            $product->product_price = $request->product_price;
            $product->product_condition = $request->product_condition;
            $product->product_keyword = $request->product_keyword;
            $product->product_content = $request->product_content;
            $product->product_image = $imageName;

            $product->save();
        } else {
            $product->product_name = $request->product_name;
            $product->product_description = $request->product_description;
            $product->product_url = $request->product_url;
            $product->category_id = $request->category_id;
            $product->product_quantity = $request->product_quantity;
            $product->product_price = $request->product_price;
            $product->product_condition = $request->product_condition;
            $product->product_keyword = $request->product_keyword;
            $product->product_content = $request->product_content;

            $product->save();
        }
            return redirect('products')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get all record table orders where products.id = orders.product_id
        $orders = Orders::where('product_id',$id)->get();

        foreach($orders as $order) {
            // get order_id
            $orderId = $order->id;

            // get transaction_id
            $transactionId = $order->transaction_id;

            // delete record table order_histories where order_histrories.order_id = orders.id
            $orderhistory = Order_histories::where('order_id',$orderId);
            if($orderhistory) {
                $orderhistory->delete();
            }


            // delete record table rate where rate.order_id = orders.id
            $rate = Rate::where('order_id',$orderId);
            if($rate){
                $rate->delete();
            }
            
            // delete record table orders follow transaction_id
            $o = Orders::where('transaction_id',$transactionId);
            if($o){
                $o->delete();
            }
            // Orders::destroy($orderId);

            // delete record table trasactions where transactions.id = orders.transaction_id
            Transactions::destroy($transactionId);
        }


        // delete record table carts where carts.product_id = products.id
        $cart = Cart::where('product_id',$id);
        if($cart){
            $cart->delete();
        }

        // delete record table comments where carts.product_id = products.id
        $comment = Comments::where('product_id',$id);
        if($comment){
            $comment->delete();
        }

        // delete record table products
        Products::destroy($id);

        return redirect('products');
    }
}
