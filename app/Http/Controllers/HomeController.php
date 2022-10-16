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


        $companies = new Companies();
        $posts = $companies->index_table($request);

        /* return view('crud.index', compact('posts', 'keyword')); */
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



        $maxUserId = Products::max('id')+1;

        // ディレクトリ名
        $dir = 'img';


        // ランダムな名前でsampleディレクトリに画像を保存する場合
        // $request->file('image')->store('public/' . $dir);

        // 取得したファイル名で保存する

         /* 画像ファイルがアップロード選択されていない場合、ダミーの画像のURLを入れる */

         $pass = "storage/img/ダミー.png";

        /* 必須項目以外のinputが空になっているか確認のため受け取った情報を取得 */
        $img_path = $request->file('img_path');
        $comment = $request->comment;


        /* ファイルがフォーム内で選択されていればファイルのパスを取得し$passへ代入する */
         if(!empty($img_path)) {
         $file_name = $request->file('img_path')->getClientOriginalName();

         // 取得したファイル名で保存
         // storage/app/public/任意のディレクトリ名/
         $request->file('img_path')->storeAs('public/' . $dir, $file_name);

         $pass = "storage/img/".$file_name;


        }


        /* ファイルがフォーム内でコメントが存在すれば取得し$commentへ代入する */
        if(isset($request->comment)) { } else {$comment = '登録されたコメントはありません'; }


        // ファイル情報をDBに保存
        /* データを挿入する方法 $image->name = $request->price; */
        $products = new Products();

        $products->companies_id = $maxUserId;
        $products->product_name = $request->product_name;
        $products->price = $request->price;
        $products->stock = $request->stock;
        $products->comment = $comment;
        $products->img_path = $pass;

        $products->save();

        $companies = new Companies();
        $companies->company_name = $request->company_name;
        $companies->street_address = '住所';
        $companies->representative_name = '代表者名';
        $companies->save();

        return redirect('/');

    }

    public function update(Request $request, $id)
    {


        // ランダムな名前でsampleディレクトリに画像を保存する場合
        // $request->file('image')->store('public/' . $dir);

        // 取得したファイル名で保存する

         /* 画像ファイルがアップロード選択されていない場合、ダミーの画像のURLを入れる */

         $pass = "storage/img/ダミー.png";

        // ディレクトリ名
        $dir = 'img';

        /* 必須項目以外のinputが空になっているか確認のため受け取った情報を取得 */
        $img_path = $request->file('img_path');
        $comment = $request->comment;


        /* ファイルがフォーム内で選択されていればファイルのパスを取得し$passへ代入する */
         if(!empty($img_path)) {
         $file_name = $request->file('img_path')->getClientOriginalName();

         // 取得したファイル名で保存
         // storage/app/public/任意のディレクトリ名/
         $request->file('img_path')->storeAs('public/' . $dir, $file_name);

         $pass = "storage/img/".$file_name;


        }


        /* ファイルがフォーム内でコメントが存在すれば取得し$commentへ代入する */
        if(isset($request->comment)) { } else {$comment = '登録されたコメントはありません';}

        // ファイル情報をDBに保存
        /* データを挿入する方法 $image->name = $request->price; */
        $products = Products::findOrFail($id);


        $products->product_name = $request->product_name;
        $products->price = $request->price;
        $products->stock = $request->stock;
        $products->comment = $comment;
        $products->img_path = $pass;

        $products->save();

        $companies = Companies::findOrFail($id);
        $companies->company_name = $request->company_name;
        $companies->street_address = '住所';
        $companies->representative_name = '代表者名';
        $companies->save();

        return redirect('/');

    }

    public function destroy($id)
    {
        // 削除対象レコードを検索
    $products = Products::findOrFail($id);
   /*  $products = Products::find($id); */
    // 削除
    $products->delete();

    // 削除対象レコードを検索
    $companies = Companies::findOrFail($id);
    /*  $products = Products::find($id); */
    // 削除
    $companies->delete();


    // リダイレクト
    return redirect('/');
    }

}
