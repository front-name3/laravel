@extends('layouts.app')

@section('content')

<div class="wrapper mx-auto" style="padding-top:30px;">

<!-- 検索機能ここから -->
<div>
  <form action="{{ route('crud.index') }}" method="GET">

  @csrf

    <input type="text" name="keyword">
    <input type="submit" value="検索">
  </form>
</div>


<!-- 新規作成ボタン -->
<button style="margin-top:50px; margin-bottom:20px;" class="btn btn-primary" type=“button” onclick="location.href='/create'">新規作成</button>








<!--テーブル-->

      <div class="table-responsive">
          <table class="table" style="width: 1000px; max-width: 0 auto;">
                <tr class="table-info">
                <th scope="col" >id</th>
                  <th scope="col" >商品画像</th>
                  <th scope="col" >商品名</th>
                  <th scope="col" >価格</th>
                  <th scope="col" >在庫数</th>
                  <th scope="col" >メーカー名</th>
                  <th scope="col" >詳細表示</th>
                  <th scope="col" >削除</th>
                </tr>

                @foreach($posts as $companie)
                <tr>
                  <td>{{$companie->id}}</td>
                  <td><img style="width:80px;" src="{{asset($companie->products->img_path)}}" ></td>
                  <td>{{$companie->products->product_name}}</td>
                  <td>{{$companie->products->price}}</td>
                  <td>{{$companie->products->stock}}</td>
                  <td>{{$companie->company_name}}</td>
                  <td><a href="/show/{{$companie->id}}"><button type="button" class="btn btn-success">詳細</button></a></td>

                  <td>


                  <form  class="id">

                         <input data-user_id="{{$companie->id}}" type="submit" class="btn btn-danger btn-dell" value="削除">

                  </form>


                  </td>

                </tr>
                @endforeach
            </table>
       </div>

       {{ $posts->links() }}

    </div>


<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$(function() {
              $('.btn-danger').on('click', function() {
                var deleteConfirm = confirm('削除してよろしいでしょうか？');

                    if(deleteConfirm == true) {
                      var clickEle = $(this)
                      //$(this)は自身のhtmlタグを参照します
                      //今回は削除ボタンが押されたので、clickEleにはinputタグが代入されます

                      var userID = clickEle.attr('data-user_id');
                      //attr()」は、HTML要素の属性を取得したり設定することができるメソッド、今回はinputタグのdata-user-id属性の値を取得します
                      // 削除ボタンへ事前にdata-user-idという属性を付与しておき、IDの値をコントローラーから渡されたidの値をここで取得します

                            $.ajax({
                              type: 'POST',
                 url: '/destroy/'+userID,
                 dataType: 'json',
                 data: {'id':userID},


                                  })

                    } else {
                            (function(e) {
                              e.preventDefault()
                            });
                    };
              });
});


</script>

@endsection


