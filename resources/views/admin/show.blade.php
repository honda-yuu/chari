<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
         <link rel="stylesheet" href="{{ asset('/css/star.css') }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <x-admin>
   
        <body>
            <div class="name">
                <h1 class="name">
                    {{$facility->name}} 
                    </h1>
            </div>
            
             <div id="map" style="height:500px"></div>
            	   <script src="{{ asset('/js/result.js') }}"></script>
            	   <script src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key=AIzaSyD4_2152ivTGp4yt1qPgyvGdyD5zJ7om7I&callback=initMap" async defer>
            	   </script>
            	   
            	  <script> // googleMapsAPIを持ってくるときに,callback=initMapと記述しているため、initMap関数を作成
function initMap() {
    // welcome.blade.phpで描画領域を設定するときに、id=mapとしたため、その領域を取得し、mapに格納します。
    map = document.getElementById("map");
    const data = {!!json_encode( $facility ) !!};
    let latitude = data.latitude;
    let longitude = data.longitude;
    // 東京タワーの緯度は35.6585769,経度は139.7454506と事前に調べておいた
    let location = {lat: latitude, lng: longitude};
    // オプションを設定
    opt = {
        zoom: 18, //地図の縮尺を指定
        center: location, //センターを東京タワーに指定
    };
    // 地図のインスタンスを作成します。第一引数にはマップを描画する領域、第二引数にはオプションを指定
    mapObj = new google.maps.Map(map, opt);
    
     marker = new google.maps.Marker({
        // ピンを差す位置を決めます。
        position: location,
	// ピンを差すマップを決めます。
        map: mapObj,
	// ホバーしたときに「tokyotower」と表示されるようにします。
        title: '熊本市庁舎自転車駐車場',
    });
} </script>
         
            <div class='detail'>
                <div class='opening_time'>
                    <h3>営業時間：{{$facility->opening_time}}</h3>
                </div>
                <div class='per_hour_fee'>
                    <h3>料金：{{$facility->per_hour_fee}}</h3>
                </div>
                <div class='capacity'>
                    <h3>駐車台数：{{$facility->capacity}}</h3>
                </div>
                <div class='address'>
                    <h3>住所：{{$facility->address}}</h3>
                </div>
                <div class='link'>
                    <h3>リンク：{{$facility->link}}</h3>
                </div>
                <div class='phone_number'>
                    <h3>電話番号：{{$facility->phone_number}}</h3>
                </div>
                <div class='bicycle'>
                    <h3>自転車：{{$facility->bicycle}}</h3>
                </div>
                <div class='bike_under_125cc'>
                    <h3>原付（125㏄以下）：{{$facility->bike_under_125cc}}</h3>
                </div>
                <div class='bike_more_125cc'>
                    <h3>大型バイク（125CC以上）：{{$facility->bike_more_125cc}}</h3>
                </div>
                <div class='receipt'>
                    <h3>領収書：{{$facility->receipt}}</h3>
                <div class='image'>
                    <img class='image1'src="{{ $facility->image }}" alt="">
                     <img class='image1'src="{{ $facility->image2 }}" alt="">
                      <img class='image1'src="{{ $facility->image3 }}" alt="">
                </div>
                </div>
            </div>
            
            <div class='reviewshow'>
                 <h2>口コミ</h2>
                @foreach($reviews as $review)
                <div class='reviews'>
                   
                    <p class='name'>{{ $review->name }}</p>
                    <div class='star'>
                    @if($review['star_number'] === 0)
                    <label for="star0">☆☆☆☆☆</label>
                    @elseif( $review['star_number'] === 1)
            　　　  　 <label for="star1">★☆☆☆☆</label>
            　　　  　 @elseif($review['star_number'] === 2)
            　　　  　 <label for="star2">★★☆☆☆</label>
　　　　　　　　　　@elseif($review['star_number']  === 3)
　　　　　　　　　　<label for="star3">★★★☆☆</label>
　　　　　　　　　　@elseif($review['star_number'] === 4)
　　　　　　　　　　<label for="star4">★★★★☆</label>
　　　　　　　　　　@else($review['star_number'] === 5)
　　　　　　　　　　<label for="star5">★★★★★</label>
　　　　　　　　　　@endif
　　　　　　　　　　</div>
                    
                    <p class='body'>{{ $review->body }}</p>
                    <p class='created_at'>{{ $review->created_at }}</p>
                @if($review->image)
                <div class='reviewimage'>
                    <img src="{{ $review->image }}" alt="画像が読み込めません。"/>
                </div>
                @endif
                </div>

                @endforeach
            </div>
            <div class="review">
                <a href="/admin/park/review/{{$facility->id}}">口コミを書く</a>
            </div>
            <div class="top-page">
                <a href="/admin/park/index">トップページへ戻る</a>
            </div>
        </body>
    </x-admin>    
</html>
