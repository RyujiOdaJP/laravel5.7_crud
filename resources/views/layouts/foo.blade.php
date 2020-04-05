<!DOCTYPE html>
<!-- html template -->
<html lang="ja">
    <head>
        <title>@yield('title')</title>
    </head>
    <body>
    <h1>練習レイアウト</h1>    
    {{-- 個別ページの内容はここに挿入される --}}
    @yield('content')
    </body>
</html>