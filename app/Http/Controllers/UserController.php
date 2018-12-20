<?php

namespace App\Http\Controllers;
use App\User;
use App\models\Products;
use App\models\Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserPost;



class UserController extends Controller
{
    public function order_history(){
        return view('users.order_history');
    }


    public function showLogin(){
        return view('users/login');
    }
    public function doLogout(Request $request){
        Auth::logout();
        $request->session()->flush();
        return redirect('home');
    }
    protected function checkAuth(Request $request){
        $credential=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($credential)){
            
            $user = User::find(Auth::user()->id);
            // is user block 
            if ($user->status == 0) {
                Auth::logout();
                $request->session()->flush();
                return redirect('login')->withErrors(['This account was blocked, please go to shop to support'])->withInput();
            }
            $cart = $request->session()->get('cart');
            
            if(!is_null($cart)){
                foreach ($cart as $key => $product_incart) {
                    $is_exit = 0;
                    foreach ($user->carts as $prod) {
                        if($prod->id == $key) {
                            $product = Cart::where('user_id', $user->id )
                                            ->where('product_id',$prod->id)
                                            ->update(['quantity' => $product_incart->quantity + $prod->pivot->quantity] );

                            $product_incart->quantity += $prod->pivot->quantity;

                            $is_exit = 1;
                            break;
                        }    
                    }
                    // Chua co trong gio hang CSDL
                    if(!$is_exit){

                        Cart::create([
                            'user_id' => $user->id,                
                            'product_id' => $key,               
                            'quantity' => $product_incart->quantity,               
                        ]);
                    }    
                }
                foreach ($user->carts as $prod) {
                    if(!array_key_exists($prod->id,$cart)) {
                        $prod->quantity = $prod->pivot->quantity;
                        $cart[$prod->id] = $prod;
                    }
                }

                
            }else{

                foreach ($user->carts as $prod) {
                    $prod->quantity = $prod->pivot->quantity;
                    $cart[$prod->id] = $prod;
                }
                
            }
            
            $request->session()->put('cart', $cart);
            return redirect('home');
        }else{
            return redirect('login')->withErrors(['Wrong email or password'])->withInput();
        }
         
    }

    public function blockUser($id){
        $user = User::find($id);

        $user->status = 0;
        $user->save();
        return redirect("users");
    }

    public function unblockUser($id){
        $user = User::find($id);

        $user->status = 1;
        $user->save();
        return redirect("users");
    }

    public function getDetail($id){
       
        $user = User::find($id);
        echo $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('admins/users', ['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPost $request)
    {
        $validated = $request->validated();
        if($request->file('logo')) {
            $path = $request->file('logo')->store('public/users');
            $path = explode("/", $path);
            $path = $path[1] .'/'.$path[2];
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'user_phone' => $request->user_phone,
                'user_address' => $request->user_address,
                'password' => Hash::make($request['password']),
                'user_image' => $path,
            ]);
            return redirect('home')->with('success', 'User created successfully.');
        }
        return Redirect::back()->withErrors(['The image null or wrong type'])->withInput();
        
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('users/profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $user->status = 0;
        $user->save();
        return redirect("users");
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
        // $validated = $request->validated();
        $user = User::find($id);
        if($request->file('logo')) {
            unlink(storage_path('app/public/'. $user->user_image));
            $path = $request->file('logo')->store('public/users');
            $path = explode("/", $path);
            $path = $path[1] .'/'.$path[2];
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_phone = $request->user_phone;
            $user->user_address = $request->user_address;
            $user->user_image = $path;
            $user->save();
        }else{
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->user_phone = $request->user_phone;
            $user->user_address = $request->user_address;
            $user->save();
        }
        return redirect()->back();
        
    }

    // Change new password
    public function changePassword(Request $request){

        $user = User::find($request->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'User change password successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
