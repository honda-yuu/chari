<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </head>
    
     <x-app-layout>
       <body>
       
          <h1>RESEARCH PARK</h1>
           
           <h1>駐輪場を探す</h1>
           <div class="search">
                <form action="/park/index" method="GET">
                   <input type="text" name="keyword" value="{{ $keyword??"" }}">
                   <input type="submit" value="検索">
                </form>
           </div>
           <h2>＜地区ごとの駐輪場一覧＞</h2>
           <div class='facilities'>
                @foreach($facilities as $facility)
                    <div class='facility'>
                        <table>    
                           <h2 class='name'><a href="/park/{{ $facility->id }}">{{ $facility->name }}</a></h2>
                           <tr>
                           <tr><th>営業時間：</th><td>{{ $facility->opening_time }}</td></tr>
                           <tr><th>料金：</th><td>{{ $facility->per_hour_fee }}</td></tr>
                           <tr><th>駐車台数：</th><td>{{ $facility->capacity }}</td></tr>
                           <tr><th>地区：</th><td><a href="/regions/{{ $facility->region->id }}">{{ $facility->region->area }}</a></td></tr>
                           <div class="facilityimage">
                           <td><img class='image1'src="{{ $facility->image }}" alt="" width="200"></td>
                           </div>
                           </tr>
                       </table>
                    </div>
                @endforeach
           </div>
           <div class='paginate'>
               {{ $facilities->links() }}
           </div>
           
    
            
            
        </body>
        </x-app-layout>
    </html>