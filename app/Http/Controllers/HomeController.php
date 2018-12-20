<?php

namespace App\Http\Controllers;
use App\models\Products;
use App\models\Category;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about(){
        return view('users/about');
    }
    public function index()
    {
        $products = Products::paginate(12);
        $categories = Category::all('id','category_name','status');
        return view('users/home',['products'=> $products, 'categories' => $categories]);
    }
    public function showProduct($id){
        // User view product
        $product = Products::find($id);
        $comments = [];
        
        foreach ($product->comments as $comment) {
            $come['comment_content'] = $comment->comment_content;
            $come['created_at'] = $comment->created_at;
            $user = User::find($comment->user_id);
            $come['image'] = $user->user_image;
            $comments[] = $come;
        }
        return view('users.product',['product' => $product,'comments' => $comments]);
    }
    public function showCategory($id){
        // list product in category
        $category = Category::find($id);
        return view('users.category',['category' => $category]);
    }

    public function search(Request $request){
        if($request->ajax()){
            $output="";
            $products = Products::where('product_name','LIKE','%'.$request->search."%")
            ->get();
            if($request->search == null)
                return Response($output);
            if($products){
                foreach ($products as  $product) {
                    $sub = substr($product->product_price,-3);
                    $pre = substr($product->product_price,0,-3);
                    $price = $pre . '.' .$sub;
                    $output.= '<div class="col-lg-3 col-sm-6 ">
                        <div class="card h-100">
                          <a href="product/'. $product->id .'"><img class="card-img-top" src="img/products/'. $product->product_image .'" alt="product" height="250">
                            <div class="card-body">
                              <h5 class="card-title">
                                '. $product->product_name .'
                              </h5>
                              <small class="text-muted">
                                <p class="card-text" style="color: red"><b>Price: </b>'. $price  .'Đ</p>
                                <p class="card-text"><b>SL đơn đặt hàng: </b>'. $product->orders->count() .'</p>  
                              </small>
                              
                            </div>
                          </a>
                          
                        </div>

                      </div>';
                    
                }
                return Response($output);
            }
        }
    }
    
}
