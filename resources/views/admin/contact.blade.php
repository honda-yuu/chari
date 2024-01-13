<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>問い合わせフォーム</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    
    <x-admin>
    
   
        <body>
           <h1>問い合わせフォーム</h1>
           <form action="/admin/park/contact" method="POST">
               @csrf
               <div class="name">
                   <h2>お名前</h2>
                   <input type="text" name="contact[name]" placeholder="お名前を入力してください。" value="{{ old('contact.title') }}" />
                   <p class="name__error" style="color:red">{{ $errors->first('contact.name')}}</p>
               </div>
               
               <div class="body">
                   <h2>本文</h2>
                   <textarea name="contact[body]" placeholder="〇〇駐輪場の料金の掲載が正しくない。"></textarea>
                   <p class="body__error" style="color:red">{{ $errors->first('contact.body')}}</p>
               </div>
               <input type="submit" onclick="contactform()" value="送信"/>
           </form>
           <div class="footer">
            <a href="/admin/park/">戻る</a>
           </div>
           
           <script>
               function contactform(){
                   'use strict'
                  
                   alert('送信が完了しました。\nトップページに戻ります。');
               }
           </script>
        </body>
    </x-admin>
</html>
