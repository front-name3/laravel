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

  public function companies_save($request,$id){

    $companies = Companies::findOrFail($id);
    $companies->company_name = $request->company_name;
    $companies->street_address = '住所';
    $companies->representative_name = '代表者名';
    $companies->save();

  }

  public function companies_destroy($id){

    $companies = Companies::findOrFail($id);

    // 削除
    $companies->delete();


  }
}
