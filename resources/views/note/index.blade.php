@extends('layouts.main')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.css" rel="stylesheet">
    <link href="https://unpkg.com/basscss@8.0.2/css/basscss.min.css" rel="stylesheet">
    <link href="{{ asset('css/color.css') }}" rel="stylesheet">
    <style type="text/css">

    </style>
@endsection
@section('content')
    <div class="level is-12">
        <div class="level-left is-2 bg-gray">
            <aside class="menu is-size-7">
                <ul class="menu-list">
                    @foreach($shareList['data'] as $share)
                        <li><a>{{ $share['title'] }}</a></li>
                    @endforeach
                </ul>
            </aside>
        </div>
        <div class="level-right is-8">

        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/note.js') }}"></script>
@endsection