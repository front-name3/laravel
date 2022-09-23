<?php

namespace App\Http\Controllers;
use App\Companies;
use App\Products;
use Illuminate\Http\Request;


class CompaniesController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       

       /*  $companies = Companies::all(); */

        /* return view('crud.index',['posts' => $companies]); */
        /* return view('crud.index',['companies' => $companies]); */


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('crud.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $maxUserId = Products::max('id')+1;

                 // ディレクトリ名
         $dir = 'img';

         // アップロードされたファイル名を取得
         $file_name = $request->file('image')->getClientOriginalName();



         // ランダムな名前でsampleディレクトリに画像を保存
         // $request->file('image')->store('public/' . $dir);

         // 取得したファイル名で保存する
         $request->file('image')->storeAs('public/' . $dir, $maxUserId . '_' .$file_name);

         // ファイル情報をDBに保存
        $image = new Products();
        /* $image->name = $file_name; */
        $image->companies_id = '11';
        $image->product_name = '1';
        $image->price = '1';
        $image->stock = '11';
        $image->comment = '1';
        $image->img_path = 'storage/' . $dir . '/'. $maxUserId . '_'. $file_name;
        $image->save();


         return redirect('/');
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
        //
    }
}
