<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Admin;
use App\models\Products;
use App\models\Category;
use App\models\Rate;
use App\models\Orders;
use App\models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function showDashboard(){
        $totalTrans = Transactions::all()->count("transaction_id");
        $waitTrans = Transactions::all()->where('status', 1)->count("transaction_id");
        $shipTrans = Transactions::all()->where('status', 2)->count("transaction_id");
        $doneTrans = Transactions::all()->where('status', 3)->count("transaction_id");
        $money = Transactions::all()->groupBy(DB::raw('Date(created_at)'))->sum('total_money');
        return view('admins/dashboard', ['totalTrans'=>$totalTrans, 'waitTrans'=>$waitTrans, 'shipTrans'=>$shipTrans, 'doneTrans'=>$doneTrans,'money'=>$money]);
    }
    /**
     * [checkAuth description] Check account admin
     * @param  Request $request admin_email, admin_password
     * @return view dashboard if true
     */
    protected function checkAuth(Request $request){
        $credential=[
            'admin_email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::guard('admin')->attempt($credential)){
            $admin_email = $request->input("email");
            $admin = DB::table("admins")
                        ->where("admin_email", "=", $admin_email)
                        ->first();
            if($admin->admin_status == 0){
                return view('admins/login', ['error'=> "Tài khoản đã bị khóa"]);
            }
            else{
                session(["admin_status" => $admin->admin_status]);
                return redirect('admin/dashboard');
            }     
        } else{
            return view('admins/login', ['error'=> "Email hoặc Password không đúng, hãy thử lại"]);
        }
         
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admins/login');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins/register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Admin::create([
            'admin_name' => $request->admin_name,
            'password' => Hash::make($request->password),
            'admin_phone' => $request->admin_phone,
            'admin_email' => $request->admin_email,
            'admin_status' => 2 // 2 is admin, 1 is employee
            
        ]);
        return redirect('admin/dashboard');
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
        return view('admins/forgot-password');
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
