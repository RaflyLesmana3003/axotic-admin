<?php

namespace App\Http\Controllers;
use DateTime;
use DateTimeZone;
use App\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use App\Notifications\statusa;
use App\Notifications\resi;
use App\User;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addresi(Request $request)
    {
        $email = DB::table('penjualans')->where("code","=",$request->get('code'))->get("email");
        $data=[
            "resi" => $request->get('resi'),
        ];

        $user = new User();
        $user->email = $email[0]->email;   // This is the email you want to send to.
        $user->notify(new resi($data));
        DB::table('penjualans')
        ->where('code', $request->get('code'))
        ->update([
            'resi' => $request->get('resi'),
        ]);
        $timezone = new DateTimeZone('Asia/Jakarta');
        $date = new DateTime();
        $date->setTimeZone($timezone);
        DB::table('pembayarans')->insert([[
            'code' => $request->get('code'),
            'status' => "update nomor resi",
            'deskripsi' => "mohon lakukan pengecekan nomor resi anda",
            'created_at' => $date->format('Y-m-d H:i:s'),
            ]]);
        return $request->get('code');
    }
    public function delete(Request $request)
    {
        $data = DB::table('pembayarans')->where('id', '=', $request->get('id'))->delete();
        return $request->get('code');
    }
    public function addstatus(Request $request)
    {
        //
        $email = DB::table('penjualans')->where("code","=",$request->get('code'))->get("email");
        $data=[
            "status" => $request->get('status'),
            "deskripsi" => $request->get('deskripsi'),
        ];
        $user = new User();
        $user->email = $email[0]->email;   // This is the email you want to send to.
        $user->notify(new statusa($data));

        $timezone = new DateTimeZone('Asia/Jakarta');
        $date = new DateTime();
        $date->setTimeZone($timezone);
        DB::table('pembayarans')->insert([[
            'code' => $request->get('code'),
            'status' => $request->get('status'),
            'deskripsi' => $request->get('deskripsi'),
            'created_at' => $date->format('Y-m-d H:i:s'),
            ]]);
        // dd( $data);
        return $request->get('code');
    }

    public function list()
    {
        //
        $data = DB::table('penjualans')->get();
        // dd( $data);
        return view('status/list',['data' => $data]);
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
     * @param  \App\status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(status $status)
    {
        //
    }
}
