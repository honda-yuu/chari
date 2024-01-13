<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>トップページ</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </head>
        <x-admin>
        <header>
          <h1>RESEARCH PARK</h1>
        </header>
    <body>
        <h1>口コミ投稿</h1>
        
        <div class="reviewform">
            <form action="/admin/park" method="POST" enctype="multipart/form-data">
                @csrf
        <div class="username">
            <h2>ニックネーム</h2>
            <input type="text" name="review[name]"  value="{{ old('review.name') }}" />
            <h2>{{$facility->name}}</h2>
        <div class="reviewname">
            <input type="hidden" name="review[facility_id]" value="{{$facility->id}}"/>
            <textarea name="review[body]" style="width:80%" placeholder="口コミ本文を入れてください"></textarea>
            <div class="star">
              <input id="star1" type="radio" name="review[star_number]" value="5" />
              <label for="star1">★</label>
　　　　　　　<input id="star2" type="radio" name="review[star_number]" value="4" />
　　　　　　　<label for="star2">★</label>
　　　　　　　<input id="star3" type="radio" name="review[star_number]" value="3" />
            　<label for="star3">★</label>
            　<input id="star4" type="radio" name="review[star_number]" value="2" />
            　<label for="star4">★</label>
            　<input id="star5" type="radio" name="review[star_number]" value="1" />
            　<label for="star5">★</label>
            </div>   
            <div class="image">
                <input type="file" name="image">
            </div>
                <div class="reviewbtn">
                    <input type="submit" value="送信"/>
                </div>
            </form>
        </div>
        </div>
       </div>
        
    </body>
    </x-admin>
</html>
