<!-- individual template -->
@extends('../layouts/my')
@section('title', $title)
@section('content')
    {{-- 個別ベージの内容 --}}
    <h2>{{ $title }}</h2>
    <p>{{ $body }}</p>
@endsection
