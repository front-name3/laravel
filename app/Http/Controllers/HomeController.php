<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Companies;
use App\Products;

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

        /* インスタンス呼び出し */
        $companies = new Companies();
        $posts = $companies->index_table($request);

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
        /* インスタンス呼び出し */
        $products = new Products();
        $posts = $products->store_process($request);

        return redirect('/');

    }

    public function update(Request $request, $id)
    {

        /* インスタンス呼び出し */
        $products = new Products();
        $save = $products->products_save($request,$id);


        /* インスタンス呼び出し */
        $companies = new Companies();
        $save = $companies->companies_save($request,$id);

        return redirect('/');

    }

    public function destroy($id)
    {

        $companies = new Companies();
        $destroy = $companies->companies_destroy($id);

        $products = new Products();
        $destroy = $products->products_destroy($id);

    // リダイレクト
    return redirect('/');
    }

}
