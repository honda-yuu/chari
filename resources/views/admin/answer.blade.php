<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>返答</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <x-admin>
    
   
        <body>
           <h1>返答</h1>
           @foreach($contacts as $contact)
             <div class='contact'>
             <div class='contactshow'>    
                 <h2>問い合わせ</h2>
                 <p class='name'>{{ $contact->name }}</p>
                 <p class='body'>{{ $contact->body }}</p>
             </div>
             </div>
           @endforeach
         
           
           
           
        </body>
    </x-admin>
</html>