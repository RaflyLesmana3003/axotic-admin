<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tambah()
    {
        //
        return view('product/tambah');
    }

    public function list()
    {
        //
        $data = DB::table('products')->get();
        // dd( $data);
        return view('product/list',['data' => $data]);
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
        //uploadphoto
        $uploaded = $request->photo;
        if ($uploaded === "undefined")
        {
        }
        else
        {
            $file_parts = pathinfo($uploaded);


                $photo = "product" . time() . $uploaded->getClientOriginalName();

                $ext = pathinfo($photo, PATHINFO_EXTENSION);
                if ($ext == "PNG" || $ext == "JPG" || $ext == "JPEG" || $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
                $uploaded->move(storage_path('/app/public/file') , $photo);
                }else{
                    return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                }

        }

        //uploadphoto1
        $uploaded1 = $request->photo1;
        if ($uploaded === "undefined")
        {
        }
        else
        {
            $file_parts = pathinfo($uploaded1);


                $photo1 = "product1" . time() . $uploaded1->getClientOriginalName();

                $ext = pathinfo($photo1, PATHINFO_EXTENSION);
                if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                $uploaded1->move(storage_path('/app/public/file') , $photo1);
                }else{
                    return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                }

        }

        //uploadphoto2
        $uploaded2 = $request->photo2;
        if ($uploaded === "undefined")
        {
        }
        else
        {
            $file_parts = pathinfo($uploaded2);


                $photo2 = "product2" . time() . $uploaded2->getClientOriginalName();

                $ext = pathinfo($photo2, PATHINFO_EXTENSION);
                if ($ext == "PNG" || $ext == "JPG" || $ext == "png" || $ext == "jpg") {
                $uploaded2->move(storage_path('/app/public/file') , $photo2);
                }else{
                    return response(['data'=>"thumbnail harus berupa .JPG atau .PNG",'tipe'=>"danger"], 404);
                }

        }

          DB::table('products')->insert([[
            'nama' => $request->get('nama'),
            'harga' => $request->get('harga'),
            'kode' => $request->get('kode'),
            'stok' => 1,
            'desc' => $request->get('deskripsi'),
            'photo' => $photo,
            'photo1' => $photo1,
            'photo2' => $photo2,
            'created_at' => now(),
            ]]);

    }

    public function delete(Request $request)
    {
        $data = DB::table('products')->where('id', '=', $request->get('id'))->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        DB::table('products')
            ->where('id', $request->get('id'))
            ->update([
                'nama' => $request->get('nama'),
                'harga' => $request->get('harga'),
                'kode' => $request->get('kode'),
                'stok' => $request->get('stok'),
                'desc' => $request->get('deskripsi'),
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        //
    }
}
