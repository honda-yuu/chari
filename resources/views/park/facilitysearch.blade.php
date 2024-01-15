<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>駐輪場を探す</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    </head>
    
    <x-app-layout>
       <header>
          <h1 class='subtitle'>RESEARCH PARK</h1>
       </header>
    
   
        <body>
           <h1 class='title'>熊本市の駐輪場一覧</h1>
           
           <h1>・駐輪場を探す</h1>
           <div class="search">
                <form action="/park/facilitysearch" method="GET">
                    @csrf
                   <input type="text" name="keyword" value="{{ request()->input('keyword') }}">
                   <input type="submit" value="検索">
                </form>
                <form action="/park/facilitysearch" method="GET">
                    @csrf
                       <h2>・地域ごとで探す</h2>
                       <select name="regionId" class="form-config" >
                            <option value="">--選択</option>
                                    
                                    
                        @foreach($regions as $region)
                            <option value="{{ $region->id }}">
                            {{ $region->area }}
                            </option>
                        @endforeach
                        </select>
                   <input type="submit" value="検索">
                </form>
           </div>
           <div class='facilities'>
                @foreach($facilities as $facility)
                    <div class='facility'>
                        <table>
                        <h2 class='name'>
                           <a href="/park/{{ $facility->id }}">{{ $facility->name }}</a>
                        </h2>
                        <tr>
                        <tr><th>営業時間：</th><td>{{ $facility->opening_time }}</td></tr>
                        <tr><th>料金：</th><td>{{ $facility->per_hour_fee }}</td></tr>
                        <tr><th>駐車台数：</th><td>{{ $facility->capacity }}</td></tr>
                        <tr><th>地区：</th><td><a href="/regions/{{ $facility->region->id }}">{{ $facility->region->area }}</a></td></tr>
                        <td><img class='image1'src="{{ $facility->image }}" alt="" width="200"></td>
                        </tr>
                        </table>
                    </div>
                @endforeach
           </div>
           
    
            
            
        </body>
    </x-app-layout>
</html>
