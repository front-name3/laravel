<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Products;
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
    public function index(Request $request)
    {

        DB::beginTransaction();

    try {
        /* インスタンス呼び出し */
        $companies = new Companies();
        $posts = $companies->index_table($request);
        // データ操作を確定させる
        DB::commit();
    } catch(Exception $exception) {
        // データ操作を巻き戻す
        DB::rollBack();
        throw $exception;
    }



        return view('crud.index', ['posts' => $posts]);

    }


    public function show($id)
    {
        $companies = Companies::findOrFail($id);
        return view('crud.show')->with('companies',$companies);
    }

    public function edit($id)
    {
        $companies = Companies::findOrFail($id);
        return view('crud.edit')->with('companies',$companies);
    }



    public function create()
    {
        return view('crud.create');
    }



    public function store(Request $request)
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            /* インスタンス呼び出し */
            $products = new Products();
            $posts = $products->store_process($request);
            // データ操作を確定させる
            DB::commit();
        } catch(Exception $exception) {
            // データ操作を巻き戻す
            DB::rollBack();
            throw $exception;
        }

            return redirect('/');

    }

    public function update(Request $request, $id)
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            /* インスタンス呼び出し */
        $products = new Products();
        $save = $products->products_save($request,$id);


        /* インスタンス呼び出し */
        $companies = new Companies();
        $save = $companies->companies_save($request,$id);
            // データ操作を確定させる
            DB::commit();
        } catch(Exception $exception) {
            // データ操作を巻き戻す
            DB::rollBack();
            throw $exception;
        }



        return redirect('/');

    }

    public function destroy($id)
    {

        try {
            /* インスタンス呼び出し */
            $companies = new Companies();
            $destroy = $companies->companies_destroy($id);
            /* インスタンス呼び出し */
            $products = new Products();
            $destroy = $products->products_destroy($id);
            // データ操作を確定させる
            DB::commit();
        } catch(Exception $exception) {
            // データ操作を巻き戻す
            DB::rollBack();
            throw $exception;
        }



    // リダイレクト
    return redirect('/');
    }

}
