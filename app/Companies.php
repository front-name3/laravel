<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    Public function products()
  {
    //  Productsモデルのデータを引っ張てくる
    return $this->hasOne('App\Products');
  }

  public function index_table($request){

    /* テーブルから全てのレコードを取得する */
    $companies = Companies::query();


    /* キーワードから検索処理 */
    $keyword = $request->input('keyword');
    if(!empty($keyword)) {
        $companies->where('company_name', 'LIKE', "%{$keyword}%")
        ->orwhereHas('products', function ($query) use ($keyword) {
            $query->where('product_name', 'LIKE', "%{$keyword}%");
        })->get();

    }




    /* ページネーション */
    $posts = $companies->paginate(5);

    return $posts;

  }

}
