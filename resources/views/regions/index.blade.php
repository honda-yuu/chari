<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
       <body>
       <header>
          <h1>RESEARCH PARK</h1>
       </header>
    
           <h1>熊本市の駐輪場一覧</h1>
           
           <h1>駐輪場を探す</h1>
           <div class="search">
                <form action="/park/index" method="GET">
                   <input type="text" name="keyword" value="{{ $keyword??"" }}">
                   <input type="submit" value="検索">
                </form>
           </div>
           <div class='facilities'>
                @foreach($facilities as $facility)
                    <div class='facility'>
                        <h2 class='name'>
                           <a href="/park/{{ $facility->id }}">{{ $facility->name }}</a>
                        </h2>
                       <p class='opening_time'>{{ $facility->opening_time }}</p>
                       <p class='per_hour_fee'>{{ $facility->per_hour_fee }}</p>
                       <p class='capacity'>{{ $facility->capacity }}</p>
                       <a href="/regions/{{ $facility->region->id }}">{{ $facility->region->name }}</a>

                    </div>
                @endforeach
           </div>
           <div class='paginate'>
               {{ $facilities->links() }}
           </div>
           
    
            
            
        </body>