<?php

namespace App\Http\Controllers;

use App\penjualan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use App\Notifications\approval;

class PenjualanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function penjualandelete(Request $request)
    {
        $email = DB::table('penjualans')->where("code","=",$request->get('id'))->get("email");
        $data=[
            "text" => "maaf nih pembayaran kamu pake pemesanan ".$request->get('id')." ditolak mohon hubungi customer service kami ya",
        ];
        $user = new User();
        $user->email = $email[0]->email;   // This is the email you want to send to.
        $user->notify(new approval($data));

        DB::table('penjualans')
        ->where('code', $request->get('id'))
        ->update([
            'status' =>3,
        ]);
    }

    public function penjualanapproval(Request $request)
    {
        $email = DB::table('penjualans')->where("code","=",$request->get('id'))->get("email");
        $data=[
            "text" => "selamat nih pembayaran kamu pake pemesanan ".$request->get('id')." telah diterima",
        ];
        $user = new User();
        $user->email = $email[0]->email;   // This is the email you want to send to.
        $user->notify(new approval($data));
        DB::table('penjualans')
        ->where('code', $request->get('id'))
        ->update([
            'status' =>2,
        ]);
    }

    public function list()
    {
        //
        $data = DB::table('penjualans')->get();
        // dd( $data);
        return view('penjualan/list',['data' => $data]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function show(penjualan $penjualan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function edit(penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\penjualan  $penjualan
     * @return \Illuminate\Http\Response
     */
    public function destroy(penjualan $penjualan)
    {
        //
    }
}
