<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = DB::table('products')->where([['stok', '=',1]])->count();
        $products = DB::table('products')->where([['stok', '=',1]])->paginate(5);
        $penjualan = DB::table('penjualans')->where([['status', '=',2]])->count();
        $penjualans = DB::table('penjualans')->where([['status', '=',2]])->paginate(10);
        $pemasukan = DB::table('penjualans')->where([['status', '=',2]])->select("total")->get();
        foreach ($pemasukan as $masuk) {
            $pemasukana[] = str_replace(".","",$masuk->total);
        }
        $subtotal = array_sum($pemasukana);
        // dd();
        return view('layouts/dashboard',['product' => $product,'penjualan' => $penjualan,'pemasukan' => $subtotal,'datapenjualan' => $penjualans,'dataproduct' => $products]);
    }
}
